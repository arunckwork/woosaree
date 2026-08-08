<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * @package woosaree
 */

defined('ABSPATH') || exit;

get_header('shop');
?>

<?php
$page_title = function_exists('woocommerce_page_title') ? woocommerce_page_title(false) : '';
if (empty(trim(strip_tags($page_title)))) {
    $shop_id = function_exists('wc_get_page_id') ? wc_get_page_id('shop') : 0;
    $page_title = ($shop_id > 0) ? get_the_title($shop_id) : '';
}
if (empty(trim(strip_tags($page_title)))) {
    $page_title = __('Shop', 'woosaree');
}
?>

<!-- Breadcrumb -->
<div class="tf-breadcrumb">
    <div class="container">
        <div class="tf-breadcrumb-wrap d-flex justify-content-between flex-wrap align-items-center">
            <div class="tf-breadcrumb-list">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="text">Home</a>
                <i class="icon icon-arrow-right"></i>
                <span class="text"><?php echo esc_html($page_title); ?></span>
            </div>
        </div>
    </div>
</div>
<!-- /Breadcrumb -->

<!-- Page Title -->
<div class="tf-page-title pt_0">
    <div class="container-full">
        <h1 class="heading text-center"><?php echo esc_html($page_title); ?></h1>
        <?php if (is_product_category() || is_product_tag()): ?>
            <div class="text-center text-2 text_black-2 mt_5">
                <?php do_action('woocommerce_archive_description'); ?>
            </div>
        <?php else: ?>
            <p class="text-center text-2 text_black-2 mt_5">Shop through our latest selection of Fashion</p>
        <?php endif; ?>
    </div>
</div>
<!-- /Page Title -->

<!-- Product Grid Section -->
<section class="flat-spacing-1 pt_0 flat-seller">
    <div class="container">
        <?php if (have_posts()): ?>

            <div class="grid-layout loadmore-item wow fadeInUp" data-wow-delay="0s" data-grid="grid-4">
                <?php
                while (have_posts()):
                    the_post();

                    global $product;
                    if (empty($product) || !is_a($product, 'WC_Product')) {
                        $product = wc_get_product(get_the_ID());
                    }
                    if (!$product)
                        continue;

                    $main_image_id = $product->get_image_id();
                    $main_image_url = $main_image_id ? wp_get_attachment_image_url($main_image_id, 'woocommerce_thumbnail') : wc_placeholder_img_src();
                    $gallery_image_ids = $product->get_gallery_image_ids();
                    $has_hover_img = !empty($gallery_image_ids) && !empty($gallery_image_ids[0]);
                    $hover_image_url = $has_hover_img ? wp_get_attachment_image_url($gallery_image_ids[0], 'woocommerce_thumbnail') : '';
                    ?>
                    <!-- Product Card -->
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
                                <a href="#quick_add" data-bs-toggle="modal" class="box-icon bg_white quick-add tf-btn-loading" data-product-id="<?php echo esc_attr($product->get_id()); ?>" data-product-title="<?php echo esc_attr(get_the_title()); ?>" data-product-price="<?php echo esc_attr($product->get_price_html()); ?>" data-product-raw-price="<?php echo esc_attr($product->get_price()); ?>" data-product-image="<?php echo esc_url($main_image_url); ?>" data-product-url="<?php echo esc_url(get_permalink()); ?>">
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
                ?>
            </div>

            <!-- WooCommerce Pagination -->
            <div class="tf-pagination text-center mt-5">
                <ul class="wg-pagination d-flex justify-content-center align-items-center gap-10 flex-wrap"
                    style="list-style: none; padding: 0;">
                    <?php
                    global $wp_query;
                    $big = 999999999;
                    $pages = paginate_links(array(
                        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                        'format' => '?paged=%#%',
                        'current' => max(1, get_query_var('paged')),
                        'total' => $wp_query->max_num_pages,
                        'type' => 'array',
                        'prev_text' => '<i class="icon icon-arrow-left"></i>',
                        'next_text' => '<i class="icon icon-arrow-right"></i>',
                    ));

                    if (is_array($pages)) {
                        foreach ($pages as $page) {
                            $is_active = strpos($page, 'current') !== false;
                            $active_class = $is_active ? ' active' : '';
                            echo '<li class="pagination-item' . $active_class . '" style="width: 45px; height: 39px; display: inline-flex; align-items: center; justify-content: center; border: 1px solid #e5e5e5; border-radius: 3px;' . ($is_active ? ' background-color: #000; color: #fff;' : '') . '">';
                            echo str_replace('<a ', '<a style="color: inherit; text-decoration: none; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;" ', $page);
                            echo '</li>';
                        }
                    }
                    ?>
                </ul>
            </div>

        <?php else: ?>
            <div class="text-center py-5">
                <h4>No products found</h4>
                <p>Check back later or explore other categories.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php
get_footer('shop');
