<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Setup;

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Setup\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');

/**
 * Modify TinyMCE editor to remove unused items
 */
add_filter('tiny_mce_before_init', function($init) {
  // Block format elements to show in dropdown
  $init['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6;';
	return $init;
});

/**
* Retrieve adjacent post by author.
* Modified function from get_adjacent_post in wp-includes/link-template.php
*
* Can either be next or previous post.
*
* @param bool         $previous       Optional. Whether to retrieve previous post.
* @return mixed       Post object if successful. Null if global $post is not set. Empty string if no corresponding post exists.
*/
function get_adjacent_author_post( $previous = true ) {
  global $wpdb;

  if ( ( ! $post = get_post() ) )
  return null;

  $current_post_date = $post->post_date;

  $author = $post->post_author;

  $join = '';
  $where = '';

  $adjacent = $previous ? 'previous' : 'next';
  $op = $previous ? '<' : '>';
  $order = $previous ? 'DESC' : 'ASC';

  /**
  * Filter the JOIN clause in the SQL for an adjacent post query.
  *
  * The dynamic portion of the hook name, `$adjacent`, refers to the type
  * of adjacency, 'next' or 'previous'.
  *
  * @since 2.5.0
  *
  * @param string $join           The JOIN clause in the SQL.
  * @param bool   $in_same_term   Whether post should be in a same taxonomy term.
  * @param array  $excluded_terms Array of excluded term IDs.
  */
  $in_same_term = false;
  $excluded_terms = '';
  $join  = apply_filters( "get_{$adjacent}_post_join", $join, $in_same_term, $excluded_terms );

  print_r($join);

  /**
  * Filter the WHERE clause in the SQL for an adjacent post query.
  *
  * The dynamic portion of the hook name, `$adjacent`, refers to the type
  * of adjacency, 'next' or 'previous'.
  *
  * @since 2.5.0
  *
  * @param string $where          The `WHERE` clause in the SQL.
  * @param bool   $in_same_term   Whether post should be in a same taxonomy term.
  * @param array  $excluded_terms Array of excluded term IDs.
  */
  $where = apply_filters( "get_{$adjacent}_post_where", $wpdb->prepare( "WHERE p.post_date $op %s AND p.post_author = %d AND p.post_type = %s AND p.post_status = 'publish' $where", $current_post_date, $author, $post->post_type ), $in_same_term, $excluded_terms );

  /**
  * Filter the ORDER BY clause in the SQL for an adjacent post query.
  *
  * The dynamic portion of the hook name, `$adjacent`, refers to the type
  * of adjacency, 'next' or 'previous'.
  *
  * @since 2.5.0
  *
  * @param string $order_by The `ORDER BY` clause in the SQL.
  */
  $sort  = apply_filters( "get_{$adjacent}_post_sort", "ORDER BY p.post_date $order LIMIT 1" );

  $query = "SELECT p.ID FROM $wpdb->posts AS p $join $where $sort";
  $query_key = 'adjacent_post_' . md5( $query );
  $result = wp_cache_get( $query_key, 'counts' );
  if ( false !== $result ) {
    if ( $result )
    $result = get_post( $result );
    return $result;
  }

  $result = $wpdb->get_var( $query );
  if ( null === $result )
  $result = '';

  wp_cache_set( $query_key, $result, 'counts' );

  if ( $result )
  $result = get_post( $result );

  return $result;
}

// Search inside multimidensional object and return key
function object_search_deep($haystack, $field, $value) {
  foreach($haystack as $key => $item) {
    if ( strpos($item->$field, $value) !== false )
    return $key;
  }
  return false;
}
