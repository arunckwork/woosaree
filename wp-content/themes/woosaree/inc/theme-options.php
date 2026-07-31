<?php
/**
 * Theme Options Page Setup
 * 
 * Provides Theme Options support via ACF PRO if available,
 * or native WordPress Admin Options pages if using ACF Free / no plugin.
 *
 * @package woosaree
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Helper function to get theme option values.
 * Checks ACF Options page first, falls back to native WP options.
 *
 * @param string $name Option key without prefix.
 * @param mixed  $default Default value if option is empty.
 * @return mixed
 */
function woosaree_get_option( $name, $default = '' ) {
	if ( function_exists( 'get_field' ) ) {
		$acf_val = get_field( $name, 'option' );
		if ( ! empty( $acf_val ) ) {
			return $acf_val;
		}
	}
	return get_option( 'woosaree_' . $name, $default );
}

if ( function_exists( 'acf_add_options_page' ) ) {

	/**
	 * Register ACF PRO Theme Options Page
	 */
	add_action( 'acf/init', 'woosaree_acf_op_init' );
	function woosaree_acf_op_init() {
		acf_add_options_page( array(
			'page_title' => __( 'Theme General Settings', 'woosaree' ),
			'menu_title' => __( 'Theme Options', 'woosaree' ),
			'menu_slug'  => 'theme-general-settings',
			'capability' => 'manage_options',
			'redirect'   => false,
			'icon_url'   => 'dashicons-admin-generic',
			'position'   => 60,
		) );

		acf_add_options_sub_page( array(
			'page_title'  => __( 'Header Settings', 'woosaree' ),
			'menu_title'  => __( 'Header', 'woosaree' ),
			'parent_slug' => 'theme-general-settings',
		) );

		acf_add_options_sub_page( array(
			'page_title'  => __( 'Footer Settings', 'woosaree' ),
			'menu_title'  => __( 'Footer', 'woosaree' ),
			'parent_slug' => 'theme-general-settings',
		) );
	}

} else {

	/**
	 * Native WordPress Admin Menu Page fallback for ACF Free
	 */
	add_action( 'admin_menu', 'woosaree_register_native_theme_options' );
	function woosaree_register_native_theme_options() {
		add_menu_page(
			__( 'Theme Options', 'woosaree' ),
			__( 'Theme Options', 'woosaree' ),
			'manage_options',
			'theme-general-settings',
			'woosaree_render_general_options_page',
			'dashicons-admin-generic',
			60
		);

		add_submenu_page(
			'theme-general-settings',
			__( 'Theme General Settings', 'woosaree' ),
			__( 'General Settings', 'woosaree' ),
			'manage_options',
			'theme-general-settings',
			'woosaree_render_general_options_page'
		);

		add_submenu_page(
			'theme-general-settings',
			__( 'Header Settings', 'woosaree' ),
			__( 'Header Settings', 'woosaree' ),
			'manage_options',
			'theme-header-settings',
			'woosaree_render_header_options_page'
		);

		add_submenu_page(
			'theme-general-settings',
			__( 'Footer Settings', 'woosaree' ),
			__( 'Footer Settings', 'woosaree' ),
			'manage_options',
			'theme-footer-settings',
			'woosaree_render_footer_options_page'
		);
	}

	add_action( 'admin_init', 'woosaree_register_theme_settings' );
	function woosaree_register_theme_settings() {
		// General Settings
		register_setting( 'woosaree_general_group', 'woosaree_phone' );
		register_setting( 'woosaree_general_group', 'woosaree_email' );
		register_setting( 'woosaree_general_group', 'woosaree_address' );

		// Header Settings - Announcements Repeater Array
		register_setting( 'woosaree_header_group', 'woosaree_announcements', array(
			'type'              => 'array',
			'sanitize_callback' => 'woosaree_sanitize_announcements',
			'default'           => array(),
		) );

		// Footer Settings
		register_setting( 'woosaree_footer_group', 'woosaree_footer_copyright' );
		register_setting( 'woosaree_footer_group', 'woosaree_footer_about' );
	}

	/**
	 * Sanitize announcements array
	 */
	function woosaree_sanitize_announcements( $input ) {
		if ( ! is_array( $input ) ) {
			return array();
		}
		$sanitized = array();
		foreach ( $input as $item ) {
			$clean = sanitize_text_field( $item );
			if ( '' !== trim( $clean ) ) {
				$sanitized[] = $clean;
			}
		}
		return $sanitized;
	}

	/**
	 * Render General Settings Page
	 */
	function woosaree_render_general_options_page() {
		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'Theme General Settings', 'woosaree' ); ?></h1>
			<form method="post" action="options.php">
				<?php
				settings_fields( 'woosaree_general_group' );
				do_settings_sections( 'woosaree_general_group' );
				?>
				<table class="form-table">
					<tr valign="top">
						<th scope="row"><?php esc_html_e( 'Phone Number', 'woosaree' ); ?></th>
						<td><input type="text" name="woosaree_phone" value="<?php echo esc_attr( get_option( 'woosaree_phone' ) ); ?>" class="regular-text" /></td>
					</tr>
					<tr valign="top">
						<th scope="row"><?php esc_html_e( 'Email Address', 'woosaree' ); ?></th>
						<td><input type="email" name="woosaree_email" value="<?php echo esc_attr( get_option( 'woosaree_email' ) ); ?>" class="regular-text" /></td>
					</tr>
					<tr valign="top">
						<th scope="row"><?php esc_html_e( 'Address', 'woosaree' ); ?></th>
						<td><textarea name="woosaree_address" class="large-text" rows="3"><?php echo esc_textarea( get_option( 'woosaree_address' ) ); ?></textarea></td>
					</tr>
				</table>
				<?php submit_button(); ?>
			</form>
		</div>
		<?php
	}

	/**
	 * Render Header Settings Page with Announcements Repeater
	 */
	function woosaree_render_header_options_page() {
		$announcements = get_option( 'woosaree_announcements', array() );
		if ( ! is_array( $announcements ) || empty( $announcements ) ) {
			$announcements = array( '' );
		}
		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'Header Settings', 'woosaree' ); ?></h1>
			<form method="post" action="options.php">
				<?php
				settings_fields( 'woosaree_header_group' );
				do_settings_sections( 'woosaree_header_group' );
				?>
				
				<h2><?php esc_html_e( 'Header Announcements', 'woosaree' ); ?></h2>
				<p class="description"><?php esc_html_e( 'Add announcement text items to display in the header slider / top bar.', 'woosaree' ); ?></p>
				
				<div id="woosaree-announcements-wrapper" style="max-width: 750px; margin-top: 15px;">
					<?php foreach ( $announcements as $text ) : ?>
						<div class="announcement-item" style="display: flex; gap: 10px; margin-bottom: 10px; align-items: center;">
							<span class="dashicons dashicons-menu" style="color: #999;" title="<?php esc_attr_e( 'Item', 'woosaree' ); ?>"></span>
							<input type="text" name="woosaree_announcements[]" value="<?php echo esc_attr( $text ); ?>" class="large-text" placeholder="<?php esc_attr_e( 'Enter announcement text...', 'woosaree' ); ?>" />
							<button type="button" class="button remove-announcement-btn" style="color: #b32d2e; border-color: #b32d2e;"><?php esc_html_e( 'Remove', 'woosaree' ); ?></button>
						</div>
					<?php endforeach; ?>
				</div>

				<p style="margin-top: 15px;">
					<button type="button" id="add-announcement-btn" class="button button-secondary">+ <?php esc_html_e( 'Add Announcement', 'woosaree' ); ?></button>
				</p>

				<?php submit_button(); ?>
			</form>
		</div>

		<script>
		document.addEventListener('DOMContentLoaded', function() {
			const wrapper = document.getElementById('woosaree-announcements-wrapper');
			const addBtn = document.getElementById('add-announcement-btn');

			if (addBtn && wrapper) {
				addBtn.addEventListener('click', function() {
					const div = document.createElement('div');
					div.className = 'announcement-item';
					div.style.cssText = 'display: flex; gap: 10px; margin-bottom: 10px; align-items: center;';
					div.innerHTML = `
						<span class="dashicons dashicons-menu" style="color: #999;"></span>
						<input type="text" name="woosaree_announcements[]" value="" class="large-text" placeholder="Enter announcement text..." />
						<button type="button" class="button remove-announcement-btn" style="color: #b32d2e; border-color: #b32d2e;">Remove</button>
					`;
					wrapper.appendChild(div);
				});

				wrapper.addEventListener('click', function(e) {
					if (e.target && e.target.classList.contains('remove-announcement-btn')) {
						const items = wrapper.querySelectorAll('.announcement-item');
						if (items.length > 1) {
							e.target.closest('.announcement-item').remove();
						} else {
							const input = e.target.closest('.announcement-item').querySelector('input');
							if (input) input.value = '';
						}
					}
				});
			}
		});
		</script>
		<?php
	}

	/**
	 * Render Footer Settings Page
	 */
	function woosaree_render_footer_options_page() {
		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'Footer Settings', 'woosaree' ); ?></h1>
			<form method="post" action="options.php">
				<?php
				settings_fields( 'woosaree_footer_group' );
				do_settings_sections( 'woosaree_footer_group' );
				?>
				<table class="form-table">
					<tr valign="top">
						<th scope="row"><?php esc_html_e( 'Footer About Text', 'woosaree' ); ?></th>
						<td><textarea name="woosaree_footer_about" class="large-text" rows="4"><?php echo esc_textarea( get_option( 'woosaree_footer_about' ) ); ?></textarea></td>
					</tr>
					<tr valign="top">
						<th scope="row"><?php esc_html_e( 'Copyright Text', 'woosaree' ); ?></th>
						<td><input type="text" name="woosaree_footer_copyright" value="<?php echo esc_attr( get_option( 'woosaree_footer_copyright' ) ); ?>" class="large-text" /></td>
					</tr>
				</table>
				<?php submit_button(); ?>
			</form>
		</div>
		<?php
	}

}
