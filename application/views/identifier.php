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
			
			<div class="form_identifier">
				<h4 align="center" class="mb-3">Réinitialisation mot de passe</h4>

				<?php if( $this->session->flashdata( 'message' ) ) { ?>
				<div class="alert alert-success mt-2 mb-2" role="alert">
					<?php echo $this->session->flashdata( 'message' );?>
				</div>
				<?php } elseif( $this->session->flashdata( 'email_erreur' ) ) { ?>
				<div class="alert alert-danger mt-2 mb-2" role="alert">
					<?php echo $this->session->flashdata( 'email_erreur' );?>
				</div>
				<?php } ?>

				<form class="mt-4" method="post" action="<?php echo site_url('home/identifier'); ?>">
					<div class="form-row">

						<div class="form-group col-md-12">
							<label>Veuillez saisir votre adresse email et nous vous enverrons un lien de réinitialisation de mot de passe.</label>
							<input class="form-control" type="email" name="mail_user">					
							<span><?php echo form_error('mail_user' , '<p class="text-danger">' , '</p>'); ?></span>
						</div>

					</div>
					<div class="form-row">

						<div class="form-group col-md-12">
							<input type="submit" class="btn btn-success mt-2 float-right" value="Envoyer"><br>
						</div>

					</div>				

					
				</form>
				
			</div>
			
		</div>

	</div>
</body>
<?php $this->load->view("include/assets_js");?>
</html>