<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $title; ?></title>
	<link rel="icon" href="<?php echo site_url('assets/images/logo.png')?>"/>
	<?php $this->load->view("include/assets_css.php");?>
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

			<h3 align="center"><?php echo $title; ?><hr></h3>

			<div class="my-2">
				<?php if( $this->session->flashdata('message_erreur') ) { ?>
					<p class="message alert alert-danger" role="alert">
						<?php echo $this->session->flashdata('message_erreur') ; ?>
					</p>
				<?php } elseif( isset( $code_promo_error ) ) { ?>
					<p class="message alert alert-danger" role="alert">
						<?php echo $code_promo_error; ?>
					</p>
				<?php } elseif( $this->session->flashdata('message_annulee') ) { ?>
					<p class="message alert alert-danger" role="alert">
						<?php echo  $this->session->flashdata('message_annulee') ; ?>
					</p>
				<?php } ?>
				<span><?php echo form_error('nb_mot' , '<p class="alert-danger rounded px-2 py-1" role="alert">' , '</p>'); ?></span>
				<span><?php echo form_error('id_langue_text' , '<p class="alert-danger rounded px-2 py-1" role="alert">' , '</p>'); ?></span>
				<span><?php echo form_error('id_type_paiement' , '<p class="alert-danger rounded px-2 py-1" role="alert">' , '</p>'); ?></span>
				<span><?php echo form_error('id_tarif' , '<p class="alert-danger rounded px-2 py-1" role="alert">' , '</p>'); ?></span>
				<span><?php echo form_error('nom_user' , '<p class="alert-danger rounded px-2 py-1" role="alert">' , '</p>'); ?></span>
				<span><?php echo form_error('mail_user' , '<p class="alert-danger rounded px-2 py-1" role="alert">' , '</p>'); ?></span>
				<span><?php echo form_error('nom_entreprise' , '<p class="alert-danger rounded px-2 py-1" role="alert">' , '</p>'); ?></span>
				<span><?php echo form_error('num_eng_fiscal' , '<p class="alert-danger rounded px-2 py-1" role="alert">' , '</p>'); ?></span>
				<span><?php echo form_error('cible' , '<p class="alert-danger rounded px-2 py-1" role="alert">' , '</p>'); ?></span>
				<span><?php echo form_error('ton' , '<p class="alert-danger rounded px-2 py-1" role="alert">' , '</p>'); ?></span>
				<span><?php echo form_error('titre' , '<p class="alert-danger rounded px-2 py-1" role="alert">' , '</p>'); ?></span>
				<span><?php echo form_error('intertitres' , '<p class="alert-danger rounded px-2 py-1" role="alert">' , '</p>'); ?></span>
				<span><?php echo form_error('mot_cle_1' , '<p class="alert-danger rounded px-2 py-1" role="alert">' , '</p>'); ?></span>
				<span><?php echo form_error('mot_cle_2' , '<p class="alert-danger rounded px-2 py-1" role="alert">' , '</p>'); ?></span>
			</div>

			<form action="<?php echo site_url('Client/commande')?>" method="post">

				<div class="mx-2">
				<ul class="etape">

					<li class="my-2">	
						<div class="row">
							<div class="col-md-3">					
								<label>PRIX (en Ariary)</label>
								<input type="number"  step="0.00000001" name="prix_prestation" id="prix_prestation" class="form-control mb-4" disabled>
							</div>
						</div>
					</li>
					<li class="my-2">
						<a class="btn btn-light" onclick="open_form_motif( 'insc_1' )">Informations sur le client <i class="fa fa-angle-down" style="color:black;"></i></a>

						<div id="insc_1" class="shadow my-4 p-2 rounded">

							<a onclick="close_form_motif( 'insc_1' )" class="btn btn-white">							
								<i class="fa fa-close" style="color:black;"></i>
							</a>

							<h4 align="center">Client</h4>	
							<hr>

							<div class="row">
								<div class="col-md-6">
									<label>Nom</label>
									<input type="text" name="nom_user"class="form-control mb-4" value="<?php echo $user["nom_user"] ;?>">
									<label>Adresse email</label>
									<input type="text" name="mail_user"class="form-control mb-4" value="<?php echo $user["mail_user"] ;?>">
								</div>
								<div class="col-md-6">
									<label>Nom de la société</label>
									<input type="text" name="nom_entreprise"class="form-control mb-4" value="<?php echo $user["nom_entreprise"] ;?>">
									<label>Numéro d’ enregistrement fiscal</label>
									<input type="text" name="num_eng_fiscal"class="form-control mb-4" value="<?php echo $user["num_eng_fiscal"] ;?>">							
								</div>
							</div>
							

						</div>
					</li>

					<li class="my-2">
						<a class="btn btn-light" onclick="open_form_motif( 'insc_2' )">Commande <i class="fa fa-angle-down" style="color:black;"></i></a>

						<div id="insc_2" class="shadow my-4 p-2 rounded">

							<a onclick="close_form_motif( 'insc_2' )" class="btn btn-white">							
								<i class="fa fa-close" style="color:black;"></i>
							</a>

							<h4 align="center">Type et langue de texte</h4>	
							<hr>
							
							<div class="row">
								<div class="col-md-6">
									<label>Type de texte</label>
									<select name="id_tarif" id="id_tarif" class="form-control mb-4">
									<?php for($i=0 ; $i<count($tarifs) ; $i++){?>
										<option value="<?php echo $tarifs[$i]['id_tarif']."|".$tarifs[$i]['prix_par_mot'] ;?>">
										<?php echo $tarifs[$i]['type_redacteur']." - ".$tarifs[$i]['type_text'];?>
										</option>
									<?php }?>
									</select>									
								</div>
								<div class="col-md-6">
									<label>Langue</label>
									<select name="id_langue_text" class="form-control mb-4">
									<?php for($j=0 ; $j<count($langues_text) ; $j++){?>
										<option value="<?php echo $langues_text[$j]['id_langue_text'];?>">
											<?php echo $langues_text[$j]['langue_text'];?>
										</option>
									<?php }?>
									</select>
								</div>
							</div>

							<h4 align="center" class="mt-4">Cible et ton du texte</h4>	
							<hr>

							<div class="row">							
								<div class="col-md-6">
									<label>Cible (Exemple: jeunes francophones CA, gamers US, touristes...)</label>
									<textarea name="cible" rows="3" class="form-control mb-4"></textarea>									
								</div>
								<div class="col-md-6">
									<label>Ton (Exemple: formel, informel...)</label>
									<textarea name="ton" rows="3" class="form-control mb-4"></textarea>		
								</div>
							</div>

							<h4 align="center" class="mt-4">Structures</h4>	
							<hr>

							<div class="row">							
								<div class="col-md-6">
									<label>Titre</label>
									<textarea name="titre" rows="3" class="form-control mb-4"></textarea>									
								</div>
								<div class="col-md-6">
									<label>Intertitres</label>
									<textarea name="intertitres" rows="3" class="form-control mb-4"></textarea>									
								</div>
							</div>

							<h4 align="center" class="mt-4">Mot-clé</h4>	
							<hr>

							<div class="row">							
								<div class="col-md-6">
									<label>Mot-clé primaire</label>
									<textarea name="mot_cle_1" rows="3" class="form-control mb-4"></textarea>									
								</div>
								<div class="col-md-6">
									<label>Mot-clé secondaire</label>
									<textarea name="mot_cle_2" rows="3" class="form-control mb-4"></textarea>									
								</div>
							</div>

							<h4 align="center" class="mt-4">Paragraphes</h4>	
							<hr>

							<div class="row">							
								<div class="col-md-12">
									<label>Nombre de mot</label>
									<input type="number" name="nb_mot" id="nb_mot" class="form-control mb-4">									
								</div>
							</div>

							<h4 align="center" class="mt-4">Mise en forme</h4>	
							<hr>

							<div class="row">							
								<div class="col-md-12">
									<label>Mise en forme de l'article</label>
									<br>
									(Exemple: titre gras, intertitre gras et souligné, mot-clé en gras...)
									<textarea name="mise_en_forme" rows="10" class="form-control mb-4 mt-2"></textarea>									
								</div>
							</div>
							<div class="row">							
								<div class="col-md-6">
									<label>Méta-titre</label>
									<textarea name="meta_titre" rows="3" class="form-control mb-4"></textarea>									
								</div>
								<div class="col-md-6">
									<label>Méta-description </label>
									<textarea name="meta_desc" rows="3" class="form-control mb-4"></textarea>									
								</div>
							</div>
							<div class="row">							
								<div class="col-md-12">
									<label>Balises</label>
									<br>
									(Exemple: balises gras sur le mot-clé primaire, balises italiques sur les noms propres...)
									<textarea name="balise" rows="5" class="form-control mb-4 mt-2"></textarea>									
								</div>
							</div>
							<div class="row">							
								<div class="col-md-12">
									<label>Remarques</label>
									<textarea name="remarques" rows="5" class="form-control mb-4"></textarea>									
								</div>
							</div>

							<h4 align="center" class="mt-4">Paiement</h4>	
							<hr>

							<div class="row">							
								<div class="col-md-6">
									<label>Code PROMO</label>
									<input type="text" name="code_promo" class="form-control mb-4">									
								</div>
								<div class="col-md-6">
									<label>Moyen de paiement</label>
									<select name="id_type_paiement" id="id_type_paiement" class="form-control">
										<?php for($k=0 ; $k<count($type_paiement) ; $k++){?>
										<option value="<?php echo $type_paiement[$k]['id_type_paiement'];?>">
										<?php echo $type_paiement[$k]['type_paiement'];?>
										</option>
										<?php }?>
									</select>
								</div>
							</div>

							<div class="row">							
								<div class="col-md-6">
									<input type="submit" class="btn btn-success" value="Suivant">									
								</div>
							</div>

						</div>
					</li>

				</ul>

			</div>
				
			</form>
		
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
	$(function()
		{
			$( " #id_tarif , #nb_mot " ).change(
			function()
				{
					var selected = $( " #id_tarif option:selected " ).val().split( "|" )[1];
					console.log(selected);
					$( " #prix_prestation " ).val(selected * $( ' #nb_mot ' ).val());
				}
			)
		}
	);

</script>
</html>
