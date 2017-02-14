<?php
/* Template Name: Page with County Map */

use Roots\Sage\Setup;

get_template_part('templates/components/header', get_post_type());
?>

<div class="container">
  <div class="content">
    <main class="main">
      <?php
        while (have_posts()) : the_post();
          get_template_part('templates/layouts/content', get_post_type());
        endwhile;
      ?>
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

<section class="county-map">
  <?php get_template_part('templates/components/county-map'); ?>

  <script type="text/javascript">
    <?php
      $i = 1;
      $counties = array("Alamance", "Alexander", "Alleghany", "Anson", "Ashe", "Avery", "Beaufort", "Bertie", "Bladen", "Brunswick", "Buncombe", "Burke", "Cabarrus", "Caldwell", "Camden", "Carteret", "Caswell", "Catawba", "Chatham", "Cherokee", "Chowan", "Clay", "Cleveland", "Columbus", "Craven", "Cumberland", "Currituck", "Dare", "Davidson", "Davie", "Duplin", "Durham", "Edgecombe", "Forsyth", "Franklin", "Gaston", "Gates", "Graham", "Granville", "Greene", "Guilford", "Halifax", "Harnett", "Haywood", "Henderson", "Hertford", "Hoke", "Hyde", "Iredell", "Jackson", "Johnston", "Jones", "Lee", "Lenoir", "Lincoln", "Macon", "Madison", "Martin", "McDowell", "Mecklenburg", "Mitchell", "Montgomery", "Moore", "Nash", "New Hanover", "Northampton", "Onslow", "Orange", "Pamlico", "Pasquotank", "Pender", "Perquimans", "Person", "Pitt", "Polk", "Randolph", "Richmond", "Robeson", "Rockingham", "Rowan", "Rutherford", "Sampson", "Scotland", "Stanly", "Stokes", "Surry", "Swain", "Transylvania", "Tyrrell", "Union", "Vance", "Wake", "Warren", "Washington", "Watauga", "Wayne", "Wilkes", "Wilson", "Yadkin", "Yancey");
      $map_config['default'] = array('borderColor' => '#9CA8B6');

      // Loop through counties to make an array with the config for the map
      foreach ($counties as $county) {
        $map_config["map_$i"] = array(
          'hover' => $county,
      		'enable' => true,
      		'url' => 'http://www.html5interactivemaps.com/',
      		'target' => 'new_window', //open link in new window:new_window, open in current window:same_window, or none for nothing.
      		'upColor' => '#535388', //county color when page loads
      		'overColor' => '#CB9F5B', //county color when mouse hover
      		'downColor' => '#28296B' //county color when mouse clicking
        );

        $i++;
      }
    ?>
    var map_config = <?php echo json_encode($map_config); ?>;
  </script>
</section>

<?php if ($wp_query->max_num_pages > 1) : ?>
  <nav class="post-nav container">
    <?php wp_pagenavi(); ?>
  </nav>
<?php endif; ?>
