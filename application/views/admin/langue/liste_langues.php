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

					<a href="<?php echo site_url('Admin/insertion_langue');?>" class="btn btn-outline-dark mt-2 mr-2">
						<i class="fa fa-plus" style="color:black;"></i>
						Nouvelle langue
					</a>
					<hr>

					<h4 align="center" class="mb-3">Langues</h4>
					<hr>
		      		<form class="container-fluid mt-4" method="post" action="<?php echo site_url('Admin/langues');?>">
					  	<div class="form-row">
	      					<div class="form-group col-md-2">
							</div>
						    <div class="input-group form-group col-md-8">
						    	Recherche
							    <div class="input-group">     
							      	<input type="text" class="form-control" name="langue_text" id="langue_text" placeholder="Langue" aria-label="Langue" aria-describedby="basic-addon1">
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
								<th scope="col">Langue</th>
								<th scope="col">Etat</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
						<?php for($i = 0 ; $i<count($langues) ; $i++) {?>
							<tr>
								<td><?php echo $langues[$i]['langue_text'] ;?></td>				  								  		
								<td><?php echo $langues[$i]['activee'] ;?></td>				  								  		
								<td>
									<a class="btn btn-light text-decoration-none mt-2" href="<?php echo site_url('Admin/modification_langue/'.$langues[$i]['id_langue_text']);?>">
										<i class="fa fa-edit" style="color:black;"></i>
										Modifier
									</a>
								<?php if($langues[$i]['is_activee'] == 1) { ?>
									<a class="btn btn-light text-decoration-none text-danger mt-2" href="<?php echo site_url('Admin/activation_langue/'.$langues[$i]['id_langue_text']."/".$langues[$i]['is_activee'].'/'.$page);?>">
										<i class="fa fa-close" style="color:red;"></i>
										Désactiver
									</a>
								<?php } elseif($langues[$i]['is_activee'] == 0) { ?>
									<a class="btn btn-light text-decoration-none text-success mt-2" href="<?php echo site_url('Admin/activation_langue/'.$langues[$i]['id_langue_text']."/".$langues[$i]['is_activee'].'/'.$page);?>">
										<i class="fa fa-check" style="color:green;"></i>
										Activer
									</a>
								<?php }?>
								</td>						  								  		
							</tr>
						<?php } ?>
						</tbody>
					</table>

					<nav aria-label="Page navigation example">
						<ul class="pagination">
							<?php for($e=1 ; $e<=$nb_pages ; $e++) {?>	
							<li class="page-item"><a class="page-link" href="<?php echo site_url('Admin/langues/'.$e);?>"><?php echo $e; ?></a></li>
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