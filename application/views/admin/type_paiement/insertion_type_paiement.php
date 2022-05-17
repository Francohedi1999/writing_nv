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
						<h5 align="center">Ajout type de paiement</h5>
					</legend>
					<hr>
					<form action="" method="post">

						<label>Type de payement</label>
						<input type="text" name="type_paiement" class="form-control">
						<span><?php echo form_error('type_paiement' , '<p class="text-danger">' , '</p>'); ?></span>

						<label class="mt-3">Description</label>
						<textarea name="desc_type_paiement" class="form-control" rows="5"></textarea>
						<span><?php echo form_error('desc_type_paiement' , '<p class="text-danger">' , '</p>'); ?></span>
						
						<input type="submit" value="Enregistrer" class="btn btn-success mt-3">
					</form>
					<a href="<?php echo site_url('Admin/paiements');?>" class="btn btn-danger mt-2">Annuler</a>
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
