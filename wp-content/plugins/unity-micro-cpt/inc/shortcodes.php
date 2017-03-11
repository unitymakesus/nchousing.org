<?php
/**
 * Display # of most recent items
 *
 */
add_shortcode('recent-housing-news', 'show_recent_housing_news');
function show_recent_housing_news( $atts, $content = null ) {
  $a = shortcode_atts( array(
    'number' => 9
  ), $atts );

  ?>
    <div class="col-md-4">
      <ul class="hnews-items">
        <?php
        global $wpdb;

        $number = $a['number'];

        // Set up query
        $query = "SELECT * FROM {$wpdb->prefix}housing_news ORDER BY date DESC";

        // If count is less than limit, determine where to break the column. Otherwise, set column break at a third the limit
        $count = $wpdb->query($query);
        if ($count < $number) {
          $colbreak = ceil($count/3);
        } else {
          $colbreak = $number/3;
        }

        // Fetch the items
        $query .= " LIMIT %d";
        $quargs[] = $number;
        $items = $wpdb->get_results($wpdb->prepare($query, $quargs));

        $i = 0;

        while ($i < $number && $i < $count) {
          if ($i > 0 && $i % $colbreak == 0) {
            echo '</ul></div><div class="col-md-4"><ul class="hnews-items">';
          }
          $item = $items[$i];
          ?>

          <li data-source="<?php echo $item->url; ?>">
            <a class="mega-link" href="<?php echo $item->url; ?>" target="_blank"></a>
            <h3><?php echo $item->title; ?></h3>
            <p class="meta"><?php echo $item->source; ?> | <?php echo date('m/d/Y', $item->date); ?> <span class="icon-external-link"></span></p>
          </li>

          <?php
          $i++;
        } ?>
      </ul>
    </div>
  <?php
}

/**
 * Display archives page with sidebar
 *
 */
