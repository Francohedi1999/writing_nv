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

				<h4 align="center" class="mt-3 mb-3">Clients<?php echo "<br>(".$title_client['fidele'].")" ;?></h4>
				<hr>
				<form class="container-fluid mt-4" method="post" action="<?php echo site_url('Admin/fidelite_clients/'.$is_fidele);?>">
				    	<div class="form-row">
	      					<div class="form-group col-md-2">
							</div>
						    <div class="input-group form-group col-md-8">
						    	Recherche
							    <div class="input-group">     
							      	<input type="text" class="form-control" name="nom_user" id="nom_user" placeholder="Nom du client" aria-label="Username" aria-describedby="basic-addon1">
							     	<button class="btn btn-outline-light pl-2 pr-2"><i class="fa fa-search" style="color:black;"></i></button>
							    </div>
						    </div>
						    <div class="form-group col-md-2">
							</div>
					    </div>
				</form>

	      		<table class="table table-bordered mt-3">
					<thead class="table-secondary">
						<tr>
							<th scope="col" width="150">#</th>
							<th scope="col" width="200">Nom</th>
							<th scope="col" width="200">Email</th>
							<th scope="col" width="150">Inscription</th>
							<th scope="col" width="50"></th>
						</tr>
					</thead>
					<tbody>
					<?php for($i=0 ; $i<count($users) ; $i++) { ?>
						<tr>
			    			<th><?php echo $users[$i]['id_user'] ;?></th>
			    			<td><?php echo $users[$i]['nom_user'] ;?></td>
			    			<td><?php echo $users[$i]['mail_user'] ;?></td>
			    			<td><?php echo $users[$i]['date_inscri'] ;?></td>
							<td>
								<a href="<?php echo site_url( 'Admin/details_client/'.$users[$i]['id_user'] );?>" class="btn btn-outline-primary">
									Voir
								</a>
							</td>
						</tr>
					<?php } ?>
					</tbody>
				</table>

				<nav>
					<ul class="pagination">
						<?php for($e=1 ; $e<=$nb_pages ; $e++) {?>	
						<li class="page-item"><a class="page-link" href="<?php echo site_url('Admin/fidelite_clients/'.$is_fidele."/".$e);?>"><?php echo $e; ?></a></li>
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
