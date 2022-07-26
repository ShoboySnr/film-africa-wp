<?php
use FilmAfricaWP\classes\Taxonomy;

$whats_on = Taxonomy::get_instance()->get_all_whatson($terms->slug, $taxonomy, $filter_by);
$max_number_pages = $whats_on['max_num_pages'];
$count_number_pages = $whats_on['count'];
$whats_on = $whats_on['data'];

$api_link = esc_html(FILM_AFRICA_API_BASE."/taxonomy/pages?filter_by=$filter_by&taxonomy_name=$terms->slug&taxonomy=$taxonomy");
?>
<section class="custom-container mt-20">
    <div class="grid lg:grid-cols-3 gap-2 mt-8" id="ajax-contents">
        <?php
            foreach ($whats_on as $new) {
                include FILM_AFRICA_PARTIAL_VIEWS . '/news/_news.php';
            }
        ?>
    </div>
    <?php include_once (FILM_AFRICA_PARTIAL_VIEWS.'/pagination.php') ?>
</section>
