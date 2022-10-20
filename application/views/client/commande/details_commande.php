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
						<div class="col-md-8">
							<dl class="row">

								<dt class="col-sm-4">Langue</dt>
					  			<dd class="col-sm-8"><?php echo $details_commande['langue_text'];?></dd>

					  			<dt class="col-sm-4">Type de texte et rédacteur</dt>
						  		<dd class="col-sm-8"><?php echo $details_commande['type_text']."<br>( ".$details_commande['type_redacteur']." )";?></dd>

					  			<dt class="col-sm-4">Cible</dt>
					  			<dd class="col-sm-8"><?php echo $details_commande['cible'];?></dd>						  		

						  		<dt class="col-sm-4">Ton</dt>
						  		<dd class="col-sm-8"><?php echo $details_commande['ton'];?></dd>

					  			<dt class="col-sm-4">Stuctures</dt>
					  			<dd class="col-sm-8">
								    <dl class="row">
								      	<dt class="col-sm-4">Titre</dt>
								      	<dd class="col-sm-8"><?php echo $details_commande['titre'];?></dd>
								    </dl>
								    <dl class="row">
								      	<dt class="col-sm-4">Inertitre</dt>
								      	<dd class="col-sm-8"><?php echo $details_commande['intertitres'];?></dd>
								    </dl>
								    <dl class="row">
								      	<dt class="col-sm-4">Nombre de mots</dt>
								      	<dd class="col-sm-8"><?php echo $details_commande['nb_mots_paragraphe'] ;?></dd>
								    </dl>
								 </dd>

					  			<dt class="col-sm-4">Mot-clé primaire</dt>
					  			<dd class="col-sm-8"><?php echo $details_commande['mot_cle_1'];?></dd>

					  			<dt class="col-sm-4">Mot-clés secondaires</dt>
					  			<dd class="col-sm-8"><?php echo $details_commande['mot_cle_2'];?></dd>

								<dt class="col-sm-4">Mise en forme de l'article</dt>
					  			<dd class="col-sm-8"><?php echo $details_commande['mise_en_forme'];?></dd>	

					  			<dt class="col-sm-4">Méta-titre</dt>
					  			<dd class="col-sm-8"><?php echo $details_commande['meta_titre'];?></dd>	

					  			<dt class="col-sm-4">Méta-description</dt>
					  			<dd class="col-sm-8"><?php echo $details_commande['meta_desc'];?></dd>	

					  			<dt class="col-sm-4">Balises</dt>
					  			<dd class="col-sm-8"><?php echo $details_commande['balise'];?></dd>			
					  					  			
							</dl>
						</div>
						<div class="vl col-md-4">
							<dl class="row">

					  			<dt class="col-sm-6">Code Promo</dt>
					  			<dd class="col-sm-6"><?php echo $details_commande['code_promo'] ;?></dd>

					  			<dt class="col-sm-6">Prix par mot</dt>
					  			<dd class="col-sm-6"><?php echo round($details_commande['prix_par_mot'] , 2)." Ar" ;?></dd>

								<dt class="col-sm-6">Prix prestation</dt>
					  			<dd class="col-sm-6"><?php echo round( $details_commande['nb_mots_paragraphe'] * $tarif['prix_par_mot'] , 2 )." Ar" ;?></dd>					  			

					  			<dt class="col-sm-6">Réduction par Code Promo</dt>
					  			<dd class="col-sm-6"><?php echo "-".round( $details_commande['reduction_promo'] , 2)."%" ;?></dd>

					  			<dt class="col-sm-6">Réduction par fidélité</dt>
					  			<dd class="col-sm-6"><?php echo "-".round( $details_commande['reduction_fidelite'] , 2)."%" ;?></dd>

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