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
					<?php echo $this->session->flashdata( 'message' );?>
				</p>
				<?php } ?>

				<div class="row">
					<div class="col-md-4 mt-6">

						<?php if( $facture['payee'] == 0 ) { ?>
						<a href="<?php echo site_url('Admin/modification_etat_facture/'.$facture['id_facture'] );?>" class="btn btn-success mt-2">
							Payer cette facture
						</a><br>
						<?php }?>
				
						<button class="btn btn-light text-decoration-none mt-2" id="exportPDF">
							<i class="fa fa-print fa-lg" style="color:black"></i>
							Capturer
						</button>

					</div>
				</div>
				
				<hr>

				

				<div id="facture">
					<div class="titre">
						<h4 align="center">
							Facture n° <?php echo $facture['id_facture']." / commande n°".$facture['id_commande'];?>
						</h4>
					</div>
					<hr>
					<div class="date">
						<div class="row">
							<div class="col-md-6">
								<dl class="row">
									<dt class="col-sm-3">Date de facture</dt>
									<dd class="col-sm-9"><?php echo $facture['date_facturation'];?></dd>
								</dl>								
								<dl class="row">
									<dt class="col-sm-3">Date de livraison</dt>
									<dd class="col-sm-9"><?php echo $facture['date_livraison'];?></dd>
							  	</dl>
							</div>	
							<div class="col-md-6">
								<dl class="row">
									<dt class="col-sm-3">Type de paiement</dt>
									<dd class="col-sm-9"><?php echo $facture['type_paiement'];?></dd>
								</dl>
							</div>					  			
						</div>
					</div>
					<hr>
					<div class="info_client">
						<div class="row">
							<div class="col-md-6">
								<dl class="row">
									<dt class="col-sm-3">Nom du Client</dt>
									<dd class="col-sm-9"><?php echo $commande['nom_user'];?></dd>
									<dt class="col-sm-3">Adresse email</dt>
									<dd class="col-sm-9"><?php echo $commande['mail_user'];?></dd>
								</dl>
							</div>
							<div class="col-md-6">
								<dl class="row">
									<dt class="col-sm-3">Entreprise</dt>
									<dd class="col-sm-9"><?php echo $commande['nom_entreprise'];?></dd>
									<dt class="col-sm-3">Adresse</dt>
									<dd class="col-sm-9"><?php echo $commande['adresse'];?></dd>
									<dt class="col-sm-3">Pays</dt>
									<dd class="col-sm-9"><?php echo $commande['nom_pays'];?></dd>
									<dt class="col-sm-3">Ville</dt>
									<dd class="col-sm-9"><?php echo $commande['ville'];?></dd>
									<dt class="col-sm-3">Code postal</dt>
									<dd class="col-sm-9"><?php echo $commande['code_postal'];?></dd>
								</dl>
							</div>
						</div>
					</div>
					<div class="tableau">
						<table class="table table-bordered">
				  			<tr>
					  			<th>Description</th>	  							
					  			<th>Etat</th>
					  			<th>Mots</th>
					  			<th>Prix par mot (Ar)</th>
				  			</tr>
				  			<tr>
					  			<td>
						  			<p>
							  			<?php echo $commande['type_text'] ;?><br>
							  			<?php echo $commande['type_redacteur'] ;?><br>
							  			<?php echo $commande['langue_text'] ;?>							
						  			</p>	  								
					  			</td>
					  			<td><?php echo $facture['etat_facture'] ;?></td>
					  			<td><?php echo $commande['nb_mot'] ;?></td>	  							
					  			<td><?php echo round($commande['prix_par_mot'] , 2) ;?></td>	  							
				  			</tr>
						</table>
					</div>
					<div class="prix">
						<dl class="row">
							
							<dt class="col-sm-6">CODE PROMO</dt>
							<dd class="col-sm-6"><?php echo $commande['code_promo'] ;?></dd>

							<dt class="col-sm-6">Sous-total</dt>
							<dd class="col-sm-6"><?php echo round($commande['nb_mot'] * $commande['prix_par_mot'] , 2)." Ar" ;?></dd>
							
							<dt class="col-sm-6">Remise par CODE PROMO</dt>
							<dd class="col-sm-6"><?php echo "-".round($commande['reduction_promo'] , 2)." %" ;?></dd>
							
							<dt class="col-sm-6">Remise par fidélité </dt>
							<dd class="col-sm-6"><?php echo "-".round($commande['reduction_fidelite'] , 2)." %" ;?></dd>
							
							<dt class="col-sm-6">Remise total</dt>
							<dd class="col-sm-6"><?php echo "-".round($commande['reduction_promo'] + $commande['reduction_fidelite'] , 2)." %" ;?></dd>
							
							<dt class="col-sm-6">Total à payer</dt>
							<dd class="col-sm-6"><?php echo round($commande['prix_prestation'] , 2)." Ar" ;?></dd>
						</dl>
					</div>
				</div>

				<a href="<?php echo site_url('Admin/details_commande/'.$facture['id_commande']);?>" class="btn btn-primary mt-4 mb-4">Voir la commande</a><br>

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
<script type="text/javascript">

	let htmlPDF = document.getElementById("facture");
	let exportPDF = document.getElementById("exportPDF");
	exportPDF.onclick = (e) => html2pdf(htmlPDF);

</script>
</html>