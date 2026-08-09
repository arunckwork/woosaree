<?php
/**
 * woosaree functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package woosaree
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function woosaree_setup()
{
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on woosaree, use a find and replace
	 * to change 'woosaree' to the name of your theme in all the template files.
	 */
	load_theme_textdomain('woosaree', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support('title-tag');

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'header_menu' => esc_html__('Primary', 'woosaree'),
			'footer_menu' => esc_html__('Footer Menu', 'woosaree'),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'woosaree_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height' => 250,
			'width' => 250,
			'flex-width' => true,
			'flex-height' => true,
		)
	);
	// Enable WooCommerce support
	add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'woosaree_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function woosaree_content_width()
{
	$GLOBALS['content_width'] = apply_filters('woosaree_content_width', 640);
}
add_action('after_setup_theme', 'woosaree_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function woosaree_widgets_init()
{
	register_sidebar(
		array(
			'name' => esc_html__('Sidebar', 'woosaree'),
			'id' => 'sidebar-1',
			'description' => esc_html__('Add widgets here.', 'woosaree'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		)
	);
}
add_action('widgets_init', 'woosaree_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function woosaree_scripts()
{
	// Styles
	wp_enqueue_style('woosaree-fonts', get_template_directory_uri() . '/fonts/fonts.css', array(), _S_VERSION);
	wp_enqueue_style('woosaree-font-icons', get_template_directory_uri() . '/fonts/font-icons.css', array(), _S_VERSION);
	wp_enqueue_style('woosaree-bootstrap-css', get_template_directory_uri() . '/css/bootstrap.min.css', array(), _S_VERSION);
	wp_enqueue_style('woosaree-swiper-css', get_template_directory_uri() . '/css/swiper-bundle.min.css', array(), _S_VERSION);
	wp_enqueue_style('woosaree-drift-basic', get_template_directory_uri() . '/css/drift-basic.min.css', array(), _S_VERSION);
	wp_enqueue_style('woosaree-photoswipe', get_template_directory_uri() . '/css/photoswipe.css', array(), _S_VERSION);
	wp_enqueue_style('woosaree-animate', get_template_directory_uri() . '/css/animate.css', array(), _S_VERSION);
	// wp_enqueue_style('woosaree-sib-styles', '../../../sibforms.com/forms/end-form/build/sib-styles.css', array(), _S_VERSION);
	wp_enqueue_style('woosaree-css-styles', get_template_directory_uri() . '/css/styles.css', array(), _S_VERSION);
	wp_enqueue_style('woosaree-fontawesome', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), '4.7.0');

	wp_enqueue_style('woosaree-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_style_add_data('woosaree-style', 'rtl', 'replace');

	// Scripts
	wp_enqueue_script('woosaree-bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), _S_VERSION, true);
	wp_enqueue_script('woosaree-jquery', get_template_directory_uri() . '/js/jquery.min.js', array(), _S_VERSION, true);
	wp_enqueue_script('woosaree-swiper-js', get_template_directory_uri() . '/js/swiper-bundle.min.js', array(), _S_VERSION, true);
	wp_enqueue_script('woosaree-carousel', get_template_directory_uri() . '/js/carousel.js', array('woosaree-swiper-js'), _S_VERSION, true);
	wp_enqueue_script('woosaree-bootstrap-select', get_template_directory_uri() . '/js/bootstrap-select.min.js', array('woosaree-bootstrap-js'), _S_VERSION, true);
	wp_enqueue_script('woosaree-lazysize', get_template_directory_uri() . '/js/lazysize.min.js', array(), _S_VERSION, true);
	wp_enqueue_script('woosaree-count-down', get_template_directory_uri() . '/js/count-down.js', array(), _S_VERSION, true);
	wp_enqueue_script('woosaree-drift', get_template_directory_uri() . '/js/drift.min.js', array(), _S_VERSION, true);
	wp_enqueue_script('woosaree-photoswipe-lightbox', get_template_directory_uri() . '/js/photoswipe-lightbox.umd.min.js', array(), _S_VERSION, true);
	wp_enqueue_script('woosaree-photoswipe-umd', get_template_directory_uri() . '/js/photoswipe.umd.min.js', array(), _S_VERSION, true);
	wp_enqueue_script('woosaree-zoom', get_template_directory_uri() . '/js/zoom.js', array('woosaree-swiper-js', 'woosaree-drift', 'woosaree-photoswipe-umd'), _S_VERSION, true);
	wp_enqueue_script('woosaree-wow', get_template_directory_uri() . '/js/wow.min.js', array(), _S_VERSION, true);
	wp_enqueue_script('woosaree-multiple-modal', get_template_directory_uri() . '/js/multiple-modal.js', array(), _S_VERSION, true);
	wp_enqueue_script('woosaree-main', get_template_directory_uri() . '/js/main.js', array('jquery'), _S_VERSION, true);
	wp_enqueue_script('woosaree-product-detail-js', get_template_directory_uri() . '/js/product-detail.js', array('jquery'), _S_VERSION, true);
	wp_enqueue_script('woosaree-sibforms', get_template_directory_uri() . '/js/sibforms.html', array(), _S_VERSION, true);

	$inline_js = "
		window.REQUIRED_CODE_ERROR_MESSAGE = 'Please choose a country code';
		window.LOCALE = 'en';
		window.EMAIL_INVALID_MESSAGE = window.SMS_INVALID_MESSAGE = \"The information provided is invalid. Please review the field format and try again.\";
		window.REQUIRED_ERROR_MESSAGE = \"This field cannot be left blank. \";
		window.GENERIC_INVALID_MESSAGE = \"The information provided is invalid. Please review the field format and try again.\";
		window.translation = {
			common: {
				selectedList: '{quantity} list selected',
				selectedLists: '{quantity} lists selected'
			}
		};
		var AUTOHIDE = Boolean(0);
	";
	wp_add_inline_script('woosaree-sibforms', $inline_js);

	wp_enqueue_script('woosaree-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'woosaree_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load Theme Options (ACF PRO fallback to Native WP Admin Settings).
 */
require get_template_directory() . '/inc/theme-options.php';

/**
 * Custom Post Type for Home Slider
 */

function create_home_slider_cpt()
{

	$args = array(
		'labels' => array(
			'name' => 'Home Sliders',
			'singular_name' => 'Home Slider'
		),
		'public' => true,
		'menu_icon' => 'dashicons-images-alt2',
		'supports' => array(
			'title',
			'editor',
			'thumbnail',
			'page-attributes'
		),
		'show_in_rest' => true,
		'has_archive' => false,
	);

	register_post_type('home_slider', $args);
}

add_action('init', 'create_home_slider_cpt');

// Load More Products AJAX Handler
add_action('wp_ajax_load_more_products', 'load_more_products');
add_action('wp_ajax_nopriv_load_more_products', 'load_more_products');

function load_more_products()
{

	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;

	$args = array(
		'post_type' => 'product',
		'posts_per_page' => 8,
		'paged' => $page,
		'post_status' => 'publish'
	);

	$products = new WP_Query($args);

	if ($products->have_posts()):

		while ($products->have_posts()):

			$products->the_post();

			global $product;

			$main_image_url = get_the_post_thumbnail_url($product->get_id(), 'woocommerce_thumbnail');
			if (!$main_image_url) {
				$main_image_url = wc_placeholder_img_src('woocommerce_thumbnail');
			}

			$gallery_image_ids = $product->get_gallery_image_ids();
			$has_hover_img = !empty($gallery_image_ids) && !empty($gallery_image_ids[0]);
			$hover_image_url = $has_hover_img ? wp_get_attachment_image_url($gallery_image_ids[0], 'woocommerce_thumbnail') : '';

			?>

			<div class="card-product fl-item<?php echo !$has_hover_img ? ' none-hover' : ''; ?>" style="display: block;">
				<div class="card-product-wrapper">
					<a href="<?php the_permalink(); ?>" class="product-img">
						<img class="img-product" src="<?php echo esc_url($main_image_url); ?>"
							alt="<?php echo esc_attr(get_the_title()); ?>">
						<?php if ($has_hover_img && $hover_image_url): ?>
							<img class="img-hover" src="<?php echo esc_url($hover_image_url); ?>"
								alt="<?php echo esc_attr(get_the_title()); ?>">
						<?php endif; ?>
					</a>
					<div class="list-product-btn">
						<a href="#quick_add" data-bs-toggle="modal" class="box-icon bg_white quick-add tf-btn-loading"
							data-product-id="<?php echo esc_attr($product->get_id()); ?>"
							data-product-title="<?php echo esc_attr(get_the_title()); ?>"
							data-product-price="<?php echo esc_attr($product->get_price_html()); ?>"
							data-product-raw-price="<?php echo esc_attr($product->get_price()); ?>"
							data-product-image="<?php echo esc_url($main_image_url); ?>"
							data-product-url="<?php echo esc_url(get_permalink()); ?>">
							<span class="icon icon-bag"></span>
							<span class="tooltip">Add to Cart</span>
						</a>
						<!-- <?php if (function_exists('yith_wcwl_add_to_wishlist')): ?>
			<?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>
			<?php else: ?>
			<a href="#" class="box-icon bg_white wishlist btn-icon-action">
				<span class="icon icon-heart"></span>
				<span class="tooltip">Add to Wishlist</span>
			</a>
			<?php endif; ?> -->
						<a href="<?php the_permalink(); ?>" class="box-icon bg_white quickview tf-btn-loading">
							<span class="icon icon-view"></span>
							<span class="tooltip">View Details</span>
						</a>
					</div>

				</div>
				<div class="card-product-info">
					<a href="<?php the_permalink(); ?>" class="title link"><?php the_title(); ?></a>
					<span class="price"><?php echo $product->get_price_html(); ?></span>
				</div>
			</div>

			<?php

		endwhile;

	endif;

	wp_reset_postdata();

	wp_die();
}

function custom_scripts()
{

	wp_enqueue_script(
		'custom-load-more',
		get_template_directory_uri() . '/js/load-more.js',
		array('jquery'),
		null,
		true
	);

	wp_localize_script(
		'custom-load-more',
		'ajax_object',
		array(
			'ajax_url' => admin_url('admin-ajax.php')
		)
	);

}

add_action('wp_enqueue_scripts', 'custom_scripts');

/**
 * Render Woosaree Live Mini Cart Items List
 */
function woosaree_render_mini_cart_items()
{
	ob_start();
	?>
	<div class="tf-mini-cart-items">
		<?php if (function_exists('WC') && WC()->cart && !WC()->cart->is_empty()): ?>
			<?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item):
				$_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
				if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)):
					$product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
					$thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image('woocommerce_thumbnail'), $cart_item, $cart_item_key);
					$product_name = apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key);
					$product_price = apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key);
					$qty = $cart_item['quantity'];
					?>
					<div class="tf-mini-cart-item" data-cart-item-key="<?php echo esc_attr($cart_item_key); ?>">
						<div class="tf-mini-cart-image">
							<a href="<?php echo esc_url($product_permalink); ?>">
								<?php echo $thumbnail; ?>
							</a>
						</div>
						<div class="tf-mini-cart-info">
							<a class="title link"
								href="<?php echo esc_url($product_permalink); ?>"><?php echo esc_html($product_name); ?></a>
							<div class="price fw-6"><?php echo $product_price; ?></div>
							<div class="tf-mini-cart-btns">
								<div class="wg-quantity small">
									<span class="btn-quantity mini-cart-qty-btn mini-cart-minus"
										data-cart-item-key="<?php echo esc_attr($cart_item_key); ?>"
										data-current-qty="<?php echo esc_attr($qty); ?>" style="cursor:pointer;">-</span>
									<input type="text" name="cart_quantity" value="<?php echo esc_attr($qty); ?>" readonly>
									<span class="btn-quantity mini-cart-qty-btn mini-cart-plus"
										data-cart-item-key="<?php echo esc_attr($cart_item_key); ?>"
										data-current-qty="<?php echo esc_attr($qty); ?>" style="cursor:pointer;">+</span>
								</div>
								<div class="tf-mini-cart-remove" data-cart-item-key="<?php echo esc_attr($cart_item_key); ?>"
									style="cursor:pointer;">Remove</div>
							</div>
						</div>
					</div>
							<?php
				endif;
			endforeach; ?>
		<?php else: ?>
			<p class="text-center py-4 text-muted">Your cart is currently empty.</p>
		<?php endif; ?>
	</div>
	<?php
	return ob_get_clean();
}

