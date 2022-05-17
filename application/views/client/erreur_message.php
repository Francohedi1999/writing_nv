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
			<?php if( isset( $erreur_message ) ) { ?>
				<p class="message alert alert-danger" role="alert">
					<?php echo $erreur_message ;?>	
				</p>
			<?php } ?>
		</div>

		<div class="scroll_top bg-dark">
			<a class="nav-link text-white" onclick="scroll_top()">
            	<img src="<?php echo site_url('assets/images/scroll_up.png')?>" alt="" class="rounded" width="30px" height="30px">
			</a>
		</div>
		
	</div>
</body>
<?php $this->load->view("include/assets_js");?>
<script type="text/javascript">
		
	function scroll_top()
	{
		document.getElementById('navigation').scrollIntoView();
	}	

</script>
</html>