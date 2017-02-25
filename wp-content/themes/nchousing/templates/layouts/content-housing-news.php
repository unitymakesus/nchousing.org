<article <?php post_class('article'); ?>>

  <div class="entry-content">
    <ul class="hnews-items">
      <?php
      $date = get_the_time('n/j/Y');
      $items = get_field('news_item');

      foreach ($items as $item) { ?>
        <li>
          <a class="mega-link" href="<?php echo $item['link']; ?>" target="_blank" onclick="ga('send', 'event', 'ednews', 'click');"></a>
          <h3><?php echo $item['title']; ?></h3>
          <p class="meta"><?php echo $item['source_name']; ?> | <?php echo $item['original_date']; ?> <span class="icon-external-link"></span></p>
        </li>
      <?php } ?>
    </ul>
  </div>

</article>

<?php get_template_part('templates/components/social-share'); ?>
