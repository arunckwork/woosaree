<?php
/**
 * Empty cart page template override for woosaree theme
 *
 * @package woosaree
 */

defined( 'ABSPATH' ) || exit;

/*
 * Empty cart page
 */
do_action( 'woocommerce_cart_is_empty' );

if ( wc_get_page_id( 'shop' ) > 0 ) : ?>
    <!-- page-title -->
    <div class="tf-page-title">
        <div class="container-full">
            <h1 class="heading text-center"><?php esc_html_e( 'Shopping Cart', 'woocommerce' ); ?></h1>
        </div>
    </div>
    <!-- /page-title -->

    <div class="tf-page-cart text-center py-5 my-5">
        <h4 class="mb-3 fw-6"><?php esc_html_e( 'Your cart is currently empty.', 'woocommerce' ); ?></h4>
        <p class="mb-4 text-muted"><?php esc_html_e( 'You may check out all the available products and buy some in the shop.', 'woocommerce' ); ?></p>
        <p class="return-to-shop">
            <a class="button wc-backward tf-btn btn-sm radius-3 btn-fill btn-icon animate-hover-btn d-inline-flex align-items-center justify-content-center gap-10" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
                <span><?php esc_html_e( 'Return to shop', 'woocommerce' ); ?></span>
                <i class="icon icon-arrow1-top-left"></i>
            </a>
        </p>
    </div>
<?php endif; ?>
