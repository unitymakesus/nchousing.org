<?php

use Roots\Sage\ShareCount;

// Get post ID
global $wp_query;
$id = $wp_query->post->ID;

$crunchifyURL = urlencode(get_permalink($id));
$crunchifyTitle = urlencode(get_the_title($id));
$crunchifyText = urlencode(get_the_title($id) . ': ' . get_permalink($id));

// Construct sharing URL without using any script
$twitterURL = 'https://twitter.com/intent/tweet?text='.$crunchifyTitle.'&amp;url='.$crunchifyURL.'&amp;via=ncinitiative';
$facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$crunchifyURL;
$linkedinURL = 'http://www.linkedin.com/shareArticle?mini=true&amp;url='.$crunchifyURL.'&title='.$crunchifyTitle.'&source=NCInitiative';
$emailURL = 'mailto:?subject='.$crunchifyTitle.'&amp;body='.$crunchifyText;

// Get current counts of social media shares & store in transient
$counts = get_transient('social-counts-' . $id);
if ($counts === false) {
  $social_counts = new ShareCount\socialNetworkShareCount(array(
    'url' => $crunchifyURL,
    'facebook' => true,
    'twitter' => true,
    'buffer' => true,
    'pinterest' => true,
    'linkedin' => true,
    'google' => true
  ));
  $counts = json_decode($social_counts->getShareCounts());
  set_transient('social-counts-' . $id, $counts, HOUR_IN_SECONDS);
}

// Translate share counts to K if number is in thousands
function num_format($val) {
  $letter = "";
  while ($val >= 1000) {
    $val /= 1000;
    $val = round($val, 1);
    $letter .= "K";
  }
  $letter = str_replace("KKK", "B", $letter);
  $letter = str_replace("KK", "M", $letter);
  return $val.$letter;
}
$count_num = num_format($counts->total);
?>

<div class="social-share-buttons print-no">
  <?php if ($count_num != 0) { ?>
    <div class="count"><span class="num"><?php echo $count_num; ?></span> shares</div>
  <?php } ?>
  <a rel="nofollow" class="icon-facebook social-share-link" href="<?php echo $facebookURL; ?>" target="_blank">
    Share on facebook
  </a>
  <a rel="nofollow" class="icon-twitter social-share-link" href="<?php echo $twitterURL; ?>" target="_blank">
    Tweet on Twitter
  </a>
  <a rel="nofollow" class="icon-linkedin social-share-link" href="<?php echo $linkedinURL; ?>" target="_blank">
    Share on LinkedIn
  </a>
  <a rel="nofollow" class="icon-email social-share-link" href="<?php echo $emailURL; ?>" target="_blank">
    Email this page
  </a>
  <a rel="nofollow" class="other-share icon-fax hidden-xs hidden-sm" href="http://www.printfriendly.com/print?<?php echo $crunchifyURL; ?>" target="_blank">
    Print this page
  </a>
</div>

<div class="social-share-modal print-no">
    <a data-toggle="modal" data-target="#social-share-modal" class="icon-share" href="#"></a>

    <div class="modal fade" id="social-share-modal" tabindex="-1" role="dialog" aria-labelledby="social-share-modal">
      <div class="modal-dialog" role="document">
            <a rel="nofollow" class="icon-facebook social-share-link" href="<?php echo $facebookURL; ?>" target="_blank">
              Share on facebook
            </a>
            <a rel="nofollow" class="icon-twitter social-share-link" href="<?php echo $twitterURL; ?>" target="_blank">
              Tweet on Twitter
            </a>
            <a rel="nofollow" class="icon-linkedin social-share-link" href="<?php echo $linkedinURL; ?>" target="_blank">
              Share on LinkedIn
            </a>
            <a rel="nofollow" class="icon-email social-share-link" href="<?php echo $emailURL; ?>" target="_blank">
              Email this page
            </a>
            <a rel="nofollow" class="other-share icon-fax hidden-xs hidden-sm" href="http://www.printfriendly.com" onclick="window.print();return false;">
              Print this page
            </a>
          </div>
    </div>
</div>
