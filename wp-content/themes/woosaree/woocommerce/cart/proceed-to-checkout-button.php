<?php
/**
 * Proceed to checkout button template override for woosaree theme
 *
 * @package woosaree
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="checkout-button button alt wc-forward tf-btn w-100 btn-fill animate-hover-btn radius-3 justify-content-center">
	<span><?php esc_html_e( 'Proceed to checkout', 'woocommerce' ); ?></span>
</a>
