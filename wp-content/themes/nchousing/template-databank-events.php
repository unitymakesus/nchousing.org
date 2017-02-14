<?php
/* Template Name: DataBank Events Calendar */

use Roots\Sage\Setup;

get_template_part('templates/components/header', get_post_type());
?>

<div class="container">
  <div class="content">
    <main class="main">

      <script type="text/javascript" src="https://www3.thedatabank.com/dpg/217/tdbDynamicIframeLoader.js"></script>
      <iframe id="tdbIframe" src="https://www3.thedatabank.com/dpg/217/default.asp?formid=meeting" frameborder="0" width="100%" height="1300">
      This page requires a frames-capable browser.
      </iframe>

    </main>
    <?php if (Setup\display_sidebar()) : ?>
      <aside class="sidebar">
        <?php if (is_page('whats-new')) {
          get_template_part('templates/components/sidebar', 'post');
        } else {
          get_template_part('templates/components/sidebar', get_post_type());
        } ?>
      </aside>
    <?php endif; ?>
  </div><!-- /.content -->
</div><!-- /.container -->

<?php if ($wp_query->max_num_pages > 1) : ?>
  <nav class="post-nav container">
    <?php wp_pagenavi(); ?>
  </nav>
<?php endif; ?>
