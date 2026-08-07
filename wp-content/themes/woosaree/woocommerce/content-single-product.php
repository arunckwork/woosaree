<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * @package woosaree
 */

defined('ABSPATH') || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action('woocommerce_before_single_product');

if (post_password_required()) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}

// Get product gallery images
$attachment_ids = $product->get_gallery_image_ids();
$main_image_id = $product->get_image_id();
$gallery_ids = array();

if ($main_image_id) {
    $gallery_ids[] = $main_image_id;
}
if (!empty($attachment_ids)) {
    $gallery_ids = array_merge($gallery_ids, $attachment_ids);
}

// Calculate discount percentage if product is on sale
$regular_price = $product->get_regular_price();
$sale_price = $product->get_sale_price();
$discount_percentage = 0;
if ($product->is_on_sale() && !empty($regular_price) && !empty($sale_price) && $regular_price > $sale_price) {
    $discount_percentage = round((($regular_price - $sale_price) / $regular_price) * 100);
}

// Prev and Next product navigation
$prev_post = get_previous_post(true, '', 'product_cat');
$next_post = get_next_post(true, '', 'product_cat');
if (!$prev_post) {
    $prev_post = get_previous_post();
}
if (!$next_post) {
    $next_post = get_next_post();
}
$shop_url = function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/shop');
?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class('', $product); ?>>

    <!-- breadcrumb -->
    <div class="tf-breadcrumb">
        <div class="container">
            <div class="tf-breadcrumb-wrap d-flex justify-content-between flex-wrap align-items-center">
                <div class="tf-breadcrumb-list">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="text">Home</a>
                    <i class="icon icon-arrow-right"></i>
                    <?php
                    $categories = get_the_terms($product->get_id(), 'product_cat');
                    if (!empty($categories) && !is_wp_error($categories)) {
                        $main_cat = $categories[0];
                        echo '<a href="' . esc_url(get_term_link($main_cat)) . '" class="text">' . esc_html($main_cat->name) . '</a>';
                        echo '<i class="icon icon-arrow-right"></i>';
                    }
                    ?>
                    <span class="text"><?php the_title(); ?></span>
                </div>
                <div class="tf-breadcrumb-prev-next">
                    <?php if ($prev_post): ?>
                        <a href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>"
                            class="tf-breadcrumb-prev hover-tooltip center"
                            title="<?php echo esc_attr(get_the_title($prev_post->ID)); ?>">
                            <i class="icon icon-arrow-left"></i>
                        </a>
                    <?php endif; ?>
                    <a href="<?php echo esc_url($shop_url); ?>" class="tf-breadcrumb-back hover-tooltip center"
                        title="Back to Shop">
                        <i class="icon icon-shop"></i>
                    </a>
                    <?php if ($next_post): ?>
                        <a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>"
                            class="tf-breadcrumb-next hover-tooltip center"
                            title="<?php echo esc_attr(get_the_title($next_post->ID)); ?>">
                            <i class="icon icon-arrow-right"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- /breadcrumb -->

    <!-- main product -->
    <section class="flat-spacing-4 pt_0">
        <div class="tf-main-product section-image-zoom">
            <div class="container">
                <div class="row">
                    <!-- Left: Media Gallery -->
                    <div class="col-md-6">
                        <div class="tf-product-media-wrap sticky-top">
                            <div class="thumbs-slider">
                                <!-- Thumbnails Swiper -->
                                <div dir="ltr" class="swiper tf-product-media-thumbs other-image-zoom"
                                    data-direction="vertical">
                                    <div class="swiper-wrapper stagger-wrap">
                                        <?php if (!empty($gallery_ids)): ?>
                                            <?php foreach ($gallery_ids as $img_id):
                                                $thumb_url = wp_get_attachment_image_url($img_id, 'woocommerce_thumbnail');
                                                $full_url = wp_get_attachment_image_url($img_id, 'full');
                                                if (!$thumb_url)
                                                    continue;
                                                ?>
                                                <div class="swiper-slide stagger-item">
                                                    <div class="item">
                                                        <img class="lazyload" data-src="<?php echo esc_url($full_url); ?>"
                                                            src="<?php echo esc_url($thumb_url); ?>"
                                                            alt="<?php echo esc_attr(get_the_title()); ?>">
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <div class="swiper-slide stagger-item">
                                                <div class="item">
                                                    <img class="lazyload"
                                                        data-src="<?php echo esc_url(wc_placeholder_img_src()); ?>"
                                                        src="<?php echo esc_url(wc_placeholder_img_src()); ?>"
                                                        alt="placeholder">
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <!-- Main Gallery Swiper -->
                                <div dir="ltr" class="swiper tf-product-media-main" id="gallery-swiper-started">
                                    <div class="swiper-wrapper">
                                        <?php if (!empty($gallery_ids)): ?>
                                            <?php foreach ($gallery_ids as $img_id):
                                                $full_url = wp_get_attachment_image_url($img_id, 'full');
                                                $large_url = wp_get_attachment_image_url($img_id, 'large');
                                                if (!$full_url)
                                                    continue;
                                                ?>
                                                <div class="swiper-slide">
                                                    <a href="<?php echo esc_url($full_url); ?>" target="_blank" class="item"
                                                        data-pswp-width="770px" data-pswp-height="1075px">
                                                        <img class="tf-image-zoom lazyload"
                                                            data-zoom="<?php echo esc_url($full_url); ?>"
                                                            data-src="<?php echo esc_url($large_url ? $large_url : $full_url); ?>"
                                                            src="<?php echo esc_url($large_url ? $large_url : $full_url); ?>"
                                                            alt="<?php echo esc_attr(get_the_title()); ?>">
                                                    </a>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <div class="swiper-slide">
                                                <a href="<?php echo esc_url(wc_placeholder_img_src()); ?>" target="_blank"
                                                    class="item" data-pswp-width="770px" data-pswp-height="1075px">
                                                    <img class="tf-image-zoom lazyload"
                                                        data-zoom="<?php echo esc_url(wc_placeholder_img_src()); ?>"
                                                        data-src="<?php echo esc_url(wc_placeholder_img_src()); ?>"
                                                        src="<?php echo esc_url(wc_placeholder_img_src()); ?>"
                                                        alt="placeholder">
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="swiper-button-next button-style-arrow thumbs-next"></div>
                                    <div class="swiper-button-prev button-style-arrow thumbs-prev"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Product Info -->
                    <div class="col-md-6">
                        <div class="tf-product-info-wrap position-relative">
                            <div class="tf-zoom-main"></div>
                            <div class="tf-product-info-list other-image-zoom">
                                <div class="tf-product-info-title">
                                    <h5><?php the_title(); ?></h5>
                                </div>

                                <div class="tf-product-info-price">
                                    <?php if ($product->is_on_sale() && !empty($sale_price)): ?>
                                        <div class="price-on-sale"
                                            data-price="<?php echo esc_attr($product->get_price()); ?>">
                                            <?php echo wc_price($product->get_price()); ?></div>
                                        <div class="compare-at-price"><?php echo wc_price($regular_price); ?></div>
                                        <?php if ($discount_percentage > 0): ?>
                                            <div class="badges-on-sale">
                                                <span><?php echo esc_html($discount_percentage); ?></span>% OFF
                                            </div>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <div class="price-on-sale"
                                            data-price="<?php echo esc_attr($product->get_price()); ?>">
                                            <?php echo $product->get_price_html(); ?></div>
                                    <?php endif; ?>
                                </div>

                                <?php if (get_the_excerpt()): ?>
                                    <div class="d-flex justify-content-between align-items-center my-3">
                                        <div class="variant-picker-label">
                                            <?php echo wp_kses_post(get_the_excerpt()); ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <!-- Add to Cart Form -->
                                <?php if ($product->is_in_stock()): ?>
                                    <div class="tf-product-info-quantity mt-4">
                                        <div class="quantity-title fw-6 mb-2">Quantity</div>
                                        <div class="wg-quantity">
                                            <span class="btn-quantity btn-decrease">-</span>
                                            <input type="text" class="quantity-product" name="quantity_display" value="1"
                                                readonly>
                                            <span class="btn-quantity btn-increase">+</span>
                                        </div>
                                    </div>

                                    <div class="tf-product-info-buy-button mt-3">
                                        <?php if ($product->is_type('variable')): ?>
                                            <div class="mb-3">
                                                <?php woocommerce_variable_add_to_cart(); ?>
                                            </div>
                                        <?php else: ?>
                                            <form class="cart d-flex flex-wrap gap-10"
                                                action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>"
                                                method="post" enctype='multipart/form-data'>
                                                <input type="hidden" name="quantity" value="1"
                                                    class="quantity-product-hidden" />

                                                <button type="submit" name="add-to-cart"
                                                    value="<?php echo esc_attr($product->get_id()); ?>"
                                                    class="tf-btn btn-fill justify-content-center fw-6 fs-16 flex-grow-1 animate-hover-btn btn-add-to-cart">
                                                    <span>Add to cart -&nbsp;</span>
                                                    <span class="tf-qty-price total-price"
                                                        data-price="<?php echo esc_attr($product->get_price()); ?>"><?php echo wc_price($product->get_price()); ?></span>
                                                </button>

                                                <!-- <?php if (function_exists('yith_wcwl_add_to_wishlist')): ?>
                                        <?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>
                                        <?php else: ?>
                                        <a href="#"
                                            class="tf-product-btn-wishlist hover-tooltip box-icon bg_white wishlist btn-icon-action">
                                            <span class="icon icon-heart"></span>
                                            <span class="tooltip">Add to Wishlist</span>
                                        </a>
                                        <?php endif; ?> -->

                                                <div class="w-100 mt-2">
                                                    <button type="submit" name="add-to-cart"
                                                        value="<?php echo esc_attr($product->get_id()); ?>"
                                                        onclick="this.form.action='<?php echo esc_url(wc_get_checkout_url()); ?>';"
                                                        class="btns-full w-100 text-center py-2"
                                                        style="border:none; border-radius:4px; font-weight:600; display:block;">Buy
                                                        Now</button>
                                                </div>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                <?php else: ?>
                                    <div class="out-of-stock-message my-3">
                                        <p class="text-danger fw-6"><?php esc_html_e('Out of stock', 'woocommerce'); ?>
                                        </p>
                                    </div>
                                <?php endif; ?>

                                <!-- Extra Action Links -->
                                <div class="tf-product-info-extra-link mt-4 pt-3 border-top d-flex gap-20 flex-wrap">
                                    <!-- <a href="#ask_question" data-bs-toggle="modal" class="tf-product-extra-icon d-flex align-items-center gap-2">
                                        <div class="icon"><i class="icon-question"></i></div>
                                        <div class="text fw-6">Ask a question</div>
                                    </a> -->
                                    <a href="#delivery_return" data-bs-toggle="modal"
                                        class="tf-product-extra-icon d-flex align-items-center gap-2">
                                        <div class="icon">
                                            <svg class="d-inline-block" xmlns="http://www.w3.org/2000/svg" width="22"
                                                height="18" viewBox="0 0 22 18" fill="currentColor">
                                                <path
                                                    d="M21.7872 10.4724C21.7872 9.73685 21.5432 9.00864 21.1002 8.4217L18.7221 5.27043C18.2421 4.63481 17.4804 4.25532 16.684 4.25532H14.9787V2.54885C14.9787 1.14111 13.8334 0 12.4255 0H9.95745V1.69779H12.4255C12.8948 1.69779 13.2766 2.07962 13.2766 2.54885V14.5957H8.15145C7.80021 13.6052 6.85421 12.8936 5.74468 12.8936C4.63515 12.8936 3.68915 13.6052 3.33792 14.5957H2.55319C2.08396 14.5957 1.70213 14.2139 1.70213 13.7447V2.54885C1.70213 2.07962 2.08396 1.69779 2.55319 1.69779H9.95745V0H2.55319C1.14528 0 0 1.14111 0 2.54885V13.7447C0 15.1526 1.14528 16.2979 2.55319 16.2979H3.33792C3.68915 17.2884 4.63515 18 5.74468 18C6.85421 18 7.80021 17.2884 8.15145 16.2979H13.423C13.7742 17.2884 14.7202 18 15.8297 18C16.9393 18 17.8853 17.2884 18.2365 16.2979H21.7872V10.4724ZM16.684 5.95745C16.9494 5.95745 17.2034 6.08396 17.3634 6.29574L19.5166 9.14894H14.9787V5.95745H16.684ZM5.74468 16.2979C5.27545 16.2979 4.89362 15.916 4.89362 15.4468C4.89362 14.9776 5.27545 14.5957 5.74468 14.5957C6.21392 14.5957 6.59575 14.9776 6.59575 15.4468C6.59575 15.916 6.21392 16.2979 5.74468 16.2979ZM15.8298 16.2979C15.3606 16.2979 14.9787 15.916 14.9787 15.4468C14.9787 14.9776 15.3606 14.5957 15.8298 14.5957C16.299 14.5957 16.6809 14.9776 16.6809 15.4468C16.6809 15.916 16.299 16.2979 15.8298 16.2979ZM18.2366 14.5957C17.8853 13.6052 16.9393 12.8936 15.8298 12.8936C15.5398 12.8935 15.252 12.943 14.9787 13.04V10.8511H20.0851V14.5957H18.2366Z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div class="text fw-6">Delivery & Return</div>
                                    </a>
                                    <a href="#share_social" data-bs-toggle="modal"
                                        class="tf-product-extra-icon d-flex align-items-center gap-2">
                                        <div class="icon"><i class="icon-share"></i></div>
                                        <div class="text fw-6">Share</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Full Description -->
    <?php if (get_the_content()): ?>
        <section class="flat-spacing-1 pt_0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="product-description-wrap p-4 bg-light radius-10">
                            <h4 class="mb-3">Product Details</h4>
                            <div class="description-content">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- Modals -->
    <!-- Modal: Ask Question -->
    <div class="modal modalCentered fade modalDemo tf-product-modal modal-part-content" id="ask_question">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="header">
                    <div class="demo-title">Ask a question</div>
                    <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
                </div>
                <div class="overflow-y-auto">
                    <form class="p-3">
                        <fieldset class="mb-3">
                            <label class="form-label">Name *</label>
                            <input type="text" class="form-control" name="name" required>
                        </fieldset>
                        <fieldset class="mb-3">
                            <label class="form-label">Email *</label>
                            <input type="email" class="form-control" name="email" required>
                        </fieldset>
                        <fieldset class="mb-3">
                            <label class="form-label">Phone number</label>
                            <input type="text" class="form-control" name="phone">
                        </fieldset>
                        <fieldset class="mb-3">
                            <label class="form-label">Message</label>
                            <textarea name="message" rows="4" class="form-control" required></textarea>
                        </fieldset>
                        <button type="submit"
                            class="tf-btn w-100 btn-fill justify-content-center fw-6 fs-16 animate-hover-btn"><span>Send</span></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal: Delivery & Return -->
    <div class="modal modalCentered fade modalDemo tf-product-modal modal-part-content" id="delivery_return">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="header">
                    <div class="demo-title">Shipping & Delivery</div>
                    <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
                </div>
                <div class="overflow-y-auto p-4">
                    <div class="tf-product-popup-delivery mb-3">
                        <div class="title fw-6 mb-1">Delivery</div>
                        <p class="text-paragraph">Free shipping on selected items and orders over qualifying amounts.
                        </p>
                        <p class="text-paragraph">Tracking details sent via WhatsApp and Email upon dispatch.</p>
                    </div>
                    <div class="tf-product-popup-delivery mb-3">
                        <div class="title fw-6 mb-1">Returns</div>
                        <p class="text-paragraph">Please refer to the individual return policy specified on the product
                            page.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal: Share Social -->
    <div class="modal modalCentered fade modalDemo tf-product-modal modal-part-content" id="share_social">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="header">
                    <div class="demo-title">Share</div>
                    <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
                </div>
                <div class="overflow-y-auto p-4 text-center">
                    <ul class="tf-social-icon d-flex justify-content-center gap-10 mb-3">
                        <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>"
                                target="_blank" class="box-icon social-facebook bg_line"><i
                                    class="icon icon-fb"></i></a></li>
                        <li><a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>"
                                target="_blank" class="box-icon social-twiter bg_line"><i
                                    class="icon icon-Icon-x"></i></a></li>
                        <li><a href="https://api.whatsapp.com/send?text=<?php echo urlencode(get_permalink()); ?>"
                                target="_blank" class="box-icon social-whatsapp bg_line"><i
                                    class="fa fa-whatsapp"></i></a></li>
                    </ul>
                    <div class="d-flex gap-10">
                        <input type="text" class="form-control" value="<?php echo esc_url(get_permalink()); ?>" readonly
                            id="share-link-input">
                        <button class="tf-btn btn-sm radius-3 btn-fill animate-hover-btn" type="button"
                            onclick="navigator.clipboard.writeText(document.getElementById('share-link-input').value);">Copy</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php do_action('woocommerce_after_single_product'); ?>