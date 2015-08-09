<?php
/**
 * WH_Google_map_Widget class.
 * 
 * @extends WP_Widget
 */
class WH_Google_map_Widget extends WP_Widget {

    public function __construct() {
        $widget_ops = array('description' => __('Display Google Map in the footer'));
		parent::__construct('wh_gmap', __('WH Google Map'), $widget_ops);
    }

    public function form( $instance ) {
        // outputs the options form on admin
    }

    public function update( $new_instance, $old_instance ) {
        // processes widget options to be saved
    }

    public function widget( $args, $instance ) {
        wp_enqueue_script('google_map', "https://maps.googleapis.com/maps/api/js", array(), false, false );
    }

}