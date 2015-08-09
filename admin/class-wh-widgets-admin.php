<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.webheores.it
 * @since      1.0.0
 *
 * @package    Wh_Widgets
 * @subpackage Wh_Widgets/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wh_Widgets
 * @subpackage Wh_Widgets/admin
 * @author     Web Heroes <diego@webheroes.it>
 */
class Wh_Widgets_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wh-widgets-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wh-widgets-admin.js', array( 'jquery' ), $this->version, false );

	}
	
	/**
	 * Add an options page under the Settings submenu
	 *
	 * @since  1.0.0
	 */
	public function add_options_page() {
		
		 $this->plugin_screen_hook_suffix =  add_plugins_page(
	        __( 'Web Heroes widgets collection', 'wh-widgets' ),
	        __( 'WH Widgets', 'wh-widgets' ),
	        'manage_options',
	        $this->plugin_name,
	        array( $this, 'display_options_page' )
	    );
	}
	
	
	/**
	 * Render the options page for plugin
	 *
	 * @since  1.0.0
	 */
	public function display_options_page() {
	    include_once 'partials/wh-widgets-admin-display.php';
	}
	
	/**
	 * Register all related settings of this plugin
	 *
	 * @since  1.0.0
	 */
	public function register_setting() {
		// Add a General section
		add_settings_section(
		    $this->option_name . '_general',
		    __( 'General', 'wh-widgets' ),
		    array( $this, $this->option_name . '_general_cb' ),
		    $this->plugin_name
		);
		
		add_settings_field(
		    $this->option_name . '_wh_footer_text',
		    __( 'Footer Text', 'wh-widgets' ),
		    array( $this, $this->option_name . '_wh_footer_text_cb' ),
		    $this->plugin_name,
		    $this->option_name . '_general',
		    array( 'label_for' => $this->option_name . '_wh_footer_text' )
		);
		
		add_settings_field(
		    $this->option_name . '_wh_lead_gen',
		    __( 'Lead generation (NL + Social)', 'wh-widgets' ),
		    array( $this, $this->option_name . '_wh_lead_gen_cb' ),
		    $this->plugin_name,
		    $this->option_name . '_general',
		    array( 'label_for' => $this->option_name . '_wh_lead_gen' )
		);
		
		add_settings_field(
		    $this->option_name . '_wh_sidenav',
		    __( 'Side Nav', 'wh-widgets' ),
		    array( $this, $this->option_name . '_wh_sidenav_cb' ),
		    $this->plugin_name,
		    $this->option_name . '_general',
		    array( 'label_for' => $this->option_name . '_wh_sidenav' )
		);
		
		add_settings_field(
		    $this->option_name . '_wh_gmap',
		    __( 'Google Map', 'wh-widgets' ),
		    array( $this, $this->option_name . '_wh_gmap_cb' ),
		    $this->plugin_name,
		    $this->option_name . '_general',
		    array( 'label_for' => $this->option_name . '_wh_gmap' )
		);
		
		register_setting( $this->plugin_name, $this->option_name . '_wh_footer_text' );
		register_setting( $this->plugin_name, $this->option_name . '_wh_lead_gen' );
		register_setting( $this->plugin_name, $this->option_name . '_wh_sidenav' );
		register_setting( $this->plugin_name, $this->option_name . '_wh_gmap' );


	}
	
	/**
	 * Render the text for the general section
	 *
	 * @since  1.0.0
	 */
	public function wh_widgets_general_cb() {
	    echo '<p>' . __( 'Select which widget to activate.', 'wh-widgets' ) . '</p>';
	}
	
	public function wh_widgets_wh_footer_text_cb() {
 		$whFooter = get_option( $this->option_name . '_wh_footer_text' );

		?>
			<input type="checkbox" name="<?php echo $this->option_name . '_wh_footer_text'; ?>" value="1" <?php checked( $whFooter , 1 ); ?> > 
	
	<?php
	}
	
	public function wh_widgets_wh_lead_gen_cb() {
 		$whLeadgen = get_option( $this->option_name . '_wh_lead_gen' );

		?>
			<input type="checkbox" name="<?php echo $this->option_name . '_wh_lead_gen'; ?>" value="1" <?php checked( $whLeadgen , 1 ); ?> > 
	
	<?php
	}
	
	public function wh_widgets_wh_sidenav_cb() {
 		$whSidenav = get_option( $this->option_name . '_wh_sidenav' );

		?>
			<input type="checkbox" name="<?php echo $this->option_name . '_wh_sidenav'; ?>" value="1" <?php checked( $whSidenav , 1 ); ?> > 
	
	<?php
	}
	
	public function wh_widgets_wh_gmap_cb() {
 		$whGmap = get_option( $this->option_name . '_wh_gmap' );

		?>
			<input type="checkbox" name="<?php echo $this->option_name . '_wh_gmap'; ?>" value="1" <?php checked( $whGmap , 1 ); ?> > 
	
	<?php
	}
}
