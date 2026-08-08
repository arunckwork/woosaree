<?php
/*
Template Name: Cart Page
*/

get_header();
?>

<!-- page-title -->
<div class="tf-page-title">
    <div class="container-full">
        <h1 class="heading text-center"><?php echo get_the_title() ? esc_html( get_the_title() ) : esc_html__( 'Shopping Cart', 'woosaree' ); ?></h1>
    </div>
</div>
<!-- /page-title -->

<?php
while ( have_posts() ) :
    the_post();
    the_content();
endwhile;

get_footer();
