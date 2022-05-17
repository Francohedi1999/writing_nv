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
						<h5 align="center">Ajout tarif</h5>
					</legend>
					
					<form action="<?php echo site_url('Admin/insertion_tarif');?>" method="post">
						<div class="form-group mt-2">
							<label>Type de rédacteur</label>
							<input type="text" name="type_redacteur" class="form-control">
							<span><?php echo form_error('type_redacteur' , '<p class="text-danger">' , '</p>'); ?></span>
						</div>
						<div class="form-group mt-2">
							<label>Type de texte</label>
							<input type="text" name="type_text" class="form-control">
							<span><?php echo form_error('type_text' , '<p class="text-danger">' , '</p>'); ?></span>
						</div>
						<div class="form-group mt-2">
							<label>Prix par mot (en Ar)</label>
							<input type="number" step="0.00000001" name="prix_par_mot" class="form-control">
							<span><?php echo form_error('prix_par_mot' , '<p class="text-danger">' , '</p>'); ?></span>
						</div>
						<div class="form-group mt-2">
							<input type="submit" class="btn btn-success" value="Enregistrer">
						</div>
					</form>
					<a href="<?php echo site_url('Admin/tarifs');?>" class="btn btn-danger">Annuler</a>
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