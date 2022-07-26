<?php
use FilmAfricaWP\classes\Utilities;

$see_more = isset($_GET['see-more']) ? $_GET['see-more'] : 1;
$results_posts = Utilities::get_instance()->get_year_category_posts($terms->slug, $terms->taxonomy, $filter_by, 'whats_on_category', $subcategory_filter, $see_more);
$max_number_pages = $results_posts['max_num_pages'];
$count = $results_posts['count'];
?>
<section class="custom-container mt-20">
    <div class="grid lg:grid-cols-3 gap-2 mt-8">
        <?php
        foreach ($results_posts['data'] as $new) {
            include FILM_AFRICA_PARTIAL_VIEWS.'/whats-on/_content.php';
        }
        ?>
    </div>
    <?php include FILM_AFRICA_PARTIAL_VIEWS.'/pagination.php'; ?>
</section>
