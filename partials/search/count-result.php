<?php

global $posts;

$allowed_post_types = ['posts', 'films', 'events', 'page', 'press'];
$filter_by = isset($_GET['filter-by']) && $_GET['filter-by'] != '' ? $_GET['filter-by'] : $allowed_post_types;
$args = [
        'post_type'    => $filter_by,
        's'             => $s,
        'showposts'     => 0
];

$allsearch = new WP_Query($args);
?>
<section class="custom-container pt-14">
    <p class="border-b pb-9 font-normal">
        <span class="font-semibold"><?= $allsearch->found_posts ?></span>
        <?= sprintf( esc_html__( 'search results found for %s', 'film-africa-wp' ),
            '<span class="font-semibold">'. get_search_query() .'</span>') ?>
    </p>
</section>