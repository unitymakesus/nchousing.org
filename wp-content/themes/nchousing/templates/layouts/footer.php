<?php

use Roots\Sage\Assets;

?>
<section class="sponsors">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 text-center">
        <div class="striped-line">
        </div>
        <h4 class="extra-bottom-margin">Many thanks to our donors and investors</h4>
        <img src="<?php echo Assets\asset_path('images/bbt-logo.png'); ?>" srcset="<?php echo Assets\asset_path('images/bbt-logo@2x.png'); ?> 2x" alt="BB&amp;T" />
        <img src="<?php echo Assets\asset_path('images/oak-foundation-logo.png'); ?>" srcset="<?php echo Assets\asset_path('images/oak-foundation-logo@2x.png'); ?> 2x" alt="Oak Foundation" />
        <img src="<?php echo Assets\asset_path('images/zsr-logo.png'); ?>" srcset="<?php echo Assets\asset_path('images/zsr-logo@2x.png'); ?> 2x" alt="Z Smith Reynolds Foundation" />
        <img src="<?php echo Assets\asset_path('images/wells-fargo-logo.png'); ?>" srcset="<?php echo Assets\asset_path('images/wells-fargo-logo@2x.png'); ?> 2x" alt="Wells Fargo" />
        <img src="<?php echo Assets\asset_path('images/tcf-logo.png'); ?>" srcset="<?php echo Assets\asset_path('images/tcf-logo@2x.png'); ?> 2x" alt="Triangle Community Foundation" />
        <img src="<?php echo Assets\asset_path('images/pnc-logo.png'); ?>" srcset="<?php echo Assets\asset_path('images/pnc-logo@2x.png'); ?> 2x" alt="PNC" />
        <img src="<?php echo Assets\asset_path('images/suntrust-logo.png'); ?>" srcset="<?php echo Assets\asset_path('images/suntrust-logo@2x.png'); ?> 2x" alt="Suntrust" />
        <img src="<?php echo Assets\asset_path('images/kbr-logo.png'); ?>" srcset="<?php echo Assets\asset_path('images/kbr-logo@2x.png'); ?> 2x" alt="Kate B Reynolds Charitable Trust" />
        <img src="<?php echo Assets\asset_path('images/neighborworks-logo.png'); ?>" srcset="<?php echo Assets\asset_path('images/neighborworks-logo@2x.png'); ?> 2x" alt="NeighborWorks America" />
      </div>
    </div>
  </div>
</section>

<footer class="global-footer">
  <div class="striped-line"></div>

  <div class="container">
    <div class="text-center">
      <p class="h4">
        Get the latest news
        <a class="btn btn-skew btn-teal" data-toggle="modal" data-target="#emailSignupModal">Subscribe</a>
        <a class="icon-facebook" href="http://www.facebook.com/ncinitiative5800" target="_blank" rel="nofollow"></a>
        <a class="icon-twitter" href="http://twitter.com/ncinitiative" target="_blank" rel="nofollow"></a>
        <a class="icon-flickr" href="http://www.flickr.com/photos/ncinitiative/" target="_blank" rel="nofollow"></a>
      </p>

      <p>Copyright &copy; <?php echo date('Y'); ?> &nbsp;|&nbsp; NC Community Development Initiative &nbsp;|&nbsp; 919.828.5655 &nbsp;|&nbsp; <a href="mailto:<?php echo antispambot('info@ncinitiative.org'); ?>"><?php echo antispambot('info@ncinitiative.org'); ?></a></p>

      <p>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo Assets\asset_path('images/nccdi-logo-footer.jpg'); ?>" /></a>
        <a href="http://nchousing.org" target="_blank"><img src="<?php echo Assets\asset_path('images/nchc-logo-footer.jpg'); ?>" /></a>
      </p>
    </div>
  </div>
</footer>

<?php get_template_part('templates/components/email-signup'); ?>
