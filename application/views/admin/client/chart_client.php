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
			var clients = new CanvasJS.Chart("clients", {
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
							   	<?php for( $i=0 ; $i<count($nb_clients) ; $i++ ) { ?>
								   	<?php if( $nb_clients[$i]['fidele'] == 1 ) { ?>
								   		{ label: "", color:" green" , y: <?php echo $nb_clients[$i]['nb_user']; ?>  , exploded : true },
								   	<?php } elseif( $nb_clients[$i]['fidele'] == 0 ) { ?>
								   		{ label: "", color:" grey" , y: <?php echo $nb_clients[$i]['nb_user']; ?>  , exploded : true },
									<?php } ?>
							   	<?php } ?>
							   
							],
					 	}
				 	]
		});
	clients.render();

	}
	</script>

</head>
<body>

	<div class="contenu_global">

		<div  id="navigation" class="navigation">
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

				<h4 align="center" class=" mt-3 mb-3">Clients</h4>
				<hr>

					<div class="row">

						<div class="col-md-5">

							<table class="table table-bordered">
							<?php for( $i=0 ; $i<count($nb_clients) ; $i++ ) { ?>
								<tr>
							   	<?php if( $nb_clients[$i]['fidele'] == 1 ) { ?>
										<th class="col-sm-8 text-success">Fidèle</th>
										<td class="col-sm-2 text-success"><?php echo $nb_clients[$i]['nb_user']; ?></td>
										<td class="col-md-2">
											<a href="<?php echo site_url('Admin/fidelite_clients/'.$nb_clients[$i]['fidele'] );?>" class="btn btn-outline-success">
												Voir
											</a>
										</td>
							   	<?php } elseif( $nb_clients[$i]['fidele'] == 0 ) { ?>
										<th class="col-sm-8 text-secondary">Non fidèle</th>
										<td class="col-sm-2 text-secondary"><?php echo $nb_clients[$i]['nb_user']; ?></td>
										<td class="col-md-2">
											<a href="<?php echo site_url('Admin/fidelite_clients/'.$nb_clients[$i]['fidele'] );?>" class="btn btn-outline-secondary">
												Voir
											</a>
										</td>
								<?php } ?>
								</tr>
						   	<?php } ?>
								<tr>
									<th class="col-sm-10">Total</th>
									<td class="col-sm-2"><?php echo count($clients) ;?></td>
									<td class="col-md-2">
										<a href="<?php echo site_url('Admin/clients/');?>" class="btn btn-outline-dark">
											Voir
										</a>
									</td>
								</tr>
							</table>

						</div>

						<div class="col-md-7">

							<div class="clients" id="clients"></div>

						</div>						
						
					</div>
					<hr>

					<div class="mt-4 mb-2">
						<a href="<?php echo site_url('Admin/clients'); ?>" class="btn btn-primary">Voir les clients</a>
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