<?php
/**
 * Cart Page Template Override for woosaree theme
 *
 * @package woosaree
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>

<section class="flat-spacing-11">
    <div class="container">
        <div class="tf-page-cart-wrap">
            <div class="tf-page-cart-item">
                <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
                    <?php do_action( 'woocommerce_before_cart_table' ); ?>

                    <table class="tf-table-page-cart shop_table shop_table_responsive cart woocommerce-cart-form__contents">
                        <thead>
                            <tr>
                                <th class="product-name"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
                                <th class="product-price"><?php esc_html_e( 'Price', 'woocommerce' ); ?></th>
                                <th class="product-quantity"><?php esc_html_e( 'Quantity', 'woocommerce' ); ?></th>
                                <th class="product-subtotal"><?php esc_html_e( 'Total', 'woocommerce' ); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php do_action( 'woocommerce_before_cart_contents' ); ?>

                            <?php
                            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                                $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                                $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
                                $product_name = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );

                                if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                                    $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                                    $qty = $cart_item['quantity'];
                                    ?>
                                    <tr class="tf-cart-item file-delete woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

                                        <td class="tf-cart-item_product product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
                                            <?php
                                            $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image( 'woocommerce_thumbnail' ), $cart_item, $cart_item_key );

                                            if ( ! $product_permalink ) {
                                                echo '<span class="img-box">' . $thumbnail . '</span>';
                                            } else {
                                                printf( '<a href="%s" class="img-box">%s</a>', esc_url( $product_permalink ), $thumbnail );
                                            }
                                            ?>
                                            <div class="cart-info">
                                                <?php
                                                if ( ! $product_permalink ) {
                                                    echo wp_kses_post( $product_name . '&nbsp;' );
                                                } else {
                                                    echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s" class="cart-title link">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
                                                }

                                                do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

                                                $item_data = wc_get_formatted_cart_item_data( $cart_item );
                                                $short_desc = $_product->get_short_description();

                                                if ( ! empty( $item_data ) ) {
                                                    echo '<div class="cart-meta-variant">' . $item_data . '</div>';
                                                } elseif ( ! empty( $short_desc ) ) {
                                                    echo '<div class="cart-meta-variant">' . wp_strip_all_tags( wp_trim_words( $short_desc, 10 ) ) . '</div>';
                                                }

                                                if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                                                    echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
                                                }
                                                ?>
                                                <span class="remove-cart link remove cart-page-remove-btn" data-cart-item-key="<?php echo esc_attr( $cart_item_key ); ?>" style="cursor:pointer;">Remove</span>
                                            </div>
                                        </td>

                                        <td class="tf-cart-item_price tf-variant-item-price product-price" cart-data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
                                            <div class="cart-price price">
                                                <?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); ?>
                                            </div>
                                        </td>

                                        <td class="tf-cart-item_quantity product-quantity" cart-data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
                                            <div class="cart-quantity">
                                                <div class="wg-quantity">
                                                    <span class="btn-quantity btndecrease cart-page-qty-btn" data-cart-item-key="<?php echo esc_attr( $cart_item_key ); ?>" data-current-qty="<?php echo esc_attr( $qty ); ?>" style="cursor:pointer;">
                                                        <svg class="d-inline-block" width="9" height="1" viewBox="0 0 9 1" fill="currentColor">
                                                            <path d="M9 1H5.14286H3.85714H0V1.50201e-05H3.85714L5.14286 0L9 1.50201e-05V1Z"></path>
                                                        </svg>
                                                    </span>
                                                    <input type="text" name="cart_quantity" value="<?php echo esc_attr( $qty ); ?>" readonly>
                                                    <span class="btn-quantity btnincrease cart-page-qty-btn" data-cart-item-key="<?php echo esc_attr( $cart_item_key ); ?>" data-current-qty="<?php echo esc_attr( $qty ); ?>" style="cursor:pointer;">
                                                        <svg class="d-inline-block" width="9" height="9" viewBox="0 0 9 9" fill="currentColor">
                                                            <path d="M9 5.14286H5.14286V9H3.85714V5.14286H0V3.85714H3.85714V0H5.14286V3.85714H9V5.14286Z"></path>
                                                        </svg>
                                                    </span>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="tf-cart-item_total tf-variant-item-total product-subtotal" cart-data-title="<?php esc_attr_e( 'Total', 'woocommerce' ); ?>">
                                            <div class="cart-total price">
                                                <?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?>
                                            </div>
                                        </td>

                                    </tr>
                                    <?php
                                }
                            }
                            ?>

                            <?php do_action( 'woocommerce_cart_contents' ); ?>
                            <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
                            <?php do_action( 'woocommerce_after_cart_contents' ); ?>
                        </tbody>
                    </table>
                    <?php do_action( 'woocommerce_after_cart_table' ); ?>
                </form>
            </div>

            <div class="tf-page-cart-footer">
                <div class="tf-cart-footer-inner">
                    <?php
                    /**
                     * Cart collaterals hook.
                     *
                     * @hooked woocommerce_cross_sell_display
                     * @hooked woocommerce_cart_totals - 10
                     */
                    do_action( 'woocommerce_cart_collaterals' );
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php do_action( 'woocommerce_after_cart' ); ?>
