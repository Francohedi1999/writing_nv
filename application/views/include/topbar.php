<?php if( isset($user) ) { ?> 
  <?php if($user['id_user_type'] == 1 ) { ?>

<!-- ADMIN -->
<div class="menu_nav">
  <div class="bars">    
   <ul>                
      <li><a onclick="get_menu( 'menu_choix' )"><i class="fa fa-bars"></i></a></li> 
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
          Langues
        </a>
      </li> 
      <li>
        <a href="#">
          <i class="fa fa-font pr-2"></i>
          Rédacteurs
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
      <li><a onclick="get_menu( 'menu_choix' )"><i class="fa fa-bars"></i></a></li> 
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
      <li><a onclick="get_menu( 'menu_choix' )"><i class="fa fa-bars"></i></a></li> 
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
        <div class="dropdown">
          <i class="fa fa-pencil-square-o pr-2"></i>
          <a href="#">
             S'inscrire
          </a>
          <div class="dropdown_content">
            <ul>
              <li><a href="<?php echo site_url('Home/register_client'); ?>">Client</a></li>
              <li><a href="<?php echo site_url('Home/register_redacteur'); ?>">Rédacteur</a></li>
            </ul>
          </div>
        </div>
      </li>

      <li>
        <a href="<?php echo site_url('Home/identifier'); ?>">
          <i class="fa fa-question-circle-o pr-2"></i>
          Mot de passe oublié ?
        </a>
      </li> 

      <li>
        <a href="<?php echo site_url('Home/tarifs'); ?>">
          <i class="fa fa-money pr-2"></i>
          Nos tarifs de rédaction
        </a>
      </li> 

      <li>
        <a href="<?php echo site_url('Home/paiements'); ?>">
          <i class="fa fa-shopping-cart pr-2"></i>
          Nos types de paiements
        </a>
      </li>

      <li>
        <a href="<?php echo site_url('Home/redacteurs'); ?>">
          <i class="fa fa-font pr-2"></i>
          Nos types de rédacteur
        </a>
      </li> 

      <li>
        <a href="<?php echo site_url('Home/contact'); ?>">
          <i class="fa fa-whatsapp pr-2"></i>
          Contact
        </a>
      </li> 

    </ul>  
  </div>
</div>

  <?php } ?> 