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
			
			<div class="form_log">
				<h2 align="center">Connexion</h2>
			
				<?php if( $this->session->flashdata( 'message' ) ) { ?>
					<div class="alert alert-success mt-2" role="alert">
						<?php echo $this->session->flashdata( 'message' );?>
					</div>
				<?php } elseif( isset( $error_log ) ) {?>
					<div class="alert alert-danger mt-2 mb-2" role="alert">
						<?php echo $error_log; ?>
					</div>	
				<?php }?>

				<form class="mt-4" method="post" action="<?php echo site_url('home/'); ?>">

					<div class="form-row">

						<div class="form-group col-md-12">
							<label>Adresse email</label>
							<input class="form-control" type="email" name="mail_user">
							<span><?php echo form_error('mail_user' , '<p class="text-danger">' , '</p>'); ?></span>
						</div>

					</div>
					
					<div class="form-row">

						<div class="form-group col-md-12">
							<label class="mt-3">Mot de passe</label>
							<input class="form-control" type="password" name="mdp_user">
							<span><?php echo form_error('mdp_user' , '<p class="text-danger">' , '</p>'); ?></span>	
						</div>

					</div>

					<div class="form-row">

						<div class="form-group col-md-12">
							<input class="btn btn-success mt-3 float-right" type="submit" value="Se connecter"><br>
						</div>

					</div>
				
				</form>	
			</div>

		</div>

	</div>
</body>
<?php $this->load->view("include/assets_js");?>
</html>