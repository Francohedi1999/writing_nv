<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->helper('captcha');
		$this->load->helper('email');
		$this->load->library('form_validation');
		$this->load->model('User_Model');
		$this->load->model('Commande_Model');
		$this->load->model('Facture_Model');
		$this->load->model('Info_user_Model');
		$this->load->model('Commentaire_Model');
		$this->load->model('Etat_commande_Model');
		$this->load->model('Tarif_Model');
		$this->load->model('Promotion_Model');
		$this->load->model('Langue_text_Model');
		$this->load->model('Type_paiement_Model');
	}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	
	// -------------------------------------------------------------------PROFIL ADMIN---------------------------------------------------------------------------------

	public function index()
	{
		if( isset($_SESSION['id_user']) && $_SESSION['id_user_type'] == 1 )
	    { 
			$data['title'] = "Admin";

			$data['user'] = $this->User_Model->find_user_by_id($_SESSION['id_user']);

			$data['commandes'] = $this->Commande_Model->get_nb_commande_id_etat_commande();
			$data['commandes_tarif'] = $this->Commande_Model->get_nb_commande_id_tarif();
			$data['prix_prestation_total'] = $this->Commande_Model->get_sum_prix();

			$data['total_commandes'] = $this->Commande_Model->find_all_commandes();
			$data['clients'] = $this->User_Model->find_all_clients();
			$data['nb_clients'] = $this->User_Model->find_nb_users();

			if( $this->input->post('clients') )
			{
				$this->load->view('admin/client/chart_client' , $data);			
			}
			elseif( $this->input->post('commandes') )
			{
				$this->load->view('admin/admin/home_admin' , $data);				
			}
			elseif( $this->input->post('commandes_tarif') )
			{
				$this->load->view('admin/commande/chart_commande' , $data);				
			}
			else
			{
				$this->load->view('admin/client/chart_client' , $data);
			}
		}
		else
		{
			redirect( site_url("Home/") );
		}
	}


	public function profil()
	{
		if( isset($_SESSION['id_user']) && $_SESSION['id_user_type'] == 1 )
	    	{ 
			$data['title'] = "Profil";

			$data['user'] = $this->User_Model->find_user_by_id($_SESSION['id_user']);
			$this->load->view('admin/admin/profil' , $data);
		}
		else
		{
			redirect( site_url("Home/") );
		}
	}

	public function edit()
	{
		if( isset($_SESSION['id_user']) && $_SESSION['id_user_type'] == 1 )
	    { 
			$data['title'] = "Modification profil";

			$data['user'] = $this->User_Model->find_user_by_id($_SESSION['id_user']);

			$this->form_validation->set_message('required', 'Veuillez remplir %s');
			$this->form_validation->set_message('valid_email', 'Veuillez vérifier %s');


			$this->form_validation->set_rules('nom_user' , 'le nom' , 'required');
			$this->form_validation->set_rules('mail_user' , 'l\' adresse email' , 'required|valid_email');

			if ($this->form_validation->run()) 
			{ 
				$nom_user = $this->input->post('nom_user');
				$mail_user = $this->input->post('mail_user');

				$this->User_Model->update_user( $nom_user , $mail_user , $_SESSION['id_user'] );

	            $this->session->set_flashdata( 'message' , 'Votre profil a été bien modifié' );

				redirect( site_url("Admin/profil") );
			}							
			else
			{
				$this->load->view('admin/admin/edit_admin' , $data);		
			}
		}
		else
		{
			redirect( site_url("Home/") );
		}
	}

