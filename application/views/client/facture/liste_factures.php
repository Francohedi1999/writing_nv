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
						
				<h4 align="center" class="mt-3 mb-3">Mes factures</h4>
				<hr>
				<form class="container-fluid mt-4" method="post" action="<?php echo site_url('Client/factures/');?>">
				   	<div class="form-row">
						<div class="form-group col-md-3">
						</div>
						<div class="form-group col-md-3">
							<label>Filtrer par</label>
							<select name="filtre" class="form-control">
							    <option value="id_facture">Date de facturation</option>
							    <option value="prix_prestation">Prix de prestation</option>
							</select>
						</div>
						<div class="form-group col-md-3">
							<label>ordre</label>
							<select name="ordre" class="form-control">
							    <option value="desc">Décroissant</option>
							    <option value="asc">Croissant</option>
							</select>
						</div>
						<div class="form-group col-md-3">
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-3">
						</div>
						<div class="form-group col-md-3">
							<label></label>
							<input type="submit" value="Afficher" class="btn btn-secondary"/>
						</div>
					</div>
				</form>

				<table class="table table-bordered mt-3">
					<thead class="table-secondary">
				    	<tr>
				      		<th scope="col" width="100">n°</th>
				      		<th scope="col" width="300">Paiement</th>
				   	   		<th scope="col" width="100">Etat</th>
				    		<th scope="col" width="100">Prix de prestation</th>
							<th scope="col" width="100">Date de facturation</th>
				    		<th scope="col" width="50"></th>
				    	</tr>
					</thead>
					<tbody>
						<?php for($i=0 ; $i<count($factures) ; $i++) {?>
						<tr>
						   	<th><?php echo $factures[$i]['id_facture'] ;?></th>	
	    				    <td><?php echo $factures[$i]['type_paiement'] ;?></td>
						    <td><?php echo $factures[$i]['etat_facture'] ;?></td>
						    <td><?php echo round($factures[$i]['prix_prestation'] , 2) ;?></td>
						    <td><?php echo $factures[$i]['date_facturation'] ;?></td>
						    <td>
						    	<a href="<?php echo site_url('Client/details_facture/'.$factures[$i]['id_facture'] );?>" class="btn btn-outline-primary">
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
			    		<li class="page-item"><a class="page-link" href="<?php echo site_url('Client/factures/'.$e);?>"><?php echo $e; ?></a></li>
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