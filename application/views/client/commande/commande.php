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
				
				<form method="post" action="<?php echo site_url('Client/commande'); ?>">
					<div class="row">
						<!-- Commande -->
						<div class="col-md-6">
							<h3 align="center">Commande</h3>											
							<hr>
							<div class="form-row mt-2">
								<div class="form-group col-md-12">
									<label>Type de texte</label>
									<select name="id_tarif" id="id_tarif" class="form-control">
									<?php for($i=0 ; $i<count($tarifs) ; $i++){?>
										<option value="<?php echo $tarifs[$i]['id_tarif']."|".$tarifs[$i]['prix_par_mot'] ;?>">
										<?php echo $tarifs[$i]['type_redacteur']." - ".$tarifs[$i]['type_text'];?>
										</option>
									<?php }?>
									</select>
									<span><?php echo form_error('id_tarif' , '<p class="text-danger">' , '</p>'); ?></span>
								</div>
							</div>
							<div class="form-row mt-2">
								<div class="form-group col-md-12">
									<label>Titre</label>
									<input type="text" name="titre_commande" class="form-control">
									<span><?php echo form_error('titre_commande' , '<p class="text-danger">' , '</p>'); ?></span>
								</div>
							</div>
							<div class="form-row mt-2">
								<div class="form-group col-md-12">
									<label>Langue</label>
									<select name="id_langue_text" class="form-control">
									<?php for($j=0 ; $j<count($langues_text) ; $j++){?>
										<option value="<?php echo $langues_text[$j]['id_langue_text'];?>">
											<?php echo $langues_text[$j]['langue_text'];?>
										</option>
									<?php }?>
									</select>
								</div>
							</div>
							<div class="form-row mt-2">
								<div class="form-group col-md-6">
									<label>Nombre de mot</label>
									<input type="number" name="nb_mot" id="nb_mot" class="form-control">
									<span><?php echo form_error('nb_mot' , '<p class="text-danger">' , '</p>'); ?></span>
								</div>
								<div class="form-group col-md-6">
									<label>PRIX (en Ariary)</label>
									<input type="number" step="0.00000001" name="prix_prestation" id="prix_prestation" class="form-control" disabled>
								</div>
							</div>
							<div class="form-row mt-2">
								<div class="form-group col-md-12">
									<label>Mot clé</label>
									<textarea name="mot_cle" class="form-control" rows="5"></textarea>
									<span><?php echo form_error('mot_cle' , '<p class="text-danger">' , '</p>'); ?></span>
								</div>
							</div>
							<div class="form-row mt-2">
								<div class="form-group col-md-12">
									<label>Remarque ou instruction (facultatif)</label>
									<textarea name="remarque" class="form-control" rows="5"></textarea>
								</div>
							</div>
						</div>
						<!-- Facture -->
						<div class="vl col-md-6">
							<h3 align="center">Facturation</h3>
							<hr>					
							<div class="form-row mt-2">
							<?php if( $compte_info >= 1 ) { ?>
								<div class="form-group col-md-12">
									<label>Entreprise (facultatif)</label>
									<input type="text" name="nom_entreprise" class="form-control" value="<?php echo $info_user['nom_entreprise']; ?>">
								</div>
							</div>
							<div class="form-row mt-2">
								<div class="form-group col-md-12">
									<label>Adresse (facultatif)</label>
									<input type="text" name="adresse" class="form-control" value="<?php echo $info_user['adresse']; ?>">
								</div>
							</div>
							<div class="form-row mt-2">
								<div class="form-group col-md-12">
									<label>Pays (facultatif)</label>
									<input type="hidden" id="nom_pays_choix" name="nom_pays_choix" class="form-control" value="<?php echo $info_user['nom_pays']; ?>">
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
									<input type="text" name="ville" class="form-control" value="<?php echo $info_user['ville']; ?>">
								</div>
								<div class="form-group col-md-6">
									<label>Région (facultatif)</label>
									<input type="text" name="region" class="form-control" value="<?php echo $info_user['region']; ?>">
								</div>
							</div>
							<div class="form-row mt-2">
								<div class="form-group col-md-6">
									<label>Code postal (facultatif)</label>
									<input type="text" name="code_postal" class="form-control" value="<?php echo $info_user['code_postal']; ?>">
								</div>
								<div class="form-group col-md-6">
									<label>Numero TVA (facultatif)</label>
									<input type="text" name="num_TVA" class="form-control" value="<?php echo $info_user['num_TVA']; ?>">
								</div>
							</div>
							<?php } elseif( $compte_info == 0 ) { ?>
								<div class="form-group col-md-12">
									<label>Entreprise (facultatif)</label>
									<input type="text" name="nom_entreprise" class="form-control">
								</div>
							</div>
							<div class="form-row mt-2">
								<div class="form-group col-md-12">
									<label>Adresse (facultatif)</label>
									<input type="text" name="adresse" class="form-control">
								</div>
							</div>
							<div class="form-row mt-2">
								<div class="form-group col-md-12">
									<label>Pays (facultatif)</label>
									<?php if( isset($info_user['nom_pays']) ) {?>
									<input type="hidden" id="nom_pays_choix" name="nom_pays_choix" class="form-control" value="<?php echo $info_user['nom_pays']; ?>">
									<?php }?>
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
									<input type="text" name="ville" class="form-control">
								</div>
								<div class="form-group col-md-6">
									<label>Région (facultatif)</label>
									<input type="text" name="region" class="form-control">
								</div>
							</div>
							<div class="form-row mt-2">
								<div class="form-group col-md-6">
									<label>Code postal (facultatif)</label>
									<input type="text" name="code_postal" class="form-control">
								</div>
								<div class="form-group col-md-6">
									<label>Numero TVA (facultatif)</label>
									<input type="text" name="num_TVA" class="form-control">
								</div>
							</div>
							<?php }?>
							<div class="form-row mt-2">
								<div class="form-group col-md-6">					
									<label>CODE PROMO</label>
									<input type="text" name="code_promo" class="form-control">			
								</div>							
							</div>
							<div class="form-row mt-2">
								<div class="form-group col-md-6">
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
							<div class="form-row mt-2">
								<div class="form-group col-md-6">	
									<input type="submit" class="btn btn-success" value="Suivant">
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

	var elt_pays = document.querySelector(".choix_pays");
	elt_pays.value = $('#nom_pays_choix').val() ;

</script>
</html>