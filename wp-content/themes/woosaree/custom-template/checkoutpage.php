<?php
/*
Template Name: Checkout Page
*/

get_header();
?>

<!-- page-title -->
<div class="tf-page-title tf-page-title--cart">
    <div class="container-full">
        <h1 class="heading text-center"><?php echo get_the_title() ? esc_html( get_the_title() ) : esc_html__( 'Checkout', 'woosaree' ); ?></h1>
    </div>
</div>
<!-- /page-title -->

<section class="flat-spacing-11 tf-page-checkout-section">
    <div class="container">
        <?php
        while ( have_posts() ) :
            the_post();
            the_content();
        endwhile;
        ?>
    </div>
</section>

<?php get_footer();
