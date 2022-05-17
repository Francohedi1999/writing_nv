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

		<div  id="navigation" class="navigation">
			<?php $this->load->view("include/navbar");?>
		</div>

		<div class="topbar">
			<?php $this->load->view("include/topbar");?>
		</div>

		<div class="contenu">
			<div class="p-2">

				<form action="<?php echo site_url("Admin/reduction_client/");?>" method="post">
					<input class="form-control mt-2" type="hidden" name="id_user" value="<?php echo $client['id_user'];?>">
					<label>Réduction (%)</label>
					<input class="form-control mt-2" type="text" name="reduction_fidelite" value="<?php echo round($client['reduction_fidelite'] , 2);?>">
					<input class="btn btn-success mt-2" type="submit" value="Enregistrer">
				</form>

				<a href="<?php echo site_url("Admin/details_client/".$client['id_user']);?>" class="btn btn-danger mt-2">Annuler</a>
						
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