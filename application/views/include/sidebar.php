<!-- ADMIN -->
  <?php if($user['id_user_type'] == 1 ) { ?>

    <ul class="list-group shadow-sm bg-secondary fixed">
      <li class="list-group-item bg-secondary">
        <a class="nav-link text-dark" align="center" href="<?php echo site_url('Admin/profil'); ?>">
          <img src="<?php echo site_url('assets/images/user.png')?>" alt="" class="rounded-circle mb-2" style="width:60px; height:60px;">
          <h4 align="center"> 
            <?php echo $user['nom_user'];?>
          </h4>
        </a>
      </li>
      <li class="list-group-item bg-secondary">
        <a class="nav-link text-white" href="<?php echo site_url('Admin/commandes'); ?>">
          <img src="<?php echo site_url('assets/images/commande.png')?>" alt="" class="rounded mr-2" style="width:30px; height:30px;">
          Commandes
        </a>
      </li>
      <li class="list-group-item">
        <a class="nav-link text-dark" href="<?php echo site_url('Admin/factures'); ?>">
          <img src="<?php echo site_url('assets/images/factures.png')?>" alt="" class="rounded mr-2" style="width:30px; height:30px;">
          Factures
        </a>
      </li>
      <li class="list-group-item">
        <a class="nav-link text-dark" href="<?php echo site_url('Admin/clients'); ?>">
          <img src="<?php echo site_url('assets/images/clients.png')?>" alt="" class="rounded mr-2" style="width:30px; height:30px;">
          Clients
        </a>
      </li>
      <li class="list-group-item">
        <a class="nav-link text-dark" href="<?php echo site_url('Admin/tarifs'); ?>">
          <img src="<?php echo site_url('assets/images/tarifs.png')?>" alt="" class="rounded mr-2" style="width:30px; height:30px;">
          Tarifs
        </a>
      </li>
      <li class="list-group-item">
        <a class="nav-link text-dark" href="<?php echo site_url('Admin/paiements'); ?>">
          <img src="<?php echo site_url('assets/images/paiements.png')?>" alt="" class="rounded mr-2" style="width:30px; height:30px;">
          Paiements
        </a>
      </li>
      <li class="list-group-item">
        <a class="nav-link text-dark" href="<?php echo site_url('Admin/promotions'); ?>">
          <img src="<?php echo site_url('assets/images/promotions.png')?>" alt="" class="rounded mr-2" style="width:30px; height:30px;">
          Promotion
        </a>
      </li>
      <li class="list-group-item">
        <a class="nav-link text-dark" href="<?php echo site_url('Admin/langues'); ?>">
          <img src="<?php echo site_url('assets/images/langues.png')?>" alt="" class="rounded mr-2" style="width:30px; height:30px;">
          Langue
        </a>
      </li>
      <li class="list-group-item">
        <a class="nav-link text-dark" href="<?php echo site_url('home/logout'); ?>">
          <img src="<?php echo site_url('assets/images/logout.png')?>" alt="" class="rounded mr-2" style="width:30px; height:30px;">
          Se déconnecter
        </a>
      </li>
    </ul>

<!-- CLIENT -->
  <?php } elseif($user['id_user_type'] == 2 ) { ?> 

    <ul class="list-group list-group-flush shadow-sm bg-dark rounded p-2">
      <li class="list-group-item">
        <a class="nav-link text-dark" align="center" href="<?php echo site_url('Client/profil'); ?>">
          <img src="<?php echo site_url('assets/images/user.png')?>" alt="" class="rounded-circle mb-2" style="width:60px; height:60px;">
          <h4 align="center"> 
            <?php echo $user['nom_user'];?>
          </h4>
        </a>
      </li>
      <li class="list-group-item">
        <a class="nav-link text-dark" href="<?php echo site_url('Client/commande'); ?>">          
          <img src="<?php echo site_url('assets/images/add_commande.png')?>" alt="" class="rounded mr-2" style="width:30px; height:30px;">
          Commander
        </a>
      </li>
      <li class="list-group-item">
        <a class="nav-link text-dark" href="<?php echo site_url('Client/commandes'); ?>">
          <img src="<?php echo site_url('assets/images/commandes.png')?>" alt="" class="rounded mr-2" style="width:30px; height:30px;">
          Mes commandes
        </a>
      </li>
      <li class="list-group-item">
        <a class="nav-link text-dark" href="<?php echo site_url('Client/factures'); ?>">
          <img src="<?php echo site_url('assets/images/factures.png')?>" alt="" class="rounded mr-2" style="width:30px; height:30px;">
          Mes factures
        </a>
      </li>
      <li class="list-group-item">
        <a class="nav-link text-dark" href="<?php echo site_url('home/logout'); ?>">
          <img src="<?php echo site_url('assets/images/logout.png')?>" alt="" class="rounded mr-2" style="width:30px; height:30px;">
          Se déconnecter
        </a>
      </li>
    </ul>

  <?php } ?> 