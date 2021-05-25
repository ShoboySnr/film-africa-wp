<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Film_Africa_Theme
 */
global $posts;
global $wp_query;

$filter_by = isset($_GET['filter-by']) ? $_GET['filter-by'] : '';
$max_number_pages = $wp_query->max_num_pages;
$api_link = esc_html(FILM_AFRICA_API_BASE."/search/pages?filter_by=$filter_by&s=".get_search_query());
$left_arrow = FILM_AFRICA_ASSETS_ICONS_DIR.'/left-arrow.svg';

get_header();
?>

	<main class="pb-72">
        <?= get_search_form(false);
            include_once FILM_AFRICA_PARTIAL_VIEWS.'/search/count-result.php';
            include_once FILM_AFRICA_PARTIAL_VIEWS.'/search/filter-section.php';

            if(empty($filter_by) || $filter_by == 'page') {
            ?>
            <section class="custom-container pb-5 h-auto overflow-y-auto overscroll-y-auto" id="ajax-contents">
                <?php } else {
            ?>
                <section class="custom-container overflow-y-auto overscroll-y-auto grid lg:grid-cols-2 xl:grid-cols-3 gap-2 mt-8" id="ajax-contents">
            <?php
                }

       if ( have_posts() ) : ?>
			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			endwhile;

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		wp_reset_postdata();
		?>
        </section>
                <?php include_once FILM_AFRICA_PARTIAL_VIEWS.'/pagination.php'; ?>

	</main><!-- #main -->

<?php
get_footer();
