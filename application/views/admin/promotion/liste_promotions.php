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

					<a href="<?php echo site_url('Admin/insertion_promotion');?>"  class="btn btn-outline-dark mt-2 mr-2">
						<i class="fa fa-plus" style="color:black;"></i>
						Nouvelle promotion
					</a>
					<hr>

					<h4 align="center" class="mb-3">Promotions (Promotion en cours:<?php echo " ".count($promotions_activees) ;?>)</h4>
					<hr>
	      			<form class="container-fluid mt-4" method="post" action="<?php echo site_url('Admin/promotions/');?>">
					    <div class="form-row">
	      					<div class="form-group col-md-2">
							</div>
						    <div class="input-group form-group col-md-8">
						    	Recherche
							    <div class="input-group">     
							      	<input type="text" class="form-control" name="code_promo" id="code_promo" placeholder="Code Promo" aria-label="Code Promo" aria-describedby="basic-addon1">
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
						      	<th scope="col">Code Promo</th>
						      	<th scope="col">Réduction %</th>
						      	<th scope="col" width="150"></th>
						    </tr>
					    </thead>
						<tbody>
						    <?php for($i=0 ; $i<count($promotions) ; $i++) {?>
						    <tr>
						    	<th><?php echo $promotions[$i]['code_promo'] ;?></th>	
						        <td><?php echo round( $promotions[$i]['reduction'] , 2 ) ;?></td>
						        <td>
							        <a href="<?php echo site_url('Admin/details_promotion/'.$promotions[$i]['id_promotion']);?>" class="btn btn-outline-primary">
										Voir
							        </a>
							    </tr>
								<?php }?>
						</tbody>
					</table>

					<nav aria-label="Page navigation example">
						<ul class="pagination">
							<?php for($e=1 ; $e<=$nb_pages ; $e++) {?>	
							<li class="page-item"><a class="page-link" href="<?php echo site_url('Admin/promotions/'.$e);?>"><?php echo $e; ?></a></li>
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