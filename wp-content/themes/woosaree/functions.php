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
						<?php if (function_exists('yith_wcwl_add_to_wishlist')): ?>
							<?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>
						<?php else: ?>
							<a href="#" class="box-icon bg_white wishlist btn-icon-action">
								<span class="icon icon-heart"></span>
								<span class="tooltip">Add to Wishlist</span>
							</a>
						<?php endif; ?>
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




