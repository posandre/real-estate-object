<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.api-telegram-bot.fun/
 * @since             1.0.0
 * @package           Real_Estate_Object
 *
 * @wordpress-plugin
 * Plugin Name:       Real Estate Object
 * Plugin URI:        https//www.api-telegram-bot.fun
 * Description:       This plugin add new post type for a Real Estate Object, Region taxonomy and shortcode and widget for displaying real estate objects on the page of the site.
 * Version:           1.0.0
 * Author:            Andrii Postoliuk
 * Author URI:        https://www.api-telegram-bot.fun
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       real-estate-object
 * Domain Path:       /languages
 * Prefix:            spc
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'REAL_ESTATE_OBJECT_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-real-estate-object-activator.php
 */
function activate_Real_Estate_Object() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-real-estate-object-activator.php';
	Real_Estate_Object_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-real-estate-object-deactivator.php
 */
function deactivate_Real_Estate_Object() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-real-estate-object-deactivator.php';
	Real_Estate_Object_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_Real_Estate_Object' );
register_deactivation_hook( __FILE__, 'deactivate_Real_Estate_Object' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-real-estate-object.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_Real_Estate_Object() {

	$plugin = new Real_Estate_Object();
	$plugin->run();

}

run_Real_Estate_Object();
