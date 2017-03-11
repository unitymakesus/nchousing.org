<?php
/**
 * All Housing News Table
 * Thanks to https://github.com/CaerCam/Custom-AJAX-List-Table-Example
 */

// Load WP_List_Table from wp-core
if ( ! class_exists( 'WP_List_Table' ) )
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );

// Create a new list table for housing news
class Housing_News_Table extends WP_List_Table {
  /**
   * Constructor overrides
   */
  function __construct() {
    parent::__construct(array(
      'singular'  => 'housing-news-item',
      'plural'    => 'housing-news',
      'ajax'      => false
    ));
  }

  /**
   * Default method for columns
   *
	 * @param array $item A singular item (one full row's worth of data)
	 * @param array $column_name The name/slug of the column to be processed
	 *
	 * @return string Text or HTML to be placed inside the column <td>
   */
  function column_default($item, $column_name) {
    switch ($column_name) {
      case 'date':
        return date('m/d/Y', $item->$column_name);
        break;
      case 'url':
        return '<a href="' . $item->$column_name . '" target="_blank">' . $item->$column_name . '</a>';
      default:
        // Show the whole array for troubleshooting purposes
        return $item->$column_name;
    }
  }

  /**
   * Custom column menthod to display title
   *
	 * @see WP_List_Table::single_row_columns()
	 *
	 * @param array $item A singular item (one full row's worth of data)
	 *
	 * @return string Text to be placed inside the column <td> (title only)
   */
  function column_title($item) {
    // Create nonce
    $action_nonce = wp_create_nonce('housing_news_action');

    // Build row actions
    $actions = array(
      'edit'		=> sprintf( '<a href="?page=%s&action=%s&id=%s">Edit</a>', $_REQUEST['page'], 'edit', $item->id ),
			'delete'	=> sprintf( '<a href="?page=%s&action=%s&id=%s&_wpnonce=%s">Delete</a>', $_REQUEST['page'], 'delete', $item->id, $action_nonce ),
    );

    // Return the title contents
    return sprintf('%1$s <span style="color:silver">(id:%2$s)</span>%3$s',
      $item->title,
      $item->id,
      $this->row_actions( $actions )
    );
  }

  /**
   * Custom column method for checkbox
   *
	 * @see WP_List_Table::single_row_columns()
	 *
	 * @param array $item A singular item (one full row's worth of data)
	 *
	 * @return string Text to be placed inside the column <td>
   */
  function column_cb($item) {
		return sprintf(
			'<input type="checkbox" name="%1$s[]" value="%2$s" />',
			$this->_args['singular'],  	//Let's simply repurpose the table's singular label ("housing-news-item")
			$item->id			//The value of the checkbox should be the record's id
		);
  }

  /**
   * Get the table's columns and titles
   *
	 * @see WP_List_Table::single_row_columns()
	 *
	 * @return array An associative array containing column information: 'slugs'=>'Visible Titles'
   */
  function get_columns() {
    return $columns = array(
      'cb'      => '<input type="checkbox" />',
      'title'   => 'Title',
      'date'    => 'Original Date',
      'source'  => 'Source Name',
      'url'     => 'Link'
    );
  }

  /**
   * Make sortable columns
   *
 	 * @return array An associative array containing all the columns that should be sortable: 'slugs'=>array('data_values',bool)
   */
  function get_sortable_columns() {
    return $sortable_columns = array(
      'title'   => array('title', false),
      'date'    => array('date', true),   // true means it's already sorted
      'source'  => array('source', false)
    );
  }

  /**
   * Returns an associative array containing the bulk action
   *
	 * @return array An associative array containing all the bulk actions: 'slugs'=>'Visible Titles'
   */
  function get_bulk_actions() {
    return $actions = array(
      'bulk-delete' => 'Delete'
    );
  }

  /**
   * Handle bulk actions
   *
	 * @see $this->prepare_items()
   */
  function process_bulk_action() {
    // Detect when bulk action is triggered
    if ('delete' === $this->current_action()) {
      // Verify nonce
      $nonce = esc_attr($_REQUEST['_wpnonce']);

      if (!wp_verify_nonce($nonce, 'housing_news_action')) {
        die('You don\'t have permission to edit this');
      } else {
        self::delete_housing_news(absint($_GET['id']));
      }
    }

		// die($_POST['action']);

    // If the delete bulk action is triggered
    if ((isset($_POST['action']) && $_POST['action'] == 'bulk-delete')
      || (isset($_POST['action2']) && $_POST['action2'] == 'bulk-delete')
    ) {
      $delete_ids = esc_sql($_POST['housing-news-item']);

			if (!empty($delete_ids)) {
	      // loop over array and delete them
	      foreach ($delete_ids as $id) {
	        self::delete_housing_news($id);
				}
			}
    }
  }

