<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->helper('captcha');
		$this->load->helper('email');
		$this->load->library('form_validation');
		$this->load->model('User_Model');
		$this->load->model('Commentaire_Model');
		$this->load->model('User_type_Model');
		$this->load->model('Tarif_Model');
		$this->load->model('Type_redacteur_Model');
		$this->load->model('Type_paiement_Model');
		$this->load->model('Langue_text_Model');
		$this->load->model('Langue_text_Model');
		$this->load->model('Pays_Model');
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
	
	
	public function index()
	{	
		$data['title'] = "Se connecter";

		$this->form_validation->set_message('required', 'Veuillez remplir %s');

		$this->form_validation->set_rules('mail_user' , 'l\' adresse email' , 'required');
		$this->form_validation->set_rules('mdp_user' , 'le mot de passe' , 'required');

		if ($this->form_validation->run()) 
		{ 
			$mail_user = $this->input->post('mail_user');
			$mdp_user = $this->input->post('mdp_user');

			$user = $this->User_Model->find_user_by_mail_mdp($mail_user , $mdp_user);

			if ( count( (array)$user ) > 0 )
			{
				if($user['banni'] == 0)
				{
					// ADMIN
					if($user['id_user_type'] == 1)
					{
						$_SESSION['id_user'] = $user['id_user'];
						$_SESSION['id_user_type'] = $user['id_user_type'];

						redirect( site_url("Admin/") );
					}
					// CLIENT
					elseif($user['id_user_type'] == 2)
					{
						$_SESSION['id_user'] = $user['id_user'];
						$_SESSION['id_user_type'] = $user['id_user_type'];
						redirect( site_url("Client/") );
					}
				}
				elseif($user['banni'] == 1)
				{
					$data['error_log'] = "Ce compte est désactivé";
					$this->load->view('connexion' , $data);
				}
			}
			elseif ( count( (array)$user ) == 0 )
			{
				$data['error_log'] = "Adresse email ou mot de passe invalide";
				$this->load->view('connexion' , $data);
			}
		}							
		else
		{
			$this->load->view('connexion' , $data);			
		}
	}
	

	public function logout()
	{
		header("location:".site_url("Home/"));	
		session_destroy();		
	}


	public function register_client()
	{
		$data['title'] = "S' inscrire en tant que client";
		$data['user_type'] = $this->User_type_Model->find_all_user_type();

		$vals = array(
		        // 'word'          => 'Random word',
		        'img_path'      => './captcha-images/',
		        'img_url'       => base_url().'captcha-images/',
		        'font_path'     => './path/to/fonts/texb.ttf',
		        'img_width'     => 189,
		        'img_height'    => 30,
		        'expiration'    => 7200,
		        'word_length'   => 6,
		        'font_size'     => 50,
		        'img_id'        => 'Imageid',
		        'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',

		        // White background and border, black text and red grid
		        'colors'        => array(
		                'background' => array(255, 255, 255),
		                'border' => array(255, 255, 255),
		                'text' => array(0, 0, 0),
		                'grid' => array(255, 155, 55)
		        )
		);

		$cap = create_captcha($vals);

		$data['captcha_image'] = $cap['image'];
		$data['captcha_word'] = $cap['word'];

		$data['pays'] = $this->Pays_Model->find_all_pays();


		$nom_user = $this->input->post('nom_user');
		$nom_plume = $this->input->post('nom_plume');
		$pseudo_user = $this->input->post('pseudo_user');
		$mail_user = $this->input->post('mail_user');
		$mdp_user = $this->input->post('mdp_user');
		$mdp_user_c = $this->input->post('mdp_user_c');
		$captch_word = $this->input->post('captch_word');
		$captcha = $this->input->post('captcha');
		$id_langue_text = "";							
		$id_type_redacteur = "";
		$bio = $this->input->post('bio');
		$domaine_predilection = $this->input->post('domaine_predilection');
		$tel_user = $this->input->post('tel_user');
		$whatsapp_user = $this->input->post('whatsapp_user');
		$skype_user = $this->input->post('skype_user');

		$id_pays = $this->input->post('id_pays');
		$ville = $this->input->post('ville');
		$region = $this->input->post('region');
		$adresse = $this->input->post('adresse');

		$nom_entreprise = $this->input->post('nom_entreprise'); 
		$num_eng_fiscal = $this->input->post('num_eng_fiscal');

		$this->form_validation->set_message('required', 'Veuillez remplir %s');
		$this->form_validation->set_message('min_length', '%s doit comporter 8 à 12 caractères');
		$this->form_validation->set_message('max_length', '%s doit comporter 8 à 12 caractères');
		$this->form_validation->set_message('matches', 'La confirmation de mot de passe est incorrecte');

		$this->form_validation->set_rules('nom_user' , 'le nom' , 'required');
		$this->form_validation->set_rules('mail_user' , 'l\' adresse email' , 'required');
		$this->form_validation->set_rules('nom_entreprise' , 'le nom de la société' , 'required');
		$this->form_validation->set_rules('num_eng_fiscal' , 'le numéro d\'enregistrement fiscal' , 'required');
		$this->form_validation->set_rules('bio' , 'le bio' , 'required');
		$this->form_validation->set_rules('domaine_predilection' , 'le domaine de prédilection' , 'required');
		$this->form_validation->set_rules('tel_user' , 'le numéro de téléphone' , 'required');
		
		$this->form_validation->set_rules('id_pays' , 'le pays' , 'required|integer');
		$this->form_validation->set_rules('ville' , 'la ville' , 'required');
		$this->form_validation->set_rules('region' , 'la région' , 'required');
		$this->form_validation->set_rules('adresse' , 'l\'adresse' , 'required');

		$this->form_validation->set_rules('mdp_user' , 'Le mot de passe' , 'required|min_length[8]|max_length[12]');
		$this->form_validation->set_rules('mdp_user_c' , 'la confirmation de mot de passe' , 'required|matches[mdp_user]');

		$this->form_validation->set_rules('captcha' , 'le captcha' , 'required');

		if ($this->form_validation->run()) 
		{ 

			$user = $this->User_Model->find_user_by_mail($mail_user);
				
			if($captch_word == $captcha)
			{
		 		if( count((array)$user) > 0 )
		 		{
		 			$data['error_mail'] = "Cette adresse email possède déjà un compte"; 
		 			$this->load->view('home/client/inscription' , $data);
		 		}	
		 		elseif( count((array)$user) == 0 )
		 		{
		 			$this->User_Model->insert_user( 
		 											2,	
		 											$nom_user,
													$nom_entreprise,
													$num_eng_fiscal,
													$mdp_user,
													$id_pays,
													$adresse,
													$ville,
													$region,
													$pseudo_user,
													$nom_plume,
													$bio,
													$domaine_predilection,
													$id_langue_text,
													$mail_user,
													$tel_user,
													$whatsapp_user,
													$skype_user,
													$id_type_redacteur );

		 			$this->session->set_flashdata('message' , 'Inscription réussie');
		 			redirect( site_url('Home') );
		 		}			
			}
			elseif($captch_word != $captcha)
			{	
				$data['message_error'] = "Captcha invalide";	
				$this->load->view('home/client/inscription' , $data);			
			}
		}
		else
		{
			$this->load->view('home/client/inscription' , $data);
		}
	}

	public function register_redacteur()
	{
		$data['title'] = "S' inscrire en tant que rédacteur";
		$data['user_type'] = $this->User_type_Model->find_all_user_type();

		$vals = array(
		        // 'word'          => 'Random word',
		        'img_path'      => './captcha-images/',
		        'img_url'       => base_url().'captcha-images/',
		        'font_path'     => './path/to/fonts/texb.ttf',
		        'img_width'     => 189,
		        'img_height'    => 30,
		        'expiration'    => 7200,
		        'word_length'   => 6,
		        'font_size'     => 50,
		        'img_id'        => 'Imageid',
		        'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',

		        // White background and border, black text and red grid
		        'colors'        => array(
		                'background' => array(255, 255, 255),
		                'border' => array(255, 255, 255),
		                'text' => array(0, 0, 0),
		                'grid' => array(255, 155, 55)
		        )
		);

		$cap = create_captcha($vals);

		$data['captcha_image'] = $cap['image'];
		$data['captcha_word'] = $cap['word'];

		$data['types_redacteur'] = $this->Type_redacteur_Model->find_all_type_redacteur();
		$data['langues_text'] = $this->Langue_text_Model->find_all_langue_text();
		$data['pays'] = $this->Pays_Model->find_all_pays();

		$nom_user = $this->input->post('nom_user');
		$nom_plume = $this->input->post('nom_plume');
		$pseudo_user = $this->input->post('pseudo_user');
		$mail_user = $this->input->post('mail_user');
		$mdp_user = $this->input->post('mdp_user');
		$mdp_user_c = $this->input->post('mdp_user_c');
		$captch_word = $this->input->post('captch_word');
		$captcha = $this->input->post('captcha');
		$id_langue_text = $this->input->post('id_langue_text');							
		$id_type_redacteur = $this->input->post('id_type_redacteur');
		$bio = $this->input->post('bio');
		$domaine_predilection = $this->input->post('domaine_predilection');
		$tel_user = $this->input->post('tel_user');
		$whatsapp_user = $this->input->post('whatsapp_user');
		$skype_user = $this->input->post('skype_user');

		$id_pays = $this->input->post('id_pays');
		$ville = $this->input->post('ville');
		$region = $this->input->post('region');
		$adresse = $this->input->post('adresse');

		$nom_entreprise = "";
		$num_eng_fiscal = "";

		$this->form_validation->set_message('required', 'Veuillez remplir %s');
		$this->form_validation->set_message('integer', 'Veuillez remplir bien %s');
		$this->form_validation->set_message('min_length', '%s doit comporter 8 à 12 caractères');
		$this->form_validation->set_message('max_length', '%s doit comporter 8 à 12 caractères');
		$this->form_validation->set_message('matches', 'La confirmation de mot de passe est incorrecte');

		$this->form_validation->set_rules('nom_user' , 'le nom' , 'required');
		$this->form_validation->set_rules('mail_user' , 'l\' adresse email' , 'required');
		$this->form_validation->set_rules('id_langue_text' , 'la langue de rédaction' , 'required|integer');
		$this->form_validation->set_rules('id_type_redacteur' , 'le type de rédacteur' , 'required|integer');
		$this->form_validation->set_rules('bio' , 'le bio' , 'required');
		$this->form_validation->set_rules('domaine_predilection' , 'le domaine de prédilection' , 'required');
		$this->form_validation->set_rules('tel_user' , 'le numéro de téléphone' , 'required');

		$this->form_validation->set_rules('id_pays' , 'le pays' , 'required|integer');
		$this->form_validation->set_rules('ville' , 'la ville' , 'required');
		$this->form_validation->set_rules('region' , 'la région' , 'required');
		$this->form_validation->set_rules('adresse' , 'l\'adresse' , 'required');

		$this->form_validation->set_rules('mdp_user' , 'Le mot de passe' , 'required|min_length[8]|max_length[12]');
		$this->form_validation->set_rules('mdp_user_c' , 'la confirmation de mot de passe' , 'required|matches[mdp_user]');

		$this->form_validation->set_rules('captcha' , 'le captcha' , 'required');

		if ($this->form_validation->run()) 
		{ 

			$user = $this->User_Model->find_user_by_mail($mail_user);
				
			if($captch_word == $captcha)
			{
		 		if( count((array)$user) > 0 )
		 		{
		 			$data['error_mail'] = "Cette adresse email possède déjà un compte"; 
		 			$this->load->view('home/redacteur/inscription' , $data);
		 		}	
		 		elseif( count((array)$user) == 0 )
		 		{
		 			$this->User_Model->insert_user( 
		 											3,	
		 											$nom_user,
													$nom_entreprise,
													$num_eng_fiscal,
													$mdp_user,
													$id_pays,
													$adresse,
													$ville,
													$region,
													$pseudo_user,
													$nom_plume,
													$bio,
													$domaine_predilection,
													$id_langue_text,
													$mail_user,
													$tel_user,
													$whatsapp_user,
													$skype_user,
													$id_type_redacteur );

		 			$this->session->set_flashdata('message' , 'Inscription réussie');
		 			redirect( site_url('Home') );
		 		}			
			}
			elseif($captch_word != $captcha)
			{	
				$data['message_error'] = "Captcha invalide";	
				$this->load->view('home/redacteur/inscription' , $data);			
			}
		}
		else
		{
			$this->load->view('home/redacteur/inscription' , $data);
		}
	}


	public function identifier()
	{
		$data['title'] = "Saisie identifiant";
		$this->form_validation->set_message('required', 'Veuillez remplir %s');

		$this->form_validation->set_rules('mail_user' , 'l\' adresse email' , 'required');

		if ($this->form_validation->run()) 
		{ 			
			$mail_user = $this->input->post('mail_user');

			$user = $this->User_Model->find_user_by_mail($mail_user);

			if( count((array)$user) > 0 )
			{
				if( $user['id_user_type'] == 2 )
				{
					$this->User_Model->update_date_reset_password($user['id_user']);

					$email_editeur = 'admin@writingisbae.com';
					$nom_editeur = 'Writing is Bae';

					$email_recepteur = $user['mail_user'];
					$nom_recepteur = $user['nom_user'];

					$objet = 'Réinitialisation mot de passe'; 
					$message = '<p>Salut '.$user['nom_user'].'!</p> <p>Pour réinitialiser votre mot de passe, veuillez cliquer sur le lien ci-dessous</p>';

					$url = site_url( "Home/reset_password/".$user['id_user'] );

					$lien = '<a href="'.$url.'">'.$url.'</a><p>Merci</p> <p>'.$nom_editeur.'</p>';

					send_mail( $email_editeur , $nom_editeur , $email_recepteur , $nom_recepteur , $objet , $message.$lien );
					$this->session->set_flashdata( 'message' , 'Veuillez vérifier votre email' );

					redirect( site_url( "Home/identifier" ) );
				}
				else
				{
					$this->session->set_flashdata( 'email_erreur' , 'Vous ne pouvez pas modifié le mot de passe de ce compte' );
					redirect( site_url( "Home/identifier" ) );
				}
			}
			else
			{
				$this->session->set_flashdata( 'email_erreur' , 'L\' adresse ne possède pas de compte' );
				redirect( site_url( "Home/identifier" ) );
			}
		}
		else
		{
			$this->load->view( "identifier" , $data );
		}
	}


	public function reset_password( $id_user = "" )
	{
		$data['title'] = "Saisie nouveau mot de passe";

		if( $id_user != "" )
		{
			$data['user_'] = $this->User_Model->find_user_by_id($id_user);

			if( count( (array)$data['user_'] ) > 0 )
			{
				$date_lrp = new DateTime( $data['user_']['date_reset_password'] );
				$date_lrp->add(new DateInterval('PT00H10M00S'));

				$date_limite = strtotime( $date_lrp->format("Y-m-d h:i:s") );
				$date_actuelle = strtotime( date("Y-m-d h:i:s" , time()) );

				if ( $date_limite > $date_actuelle ) 
				{
					$this->load->view( "reset_password" , $data );
				}
				elseif ( $date_limite < $date_actuelle || $date_limite == $date_actuelle )
				{
					$this->session->set_flashdata( 'email_erreur' , 'Vous avez dépassé plus de 10 minutes. Veuillez rééssayer à nouveau' );
					redirect( site_url( "Home/identifier" ) );
				}				
			}
			else
			{
				$this->session->set_flashdata( 'email_erreur' , 'Veuillez rééssayer à nouveau' );
				redirect( site_url( "Home/identifier" ) );
			}			
		}
		elseif( $id_user == "" ) 
		{
			$this->form_validation->set_message('required', 'Veuillez remplir %s');
			$this->form_validation->set_message('min_length', '%s doit comporter 8 à 12 caractères');
			$this->form_validation->set_message('max_length', '%s doit comporter 8 à 12 caractères');
			$this->form_validation->set_message('matches', 'La confirmation de mot de passe est incorrecte');

			$this->form_validation->set_rules('mdp_user' , 'Le mot de passe' , 'required|min_length[8]|max_length[12]');
			$this->form_validation->set_rules('mdp_user_c' , 'la confirmation de mot de passe' , 'required|matches[mdp_user]');

			$id__user = $this->input->post('id_user');
			$mdp_user = $this->input->post('mdp_user');
			$mdp_user_c = $this->input->post('mdp_user_c');

			if ($this->form_validation->run())
			{ 	

				$this->User_Model->update_mdp_user( $id__user , $mdp_user );

				$this->session->set_flashdata( 'message' , 'Votre mot de passe a été bien modifié' );
				redirect( site_url( "Home" ) );
			}
			else
			{
				$this->session->set_flashdata( 'message' , 'Veuillez bien remplir' );
				redirect( site_url( "Home/reset_password/".$id__user ) );
			}
		}		
	}

	public function tarifs( $page = 1 )
	{
		$data['title'] = "Nos tarifs de rédaction";
		$data['tarifs'] = $this->Tarif_Model->find_all_tarif_active_with_pagination( $page );

		$tarifs = $this->Tarif_Model->find_all_tarif_active();

		$nb_pages = count( (array)$tarifs ) / 3;	
	    $data['nb_pages'] = intval( $nb_pages ) + 1; 

		$this->load->view('home/tarif/tarifs' , $data);	
	}

	public function redacteurs()
	{
		$data['title'] = "Nos types de rédacteur";

		$data['type_redacteurs'] = $this->Type_redacteur_Model->find_all_type_redacteur();

		$this->load->view('home/redacteur/redacteurs' , $data);	
	}

	public function paiements( $page = 1 )
	{
		$data['title'] = "Nos types de paiement";
		$data['types_paiement'] = $this->Type_paiement_Model->find_all_type_paiement_active_with_pagination( $page );

		$paiements = $this->Type_paiement_Model->find_all_type_paiement_active();

		$nb_pages = count( (array)$paiements ) / 5;	
	    $data['nb_pages'] = intval( $nb_pages ) + 1;

		$this->load->view('home/paiement/paiements' , $data);	
	}


	public function contact()
	{
		$data['title'] = "Contact";

		$data['rs'] = "Tiasy";
		$data['tel'] = "+261 34 41 519 78";
		$data['mail'] = "tiasymail@gmail.com";
		$data['adresse'] = "Tsimbazaza, Antananarivo 101";

		
		$this->load->view('home/contact/index' , $data);	
	}
}
