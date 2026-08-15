<?php /* Template Name: Homepage */

get_header();
?>
<!-- slider -->

<div class="tf-slideshow slider-effect-fade position-relative">
    <div dir="ltr" class="swiper tf-sw-slideshow" data-preview="1" data-tablet="1" data-mobile="1" data-centered="false"
        data-space="0" data-loop="true" data-auto-play="true" data-delay="2000" data-speed="1000">
        <div class="swiper-wrapper">
            <?php

            $args = array(
                'post_type' => 'home_slider',
                'posts_per_page' => -1,
                'orderby' => 'menu_order',
                'order' => 'ASC'
            );

            $slider = new WP_Query($args);

            if ($slider->have_posts()):

                while ($slider->have_posts()):
                    $slider->the_post();
                    $redirect_url = get_post_meta(get_the_ID(), '_home_slider_redirect_url', true);
                    $slider_link = !empty($redirect_url) ? $redirect_url : home_url('/');
                    ?>
                    <div class="swiper-slide">
                        <a href="<?php echo esc_url($slider_link); ?>" class="wrap-slider">
                            <img class="lazyload" data-src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>"
                                alt="<?php the_title(); ?>"
                                src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>"
                                alt="<?php the_title(); ?>" alt="hp-slideshow-01">
                            <div class="box-content">
                                <!-- <div class="container">
                                    <p class="fade-item fade-item-1 subheading fw-7 tex">THE ALL-NEW SUMMER COLLECTION
                                    </p>
                                    <h2 class="fade-item fade-item-2 fw-6 heading">Looks fresh. Stays cool</h2>
                                    <div class="fade-item fade-item-3">
                                        <span class="tf-btn btn-light-icon animate-hover-btn btn-xl radius-60"><span>Shop
                                                collection</span><i class="icon icon-arrow-right"></i></span>
                                    </div>
                                </div> -->
                            </div>
                        </a>
                    </div>
                    <?php

                endwhile;

                wp_reset_postdata();

            endif;

            ?>
        </div>
    </div>
    <div class="wrap-pagination">
        <div class="container">
            <div class="sw-dots line-white-pagination sw-pagination-slider justify-content-center"></div>
        </div>
    </div>
</div>

<!-- categories -->
<section class="flat-spacing-20">
    <div class="container">
        <div class="tf-categories-wrap">
            <div class="tf-categories-container">
                <?php

                $product_categories = get_terms(array(
                    'taxonomy' => 'product_cat',
                    'hide_empty' => true,
                    'parent' => 0
                ));

                if (!empty($product_categories) && !is_wp_error($product_categories)):

                    foreach ($product_categories as $category):

                        $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                        $image = wp_get_attachment_url($thumbnail_id);

                        ?>
                        <div class="collection-item-circle hover-img">
                            <a href="<?php echo esc_url(get_term_link($category)); ?>" class="collection-image img-style">
                                <?php if ($image): ?>
                                    <img class="lazyload" data-src="<?php echo esc_url($image); ?>"
                                        src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($category->name); ?>">
                                <?php endif; ?>
                            </a>
                            <div class="collection-content text-center">
                                <a href="<?php echo esc_url(get_term_link($category)); ?>"
                                    class="link title fw-6"><?php echo esc_html($category->name); ?></a>
                            </div>
                        </div>
                        <?php

                    endforeach;

                endif;

                ?>
                <!-- <div class="collection-item-circle hover-img">
                            <a href="shop-default.html" class="collection-image img-style">
                                <img class="lazyload" data-src="<?php echo get_stylesheet_directory_uri(); ?>/images/sree-img/img/21082019120045P19819-2.jpg"
                                    src="<?php echo get_stylesheet_directory_uri(); ?>/images/sree-img/img/21082019120045P19819-2.jpg" alt="collection-img">
                            </a>
                            <div class="collection-content text-center">
                                <a href="shop-default.html" class="link title fw-6">Jewellers</a>
                            </div>
                        </div>
                        <div class="collection-item-circle hover-img">
                            <a href="shop-default.html" class="collection-image img-style">
                                <img class="lazyload" data-src="<?php echo get_stylesheet_directory_uri(); ?>/images/sree-img/img/saree-pr/1/saree-v1.jpg"
                                    src="<?php echo get_stylesheet_directory_uri(); ?>/images/sree-img/img/saree-pr/1/saree-v1.jpg" alt="collection-img">
                            </a>
                            <div class="collection-content text-center">
                                <a href="shop-default.html" class="link title fw-6">Cotton saree</a>
                            </div>
                        </div>
                         <div class="collection-item-circle hover-img">
                            <a href="shop-default.html" class="collection-image img-style">
                                <img class="lazyload" data-src="<?php echo get_stylesheet_directory_uri(); ?>/images/sree-img/img/saree-pr/2/2-saree-v4.jpg"
                                    src="<?php echo get_stylesheet_directory_uri(); ?>/images/sree-img/img/saree-pr/2/2-saree-v4.jpg" alt="collection-img">
                            </a>
                            <div class="collection-content text-center">
                                <a href="shop-default.html" class="link title fw-6">Kanjeevaram</a>
                            </div>
                        </div> -->

            </div>
            <div class="tf-shopall-wrap">
                <div class="collection-item-circle tf-shopall">
                    <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>"
                        class="collection-image img-style tf-shopall-icon">
                        <i class="icon icon-arrow1-top-left"></i>
                    </a>
                    <div class="collection-content text-center">
                        <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="link title fw-6">Shop
                            all</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /categories -->


