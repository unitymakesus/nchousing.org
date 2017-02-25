<?php

use Roots\Sage\Assets;

?>
<section class="story">
  <div class="slanted-photos">
    <div class="mission">
      <img class="background" src="<?php echo Assets\asset_path('images/banner.jpg'); ?>" />
      <div class="wrap-content">
        <div class="solid-notch">
          Ensuring that every North Carolinian has a home in which to live with <strong>dignity</strong> and <strong>opportunity</strong>.
        </div>
      </div>
    </div>

    <div class="spotlight">
      <?php
      $spotlight = get_posts(['numberposts' => 1, 'category_name' => 'member-spotlight']);
      $background = get_the_post_thumbnail_url($spotlight[0]->ID, 'medium');
      ?>
      <a href="<?php echo get_the_permalink($spotlight[0]->ID); ?>"></a>
      <img class="background" src="<?php echo $background ?>" />
      <div class="wrap-content">
        <h2>
          <span class="skew">Member Spotlight</span>
        </h2>
        <div class="spotlight-content"><?php echo get_the_title($spotlight[0]->ID); ?>
        </div>
      </div>
    </div>
  </div>

  <div class="gradient-bg">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center extra-bottom-margin">
          <h2>
            <span class="skew">Our Challenge</span>
          </h2>
        </div>
      </div>

      <div class="row impact-blocks">
        <div class="col-md-4">
          <div class="row overlap">
            <div class="col-xs-6 col-md-12">
              <div class="notch-img">
                <div class="notch-inner">
                  <img src="<?php echo Assets\asset_path('images/home-img-1.jpg'); ?>" />
                </div>
              </div>
            </div>

            <div class="col-xs-6 col-md-12">
              <div class="circle-stat">
                <div class="spacer"></div>
                <div class="circle">
                  <div class="wrap-content">
                    <span class="stat">500K</span>
                    NC households pay more than half of their income on housing
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="row overlap">
            <div class="col-xs-6 col-md-12">
              <div class="circle-stat">
                <div class="spacer"></div>
                <div class="circle">
                  <div class="wrap-content">
                    <span class="stat">43%</span>
                    of NC renter households can't afford a modest, 2br apartment
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xs-6 col-md-12">
              <div class="notch-img">
                <div class="notch-inner">
                  <img src="<?php echo Assets\asset_path('images/home-img-2.jpg'); ?>" />
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="row overlap">
            <div class="col-xs-6 col-md-12">
              <div class="notch-img">
                <div class="notch-inner">
                  <img src="<?php echo Assets\asset_path('images/home-img-3.jpg'); ?>" />
                </div>
              </div>
            </div>

            <div class="col-xs-6 col-md-12">
              <div class="circle-stat">
                <div class="spacer"></div>
                <div class="circle">
                  <div class="wrap-content">
                    <span class="stat">85</span>
                    hours per week at minimum wage is what is needed to afford a 2br apartment
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="nc-map">
  <img src="<?php echo Assets\asset_path('images/map-banner.png'); ?>" srcset="<?php echo Assets\asset_path('images/map-banner@2x.png'); ?> 2x" alt="Map of North Carolina counties" />
  <div class="wrap-content">
    <a class="btn-skew btn btn-gold btn-lg" href="/county-fact-sheets/"><span class="shape"></span>Explore NC's affordable housing needs by county <i class="glyphicon glyphicon-menu-right" aria-hidden="true"></i></a>
  </div>
</section>

<section class="whats-new">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="striped-line">
          <h2>What's New</h2>
        </div>
      </div>
    </div>

    <div class="row">
      <?php
      $news = new WP_Query([
        'posts_per_page' => 2,
      ]);

      if ($news->have_posts()) : while ($news->have_posts()) : $news->the_post();
        echo '<div class="col-md-6">';
        get_template_part('templates/layouts/block-overlay');
        echo '</div>';
      endwhile; endif; wp_reset_query();
      ?>
    </div>

    <div class="row">
      <div class="col-md-12">
        <script src="//assets.juicer.io/embed.js" type="text/javascript"></script>
        <link href="//assets.juicer.io/embed.css" media="all" rel="stylesheet" type="text/css" />
        <ul class="juicer-feed" data-feed-id="ncinitiative"></ul>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4 housing-matters callout-overlay">
        <div>
          <img style="background-image: url(<?php echo Assets\asset_path('images/casa-salisbury-apts.jpg'); ?>);" class="background" />
          <h3>Housing Matters <strong>Newsletter</strong></h3>
          <a class="mega-link" href="/housing-matters-newsletter/"></a>
        </div>
      </div>
      <div class="col-md-4 events callout-overlay">
        <div>
          <img style="background-image: url(<?php echo Assets\asset_path('images/housing-conf.jpg'); ?>);" class="background" />
          <h3>Trainings <strong>And Events</strong></h3>
          <a class="mega-link" href="/trainings-webinars/"></a>
        </div>
      </div>
      <div class="col-md-4 jobs callout-overlay">
        <div>
          <img style="background-image: url(<?php echo Assets\asset_path('images/community-lobby.jpg'); ?>);" class="background" />
          <h3>Job <strong>Opportunities</strong></h3>
          <a class="mega-link" href="/job-listings/"></a>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="housing-news">
  <div class="striped-line"></div>

  <?php

  $hnews = new WP_Query([
    'post_type' => 'housing-news',
    'posts_per_page' => 1
  ]);

  if ($hnews->have_posts()) : while ($hnews->have_posts()) : $hnews->the_post();
  ?>
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <h2 class="section-header">Housing News</h2>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4">
          <ul class="hnews-items">
            <?php
            $date = get_the_time('n/j/Y');
            $items = get_field('news_item');

            $i = 0;
            $limit = 12;
            $count = count($items);

            // If count is less than limit, determine where to break the column. Otherwise, set column break at a third the limit
            if ($count < $limit) {
              $colbreak = floor($count/3);
            } else {
              $colbreak = $limit/3;
            }

            while ($i < $limit && $i < $count) {
              if ($i > 0 && $i % $colbreak == 0) {
                echo '</ul></div><div class="col-md-4"><ul class="hnews-items">';
              }
              $item = $items[$i];
              ?>

              <li data-source="<?php echo $item['link']; ?>">
                <a class="mega-link" href="<?php echo $item['link']; ?>" target="_blank"></a>
                <h3><?php echo $item['title']; ?></h3>
                <p class="meta"><?php echo $item['source_name']; ?> | <?php echo $item['original_date']; ?> <span class="icon-external-link"></span></p>
              </li>

              <?php
              $i++;
            } ?>

            <?php
            if ($count > $limit) {
              echo '<li><a class="btn btn-skew btn-gold" href="' . get_the_permalink() . '">See all of the latest housing news &raquo;</a></li>';
            }
            ?>
          </ul>
        </div>
      </div>
    </div>
  <?php endwhile; endif; wp_reset_query(); ?>

</section>

<section class="stronger-together">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="striped-line"></div>

        <div class="st-banner has-notch">
          <div class="house">
            <img src="<?php echo Assets\asset_path('images/st-house.jpg'); ?>" />
          </div>
          <img class="st-logo" src="<?php echo Assets\asset_path('images/stronger-together-logo.png'); ?>" />
          <a class="mega-link" href="/stronger-together/"></a>
        </div>
      </div>
    </div>
  </div>
</section>
