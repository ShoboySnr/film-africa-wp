<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Film_Africa_Theme
 */

get_header();
?>

	<main class="bg-gray-1">
		<?php
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/content', 'page' );

		endwhile; // End of the loop.

        //load additional sections for pages
        load_additional_page_section();

		?>

	</main><!-- #main -->

<?php
get_footer();
