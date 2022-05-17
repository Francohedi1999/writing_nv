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
				<p class="message alert alert-danger" role="alert">
					<?php echo $this->session->flashdata( 'message' );?>	
				</p>
				<?php } ?>

				<h4 align="center"><?php echo "Client n° ".$user['id_user']; ?></h4>
					<form method="post" action="<?php echo site_url('Client/edit'); ?>">

							<div class="form-row">
								<div class="form-group col-md-6">
									<label>Nom utilisateur</label>
									<input class="form-control" type="hidden" name="id_user" value="<?php echo $user['id_user']; ?>">
									<input class="form-control" type="text" name="nom_user" value="<?php echo $user['nom_user']; ?>">
									<span><?php echo form_error('nom_user' , '<p class="text-danger">' , '</p>'); ?></span>
								</div>
								<div class="form-group col-md-6">
									<label>Adresse email</label>
									<input class="form-control" type="email" name="mail_user" value="<?php echo $user['mail_user']; ?>">
									<span><?php echo form_error('mail_user' , '<p class="text-danger">' , '</p>'); ?></span>
								</div>	
							</div>
							<hr>
						<h4 class="mt-2 mb-3">Informations pour facturation</h4>
						<?php if($compte_info > 0) { ?>

							<div class="form-row">
								<div class="form-group col-md-6">
									<label>Nom de société (facultatif)</label>
									<input class="form-control" type="text" name="nom_entreprise" value="<?php echo $info_user['nom_entreprise']; ?>">
								</div>
								<div class="form-group col-md-6">
									<label>Adresse (facultatif)</label>
									<input class="form-control" type="text" name="adresse" value="<?php echo $info_user['adresse']; ?>">
								</div>
							</div>	
							
							<div class="form-row">
								<div class="form-group col-md-12">
									<label>Pays (facultatif)</label>
									<input class="form-control" type="hidden" id="id_pays_choix" name="id_pays_choix" value="<?php echo $info_user['id_pays']; ?>">
									<select name="id_pays" class="choix_pays form-control">
										<?php for($i=0 ; $i<count($pays) ; $i++){?>
											<option value="<?php echo $pays[$i]['id_pays'];?>"><?php echo $pays[$i]['nom_pays'];?></option>
										<?php }?>
									</select>
								</div>	
							</div>
							
							<div class="form-row">
								<div class="form-group col-md-6">	
									<label>Ville (facultatif)</label>
									<input class="form-control" type="text" name="ville" value="<?php echo $info_user['ville']; ?>">
								</div>
								<div class="form-group col-md-6">
									<label>Région (facultatif)</label>
									<input class="form-control" type="text" name="region" value="<?php echo $info_user['region']; ?>">
								</div>	
							</div>
								
							<div class="form-row">	
								<div class="form-group col-md-6">
									<label>Code postal (facultatif)</label>
									<input class="form-control" type="text" name="code_postal" value="<?php echo $info_user['code_postal']; ?>">
								</div>
								<div class="form-group col-md-6">
									<label>Numéro TVA (facultatif)</label>
									<input class="form-control" type="text" name="num_TVA" value="<?php echo $info_user['num_TVA']; ?>">
								</div>
							</div>

						<?php } elseif ($compte_info == 0) { ?>

							<div class="form-row">
								<div class="form-group col-md-6">
									<label>Nom de société (facultatif)</label>
									<input class="form-control" type="text" name="nom_entreprise">
								</div>
								<div class="form-group col-md-6">
									<label>Adresse (facultatif)</label>
									<input class="form-control" type="text" name="adresse">
								</div>
							</div>	
							
							<div class="form-row">
								<div class="form-group col-md-12">
									<label>Pays (facultatif)</label>
									<select name="id_pays" class="choix_pays form-control">
										<?php for($i=0 ; $i<count($pays) ; $i++){?>
											<option value="<?php echo $pays[$i]['id_pays'];?>"><?php echo $pays[$i]['nom_pays'];?></option>
										<?php }?>
									</select>
									<span><?php echo form_error('id_pays' , '<p class="text-danger">' , '</p>'); ?></span>
								</div>	
							</div>	

							<div class="form-row">
								<div class="form-group col-md-6">	
									<label>Ville (facultatif)</label>
									<input class="form-control" type="text" name="ville">
								</div>
								<div class="form-group col-md-6">
									<label>Région (facultatif)</label>
									<input class="form-control" type="text" name="region">
								</div>	
							</div>
								
							<div class="form-row">	
								<div class="form-group col-md-6">
									<label>Code postal (facultatif)</label>
									<input class="form-control" type="text" name="code_postal">
								</div>
								<div class="form-group col-md-6">
									<label>Numéro TVA (facultatif)</label>
									<input class="form-control" type="text" name="num_TVA">
								</div>
							</div>

						<?php } ?>

							<div class="form-row">
								<div class="form-group col-md-12">
									<input class="btn btn-success" type="submit" value="Enregistrer">
								</div>
							</div>	

					</form>
					<a href="<?php echo site_url('Client/profil')?>" class="btn btn-danger">Annuler</a>
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
<script type="text/javascript">

	var elt_pays = document.querySelector(".choix_pays");
	elt_pays.value = $('#id_pays_choix').val() ;

</script>
</html>