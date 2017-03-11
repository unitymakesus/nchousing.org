<?php
/* Template Name: Full Width */

use Roots\Sage\Extras;
use Roots\Sage\Setup;

get_template_part('templates/components/header', get_post_type());
?>

<div class="container">
  <div class="content">
      <?php
        while (have_posts()) : the_post();
          get_template_part('templates/layouts/content', get_post_type());
        endwhile;
      ?>
    </main>
  </div><!-- /.content -->
</div><!-- /.container -->
