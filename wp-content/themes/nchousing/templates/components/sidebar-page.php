<div class="well">
  <?php
  if (has_nav_menu('primary_navigation')) :
    wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav nav-stacked']);
  endif;
  ?>
</div>
