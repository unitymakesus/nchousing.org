<?php

use Roots\Sage\Wrapper;

?>

<!doctype html>
<html <?php language_attributes(); ?>>
  <?php get_template_part('templates/layouts/head'); ?>
  <body <?php body_class(); ?>>
    <!--[if IE]>
      <div class="alert alert-warning">
        <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'sage'); ?>
      </div>
    <![endif]-->
    <a href="#wrap" class="screen-reader-shortcut">Skip to content</a>
    <?php
      do_action('get_header');
      get_template_part('templates/layouts/header');
    ?>
    <div id="wrap" class="wrap clearfix" role="document">
      <?php include Wrapper\template_path(); ?>
    </div><!-- /.wrap -->
    <?php
      do_action('get_footer');
      get_template_part('templates/layouts/footer');
      wp_footer();
    ?>
  </body>
</html>
