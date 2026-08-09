jQuery(function ($) {

    $('#load-more-products').on('click', function () {

        let button = $(this);

        let currentPage = parseInt(button.attr('data-page')) || 1;
        let page = currentPage + 1;

        $.ajax({

            url: ajax_object.ajax_url,

            type: 'POST',

            dataType: 'json',

            data: {
                action: 'load_more_products',
                page: page
            },

            beforeSend: function () {

                button.prop('disabled', true).find('.text').text('Loading...');

            },

            success: function (response) {

                button.prop('disabled', false);

                if (response.success && response.data.html.trim() !== '') {

                    $('#product-list').append(response.data.html);

                    button.attr('data-page', page);

                    button.find('.text').text('Load more');

                    // Hide the button when we have reached the last page
                    if (page >= response.data.max_pages) {
                        button.closest('.tf-pagination-wrap').hide();
                    }

                } else {

                    // No products returned — hide the button
                    button.closest('.tf-pagination-wrap').hide();

                }

            }

        });

    });

});