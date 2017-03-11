<?php
/**
 * Define the admin page
 */
function housing_news_add_menu_items() {
  add_menu_page('Housing News Table', 'Housing News', 'edit_pages', 'housing_news', 'render_housing_news_page', 'dashicons-list-view', 8);
}
add_action('admin_menu', 'housing_news_add_menu_items');

/**
 * Render admin page table
 */
function render_housing_news_page() {
  // Create instances of classes
  $addNewItem = new New_Housing_News();
  $housingNewsTable = new Housing_News_Table();
  // Fetch and prepare data
  $housingNewsTable->prepare_items();

  ?>
  <div class="wrap">
    <h2>Housing News</h2>

    <?php if ($_GET['action_d'] === 'success') : ?>
      <div class="notice notice-success is-dismissible">
  			<p>Housing news successfully deleted.</p>
  		</div>
    <?php endif; ?>

    <?php if ($_GET['action_e'] === 'success') : ?>
      <div class="notice notice-success is-dismissible">
  			<p>Housing news successfully updated.</p>
  		</div>
    <?php endif; ?>

		<div id="poststuff">
			<div id="post-body" class="metabox-holder">
				<div id="post-body-content">

          <?php if ($_GET['action'] === 'edit') { ?>
            <h3>Edit Housing News</h3>
            <p><a href="<?php echo menu_page_url( 'housing_news', false ); ?>">Back to add new</a></p>
          <?php } else { ?>
            <h3>Add New</h3>
          <?php } ?>

          <?php $addNewItem->display_form(); ?>

          <h3>All Housing News</h3>
					<div class="meta-box-sortables ui-sortable">
						<form method="post">
							<?php $housingNewsTable->display(); ?>
						</form>
					</div>
				</div>
			</div>
			<br class="clear">
		</div>
  </div>
  <?php
}

add_action( 'load-toplevel_page_housing_news', 'after_action_redirect' );
function after_action_redirect() {
  if ((isset($_GET['action']) && $_GET['action'] == 'delete')
    || (isset($_POST['action']) && $_POST['action'] == 'bulk-delete')
    || (isset($_POST['action2']) && $_POST['action2'] == 'bulk-delete')) {
    $housingNewsTable = new Housing_News_Table();
    $housingNewsTable->process_bulk_action();
    wp_redirect(add_query_arg('action_d', 'success', menu_page_url( 'housing_news', false )));
    exit;
  }
  if ((isset($_GET['action']) && $_GET['action'] == 'edit')
    && (isset($_POST['submit-cmb']))) {
    $addNewItem = new New_Housing_News();
    $addNewItem->handle_edit_submission();
    wp_redirect(add_query_arg('action_e', 'success', menu_page_url( 'housing_news', false )));
    exit;
  }
}