//------------------------------------------------------------------------- GESTION COMMANDE -----------------------------------------------------------------------------


	public function update_etat_commande()
	{
		if( isset($_SESSION['id_user']) && $_SESSION['id_user_type'] == 1 )
	    {
	    	$id_commande = $this->input->post('id_commande');
	        $id_etat_commande = $this->input->post('id_etat_commande');

	        $commentaire = $this->input->post('commentaire');

	        $data['user'] = $this->User_Model->find_user_by_id($_SESSION['id_user']);
	        
			$facture = $this->Facture_Model->find_facture_by_id_commande( $id_commande );
			$commande = $this->Commande_Model->find_commande_by_id_commande($id_commande);
			$user = $this->User_Model->find_user_by_id($commande['id_user']);

			// Envoie d' email pour utilisateur

			$email_editeur = 'writingisbae7@gmail.com';
			$nom_editeur = 'Writing is Bae';

			$email_recepteur = $user['mail_user'];
			$nom_recepteur = $user['nom_user'];

			$url = site_url( 'Client/details_commande/'.$id_commande) ;
			$lien = '<a href="'.$url.'">'.$url.'</a><p>Merci</p>';

			if( $id_etat_commande == 2 )
			{
				$this->Commande_Model->update_etat_commande_by_id_commande( $id_commande , $id_etat_commande );

				$objet = 'Votre commande n° '.$id_commande.' est validée';
				$message = '<p>Salut '.$nom_recepteur.'!</p> <p>Votre commande n° '.$id_commande.' est validée.</p><p>'.$nom_editeur.'</p>Cliquer sur le lien ci-dessus pour plus de détails.<br>';
				send_mail( $email_editeur , $nom_editeur , $email_recepteur , $nom_recepteur , $objet , $message.$lien );

				$this->session->set_flashdata( 'message' , 'Cette commande est validée' );
		  	}
			elseif($id_etat_commande == 3 )
			{
				$this->Commande_Model->update_etat_commande_by_id_commande( $id_commande , $id_etat_commande );

				$objet = 'Votre commande n° '.$id_commande.' est en cours de rédaction';
				$message = '<p>Salut '.$nom_recepteur.'!</p> <p>Votre commande n° '.$id_commande.' est en cours de rédaction.</p><p>'.$nom_editeur.'</p>Cliquer sur le lien ci-dessus pour plus de détails.<br>';
				send_mail( $email_editeur , $nom_editeur , $email_recepteur , $nom_recepteur , $objet , $message.$lien );
				
				$this->session->set_flashdata( 'message' , 'Cette commande est en cours de rédaction' );
			}
			elseif($id_etat_commande == 4 )
			{
				if( empty( $_FILES['fichier']['name'] ) || $commentaire == "" )
			  	{		    		
		            $this->session->set_flashdata( 'com_vide' , 'Veuillez bien verifer le commentaire' );
			  	}
			  	else
			  	{
					$this->Commande_Model->update_etat_commande_by_id_commande( $id_commande , $id_etat_commande );
					
			  		$source ="uploads/".$_FILES['fichier']['name'];
		    		move_uploaded_file( $_FILES['fichier']['tmp_name'] , $source );  

		    		// INSERT COMMENTAIRE ET FICHIER 
		     		$this->Commentaire_Model->insert_commentaire( $_SESSION['id_user'] , $id_commande , $commentaire , $_FILES['fichier']['name'] ); 

			  		$objet = 'Votre commande n° '.$id_commande.' est livrée';
					$message = '<p>Salut '.$nom_recepteur.'!</p> <p>Votre commande n° '.$id_commande.' est livrée.</p><p>'.$nom_editeur.'</p>Cliquer sur le lien ci-dessus pour plus de détails.<br>';
					send_mail( $email_editeur , $nom_editeur , $email_recepteur , $nom_recepteur , $objet , $message.$lien );

		            $this->session->set_flashdata( 'message' , 'Cette commande est livrée' );
	        	}				
			}
			elseif($id_etat_commande == 5 )
			{
				$this->Commande_Model->update_etat_commande_by_id_commande( $id_commande , $id_etat_commande );
				$this->Commande_Model->update_prix_prestation( $id_commande );
				$this->Facture_Model->delete_facture_by_id_commande( $id_commande );

				$objet = 'Votre commande n° '.$id_commande.' est échouée';
				$message_motif = $this->input->post('message_motif');
				if ( $message_motif == "" ) 
				{
					$message_motif = 'Votre commande n° '.$id_commande.' est échouée';
					$message = '<p>Salut '.$nom_recepteur.'!</p> <pre>'.$message_motif.'</pre><p>'.$nom_editeur.'</p>Cliquer sur le lien ci-dessus pour plus de détails.<br>';
					send_mail( $email_editeur , $nom_editeur , $email_recepteur , $nom_recepteur , $objet , $message.$lien );
				}
				elseif( $message_motif != "" )
				{					
					$message = '<p>Salut '.$nom_recepteur.'!</p> <pre>Motif: '.$message_motif.'</pre><p>'.$nom_editeur.'</p>Cliquer sur le lien ci-dessus pour plus de détails.<br>';
					send_mail( $email_editeur , $nom_editeur , $email_recepteur , $nom_recepteur , $objet , $message.$lien );
				}
				$this->session->set_flashdata( 'message' , 'Cette commande est échouée' );
			}
			redirect( site_url( 'Admin/details_commande/'.$id_commande ) );
	    }
        else
		{
			redirect( site_url("Home/") );
		}
	}


	public function commandes($page = 1)
	{
		if( isset($_SESSION['id_user']) && $_SESSION['id_user_type'] == 1 )
	    { 
			$data['title'] = "Liste des commandes";

			$data['user'] = $this->User_Model->find_user_by_id($_SESSION['id_user']);

			$commandes = $this->Commande_Model->find_all_commandes();

			$nb_pages = ( count( (array)$commandes ) ) / 5;	
	    	$data['nb_pages'] = intval( $nb_pages ) + 1;

	    	$titre_commande = $this->input->post('titre_commande');	

	    	$date_commande_1 = $this->input->post('date_commande_1');	
	    	$date_commande_2 = $this->input->post('date_commande_2');	
	    	$filtre = $this->input->post('filtre');	
	    	$ordre = $this->input->post('ordre');	

	    	$data['commandes'] = $this->Commande_Model->find_all_commandes_with_pagination( $titre_commande , $date_commande_1 , $date_commande_2 , $page , $filtre , $ordre );

	    	$this->form_validation->set_message('required', 'Veuillez remplir %s');
			$this->form_validation->set_rules('date_commande_1' , 'la date de debut' , 'required');
			if( $this->input->post('afficher') )
			{
				if($this->form_validation->run()) 
				{
					if( $date_commande_2 != "" )
					{
						if( strtotime($date_commande_1) <= strtotime($date_commande_2) )
						{						
							$this->load->view('admin/commande/liste_commandes' , $data);	
						}
						else
						{
							$this->session->set_flashdata( 'date_invalid' , 'Veuillez saisir correctement les dates');
							redirect( site_url("Admin/commandes/") );
						}
					}
					else
					{
						$this->load->view('admin/commande/liste_commandes' , $data);
					}
				}
				else
				{				
					$this->load->view('admin/commande/liste_commandes' , $data);	
				}	
			}
			else
			{
				$this->load->view('admin/commande/liste_commandes' , $data);	
			}
		}
		else
		{
			redirect( site_url("Home/") );
		}
	}



//--------------------- COMMANDE PAR CLIENT ET ETAT ----------------------------------// 

	public function client_commandes( $id_user , $id_etat_commande , $page = 1)
	{
		if( isset($_SESSION['id_user']) && $_SESSION['id_user_type'] == 1 )
	    { 
			$data['title'] = "Commandes";
			$data['user'] = $this->User_Model->find_user_by_id($_SESSION['id_user']);

			$commandes = $this->Commande_Model->get_commande_by_id_user_id_etat_commande( $id_user , $id_etat_commande);	

			$nb_pages = ( count( (array)$commandes ) ) / 5;	
	    	$data['nb_pages'] = intval( $nb_pages ) + 1;

	    	$data['id_user'] = $id_user;
	    	$data['id_etat_commande'] = $id_etat_commande;

	    	$titre_commande = $this->input->post('titre_commande');
	    	$filtre = $this->input->post('filtre');	

			$data['commandes'] = $this->Commande_Model->get_commande_by_id_user_id_etat_commande_with_pagination( $id_user , $id_etat_commande , $titre_commande , $filtre , $page);			

			$etats_commande = $this->Etat_commande_Model->find_etat_commande_by_id_etat_commande( $id_etat_commande );
			$data['titre_etat_commande'] = $etats_commande['etat_commande'] ;

			$this->load->view('admin/commande/commandes_client' , $data);
		}
		else
		{
			redirect( site_url("Home/") );
		}
	}

