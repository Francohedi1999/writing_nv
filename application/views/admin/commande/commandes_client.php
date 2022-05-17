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
					<h4 align="center" class="mt-2 mb-3">Commandes<?php echo "<br>(".$titre_etat_commande.")" ;?></h4>

	      			<form class="container-fluid mt-2" method="post" action="<?php echo site_url('Admin/client_commandes/'.$id_user."/".$id_etat_commande);?>">
					    <div class="input-group">      
					      	<input type="text" class="form-control col-md-11" name="titre_commande" id="titre_commande" placeholder="Titre" aria-label="Titre" aria-describedby="basic-addon1">
					     	<button class="btn btn-outline-light pl-2 pr-2 col-md-1"><img src="<?php echo site_url('assets/images/search.png')?>" alt="" width="20px" height="20px"></button>
					    </div>
					</form>

					<form class="container-fluid mt-4" method="post" action="<?php echo site_url('Admin/client_commandes/'.$id_user."/".$id_etat_commande);?>">
						<label>Filtrer par</label>
					    <div class="input-group">  

							<select name="filtre" class="form-control col-md-11">
							    <option value="id_commande desc">date de commande la plus récente</option>
							    <option value="id_commande asc">date de commande la plus ancienne</option>
							</select>

					     	<input type="submit" value="Afficher" class="btn btn-outline-secondary col-md-1"/>
						</div>
					</form>

					<table class="table table-bordered mt-3">
						<thead class="table-secondary">
							<tr>
								<th scope="col" width="150">n°</th>
								<th scope="col" width="250">Titre</th>
								<th scope="col" width="300">Rédaction</th>
								<th scope="col" width="150">Commande</th>
								<th scope="col" width="150">Commencement</th>
								<th scope="col" width="150">Livraison</th>
								<th scope="col" width="150">Etat</th>
								<th scope="col" width="100"></th>
							</tr>
						</thead>
						<tbody>
							<?php for($i=0 ; $i<count($commandes) ; $i++) {?>
							<tr>	
								<th><?php echo $commandes[$i]['id_commande'] ;?></th>
								<td><?php echo $commandes[$i]['titre_commande'] ;?></th>
								<td><?php echo $commandes[$i]['type_redacteur']."<br>".$commandes[$i]['type_text'] ;?></th>
								<td><?php echo $commandes[$i]['date_commande'] ;?></th>
								<td><?php echo $commandes[$i]['date_commencement'] ;?></th>
								<td><?php echo $commandes[$i]['date_livraison'] ;?></td>
								<td><?php echo $commandes[$i]['etat_commande'] ;?></td>
								<td>
									<a href="<?php echo site_url('Admin/details_commande/'.$commandes[$i]['id_commande']);?>" class="btn btn-outline-primary">
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
							<li class="page-item"><a class="page-link" href="<?php echo site_url('Admin/client_commandes/'.$id_user."/".$id_etat_commande.'/'.$e);?>"><?php echo $e; ?></a></li>
							<?php }?>
						</ul>
					</nav>

				</fieldset>	
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