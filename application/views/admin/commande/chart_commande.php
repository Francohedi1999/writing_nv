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
						type: "bar",
						dataPoints: 
							[
							   	<?php for( $i=0 ; $i<count($commandes_tarif) ; $i++ ) { ?>
								   		{ 
								   			y : <?php echo $commandes_tarif[$i]['prix_prestation'] ; ?>  ,
									   		label : "<?php echo $commandes_tarif[$i]['type_text'] ; ?>" ,
									   		exploded : true 
									   	},
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
							<?php for($i=0 ; $i<count($commandes_tarif) ; $i++) { ?>
								<tr>
									<th class="col-md-6"><?php echo $commandes_tarif[$i]['type_redacteur']."<br>".$commandes_tarif[$i]['type_text'] ;?></th>
									<td class="col-md-2"><?php echo $commandes_tarif[$i]['nb_commande'] ;?></td>
									<td class="col-md-2"><?php echo round( $commandes_tarif[$i]['prix_prestation'] , 2 )." Ar" ;?></td>
									<td class="col-md-2">
										<a href="<?php echo site_url('Admin/tarif_commandes/'.$commandes_tarif[$i]['id_tarif']);?>" class="btn btn-outline-primary">
											Voir
										</a>
									</td>
								</tr>
							<?php } ?>
								<tr>
									<th class="col-md-6">Total</th>
									<td class="col-md-2"><?php echo count($total_commandes) ;?></td>
									<td class="col-md-2"><?php echo round($prix_prestation_total['prix_prestation_total'] , 2)." Ar" ;?></td>
									<td class="col-md-2">
										<a href="<?php echo site_url('Admin/commandes/');?>" class="btn btn-outline-primary">
											Voir
										</a>
									</td>
								</tr>
						</table>

					</div>

					<div class="col-md-7">

						<div class="vl commandes" id="commandes"></div>

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