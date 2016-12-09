<?php

use Roots\Sage\Assets;
use Roots\Sage\Nav;

?>
<header id="header" class="banner">
  <div class="container">
    <div class="navbar-header navbar-default">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo Assets\asset_path('images/nchc-logo.png'); ?>" alt="North Carolina Housing Coalition" /></a>
    </div>

    <nav class="navbar collapse navbar-collapse" data-topbar role="navigation" id="navbar-collapse-1">
      <div class="navbar-right">
        <?php
        if (has_nav_menu('primary_navigation')) :
          wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav', 'depth' => 2, 'walker' => new Nav\NavWalker()]);
        endif;
        ?>
      </div>
    </nav>
  </div>
</header>
