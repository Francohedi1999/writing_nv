<?php if( isset($user) ) { ?> 
  <?php if($user['id_user_type'] == 1 ) { ?>

<!-- ADMIN -->
<div class="menu_nav">
  <div class="bars">    
   <ul>                
      <li>
        <a onclick="get_menu( 'menu_choix' )">
          <button class="btn"><i class="fa fa-bars"></i></button>
        </a>
      </li> 
   </ul>  
  </div>
  <div id="menu_choix">
   <ul>
      <li class="btn_compte">
        <a href="<?php echo site_url('Admin/profil'); ?>">
          <i class="fa fa-user pr-2"></i>
          Compte
        </a>
      </li>
      <li>
        <a href="<?php echo site_url('Admin/commandes'); ?>">
          <i class="fa fa-calendar pr-2"></i>
          Commandes
        </a>
      </li>
      <li>
        <a href="<?php echo site_url('Admin/factures'); ?>">
          <i class="fa fa-file pr-2"></i>
          Factures
        </a>
      </li>
      <li>
        <a href="<?php echo site_url('Admin/clients'); ?>">
          <i class="fa fa-users pr-2"></i>
          Clients
        </a>
      </li>
      <li>
        <a href="<?php echo site_url('Admin/tarifs'); ?>">
          <i class="fa fa-money pr-2"></i>
          Tarifs
        </a>
      </li>
      <li>
        <a href="<?php echo site_url('Admin/paiements'); ?>">
          <i class="fa fa-credit-card pr-2"></i>
          Paiements
        </a>
      </li>
      <li>
        <a href="<?php echo site_url('Admin/promotions'); ?>">
          <i class="fa fa-bullhorn pr-2"></i>
          Promotions
        </a>
      </li>
      <li>
        <a href="<?php echo site_url('Admin/langues'); ?>">
          <i class="fa fa-language pr-2"></i>
          Langue
        </a>
      </li>                     
      <li class="logout_btn">
        <a href="<?php echo site_url('home/logout'); ?>">
          <i class="fa fa-sign-out pr-2"></i>
          Se déconnecter
        </a>
      </li>                     
    </ul>  
  </div>
</div>

  <?php } elseif($user['id_user_type'] == 2 ) { ?> 

<div class="menu_nav">
  <div class="bars">    
   <ul>                
      <li>
        <a onclick="get_menu( 'menu_choix' )">
          <button class="btn"><i class="fa fa-bars"></i></button>
        </a>
      </li> 
   </ul>  
  </div>
  <div id="menu_choix">
   <ul>
      <li class="btn_compte">
        <a href="<?php echo site_url('Client/profil'); ?>">
          <i class="fa fa-user pr-2"></i>
          Compte
        </a>
      </li>
      <li>
        <a href="<?php echo site_url('Client/commande'); ?>">
          <i class="fa fa-pencil pr-2"></i>
          Commander
        </a>
      </li>
      <li>
        <a href="<?php echo site_url('Client/commandes'); ?>">
          <i class="fa fa-calendar pr-2"></i>
          Commandes
        </a>
      </li>
      <li>
        <a href="<?php echo site_url('Client/factures'); ?>">
          <i class="fa fa-file pr-2"></i>
          Factures
        </a>
      </li>                     
      <li class="logout_btn">
        <a href="<?php echo site_url('home/logout'); ?>">
          <i class="fa fa-sign-out pr-2"></i>
          Se déconnecter
        </a>
      </li>                     
    </ul>  
  </div>
</div>

<?php } ?>
<?php } else { ?>


<div class="menu_nav">
  <div class="bars">    
   <ul>                
      <li>
        <a onclick="get_menu( 'menu_choix' )">
          <button class="btn"><i class="fa fa-bars"></i></button>
        </a>
      </li>
   </ul>  
  </div>
  <div id="menu_choix">
   <ul>
      <li>
        <a href="<?php echo site_url('Home/'); ?>">
          <i class="fa fa-sign-in pr-2"></i>
          Se connecter
        </a>
      </li>
      <li>
        <a href="<?php echo site_url('Home/register'); ?>">
          <i class="fa fa-pencil-square-o pr-2"></i>
           S'inscrire
        </a>
      </li>
      <li>
        <a href="<?php echo site_url('Home/identifier'); ?>">
          <i class="fa fa-question-circle-o pr-2"></i>
          Mot de passe oublié ?
        </a>
      </li>                    
    </ul>  
  </div>
</div>

  <?php } ?> 