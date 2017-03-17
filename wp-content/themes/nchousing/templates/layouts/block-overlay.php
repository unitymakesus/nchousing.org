<?php

use Roots\Sage\Assets;
use Roots\Sage\Media;
use Roots\Sage\Resize;

$video = has_post_format('video');

$featured_image = Media\get_featured_image('medium');

$target = '';
if (is_embed()) {
  $target = 'target="_blank"';
}
?>

<article <?php post_class('block-overlay photo-overlay'); ?>>
  <?php
  if (!empty($featured_image)) {
    echo '<img class="post-thumbnail" src="' . $featured_image . '" alt="" />';
  }

  if ($video) {
    echo '<div class="video-play"></div>';
  }
  ?>

  <header class="entry-header">
    <h2 class="post-title"><?php the_title(); ?></h2>
    <?php get_template_part('templates/components/entry-meta'); ?>
  </header>

  <a class="mega-link" href="<?php the_permalink(); ?>" <?php echo $target; ?> aria-label="Read full article: <?php the_title(); ?>"></a>
</article>
