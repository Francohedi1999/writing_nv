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
				<h2 align="center">Inscription</h2>

				<form class="mt-4" method="post" action="<?php echo site_url('home/register'); ?>">

					<div class="form-row">

						<div class="form-group col-md-6">
							<label>Nom</label>	
							<input class="form-control" type="text" name="nom_user">
							<span><?php echo form_error('nom_user' , '<p class="text-danger">' , '</p>'); ?></span>
						</div>

						<div class="form-group col-md-6">
							<label>Adresse email</label>
							<input class="form-control" type="email" name="mail_user">
							<span><?php echo form_error('mail_user' , '<p class="text-danger">' , '</p>'); ?></span>
							<?php if(isset($error_mail)){?>
								<span><p class="text-danger"><?php echo $error_mail; ?></p></span>
							<?php }?>
						</div>

					</div>

					<div class="form-row">

						<div class="form-group col-md-6">
							<label class="mt-3">Mot de passe</label>
							<input class="form-control" type="password" name="mdp_user">
							<span><?php echo form_error('mdp_user' , '<p class="text-danger">' , '</p>'); ?></span>
						</div>

						<div class="form-group col-md-6">
							<label class="mt-3">Confirmation mot de passe</label>
							<input class="form-control" type="password" name="mdp_user_c">
							<span><?php echo form_error('mdp_user_c' , '<p class="text-danger">' , '</p>'); ?></span>
						</div>

					</div>

					<div class="form-row">

						<div class="form-group col-md-12">
							<label class="mt-3">Captcha</label>

							<div class="img_captcha mt-1 mb-2" style="width:200px;"><?php echo $captcha_image; ?></div>
							<input type="hidden" value="<?php echo $captcha_word; ?>" name="captch_word">

							<input class="form-control" type="text" name="captcha">
							<span><?php echo form_error('captcha' , '<p class="text-danger">' , '</p>'); ?></span>
							<?php if(isset($message_error)){?>
								<span><p class="text-danger"><?php echo $message_error; ?></p></span>
							<?php }?>
						</div>

					</div>

					<div class="form-row">

						<div class="form-group col-md-12 ">
							<input type="submit" class="btn btn-success mt-3 float-right" value="S' inscrire"><br>
						</div>
					
					</div>				

				</form>
			</div>	

		</div>

	</div>
</body>
<?php $this->load->view("include/assets_js");?>
</html>