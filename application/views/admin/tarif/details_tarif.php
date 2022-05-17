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
				<?php } ?>

				<fieldset>
						<legend>
							<h4 align="center" class="mb-3">Tarif n° <?php echo $tarif['id_tarif'] ;?></h4>
							<hr>
						</legend>

							<div class="row">

								<div class="col-md-6">
									<dl class="row">
										<dt class="col-sm-3">Type de rédacteur</dt>
										<dd class="col-sm-9"><?php echo $tarif['type_redacteur'] ;?></dd>
									</dl>
									<dl class="row">
										<dt class="col-sm-3">Type de texte</dt>
										<dd class="col-sm-9"><?php echo $tarif['type_text'] ;?></dd>
									</dl>
									<dl class="row">
										<dt class="col-sm-3">Prix par mot</dt>
										<dd class="col-sm-9"><?php echo round($tarif['prix_par_mot'] , 2)." Ar" ;?></dd>
									</dl>
									<dl class="row">
										<dt class="col-sm-3">Etat</dt>
										<dd class="col-sm-9"><?php echo $tarif['active'] ;?></dd>
									</dl>
								</div>

								<div class="col-md-6">
									<?php if( $tarif['is_active'] == 1 ) {?>
										<a class="btn btn-light text-decoration-none text-danger mt-2" href="<?php echo site_url('Admin/activation_tarif/'.$tarif['is_active'].'/'.$tarif['id_tarif']);?>">
											<i class="fa fa-close" style="color:red;"></i>
											Désactiver
										</a><br>
									<?php } elseif( $tarif['is_active'] == 0 ) {?>
										<a class="btn btn-light text-decoration-none text-success mt-2" href="<?php echo site_url('Admin/activation_tarif/'.$tarif['is_active'].'/'.$tarif['id_tarif']);?>">
											<i class="fa fa-check" style="color:green;"></i>
											Activer
										</a><br>
									<?php } ?>
										<a class="btn btn-light text-decoration-none mt-2" href="<?php echo site_url('Admin/modification_tarif/'.$tarif['id_tarif']);?>">
											<i class="fa fa-edit" style="color:black;"></i>
											Modifier
										</a>
								</div>							
							</div>							
						
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