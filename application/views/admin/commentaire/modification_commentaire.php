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

				<fieldset>
					<legend>
						<h4 align="center">Modification commentaire</h4>
					</legend>
					<form action="<?php echo site_url('Admin/modification_commentaire/');?>" method="post">
						<input type="hidden" value="<?php echo $commentaire['id_commentaire'] ;?>" name="id_commentaire">
						<input type="hidden" value="<?php echo $commentaire['id_commande'] ;?>" name="id_commande">
						<textarea name="commentaire" class="form-control mb-2" rows="5"><?php echo $commentaire['commentaire'] ;?></textarea>
						<input type="submit" value="Enregistrer" class="btn btn-success">
					</form>
					<a href="<?php echo site_url('Admin/details_commande/'.$commentaire['id_commande']);?>" class="btn btn-danger mt-2">Annuler</a>
				</fieldset>
				
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