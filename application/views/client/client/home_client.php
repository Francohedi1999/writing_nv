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

				<div class="row">

					<?php for($i=0 ; $i<count($commandes) ; $i++) { ?>
					<div class="col-md-6">
						<?php if( $commandes[$i]['id_etat_commande'] == 1 ) { ?>
							<div id="nbc" class="rounded bg-secondary m-2 p-2">
								<a class="text-white text-decoration-none" href="<?php echo site_url('Client/client_commandes/'.$commandes[$i]['id_user'].'/'.$commandes[$i]['id_etat_commande']); ?>">
								    <h5><?php echo $commandes[$i]['etat_commande'] ;?></h5>
								    <?php echo $commandes[$i]['nb_commande'] ;?>
							    </a>
							</div>
						<?php } elseif( $commandes[$i]['id_etat_commande'] == 2 ) { ?>
							<div id="nbc" class="rounded bg-white m-2 p-2">
								<a class="text-dark text-decoration-none" href="<?php echo site_url('Client/client_commandes/'.$commandes[$i]['id_user'].'/'.$commandes[$i]['id_etat_commande']); ?>">
							    	<h5><?php echo $commandes[$i]['etat_commande'] ;?></h5>
							    	<?php echo $commandes[$i]['nb_commande'] ;?>
							    </a>
							</div>
						<?php } elseif( $commandes[$i]['id_etat_commande'] == 3 ) { ?>
							<div id="nbc" class="rounded bg-primary m-2 p-2">
								<a class="text-white text-decoration-none" href="<?php echo site_url('Client/client_commandes/'.$commandes[$i]['id_user'].'/'.$commandes[$i]['id_etat_commande']); ?>">
							    	<h5><?php echo $commandes[$i]['etat_commande'] ;?></h5>
							    	<?php echo $commandes[$i]['nb_commande'] ;?>
							    </a>
							</div>
						<?php } elseif( $commandes[$i]['id_etat_commande'] == 4 ) { ?>
							<div id="nbc" class="rounded bg-success m-2 p-2">
								<a class="text-white text-decoration-none" href="<?php echo site_url('Client/client_commandes/'.$commandes[$i]['id_user'].'/'.$commandes[$i]['id_etat_commande']); ?>">
							    	<h5><?php echo $commandes[$i]['etat_commande'] ;?></h5>
							    	<?php echo $commandes[$i]['nb_commande'] ;?>
							    </a>
							</div>
						<?php } elseif( $commandes[$i]['id_etat_commande'] == 5 ) { ?>
							<div id="nbc" class="rounded bg-warning m-2 p-2">
								<a class="text-white text-decoration-none" href="<?php echo site_url('Client/client_commandes/'.$commandes[$i]['id_user'].'/'.$commandes[$i]['id_etat_commande']); ?>">
							    	<h5><?php echo $commandes[$i]['etat_commande'] ;?></h5>
							    	<?php echo $commandes[$i]['nb_commande'] ;?>
							    </a>
							</div>
						<?php } elseif( $commandes[$i]['id_etat_commande'] == 6 ) { ?>
							<div id="nbc" class="rounded bg-danger m-2 p-2">
								<a class="text-white text-decoration-none" href="<?php echo site_url('Client/client_commandes/'.$commandes[$i]['id_user'].'/'.$commandes[$i]['id_etat_commande']); ?>">
							    	<h5><?php echo $commandes[$i]['etat_commande'] ;?></h5>
							    	<?php echo $commandes[$i]['nb_commande'] ;?>
							    </a>
							</div>
						<?php } ?>
					</div>
					<?php } ?>

				</div>

				<div class="row">

					<div class="col-md-12">
						<div id="nbc" class="rounded bg-light m-2 p-2">
							<a class="text-dark text-decoration-none" href="<?php echo site_url('Client/commandes/'); ?>">
								<h5>Total</h5>
								<?php echo count($all_commandes) ;?>
							</a>
						</div>
					</div>

				</div>

				<a class="btn btn-outline-primary m-2" href="<?php echo site_url('Client/commande'); ?>">Faire une nouvelle commande</a>
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