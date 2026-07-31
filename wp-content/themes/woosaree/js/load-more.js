jQuery(function ($) {
    

    $('#load-more-products').on('click', function () {

        let button = $(this);

       let currentPage = parseInt(button.attr('data-page')) || 1;
let page = currentPage + 1;

        $.ajax({

            url: ajax_object.ajax_url,

            type: 'POST',

            data: {
                action: 'load_more_products',
                page: page
            },

            beforeSend: function () {

                button.text('Loading...');

            },

            success: function (response) {

                if (response.trim() !== '') {

                    $('#product-list').append(response);

                    button.attr('data-page', page);

                    button.text('Load More');
                    if (response.current_page >= response.max_pages) {
    button.hide();
}

                } else {

                    button.hide();

                }

            }

        });

    });

});