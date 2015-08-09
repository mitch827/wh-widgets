<?php
 /**
 * Lead Generation widget class
 *
 * @package WH
 * @since 2.0.0
 */
class WH_Lead_gen_Widget extends WP_Widget {
	public function __construct() {
		$widget_ops = array('description' => __('Display contact form and/or social networks in the footer'));
		parent::__construct('wh_leadgen', __('WH Lead Generation'), $widget_ops);
	}
	/**
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		/** This filter is documented in wp-includes/default-widgets.php */
		$title_nl = apply_filters( 'widget_title_nl', empty( $instance['title_nl'] ) ? '' : $instance['title_nl'], $instance, $this->id_base );
		$title_social = apply_filters( 'widget_title_social', empty( $instance['title_social'] ) ? '' : $instance['title_social'], $instance );
		/**
		 * Filter the content of the Text widget.
		 *
		 * @since 2.3.0
		 *
		 * @param string    $widget_text The widget content.
		 * @param WP_Widget $instance    WP_Widget instance.
		 */
		$text = apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance );
		echo $args['before_widget'];
		?>
		<div class="row collapse">
			<div class="small-12 columns">
				<?php if (isset($title_nl) && ! empty($title_nl) && isset($text) && ! empty($text)) : ?>
					<div class="inline-newsletter">
						<fieldset>
						<legend><?php echo $title_nl ?></legend>
							<?php echo $text; ?>
						</fieldset>
					</div>
				<?php endif; ?>
				<?php if (isset($title_social) && ! empty($title_social) && ! empty( $instance['social_nav_menu'] )) : ?>
					<p><b><?php echo $title_social ?></b></p>
					<?php
						$social_nav_menu =  wp_get_nav_menu_object( $instance['social_nav_menu'] );
						if ( !$social_nav_menu ){
							return;
						}
						$social_nav_menu_args = array(
							'fallback_cb' 	=> '',
							'menu'        	=> $social_nav_menu,
							'container'		=> false,
							'items_wrap'    => '<ul class="%2$s inline-list">%3$s</ul>',
							'walker'		=> new Icon_Walker_Nav_Menu()
						);
						/**
						 * Filter the arguments for the Custom Menu widget.
						 *
						 * @since 4.2.0
						 *
						 * @param array    $nav_menu_args {
						 *     An array of arguments passed to wp_nav_menu() to retrieve a custom menu.
						 *
						 *     @type callback|bool $fallback_cb Callback to fire if the menu doesn't exist. Default empty.
						 *     @type mixed         $menu        Menu ID, slug, or name.
						 * }
						 * @param stdClass $nav_menu      Nav menu object for the current menu.
						 * @param array    $args          Display arguments for the current widget.
						 */
						 wp_nav_menu( apply_filters( 'widget_nav_menu_args', $social_nav_menu_args, $social_nav_menu, $args ) );
					?>
				<?php endif; ?>
			</div>
		</div><!-- .row collapse -->
		<?php
		echo $args['after_widget'];
	}
	/**
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title_nl'] = strip_tags($new_instance['title_nl']);
		$instance['title_social'] = strip_tags($new_instance['title_social']);
		if ( ! empty( $new_instance['social_nav_menu'] ) ) {
			$instance['social_nav_menu'] = (int) $new_instance['social_nav_menu'];
		}
		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed
		return $instance;
	}
	/**
	 * @param array $instance
	 */
	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title_nl' => '', 'text' => '', 'title_social' => '', 'social_nav_menu' => '' ) );
		$title_nl = strip_tags($instance['title_nl']);
		$title_social = strip_tags($instance['title_social']);
		$text = esc_textarea($instance['text']);
		$social_nav_menu = isset( $instance['social_nav_menu'] ) ? $instance['social_nav_menu'] : '';
		// Get menus
		$menus = wp_get_nav_menus();
		// If no menus exists, direct the user to go and create some.
		if ( !$menus ) {
			echo '<p>'. sprintf( __('No menus have been created yet. <a href="%s">Create some</a>.'), admin_url('nav-menus.php') ) .'</p>';
			return;
		}
		?>
		<p><label for="<?php echo $this->get_field_id('title_nl'); ?>"><?php _e('Newsletter box title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title_nl'); ?>" name="<?php echo $this->get_field_name('title_nl'); ?>" type="text" value="<?php echo esc_attr($title_nl); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Content:' ); ?></label>
		<textarea class="widefat" rows="2" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea></p>
		
		<hr/>
		
		<p><label for="<?php echo $this->get_field_id('title_social'); ?>"><?php _e('Social networks box title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title_social'); ?>" name="<?php echo $this->get_field_name('title_social'); ?>" type="text" value="<?php echo esc_attr($title_social); ?>" /></p>
		
		<p>
			<label for="<?php echo $this->get_field_id('social_nav_menu'); ?>"><?php _e('Select Social menu:'); ?></label>
			<select class="widefat"id="<?php echo $this->get_field_id('social_nav_menu'); ?>" name="<?php echo $this->get_field_name('social_nav_menu'); ?>">
				<option value="0"><?php _e( '&mdash; Select &mdash;' ) ?></option>
		<?php
			foreach ( $menus as $menu ) {
				echo '<option value="' . $menu->term_id . '"'
					. selected( $social_nav_menu, $menu->term_id, false )
					. '>'. esc_html( $menu->name ) . '</option>';
			}
		?>
			</select>
		</p>

<?php
	}
}

/**
 * Icon_Walker_Nav_Menu class. Custom Walker used to add classes to submenu ul.
 * 
 * @extends Walker_Nav_Menu
 */
class Icon_Walker_Nav_Menu extends Walker_Nav_Menu {
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$output .= sprintf( "\n<li id='menu-item-". $item->ID ."'><a href='%1\$s' %2\$s title='%4\$s'><div class='icon-wrapper text-center'><i class='fi-social-%3\$s'></i></div></a></li>\n",
	        $item->url,
	        ( $item->object_id === get_the_ID() ) ? ' class="current"' : '',
	         $item->title,
	        $item->attr_title
	    );
	}
}