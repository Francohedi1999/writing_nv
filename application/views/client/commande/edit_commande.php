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

					<?php if(isset($code_promo_error)) {?>
					<p class="message alert alert-danger" role="alert">
						<?php echo $code_promo_error; ?>
					</p>
					<?php } elseif(isset($error_commande)) {?>
					<p class="message alert alert-danger" role="alert">
						<?php echo $error_commande; ?>
					</p>
					<?php } elseif(isset($message_erreur)) {?>
					<p class="message alert alert-danger" role="alert">
						<?php echo $message_erreur; ?>
					</p>
					<?php } elseif( $this->session->flashdata('message_erreur') ) { ?>
					<p class="message alert alert-danger" role="alert">
						<?php echo $this->session->flashdata('message_erreur') ; ?>
					</p>
					<?php } ?>

						<form method="post" action="<?php echo site_url('Client/modification_commande'); ?>">
							<div class="row">
								<div class="col-md-6">
						  			<h3 class="mt-3 mb-4" align="center"><?php echo "Commande n° ".$details_commande['id_commande'];?></h3>
									<hr>
									<input type="hidden" name="id_commande" value="<?php echo $details_commande['id_commande'];?>">
									<div class="form-row mt-2">
										<div class="form-group col-md-12">
											<label>Type de texte</label>
											<input type="hidden" id="id_tarif_choix" name="id_tarif_choix" value="<?php echo $details_commande['id_tarif']."|".$details_commande['prix_par_mot'];?>">
											<select class="choix_tarif form-control" name="id_tarif" id="id_tarif" >
											<?php for($i=0 ; $i<count($tarifs) ; $i++){?>
												<option value="<?php echo $tarifs[$i]['id_tarif']."|".$tarifs[$i]['prix_par_mot'] ;?>">
													<?php echo $tarifs[$i]['type_redacteur']." - ".$tarifs[$i]['type_text'];?>
												</option>
											<?php }?>
											</select>
										</div>
									</div>
									<div class="form-row mt-2">
										<div class="form-group col-md-12">
											<label>Titre</label>
											<input type="text" name="titre_commande" value="<?php echo $details_commande['titre_commande'];?>" class="form-control">
											<span><?php echo form_error('titre_commande' , '<p class="text-danger">' , '</p>'); ?></span>
										</div>
									</div>
									<div class="form-row mt-2">
										<div class="form-group col-md-12">
											<label>Langue</label>
											<input type="hidden" id="id_langue_choix" name="id_langue_choix" value="<?php echo $details_commande['id_langue_text'];?>" class="form-control">
											<select name="id_langue_text" class="choix_langue form-control">
											<?php for($i=0 ; $i<count($langues_text) ; $i++){?>
												<option value="<?php echo $langues_text[$i]['id_langue_text'];?>"><?php echo $langues_text[$i]['langue_text'];?></option>
											<?php }?>
											</select>
										</div>
									</div>
									<div class="form-row mt-2">									
										<div class="form-group col-md-6">
											<label>Nombre de mot</label>
											<input type="number" name="nb_mot" id="nb_mot" value="<?php echo $details_commande['nb_mot'];?>" class="form-control">
											<span><?php echo form_error('nb_mot' , '<p class="text-danger">' , '</p>'); ?></span>
										</div>
										<div class="form-group col-md-6">
											<label>Prix (en Ariary)</label>
											<input type="number" step="0.00000001" name="prix_prestation" id="prix_prestation" class="form-control" disabled>
										</div>
									</div>

									<div class="form-row mt-2">
										<div class="form-group col-md-12">
											<label>Mot clé</label>
											<textarea name="mot_cle" class="form-control" rows="5"><?php echo $details_commande['mot_cle'];?></textarea>
											<span><?php echo form_error('mot_cle' , '<p class="text-danger">' , '</p>'); ?></span>
										</div>
									</div>
									<div class="form-row mt-2">
										<div class="form-group col-md-12">
											<label>Remarque ou instruction (facultatif)</label>
											<textarea name="remarque" class="form-control" rows="5"><?php echo $details_commande['remarque'];?></textarea>
										</div>
									</div>
								</div>
								<div class="vl col-md-6">
									<h3 class="mt-3 mb-4" align="center">Facturation</h3>
									<hr>
									<div class="form-row mt-2">
										<div class="form-group col-md-12">
											<label>Entreprise (facultatif)</label>
											<input type="text" name="nom_entreprise" value="<?php echo $details_commande['nom_entreprise'];?>" class="form-control">
										</div>
									</div>

									<div class="form-row mt-2">
										<div class="form-group col-md-12">
											<label>Adresse (facultatif)</label>
											<input type="text" name="adresse" value="<?php echo $details_commande['adresse'];?>" class="form-control">
										</div>
									</div>
									<div class="form-row mt-2">
										<div class="form-group col-md-12">
											<label>Pays (facultatif)</label>
											<input type="hidden" id="nom_pays_choix" name="nom_pays_choix" value="<?php echo $details_commande['nom_pays'];?>" class="form-control">
											<select name="nom_pays" class="choix_pays form-control">
											<?php for($i=0 ; $i<count($pays) ; $i++){?>
												<option value="<?php echo $pays[$i]['nom_pays'];?>"><?php echo $pays[$i]['nom_pays'];?></option>
											<?php }?>
											</select>
										</div>
									</div>
									<div class="form-row mt-2">
										<div class="form-group col-md-6">
											<label>Ville (facultatif)</label>
											<input type="text" name="ville" value="<?php echo $details_commande['ville'];?>" class="form-control">
										</div>
										<div class="form-group col-md-6">
											<label>Région (facultatif)</label>
											<input type="text" name="region" value="<?php echo $details_commande['region'];?>" class="form-control">
										</div>
									</div>
							
									<div class="form-row mt-2">
										<div class="form-group col-md-6">
											<label>Code postal (facultatif)</label>
											<input type="text" name="code_postal" value="<?php echo $details_commande['code_postal'];?>" class="form-control">
										</div>
										<div class="form-group col-md-6">
											<label>Numéro TVA (facultatif)</label>
											<input type="text" name="num_TVA" value="<?php echo $details_commande['num_TVA'];?>" class="form-control">
										</div>
									</div>
									
									<div class="form-row mt-2">
										<div class="form-group col-md-6">
											<label>CODE PROMO</label>
											<input type="text" name="code_promo" value="<?php echo $details_commande['code_promo'];?>" class="form-control">
										</div>
									</div>
									<div class="form-row mt-2">
										<div class="form-group col-md-6">
											<label>Moyen de paiement</label>
											<input type="hidden" id="id_paiement_choix" name="id_paiement_choix" value="<?php echo $details_commande['id_type_paiement'];?>" class="form-control">
											<select name="id_type_paiement" id="id_type_paiement" class="choix_paiement form-control">
											<?php for($k=0 ; $k<count($type_paiement) ; $k++){?>
												<option value="<?php echo $type_paiement[$k]['id_type_paiement'];?>">
													<?php echo $type_paiement[$k]['type_paiement'];?>
												</option>
											<?php }?>
											</select>
										</div>
									</div>
									<div class="form-row mt-2">
										<div class="form-group col-md-3">	
											<input type="submit" class="btn btn-success" value="Enregistrer">
										</div>
									</div>
								</div>
								

								
							</div>								
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

	<script type="text/javascript">
		$(function()
		{
			$("#id_tarif,#nb_mot").change(function()
			{
				var selected = $("#id_tarif option:selected").val().split("|")[1];
				console.log(selected);
				$("#prix_prestation").val(selected * $('#nb_mot').val());
			}
			)
		}
		);

		var elt_tarif = document.querySelector(".choix_tarif");
		elt_tarif.value = $('#id_tarif_choix').val() ;

		var elt_langue = document.querySelector(".choix_langue");
		elt_langue.value = $('#id_langue_choix').val() ;

		var elt_paiement = document.querySelector(".choix_paiement");
		elt_paiement.value = $('#id_paiement_choix').val() ;

		var elt_pays = document.querySelector(".choix_pays");
		elt_pays.value = $('#nom_pays_choix').val() ;

</script>
</html>