add_shortcode('housing-news-archives', 'show_housing_news_archives');
function show_housing_news_archives( $atts, $content = null ) {
  $a = shortcode_atts( array(), $atts );

  ?>
    <main class="main">
      <article <?php post_class('housing-news'); ?>>

        <div class="entry-content">
          <?php if (!empty($_GET['d'])) { ?>
            <h3><?php echo date('F j, Y', $_GET['d']); ?></h3>
          <?php } ?>

          <ul class="hnews-items">
            <?php
            global $wpdb;

            // Set up query
            $query = "SELECT * FROM {$wpdb->prefix}housing_news";

            // Only get the date in query args
            if (!empty($_GET['d'])) {
              $query .= " WHERE date = %d";
              $quargs[] = $_GET['d'];
            }

            // Order by
            $query .= " ORDER BY date DESC";

            // Determine pagination
            $totalitems = $wpdb->query($query); //return the total number of affected rows
            $paged = get_query_var( 'paged' );
            $per_page = 10;

            if(empty($paged) || !is_numeric($paged) || $paged<=0 ) { $paged=1; }

        		//How many pages do we have in total?
        		$totalpages = ceil($totalitems/$per_page);

        		//adjust the query to take pagination into account
        		if(!empty($paged) && !empty($per_page)) {
        			$offset = ($paged-1)*$per_page;
        			$query .= ' LIMIT '.(int)$offset.','.(int)$per_page;
        		}

            // Fetch the items
            $items = $wpdb->get_results($wpdb->prepare($query, $quargs));

            foreach ($items as $item) { ?>
              <li>
                <a class="mega-link" href="<?php echo $item->url; ?>" target="_blank" onclick="ga('send', 'event', 'ednews', 'click');"></a>
                <h3><?php echo $item->title; ?></h3>
                <p class="meta"><?php echo $item->source; ?> | <?php echo date('m/d/Y', $item->date); ?> <span class="icon-external-link"></span></p>
              </li>
            <?php } ?>
          </ul>
        </div>

      </article>

      <?php
      $big = 999999999; // need an unlikely integer
      $page_args = array(
      	'base'               => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
      	'format'             => '?paged=%#%',
      	'total'              => $totalpages,
      	'current'            => $paged,
      	'show_all'           => false,
      	'end_size'           => 1,
      	'mid_size'           => 2,
      	'prev_next'          => true,
      	'prev_text'          => __('« Previous'),
      	'next_text'          => __('Next »'),
      	'type'               => 'plain',
      	'add_args'           => false,
      	'add_fragment'       => '',
      	'before_page_number' => '',
      	'after_page_number'  => ''
      );

      echo paginate_links( $page_args );
      ?>
    </main>

    <aside class="sidebar">
      <div class="well accordion" id="accordion-years" role="tablist" aria-multiselectable="true">
        <?php
        /*
         * Collapsing daily archives widget, grouped by year and month
         *
         */
        global $wpdb, $wp_query;

        $year_prev = null;
        $month_prev = null;

        // Get unique dates of each post in the database
        $days = $wpdb->get_results("SELECT DISTINCT DAY( CONVERT_TZ(FROM_UNIXTIME(date), '-06:00',  '+00:00') ) AS day, MONTH( CONVERT_TZ(FROM_UNIXTIME(date), '-06:00',  '+00:00') ) AS month, YEAR( CONVERT_TZ(FROM_UNIXTIME(date), '-06:00',  '+00:00') ) AS year, COUNT( id ) AS post_count FROM {$wpdb->prefix}housing_news GROUP BY day, month , year ORDER BY date DESC");

        // Determine which years and months need to be expanded on page load
        if (is_archive()) {
          $expanded_year = $wp_query->query_vars['year'];
          $expanded_month = $wp_query->query_vars['monthnum'];
        } else {
          $expanded_year = $days[0]->year;
          $expanded_month = $days[0]->month;
        }

        // Determine how many days there are and add iterator so we can check for the last day
        $size = sizeof($days);
        $i = 1;

        // Loop through each date to create the nested structure
        foreach($days as $day) :
          $year_current = $day->year;
          $month_current = $day->month; ?>

          <?php if (($month_prev !== null) && ($month_current != $month_prev)) { ?>
            </ul>
            </div><!-- .wrapper-month -->
            </li><!-- .archive-month -->
          <?php } ?>

          <?php if ($year_current != $year_prev) { ?>
            <?php if ($year_prev !== null) {?>
              </div><!-- #accordion-months -->
              </div><!-- .wrapper-year -->
              </div><!-- .archive-year -->
            <?php } ?>

            <div class="panel archive-year">
              <h4 class="panel-heading" role="tab" id="heading-<?php echo $day->year; ?>">
                <a class="collapsed" data-toggle="collapse" data-parent="#accordion-years" href="#collapse-<?php echo $day->year; ?>" aria-expanded="false" aria-controls="collapse-<?php echo $day->year; ?>">
                  <?php echo $day->year; ?>
                </a>
              </h4>
              <div class="panel-collapse collapse <?php if ($day->year == $expanded_year) { echo 'in'; } ?> wrapper-year" id="collapse-<?php echo $day->year; ?>" role="tabpanel" aria-labelledby="heading-<?php echo $day->year; ?>">
                <div class="accordion" id="accordion-months-<?php echo $day->year; ?>" role="tablist" aria-multiselectable="true">
                  <ul class="nav nav-stacked has-padding">
          <?php } ?>

          <?php if ($month_current != $month_prev) { ?>
            <li class="panel archive-month">
              <h5 class="archive-heading" role="tab" id="heading-<?php echo $day->month; ?>-<?php echo $day->year; ?>">
                <a class="collapsed" data-toggle="collapse" data-parent="#accordion-months-<?php echo $day->year; ?>" href="#collapse-<?php echo $day->month; ?>-<?php echo $day->year; ?>" aria-expanded="false" aria-controls="collapse-<?php echo $day->month; ?>-<?php echo $day->year; ?>">
                  <?php echo date_i18n("F", mktime(0, 0, 0, $day->month, 1, $day->year)); ?>
                </a>
              </h5>
              <div class="panel-collapse collapse <?php if ($day->year == $expanded_year && $day->month == $expanded_month) { echo 'in'; } ?> wrapper-month" id="collapse-<?php echo $day->month; ?>-<?php echo $day->year; ?>" role="tabpanel" aria-labelledby="heading-<?php echo $day->month; ?>-<?php echo $day->year; ?>">
                <ul class="nav nav-stacked has-padding">
                  <?php } ?>

                    <li class="archive-day">
                      <?php $date = strtotime("$day->month/$day->day/$day->year"); ?>
                      <a href="<?php echo esc_url(add_query_arg('d', $date, get_permalink())); ?>">
                        <?php echo date_i18n("F j", mktime(0, 0, 0, $day->month, $day->day, $day->year)); ?>
                      </a>
                    </li>

                  <?php if ($i == $size) { ?>
                </ul>
              </div><!-- .wrapper-month -->
            </li><!-- .archive-month -->
          <?php } ?>

          <?php
          $year_prev = $year_current;
          $month_prev = $month_current;
          $i++;
        endforeach;
        ?>
        </ul>
        </div><!-- #accordion-months -->
        </div><!-- .wrapper-year -->
        </div><!-- .archive-year -->
      </div><!-- #accordion-years -->
    </aside>
  <?php
}