  /**
   * Prepare the items for display
   *
	 * @global WPDB $wpdb
	 * @uses $this->_column_headers
	 * @uses $this->items
	 * @uses $this->get_columns()
	 * @uses $this->get_sortable_columns()
	 * @uses $this->get_pagenum()
	 * @uses $this->set_pagination_args()
   */
  function prepare_items() {
    global $wpdb;
    $screen = get_current_screen();

    // Handle bulk actions
    // $this->process_bulk_action();

    // Set up query
    $query = "SELECT * FROM {$wpdb->prefix}housing_news";

    // Set up orderby and order
    $orderby = !empty($_GET["orderby"]) ? $_GET["orderby"] : 'date';
    $order = !empty($_GET["order"]) ? $_GET["order"] : 'DESC';
    if(!empty($orderby) & !empty($order)){ $query.=' ORDER BY '.$orderby.' '.$order; }

    // Determine pagination
    $totalitems = $wpdb->query($query); //return the total number of affected rows
    $paged = !empty($_GET["paged"]) ? $_GET["paged"] : '';
    $per_page = 20;
    if(empty($paged) || !is_numeric($paged) || $paged<=0 ){ $paged=1; }

		//How many pages do we have in total?
		$totalpages = ceil($totalitems/$per_page);

		//adjust the query to take pagination into account
		if(!empty($paged) && !empty($per_page)) {
			$offset = ($paged-1)*$per_page;
			$query .= ' LIMIT '.(int)$offset.','.(int)$per_page;
		}

		// Register the pagination
    $this->set_pagination_args( array(
      "total_items" => $totalitems,
      "total_pages" => $totalpages,
      "per_page" => $per_page,
    ) );

    // Define column headers
    $columns = $this->get_columns();
    $hidden = array();
    $sortable = $this->get_sortable_columns();

    // Build array of column headers
    $this->_column_headers = array($columns, $hidden, $sortable);

    // Fetch the items
    $this->items = $wpdb->get_results($query);

  }

  /**
   * Display the table
	 * Adds a Nonce field and calls parent's display method
	 *
	 * @since 3.1.0
   * @access public
   */
  function display() {
    wp_nonce_field('ajax-housing-news-nonce', '_ajax_housing_news_nonce');

		echo '<input type="hidden" id="order" name="order" value="' . $this->_pagination_args['order'] . '" />';
		echo '<input type="hidden" id="orderby" name="orderby" value="' . $this->_pagination_args['orderby'] . '" />';

		parent::display();
  }

  /**
   * Handle incoming ajax request
   *
   * @since 3.1.0
   * @access public
   */
  // function ajax_response() {
  //   check_ajax_referer('ajax-housing-news-nonce', '_ajax_housing_news_nonce');
  //
  //   $this->prepare_items();
  //
  //   extract($this->args);
  //   extract($this->_pagination_args, EXTR_SKIP);
  //
  //   ob_start();
  //   if (!empty($_REQUEST['no_placeholder'])) {
  //     $this->display_rows();
  //   } else {
  //     $this->display_rows_or_placeholder();
  //   }
  //   $rows = ob_get_clean();
  //
  //   ob_start();
  //   $this->print_column_headers();
  //   $headers = ob_get_clean();
  //
  //   ob_start();
  //   $this->pagination('top');
  //   $pagination_top = ob_get_clean();
  //
  //   ob_start();
  //   $this->pagination('bottom');
  //   $pagination_bottom = ob_get_clean();
  //
  //   $response = array('rows' => $rows);
  //   $response['pagination']['top'] = $pagination_top;
  //   $response['pagination']['bottom'] = $pagination_bottom;
  //   $response['column_headers'] = $headers;
  //
  //   if (isset($total_items)) {
  //     $response['total_items_i18n'] = sprintf( _n( '1 item', '%s items', $total_items ), number_format_i18n( $total_items ) );
  //   }
  //
  //   if (isset($total_pages)) {
  //     $response['total_pages'] = $total_pages;
  //     $response['total_pages_i18n'] = number_format_i18n($total_pages);
  //   }
  //
  //   die(json_encode($response));
  // }

  /**
   * Delete housing-news item
   *
   * @param int $id customer ID
   */
  public static function delete_housing_news($id) {
    global $wpdb;

    $wpdb->delete(
      "{$wpdb->prefix}housing_news",
      ['ID' => $id],
      ['%d']
    );

		$wpdb->print_error();
  }

  /**
   * Count number of records in database
   *
   * @return null|string
   */
  public static function record_count() {
    global $wpdb;

    return $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->prefix}housing_news");
  }

  /** Text displayed when no customer data is available */
  public function no_items() {
    _e( 'No housing news found.', 'sp' );
  }
}
