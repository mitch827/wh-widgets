<?php
/**
 * WH_Google_map_Widget class.
 * 
 * @extends WP_Widget
 */
class WH_Footer_contact_list_Widget extends WP_Widget {

    public function __construct() {
        $widget_ops = array('description' => __('Display a ist of contacts in footer'));
		parent::__construct('wh_contactlist', __('WH Footer Contact List'), $widget_ops);
    }

    public function form( $instance ) {
	    $instance = wp_parse_args( (array) $instance, array( 'address_1' => '', 'address_2' => '', 'telephone' => '', 'mail' => '' ) );
		$address1 = strip_tags($instance['address_1']);
		$address2 = strip_tags($instance['address_2']);
		$telephone = strip_tags($instance['telephone']);
		$mail = strip_tags($instance['mail']);
	?>
		<p><label for="<?php echo $this->get_field_id('address_1'); ?>"><?php _e('Address (first line):', 'wh-footer-contact-list' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('address_1'); ?>" name="<?php echo $this->get_field_name('address_1'); ?>" type="text" value="<?php echo esc_attr($address1); ?>" />
		<label for="<?php echo $this->get_field_id('address_1'); ?>"><?php _e('Address (second line):', 'wh-footer-contact-list' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('address_2'); ?>" name="<?php echo $this->get_field_name('address_2'); ?>" type="text" value="<?php echo esc_attr($address2); ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('telephone'); ?>"><?php _e('Telephone:', 'wh-footer-contact-list' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('telephone'); ?>" name="<?php echo $this->get_field_name('telephone'); ?>" type="text" value="<?php echo esc_attr($telephone); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'mail' ); ?>"><?php _e( 'Mail:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('mail'); ?>" name="<?php echo $this->get_field_name('mail'); ?>" type="text" value="<?php echo esc_attr($mail); ?>" /></p>

		<?php
	}
	
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
		$instance['address_1'] = strip_tags($new_instance['address_1']);
		$instance['address_2'] = strip_tags($new_instance['address_2']);
		$instance['telephone'] = strip_tags($new_instance['telephone']);
		$instance['mail'] = strip_tags($new_instance['mail']);
		
		return $instance;
    }

    public function widget( $args, $instance ) {
	    
	    /** This filter is documented in wp-includes/default-widgets.php */
		$address1 = apply_filters( 'w_address_1', empty( $instance['address_1'] ) ? '' : $instance['address_1'], $instance );
		$address2 = apply_filters( 'w_address_2', empty( $instance['address_2'] ) ? '' : $instance['address_2'], $instance );
		$telephone = apply_filters( 'w_telephone', empty( $instance['telephone'] ) ? '' : $instance['telephone'], $instance );
		$mail = apply_filters( 'w_mail', empty( $instance['mail'] ) ? '' : $instance['mail'], $instance );

		echo $args['before_widget'];
		
	 	echo !empty( $instance['address_1'] ) ? '<div class="contact_list_widget"><p class="location"><strong>' . __('Where we are', 'wh-footer-contact-list') . '</strong></p><p>' .  $instance['address_1'] . '<br>' . $instance['address_2'] . '</p></div>' : '';
	 	echo !empty( $instance['telephone'] ) ? '<div class="contact_list_widget"><p class="telephone"><strong>' . $instance['telephone'] . '</strong></p></div>' : '';
	 	echo !empty( $instance['mail'] ) ? '<div class="contact_list_widget"><p class="mail"><strong>' . __('Mail', 'wh-footer-contact-list') . '</strong></p><p>' .  $instance['mail'] . '</p></div>' : '';
	 	
		echo $args['after_widget'];
	    
    }

}