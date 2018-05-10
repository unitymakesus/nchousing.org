<?php

use Roots\Sage\Assets;

?>
<section class="story">
  <div class="slanted-photos">
    <div class="mission">
      <img class="background" src="<?php echo Assets\asset_path('images/banner.jpg'); ?>" alt="" />
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
      <a href="<?php echo get_the_permalink($spotlight[0]->ID); ?>" aria-label="Read full member spotlight"></a>
      <img class="background" src="<?php echo $background ?>" alt="" />
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
            <div class="hidden-xs col-sm-6 col-md-12">
              <div class="notch-img">
                <div class="notch-inner">
                  <img src="<?php echo Assets\asset_path('images/home-img-1.jpg'); ?>" alt="Group of people on front porch of house" />
                </div>
              </div>
            </div>

            <div class="col-sm-6 col-md-12">
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
            <div class="col-sm-6 col-md-12">
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

            <div class="hidden-xs col-sm-6 col-md-12">
              <div class="notch-img">
                <div class="notch-inner">
                  <img src="<?php echo Assets\asset_path('images/home-img-2.jpg'); ?>" alt="Woman smiling in front of house" />
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="row overlap">
            <div class="hidden-xs col-sm-6 col-md-12">
              <div class="notch-img">
                <div class="notch-inner">
                  <img src="<?php echo Assets\asset_path('images/home-img-3.jpg'); ?>" alt="Woman filling out paperwork" />
                </div>
              </div>
            </div>

            <div class="col-sm-6 col-md-12">
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
    <a class="btn-skew btn btn-gold btn-lg" href="http://ncsu.maps.arcgis.com/apps/webappviewer/index.html?id=6dc0f5617a2e458c84236b901db3a244"><span class="shape"></span>Mapping Housing Insecurity in North Carolina <i class="glyphicon glyphicon-menu-right" aria-hidden="true"></i></a>
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
          <img style="background-image: url(<?php echo Assets\asset_path('images/casa-salisbury-apts.jpg'); ?>);" alt="" class="background" />
          <h3>Housing Matters <strong>Newsletter</strong></h3>
          <a class="mega-link" href="/housing-matters-newsletter/" aria-label="Go to Housing Matters newsletters"></a>
        </div>
      </div>
      <div class="col-md-4 events callout-overlay">
        <div>
          <img style="background-image: url(<?php echo Assets\asset_path('images/housing-conf.jpg'); ?>);" alt="" class="background" />
          <h3>Trainings <strong>And Events</strong></h3>
          <a class="mega-link" href="/trainings-webinars/" aria-label="See upcoming trainings and events"></a>
        </div>
      </div>
      <div class="col-md-4 jobs callout-overlay">
        <div>
          <img style="background-image: url(<?php echo Assets\asset_path('images/community-lobby.jpg'); ?>);" alt="" class="background" />
          <h3>Job <strong>Opportunities</strong></h3>
          <a class="mega-link" href="/job-listings/" aria-label="See current job opportunities"></a>
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
        <?php echo do_shortcode('[recent-housing-news number="12"]'); ?>
      </div>

      <div class="text-center">
        <a class="btn btn-skew btn-gold" href="<?php echo esc_url(home_url('/housing-news')); ?>">See all of the latest housing news &raquo;</a>
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
            <img src="<?php echo Assets\asset_path('images/st-house.jpg'); ?>" alt="" />
          </div>
          <img class="st-logo" src="<?php echo Assets\asset_path('images/stronger-together-logo.png'); ?>" alt="Stronger Together. Smart Policy. Strategic Investments." />
          <a class="mega-link" href="/stronger-together/" aria-label="Read more about the Stronger Together partnership between the NC Housing Coalition and the NC Community Development Initiative"></a>
        </div>
      </div>
    </div>
  </div>
</section>
