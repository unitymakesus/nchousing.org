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
      $spotlight = get_posts(['numberposts' => 1, 'cat_name' => 'member-spotlight']);
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
                  <img src="<?php echo Assets\asset_path('images/leadership.jpg'); ?>" />
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
                  <img src="<?php echo Assets\asset_path('images/investment.jpg'); ?>" />
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
                  <img src="<?php echo Assets\asset_path('images/public-policy.jpg'); ?>" />
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
    <a class="btn-skew btn btn-gold btn-lg" href="#"><span class="shape"></span>Explore NC's affordable housing needs by county <i class="glyphicon glyphicon-menu-right" aria-hidden="true"></i></a>
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
      <div class="col-md-4 housing-matters">
        <a href="#">Housing Matters <strong>Newsletter</strong></a>
      </div>
      <div class="col-md-4 events">
        <a href="#">Trainings <strong>And Events</strong></a>
      </div>
      <div class="col-md-4 jobs">
        <a href="#">Job <strong>Opportunities</strong></a>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <script src="//assets.juicer.io/embed.js" type="text/javascript"></script>
        <link href="//assets.juicer.io/embed.css" media="all" rel="stylesheet" type="text/css" />
        <ul class="juicer-feed" data-feed-id="ncinitiative"><h1 class="referral"><a href="https://www.juicer.io">Powered by Juicer</a></h1></ul>
      </div>
    </div>
  </div>
</section>

<section class="housing-news">
  <div class="striped-line"></div>

  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h2>Housing News</h2>
      </div>
    </div>
  </div>
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
          <a class="mega-link" href="/nc-housing-coalition/"></a>
        </div>
      </div>
    </div>
  </div>
</section>
