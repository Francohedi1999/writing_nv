<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->helper('captcha','url','form');
// 		$this->load->helper('sendmail');
		$this->load->library('form_validation');
		$this->load->library('pagination');
		$this->load->model('User_Model');
		$this->load->model('Pays_Model');
		$this->load->model('Info_user_Model');
		$this->load->model('Langue_text_Model');
		$this->load->model('Tarif_Model');
		$this->load->model('Commande_Model');
		$this->load->model('Promotion_Model');
		$this->load->model('Etat_commande_Model');
		$this->load->model('Type_paiement_Model');
		$this->load->model('Facture_Model');
		$this->load->model('Commentaire_Model');

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
	
	// ------------------------------------------------------------------------------PROFIL CLIENT---------------------------------------------------------------------------
	public function index()
	{
		if( isset( $_SESSION['id_user'])  && $_SESSION['id_user_type'] == 2 )
	    { 
			$data['title'] = "Espace client";

			$data['user'] = $this->User_Model->find_user_by_id($_SESSION['id_user']);
			
			$data['commandes'] = $this->Commande_Model->get_nb_commande_id_user( $_SESSION['id_user'] );
			$data['all_commandes'] = $this->Commande_Model->find_all_commandes_by_id_user( $_SESSION['id_user'] );

			$this->load->view('client/client/home_client' , $data);
		}
		else
		{
			redirect( site_url("Home/") );
		}
	}


	public function profil()
	{
		if( isset( $_SESSION['id_user'])  && $_SESSION['id_user_type'] == 2 )
	    { 
			$data['title'] = "Profil";

			$data['user'] = $this->User_Model->find_user_by_id($_SESSION['id_user']);
			$data['user_info'] = $this->Info_user_Model->find_info_user_by_id_user($_SESSION['id_user']);

			$data['compte_info'] = count((array)$data['user_info']);

			$this->load->view('client/client/profil' , $data);
		}
		else
		{
			redirect( site_url("Home/") );
		}
	}

	public function edit()
	{
		if( isset( $_SESSION['id_user'])  && $_SESSION['id_user_type'] == 2 )
	    { 
			$data['title'] = "Modification profil";
			
			$data['pays'] = $this->Pays_Model->find_all_pays();
			$data['user'] = $this->User_Model->find_user_by_id($_SESSION['id_user']);
			$data['info_user'] = $this->Info_user_Model->find_info_user_by_id_user($_SESSION['id_user']);

			$data['compte_info'] = count( (array)$data['info_user'] );


			$this->form_validation->set_message('required', 'Veuillez remplir %s');
			$this->form_validation->set_message('valid_email', 'Veuillez vérifier %s');

			$this->form_validation->set_rules('nom_user' , 'le nom' , 'required');
			$this->form_validation->set_rules('mail_user' , 'l\' adresse email' , 'required|valid_email');
			$this->form_validation->set_rules('id_pays' , 'le pays' , 'required');

			if ($this->form_validation->run()) 
			{ 
				$id_user = $_SESSION['id_user'];

				$nom_user = $this->input->post('nom_user');
				$mail_user = $this->input->post('mail_user');				

				if( $data['user']['mail_user'] == $mail_user )
				{
					$this->User_Model->update_user($nom_user , $mail_user , $id_user);

					$nom_entreprise = $this->input->post('nom_entreprise');
					$adresse = $this->input->post('adresse');
					$id_pays = $this->input->post('id_pays');
					$ville = $this->input->post('ville');
					$region = $this->input->post('region');
					$num_TVA = $this->input->post('num_TVA');
					$code_postal = $this->input->post('code_postal');
					

					$info_user = $this->Info_user_Model->find_info_user_by_id_user($id_user);

					if( count((array)$info_user) > 0 )
					{			
						$this->Info_user_Model->update_info_user($nom_entreprise , $adresse , $id_pays , $ville , $region , $num_TVA , $code_postal , $id_user);
					}
					elseif( count((array)$info_user) == 0)
					{
						$this->Info_user_Model->insert_info_user($nom_entreprise , $adresse , $id_pays , $ville , $region , $num_TVA , $code_postal , $id_user);
					}

					$this->session->set_flashdata( 'message' , 'Votre profil a été bien modifié');
					redirect( site_url("Client/profil") );	
				}
				elseif( $data['user']['mail_user'] != $mail_user ) 
				{
					$user_modif = $this->User_Model->find_user_by_mail($mail_user);

					if( count((array)$user_modif) > 0 )
					{
						$this->session->set_flashdata( 'message' , 'L\' adresse email existe déjà');
						redirect( site_url("Client/edit") );	
					}
					elseif( count((array)$user_modif) == 0 ) 
					{
						$this->User_Model->update_user($nom_user , $mail_user , $id_user);

						$nom_entreprise = $this->input->post('nom_entreprise');
						$adresse = $this->input->post('adresse');
						$id_pays = $this->input->post('id_pays');
						$ville = $this->input->post('ville');
						$region = $this->input->post('region');
						$num_TVA = $this->input->post('num_TVA');
						$code_postal = $this->input->post('code_postal');
						

						$info_user = $this->Info_user_Model->find_info_user_by_id_user($id_user);

						if( count((array)$info_user) > 0 )
						{			
							$this->Info_user_Model->update_info_user($nom_entreprise , $adresse , $id_pays , $ville , $region , $num_TVA , $code_postal , $id_user);
						}
						elseif( count((array)$info_user) == 0)
						{
							$this->Info_user_Model->insert_info_user($nom_entreprise , $adresse , $id_pays , $ville , $region , $num_TVA , $code_postal , $id_user);
						}

						$this->session->set_flashdata( 'message' , 'Votre profil a été bien modifié');
						redirect( site_url("Client/profil") );	
					}
				}				
			}							
			else
			{
				$this->load->view('client/client/edit_client' , $data);		
			}
		}
		else
		{
			redirect( site_url("Home/") );
		}
	}



	//---------------------------------------------------------------------- COMMANDE CLIENT----------------------------------------------------------------------------------

	public function annuler_commande( $id_commande )
	{
		if( isset( $_SESSION['id_user'] )  && $_SESSION['id_user_type'] == 2 )
	    { 
			$this->Commande_Model->cancel_commande( $id_commande );
			$this->Facture_Model->delete_facture_by_id_commande( $id_commande );

			$client = $this->User_Model->find_user_by_id( $_SESSION['id_user'] );
			$email_editeur = $client['mail_user'] ;
			$nom_editeur = $client['nom_user'] ;
			
			$email_recepteur = "writingisbae7@gmail.com" ;
			$nom_recepteur = "Writing is Bae" ;
			
			$objet = "Annulation commande du client n° ".$client['id_user'] ;

			$message = '<p>'.$nom_editeur.' a annulé sa commande n° '.$id_commande.'.</p>
						<br>
						<p><b>'.$nom_editeur.'</b></p>';

			// send_mail( $email_editeur , $nom_editeur , $email_recepteur , $nom_recepteur , $objet , $message );

			$this->session->set_flashdata( "message" , "Cette commande est bien annulée" );
			redirect( site_url("Client/details_commande/".$id_commande) );
		}
		else
		{
			redirect( site_url("Home/") );
		}
	}

	public function commande()
	{
		if( isset( $_SESSION['id_user'] )  && $_SESSION['id_user_type'] == 2 )
	    { 
			$data['title'] = "Nouveau commande";

			$data['pays'] = $this->Pays_Model->find_all_pays();
			$data['tarifs'] = $this->Tarif_Model->find_all_tarif_active();
			$data['langues_text'] = $this->Langue_text_Model->find_all_langue_text();
			$data['type_paiement'] = $this->Type_paiement_Model->find_all_type_paiement_active();

			$data['user'] = $this->User_Model->find_user_by_id($_SESSION['id_user']);			
			$data['info_user'] = $this->Info_user_Model->find_info_user_by_id_user($_SESSION['id_user']);

			$data['compte_info'] = count((array)$data['info_user']);

			$this->form_validation->set_message( 'greater_than_equal_to', 'Le nombre de mot doit être supérieur à 100' );
			$this->form_validation->set_message('required', 'Veuillez remplir %s');
			$this->form_validation->set_message('integer', 'La valeur doit être un entier');

			$this->form_validation->set_rules('nb_mot' , 'le nombre de mot' , 'required|integer|greater_than_equal_to[100]');
			$this->form_validation->set_rules('mot_cle' , 'le mot clé' , 'required');
			$this->form_validation->set_rules('titre_commande' , 'le titre' , 'required');

			if ($this->form_validation->run()) 
			{ 
				if( strpos( $this->input->post('id_tarif') , "|" ) == true )
				{
					$tarif = explode( "|" , $this->input->post('id_tarif') );

					$id_tarif = $tarif[0];

					$id_langue_text = $this->input->post('id_langue_text');

					$id_user = $_SESSION['id_user'] ;
					$client = $this->User_Model->find_user_by_id($id_user);

					$nb_mot = $this->input->post('nb_mot');
					$mot_cle = $this->input->post('mot_cle');
					$titre_commande = $this->input->post('titre_commande');
					$remarque = $this->input->post('remarque');
					$nom_user = $client['nom_user'];
					$nom_entreprise = $this->input->post('nom_entreprise');
					$adresse = $this->input->post('adresse');
					$nom_pays = $this->input->post('nom_pays');
					$ville = $this->input->post('ville');
					$region = $this->input->post('region');
					$code_postal = $this->input->post('code_postal');
					$num_TVA = $this->input->post('num_TVA');
					$id_type_paiement = $this->input->post('id_type_paiement');
					$code_promo = $this->input->post('code_promo');
								
					$prix = $this->Tarif_Model->find_tarif_by_id_tarif( $id_tarif );

					if( count((array)$prix) > 0 )
					{
						$prix_prestation = $prix['prix_par_mot'] * $nb_mot ;		

						if( $code_promo != "" )
						{
							$promotion = $this->Promotion_Model->find_promo_by_code_promo($code_promo);
							
							if(count( (array)$promotion ) > 0)
							{
								$this->Commande_Model->insert_commande(	$id_tarif,
																		$id_langue_text,
																		$nb_mot,
																		$mot_cle,
																		$titre_commande,
																		$remarque,
																		$nom_user,
																		$nom_entreprise,
																		$adresse,
																		$nom_pays,
																		$ville,
																		$region,
																		$code_postal,
																		$num_TVA,
																		$code_promo,
																		$promotion['reduction'],
																		$client['reduction_fidelite'],
																		$prix_prestation,
																		$id_type_paiement,
																		$id_user,
																		$client['is_fidele']);
								redirect( site_url("Client/details_commande") );	
							}
							elseif(count( (array)$promotion ) == 0)
							{
								$data['code_promo_error'] = "Le code promo est invalide";
								$this->load->view('client/commande/commande' , $data);	
							}	
						}
						elseif( $code_promo == "" )
						{
							$code_promo = "" ;
							$reduction_promo = 0 ;
							$this->Commande_Model->insert_commande(	$id_tarif,
																	$id_langue_text,
																	$nb_mot,
																	$mot_cle,
																	$titre_commande,
																	$remarque,
																	$nom_user,
																	$nom_entreprise,
																	$adresse,
																	$nom_pays,
																	$ville,
																	$region,
																	$code_postal,
																	$num_TVA,
																	$code_promo,
																	$reduction_promo,
																	$client['reduction_fidelite'],
																	$prix_prestation,
																	$id_type_paiement,
																	$id_user,
																	$client['is_fidele'] );
							redirect( site_url("Client/details_commande") );						
						}
					}
					else
					{
						$this->session->set_flashdata( "message_erreur" , "Veuillez remplir correctement les champs" );
						redirect( site_url("Client/commande") );
					}					
				}
				else
				{
					$this->session->set_flashdata( "message_erreur" , "Veuillez remplir correctement les champs" );
					redirect( site_url("Client/commande") );
				}
			}							
			else
			{
				$this->load->view('client/commande/commande' , $data);	
			}
		}
		else
		{
			redirect( site_url("Home/") );
		}
	}

	public function validation_commande()
	{	
		if( isset( $_SESSION['id_user'])  && $_SESSION['id_user_type'] == 2 )
		{
			$data['user'] = $this->User_Model->find_user_by_id($_SESSION['id_user']);

			$id_user = $_SESSION['id_user'];
			$id_commande = $this->input->post('id_commande');

			// Mail pour nouvelle commande 

			$client = $this->User_Model->find_user_by_id( $id_user );
			$email_editeur = $client['mail_user'] ;
			$nom_editeur = $client['nom_user'] ;

			$email_recepteur = "writingisbae7@gmail.com" ;
			$nom_recepteur = "Writing is Bae" ;

			$objet = "Nouvelle commande du client n° ".$client['id_user'] ;

			$message = '<p>'.$nom_editeur.' a effectué une nouvelle commande.</p>
						<br>
						<p><b>Client n° '.$client['id_user'].'</b></p>';

			$facture = $this->Facture_Model->find_all_factures_by_id_commande( $id_commande );
			$commande = $this->Commande_Model->find_commande_by_id_commande($id_commande);

			if( $this->input->post('valider') )
			{
				$this->Commande_Model->update_commande_to_uneditable($id_commande);

				if( count( (array)$facture ) > 0 )
				{
					$this->session->set_flashdata( 'message' , 'Votre commande est déjà enregistrée');
				}
				elseif( count( (array)$facture ) == 0 )
				{
					if( $commande['id_etat_commande'] == 6 )
					{
						$this->session->set_flashdata( 'message_annulee' , 'Votre commande est déjà annulée');
					}
					else
					{
						$this->Facture_Model->insert_facture( $id_user , $id_commande );

						// send_mail( $email_editeur , $nom_editeur , $email_recepteur , $nom_recepteur , $objet , $message );

						$this->session->set_flashdata( 'message' , 'Votre commande est bien enregistrée');
					}					
				}	
			}
			elseif( $this->input->post('modifier') )
			{
				if( $commande['modifiable'] == 0 )
				{
					$this->session->set_flashdata( 'message' , 'Votre commande est déjà enregistrée');
				}
				elseif( $commande['modifiable'] == 1 ) 
				{
					redirect( site_url("Client/modification_commande") );
				}
			}
			elseif( $this->input->post('annuler') )
			{	
				$this->Commande_Model->cancel_commande( $id_commande );
				$this->Facture_Model->delete_facture_by_id_commande( $id_commande );
				$this->session->set_flashdata( 'message_annulee' , 'Votre commande est annulée');
				redirect( site_url("Client/commande") );
			}
			redirect( site_url("Client/commandes") );
		}
		else
		{
			redirect( site_url("Home/") );
		}
		
	}


	public function details_commande($id_commande = "")
	{
		if( isset( $_SESSION['id_user'])  && $_SESSION['id_user_type'] == 2 )
	    {	
	    	$data['title'] = "Détails";
		    $data['user'] = $this->User_Model->find_user_by_id($_SESSION['id_user']);

	    	if( $id_commande == "" )
	    	{
		    	$data['details_commande'] = $this->Commande_Model->find_last_command_by_id_user($_SESSION['id_user']);
		    	$data['promotion'] = $this->Promotion_Model->find_promo_by_code_promo( $data['details_commande']['code_promo'] );
		    	$data['tarif'] = $this->Tarif_Model->find_tarif_by_id_tarif( $data['details_commande']['id_tarif'] );
				$this->load->view('client/commande/details_commande' , $data);
	    	}
	    	elseif( $id_commande != "" ) 
	    	{
	    		$data['details_commande'] = $this->Commande_Model->find_commande_by_id_commande($id_commande);
	    		$facture = $this->Facture_Model->find_facture_by_id_commande( $id_commande );
	    		if( count( (array)$data['details_commande'] ) > 0 )
	    		{
	    			if( $data['details_commande']['id_user'] == $_SESSION['id_user'] )
		    		{				
			    		$data['commentaires'] = $this->Commentaire_Model->find_commentaire_by_id_commande( $id_commande );
				    	$data['facture'] = $this->Facture_Model->find_facture_by_id_commande($id_commande);
						$this->load->view('client/commande/affichage_commande' , $data);
						
		    		}
		    		elseif( $data['details_commande']['id_user'] != $_SESSION['id_user'] )
		    		{
		    			$data['erreur_message'] = " Vous n'avez pas accès à cette commande ";
		    			$this->load->view('client/erreur_message' , $data);
		    		}
	    		}
	    		elseif( $data['details_commande'] == 0 )
	    		{
	    			$data['erreur_message'] = " Cette commande n'existe pas ";
		    		$this->load->view('client/erreur_message' , $data);
	    		}
	    	}
		}
		else
		{
			redirect( site_url("Home/") );
		}
	}


	


	public function commandes($page = 1)
	{
		if( isset( $_SESSION['id_user'])  && $_SESSION['id_user_type'] == 2 )
	    {	
	    	$data['title'] = "Mes commandes";
	    	$data['user'] = $this->User_Model->find_user_by_id($_SESSION['id_user']);

	    	$commandes = $this->Commande_Model->find_all_commandes_by_id_user($_SESSION['id_user']);

	    	
	    	$nb_pages = count( (array)$commandes ) / 5;	
	    	$data['nb_pages'] = intval( $nb_pages ) + 1; 	

	    	$date_commande_1 = $this->input->post('date_commande_1');
	    	$date_commande_2 = $this->input->post('date_commande_2');
	    	$filtre = $this->input->post('filtre');
	    	$ordre = $this->input->post('ordre');

			$titre_commande = $this->input->post('titre_commande');			
			$data['commandes'] = $this->Commande_Model->find_all_commandes_by_id_user_with_pagination($_SESSION['id_user'] , 
				$titre_commande ,
				$date_commande_1 ,
				$date_commande_2 ,
				$page ,
				$filtre ,
				$ordre);

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
							$this->load->view('client/commande/liste_commandes' , $data);	
						}
						else
						{
							$this->session->set_flashdata( 'date_invalid' , 'Veuillez saisir correctement les dates');
							redirect( site_url("Client/commandes/") );
						}
					}
					else
					{
						$this->load->view('client/commande/liste_commandes' , $data);
					}
				}
				else
				{				
					$this->load->view('client/commande/liste_commandes' , $data);	
				}	
			}
			else
			{
				$this->load->view('client/commande/liste_commandes' , $data);	
			}	
		}
		else
		{
			redirect( site_url("Home/") );
		}
	}


	public function modification_commande()
	{
		if( isset( $_SESSION['id_user'])  && $_SESSION['id_user_type'] == 2 )
	    {	

	    	$data['title'] = "Modification";
	    	$data['user'] = $this->User_Model->find_user_by_id($_SESSION['id_user']);

	    	$data['pays'] = $this->Pays_Model->find_all_pays();
	    	$data['tarifs'] = $this->Tarif_Model->find_all_tarif_active();
			$data['langues_text'] = $this->Langue_text_Model->find_all_langue_text();
			$data['type_paiement'] = $this->Type_paiement_Model->find_all_type_paiement_active();

	    	$data['details_commande'] = $this->Commande_Model->find_last_command_by_id_user($_SESSION['id_user']);

	    	$this->form_validation->set_message( 'greater_than_equal_to', 'Le nombre de mot doit être supérieur à 100' );
			$this->form_validation->set_message('required', 'Veuillez remplir %s');
			$this->form_validation->set_message('integer', 'La valeur doit être un entier');

			$this->form_validation->set_rules('nb_mot' , 'le nombre de mot' , 'required|integer|greater_than_equal_to[100]');
			$this->form_validation->set_rules('mot_cle' , 'le mot clé' , 'required');
			$this->form_validation->set_rules('titre_commande' , 'le titre' , 'required');

			if ($this->form_validation->run()) 
			{
				if( strpos( $this->input->post('id_tarif') , "|" ) == true )
				{
					$tarif = explode( "|" , $this->input->post('id_tarif') );	

					$id_tarif = $tarif[0];

					$id_commande = $this->input->post('id_commande'); 

					$commande = $this->Commande_Model->find_commande_by_id_commande( $id_commande );

					$id_user = $_SESSION['id_user']; 
					$client = $this->User_Model->find_user_by_id( $id_user );

					$id_langue_text = $this->input->post('id_langue_text');
					$nb_mot = $this->input->post('nb_mot');
					$mot_cle = $this->input->post('mot_cle');
					$titre_commande = $this->input->post('titre_commande');
					$remarque = $this->input->post('remarque');
					$nom_user = $client['nom_user'];
					$nom_entreprise = $this->input->post('nom_entreprise');
					$adresse = $this->input->post('adresse');
					$nom_pays = $this->input->post('nom_pays');
					$ville = $this->input->post('ville');
					$region = $this->input->post('region');
					$code_postal = $this->input->post('code_postal');
					$num_TVA = $this->input->post('num_TVA');
					$id_type_paiement = $this->input->post('id_type_paiement');

					$code_promo = $this->input->post('code_promo');
					
					$modifiable = $commande['modifiable'];

					// Mail pour nouvelle commande 

					$email_editeur = $client['mail_user'] ;
					$nom_editeur = $client['nom_user'] ;

					$email_recepteur = "writingisbae7@gmail.com" ;
					$nom_recepteur = "Writing is Bae" ;

					$objet = "Nouvelle commande du client n° ".$client['id_user'] ;

					$message = '<p>'.$nom_editeur.' a effectué une nouvelle commande.</p>
								<br>
								<p><b>Client n° '.$client['id_user'].'</b></p>';

					$prix = $this->Tarif_Model->find_tarif_by_id_tarif( $id_tarif );

					if(  count((array)$prix) > 0  )
					{
						$prix_prestation = $prix['prix_par_mot'] * $nb_mot ;

						if( $modifiable == 1 )
						{
							if( $code_promo != "" )
							{
								$promotion = $this->Promotion_Model->find_promo_by_code_promo($code_promo);
								
								if(count( (array)$promotion ) > 0)
								{	
									$this->Commande_Model->update_commande_by_id_commande($id_tarif,
																								$id_langue_text,
																								$nb_mot,
																								$mot_cle,
																								$titre_commande,
																								$remarque,
																								$nom_user,
																								$nom_entreprise,
																								$adresse,
																								$nom_pays,
																								$ville,
																								$region,
																								$code_postal,
																								$num_TVA,
																								$code_promo,
																								$promotion['reduction'],
																								$client['reduction_fidelite'],
																								$prix_prestation,
																								$id_type_paiement,
																								$id_user,
																								$id_commande,
																								$client['is_fidele']);
									$this->Facture_Model->insert_facture( $id_user , $id_commande );

									// send_mail( $email_editeur , $nom_editeur , $email_recepteur , $nom_recepteur , $objet , $message );

									$this->session->set_flashdata( 'message' , 'Votre commande est bien enregistrée');
									redirect( site_url("Client/commandes") );	
								}
								elseif(count( (array)$promotion ) == 0)
								{
									$data['code_promo_error'] = "Le code promo est invalide";
									$this->load->view('client/commande/edit_commande' , $data);	
								}	
							}
							elseif( $code_promo == "" )
							{
								$code_promo = "";
								$reduction_promo = 0 ;
								
								$this->Commande_Model->update_commande_by_id_commande($id_tarif,
																							$id_langue_text,
																							$nb_mot,
																							$mot_cle,
																							$titre_commande,
																							$remarque,
																							$nom_user,
																							$nom_entreprise,
																							$adresse,
																							$nom_pays,
																							$ville,
																							$region,
																							$code_postal,
																							$num_TVA,
																							$code_promo,
																							$reduction_promo,
																							$client['reduction_fidelite'],
																							$prix_prestation,
																							$id_type_paiement,
																							$id_user,
																							$id_commande,
																							$client['is_fidele']);
								$this->Facture_Model->insert_facture( $id_user , $id_commande );

								// send_mail( $email_editeur , $nom_editeur , $email_recepteur , $nom_recepteur , $objet , $message );

								$this->session->set_flashdata( 'message' , 'Votre commande est bien enregistrée');
								redirect( site_url("Client/commandes") );	
							}
						}
						elseif( $modifiable == 0 )
						{
							$data['error_commande'] = "Cette commande est déjà enregistrée";
							$this->load->view('client/commande/edit_commande' , $data);
						}
					}
					else
					{
						$this->session->set_flashdata( "message_erreur" , "Veuillez remplir correctement les champs" );
						redirect( site_url("Client/modification_commande") );
					}					
				}
				else
				{
					$this->session->set_flashdata( "message_erreur" , "Veuillez remplir correctement les champs" );
					redirect( site_url("Client/modification_commande") );
				}
			}
			else
			{
				$this->load->view('client/commande/edit_commande' , $data);
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
			if( isset($_SESSION['id_user']) && $_SESSION['id_user_type'] == 2 )
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
				

				if ( count((array)$etats_commande ) > 0 && $id_user == $_SESSION['id_user'] ) 
				{
					$data['titre_etat_commande'] = $etats_commande['etat_commande'] ;
					$this->load->view('client/commande/commandes_client' , $data);
				}
				elseif( count((array)$etats_commande ) == 0 )
				{
					$data['erreur_message'] = "Ces commandes n'existe pas";
			   		$this->load->view('client/erreur_message' , $data);
				}
				elseif( $id_user != $_SESSION['id_user'] )
				{
					$data['erreur_message'] = "Vous n'avez pas accès à ces commandes";
			   		$this->load->view('client/erreur_message' , $data);
				}				
			}
			else
			{
				redirect( site_url("Home/") );
			}
		}


	// ------------------------------------------------------------------------------FACTURE CLIENT--------------------------------------------------------------------------
	public function factures($page = 1)
	{
		if( isset( $_SESSION['id_user'])  && $_SESSION['id_user_type'] == 2 )
	    {	
	    	$data['title'] = "Mes factures";    
	    	$data['user'] = $this->User_Model->find_user_by_id($_SESSION['id_user']);
	    	$factures = $this->Facture_Model->find_all_factures_by_id_user( $_SESSION['id_user'] );	

	    	$nb_pages = ( count( (array)$factures ) ) / 5;	
	    	$data['nb_pages'] = intval( $nb_pages ) + 1; 

	    	$filtre = $this->input->post('filtre');
	    	$ordre = $this->input->post('ordre');

	    	$data['factures'] = $this->Facture_Model->find_all_factures_by_id_user_with_pagination( $_SESSION['id_user'] , $page , $filtre , $ordre);	
			$this->load->view('client/facture/liste_factures' , $data);
		}
		else
		{
			redirect( site_url("Home/") );
		}
	}

	public function details_facture($id_facture = "")
	{
		if( isset( $_SESSION['id_user'])  && $_SESSION['id_user_type'] == 2 )
	    {	
	    	$data['title'] = "Détails";
		    $data['user'] = $this->User_Model->find_user_by_id($_SESSION['id_user']);

		    if( $id_facture != "" )
		    {	
		        $data['facture']= $this->Facture_Model->find_facture_by_id_facture($id_facture);
		    
		        if( $data['facture'] > 0 )
		       	{
		       		if( $data['facture']['id_user'] == $_SESSION['id_user'] )
		    	    {
		    	    	$data['commande'] = $this->Commande_Model->find_commande_by_id_commande($data['facture']['id_commande']);
		    
		    		    $data['promotion'] = $this->Promotion_Model->find_promo_by_code_promo($data['commande']['code_promo']);
		    
		    		    $this->load->view('client/facture/details_factures' , $data);
		    	    } 
		    	    elseif( $data['facture']['id_user'] !=  $_SESSION['id_user'] )
		    	    {
		    	    	$data['erreur_message'] = "Vous n'avez pas accès à cette facture";
		    	    	$this->load->view('client/erreur_message' , $data);
		    	    }	
		       	} 
		       	elseif( $data['facture'] == 0 )
		    	{
		    	  	$data['erreur_message'] = "Cette facture n'existe pas";
		    	   	$this->load->view('client/erreur_message' , $data);
		    	}
		    }
		    elseif( $id_facture == "" )
		    {
		    	$data['erreur_message'] = "Cette facture n'existe pas";
		    	$this->load->view('client/erreur_message' , $data);
		    }
		}
		else
		{
			redirect( site_url("Home/") );
		}
	}

	//---------------------------------------------------------------------COMMENTAIRE-----------------------------------------------------------------------------------
	public function commenter()
	{ 
		if( isset( $_SESSION['id_user'])  && $_SESSION['id_user_type'] == 2 )
		{
			$id_user = $_SESSION['id_user'];
		  	$id_commande = $this->input->post('id_commande');
		    $commentaire = $this->input->post('commentaire');

		    $client = $this->User_Model->find_user_by_id( $id_user );
			$email_editeur = $client['mail_user'] ;
			$nom_editeur = $client['nom_user'] ;

			$email_recepteur = "writingisbae7@gmail.com" ;
			$nom_recepteur = "Writing is Bae" ;

			$objet = "Nouveau commentaire du client n° ".$client['id_user'] ;

			$message = '<p>'.$nom_editeur." a commenté sa commande n° ".$id_commande.'.<p>
						<br>
						<p><b>Client n°'.$client['id_user'].'</b></p>';
		    
		  	// S'il y a un fichier 
		  	if( ! empty( $_FILES['fichier']['name'] ) )
		  	{	   
	    		$source ="uploads/".$_FILES['fichier']['name'];
	    		move_uploaded_file( $_FILES['fichier']['tmp_name'] , $source );  
	    		if( $commentaire == "" )
	    		{
	    			// INSERT FICHIER SEULEMENT	
					$this->Commentaire_Model->insert_commentaire( $id_user , $id_commande , "" , $_FILES['fichier']['name'] ); 				
	    		}
	    		elseif( $commentaire != ""  )
	    		{
	    			// INSERT COMMENTAIRE ET FICHIER 
	     			$this->Commentaire_Model->insert_commentaire( $id_user , $id_commande , $commentaire , $_FILES['fichier']['name'] );     			
	    		}
	    		// send_mail( $email_editeur , $nom_editeur , $email_recepteur , $nom_recepteur , $objet , $message );
	    		$this->session->set_flashdata( 'message' , 'Votre commentaire sur cette commande est bien enregistré');
		  	}
		  	// si non
		  	elseif( empty( $_FILES['fichier']['name'] ) )
		  	{
		  		if( $commentaire != "" )
		  		{
		  			// INSERT COMMENTAIRE ET FICHIER 
		  			$this->Commentaire_Model->insert_commentaire( $id_user , $id_commande , $commentaire , "" ); 

		  			// send_mail( $email_editeur , $nom_editeur , $email_recepteur , $nom_recepteur , $objet , $message );

	    			$this->session->set_flashdata( 'message' , 'Votre commentaire sur cette commande est bien enregistré');
		  		}
		  		elseif( $commentaire == "" )
		  		{
		  			redirect( site_url("Client/details_commande/".$id_commande) );
		  		}
		  	}
		  	redirect( site_url("Client/details_commande/".$id_commande) );
		}
		else
	 	{
	 		redirect( site_url("Home/") );
	 	}
	}


	public function effacer_commentaire($id_commentaire , $id_commande)
	{
		$data['user'] = $this->User_Model->find_user_by_id($_SESSION['id_user']);

		if( isset( $_SESSION['id_user'])  && $_SESSION['id_user_type'] == 2 )
		{
			$this->Commentaire_Model->delete_commentaire_by_id_commande( $id_commentaire );

			$this->session->set_flashdata( 'message' , 'Le commentaire a été supprimé');
		  	redirect( site_url("Client/details_commande/".$id_commande) );
		}
		else
		{
			redirect( site_url("Home/") );
		}
	}


	public function modification_commentaire( $id_commentaire = "" )
	{
		if( isset( $_SESSION['id_user'])  && $_SESSION['id_user_type'] == 2 )
	    { 
			$data['title'] = "Modification commentaire";
			$data['user'] = $this->User_Model->find_user_by_id($_SESSION['id_user']);

			if( $id_commentaire != "" )
			{
				$data['commentaire'] = $this->Commentaire_Model->find_commentaire_by_id_commentaire( $id_commentaire );
				$this->load->view('client/commentaire/modification_commentaire' , $data);	
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
				  	
				  	$this->session->set_flashdata( 'message' , 'Le commentaire a été bien modifié');
	  				redirect( site_url("Client/details_commande/".$id_commande) );	
				}
				else
				{
					redirect( site_url("Client/modification_commentaire/".$id_commande) );	
				}
			}
		}
		else
		{
			redirect( site_url("Home/") );
		}	
	}
}
