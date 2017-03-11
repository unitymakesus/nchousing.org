<?php
/**
 * This class manages creating new housing news items
 *
 */
if (!class_exists('New_Housing_News')) {
  class New_Housing_News {
    // Set constants
    private $metabox_id = 'new_micro_cpt_item';
    private $key = 'housing_news';

    // These things will happen as soon as class is called
    public function __construct() {
      $this->add_form_fields();
    }

    // Set field data when editing item
    function cpt_set_field_data($field_args, $field) {
      if ('edit' === $_GET['action']) {
        $field_data = $this->get_field_data($_GET['id'], $field_args['id']);
        return $field_data;
      }
    }

    /**
     * Add form fields
     *
     */
    function add_form_fields() {
      global $cmb;

      $cmb = new_cmb2_box( array(
        'id'         => $this->metabox_id,
        'hookup'     => false,
        'save_fields'=> false,
        'cmb_styles' => true,
        'show_on'    => array(
          'key'   => 'options-page',
          'value' => array( $this->key, )
        ),
      ) );

      // Set our CMB2 fields
      $cmb->add_field( array(
        'name'    => 'Title',
        'id'      => 'title',
        'type'    => 'text',
        'default'  => array($this, 'cpt_set_field_data')
      ) );

      $cmb->add_field( array(
        'name'    => 'Original Date',
        'desc'    => 'Select the date of publication',
        'id'      => 'date',
        'type'    => 'text_date_timestamp',
        'default'  => array($this, 'cpt_set_field_data')
      ) );

      $cmb->add_field( array(
        'name'    => 'Source Name',
        'id'      => 'source',
        'type'    => 'text',
        'default'  => array($this, 'cpt_set_field_data')
      ) );

      $cmb->add_field( array(
        'name'    => 'Link',
        'id'      => 'url',
        'type'    => 'text_url',
        'protocols' => array('http', 'https'),
        'default'  => array($this, 'cpt_set_field_data')
      ) );
    }

    /**
     * Create "add new" form
     *
     */
    function display_form() {
      global $cmb;

      $output = '';

      // Handle form saving (if form has been submitted)
      $new_id = $this->handle_form_submission( $cmb, $atts );

      if ( $new_id ) {

          if ( is_wp_error( $new_id ) ) {

              // If there was an error with the submission, add it to our ouput.
              $output .= '<h3>' . sprintf( __( 'There was an error in the submission: %s', 'wds-post-submit' ), '<strong>'. $new_id->get_error_message() .'</strong>' ) . '</h3>';

          } else {

              // Get submitter's name
              $name = isset( $_POST['submitted_author_name'] ) && $_POST['submitted_author_name']
                  ? ' '. $_POST['submitted_author_name']
                  : '';

              // Add notice of submission
              $output .= '<h3>' . sprintf( __( 'Thank you %s, your new post has been submitted and is pending review by a site administrator.', 'wds-post-submit' ), esc_html( $name ) ) . '</h3>';
          }

      }

      if ('edit' === $_GET['action']) {
        $button = 'Update';
      } else {
        $button = 'Add New';
      }

      $output = cmb2_metabox_form($this->metabox_id, $this->key, array(
        'save_button' => $button
      ));

      return $output;
    }

    /**
     * Handles form submission on save
     *
     */
    function handle_edit_submission() {
      global $cmb;

      $this->handle_form_submission($cmb, $atts);
    }

    function handle_form_submission($cmb, $post_data = array()) {
      // If no form submission, bail
      if ( empty( $_POST ) ) {
          return false;
      }

      // check required $_POST variables and security nonce
      if (
          ! isset( $_POST['submit-cmb'], $_POST['object_id'], $_POST[ $cmb->nonce() ] )
          || ! wp_verify_nonce( $_POST[ $cmb->nonce() ], $cmb->nonce() )
      ) {
          return new WP_Error( 'security_fail', __( 'Security check failed.' ) );
      }

      // Fetch sanitized values
      $sanitized_values = $cmb->get_sanitized_values( $_POST );

      $this->insert_data($sanitized_values);
    }

    /**
     * Get field data when editing item
     *
     */
    function get_field_data($id, $field) {
      global $wpdb;
      $table_name = $wpdb->prefix . 'housing_news';

      $data = $wpdb->get_results($wpdb->prepare(
        "SELECT $field FROM $table_name WHERE id = %d",
        $id
      ), ARRAY_N);

      return $data[0][0];
    }

    /**
     * Insert data into custom table
     *
     */
    function insert_data($data) {
      global $wpdb;
      $table_name = $wpdb->prefix . 'housing_news';

      if ('edit' === $_GET['action']) {
        $result = $wpdb->update(
          $table_name,
          array(
            'added_time'  => current_time( 'mysql' ),
            'title'       => $data['title'],
            'date'        => $data['date'],
            'source'      => $data['source'],
            'url'         => $data['url']
          ),
          array('id' => $_GET['id']),
          array(
            '%s',
            '%s',
            '%d',
            '%s',
            '%s'
          ),
          array('%d')
        );
      } else {
        $wpdb->insert(
          $table_name,
          array(
            'added_time'  => current_time( 'mysql' ),
            'title'       => $data['title'],
            'date'        => $data['date'],
            'source'      => $data['source'],
            'url'         => $data['url']
          ),
          array(
            '%s',
            '%s',
            '%d',
            '%s',
            '%s'
          )
        );
      }
    }
  }
}
