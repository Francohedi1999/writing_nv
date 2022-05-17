<?php if( isset($user) ) { ?> 
  <?php if( $user['id_user_type'] == 1 ) { ?>

  <!-- ADMIN -->
    <nav class="navbar-dark shadow-sm pt-2 bg-dark fixed-top">
    <div class="row">
      <div class="col-9">
        <ul class="nav justify-content-start">
          <li class="nav-item">
            <a class="nav-link text-white" href="<?php echo site_url('Admin/'); ?>">
              <h4 class="lg_title"><img src="<?php echo site_url('assets/images/logo.png')?>" alt="" class="rounded-circle img_logo" width="70px" height="70px"> Writing is Bae</h4>
            </a>
          </li>
        </ul>
      </div>
      <div class="btn_lgt col-3">
        <ul class="nav justify-content-end pt-3">
          <li class="nav-item">
            <a class="nav-link text-white" href="<?php echo site_url('Admin/profil'); ?>">
              <i class="fa fa-user fa-2x"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('home/logout'); ?>">
              <i class="fa fa-sign-out fa-2x"></i>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <?php } elseif( $user['id_user_type'] == 2 ) { ?>

  <!-- CLIENT -->
    <nav class="navbar-dark shadow-sm pt-2 bg-dark fixed-top">
      <div class="row">
        <div class="col-9">
          <ul class="nav justify-content-start">
            <li class="nav-item">
              <a class="nav-link text-white" href="<?php echo site_url('Client/'); ?>">
                <h4 class="lg_title"><img src="<?php echo site_url('assets/images/logo.png')?>" alt="" class="rounded-circle img_logo" width="70px" height="70px"> Writing is Bae</h4>
              </a>
            </li>
          </ul>
        </div>
        <div class="btn_lgt col-3">
          <ul class="nav justify-content-end pt-3">
            <li class="nav-item">
              <a class="nav-link text-white" href="<?php echo site_url('Client/profil'); ?>">
                <i class="fa fa-user fa-2x"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url('home/logout'); ?>">
                <i class="fa fa-sign-out fa-2x"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

  <?php } ?>
<?php } else { ?>

  <nav class="navbar-dark shadow-sm pt-2 bg-dark fixed-top">
    <div class="row">
      <div class="col-9">
        <ul class="nav justify-content-start">
          <li class="nav-item">
            <a class="nav-link text-white" href="<?php echo site_url('Home/'); ?>">
              <h4 class="lg_title"><img src="<?php echo site_url('assets/images/logo.png')?>" alt="" class="rounded-circle img_logo" width="70px" height="70px"> Writing is Bae</h4>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

<?php } ?> 