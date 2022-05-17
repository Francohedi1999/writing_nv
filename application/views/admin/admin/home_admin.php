<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $title; ?></title>
	<link rel="icon" href="<?php echo site_url('assets/images/logo.png')?>"/>
	<?php $this->load->view("include/assets_css");?>
	<script src = "<?php echo site_url('assets/js/canvasjs.min.js')?>"></script>
	<script type="text/javascript">
		window.onload = function () {
			var commandes = new CanvasJS.Chart("commandes", {
				theme: "light2", // "light2", "dark1", "dark2"
				animationEnabled: true, // change to true		
				 title:
					 {
						text: ""
					 },
				 data: 
					 [
						 {
					
						// Change type to "bar", "area", "spline", "pie", "column",etc.
						type: "pie",
						dataPoints: 
							[
							   	<?php for( $i=0 ; $i<count($commandes) ; $i++ ) { ?>
								   	<?php if( $commandes[$i]['id_etat_commande'] == 1 ) { ?>
								   		{ label: "", color:" grey" , y: <?php echo $commandes[$i]['nb_commande']; ?>  , exploded : true },
									<?php } elseif ( $commandes[$i]['id_etat_commande'] == 2 ) { ?>
										{ label: "", color:"black" , y: <?php echo $commandes[$i]['nb_commande']; ?> , exploded : true  },
									<?php } elseif ( $commandes[$i]['id_etat_commande'] == 3 ) { ?>
										{ label: "" , color:"blue" , y: <?php echo $commandes[$i]['nb_commande']; ?> , exploded : true  },
									<?php } elseif ( $commandes[$i]['id_etat_commande'] == 4 ) { ?>
										{ label: "", color:" green" , y: <?php echo $commandes[$i]['nb_commande']; ?> , exploded : true  },
									<?php } elseif ( $commandes[$i]['id_etat_commande'] == 5 ) { ?>
										{ label: "", color:" yellow" , y: <?php echo $commandes[$i]['nb_commande']; ?> , exploded : true  },
									<?php } elseif ( $commandes[$i]['id_etat_commande'] == 6 ) { ?>
										{ label: "", color:" red" , y: <?php echo $commandes[$i]['nb_commande']; ?> , exploded : true  },
									<?php } ?>
							   	<?php } ?>
							   
							],
					 	}
				 	]
		});
	commandes.render();

	}
	</script>

</head>
<body>

	<div class="contenu_global">

		<div id="navigation" class="navigation">
			<?php $this->load->view("include/navbar");?>
		</div>

		<div class="topbar">
			<?php $this->load->view("include/topbar");?>
		</div>	
		
	

		<div class="contenu p-2">

			<form action="<?php echo site_url("Admin/") ;?>" method="post">
				<input type="submit" class="btn btn-outline-info mt-2" name="clients" value="Clients">
				<input type="submit" class="btn btn-outline-info mt-2" name="commandes" value="Commandes par état">
				<input type="submit" class="btn btn-outline-info mt-2" name="commandes_tarif" value="Commandes par type de rédaction">
			</form>

			<h4 align="center" class=" mt-3 mb-3">Commandes</h4>
			<hr>

				<div class="row">

					<div class="col-md-5">

						<table class="table table-bordered">
						<?php for($i=0 ; $i<count($commandes) ; $i++) { ?>
							<tr>
							<?php if( $commandes[$i]['id_etat_commande'] == 1 ) { ?>
								<th class="col-sm-10 text-secondary">En attente</th>
								<td class="col-sm-2 text-secondary"><?php echo $commandes[$i]['nb_commande'] ;?></td>
								<td class="col-md-2">
									<a href="<?php echo site_url('Admin/etat_commandes/'.$commandes[$i]['id_etat_commande']) ;?>" class="btn btn-outline-secondary">
										Voir
									</a>
								</td>
							<?php } elseif ( $commandes[$i]['id_etat_commande'] == 2 ) { ?>
								<th class="col-sm-10">Validée</th>
								<td class="col-sm-2"><?php echo $commandes[$i]['nb_commande'] ;?></td>
								<td class="col-md-2">
									<a href="<?php echo site_url('Admin/etat_commandes/'.$commandes[$i]['id_etat_commande']) ;?>" class="btn btn-outline-dark">
										Voir
									</a>
								</td>
							<?php } elseif ( $commandes[$i]['id_etat_commande'] == 3 ) { ?>
								<th class="col-sm-10 text-primary">En cours</th>
								<td class="col-sm-2 text-primary"><?php echo $commandes[$i]['nb_commande'] ;?></td>
								<td class="col-md-2">
									<a href="<?php echo site_url('Admin/etat_commandes/'.$commandes[$i]['id_etat_commande']) ;?>" class="btn btn-outline-primary">
										Voir
									</a>
								</td>
							<?php } elseif ( $commandes[$i]['id_etat_commande'] == 4 ) { ?>
								<th class="col-sm-10 text-success">Livrée</th>
								<td class="col-sm-2 text-success"><?php echo $commandes[$i]['nb_commande'] ;?></td>
								<td class="col-md-2">
									<a href="<?php echo site_url('Admin/etat_commandes/'.$commandes[$i]['id_etat_commande']) ;?>" class="btn btn-outline-success">
										Voir
									</a>
								</td>
							<?php } elseif ( $commandes[$i]['id_etat_commande'] == 5 ) { ?>
								<th class="col-sm-10 text-warning">Echouée</th>
								<td class="col-sm-2 text-warning"><?php echo $commandes[$i]['nb_commande'] ;?></td>
								<td class="col-md-2">
									<a href="<?php echo site_url('Admin/etat_commandes/'.$commandes[$i]['id_etat_commande']) ;?>" class="btn btn-outline-warning">
										Voir
									</a>
								</td>
							<?php } elseif ( $commandes[$i]['id_etat_commande'] == 6 ) { ?>
								<th class="col-sm-10 text-danger">Annulée</th>
								<td class="col-sm-2 text-danger"><?php echo $commandes[$i]['nb_commande'] ;?></td>
								<td class="col-md-2">
									<a href="<?php echo site_url('Admin/etat_commandes/'.$commandes[$i]['id_etat_commande']) ;?>" class="btn btn-outline-danger">
										Voir
									</a>
								</td>
							<?php } ?>
							</tr>
						<?php } ?>
							<tr>
								<th class="col-sm-10">Total</th>
								<td class="col-sm-2"><?php echo count($total_commandes) ;?></td>
								<td class="col-md-2">
									<a href="<?php echo site_url('Admin/commandes/') ;?>" class="btn btn-outline-dark">
										Voir
									</a>
								</td>
							</tr>
						</table>

					</div>

					<div class="col-md-7">

						<div class="commandes" id="commandes"></div>

					</div>						
						
				</div>
				<hr>

				<div class="mt-4 mb-2">
					<a href="<?php echo site_url('Admin/commandes'); ?>" class="btn btn-primary">Voir les commandes</a>
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