<!-- Shop -->


<section class="flat-spacing-5 pt_0 flat-seller">
    <div class="container">
        <div class="flat-title">
            <span class="title wow fadeInUp" data-wow-delay="0s"
                style="visibility: visible; animation-delay: 0s; animation-name: fadeInUp;">Best Seller</span>
            <p class="sub-title wow fadeInUp" data-wow-delay="0s"
                style="visibility: visible; animation-delay: 0s; animation-name: fadeInUp;">Shop the Latest Styles: Stay
                ahead of the
                curve with our newest arrivals</p>
        </div>
        <div class="grid-layout loadmore-item wow fadeInUp" data-wow-delay="0s" data-grid="grid-4"
            style="visibility: visible; animation-delay: 0s; animation-name: fadeInUp;" id="product-list">

            <?php

            $args = array(
                'post_type' => 'product',
                'posts_per_page' => 8,
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
                    <!-- card product -->
                    <div class="card-product fl-item<?php echo !$has_hover_img ? ' none-hover' : ''; ?>"
                        style="display: block;">
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
                                    data-product-stock="<?php echo ($product->managing_stock() && $product->get_stock_quantity() > 0) ? (int) $product->get_stock_quantity() : 0; ?>"
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

                wp_reset_postdata();

            endif;

            ?>


        </div>
        <?php if ($products->max_num_pages > 1): ?>
            <div class="tf-pagination-wrap view-more-button text-center">
                <button class="tf-btn-loading tf-loading-default style-2 btn-loadmore " id="load-more-products"
                    data-page="1"><span class="text">Load
                        more</span></button>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Shop -->


<!-- Icon box -->
<section class="flat-spacing-11 pb_0 flat-iconbox wow fadeInUp" data-wow-delay="0s">
    <div class="container">
        <div class="wrap-carousel wrap-mobile">
            <div dir="ltr" class="swiper tf-sw-mobile" data-preview="1" data-space="15">
                <div class="swiper-wrapper wrap-iconbox">
                    <div class="swiper-slide">
                        <div class="tf-icon-box style-border-line text-center">
                            <div class="icon">
                                <i class="icon-shipping"></i>
                            </div>
                            <div class="content">
                                <div class="title">Fast Shipping</div>
                                <p>Free shipping over order ₹ 120</p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="tf-icon-box style-border-line text-center">
                            <div class="icon">
                                <i class="icon-payment fs-22"></i>
                            </div>
                            <div class="content">
                                <div class="title">Flexible Payment</div>
                                <p>Pay with Multiple Credit Cards</p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="tf-icon-box style-border-line text-center">
                            <div class="icon">
                                <i class="icon-return fs-22"></i>
                            </div>
                            <div class="content">
                                <div class="title">Instant In-Store Experience </div>
                                <p>Instant In-Store Experience </p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="tf-icon-box style-border-line text-center">
                            <div class="icon">
                                <i class="icon-suport"></i>
                            </div>
                            <div class="content">
                                <div class="title">Premium Support</div>
                                <p>24 hours a day, 7 days a week</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="sw-dots style-2 sw-pagination-mb justify-content-center"></div>
        </div>
    </div>
</section>
<!-- /Icon box -->


<section class="flat-spacing-7 flat-spacing-11">
    <div class="container">
        <div class="flat-title wow fadeInUp" data-wow-delay="0s"
            style="visibility: visible; animation-delay: 0s; animation-name: fadeInUp;">
            <span class="title">Follow Us on Instagram</span>
            <p class="sub-title">Inspire and let yourself be inspired, from one unique fashion to another.</p>
        </div>
        <div class="wrap-carousel wrap-shop-gram">
            <div dir="ltr"
                class="swiper tf-sw-shop-gallery swiper-initialized swiper-horizontal swiper-pointer-events swiper-backface-hidden"
                data-preview="5" data-tablet="3" data-mobile="2" data-space-lg="7" data-space-md="7">
                <div class="swiper-wrapper" style="transform: translate3d(0px, 0px, 0px);"
                    id="swiper-wrapper-1067f7cc93547dc24" aria-live="polite">
                    <div class="swiper-slide swiper-slide-active" style="width: 282.4px; margin-right: 7px;"
                        role="group" aria-label="1 / 6">
                        <div class="gallery-item hover-img wow fadeInUp" data-wow-delay="0s"
                            style="visibility: visible; animation-delay: 0s; animation-name: fadeInUp;">
                            <div class="img-style">
                                <img class="img-hover ls-is-cached lazyloaded"
                                    data-src="<?php echo get_stylesheet_directory_uri(); ?>/images/sree-img/img/saree-pr/7/7-sare3.jpg"
                                    src="<?php echo get_stylesheet_directory_uri(); ?>/images/sree-img/img/saree-pr/7/7-sare3.jpg"
                                    alt="image-gallery">
                            </div>
                            <!-- <a href="#quick_add" data-bs-toggle="modal" class="box-icon"><span
                                    class="icon icon-bag"></span> <span class="tooltip">Quick Add</span></a> -->
                        </div>
                    </div>
                    <div class="swiper-slide swiper-slide-next" style="width: 282.4px; margin-right: 7px;" role="group"
                        aria-label="2 / 6">
                        <div class="gallery-item hover-img wow fadeInUp" data-wow-delay=".1s"
                            style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
                            <div class="img-style">
                                <img class="img-hover ls-is-cached lazyloaded"
                                    data-src="<?php echo get_stylesheet_directory_uri(); ?>/images/sree-img/img/saree-pr/1/saree-v4.jpg"
                                    src="<?php echo get_stylesheet_directory_uri(); ?>/images/sree-img/img/saree-pr/1/saree-v4.jpg"
                                    alt="image-gallery">
                            </div>
                            <!-- <a href="#quick_add" data-bs-toggle="modal" class="box-icon"><span
                                    class="icon icon-bag"></span> <span class="tooltip">Quick Add</span></a> -->
                        </div>
                    </div>
                    <div class="swiper-slide" style="width: 282.4px; margin-right: 7px;" role="group"
                        aria-label="3 / 6">
                        <div class="gallery-item hover-img wow fadeInUp" data-wow-delay=".2s"
                            style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                            <div class="img-style">
                                <img class="img-hover ls-is-cached lazyloaded"
                                    data-src="<?php echo get_stylesheet_directory_uri(); ?>/images/sree-img/img/saree-pr/3/3-saree-v8.jpg"
                                    src="<?php echo get_stylesheet_directory_uri(); ?>/images/sree-img/img/saree-pr/3/3-saree-v8.jpg"
                                    alt="image-gallery">
                            </div>
                            <!-- <a href="#quick_add" data-bs-toggle="modal" class="box-icon"><span
                                    class="icon icon-bag"></span> <span class="tooltip">Quick Add</span></a> -->
                        </div>
                    </div>
                    <div class="swiper-slide" style="width: 282.4px; margin-right: 7px;" role="group"
                        aria-label="4 / 6">
                        <div class="gallery-item hover-img wow fadeInUp" data-wow-delay=".3s"
                            style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">
                            <div class="img-style">
                                <img class="img-hover ls-is-cached lazyloaded"
                                    data-src="<?php echo get_stylesheet_directory_uri(); ?>/images/sree-img/img/saree-pr/7/7-sare3.jpg"
                                    src="<?php echo get_stylesheet_directory_uri(); ?>/images/sree-img/img/saree-pr/7/7-sare3.jpg"
                                    alt="image-gallery">
                            </div>
                            <!-- <a href="product-detail.html" class="box-icon"><span class="icon icon-bag"></span>
                                <span class="tooltip">View product</span></a> -->
                        </div>
                    </div>
                    <div class="swiper-slide" style="width: 282.4px; margin-right: 7px;" role="group"
                        aria-label="5 / 6">
                        <div class="gallery-item hover-img wow fadeInUp" data-wow-delay=".4s"
                            style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                            <div class="img-style">
                                <img class="img-hover ls-is-cached lazyloaded"
                                    data-src="<?php echo get_stylesheet_directory_uri(); ?>/images/sree-img/img/saree-pr/1/saree-v4.jpg"
                                    src="<?php echo get_stylesheet_directory_uri(); ?>/images/sree-img/img/saree-pr/1/saree-v4.jpg"
                                    alt="image-gallery">
                            </div>
                            <!-- <a href="product-detail.html" class="box-icon"><span class="icon icon-bag"></span>
                                <span class="tooltip">View product</span></a> -->
                        </div>
                    </div>
                    <div class="swiper-slide" style="width: 282.4px; margin-right: 7px;" role="group"
                        aria-label="6 / 6">
                        <div class="gallery-item hover-img wow fadeInUp" data-wow-delay=".4s"
                            style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                            <div class="img-style">
                                <img class="img-hover ls-is-cached lazyloaded"
                                    data-src="<?php echo get_stylesheet_directory_uri(); ?>/images/sree-img/img/saree-pr/5/5-saree-v5.jpg"
                                    src="<?php echo get_stylesheet_directory_uri(); ?>/images/sree-img/img/saree-pr/5/5-saree-v5.jpg"
                                    alt="image-gallery">
                            </div>
                            <!-- <a href="product-detail.html" class="box-icon"><span class="icon icon-bag"></span>
                                <span class="tooltip">View product</span></a> -->
                        </div>
                    </div>
                </div>
                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
            </div>
            <div
                class="sw-dots sw-pagination-gallery justify-content-center swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal">
                <span class="swiper-pagination-bullet swiper-pagination-bullet-active" tabindex="0" role="button"
                    aria-label="Go to slide 1" aria-current="true"></span><span class="swiper-pagination-bullet"
                    tabindex="0" role="button" aria-label="Go to slide 2"></span>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>