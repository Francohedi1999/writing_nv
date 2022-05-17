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

		<div  id="navigation" class="navigation">
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

					<h3>
						<img src="<?php echo site_url('assets/images/user.png')?>" alt="" class="rounded-circle" style="width:120px; height:120px;">
						<?php echo $client['nom_user']." - ".$client['mail_user'];?>
					</h3>
					<hr>
					<div class="row">
						<div class="col-md-6">
								<h6 class="mt-3"><?php echo $client['banni'];?></h6>
					
							<?php if( $client['is_fidele'] == 0 ) { ?>
								<h6 class="mt-3"><?php echo $client['fidele'];?></h6>
								<h6 class="mt-3"><?php echo "Réduction: -".round( 0 , 2 )." %";?></h6>
							<?php } elseif( $client['is_fidele'] == 1 ) { ?>
								<h6 class="mt-3"><?php echo $client['fidele'];?></h6>
								<h6 class="mt-3"><?php echo "Réduction: -".round($client['reduction_fidelite'] , 2 )." %";?></h6>
							<?php }?>	
							
						</div>
						<div class="col-md-6">

							<?php if( $client['is_banni'] == 0 ) { ?>

							<button onclick="open_form_motif( 'md' )" class="mt-2 btn btn-light text-decoration-none text-danger">
								<i class="fa fa-close" style="color:red;"></i>
								Désactiver
							</button><br>

							<div id="md" class="md p-2">
								<div class="card p-2">
									<form action="<?php echo site_url('Admin/bannir');?>" method="post" enctype="multipart/form-data">
										<label>Motif</label>
										<input type="hidden" name="id_user" value="<?php echo $client['id_user'];?>" class="form-control">
	                   					<input type="hidden" name="banni" value="<?php echo $client['is_banni'];?>">
										<div class="form-row">
											<div class="form-group col-md-12">
												<textarea name="motif" class="form-control mb-2" rows="5"></textarea>
											</div>
										</div>
										<input type="submit" value="Envoyer" class="mt-2 btn btn-secondary">
									</form>
								</div>
								<a onclick="close_form_motif( 'md' )">
									<i class="fa fa-angle-up fa-2x" style="color:black;"></i>
								</a>
							</div>

							<?php if( $client['is_fidele'] == 1 ) { ?>				
							<a class="mt-2 btn btn-light text-decoration-none" href="<?php echo site_url( 'Admin/reduction_client/'.$client['id_user'] );?>">	
								<i class="fa fa-edit" style="color:black;"></i>
								Modifier réduction
							</a><br>
							<a class="btn btn-danger mt-2" href="<?php echo site_url( 'Admin/donner_fidelite/'.$client['id_user'].'/'.$client['is_fidele'] );?>">	
								Retirer badge
							</a>						
							<?php } elseif( $client['is_fidele'] == 0 ) { ?>
							<a class="btn btn-success mt-2" href="<?php echo site_url( 'Admin/donner_fidelite/'.$client['id_user'].'/'.$client['is_fidele'] );?>">	
								Donner badge
							</a>
							<?php }?>	

							<?php } elseif( $client['is_banni'] == 1 ) { ?>
							<form class=" mt-4" action="<?php echo site_url('Admin/bannir');?>" method="post">
								<input type="hidden" name="id_user" value="<?php echo $client['id_user'];?>" class="form-control">
							 	<input type="hidden" name="banni" value="<?php echo $client['is_banni'];?>">
							   	<button type="submit" class="mt-2 btn btn-light text-decoration-none text-success">
							    	<i class="fa fa-check" style="color:green;"></i>
							    	Activer 
								</button>
							</form>
							<?php }?>
							
						</div>
					</div>
					

					
					<hr>
					<h2><p>Informations</p></h2>

					<?php if($compte_info > 0) { ?>
					<div class="row">

						<div class="col-md-6">
							<dl class="row">
								<dt class="col-sm-3">Entreprise:</dt>
								<dd class="col-sm-9"><?php echo $user_info['nom_entreprise'];?></dd>
							</dl>
							<dl class="row">
								<dt class="col-sm-3">Lieu:</dt>
								<dd class="col-sm-9"><?php echo $user_info['adresse'];?></dd>
							</dl>
							<dl class="row">
								<dt class="col-sm-3">Adresse email:</dt>
								<dd class="col-sm-9"><?php echo $user['mail_user'];?></dd>
							</dl>
						</div>	

						<div class="col-md-6">
							<dl class="row">
								<dt class="col-sm-3">Pays:</dt>
								<dd class="col-sm-9"><?php echo $user_info['nom_pays'];?></dd>
							</dl>
							<dl class="row">
								<dt class="col-sm-3">Ville:</dt>
								<dd class="col-sm-9"><?php echo $user_info['ville'];?></dd>
							</dl>
							<dl class="row">
								<dt class="col-sm-3">Region:</dt>
								<dd class="col-sm-9"><?php echo $user_info['region'];?></dd>
							</dl>
							<dl class="row">
								<dt class="col-sm-3">Code postal:</dt>
								<dd class="col-sm-9"><?php echo $user_info['code_postal'];?></dd>
							</dl>
							<dl class="row">
								<dt class="col-sm-3">Numero TVA:</dt>
								<dd class="col-sm-9"><?php echo $user_info['num_TVA'];?></dd>
							</dl>
						</div>

					</div>							
							
				<?php } elseif ($compte_info == 0) { ?>
					<div class="row">

						<div class="col-md-6">
							<dl class="row">
								<dt class="col-sm-3">Entreprise:</dt>
								<dd class="col-sm-9"></dd>
							</dl>
							<dl class="row">
								<dt class="col-sm-3">Lieu:</dt>
								<dd class="col-sm-9"></dd>
							</dl>
							<dl class="row">
								<dt class="col-sm-3">Adresse email:</dt>
								<dd class="col-sm-9"></dd>
							</dl>
						</div>	

						<div class="col-md-6">
							<dl class="row">
								<dt class="col-sm-3">Pays:</dt>
								<dd class="col-sm-9"></dd>
							</dl>
							<dl class="row">
								<dt class="col-sm-3">Ville:</dt>
								<dd class="col-sm-9"></dd>
							</dl>
							<dl class="row">
								<dt class="col-sm-3">Region:</dt>
								<dd class="col-sm-9"></dd>
							</dl>
							<dl class="row">
								<dt class="col-sm-3">Code postal:</dt>
								<dd class="col-sm-9"></dd>
							</dl>
							<dl class="row">
								<dt class="col-sm-3">Numero TVA:</dt>
								<dd class="col-sm-9"></dd>
							</dl>
						</div>

					</div>	
				<?php } ?>	
			
				<hr>

			<h2><p>Commandes</p></h2>
			<table class="table table-bordered mb-4">
				<tbody>
			 		<tr>
			 			<th class="table-secondary" >Etat</th>
				  		<th class="table-secondary" >Nombre de commande</th>
				  		<th class="table-secondary" ></th>
					</tr>
					<?php for($i = 0 ; $i<count($nb_commande_user) ; $i++) { ?>
					<tr>								    	
						<td><?php echo $nb_commande_user[$i]['etat_commande'] ;?></td>
						<td><?php echo $nb_commande_user[$i]['nb_commande'] ;?></td>
					    <td>
						    <a href="<?php echo site_url('Admin/client_commandes/'.$nb_commande_user[$i]['id_user']."/".$nb_commande_user[$i]['id_etat_commande']);?>" class="btn btn-outline-primary">
								Voir
							</a>
						</td>								       
					</tr>
					<?php }?>
				</tbody>
			</table>				
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