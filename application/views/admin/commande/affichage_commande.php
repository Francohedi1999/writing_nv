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

		<div class="contenu">
			<div class="p-2">
                
				<?php if( $this->session->flashdata( 'message' ) ) { ?>
				<p class="message alert alert-success" role="alert">
					<?php echo $this->session->flashdata( 'message' );?>
				</p> 
				<?php } ?>

				<fieldset>
					<legend>
						<dl class="row">
								<dt class="col-sm-6">Commande n°</dt>
					  		<dd class="col-sm-6"><?php echo $details_commande['id_commande'];?></dd>

					  		<dt class="col-sm-6">Date de commande</dt>
					  		<dd class="col-sm-6"><?php echo $details_commande['date_commande'];?></dd>

								<dt class="col-sm-6">Date de commencement</dt>
					  		<dd class="col-sm-6"><?php echo $details_commande['date_commencement'];?></dd>	

					  		<dt class="col-sm-6">Date de livraison</dt>
					  		<dd class="col-sm-6"><?php echo $details_commande['date_livraison'];?></dd>					  		

					  		<dt class="col-sm-6">Etat</dt>
					  		<dd class="col-sm-6"><?php echo $details_commande['etat_commande'];?></dd>
				  		</dl>
					</legend>

										<?php if( count((array)$facture) > 0 && $facture['payee'] == 0 ) { ?>

                    	<p class="alert alert-danger" role="alert">
                    		La facture de cette commande n' est pas encore payée
                    	</p>
                    
                    <?php } elseif( count((array)$facture) > 0 && $facture['payee'] == 1 )  { ?>
                    
                    	<?php if( $details_commande['id_etat_commande'] == 2 ) { ?>

                    	<form method="post" action="<?php echo site_url('Admin/update_etat_commande');?>">
                    		<div class="form-row">
                    			<div class="form-group col-md-2 mr-2">
                    				<input type="hidden" id="id_commande" name="id_commande" value="<?php echo $details_commande['id_commande'];?>">
                    				<input type="hidden" id="id_etat_commande" name="id_etat_commande" value="3">
                    				<input type="submit" class="btn btn-success" value="Mettre en cours">
                    			</div>
                    		</div>
                    	</form>

                    	<?php } elseif( $details_commande['id_etat_commande'] == 3 ) { ?>

                    	<?php if( $this->session->flashdata( 'com_vide' ) ) { ?>
											<p class="message alert alert-danger" role="alert">
												<?php echo $this->session->flashdata( 'com_vide' );?>
											</p> 
											<?php } ?>

                    	<button onclick="open_form_motif( 'livraison' )" class="btn btn-success">Livrer</button>

											<div id="livraison" class="livraison p-2">

												<div class="card p-2">
													<form action="<?php echo site_url('Admin/update_etat_commande');?>" method="post" enctype="multipart/form-data">
														<input type="hidden" name="id_commande" value="<?php echo $details_commande['id_commande'];?>" class="form-control">
	                    			<input type="hidden" name="id_etat_commande" value="4">
															<div class="form-row">
																<div class="form-group col-md-12">
																	<textarea name="commentaire" class="form-control mb-2" rows="5" placeholder="Commentaire..."></textarea>
																	<input type="file" name="fichier">
																</div>
															</div>
														<input type="submit" value="Envoyer la livraison" class="btn btn-secondary">
													</form>
												</div>

												<a onclick="close_form_motif( 'livraison' )">
													<i class="fa fa-angle-up">
												</a>

											</div>
                    	

                    	<?php } elseif( $details_commande['id_etat_commande'] == 4 || $details_commande['id_etat_commande'] == 5 ) { ?>

                    	<?php } ?>

                    <?php } ?>


                    	<?php if( $details_commande['id_etat_commande'] == 1 ) { ?>

                    	<form method="post" action="<?php echo site_url('Admin/update_etat_commande');?>">
                    		<div class="form-row">
                    			<div class="form-group col-md-2 mr-2">
                    				<input type="hidden" id="id_commande" name="id_commande" value="<?php echo $details_commande['id_commande'];?>">
                    				<input type="hidden" id="id_etat_commande" name="id_etat_commande" value="2">
                    				<input type="submit" class="btn btn-success" value="Valider">
                    			</div>
                    		</div>
                    	</form>

                    	<button onclick="open_form_motif( 'clps' )" class="btn btn-danger">Echouer</button>

                    	<div id="clps" class="clps mt-2">
												<form method="post" action="<?php echo site_url('Admin/update_etat_commande');?>">
		                   		<div class="form-row">
		                   			<div class="form-group col-md-12">
		                   				<label>Motif</label>
		                   				<input type="hidden" id="id_commande" name="id_commande" value="<?php echo $details_commande['id_commande'];?>">
		                   				<input type="hidden" id="id_etat_commande" name="id_etat_commande" value="5">
		                   				<textarea id="message_motif" name="message_motif" class="form-control" rows="5"></textarea>
		                   				<input type="submit" class="btn btn-secondary mt-2" value="Envoyer">
		                   			</div>
		                   		</div>
		                   	</form>
		                   	<a onclick="close_form_motif( 'clps' )" class="btn">
		                   		<img src="<?php echo site_url('assets/images/close_b.png')?>" width="20px" height="20px">
		                   		Annuler
		                   	</a>
											</div>

                    	<?php } ?>
                   
					<hr>
						<div class="row">
							<div class="col-md-6">
								<dl class="row">
						  			<dt class="col-sm-3">Type de rédacteur</dt>
						  			<dd class="col-sm-9"><?php echo $details_commande['type_redacteur'];?></dd>

							  		<dt class="col-sm-3">Type de texte</dt>
							  		<dd class="col-sm-9"><?php echo $details_commande['type_text'];?></dd>

							  		<dt class="col-sm-3">Langue</dt>
						  			<dd class="col-sm-9"><?php echo $details_commande['langue_text'];?></dd>

						  			<dt class="col-sm-3">Nombre de mot</dt>
						  			<dd class="col-sm-9"><?php echo $details_commande['nb_mot'];?></dd>

						  			<dt class="col-sm-3">Titre</dt>
						  			<dd class="col-sm-9"><?php echo $details_commande['titre_commande'];?></dd>

						  			<dt class="col-sm-3">Mot clé</dt>
						  			<dd class="col-sm-9"></pre><?php echo $details_commande['mot_cle'];?><pre></dd>

						  			<dt class="col-sm-3">Remarque (Instruction)</dt>
						  			<dd class="col-sm-9"></pre><?php echo $details_commande['remarque'];?><pre></dd>

						  			<dt class="col-sm-3">Prix total</dt>
						  			<dd class="col-sm-9"><?php echo round($details_commande['prix_prestation'] , 2)." Ar";?></dd>
								</dl>
							</div>
							<div class="col-md-6">
								<dl class="row">
						  			<dt class="col-sm-3">Type de paiement</dt>
						  			<dd class="col-sm-9"><?php echo $details_commande['type_paiement'];?></dd>
								</dl>
							</div>
						</div>
				</fieldset>
				
					<?php if( count((array)$facture) > 0 ) { ?>
						<a href="<?php echo site_url('Admin/details_facture/'.$facture['id_facture']);?>" class="btn btn-primary">Voir la facture</a>
						<hr>
					<?php } ?>

					<h3 class="mt-4">Commentaire</h3>
					<form action="<?php echo site_url('Admin/commenter');?>" method="post" enctype="multipart/form-data">
						<input type="hidden" name="id_commande" value="<?php echo $details_commande['id_commande'];?>" class="form-control">

							<div class="form-row">
								<div class="form-group col-md-6 mt-4">
									<label>Moyen de paiement</label>									
									<select name="id_type_paiement" id="id_type_paiement" class="form-control">
										<?php for($k=0 ; $k<count($type_paiement) ; $k++){?>
											<option value="<?php echo $type_paiement[$k]['desc_type_paiement'];?>">
											<?php echo $type_paiement[$k]['type_paiement'];?>
											</option>
										<?php }?>
									</select>
								</div>	
							</div>

							<div class="form-row">
								<div class="form-group col-md-12">
									<label>Commentaire</label>
									<textarea name="commentaire" id="commentaire" class="form-control mb-2" rows="5"></textarea>
									<input type="file" name="fichier">
								</div>
							</div>	

						<input type="submit" class="btn btn-secondary">
					</form>
					<?php if( count($commentaires) > 0 ) { ?>
					<h4>
						<button onclick="open_form_motif( 'coms' )" class="btn btn-white mt-4">
							Voir les commentaires<span class="badge rounded-pill bg-success ml-2"><?php echo count($commentaires) ;?></span>
						</button>
					</h4>
					<?php } ?>
					
					<div id="coms" class="clps">

						<button onclick="close_form_motif( 'coms' )" class="btn btn-white mt-4 mb-4 float-left">							
							<i class="fa fa-close fa-2x" style="color:black;"></i>
						</button>

						<div class="card p-2 bg-light"> 

							<div class="row"> 

								<?php for($i=0 ; $i<count($commentaires) ; $i++) {?>	
								<?php if( $commentaires[$i]['id_user_type'] == 1 ) {?>

									<div class="col-md-6">							
									</div>

									<div class="col-md-6">
										<h5><?php echo $commentaires[$i]['nom_user']." - ".$commentaires[$i]['date_commentaire'];?></h5>
										<ul class="list-group mb-2">									
											<li class="list-group-item bg-primary text-white">
												<h6>
													<pre class="text-white"><?php echo $commentaires[$i]['commentaire'] ;?></pre>
													<a onclick="open_form_motif( 'option<?php echo $commentaires[$i]['id_commentaire'] ;?>' )" class="float-right mt-3">
													<i class="fa fa-ellipsis-v"></i>
													</a>
												</h6>		
												<hr>									
												Fichier:
												<h6>
													<a class="text-white" href="<?php echo site_url('uploads/'.$commentaires[$i]['fichier'])?>"
													 download="<?php echo $commentaires[$i]['fichier'] ;?>" >
														<?php echo $commentaires[$i]['fichier'] ;?>
													</a>
												</h6>

												<div id="option<?php echo $commentaires[$i]['id_commentaire'] ;?>" class="clps">
													<a class="text-dark mt-3" href="<?php echo site_url('Admin/effacer_commentaire/'.$commentaires[$i]['id_commentaire'].'/'.$commentaires[$i]['id_commande']); ?>">
														<i class="fa fa-trash-o"></i>
													</a>
													<a class="text-dark ml-3 mt-3" href="<?php echo site_url('Admin/modification_commentaire/'.$commentaires[$i]['id_commentaire']); ?>">
														<i class="fa fa-edit"></i>
													</a>				
													<a onclick="close_form_motif( 'option<?php echo $commentaires[$i]['id_commentaire'] ;?>' )"  class="float-right mt-3">
														<i class="fa fa-angle-up"></i>
													</a>								
												</div>

											</li>								  	
										</ul>
									</div>

								<?php } elseif( $commentaires[$i]['id_user_type'] == 2 ) { ?>

									<div class="col-md-6">	
										<h5><?php echo $commentaires[$i]['nom_user']." - ".$commentaires[$i]['date_commentaire'];?></h5>						
										<ul class="list-group mb-2">									
											<li class="list-group-item" style="background-color: #d3d3d3;">
												<h6><pre><?php echo $commentaires[$i]['commentaire'] ;?></pre></h6>
												<hr>
												Fichier:
												<h6>
													<a class="text-dark" href="<?php echo site_url('uploads/'.$commentaires[$i]['fichier'])?>"
													 download="<?php echo $commentaires[$i]['fichier'] ;?>" >
														<?php echo $commentaires[$i]['fichier'] ;?>
													</a>
												</h6>		 
											</li>								  	
										</ul>
									</div>

									<div class="col-md-6">							
									</div>

								<?php }?>
								<?php }?>
							</div>
							
						</div>

					</div>
							
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
<script>
	
$(function()
	{
		$("#id_type_paiement").change(function()
		{
			var selected = $("#id_type_paiement option:selected").val();
			console.log(selected);
			$("#commentaire").val(selected);
		}
		)
	}
	);

</script>
</html>