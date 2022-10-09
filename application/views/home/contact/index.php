<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $title; ?></title>
	<link rel="icon" href="<?php echo site_url('assets/images/logo.png')?>"/>
	<?php $this->load->view("include/assets_css.php");?>
</head>
<body>
	<div class="contenu_global">
		
		<div id="navigation" class="navigation">
			<?php $this->load->view("include/navbar");?>
		</div>

		<div class="topbar">
			<?php $this->load->view("include/topbar");?>
		</div>			
		
		<div class="contenu p-2">
			
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6">

					<h4 align="center" class="mt-3 mb-3"><?php echo $title; ?></h4>

					<div class="card">

						<dl class="row m-2">

							<p class="p-2">
								Nous sommes là à la fois pour savourer ce beau métier et vous faire ressentir cette passion à travers nos écrits.
								<br>
								Si vous souhaitez collaborer avec nous, n’hésitez pas à prendre contact.
							</p>
							
						</dl>
						
						<dl class="row m-2">

							<dt class="col-sm-3">Réseaux sociaux:</dt>
						  	<dd class="col-sm-9">
						    	<p></p>
						    	<p><?php echo $rs ;?></p>
						  	</dd>

						  	<dt class="col-sm-3">Téléphone:</dt>
						  	<dd class="col-sm-9">
						    	<p></p>
						    	<p><?php echo $tel ;?></p>
						  	</dd>

						  	<dt class="col-sm-3">Email</dt>
						  	<dd class="col-sm-9">
						    	<p></p>
						    	<p><?php echo $mail ;?></p>
						  	</dd>

						  	<dt class="col-sm-3">Adresse</dt>
						  	<dd class="col-sm-9">
						    	<p></p>
						    	<p><?php echo $adresse ;?></p>
						  	</dd>

						</dl>

					</div>

				</div>
				<div class="col-md-3"></div>
			</div>

			<div class="scroll_top bg-dark">
				<a class="nav-link text-white" onclick="scroll_top('navigation')">
	            	<i class="fa fa-angle-double-up fa-2x"></i>
				</a>
			</div>
		</div>

	</div>
</body>
<?php $this->load->view("include/assets_js");?>
</html>