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

				<?php if( $this->session->flashdata('message') ) { ?>
				<p class="message alert alert-success" role="alert">
					<?php echo $this->session->flashdata('message') ;?>
				</p>
				<?php } ?>

				<a href="<?php echo site_url('Admin/insertion_type_de_paiement');?>" class="btn btn-outline-dark mt-2 mr-2">
					<i class="fa fa-plus" style="color:black;"></i>
					Nouveau type de payement
				</a>
				<hr>

				<h4 align="center" class="mb-3">Types de paiement</h4>
					<hr>
					<form class="container-fluid mt-2" method="post" action="<?php echo site_url('Admin/paiements/');?>">
					    <div class="form-row">
	      					<div class="form-group col-md-2">
							</div>
						    <div class="input-group form-group col-md-8">
						    	Recherche
							    <div class="input-group">     
							      	<input type="text" class="form-control" name="type_paiement" id="type_paiement" placeholder="Type de paiement" aria-label="Type de paiement" aria-describedby="basic-addon1">
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
								<th scope="col" width="200">Paiement</th>
								<th scope="col" width="50"></th>
							</tr>
						</thead>
						<tbody>
						<?php for($i=0 ; $i<count($type_paiements) ; $i++) {?>
							<tr>
				    			<td><?php echo $type_paiements[$i]['type_paiement'] ;?></td>
								<td>
									<a href="<?php echo site_url('Admin/paiement/'.$type_paiements[$i]['id_type_paiement']);?>" class="btn btn-outline-primary">
										Voir
									</a>
								</td>
							</tr>
						<?php }?>
						</tbody>
					</table>

					<nav>
						<ul class="pagination">
							<?php for($e=1 ; $e<=$nb_pages ; $e++) {?>	
							<li class="page-item"><a class="page-link" href="<?php echo site_url('Admin/paiements/'.$e);?>"><?php echo $e; ?></a></li>
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