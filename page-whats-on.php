<!--
Template Name: What's On Template
-->
<?php
use FilmAfricaWP\pages\WhatsOn;

$sub_category = $_GET['subcategory-filter'] ?? '';
$filter_by = $_GET['filter-by'] ?? '';
$location = $_GET['location'] ?? '';
$see_more = $_GET['see-more'] ?? get_option('posts_per_page');
$current_date = isset($_GET['date']) && $_GET['date'] != '' ? $_GET['date'] : '';

$whats_on = WhatsOn::get_instance()->get_all_whatson($filter_by, $location, $sub_category, $current_date);

//specify which taxonomy to show for the sub filter
$specific_taxonomies = ['Narrative Features', 'Documentaries', 'Doc Shorts', 'Fiction Shorts', 'Film Africa Live', 'Dine and View'];
if($filter_by == 'events') {
    $specific_taxonomies = ['Film Africa Live', 'Dine and View'];
} elseif ($filter_by == 'films') {
    $specific_taxonomies = ['Narrative Features', 'Documentaries', 'Doc Shorts', 'Fiction Shorts'];
}
$get_sub_categories = WhatsOn::get_instance()->get_sub_taxonomy('whats_on_category', $filter_by, $specific_taxonomies);
$max_number_pages = $whats_on['max_num_pages'];
$count_number_pages = $whats_on['count'];
$whats_on = $whats_on['data'];

$api_link = esc_html(FILM_AFRICA_API_BASE."/whats-on/pages?filter_by=$filter_by&location=$location&sub_category=$sub_category&current_date=$current_date");

get_header();
?>
<main class="relative border-t">
    <?php

    //include the theme files
    include_once(FILM_AFRICA_PARTIAL_VIEWS.'/whats-on/type.php');
    include_once(FILM_AFRICA_PARTIAL_VIEWS.'/whats-on/filter.php');
    include_once(FILM_AFRICA_PARTIAL_VIEWS.'/whats-on/content.php');

    ?>

</main>


<?php
get_footer();