/**
 * Render Live Cart Page Wrap for AJAX Fragment
 */
function woosaree_render_cart_wrap_fragment()
{
	ob_start();
	if (function_exists('WC') && WC()->cart) {
		if (WC()->cart->is_empty()) {
			wc_get_template('cart/cart-empty.php');
		} else {
			wc_get_template('cart/cart.php');
		}
	}
	return ob_get_clean();
}

/**
 * Dynamic WooCommerce Cart Fragments
 */
add_filter('woocommerce_add_to_cart_fragments', 'woosaree_cart_fragments');
function woosaree_cart_fragments($fragments)
{
	$count = (function_exists('WC') && WC()->cart) ? WC()->cart->get_cart_contents_count() : 0;
	$fragments['span.count-box'] = '<span class="count-box">' . esc_html($count) . '</span>';
	$fragments['div.count-box'] = '<div class="toolbar-count count-box">' . esc_html($count) . '</div>';
	$fragments['div.tf-mini-cart-items'] = woosaree_render_mini_cart_items();
	$subtotal = (function_exists('WC') && WC()->cart) ? WC()->cart->get_cart_subtotal() : '';
	$fragments['div.tf-totals-total-value'] = '<div class="tf-totals-total-value fw-6">' . $subtotal . '</div>';
	$cart_wrap_html = woosaree_render_cart_wrap_fragment();
	$fragments['section.flat-spacing-11'] = $cart_wrap_html;
	$fragments['div.tf-page-cart-wrap'] = $cart_wrap_html;
	return $fragments;
}

