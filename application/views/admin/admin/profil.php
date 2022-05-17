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

				<?php if( $this->session->flashdata( 'message' ) ) { ?>
				<p class="message alert alert-success" role="alert">
					<?php echo $this->session->flashdata( 'message' ) ;?>
				</p>
				<?php }?>

				<fieldset>
					<legend>
						<h1 align="center">
							<img src="<?php echo site_url('assets/images/user.png')?>" alt="<?php echo $user['nom_user'];?>" class="rounded-circle" width="120px" height="120px">
							<?php echo $user['nom_user'];?>
						</h1>
					</legend>
					<hr>
					<dl class="row">
						<dt class="col-sm-3">Nom(s)</dt>
						<dd class="col-sm-9"><?php echo $user['nom_user'];?></dd>
					</dl>
					<dl class="row">
						<dt class="col-sm-3">Adresse email</dt>
						<dd class="col-sm-9"><?php echo $user['mail_user'];?></dd>
					</dl>
				</fieldset>
				
				<a href="<?php echo site_url('Admin/edit')?>" class="btn btn-success">
					Modifier mon profil
				</a>

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