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
				
				<?php if( $this->session->flashdata('message') ) { ?>
				<p class="message alert alert-success" role="alert">
					<?php echo $this->session->flashdata('message') ;?>
				</p>
				<?php } ?>

				<h4 align="center">Type de paiement</h4>
				<hr>
				<div class="row">
					<div class="col-md-6">
						<dl class="row">

							<dt class="col-sm-3">Type de paiement</dt>
							<dd class="col-sm-9"><?php echo $paiement['type_paiement'];?></dd>

							<dt class="col-sm-3">Description</dt>
							<dd class="col-sm-9"><pre><?php echo $paiement['desc_type_paiement'];?></pre></dd>

							<dt class="col-sm-3">Etat</dt>
							<dd class="col-sm-9"><?php echo $paiement['active'];?></dd>

						</dl>
					</div>
					<div class="col-md-6">				

						<?php if( $paiement['is_active'] == 1 ) { ?>
						<a class="btn btn-light text-decoration-none text-danger mt-2" href="<?php echo site_url('Admin/activation_type_paiement/'.$paiement['id_type_paiement'].'/'.$paiement['is_active']);?>">
							<i class="fa fa-close" style="color:red;"></i>
							Désactiver
						</a><br>
						<?php } elseif( $paiement['is_active'] == 2 ) { ?>
						<a class="btn btn-light text-decoration-none text-success mt-2" href="<?php echo site_url('Admin/activation_type_paiement/'.$paiement['id_type_paiement'].'/'.$paiement['is_active']);?>">
							<i class="fa fa-check" style="color:green;"></i>
							Activer
						</a><br>
						<?php } ?>

						<a class="btn btn-light text-decoration-none mt-2" href="<?php echo site_url('Admin/modification_type_paiement/'.$paiement['id_type_paiement']);?>">
							<i class="fa fa-edit" style="color:black;"></i>
							Modifier
						</a>

					</div>
				</div>				

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