//--------------------- COMMANDE PAR ETAT----------------------------------// 

	public function etat_commandes( $id_etat_commande , $page = 1)
	{
		if( isset($_SESSION['id_user']) && $_SESSION['id_user_type'] == 1 )
	    { 
			$data['title'] = "Commandes";
			$data['user'] = $this->User_Model->find_user_by_id($_SESSION['id_user']);

			$commandes = $this->Commande_Model->find_all_commandes_by_id_etat( $id_etat_commande );	

			$nb_pages = ( count( (array)$commandes ) ) / 5;	
	    	$data['nb_pages'] = intval( $nb_pages ) + 1;

	    	$titre_commande = $this->input->post('titre_commande');	

	    	$filtre = $this->input->post('filtre');	

			$data['commandes'] = $this->Commande_Model->find_all_commandes_by_id_etat_with_pagination( $id_etat_commande , $titre_commande , $page , $filtre );			
			$data['id_etat_commande'] = $id_etat_commande;
			$data['titre_etat_commande'] = $this->Etat_commande_Model->find_etat_commande_by_id_etat_commande( $id_etat_commande );

			if( count( (array)$data['titre_etat_commande']) > 0 )
			{
				$this->load->view('admin/commande/liste_commandes_par_etat' , $data);
			}
			else
			{
				$data['erreur_message'] = "Cet état de commande n'existe pas";
				$this->load->view('admin/erreur_message' , $data);
			}			
		}
		else
		{
			redirect( site_url("Home/") );
		}
	}



	//--------------------- COMMANDE PAR TARIF----------------------------------// 

	public function tarif_commandes( $id_tarif , $page = 1)
	{
		if( isset($_SESSION['id_user']) && $_SESSION['id_user_type'] == 1 )
	    { 
			$data['title'] = "Commandes";
			$data['user'] = $this->User_Model->find_user_by_id($_SESSION['id_user']);

			$commandes = $this->Commande_Model->find_all_commandes_by_id_tarif( $id_tarif );	

			$nb_pages = ( count( (array)$commandes ) ) / 5;	
	    	$data['nb_pages'] = intval( $nb_pages ) + 1;

	    	$titre_commande = $this->input->post('titre_commande');	

	    	$filtre = $this->input->post('filtre');	
	    	$ordre = $this->input->post('ordre');	

			$data['commandes'] = $this->Commande_Model->find_all_commandes_by_id_tarif_with_pagination( $id_tarif , $titre_commande , $page , $filtre , $ordre);			
			$data['id_tarif'] = $id_tarif;
			$data['titre_tarif'] = $this->Tarif_Model->find_tarif_by_id_tarif($id_tarif);

			if( count( (array)$data['titre_tarif']) > 0 )
			{
				$this->load->view('admin/commande/liste_commandes_par_tarif' , $data);
			}
			else
			{
				$data['erreur_message'] = "Ce type de tarif n'existe pas";
				$this->load->view('admin/erreur_message' , $data);
			}
		}
		else
		{
			redirect( site_url("Home/") );
		}
	}

// ------------------------------- DETAILS COMMANDE -------------------------- //

	public function details_commande($id_commande)
	{
		if( isset($_SESSION['id_user']) && $_SESSION['id_user_type'] == 1 )
	    {	
	    	$data['title'] = "Détails commande";
		    $data['user'] = $this->User_Model->find_user_by_id($_SESSION['id_user']);
		    $data['commentaires'] = $this->Commentaire_Model->find_commentaire_by_id_commande( $id_commande );
	    	$data['facture'] = $this->Facture_Model->find_facture_by_id_commande($id_commande);
	    	$data['details_commande'] = $this->Commande_Model->find_commande_by_id_commande($id_commande);
	    	$data['type_paiement'] = $this->Type_paiement_Model->find_all_type_paiement_active();
			$this->load->view('admin/commande/affichage_commande' , $data);	
		}
		else
		{
			redirect( site_url("Home/") );
		}
	}



// ------------------------------------------------------------------------GESTION FACTURE----------------------------------------------------------------------------------

	public function factures($page = 1)
	{
		if( isset($_SESSION['id_user']) && $_SESSION['id_user_type'] == 1 )
	    { 
			$data['title'] = "Liste des factures";
			$data['user'] = $this->User_Model->find_user_by_id($_SESSION['id_user']);

			$factures = $this->Facture_Model->find_all_factures();

			$nb_pages = ( count( (array)$factures ) ) / 5;	
	    	$data['nb_pages'] = intval( $nb_pages ) + 1;

	    	$filtre = $this->input->post('filtre');
	    	$ordre = $this->input->post('ordre');

	    	$data['factures'] = $this->Facture_Model->find_all_factures_with_pagination( $page , $filtre , $ordre);

			$this->load->view('admin/facture/liste_factures' , $data);
		}
		else
		{
			redirect( site_url("Home/") );
		}
	}


	public function details_facture($id_facture)
	{
		if( isset($_SESSION['id_user']) && $_SESSION['id_user_type'] == 1 )
	    {	
	    	$data['title'] = "Détails facture";
		    $data['user'] = $this->User_Model->find_user_by_id($_SESSION['id_user']);

		    $data['facture']= $this->Facture_Model->find_facture_by_id_facture($id_facture);

		    $data['commande'] = $this->Commande_Model->find_commande_by_id_commande($data['facture']['id_commande']);


		    $this->load->view('admin/facture/details_factures' , $data);
		}
		else
		{
			redirect( site_url("Home/") );
		}
	}


	public function modification_etat_facture( $id_facture )
	{
		if( isset($_SESSION['id_user']) && $_SESSION['id_user_type'] == 1 )
		{
		$this->Facture_Model->update_etat_facture( $id_facture );
		
		$data['user'] = $this->User_Model->find_user_by_id($_SESSION['id_user']);

		$facture = $this->Facture_Model->find_facture_by_id_facture($id_facture);
		$user = $this->User_Model->find_user_by_id( $facture['id_user'] );

		$email_editeur = "writingisbae7@gmail.com";		
		$nom_editeur = "Writing is Bae";

		$email_recepteur = $user['mail_user'];
		$nom_recepteur = $user['nom_user'];

		$objet = "Paiement facture";	

		$message = "<p>Votre facture n° ".$id_facture." est payée.</p>Cliquer sur le lien ci-dessus pour plus de détails.<br>";

		$url = site_url("Client/details_facture/".$id_facture);
		$lien = '<a href="'.$url.'">'.$url.'</a>';

		send_mail( $email_editeur , $nom_editeur , $email_recepteur , $nom_recepteur , $objet , $message.$lien );

		$this->session->set_flashdata( 'message' , 'Cette facture a été payée');
		redirect( site_url("Admin/details_facture/".$id_facture) );
		}
		else
		{
			redirect( site_url("Home/") );
		}
	}


