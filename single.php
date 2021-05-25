<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Film_Africa_Theme
 */

get_header();
?>

	<main>

		<?php

        the_post();

        get_template_part( 'template-parts/single/content-single', get_post_type() );
		?>

	</main><!-- #main -->

<?php
get_footer();
