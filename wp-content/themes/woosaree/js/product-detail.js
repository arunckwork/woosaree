(function ($) {
    "use strict";

    $(document).ready(function () {
        // Quantity Increase / Decrease handler
        $(document).on('click', '.btn-decrease, .btn-increase', function (e) {
            e.preventDefault();
            var $button = $(this);
            var $wg = $button.closest('.wg-quantity');
            var $input = $wg.find('.quantity-product, input[name="quantity"]');
            var oldValue = parseFloat($input.val()) || 1;
            var newVal = oldValue;
            var stockMax = parseInt($wg.attr('data-stock-max')) || 0;

            if ($button.hasClass('btn-increase')) {
                if (stockMax > 0 && oldValue >= stockMax) {
                    newVal = stockMax;
                } else {
                    newVal = oldValue + 1;
                }
            } else {
                if (oldValue > 1) {
                    newVal = oldValue - 1;
                } else {
                    newVal = 1;
                }
            }

            // Toggle disabled state on increase button if stock limit reached
            var $increaseBtn = $wg.find('.btn-increase');
            if (stockMax > 0 && newVal >= stockMax) {
                $increaseBtn.addClass('disabled').css('pointer-events', 'none');
            } else {
                $increaseBtn.removeClass('disabled').css('pointer-events', '');
            }

            $input.val(newVal).trigger('change');

            // Sync hidden WooCommerce quantity input if separate
            $('form.cart input[name="quantity"]').val(newVal);
        });

        // Update the total price in the Add to Cart button when qty changes on the product page.
        // The .quantity-product input is a SIBLING of form.cart (not inside it), so we cannot
        // use descendant selectors from form.cart. Instead we listen on the buttons globally
        // and bail out if the click is inside #quick_add (which has its own price handler).
        $(document).on('click', '.btn-increase, .btn-decrease', function () {
            // Skip if this button is inside the quick-add modal — that has its own handler
            if ($(this).closest('#quick_add').length) return;

            // Delay so the input value has already been updated by the handler above
            setTimeout(updateProductPagePrice, 15);
        });

        function updateProductPagePrice() {
            // The price span lives inside form.cart on the product page
            var $priceSpan = $('form.cart').find('.total-price[data-price]');
            if (!$priceSpan.length) return;

            var unitPrice = parseFloat($priceSpan.attr('data-price'));
            if (isNaN(unitPrice) || unitPrice <= 0) return;

            // The qty input is OUTSIDE form.cart — find it via .wg-quantity on the page
            // (exclude any inside #quick_add to be safe)
            var $qtyInput = $('.wg-quantity').not('#quick_add .wg-quantity').find('.quantity-product');
            var quantity = parseInt($qtyInput.val()) || 1;

            var totalPrice = unitPrice * quantity;

            // Match the locale/format used by the quick-add modal
            var formatted = totalPrice.toLocaleString('en-IN', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });

            // Preserve the currency symbol already rendered inside the span by WooCommerce
            var $symbol = $priceSpan.find('.woocommerce-Price-currencySymbol');
            if ($symbol.length) {
                var symbol = $symbol.text().trim();
                $priceSpan.html('<span class="woocommerce-Price-currencySymbol">' + symbol + '</span>&nbsp;' + formatted);
            } else {
                // Fallback: extract leading non-digit characters as the symbol
                var currentText = $priceSpan.text().trim();
                var match = currentText.match(/^[^\d\s]+/);
                var sym = match ? match[0] : '';
                $priceSpan.text(sym + ' ' + formatted);
            }
        }
    });

})(jQuery);