//------------------------------------------------------------------------ GESTION CLIENT--------------------------------------------------------------------------------
	

	public function fidelite_clients( $is_fidele , $page = 1 )
	{
		if( isset($_SESSION['id_user']) && $_SESSION['id_user_type'] == 1 )
	    { 
			$data['title'] = "Liste des clients";
			$data['user'] = $this->User_Model->find_user_by_id($_SESSION['id_user']);

			$users = $this->User_Model->find_all_clients_by_fidele( $is_fidele );

			$nb_pages = ( count( (array)$users ) ) / 5;	
	    	$data['nb_pages'] = intval( $nb_pages ) + 1;

	    	$nom_user = $this->input->post('nom_user');
	    	$data['users'] = $this->User_Model->find_all_clients_by_fidele_with_pagination( $is_fidele , $nom_user , $page );
	    	$data['is_fidele'] = $is_fidele;
	    	$data['title_client'] = $this->User_Model->get_fidelite_user( $is_fidele );

	    	if( count( (array)$data['title_client']) > 0 )
	    	{
				$this->load->view('admin/client/liste_client_par_fidelite' , $data);
	    	}
	    	else
	    	{
	    		$data['erreur_message'] = "Ce type de fidélité n'existe pas";
				$this->load->view('admin/erreur_message' , $data);
	    	}
		}
		else
		{
			redirect( site_url("Home/") );
		}
	}


	public function clients($page = 1)
	{
		if( isset($_SESSION['id_user']) && $_SESSION['id_user_type'] == 1 )
	    { 
			$data['title'] = "Liste des clients";
			$data['user'] = $this->User_Model->find_user_by_id($_SESSION['id_user']);

			$users = $this->User_Model->find_all_users();

			$nb_pages = ( count( (array)$users ) ) / 5;	
	    	$data['nb_pages'] = intval( $nb_pages ) + 1;

	    	$nom_user = $this->input->post('nom_user');
	    	$data['users'] = $this->User_Model->find_all_users_with_pagination( $nom_user , $page );

			$this->load->view('admin/client/liste_clients' , $data);
		}
		else
		{
			redirect( site_url("Home/") );
		}
	}


	public function details_client($id_user)
	{
		if( isset($_SESSION['id_user']) && $_SESSION['id_user_type'] == 1 )
	    { 
			$data['title'] = "Détails client";

			$data['user'] = $this->User_Model->find_user_by_id($_SESSION['id_user']);

			$data['client'] = $this->User_Model->find_user_by_id($id_user);
			$data['nb_commande_user'] = $this->Commande_Model->get_nb_commande_id_user( $id_user );

			$data['user_info'] = $this->Info_user_Model->find_info_user_by_id_user($id_user);
			$data['compte_info'] = count((array)$data['user_info']);

			$this->load->view('admin/client/details_client' , $data);
		}
		else
		{
			redirect( site_url("Home/") );
		}
	}

	public function reduction_client($id_user = "")
	{
		if( isset($_SESSION['id_user']) && $_SESSION['id_user_type'] == 1 )
	    { 
	    	$data['title'] = "Réduction client";

			$data['user'] = $this->User_Model->find_user_by_id($_SESSION['id_user']);
			$data['client'] = $this->User_Model->find_user_by_id($id_user);

			if( $id_user != "" ) 
			{
				$this->load->view('admin/client/edit_reduction' , $data);	
			}
			elseif( $id_user == "" )
			{	
				$this->form_validation->set_message('required', 'Veuillez remplir %s');

				$this->form_validation->set_rules('reduction_fidelite' , 'la réduction' , 'required');

				if ($this->form_validation->run()) 
				{ 
					$id_user = $this->input->post('id_user');
					$reduction_fidelite = $this->input->post('reduction_fidelite');

					$this->User_Model->update_reduction_user($reduction_fidelite , $id_user);

					$this->session->set_flashdata( 'message' , 'Réduction modifiée');
					redirect( site_url("Admin/details_client/".$id_user) );
				}							
				else
				{
					$this->load->view('admin/client/edit_reduction' , $data);		
				}
			}
		}
		else
		{
			redirect( site_url("Home/") );
		}
	}


	public function bannir()
	{
		if( isset($_SESSION['id_user']) && $_SESSION['id_user_type'] == 1 )
		{
			$id_user = $this->input->post('id_user');
			$banni = $this->input->post('banni');
			$motif = $this->input->post('motif');

			$admin = $this->User_Model->find_user_by_id($_SESSION['id_user']);
			$client = $this->User_Model->find_user_by_id($id_user);

			// Envoie d' email pour utilisateur

			$email_editeur = $admin['mail_user'];
			$nom_editeur = $admin['nom_user'];

			$email_recepteur = $client['mail_user'];
			$nom_recepteur = $client['nom_user'];

			$objet = "Compte Writing is Bae";
			if($banni == 0)
			{
				$banni = 1;
				$this->User_Model->update_reduction_user( 0 , $id_user);
				$this->User_Model->update_fidelity_user( $id_user , 0 );
				$this->User_Model->update_accessibility_user( $id_user , $banni );
				if( $motif == "" )
				{
					$message = '<p>Votre compte a été désactivé</p><p>Merci</p>'.$nom_editeur;
				} 
				elseif( $motif != "" )
				{					
					$message = '<p>Votre compte a été désactivé</p><pre>Motif: '.$motif.'</pre><p>Merci</p>'.$nom_editeur;
				}
		  		send_mail( $email_editeur , $nom_editeur , $email_recepteur , $nom_recepteur , $objet , $message );

				$this->session->set_flashdata( 'message' , 'Cet compte a été désactivé');
			}
			elseif($banni == 1)
			{
				$banni = 0;
				$this->User_Model->update_accessibility_user( $id_user , $banni );	

				$message = '<p>Votre compte a été réactivé</p>M<p>Merci</p>'.$nom_editeur;
		  		send_mail( $email_editeur , $nom_editeur , $email_recepteur , $nom_recepteur , $objet , $message );

				$this->session->set_flashdata( 'message' , 'Cet compte a été réactivé');
			}
			redirect( site_url("/Admin/details_client/".$id_user) );	
		}
		else
		{
			redirect( site_url("Home/") );
		}
	}


	public function donner_fidelite( $id_user , $fidele )
	{
		if( isset($_SESSION['id_user']) && $_SESSION['id_user_type'] == 1 )
		{
			$data['user'] = $this->User_Model->find_user_by_id($_SESSION['id_user']);

			if($fidele == 0) 
			{
				$fidele = 1;
				$this->User_Model->update_fidelity_user( $id_user , $fidele );
				$this->session->set_flashdata( 'message' , 'Ce compte a obtenu un badge de fidélité');
			}
			elseif($fidele == 1) {
				$fidele = 0;
				$this->User_Model->update_reduction_user( 0 , $id_user);
				$this->User_Model->update_fidelity_user( $id_user , $fidele );
				$this->session->set_flashdata( 'message' , 'Le badge de fidélité a été retiré de ce compte ');
			}
			redirect( site_url("/Admin/details_client/".$id_user) );
		}
		else
		{
			redirect( site_url("Home/") );
		}
	}


	// ----------------------------------------------------------------------GESTION COMMENTAIRE-------------------------------------------------------------------------
	function commenter()
	{
		if( isset($_SESSION['id_user']) && $_SESSION['id_user_type'] == 1 )
		{
			$data['user'] = $this->User_Model->find_user_by_id($_SESSION['id_user']);

			$id_user = $_SESSION['id_user'];

		  	$id_commande = $this->input->post('id_commande');
		    $commentaire = $this->input->post('commentaire');

		    $commande = $this->Commande_Model->find_commande_by_id_commande( $id_commande );

			// Envoie d' email pour utilisateur

			$email_editeur = 'writingisbae7@gmail.com';
			$nom_editeur = 'Writing is Bae';

			$email_recepteur = $commande['mail_user'];
			$nom_recepteur = $commande['nom_user'];

			$objet = "Nouveau commentaire";
			$message = $nom_editeur." a commenté votre commande n° ".$id_commande.'.<br> Pour plus de détails, veuillez cliquer sur le lien ci-dessous.<br>';

			$url = site_url( "Client/details_commande/".$id_commande);
			$lien = '<a href="'.$url.'">'.$url.'</a>';

		  	// S'il y a un fichier
		  	if( ! empty( $_FILES['fichier']['name'] ) )
		  	{
	    		$source ="uploads/".$_FILES['fichier']['name'];
	    		move_uploaded_file( $_FILES['fichier']['tmp_name'] , $source );  

	    		if( $commentaire == "" )
	    		{
	    			// INSERT FICHIER SEULEMENT	
					$this->Commentaire_Model->insert_commentaire( $id_user , $id_commande , "" , $_FILES['fichier']['name'] ); 
					
		  			send_mail( $email_editeur , $nom_editeur , $email_recepteur , $nom_recepteur , $objet , $message.$lien );
					$this->session->set_flashdata( 'message' , 'Votre commentaire sur cette commande est bien enregistré' );	  			
	    		}
	    		elseif( $commentaire != ""  )
	    		{
	    			// INSERT COMMENTAIRE ET FICHIER 
	     			$this->Commentaire_Model->insert_commentaire( $id_user , $id_commande , $commentaire , $_FILES['fichier']['name'] ); 
	     			
		  			send_mail( $email_editeur , $nom_editeur , $email_recepteur , $nom_recepteur , $objet , $message.$lien );
	     			$this->session->set_flashdata( 'message' , 'Votre commentaire sur cette commande est bien enregistré' );	  			
	    		}
		
		  	}
		  	// si non
		  	elseif( empty( $_FILES['fichier']['name'] ) )
		  	{
		  		if( $commentaire != ""  )
		  		{
		  			$this->Commentaire_Model->insert_commentaire( $id_user , $id_commande , $commentaire , "" ); 

		  			send_mail( $email_editeur , $nom_editeur , $email_recepteur , $nom_recepteur , $objet , $message.$lien );
		  			$this->session->set_flashdata( 'message' , 'Votre commentaire sur cette commande est bien enregistré' );	  			
		  		}
		  		elseif(   $commentaire == ""  )
		  		{
		  			redirect( site_url("Admin/details_commande/".$id_commande) );
		  		}
		  	}
		  	redirect( site_url("Admin/details_commande/".$id_commande) );
		}
		else
		{
			redirect( site_url("Home/") );
		}
	}


	function effacer_commentaire($id_commentaire , $id_commande)
	{
		if( isset($_SESSION['id_user']) && $_SESSION['id_user_type'] == 1 )
		{
			$data['user'] = $this->User_Model->find_user_by_id($_SESSION['id_user']);

			$this->Commentaire_Model->delete_commentaire_by_id_commande( $id_commentaire );

			$this->session->set_flashdata( 'message' , 'Le commentaire a été supprimé' );	
			redirect( site_url("Admin/details_commande/".$id_commande) );
		}
		else
		{
			redirect( site_url("Home/") );
		}
	}


	function modification_commentaire( $id_commentaire = "" )
	{
		if( isset($_SESSION['id_user']) && $_SESSION['id_user_type'] == 1 )
	    { 
			$data['title'] = "Modification commentaire";
			$data['user'] = $this->User_Model->find_user_by_id($_SESSION['id_user']);

			if( $id_commentaire != "" )
			{
				$data['commentaire'] = $this->Commentaire_Model->find_commentaire_by_id_commentaire( $id_commentaire );
				$this->load->view('admin/commentaire/modification_commentaire' , $data);	
			}	
			elseif( $id_commentaire == "" ) 
			{
				$id_commentaire = $this->input->post('id_commentaire');
				$id_commande = $this->input->post('id_commande');	
				$commentaire = $this->input->post('commentaire');		  		

				$this->form_validation->set_message('required', 'Veuillez remplir %s');

			  	$this->form_validation->set_rules('commentaire' , 'le commentaire' , 'required');
				
				if ($this->form_validation->run()) 
				{
					$this->Commentaire_Model->update_commentaire($commentaire , $id_commentaire );

				  	$this->session->set_flashdata( 'message' , 'Le commentaire a été bien modifié' );	
					redirect( site_url("Admin/details_commande/".$id_commande) );
				}
				else
				{							    
					redirect( site_url("Admin/modification_commentaire".$id_commande) );	
				}
			}
		}
		else
		{
			redirect( site_url("Home/") );
		}	
	}

	// ----------------------------------------------------------------------- GESTION TARIF-------------------------------------------------------------------------
	
	function details_tarif( $id_tarif )
	{
		if( isset($_SESSION['id_user']) && $_SESSION['id_user_type'] == 1 )
	    {
	    	$data['title'] = "Tarif";
			$data['user'] = $this->User_Model->find_user_by_id($_SESSION['id_user']);

	    	$data['tarif'] = $this->Tarif_Model->find_tarif_by_id_tarif($id_tarif);
	    	$this->load->view('admin/tarif/details_tarif' , $data);
	    }
		else
		{
			redirect( site_url("Home/") );
		} 
	}


	function tarifs($page = 1)
	{
		if( isset($_SESSION['id_user']) && $_SESSION['id_user_type'] == 1 )
	    { 
			$data['title'] = "Liste des tarifs";
			$data['user'] = $this->User_Model->find_user_by_id($_SESSION['id_user']);

			$tarifs = $this->Tarif_Model->find_all_tarif();
			$nb_pages = ( count( (array)$tarifs ) ) / 5;	


			$type_text = $this->input->post('type_text');

	    	$data['nb_pages'] = intval( $nb_pages ) + 1;
	    	$data['page'] = $page;
	    	$data['tarifs'] = $this->Tarif_Model->find_all_tarif_pagination( $page  , $type_text);

			$this->load->view('admin/tarif/liste_tarifs' , $data);
		}
		else
		{
			redirect( site_url("Home/") );
		}
	}


	function insertion_tarif()
	{
		if( isset($_SESSION['id_user']) && $_SESSION['id_user_type'] == 1 )
	    { 
			$data['title'] = "Nouveau tarif";
			$data['user'] = $this->User_Model->find_user_by_id($_SESSION['id_user']);

			$type_redacteur = $this->input->post('type_redacteur');
			$type_text = $this->input->post('type_text');
			$prix_par_mot = $this->input->post('prix_par_mot');

			$this->form_validation->set_message('required', 'Veuillez remplir %s');

			$this->form_validation->set_rules('type_redacteur' , 'le type de rédacteur' , 'required');
			$this->form_validation->set_rules('type_text' , 'le type de texte' , 'required');
			$this->form_validation->set_rules('prix_par_mot' , 'le prix par mot' , 'required');

			if ($this->form_validation->run()) 
			{ 
				$this->Tarif_Model->insert_tarif($type_redacteur , $type_text , $prix_par_mot);

				$this->session->set_flashdata( 'message' , 'Le tarif a été bien enregistré' );
				redirect( site_url("Admin/tarifs") );
			}							
			else
			{
				$this->load->view('admin/tarif/insertion_tarif' , $data);	
			}			
		}
		else
		{
			
		}
	}


	function activation_tarif( $active , $id_tarif )
	{
		if( isset($_SESSION['id_user']) && $_SESSION['id_user_type'] == 1 )
		{
			$data['user'] = $this->User_Model->find_user_by_id($_SESSION['id_user']);

			if( $active == 0 )
			{
				$active = 1 ;
				$this->Tarif_Model->update_activation_tarif($active , $id_tarif);

				$this->session->set_flashdata( 'message' , 'Ce tarif a été réactivé' );
			}	
			elseif( $active == 1 )
			{
				$active = 0 ;
				$this->Tarif_Model->update_activation_tarif($active , $id_tarif);

				$this->session->set_flashdata( 'message' , 'Ce tarif a été désactivé' );
			}
			redirect( site_url("Admin/details_tarif/".$id_tarif) );
		}
		else
		{
			redirect( site_url("Home/") );
		}
	}


	function modification_tarif( $id_tarif = "")
	{
		if( isset($_SESSION['id_user'])  && $_SESSION['id_user_type'] == 1 )
	    { 
	    	$data['user'] = $this->User_Model->find_user_by_id($_SESSION['id_user']);

			if( $id_tarif != "" )
			{
				$data['title'] = "Modification tarif";
				$data['tarif'] = $this->Tarif_Model->find_tarif_by_id_tarif($id_tarif);
				$this->load->view('admin/tarif/modification_tarif' , $data);	
			}
			elseif( $id_tarif == "" )
			{
				$id_tarif = $this->input->post( 'id_tarif' );

				$type_redacteur = $this->input->post( 'type_redacteur' );
				$type_text = $this->input->post( 'type_text' );
				$prix_par_mot = $this->input->post( 'prix_par_mot' );

				$this->form_validation->set_message('required', 'Veuillez remplir %s');

				$this->form_validation->set_rules('type_redacteur' , 'le type de rédacteur' , 'required');
				$this->form_validation->set_rules('type_text' , 'le type de texte' , 'required');
				$this->form_validation->set_rules('prix_par_mot' , 'le prix par mot' , 'required');

				if ($this->form_validation->run()) 
				{ 
					$this->Tarif_Model->update_tarif($type_redacteur , $type_text , $prix_par_mot ,  $id_tarif);

					$this->session->set_flashdata('message' , 'Ce tarif a été bien modifié');
					redirect( site_url("Admin/details_tarif/".$id_tarif ) );
				}							
				else
				{
					redirect( site_url("Admin/modification_tarif/".$id_tarif) );
				}
			}
		}
		else
		{
			redirect( site_url("Home/") );
		}
	}

	// --------------------------------------------------------------------GESTION PROMOTION-----------------------------------------------------------------------
	
	function promotions( $page = 1 )
	{
		if(isset($_SESSION['id_user'])  && $_SESSION['id_user_type'] == 1 )
	    {
	    	$data['title'] = "Liste des promotions";
			$data['user'] = $this->User_Model->find_user_by_id($_SESSION['id_user']);	
			
			$promotions= $this->Promotion_Model->find_all_promo();

			$nb_pages = ( count( (array)$promotions ) ) / 5;	
	    	$data['nb_pages'] = intval( $nb_pages ) + 1;

	    	$code_promo = $this->input->post('code_promo');
			$data['promotions'] = $this->Promotion_Model->find_all_promo_with_pagination( $page , $code_promo );
			$data['page'] = $page;

			$data['promotions_activees'] = $this->Promotion_Model->find_all_promo_activee();
			$this->load->view('admin/promotion/liste_promotions' , $data);
		}
		else
		{
			redirect( site_url("Home/") );
		}
	}


	function details_promotion( $id_promotion )
	{
		if(isset($_SESSION['id_user'])  && $_SESSION['id_user_type'] == 1 )
	    {
	    	$data['title'] = "Liste des promotions";
			$data['user'] = $this->User_Model->find_user_by_id($_SESSION['id_user']);	
			
			
			$data['promotion'] = $this->Promotion_Model->find_promo_by_id_promo( $id_promotion );
			
			$this->load->view('admin/promotion/details_promotion' , $data);
		}
		else
		{
			redirect( site_url("Home/") );
		}
	}


	function insertion_promotion()
	{
		if(isset($_SESSION['id_user'])  && $_SESSION['id_user_type'] == 1 )
	    { 
			$data['title'] = "Nouvelle promotion";
			$data['user'] = $this->User_Model->find_user_by_id($_SESSION['id_user']);

			$code_promo = $this->input->post('code_promo');
			$desc_promo = $this->input->post('desc_promo');
			$reduction = $this->input->post('reduction');

			$this->form_validation->set_message('required', 'Veuillez remplir %s');

			$this->form_validation->set_rules('code_promo' , 'le code Promo' , 'required');
			$this->form_validation->set_rules('desc_promo' , 'la description' , 'required');
			$this->form_validation->set_rules('reduction' , 'la réduction' , 'required');

			if ($this->form_validation->run()) 
			{ 
				$this->Promotion_Model->insert_promotion($code_promo , $desc_promo , $reduction);

				$this->session->set_flashdata('message' , 'La promotion a été bien enregistrée');
				redirect( site_url("Admin/promotions") );
			}							
			else
			{
				$this->load->view('admin/promotion/insertion_promotion' , $data);	
			}			
		}
		else
		{
			redirect( site_url("Home/") );
		}
	}


	function modification_promotion( $id_promotion = "" )
	{
		if(isset($_SESSION['id_user'])  && $_SESSION['id_user_type'] == 1 )
	    { 
			$data['title'] = "Nouvelle promotion";
			$data['user'] = $this->User_Model->find_user_by_id($_SESSION['id_user']);

			if( $id_promotion != "" )
			{
				$data['promotion'] = $this->Promotion_Model->find_promo_by_id_promo( $id_promotion );
				$this->load->view('admin/promotion/modification_promotion' , $data);	
			}
			elseif( $id_promotion == "" )
			{
				$id_promotion = $this->input->post('id_promotion');
				$code_promo = $this->input->post('code_promo');
				$desc_promo = $this->input->post('desc_promo');
				$reduction = $this->input->post('reduction');

				$this->form_validation->set_message('required', 'Veuillez remplir %s');
				
				$this->form_validation->set_rules('code_promo' , 'le code Promo' , 'required');
				$this->form_validation->set_rules('desc_promo' , 'la description' , 'required');
				$this->form_validation->set_rules('reduction' , 'la réduction' , 'required');

				if ($this->form_validation->run()) 
				{ 
					$this->Promotion_Model->upadte_promotion($code_promo , $desc_promo , $reduction , $id_promotion).

					$this->session->set_flashdata('message' , 'La promotion a été bien modifiée');
					redirect( site_url("Admin/details_promotion/".$id_promotion) );
				}							
				else
				{
					redirect( site_url("Admin/modification_promotion/".$id_promotion) );
				}	
			}
		}
		else
		{
			redirect( site_url("Home/") );
		}
	}

	function activation_promotion( $activee , $id_promotion )
	{
		if(isset($_SESSION['id_user'])  && $_SESSION['id_user_type'] == 1 )
		{
			$data['user'] = $this->User_Model->find_user_by_id($_SESSION['id_user']);

			if ($activee == 0) 
			{
				$activee = 1;
				$this->Promotion_Model->update_activation_promotion( $activee , $id_promotion );

				$this->session->set_flashdata('message' , 'La promotion a été réactivée');
			}
			elseif ($activee == 1) 
			{
				$activee = 0;
				$this->Promotion_Model->update_activation_promotion( $activee , $id_promotion );

				$this->session->set_flashdata('message' , 'La promotion a été désactivée');
			}
			redirect( site_url("Admin/details_promotion/".$id_promotion) );
		}
		else
		{
			redirect( site_url("Home/") );
		}
	}


	// -----------------------------------------------------------------------GESTION LANGUE---------------------------------------------------------------------------

	function langues( $page = 1 )
	{
		if(isset($_SESSION['id_user'])  && $_SESSION['id_user_type'] == 1 )
	    { 
			$data['title'] = "Liste des langues";
			$data['user'] = $this->User_Model->find_user_by_id($_SESSION['id_user']);

			$langues = $this->Langue_text_Model->find_all_langues();

			$nb_pages = ( count( (array)$langues ) ) / 5;

			$langue_text = $this->input->post('langue_text');

			$data['nb_pages'] = intval( $nb_pages ) + 1;
			$data['langues'] = $this->Langue_text_Model->find_all_langue_text_with_pagination( $langue_text , $page );
			$data['page'] = $page;

			$this->load->view('admin/langue/liste_langues' , $data);	
		}
		else
		{
			redirect( site_url("Home/") );
		}
	}


	function insertion_langue()
	{
		if(isset($_SESSION['id_user'])  && $_SESSION['id_user_type'] == 1 )
	    { 
			$data['title'] = "Nouvelle langue";
			$data['user'] = $this->User_Model->find_user_by_id($_SESSION['id_user']);

			$langue_text = $this->input->post('langue_text');

			$this->form_validation->set_message('required', 'Veuillez remplir %s');

			$this->form_validation->set_rules('langue_text' , 'la langue' , 'required');

			if ($this->form_validation->run()) 
			{ 
				$this->Langue_text_Model->insert_langue($langue_text);

				$this->session->set_flashdata('message' , 'La langue a été bien enregistrée');
				redirect( site_url("Admin/langues") );
			}							
			else
			{
				$this->load->view('admin/langue/insertion_langue' , $data);
			}	
		}
		else
		{
			redirect( site_url("Home/") );
		}	
	}


	function modification_langue( $id_langue_text = "" )
	{
		if(isset($_SESSION['id_user'])  && $_SESSION['id_user_type'] == 1 )
	    { 
			$data['title'] = "Modification langue";
			$data['user'] = $this->User_Model->find_user_by_id($_SESSION['id_user']);

			if( $id_langue_text != "" )
			{
				$data['langue'] = $this->Langue_text_Model->find_all_langue_text_id_langue_text( $id_langue_text );
				$this->load->view('admin/langue/modification_langue' , $data);
			}
			elseif( $id_langue_text == "" )
			{
				$langue_text = $this->input->post('langue_text');
				$id_langue_text = $this->input->post('id_langue_text');

				$this->form_validation->set_message('required', 'Veuillez remplir %s');

				$this->form_validation->set_rules('langue_text' , 'la langue' , 'required');

				if ($this->form_validation->run()) 
				{ 
					$this->Langue_text_Model->update_langue($id_langue_text , $langue_text);

					$this->session->set_flashdata('message' , 'La langue a été bien modifiée');
					redirect( site_url("Admin/langues"));
				}							
				else
				{
					redirect( site_url("Admin/modification_langue/".$id_langue_text));
				}	
			}
		}
		else
		{
			redirect( site_url("Home/") );
		}	
	}

	function activation_langue( $id_langue_text , $activee , $page)
	{
		if(isset($_SESSION['id_user'])  && $_SESSION['id_user_type'] == 1 )
		{
			$data['user'] = $this->User_Model->find_user_by_id($_SESSION['id_user']);

			if( $activee == 1 )
			{
				$activee = 0;
				$this->Langue_text_Model->update_activation_langue($id_langue_text , $activee);

				$this->session->set_flashdata('message' , 'Cette langue a été désactivée');
			}	
			elseif( $activee == 0 )
			{
				$activee = 1;
				$this->Langue_text_Model->update_activation_langue($id_langue_text , $activee);

				$this->session->set_flashdata('message' , 'Cette langue a été réactivée');
			}
			redirect(site_url("Admin/langues/".$page));
		}
		else
		{
			redirect( site_url("Home/") );
		}
	}


