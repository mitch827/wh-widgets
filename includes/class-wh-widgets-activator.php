<?php

/**
 * Fired during plugin activation
 *
 * @link       http://www.webheores.it
 * @since      1.0.0
 *
 * @package    Wh_Widgets
 * @subpackage Wh_Widgets/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Wh_Widgets
 * @subpackage Wh_Widgets/includes
 * @author     Web Heroes <diego@webheroes.it>
 */
class Wh_Widgets_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate( $plugin_base ) {
		
		if ( ! is_plugin_active( "web-heroes/web-heroes.php" ) ){
			deactivate_plugins( $plugin_base );
			wp_die( "<a href='https://github.com/mitch827/web-heroes'><b>Web Heroes Enhancements plugin</b></a> is required.<br><br>Go back to <a href='" . get_admin_url(null, 'plugins.php') . "'>plugins page</a>." );
     	}

	}

}
