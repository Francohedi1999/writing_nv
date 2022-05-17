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

				<h4 align="center">Modification type de paiement</h4>
				<hr>
				<form action="<?php echo site_url('Admin/modification_type_paiement/');?>" method="post">

					<input type="hidden" name="id_type_paiement" class="form-control" value="<?php echo $paiement['id_type_paiement'];?>">

					<label>Type de paiement</label>
					<input type="text" name="type_paiement" class="form-control" value="<?php echo $paiement['type_paiement'];?>">
					<span><?php echo form_error('type_paiement' , '<p class="text-danger">' , '</p>'); ?></span>

					<label class="mt-3">Description</label>
					<textarea name="desc_type_paiement" class="form-control" rows="5"><?php echo $paiement['desc_type_paiement'];?></textarea>

					<input type="submit" name="" class="btn btn-success mt-3" value="Enregistrer">

				</form>
				<a href="<?php echo site_url('Admin/paiement/'.$paiement['id_type_paiement']);?>" class="btn btn-danger mt-2">Annuler</a>
				
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