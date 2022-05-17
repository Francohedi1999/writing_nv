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
					<?php } elseif( $this->session->flashdata( 'message_annulee' ) ) { ?>
					<p class="message alert alert-danger" role="alert">
						<?php echo $this->session->flashdata( 'message_annulee' );?>	
					</p>
					<?php } ?>
					
					<h4 align="center" class="mt-3 mb-3">Mes commandes</h4>	
					<hr>
	      			<form class="container-fluid mt-2" method="post" action="<?php echo site_url('Client/commandes/');?>">
					    <div class="form-row">
	      					<div class="form-group col-md-2">
							</div>
						    <div class="input-group form-group col-md-8">
						    	Recherche
							    <div class="input-group">     
							      	<input type="text" class="form-control" name="titre_commande" id="titre_commande" placeholder="Titre" aria-label="Titre" aria-describedby="basic-addon1">
							     	<button class="btn btn-outline-light pl-2 pr-2"><i class="fa fa-search" style="color:black;"></i></button>
							    </div>
						    </div>
						    <div class="form-group col-md-2">
							</div>
					    </div>
					</form>

					<form class="container-fluid mt-4" method="post" action="<?php echo site_url('Client/commandes/');?>">
						<?php if( $this->session->flashdata( 'date_invalid' ) ) { ?>
							<div class="form-row">
								<p class="alert alert-danger" role="alert">
									<?php echo $this->session->flashdata( 'date_invalid' );?>	
								</p>
							</div>
						<?php } ?>
						<div class="form-row">
							<div class="form-group col-md-2">
							</div>
							<div class="form-group col-md-2">
								Commandes du
								<input type="date" name="date_commande_1" class="form-control">
								<span><?php echo form_error('date_commande_1' , '<p class="text-danger">' , '</p>'); ?></span>
							</div>
							<div class="form-group col-md-2">
								au
								<input type="date" name="date_commande_2" class="form-control">
							</div>
							<div class="form-group col-md-2">
								filtrer par
								<select name="filtre" class="form-control">
								    <option value="id_commande">Date de commande</option>
								    <option value="id_etat_commande">Etat</option>
								</select>
							</div>
							<div class="form-group col-md-2">
								ordre
								<select name="ordre" class="form-control">
								    <option value="desc">Décroissant</option>
								    <option value="asc">Croissant</option>
								</select>
							</div>		
							<div class="form-group col-md-2">
							</div>					
						</div>
						<div class="form-row">
							<div class="form-group col-md-2">
							</div>
							<div class="form-group col-md-3">
								<input type="submit" name="afficher" value="Afficher" class="btn btn-secondary">
							</div>
						</div>
					</form>

					<table class="table table-bordered mt-3">
						<thead class="table-secondary">
						    <tr>
						        <th scope="col" width="100">n°</th>
						        <th scope="col" width="250">Titre</th>
						        <th scope="col" width="200">Date de commande</th>
						        <th scope="col" width="200">Date de commencement</th>
						        <th scope="col" width="200">Date de livraison</th>
						        <th scope="col" width="300">Etat</th>
						        <th scope="col" width="100"></th>
						    </tr>
					   	</thead>
					    <tbody>
						    <?php for($i=0 ; $i<count($commandes) ; $i++) {?>
						    <tr>
						    	<th><?php echo $commandes[$i]['id_commande'] ;?></th>	
    						    <td><?php echo $commandes[$i]['titre_commande'] ;?></td>
						        <td><?php echo $commandes[$i]['date_commande'] ;?></td>
						        <td><?php echo $commandes[$i]['date_commencement'] ;?></td>
						        <td><?php echo $commandes[$i]['date_livraison'] ;?></td>
						        <td><?php echo $commandes[$i]['etat_commande'] ;?></td>
						        <td>
									<a href="<?php echo site_url('Client/details_commande/'.$commandes[$i]['id_commande']);?>" class="btn btn-outline-primary">
										Voir
									</a>
								</td>	
						    </tr>
							<?php }?>
						</tbody>
					</table>

					<nav aria-label="Page navigation example">
				  		<ul class="pagination">
						<?php for($e=1 ; $e<=$nb_pages ; $e++) {?>	
					   		<li class="page-item"><a class="page-link" href="<?php echo site_url('Client/commandes/'.$e);?>"><?php echo $e; ?></a></li>
				  		<?php }?>
				  		</ul>
				  	</nav>
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