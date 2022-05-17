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
			
			<div class="form_reset">
				<h4 align="center">Réinitialisation mot de passe</h4>

				<?php if( $this->session->flashdata( 'message' ) ) { ?>
				<div class="alert alert-danger mt-2 mb-2" role="alert">
					<?php echo $this->session->flashdata( 'message' );?>
				</div>
				<?php }?>

				<form class="mt-4" method="post" action="<?php echo site_url('home/reset_password/'); ?>">

					<label class="mt-2">Nouveau mot de passe</label><br>	
					<input class="form-control" type="hidden" value="<?php echo $user_['id_user'] ;?>" name="id_user">

					<input class="form-control" type="password" name="mdp_user">
					<span><?php echo form_error('mdp_user' , '<p class="text-danger">' , '</p>'); ?></span>					

					<label class="mt-2">Confirmation nouveau mot de passe </label><br>	
					<input class="form-control" type="password" name="mdp_user_c">
					<span><?php echo form_error('mdp_user_c' , '<p class="text-danger">' , '</p>'); ?></span>					

					<input type="submit" class="btn btn-success mt-3" value="Enregistrer"><br>
				</form>
			</div>
			
		</div>

	</div>
</body>
<?php $this->load->view("include/assets_js");?>
</html>