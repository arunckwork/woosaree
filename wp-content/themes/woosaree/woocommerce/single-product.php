<?php
/**
 * The Template for displaying all single products
 *
 * @package woosaree
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' );
?>

<main id="primary" class="site-main">

<?php while ( have_posts() ) : ?>
	<?php the_post(); ?>

	<?php wc_get_template_part( 'content', 'single-product' ); ?>

<?php endwhile; // end of the loop. ?>

</main>

<?php
get_footer( 'shop' );
/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
