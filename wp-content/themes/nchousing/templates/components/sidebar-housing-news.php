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
  $days = $wpdb->get_results("SELECT DISTINCT DAY (post_date) AS day, MONTH( post_date ) AS month ,	YEAR( post_date ) AS year, COUNT( id ) as post_count FROM $wpdb->posts WHERE post_status = 'publish' and post_date <= now( ) and post_type = 'housing-news' GROUP BY day, month , year ORDER BY post_date DESC");

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
                <?php
                $hnews = new WP_Query([
                  'post_type' => 'housing-news',
                  'date_query' => [
                    'year' => $day->year,
                    'month' => $day->month,
                    'day' => $day->day
                  ]
                ]);
                if ($hnews->have_posts()) : while ($hnews->have_posts()) : $hnews->the_post(); ?>
                  <a href="<?php the_permalink(); ?>">
                    <?php echo date_i18n("F j", mktime(0, 0, 0, $day->month, $day->day, $day->year)); ?>
                  </a>
                <?php endwhile; endif; wp_reset_query(); ?>
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