/**
 * Output global woosaree_ajax script in head
 */
add_action('wp_head', function () {
	?>
	<script type="text/javascript">
		var woosaree_ajax = {
			ajax_url: "<?php echo esc_url(admin_url('admin-ajax.php')); ?>"
		};
	</script>
	<?php
}, 1);

/**
 * AJAX Add to Cart Handler
 */
add_action('wp_ajax_woosaree_ajax_add_to_cart', 'woosaree_ajax_add_to_cart');
add_action('wp_ajax_nopriv_woosaree_ajax_add_to_cart', 'woosaree_ajax_add_to_cart');
function woosaree_ajax_add_to_cart()
{
	$product_id = isset($_POST['product_id']) ? absint($_POST['product_id']) : 0;
	$quantity = isset($_POST['quantity']) ? absint($_POST['quantity']) : 1;

	if (!$product_id) {
		wp_send_json_error(array('message' => 'Invalid product ID'));
	}

	$passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
	$product_status = get_post_status($product_id);

	if ($passed_validation && function_exists('WC') && WC()->cart && WC()->cart->add_to_cart($product_id, $quantity) && 'publish' === $product_status) {
		do_action('woocommerce_ajax_added_to_cart', $product_id);
		$fragments = apply_filters('woocommerce_add_to_cart_fragments', array());
		$cart_hash = WC()->cart->get_cart_hash();

		wp_send_json_success(array(
			'fragments' => $fragments,
			'cart_hash' => $cart_hash,
			'product_id' => $product_id
		));
	} else {
		$data = array(
			'error' => true,
			'product_url' => apply_filters('woocommerce_cart_redirect_after_add', get_permalink($product_id))
		);
		wp_send_json_error($data);
	}
}

