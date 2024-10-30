<?php
if ( bc_fs()->can_use_premium_code() ) {
class Bootitems_Core_Mega_Menu {
	function __construct() {
		// add custom menu fields to menu
		add_filter( 'wp_setup_nav_menu_item', array( $this, 'bc_add_custom_nav_fields' ) );
		// save menu custom fields
		add_action( 'wp_update_nav_menu_item', array( $this, 'bc_update_custom_nav_fields'), 10, 3 );
		// edit menu walker
		add_filter( 'wp_edit_nav_menu_walker', array( $this, 'rc_scm_edit_walker'), 10, 2 );
	} // end constructor
	
	/**
	 * Add custom fields to $item nav object
	 * in order to be used in custom Walker
	 *
	 * @access      public
	 * @since       1.0 
	 * @return      void
	*/
	function bc_add_custom_nav_fields( $menu_item ) {
	    $menu_item->ficon = get_post_meta( $menu_item->ID, '_menu_item_ficon', true );
	    $menu_item->megamenu = get_post_meta( $menu_item->ID, '_menu_item_megamenu', true );
	    $menu_item->column = get_post_meta( $menu_item->ID, '_menu_item_column', true );
	    $menu_item->disablet = get_post_meta( $menu_item->ID, '_menu_item_disablet', true );
	    return $menu_item;
	}
	/**
	 * Save menu custom fields
	 *
	 * @access      public
	 * @since       1.0 
	 * @return      void
	*/
	function bc_update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {

	    // Check if element is properly sent
        if( !isset( $_REQUEST['menu-item-ficon'][$menu_item_db_id] ) ) {
           $_REQUEST['menu-item-ficon'][$menu_item_db_id] = '';
        }
		$ficon_value = sanitize_text_field($_REQUEST['menu-item-ficon'][$menu_item_db_id]);
		update_post_meta( $menu_item_db_id, '_menu_item_ficon', $ficon_value );
	  
	    // Check if element is properly sent
        if( !isset( $_REQUEST['menu-item-megamenu'][$menu_item_db_id] ) ) {
           $_REQUEST['menu-item-megamenu'][$menu_item_db_id] = '';
        }
        $megamenu_value = sanitize_key($_REQUEST['menu-item-megamenu'][$menu_item_db_id]);
        update_post_meta( $menu_item_db_id, '_menu_item_megamenu', $megamenu_value );
   
	    // Check if element is properly sent
        if( !isset( $_REQUEST['menu-item-column'][$menu_item_db_id] ) ) {
           $_REQUEST['menu-item-column'][$menu_item_db_id] = '';
        }
	   $column_valid_values = array(
					   '50%',
					   '33%',
					);
        $column_value = sanitize_text_field($_REQUEST['menu-item-column'][$menu_item_db_id]);
		if( in_array( $column_value, $column_valid_values ) ) {
        update_post_meta( $menu_item_db_id, '_menu_item_column', $column_value );
		}
	    // Check if element is properly sent
        if( !isset( $_REQUEST['menu-item-disablet'][$menu_item_db_id] ) ) {
           $_REQUEST['menu-item-disablet'][$menu_item_db_id] = '';
        }
        $disablet_value = sanitize_key($_REQUEST['menu-item-disablet'][$menu_item_db_id]);
        update_post_meta( $menu_item_db_id, '_menu_item_disablet', $disablet_value );
	}
	/**
	 * Define new Walker edit
	 *
	 * @access      public
	 * @since       1.0 
	 * @return      void
	*/
	function rc_scm_edit_walker($walker,$menu_id) {
	    return 'Bootitems_Core_Walker_Nav_Menu_Edit';
	}
}

// instantiate plugin's class
$GLOBALS['Bootitems_Core_Mega_Menu'] = new Bootitems_Core_Mega_Menu();
require_once BOOTITEMS_CORE_PATH . 'inc/menu/bootitems_edit_walker.php';
require_once BOOTITEMS_CORE_PATH . 'inc/menu/bootitems_walker.php';

}