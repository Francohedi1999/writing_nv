<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $title; ?></title>
	<?php $this->load->view("include/assets_css.php");?>
</head>
<body>
	<div class="logo_nav">
		<?php $this->load->view("include/navbar.php");?>		
	</div>
	<div class="row">
		<div class="col-2">
			<div class="sidebar">
				<?php $this->load->view("include/sidebar.php");?>
			</div>
		</div>
		<div class="col-10">