/**
 * AJAX Update Cart Item Quantity Handler
 */
add_action('wp_ajax_woosaree_update_cart_quantity', 'woosaree_update_cart_quantity');
add_action('wp_ajax_nopriv_woosaree_update_cart_quantity', 'woosaree_update_cart_quantity');
function woosaree_update_cart_quantity()
{
	$cart_item_key = isset($_POST['cart_item_key']) ? sanitize_text_field($_POST['cart_item_key']) : '';
	$new_qty = isset($_POST['quantity']) ? absint($_POST['quantity']) : 0;

	if ($cart_item_key && function_exists('WC') && WC()->cart) {
		if ($new_qty <= 0) {
			WC()->cart->remove_cart_item($cart_item_key);
		} else {
			WC()->cart->set_quantity($cart_item_key, $new_qty, true);
		}
		$fragments = apply_filters('woocommerce_add_to_cart_fragments', array());
		wp_send_json_success(array('fragments' => $fragments));
	}
	wp_send_json_error(array('message' => 'Invalid request'));
}

/**
 * AJAX Remove Cart Item Handler
 */
add_action('wp_ajax_woosaree_remove_cart_item', 'woosaree_remove_cart_item');
add_action('wp_ajax_nopriv_woosaree_remove_cart_item', 'woosaree_remove_cart_item');
function woosaree_remove_cart_item()
{
	$cart_item_key = isset($_POST['cart_item_key']) ? sanitize_text_field($_POST['cart_item_key']) : '';
	if ($cart_item_key && function_exists('WC') && WC()->cart) {
		WC()->cart->remove_cart_item($cart_item_key);
		$fragments = apply_filters('woocommerce_add_to_cart_fragments', array());
		wp_send_json_success(array('fragments' => $fragments));
	}
	wp_send_json_error(array('message' => 'Invalid cart item key'));
}

