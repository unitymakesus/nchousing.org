<?php
/*
Plugin Name: Housing News CPT
Description: Allows for easy bulk management of Housing News.
Version: 1.0.12
Author: Unity Digial Agency
Author URI: https://www.unitymakes.us/
License: GPL v2 or newer <https://www.gnu.org/licenses/gpl.txt>
*/

/**
 * Run this hook when plugin is activated
 * Add new db table for CPT items
 *
 */
function activate_unity_micro_cpt() {
  global $wpdb;
  $table_name = $wpdb->prefix . 'housing_news';

  // Check if table is not already created
  if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
      id mediumint(9) NOT NULL AUTO_INCREMENT,
      added_time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
      title varchar(255) DEFAULT '' NOT NULL,
      date int(10) DEFAULT NULL,
      source varchar(255) DEFAULT '' NOT NULL,
      url varchar(255) DEFAULT '' NOT NULL,
      PRIMARY KEY (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
  }

}
register_activation_hook( __FILE__, 'activate_unity_micro_cpt' );

/**
 * Plugin file includes
 */

// Init CMB2 plugin
require_once('vendor/cmb2/init.php');

// Extend WP_List_Table class
require_once('inc/class-housing-news-table.php');

// Add new item form
require_once('inc/class-new-housing-news.php');

// Settings page
require_once('inc/settings-page.php');

// Shortcode
require_once('inc/shortcodes.php');
