<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.webheores.it
 * @since      1.0.0
 *
 * @package    Wh_Widgets
 * @subpackage Wh_Widgets/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wh_Widgets
 * @subpackage Wh_Widgets/public
 * @author     Web Heroes <diego@webheroes.it>
 */
class Wh_Widgets_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;
	
	 /**
	 * The options name to be used in this plugin
	 *
	 * @since   1.0.0
	 * @access  private
	 * @var     string      $option_name    Option name of this plugin
	 */
	private $option_name = 'wh_widgets';
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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wh_Widgets_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wh_Widgets_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wh-widgets-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wh_Widgets_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wh_Widgets_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wh-widgets-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register all of the wh custom widgets on startup.
	 *
	 * Calls 'widgets_init' action after all of the WordPress widgets have been
	 * registered.
	 *
	 * @since 2.2.0
	 */
	public function wh_widgets_init() {
		$whFooter = (bool) get_option( $this->option_name . '_wh_footer_text' );
		$whLeadgen = (bool) get_option( $this->option_name . '_wh_lead_gen' );
		$whSidenav = (bool) get_option( $this->option_name . '_wh_sidenav' );
		$whGmap = (bool) get_option( $this->option_name . '_wh_gmap' );
		
		if ( !is_blog_installed() )
			return;
		
		if ( $whFooter ){
			register_widget('WH_Footer_text_Widget');
		}
		if ( $whLeadgen ){
			register_widget('WH_Footer_Sidenav_Menu_Widget');
		}
		if ( $whSidenav ){
			register_widget('WH_Lead_gen_Widget');
		}
		if ( $whGmap ){
			register_widget('WH_Google_map_Widget');
		}
	}	
}

//load widgets classes
require_once 'partials/widgets/wh-footer-text-widget.php';
require_once 'partials/widgets/wh-subnav-widget.php';
require_once 'partials/widgets/wh-lead-gen-widget.php';
require_once 'partials/widgets/wh-google-map-widget.php';
