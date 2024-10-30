<?php
/**
 * Register Menu for Plugin
 * 
 * @package Walker_Core
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if ( !class_exists( 'Bootitems_Core_Menu' ) ) :

    class Bootitems_Core_Menu {
		
        public function __construct() {
			
            add_action( 'admin_menu', array( $this, 'register_main_menus'),	9 );
			
        }
		
        public function register_main_menus() {
			
            add_menu_page( 'Bootitems Core', 'Bootitems Core', 'manage_options', 'bootitems-core', array( $this, 'bootitems_core_info' ), '','85' );
    
            add_submenu_page('bootitems-core', 'Dashboard', __( 'Dashboard', 'bootitems-core' ), 'manage_options', 'bootitems-core');
    
        }
        
        public function bootitems_core_info() {
          include_once('dashboard/dashboard.php');
		 // echo 'Welcome to Bizindustries Page';
        }

    }
    
    $Bootitems_Plugin_Mneu = new Bootitems_Core_Menu;
    
endif;
