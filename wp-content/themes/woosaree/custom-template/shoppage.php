<?php
/*
Template Name: Custom Shop Page
*/

get_header();
?>

<!-- Breadcrumb -->
<div class="tf-breadcrumb">
    <div class="container">
        <div class="tf-breadcrumb-wrap d-flex justify-content-between flex-wrap align-items-center">
            <div class="tf-breadcrumb-list">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="text">Home</a>
                <i class="icon icon-arrow-right"></i>
                <span class="text"><?php the_title(); ?></span>
            </div>
        </div>
    </div>
</div>
<!-- /Breadcrumb -->

<!-- Page Title -->
<div class="tf-page-title pt_0">
    <div class="container-full">
        <div class="heading text-center"><?php the_title(); ?></div>
        <?php if (has_excerpt()): ?>
            <p class="text-center text-2 text_black-2 mt_5"><?php echo esc_html(get_the_excerpt()); ?></p>
        <?php else: ?>
            <p class="text-center text-2 text_black-2 mt_5">Explore our latest selection of sarees</p>
        <?php endif; ?>
    </div>
</div>
<!-- /Page Title -->

<!-- Product Grid Section -->
<section class="flat-spacing-1 pt_0 flat-seller">
    <div class="container">
        <?php
        $paged = (get_query_var('paged')) ? get_query_var('paged') : ((get_query_var('page')) ? get_query_var('page') : 1);
        $args = array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'posts_per_page' => 12,
            'paged' => $paged,
        );

        $products_query = new WP_Query($args);

        if ($products_query->have_posts()):
            ?>
            <div class="grid-layout loadmore-item wow fadeInUp" data-wow-delay="0s" data-grid="grid-4">
                <?php
                while ($products_query->have_posts()):
                    $products_query->the_post();
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
                ?>
            </div>

            <!-- Pagination -->
            <?php if ($products_query->max_num_pages > 1): ?>
                <div class="tf-pagination text-center mt-5">
                    <ul class="wg-pagination d-flex justify-content-center align-items-center gap-10 flex-wrap"
                        style="list-style: none; padding: 0;">
                        <?php
                        $big = 999999999;
                        $pages = paginate_links(array(
                            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                            'format' => '?paged=%#%',
                            'current' => max(1, $paged),
                            'total' => $products_query->max_num_pages,
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
            <?php endif; ?>

            <?php
            wp_reset_postdata();
        else:
            ?>
            <div class="text-center py-5">
                <h4>No products found</h4>
                <p>Check back later or explore other categories.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php
get_footer();
