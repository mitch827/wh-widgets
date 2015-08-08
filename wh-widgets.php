<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.webheores.it
 * @since             1.0.0
 * @package           Wh_Widgets
 *
 * @wordpress-plugin
 * Plugin Name:       WH Widgtes Plugin
 * Plugin URI:        https://github.com/mitch827/wh-widgets
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Web Heroes
 * Author URI:        http://www.webheores.it
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wh-widgets
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wh-widgets-activator.php
 */
function activate_wh_widgets() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wh-widgets-activator.php';
	Wh_Widgets_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wh-widgets-deactivator.php
 */
function deactivate_wh_widgets() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wh-widgets-deactivator.php';
	Wh_Widgets_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wh_widgets' );
register_deactivation_hook( __FILE__, 'deactivate_wh_widgets' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wh-widgets.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wh_widgets() {

	$plugin = new Wh_Widgets();
	$plugin->run();

}
run_wh_widgets();