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
						<?php echo $this->session->flashdata( 'message' ) ;?>
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
					<?php if( $details_commande['id_etat_commande'] == 1 || $details_commande['id_etat_commande'] == 2 ) { ?>
						<a href="<?php echo site_url('Client/annuler_commande/'.$details_commande['id_commande'] );?>" class="btn btn-danger">Annuler cette commande</a>				
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
							
					  			<dt class="col-sm-3">Titre</dt>
				  				<dd class="col-sm-9"><?php echo $details_commande['titre_commande'];?></dd>
							
					  			<dt class="col-sm-3">Mot clé</dt>
				  				<dd class="col-sm-9"><pre><?php echo $details_commande['mot_cle'];?></pre></dd>
							
					  			<dt class="col-sm-3">Remarque (Instruction)</dt>
					  			<dd class="col-sm-9"><pre><?php echo $details_commande['remarque'];?></pre></dd>
							</dl>
						</div>
						<div class="col-md-6">
				  			<dl class="row">
								<dt class="col-sm-3">Type de paiement</dt>
					  			<dd class="col-sm-9"><pre><?php echo $details_commande['type_paiement'];?></pre></dd>
				  			</dl>
						</div>
					</div>
				</fieldset>

				<?php if( count((array)$facture) > 0 ) { ?>
				<a href="<?php echo site_url('Client/details_facture/'.$facture['id_facture']);?>" class="btn btn-primary">Voir la facture</a>				
				<?php } ?>
				<hr>

				<form action="<?php echo site_url('Client/commenter');?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="id_commande" value="<?php echo $details_commande['id_commande'];?>" class="form-control">
					<div class="form-row">
						<div class="form-group col-md-12">
							<label><h4>Commenter</h4></label>
							<textarea name="commentaire" class="form-control mb-2" rows="5"></textarea>
							<input type="file" name="fichier">
						</div>
					</div>
					<input type="submit" class="btn btn-secondary">
				</form>

				<h4>
					<?php if( count($commentaires) > 0 ) { ?>
					<button onclick="open_form_motif( 'coms' )" class="btn btn-white mt-4">
						Voir les commentaires<span class="badge rounded-pill bg-success ml-2"><?php echo count($commentaires) ;?></span>
					</button>
					<?php } ?>
				</h4>

				<div id="coms" class="clps">	
					<button onclick="close_form_motif( 'coms' )" class="btn btn-white mt-4 mb-4 float-left">							
						<i class="fa fa-close fa-2x" style="color:black;"></i>
					</button>

					<div class="card p-2 bg-light"> 

						<div class="row"> 
							<?php for($i=0 ; $i<count($commentaires) ; $i++) {?>	
								<?php if( $commentaires[$i]['id_user_type'] == 1 ) {?>
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
								<div class="col-md-6"></div>
								<?php } elseif( $commentaires[$i]['id_user_type'] == 2 ) { ?>	
								<div class="col-md-6"></div>
								<div class="col-md-6">
											<h5><?php echo $commentaires[$i]['nom_user']." - ".$commentaires[$i]['date_commentaire'];?></h5>
											<ul class="list-group mb-2">									
												<li class="list-group-item bg-primary text-white">
													<h6>
														<pre class="text-white"><?php echo $commentaires[$i]['commentaire'] ;?></pre>
														<a onclick="open_form_motif( 'option<?php echo $commentaires[$i]['id_commentaire'] ;?>' )"  class="float-right mt-3">
														<button class="btn"><i class="fa fa-ellipsis-v"></i></button>
														</a>
													</h6>											
													<hr>
													Fichier:
													<h6>
														<a class="text-dark" href="<?php echo site_url('uploads/'.$commentaires[$i]['fichier'])?>"
														 download="<?php echo $commentaires[$i]['fichier'] ;?>" >
															<?php echo $commentaires[$i]['fichier'] ;?>
														</a>
													</h6>

													<div id="option<?php echo $commentaires[$i]['id_commentaire'] ;?>" class="clps">
														<a class="text-dark mt-3" href="<?php echo site_url('client/effacer_commentaire/'.$commentaires[$i]['id_commentaire'].'/'.$commentaires[$i]['id_commande']); ?>">
															<i class="fa fa-trash-o"></i>
														</a>
														<a class="text-dark ml-3 mt-3" href="<?php echo site_url('client/modification_commentaire/'.$commentaires[$i]['id_commentaire']); ?>">
															<i class="fa fa-edit"></i>
														</a>				
														<a onclick="close_form_motif( 'option<?php echo $commentaires[$i]['id_commentaire'] ;?>' )"  class="float-right mt-3">
															<button class="btn"><i class="fa fa-angle-up"></i></button>
														</a>								
													</div>

												</li>								  	
											</ul>
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
</html>