(function ($) {
    "use strict";

    $(document).ready(function () {
        // Quantity Increase / Decrease handler
        $(document).on('click', '.btn-decrease, .btn-increase', function (e) {
            e.preventDefault();
            var $button = $(this);
            var $input = $button.closest('.wg-quantity').find('.quantity-product, input[name="quantity"]');
            var oldValue = parseFloat($input.val()) || 1;
            var newVal = oldValue;

            if ($button.hasClass('btn-increase')) {
                newVal = oldValue + 1;
            } else {
                if (oldValue > 1) {
                    newVal = oldValue - 1;
                } else {
                    newVal = 1;
                }
            }

            $input.val(newVal).trigger('change');

            // Sync hidden WooCommerce quantity input if separate
            $('form.cart input[name="quantity"]').val(newVal);
        });
    });

})(jQuery);
