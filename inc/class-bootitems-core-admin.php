<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://bootitems.com/
 * @since      1.0.0
 *
 * @package    Bootitems_Core
 * @subpackage Bootitems_Core/core
 
*/

class Bootitems_Core_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->bootitems_core_admin();

	}

	private function bootitems_core_admin(){
		
		/**
		* Register Megamenu
		*/
		require_once BOOTITEMS_CORE_PATH . 'inc/menu/bootitems-megamenu.php';
		
		/**
		 * Register Admin Menu
		 */
		require_once BOOTITEMS_CORE_PATH . 'inc/register-menu.php';

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/css/bootitems-core-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/js/bootitems-core-admin.js', array( 'jquery' ), $this->version, false );

	}
}