/**
 * AJAX Contact Form Submission Handler
 */
add_action('wp_ajax_woosaree_contact_form_submit', 'woosaree_contact_form_submit');
add_action('wp_ajax_nopriv_woosaree_contact_form_submit', 'woosaree_contact_form_submit');
function woosaree_contact_form_submit()
{
	// Security Nonce Verification
	if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'woosaree_contact_nonce')) {
		wp_send_json_error(array('message' => 'Security check failed. Please refresh the page and try again.'));
	}

	$name = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
	$email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
	$message = isset($_POST['message']) ? sanitize_textarea_field($_POST['message']) : '';

	if (empty($name) || empty($email) || empty($message)) {
		wp_send_json_error(array('message' => 'Please fill in all required fields.'));
	}

	if (!is_email($email)) {
		wp_send_json_error(array('message' => 'Please enter a valid email address.'));
	}

	// Site Admin Notification Email
	$admin_email = get_option('admin_email');
	$site_name = get_bloginfo('name');

	$subject_admin = sprintf('[%s] New Contact Enquiry from %s', $site_name, $name);
	$body_admin  = "You have received a new contact enquiry:\n\n";
	$body_admin .= "Name: " . $name . "\n";
	$body_admin .= "Email: " . $email . "\n";
	$body_admin .= "Message:\n" . $message . "\n\n";
	$body_admin .= "--\nSent from " . home_url();

	$headers_admin = array(
		'Content-Type: text/plain; charset=UTF-8',
		'Reply-To: ' . $name . ' <' . $email . '>'
	);

	wp_mail($admin_email, $subject_admin, $body_admin, $headers_admin);

	// Customer Auto-Reply Email
	$subject_customer = sprintf('Thank you for contacting %s', $site_name);
	$body_customer  = "Hi " . $name . ",\n\n";
	$body_customer .= "Thank you for reaching out! We have received your inquiry and will get back to you shortly.\n\n";
	$body_customer .= "Your Message:\n\"" . $message . "\"\n\n";
	$body_customer .= "Warm regards,\n" . $site_name . " Team\n" . home_url();

	$headers_customer = array(
		'Content-Type: text/plain; charset=UTF-8'
	);

