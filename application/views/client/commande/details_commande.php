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
						<dl class="row">
				  			<dt class="col-sm-3">Commande n°</dt>
				  			<dd class="col-sm-9"><?php echo $details_commande['id_commande'];?></dd>
			  			</dl>
					</legend>
					<hr>
					<div class="row">
						<div class="col-md-6">
							<dl class="row">
					  			<dt class="col-sm-6">Type de rédacteur</dt>
					  			<dd class="col-sm-6"><?php echo $details_commande['type_redacteur'];?></dd>

						  		<dt class="col-sm-6">Type de texte</dt>
						  		<dd class="col-sm-6"><?php echo $details_commande['type_text'];?></dd>

						  		<dt class="col-sm-6">Langue</dt>
					  			<dd class="col-sm-6"><?php echo $details_commande['langue_text'];?></dd>

					  			<dt class="col-sm-6">Titre</dt>
					  			<dd class="col-sm-6"><?php echo $details_commande['titre_commande'];?></dd>

					  			<dt class="col-sm-6">Mot clé</dt>
					  			<dd class="col-sm-6"><pre><?php echo $details_commande['mot_cle'];?></pre></dd>

					  			<dt class="col-sm-6">Remarque (Instruction)</dt>
					  			<dd class="col-sm-6"><pre><?php echo $details_commande['remarque'];?></pre></dd>

					  			<dt class="col-sm-6">Code Promo</dt>
					  			<dd class="col-sm-6"><?php echo $details_commande['code_promo'] ;?></dd>
							</dl>
						</div>
						<div class="vl col-md-6">
							<dl class="row">
								<dt class="col-sm-6">Nombre de mot</dt>
					  			<dd class="col-sm-6"><?php echo $details_commande['nb_mot'] ;?></dd>

					  			<dt class="col-sm-6">Prix par mot</dt>
					  			<dd class="col-sm-6"><?php echo round($details_commande['prix_par_mot'] , 2)." Ar" ;?></dd>

								<dt class="col-sm-6">Prix prestation</dt>
					  			<dd class="col-sm-6"><?php echo round( $details_commande['nb_mot'] * $tarif['prix_par_mot'] , 2 )." Ar" ;?></dd>					  			

					  			<dt class="col-sm-6">Réduction par Code Promo</dt>
					  			<dd class="col-sm-6"><?php echo "-".round( $details_commande['reduction_promo'] , 2)."%" ;?></dd>

					  			<dt class="col-sm-6">Réduction par fidélité</dt>
					  			<?php if( $details_commande['fidele'] == 1 ) { ?>
					  				<dd class="col-sm-6"><?php echo "-".round( $details_commande['reduction_fidelite'] , 2)."%" ;?></dd>					  			
					  			<?php } elseif( $details_commande['fidele'] == 0 ) { ?>
					  				<dd class="col-sm-6"><?php echo "-".round( 0 , 2)."%" ;?></dd>
					  			<?php } ?>

								<dt class="col-sm-6">Réduction total</dt>
					  			<dd class="col-sm-6"><?php echo "-".round( $details_commande['reduction_promo'] + $details_commande['reduction_fidelite'] , 2)."%" ;?></dd>

					  			<dt class="col-sm-6">Prix total</dt>
					  			<dd class="col-sm-6"><?php echo round($details_commande['prix_prestation'] , 2)." Ar" ;?></dd>
							</dl>
						</div>
					</div>					
					<hr>

				</fieldset>

				<form method="post" action="<?php echo site_url('Client/validation_commande'); ?>">
					<input type="hidden" name="id_user" value="<?php echo $details_commande['id_user'];?>">
					<input type="hidden" name="id_commande" value="<?php echo $details_commande['id_commande'];?>">
					<input type="hidden" name="modifiable" value="<?php echo $details_commande['modifiable'];?>">

					<input type="submit" name="modifier" class="btn btn-secondary" value="Modifier">
					<input type="submit" name="valider" class="btn btn-success" value="Valider">

					<?php if( $details_commande['modifiable'] == 1 ) { ?>					
						<input type="submit" name="annuler" class="btn btn-danger float-right" value="Annuler">
					<?php } ?>
				</form>

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