<?php
/**
 * Cart totals template override for woosaree theme
 *
 * @package woosaree
 */

defined( 'ABSPATH' ) || exit;

?>
<div class="tf-page-cart-checkout cart_totals <?php echo ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : ''; ?>">

    <?php do_action( 'woocommerce_before_cart_totals' ); ?>

    <div class="tf-cart-totals-discounts d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-6 fs-18 mb-0"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></h3>
        <span class="total-value fw-6 fs-18"><?php wc_cart_totals_subtotal_html(); ?></span>
    </div>

    <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
        <div class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?> d-flex justify-content-between align-items-center py-2 border-bottom">
            <span><?php wc_cart_totals_coupon_label( $coupon ); ?></span>
            <span><?php wc_cart_totals_coupon_html( $coupon ); ?></span>
        </div>
    <?php endforeach; ?>

    <?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
        <div class="fee d-flex justify-content-between align-items-center py-2 border-bottom">
            <span><?php echo esc_html( $fee->name ); ?></span>
            <span><?php wc_cart_totals_fee_html( $fee ); ?></span>
        </div>
    <?php endforeach; ?>

    <p class="tf-cart-tax text-muted fs-14 my-3">
        <?php esc_html_e( 'Taxes and shipping calculated at checkout', 'woocommerce' ); ?>
    </p>

    <?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

    <?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>

    <div class="cart-checkout-btn mt-3">
        <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="tf-btn w-100 btn-fill animate-hover-btn radius-3 justify-content-center">
            <span><?php esc_html_e( 'Check out', 'woocommerce' ); ?></span>
        </a>
    </div>

    <?php do_action( 'woocommerce_after_cart_totals' ); ?>

</div>