wp_mail($email, $subject_customer, $body_customer, $headers_customer);

	wp_send_json_success(array('message' => 'Thank you! Your message has been sent successfully. We will get back to you shortly.'));
}

/**
 * Render Header Navigation Menu with Submenus and Product Categories
 */
function woosaree_render_header_menu()
{
	$locations = get_nav_menu_locations();
	$has_menu = false;

	if (isset($locations['header_menu'])) {
		$menu = wp_get_nav_menu_object($locations['header_menu']);
		if ($menu) {
			$menu_items = wp_get_nav_menu_items($menu->term_id);
			if (!empty($menu_items)) {
				$has_menu = true;

				// Organize menu items into parent and children
				$menu_tree = array();
				$children = array();

				foreach ($menu_items as $item) {
					if (empty($item->menu_item_parent)) {
						$menu_tree[$item->ID] = $item;
					} else {
						$children[$item->menu_item_parent][] = $item;
					}
				}

				// Fetch WooCommerce product categories for shop menus if needed (excluding uncategorized)
				$product_cats = array();
				if (taxonomy_exists('product_cat')) {
					$terms = get_terms(array(
						'taxonomy'   => 'product_cat',
						'hide_empty' => false,
						'parent'     => 0,
					));
					if (!empty($terms) && !is_wp_error($terms)) {
						$product_cats = array_filter($terms, function ($cat) {
							return strtolower($cat->slug) !== 'uncategorized' && strtolower($cat->name) !== 'uncategorized';
						});
					}
				}

				echo '<ul class="box-nav-ul d-flex align-items-center justify-content-center gap-30">';

				foreach ($menu_tree as $item_id => $item) {
					$has_children = isset($children[$item_id]) && !empty($children[$item_id]);
					$is_shop = (strtolower(trim($item->title)) === 'shop');

					// If shop menu item and has no explicit children, inject product categories as submenus
					$use_product_cats = ($is_shop && !$has_children && !empty($product_cats));
					$show_submenu = $has_children || $use_product_cats;

					$li_class = 'menu-item' . ($show_submenu ? ' position-relative' : '');
					echo '<li class="' . esc_attr($li_class) . '">';

					echo '<a class="item-link" href="' . esc_url($item->url) . '">';
					echo esc_html($item->title);
					if ($show_submenu) {
						echo '<i class="icon icon-arrow-down"></i>';
					}
					echo '</a>';

					if ($show_submenu) {
						echo '<div class="sub-menu submenu-default">';
						echo '<ul class="menu-list">';

						if ($has_children) {
							foreach ($children[$item_id] as $child) {
								$has_sub_children = isset($children[$child->ID]) && !empty($children[$child->ID]);
								$child_li_class = $has_sub_children ? 'menu-item-2' : '';
								echo '<li class="' . esc_attr($child_li_class) . '">';
								echo '<a href="' . esc_url($child->url) . '" class="menu-link-text link text_black-2 position-relative">' . esc_html($child->title) . '</a>';

								if ($has_sub_children) {
									echo '<div class="sub-menu submenu-default">';
									echo '<ul class="menu-list">';
									foreach ($children[$child->ID] as $sub_child) {
										echo '<li><a href="' . esc_url($sub_child->url) . '" class="menu-link-text link text_black-2">' . esc_html($sub_child->title) . '</a></li>';
									}
									echo '</ul>';
									echo '</div>';
								}
								echo '</li>';
							}
						} elseif ($use_product_cats) {
							foreach ($product_cats as $cat) {
								$cat_url = get_term_link($cat);
								echo '<li>';
								echo '<a href="' . esc_url($cat_url) . '" class="menu-link-text link text_black-2 position-relative">' . esc_html($cat->name) . '</a>';
								echo '</li>';
							}
						}

						echo '</ul>';
						echo '</div>';
					}

					echo '</li>';
				}

				echo '</ul>';
			}
		}
	}

	// Fallback menu if no header_menu is assigned
	if (!$has_menu) {
		$shop_url = function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/shop');
		$product_cats = array();
		if (taxonomy_exists('product_cat')) {
			$terms = get_terms(array(
				'taxonomy'   => 'product_cat',
				'hide_empty' => false,
				'parent'     => 0,
			));
			if (!empty($terms) && !is_wp_error($terms)) {
				$product_cats = array_filter($terms, function ($cat) {
					return strtolower($cat->slug) !== 'uncategorized' && strtolower($cat->name) !== 'uncategorized';
				});
			}
		}

		echo '<ul class="box-nav-ul d-flex align-items-center justify-content-center gap-30">';
		echo '<li class="menu-item"><a href="' . esc_url(home_url('/')) . '" class="item-link">Home</a></li>';

		echo '<li class="menu-item position-relative">';
		echo '<a href="' . esc_url($shop_url) . '" class="item-link">Shop<i class="icon icon-arrow-down"></i></a>';
		if (!empty($product_cats)) {
			echo '<div class="sub-menu submenu-default">';
			echo '<ul class="menu-list">';
			foreach ($product_cats as $cat) {
				echo '<li><a href="' . esc_url(get_term_link($cat)) . '" class="menu-link-text link text_black-2 position-relative">' . esc_html($cat->name) . '</a></li>';
			}
			echo '</ul>';
			echo '</div>';
		}
		echo '</li>';

		echo '</ul>';
	}
}

