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
			<h4 align="center" class="mt-3 mb-3"><?php echo $title; ?></h4>	

			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6">

					<div class="card">
						<?php for($i=0 ; $i<count($type_redacteurs) ; $i++) {?>
						<dl class="row m-2">
						  	<dt class="col-sm-4"><?php echo $type_redacteurs[$i]['type_redacteur'] ;?></dt>
						  	<dd class="col-sm-8">
						    	<p></p>
						    	<p><?php echo $type_redacteurs[$i]['desc_redacteur'] ;?></p>
						  	</dd>
						</dl>
						<?php }?>
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