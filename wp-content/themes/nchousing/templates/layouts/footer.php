<?php

use Roots\Sage\Assets;
use Roots\Sage\Nav;

?>
<section class="sponsors">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 text-center">
        <div class="striped-line extra-bottom-margin">
          <h2>Many thanks to our sponsors</h2>
        </div>
        <img src="<?php echo Assets\asset_path('images/bank-of-america-logo.png'); ?>" srcset="<?php echo Assets\asset_path('images/bank-of-america-logo@2x.png'); ?> 2x" alt="Bank of America" />
        <img src="<?php echo Assets\asset_path('images/bbt-logo.png'); ?>" srcset="<?php echo Assets\asset_path('images/bbt-logo@2x.png'); ?> 2x" alt="BB&amp;T" />
        <img src="<?php echo Assets\asset_path('images/cahec-logo.png'); ?>" srcset="<?php echo Assets\asset_path('images/cahec-logo@2x.png'); ?> 2x" alt="CAHEC" />
        <img src="<?php echo Assets\asset_path('images/cohnreznick-logo.png'); ?>" srcset="<?php echo Assets\asset_path('images/cohnreznick-logo@2x.png'); ?> 2x" alt="CohnReznick" />
        <img src="<?php echo Assets\asset_path('images/first-citizens-logo.png'); ?>" srcset="<?php echo Assets\asset_path('images/first-citizens-logo@2x.png'); ?> 2x" alt="First Citizens Bank" />
        <img src="<?php echo Assets\asset_path('images/kbr-logo.png'); ?>" srcset="<?php echo Assets\asset_path('images/kbr-logo@2x.png'); ?> 2x" alt="Kate B Reynolds Charitable Trust" />
        <img src="<?php echo Assets\asset_path('images/nchfa-logo.png'); ?>" srcset="<?php echo Assets\asset_path('images/nchfa-logo@2x.png'); ?> 2x" alt="NC Housing Finance Agency" />
        <img src="<?php echo Assets\asset_path('images/neighborworks-logo.png'); ?>" srcset="<?php echo Assets\asset_path('images/neighborworks-logo@2x.png'); ?> 2x" alt="NeighborWorks America" />
        <img src="<?php echo Assets\asset_path('images/north-state-logo.png'); ?>" srcset="<?php echo Assets\asset_path('images/north-state-logo@2x.png'); ?> 2x" alt="North State Bank" />
        <img src="<?php echo Assets\asset_path('images/novogradac-logo.png'); ?>" srcset="<?php echo Assets\asset_path('images/novogradac-logo@2x.png'); ?> 2x" alt="Novogradac &amp; Company" />
        <img src="<?php echo Assets\asset_path('images/rbc-logo.png'); ?>" srcset="<?php echo Assets\asset_path('images/rbc-logo@2x.png'); ?> 2x" alt="RBC Capital Markets" />
        <img src="<?php echo Assets\asset_path('images/suntrust-logo.png'); ?>" srcset="<?php echo Assets\asset_path('images/suntrust-logo@2x.png'); ?> 2x" alt="Suntrust" />
        <img src="<?php echo Assets\asset_path('images/td-logo.png'); ?>" srcset="<?php echo Assets\asset_path('images/td-logo@2x.png'); ?> 2x" alt="TD Bank" />
        <img src="<?php echo Assets\asset_path('images/wells-fargo-logo.png'); ?>" srcset="<?php echo Assets\asset_path('images/wells-fargo-logo@2x.png'); ?> 2x" alt="Wells Fargo" />
      </div>
    </div>
  </div>
</section>

<footer class="global-footer">
  <div class="container">
    <div class="col-sm-6 col-md-4">
      <a href="/">
        <img src="<?php echo Assets\asset_path('images/nchc-gray-logo.png'); ?>" srcset="<?php echo Assets\asset_path('images/nchc-gray-logo@2x.png'); ?> 2x" alt="North Carolina Housing Coalition" />
      </a>
      <br /><br />
      <a href="http://ncinitiative.org/" target="_blank">
        <img src="<?php echo Assets\asset_path('images/nccdi-gray-logo.png'); ?>" srcset="<?php echo Assets\asset_path('images/nccdi-gray-logo@2x.png'); ?> 2x" alt="North Carolina Community Development Initiative" />
      </a>
    </div>

    <div class="col-sm-6 col-md-5">
      <address>5800 Faringdon Place<br />
        Raleigh, NC 27609</address>
      <p><tel>919.881.0707</tel> | <a href="/contact/">Contact Us</a></p>
      <br />
      <p><a class="btn btn-skew btn-lg btn-gold" href="/housing-matters-newsletter/">Subscribe</a></p>
    </div>

    <div class="col-sm-6 col-sm-push-6 col-md-push-0 col-md-3">
      <?php
      if (has_nav_menu('primary_navigation')) :
        wp_nav_menu(['theme_location' => 'footer_navigation', 'menu_class' => 'nav navbar-nav', 'depth' => 1, 'walker' => new Nav\NavWalker()]);
      endif;
      ?>
    </div>
  </div>

  <div class="below-footer">
    <div class="container">
      <div class="row">
        <div class="col-md-9">
          <a href="https://www.unitymakes.us/" target="_blank" class="unity-link">
            <?php echo file_get_contents(Assets\asset_path('images/made-with-unity.svg')); ?>
          </a>
          <span class="copyright">Copyright &copy; <?php echo date('Y'); ?> North Carolina Housing Coalition &nbsp;|&nbsp; <a href="/privacy-policy/">Privacy Policy</a></span>
        </div>

        <div class="col-md-3 text-right">
          <span class="uppercase">Follow Us</span>
          <a class="icon-facebook" href="http://www.facebook.com/NCHousing" target="_blank" rel="nofollow" aria-label="Facebook"></a>
          <a class="icon-twitter" href="http://twitter.com/NCHousing" target="_blank" rel="nofollow" aria-label="Twitter"></a>
        </div>
      </div>
    </div>
  </div>
</footer>
