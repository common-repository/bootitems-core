<?php
/**
 * Plugin Name:       Bootitems Core
 * Plugin URI:        https://wordpress.org/plugins/bootitems-core/
 * Description:       Bootitems Core is a companion plugin for Bootitems Themes, which provides core functionality and extends free themes features by adding functionality to import demo data content in just a click.
 * Version:           1.0.0
 * Author:            BootItems
 * Author URI:        https://bootitems.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       bootitems-core
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! function_exists( 'bc_fs' ) ) {
    // Create a helper function for easy SDK access.
    function bc_fs() {
        global $bc_fs;

        if ( ! isset( $bc_fs ) ) {
            // Include Freemius SDK.
            require_once dirname(__FILE__) . '/freemius/start.php';

            $bc_fs = fs_dynamic_init( array(
                'id'                  => '10774',
                'slug'                => 'bootitems-core',
                'premium_slug'        => 'bootitems-core-premium',
                'type'                => 'plugin',
                'public_key'          => 'pk_459fb6dbb778bbc0b326f82885818',
                'is_premium'          => true,
                'premium_suffix'      => 'Premium',
                // If your plugin is a serviceware, set this option to false.
                'has_premium_version' => true,
                'has_addons'          => false,
                'has_paid_plans'      => true,
                'trial'               => array(
                    'days'               => 7,
                    'is_require_payment' => false,
                ),
                'menu'                => array(
                    'slug'            => 'bootitems-core',
                    'first-path'      => 'admin.php?page=bootitems-core&welcome-message=true',
                ),
                'is_live'        => true,
            ) );
        }

        return $bc_fs;
    }

    // Init Freemius.
    bc_fs();
    // Signal that SDK was initiated.
    do_action( 'bc_fs_loaded' );
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'BOOTITEMS_CORE_VERSION', '1.0.0' );
define( 'BOOTITEMS_CORE_PATH', plugin_dir_path( __FILE__ ) );
define( 'BOOTITEMS_CORE_URL', plugin_dir_url( __FILE__ ) );
define( 'BOOTITEMS_CORE_SETUP_SCRIPT_PREFIX', ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '' );

/**
 * The code that runs during plugin activation.
 * This action is documented in class/class-bootitems-core-activator.php
 */
function activate_bootitems_core() {
	require_once plugin_dir_path( __FILE__ ) . 'class/class-bootitems-core-activator.php';
	Bootitems_Core_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in class/class-bootitems-core-deactivator.php
 */
function deactivate_bootitems_core() {
	require_once plugin_dir_path( __FILE__ ) . 'class/class-bootitems-core-deactivator.php';
	Bootitems_Core_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_bootitems_core' );
register_deactivation_hook( __FILE__, 'deactivate_bootitems_core' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'class/class-bootitems-core.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_bootitems_core() {

	$plugin = new Bootitems_Core();
	$plugin->run();

}
run_bootitems_core();
