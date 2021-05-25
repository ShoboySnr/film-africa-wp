<!--
Template Name: Tickets Template
-->
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

<main>
    <section class="bg-white py-16 custom-container pb-36">
    <?php
    while ( have_posts() ) :
        the_post();
        get_template_part( 'template-parts/content', 'tickets' );

    endwhile; // End of the loop.

    wp_reset_postdata();

    include_once FILM_AFRICA_PARTIAL_VIEWS.'/tickets/content.php';

    ?>
    </section>
</main><!-- #main -->

<?php
get_footer();
