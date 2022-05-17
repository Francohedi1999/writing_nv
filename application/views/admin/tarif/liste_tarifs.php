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
					
					<a href="<?php echo site_url('Admin/insertion_tarif');?>" class="btn btn-outline-dark mt-2 mr-2">
						<i class="fa fa-plus" style="color:black;"></i>
						Nouveau tarif
					</a>
					<hr>

					<h4 align="center" class="mb-3">Tarifs</h4>
					<hr>
		      		<form class="container-fluid mt-4" method="post" action="<?php echo site_url('Admin/tarifs/');?>">
					    <div class="form-row">
	      					<div class="form-group col-md-2">
							</div>
						    <div class="input-group form-group col-md-8">
						    	Recherche
							    <div class="input-group">     
							      	<input type="text" class="form-control" name="type_text" id="type_text" placeholder="Type de texte" aria-label="Type de texte" aria-describedby="basic-addon1">
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
								<th scope="col" width="200">Type de rédacteur</th>
								<th scope="col" width="50">Type de texte</th>
								<th scope="col" width="50">Prix par mot (Ar)</th>
								<th scope="col" width="50"></th>
							</tr>
						</thead>
						<tbody>
							<?php for($i = 0 ; $i<count($tarifs) ; $i++) {?>
							<tr>
								<td><?php echo $tarifs[$i]['type_redacteur'] ;?></td>
								<td><?php echo $tarifs[$i]['type_text'] ;?></td>		  		
								<td><?php echo round( $tarifs[$i]['prix_par_mot'] , 2 ) ;?></td>		  		
								<td>
									<a href="<?php echo site_url('Admin/details_tarif/'.$tarifs[$i]['id_tarif']);?>" class="btn btn-outline-primary">
										Voir
									</a>
								</td>							  		
							</tr>
							<?php } ?>
						</tbody>
					</table>

					<nav aria-label="Page navigation example">
						<ul class="pagination">
						<?php for($e=1 ; $e<=$nb_pages ; $e++) {?>	
							<li class="page-item"><a class="page-link" href="<?php echo site_url('Admin/tarifs/'.$e);?>"><?php echo $e; ?></a></li>
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