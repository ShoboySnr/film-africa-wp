<?php
use FilmAfricaWP\classes\Taxonomy;

$filter_by = $_GET['filter-by'] ?? '';

$term_id = get_queried_object()->term_id;
$taxonomy = get_queried_object()->taxonomy;
$terms = get_term_by('id', $term_id, $taxonomy);
$has_overview = get_field('has_overview', $terms);

include_once FILM_AFRICA_PARTIAL_VIEWS.'/taxonomy/filter.php';

if($has_overview && empty($filter_by)) {
    include_once FILM_AFRICA_PARTIAL_VIEWS.'/taxonomy/overview.php';
} else {
    //check if the filter is empty
    $check_news = Taxonomy::get_instance()->check_if_taxonomy_exists($terms->slug, $taxonomy);
    $check_events = Taxonomy::get_instance()->check_if_taxonomy_exists($terms->slug, $taxonomy, 'events');
    $check_films = Taxonomy::get_instance()->check_if_taxonomy_exists($terms->slug, $taxonomy, 'films');
    if(empty($filter_by)) {
        if($check_films) {
            $filter_by = 'films';
        } elseif($check_events) {
            $filter_by = 'events';
        } elseif($check_news) {
            $filter_by = 'news';
        }
    }

    if($filter_by == 'films') {
        include FILM_AFRICA_PARTIAL_VIEWS.'/taxonomy/films.php';
    }

    if($filter_by == 'events') {
        include FILM_AFRICA_PARTIAL_VIEWS.'/taxonomy/films.php';
    }

    if($filter_by == 'news') {
        $filter_by = 'post';
        include FILM_AFRICA_PARTIAL_VIEWS.'/taxonomy/news.php';
    }
}