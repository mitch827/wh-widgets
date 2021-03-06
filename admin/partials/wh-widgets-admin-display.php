<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://www.webheores.it
 * @since      1.0.0
 *
 * @package    Wh_Widgets
 * @subpackage Wh_Widgets/admin/partials
 */
?>

<div class="wrap">
    <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
    <?php if( isset( $_GET['settings-updated'] ) ) : ?>
		<div id="message" class="updated">
			<p><strong><?php _e( 'Settings saved.' ) ?></strong></p>
		</div>
	<?php endif; ?>
    <form action="options.php" method="post">
        <?php
            settings_fields( $this->plugin_name );
            do_settings_sections( $this->plugin_name );
            submit_button();
        ?>
    </form>
</div>
