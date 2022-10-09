<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $title; ?></title>
	<link rel="icon" href="<?php echo site_url('assets/images/logo.png')?>"/>
	<?php $this->load->view("include/assets_css.php");?>
</head>
<body>
	<div class="contenu_global">

		<div id="navigation" class="navigation">
			<?php $this->load->view("include/navbar");?>
		</div>

		<div class="topbar">
			<?php $this->load->view("include/topbar");?>
		</div>
		
		<div class="contenu p-2">

				<div class="form_insc">

					<h2 align="center"><?php echo $title;?></h2>
					<div class="my-3">
						<span><?php echo form_error('nom_user' , '<p class="alert-danger rounded px-2 py-1" role="alert">' , '</p>'); ?></span>
						<span><?php echo form_error('nom_entreprise' , '<p class="alert-danger rounded px-2 py-1" role="alert">' , '</p>'); ?></span>
						<span><?php echo form_error('num_eng_fiscal' , '<p class="alert-danger rounded px-2 py-1" role="alert">' , '</p>'); ?></span>
						<span><?php echo form_error('mail_user' , '<p class="alert-danger rounded px-2 py-1" role="alert">' , '</p>'); ?></span>
						<?php if(isset($error_mail)){?>
							<span><p class="alert-danger rounded px-2 py-1" role="alert"><?php echo $error_mail; ?></p></span>
						<?php }?>
						<span><?php echo form_error('mdp_user' , '<p class="alert-danger rounded px-2 py-1" role="alert">' , '</p>'); ?></span>
						<span><?php echo form_error('mdp_user_c' , '<p class="alert-danger rounded px-2 py-1" role="alert">' , '</p>'); ?></span>
						<?php if(isset($message_error)){?>
							<span><p class="alert-danger rounded px-2 py-1" role="alert"><?php echo $message_error; ?></p></span>
						<?php }?>
						<span><?php echo form_error('captcha' , '<p class="alert-danger rounded px-2 py-1" role="alert">' , '</p>'); ?></span>
						<span><?php echo form_error('id_pays' , '<p class="alert-danger rounded px-2 py-1" role="alert">' , '</p>'); ?></span>
						<span><?php echo form_error('ville' , '<p class="alert-danger rounded px-2 py-1" role="alert">' , '</p>'); ?></span>
						<span><?php echo form_error('region' , '<p class="alert-danger rounded px-2 py-1" role="alert">' , '</p>'); ?></span>
						<span><?php echo form_error('adresse' , '<p class="alert-danger rounded px-2 py-1" role="alert">' , '</p>'); ?></span>
						<span><?php echo form_error('bio' , '<p class="alert-danger rounded px-2 py-1" role="alert">' , '</p>'); ?></span>
						<span><?php echo form_error('domaine_predilection' , '<p class="alert-danger rounded px-2 py-1" role="alert">' , '</p>'); ?></span>
						<span><?php echo form_error('tel_user' , '<p class="alert-danger rounded px-2 py-1" role="alert">' , '</p>'); ?></span>
					</div>
					<form method="post" action="<?php echo site_url('home/register_client'); ?>">		
									
						<div>    
						   <ul class="etape">   

						      	<li class="my-2">
						      		<a class="btn btn-light" onclick="open_form_motif( 'insc_1' )">Etape 1 <i class="fa fa-angle-down" style="color:black;"></i></a>

						      		<div id="insc_1" class="shadow my-4 p-2 rounded">
										
										<a onclick="close_form_motif( 'insc_1' )" class="btn btn-white">							
											<i class="fa fa-close" style="color:black;"></i>
										</a>
										<hr>
										<div class="row">
											<div class="col">
												<label>Nom</label>
												<input name="nom_user" class="form-control mb-3" type="text">
											</div>
											<div class="col">
												<label>Pseudo Discord</label>
												<input name="pseudo_user" class="form-control mb-3" type="text">
											</div>
										</div>				
										
										<div class="row">
											<div class="col">
												<label>Nom de la société</label>
												<input name="nom_entreprise" class="form-control mb-3" type="text">
											</div>
											<div class="col">
												<label>Numéro d’enregistrement fiscal</label>
												<input name="num_eng_fiscal" class="form-control mb-3" type="text">
											</div>
										</div>							
								
										<label>Adresse email</label>
										<input name="mail_user" class="form-control mb-3" type="email">
										
										<label>Mot de passe</label>
										<input name="mdp_user" class="form-control mb-3" type="password">

										<label>Confirmation mot de passe</label>
										<input name="mdp_user_c" class="form-control mb-3" type="password">

										<label>Captcha</label>

										<div class="img_captcha mt-1 mb-3" style="width:200px;"><?php echo $captcha_image; ?></div>
										<input type="hidden" value="<?php echo $captcha_word; ?>" name="captch_word">

										<input class="form-control mb-3" type="text" name="captcha">

									</div>

						      	</li> 

						      	<li class="my-2">
						      		<a class="btn btn-light" onclick="open_form_motif( 'insc_2' )">Etape 2 <i class="fa fa-angle-down" style="color:black;"></i></a>

						      		<div id="insc_2" class="shadow my-4 p-2 rounded">

						      			<a onclick="close_form_motif( 'insc_2' )" class="btn btn-white">							
											<i class="fa fa-close" style="color:black;"></i>
										</a>
										<hr>
										<label>Pays</label>
										<select name="id_pays" id="id_pays"  class="form-control mb-3">
										<?php for($i=0 ; $i<count($pays) ; $i++) {?>
											<option value="<?php echo $pays[$i]['id_pays'];?>"><?php echo $pays[$i]['nom_pays'] ;?></option>
										<?php }?>					
										</select>	

										<label>Ville</label>
										<input name="ville" class="form-control mb-3" type="text">

										<label>Région</label>
										<input name="region" class="form-control mb-3" type="text">

										<label>Adresse</label>
										<input name="adresse" class="form-control mb-3" type="text">	

									</div>
								</li>

						      	<li class="my-2">
						      		<a class="btn btn-light" onclick="open_form_motif( 'insc_3' )">Etape 3 <i class="fa fa-angle-down" style="color:black;"></i></a>

						      		<div id="insc_3" class="shadow my-4 p-2 rounded">

						      			<a onclick="close_form_motif( 'insc_3' )" class="btn btn-white">							
											<i class="fa fa-close" style="color:black;"></i>
										</a>
										<hr>
										<label>
											Bio
											<br>
											(Présentez-vous en 150 mots. Pourquoi un client vous choisirait ? Quels sont vos atouts par rapport aux autres rédacteurs ? etc) 
										</label>
										<textarea name="bio" class="form-control mb-3" rows="10"></textarea>
										
										<label>
											Vos domaines de prédilection
											<br>
											(exemple : voyage, développement personnel, finances, management, etc)
										</label>
										<textarea name="domaine_predilection" class="form-control mb-3" rows="5"></textarea>						

									</div>
								</li>

								<li class="my-2">
						      		<a class="btn btn-light" onclick="open_form_motif( 'insc_4' )">Etape 4 <i class="fa fa-angle-down" style="color:black;"></i></a>

						      		<div id="insc_4" class="shadow my-4 p-2 rounded">		
										
										<a onclick="close_form_motif( 'insc_4' )" class="btn btn-white">							
											<i class="fa fa-close" style="color:black;"></i>
										</a>
										<hr>
										<label>Numéro de téléphone</label>
										<input name="tel_user" class="form-control mb-3" type="text">
										
										<label>Numéro Whatsapp</label>
										<input name="whatsapp_user" class="form-control mb-3" type="text">
										
										<label>Contact Skype</label>
										<input name="skype_user" class="form-control mb-3" type="text">

										<input class="btn btn-success" type="submit" value="S'inscrire">	

									</div>
								</li>

						   </ul>  
						</div>
						
					</form>

				</div>

				<div class="scroll_top bg-dark">
					<a class="nav-link text-white" onclick="scroll_top('navigation')">
		            	<i class="fa fa-angle-double-up fa-2x"></i>
					</a>
				</div>

		</div>

	</div>
</body>
<?php $this->load->view("include/assets_js");?>
</html>