<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Film_Africa_Theme
 */
use FilmAfricaWP\pages\News;


$sticky = get_option('sticky_posts');
$paged = $_GET['see-more'] ?? get_option('posts_per_page');
$category = $_GET['categories'] ?? '' ;
$festival_year = $_GET['festival-year'] ?? '' ;

include_once FILM_AFRICA_PARTIAL_VIEWS . '/news/featured-news.php';

global $posts;
$posts = News::get_instance()->get_news($paged, $sticky, $category, $festival_year);
$max_number_pages = $posts['max_num_pages'];

$api_link = esc_html(FILM_AFRICA_API_BASE."/news/pages?categories=$category&festival_year=$festival_year");


?>
<section class="custom-container mt-20" id="post-<?php the_ID();?>">
    <?php include_once FILM_AFRICA_PARTIAL_VIEWS . '/news/filter-news.php';?>
    <div class="grid lg:grid-cols-3 gap-2 mt-8" id="ajax-contents">
        <?php
            foreach ($posts['data'] as $new) {
                include FILM_AFRICA_PARTIAL_VIEWS . '/news/_news.php';
            }
        ?>
    </div>
    <?php include_once (FILM_AFRICA_PARTIAL_VIEWS.'/pagination.php') ?>
</section>
<?php
wp_reset_postdata();