// --------------------------------------------------------------GESTION TYPE DE PAIEMENT----------------------------------------------------------------------------

	function paiements( $page = 1 )
	{
		if(isset($_SESSION['id_user'])  && $_SESSION['id_user_type'] == 1 )
	    { 
	    	$data['title'] = "Type de paiements";
			$data['user'] = $this->User_Model->find_user_by_id($_SESSION['id_user']);

			$type_paiements = $this->Type_paiement_Model->find_all_type_paiement();
			$nb_pages = ( count( (array)$type_paiements ) ) / 5;

			$type_paiement = $this->input->post('type_paiement');

			$data['type_paiements'] = $this->Type_paiement_Model->find_all_type_paiement_with_pagination( $type_paiement , $page );
			$data['nb_pages'] = intval( $nb_pages ) + 1;

			$this->load->view('admin/type_paiement/paiements' , $data);
		}
		else
		{
			redirect( site_url("Home/") );
		}	
	}

	function insertion_type_de_paiement()
	{
		if(isset($_SESSION['id_user'])  && $_SESSION['id_user_type'] == 1 )
	    { 
	    	$data['title'] = "Ajout type de paiement";
			$data['user'] = $this->User_Model->find_user_by_id($_SESSION['id_user']);

			$type_paiement = $this->input->post('type_paiement');
			$desc_type_paiement = $this->input->post('desc_type_paiement');

			$this->form_validation->set_message('required', 'Veuillez remplir %s');

			$this->form_validation->set_rules('type_paiement' , 'le type de paiement' , 'required');
			$this->form_validation->set_rules('desc_type_paiement' , 'la description' , 'required');

			if ($this->form_validation->run()) 
			{ 
				$this->Type_paiement_Model->insert_type_paiement($type_paiement , $desc_type_paiement);

				$this->session->set_flashdata('message' , 'Le type de paiement a été bien enregistré');
				redirect( site_url("Admin/paiements"));
			}							
			else
			{
				$this->load->view('admin/type_paiement/insertion_type_paiement' , $data);
			}				
		}
		else
		{
			redirect( site_url("Home/") );
		}	
	}

	function paiement($id_type_paiement = "")
	{
		if(isset($_SESSION['id_user'])  && $_SESSION['id_user_type'] == 1 )
	    { 
	    	$data['title'] = "Type de paiement";
			$data['user'] = $this->User_Model->find_user_by_id($_SESSION['id_user']);
			
			$data['paiement'] = $this->Type_paiement_Model->find_type_paiement_by_id( $id_type_paiement );
			$this->load->view( 'admin/type_paiement/details_type_paiement' , $data );
		}
		else
		{
			redirect( site_url("Home/") );
		}
	}


	function modification_type_paiement($id_type_paiement = "")
	{
		if(isset($_SESSION['id_user'])  && $_SESSION['id_user_type'] == 1 )
	    { 
	    	$data['title'] = "Modification type de paiement";
			$data['user'] = $this->User_Model->find_user_by_id($_SESSION['id_user']);

			if( $id_type_paiement != "" )
			{
				$data['paiement'] = $this->Type_paiement_Model->find_type_paiement_by_id( $id_type_paiement );
				$this->load->view( 'admin/type_paiement/modification_type_paiement' , $data );
			}
			elseif( $id_type_paiement == "" ) 
			{
				$id_type_paiement = $this->input->post('id_type_paiement');
				$type_paiement = $this->input->post('type_paiement');
				$desc_type_paiement = $this->input->post('desc_type_paiement');

				$this->form_validation->set_message('required', 'Veuillez remplir %s');

				$this->form_validation->set_rules('type_paiement' , 'le type de paiement' , 'required');
				$this->form_validation->set_rules('desc_type_paiement' , 'la description' , 'required');

				if ($this->form_validation->run()) 
				{ 
					$this->Type_paiement_Model->update_type_paiement($type_paiement , $desc_type_paiement , $id_type_paiement);

					$this->session->set_flashdata('message' , 'Le type de paiement a été bien modifié');

					redirect( site_url( "Admin/paiement/".$id_type_paiement ));
				}							
				else
				{
					redirect( site_url( "Admin/modification_type_paiement/".$id_type_paiement ));
				}
			}
		}
		else
		{
			redirect( site_url("Home/") );
		}
	}

	function activation_type_paiement( $id_type_paiement , $active )
	{
		if(isset($_SESSION['id_user'])  && $_SESSION['id_user_type'] == 1 )
		{
			$data['user'] = $this->User_Model->find_user_by_id($_SESSION['id_user']);

			if($active == 1)
			{
				$active = 2;
				$this->Type_paiement_Model->update_activation_type_paiement( $id_type_paiement , $active );

				$this->session->set_flashdata('message' , 'Ce type de paiement a été désactivé');
			}	
			elseif($active == 2)
			{
				$active = 1;
				$this->Type_paiement_Model->update_activation_type_paiement( $id_type_paiement , $active );	

				$this->session->set_flashdata('message' , 'Ce type de paiement a été réactivé');
			}	
			redirect( site_url( "Admin/paiement/".$id_type_paiement ));		
		}
		else
		{
			redirect( site_url("Home/") );
		}
	}
}
