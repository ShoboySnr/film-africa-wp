<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Film_Africa_Theme
 */

get_header();
?>

	<main class="border-t">
        <section class="relative custom-container">
            <div class="error-404 not-found">
                    <header class="page-header">
                        <h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'film-africa-wp' ); ?></h1>
                    </header><!-- .page-header -->

                    <div class="page-content">
                        <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try to search below?', 'film-africa-wp' ); ?></p>

                        <?php
                        get_search_form();
                        ?>
                    </div><!-- .page-content -->
                </div><!-- .error-404 -->
        </section>
	</main><!-- #main -->

<?php
get_footer();