/**
 * Render Mobile Navigation Menu with Submenus and Product Categories (excluding Uncategorized)
 */
function woosaree_render_mobile_menu()
{
	$locations = get_nav_menu_locations();
	$has_menu = false;

	if (isset($locations['header_menu'])) {
		$menu = wp_get_nav_menu_object($locations['header_menu']);
		if ($menu) {
			$menu_items = wp_get_nav_menu_items($menu->term_id);
			if (!empty($menu_items)) {
				$has_menu = true;

				$menu_tree = array();
				$children = array();

				foreach ($menu_items as $item) {
					if (empty($item->menu_item_parent)) {
						$menu_tree[$item->ID] = $item;
					} else {
						$children[$item->menu_item_parent][] = $item;
					}
				}

				$product_cats = array();
				if (taxonomy_exists('product_cat')) {
					$terms = get_terms(array(
						'taxonomy'   => 'product_cat',
						'hide_empty' => false,
						'parent'     => 0,
					));
					if (!empty($terms) && !is_wp_error($terms)) {
						$product_cats = array_filter($terms, function ($cat) {
							return strtolower($cat->slug) !== 'uncategorized' && strtolower($cat->name) !== 'uncategorized';
						});
					}
				}

				echo '<ul class="nav-ul-mb" id="wrapper-menu-navigation">';

				foreach ($menu_tree as $item_id => $item) {
					$has_children = isset($children[$item_id]) && !empty($children[$item_id]);
					$is_shop = (strtolower(trim($item->title)) === 'shop');

					$use_product_cats = ($is_shop && !$has_children && !empty($product_cats));
					$show_submenu = $has_children || $use_product_cats;

					echo '<li class="nav-mb-item">';

					if ($show_submenu) {
						$collapse_id = 'mb-dropdown-' . $item_id;
						echo '<a href="#' . esc_attr($collapse_id) . '" class="collapsed mb-menu-link" data-bs-toggle="collapse" aria-expanded="false" aria-controls="' . esc_attr($collapse_id) . '">';
						echo '<span>' . esc_html($item->title) . '</span>';
						echo '<span class="btn-open-sub"></span>';
						echo '</a>';

						echo '<div id="' . esc_attr($collapse_id) . '" class="collapse">';
						echo '<ul class="sub-nav-menu">';

						if ($has_children) {
							foreach ($children[$item_id] as $child) {
								$has_sub_children = isset($children[$child->ID]) && !empty($children[$child->ID]);
								if ($has_sub_children) {
									$sub_collapse_id = 'mb-sub-' . $child->ID;
									echo '<li>';
									echo '<a href="#' . esc_attr($sub_collapse_id) . '" class="sub-nav-link collapsed" data-bs-toggle="collapse" aria-expanded="false" aria-controls="' . esc_attr($sub_collapse_id) . '">';
									echo '<span>' . esc_html($child->title) . '</span>';
									echo '<span class="btn-open-sub"></span>';
									echo '</a>';
									echo '<div id="' . esc_attr($sub_collapse_id) . '" class="collapse">';
									echo '<ul class="sub-nav-menu sub-menu-level-2">';
									foreach ($children[$child->ID] as $sub_child) {
										echo '<li><a href="' . esc_url($sub_child->url) . '" class="sub-nav-link">' . esc_html($sub_child->title) . '</a></li>';
									}
									echo '</ul>';
									echo '</div>';
									echo '</li>';
								} else {
									echo '<li><a href="' . esc_url($child->url) . '" class="sub-nav-link">' . esc_html($child->title) . '</a></li>';
								}
							}
						} elseif ($use_product_cats) {
							foreach ($product_cats as $cat) {
								echo '<li><a href="' . esc_url(get_term_link($cat)) . '" class="sub-nav-link">' . esc_html($cat->name) . '</a></li>';
							}
						}

						echo '</ul>';
						echo '</div>';
					} else {
						echo '<a href="' . esc_url($item->url) . '" class="mb-menu-link">' . esc_html($item->title) . '</a>';
					}

					echo '</li>';
				}

				echo '</ul>';
			}
		}
	}

	if (!$has_menu) {
		$shop_url = function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/shop');
		$product_cats = array();
		if (taxonomy_exists('product_cat')) {
			$terms = get_terms(array(
				'taxonomy'   => 'product_cat',
				'hide_empty' => false,
				'parent'     => 0,
			));
			if (!empty($terms) && !is_wp_error($terms)) {
				$product_cats = array_filter($terms, function ($cat) {
					return strtolower($cat->slug) !== 'uncategorized' && strtolower($cat->name) !== 'uncategorized';
				});
			}
		}

		echo '<ul class="nav-ul-mb" id="wrapper-menu-navigation">';
		echo '<li class="nav-mb-item"><a href="' . esc_url(home_url('/')) . '" class="mb-menu-link">Home</a></li>';

		echo '<li class="nav-mb-item">';
		if (!empty($product_cats)) {
			echo '<a href="#mb-dropdown-shop" class="collapsed mb-menu-link" data-bs-toggle="collapse" aria-expanded="false" aria-controls="mb-dropdown-shop">';
			echo '<span>Shop</span>';
			echo '<span class="btn-open-sub"></span>';
			echo '</a>';
			echo '<div id="mb-dropdown-shop" class="collapse">';
			echo '<ul class="sub-nav-menu">';
			foreach ($product_cats as $cat) {
				echo '<li><a href="' . esc_url(get_term_link($cat)) . '" class="sub-nav-link">' . esc_html($cat->name) . '</a></li>';
			}
			echo '</ul>';
			echo '</div>';
		} else {
			echo '<a href="' . esc_url($shop_url) . '" class="mb-menu-link">Shop</a>';
		}
		echo '</li>';

		echo '</ul>';
	}
}

