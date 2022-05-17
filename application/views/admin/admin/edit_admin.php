<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $title; ?></title>
	<link rel="icon" href="<?php echo site_url('assets/images/logo.png')?>"/>
	<?php $this->load->view("include/assets_css");?>
</head>
<body>
	<div class="contenu_global">

		<div id="navigation" class="navigation">
			<?php $this->load->view("include/navbar");?>
		</div>

		<div class="topbar">
			<?php $this->load->view("include/topbar");?>
		</div>
		
		<div class="contenu">

			<div class="p-2">

				<h4 align="center">Admin</h4>
				<hr>

				<form method="post" action="<?php echo site_url('Admin/edit'); ?>">

					<div class="form-row">
						<div class="form-group col-md-6">
							<label>Nom utilisateur</label>
							<input class="form-control" type="hidden" name="id_user" value="<?php echo $user['id_user']; ?>">
							<input class="form-control" type="text" name="nom_user" value="<?php echo $user['nom_user']; ?>">
							<span><?php echo form_error('nom_user' , '<p class="text-danger">' , '</p>'); ?></span>
						</div>
						<div class="form-group col-md-6">
							<label>Adresse email</label>
							<input class="form-control" type="email" name="mail_user" value="<?php echo $user['mail_user']; ?>">
							<span><?php echo form_error('mail_user' , '<p class="text-danger">' , '</p>'); ?></span>
						</div>	
					</div>

					<div class="form-row">
						<div class="form-group col-md-12">
							<input class="btn btn-success" type="submit" value="Enregistrer">
						</div>
					</div>	

				</form>

				<a href="<?php echo site_url('Admin/profil')?>" class="btn btn-danger">Annuler</a>

			</div>

		</div>	

		<div class="scroll_top bg-dark">
			<a class="nav-link text-white" onclick="scroll_top('navigation')">
            	<i class="fa fa-angle-double-up fa-2x"></i>
			</a>
		</div>
			
	</div>
</body>
<?php $this->load->view("include/assets_js");?>
</html>