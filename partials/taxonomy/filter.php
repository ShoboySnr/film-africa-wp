<?php
use FilmAfricaWP\classes\Taxonomy;


$check_news = Taxonomy::get_instance()->check_if_taxonomy_exists($terms->slug, $taxonomy);
$check_events = Taxonomy::get_instance()->check_if_taxonomy_exists($terms->slug, $taxonomy, 'events');
$check_films = Taxonomy::get_instance()->check_if_taxonomy_exists($terms->slug, $taxonomy, 'films');

?>

<section>
    <div id="filters" class="filters custom-container">
    <div class="relative category" id="filters-input">
        <?php

        if($has_overview) {
        ?>
        <input class="hidden filter" type="radio" name="filter-by" value="" id="overview" <?= $filter_by == '' ? 'checked': '' ?>>
        <label class="filter-option  category-item" for="overview">
            <?= __('Overview', 'film-africa-wp') ?>
        </label>
        <?php
        }

        if($check_films) {
        ?>

        <input class="hidden filter" type="radio" name="filter-by" id="films" value="films" <?= (!$has_overview && $filter_by == '') || $filter_by == 'films' ? 'checked': '' ?>>
        <label class="filter-option  category-item" for="films">
           <?= __('Films', 'film-africa-wp') ?>
        </label>
        <?php
        }

        if($check_events) {
        ?>
        <input class="hidden filter" type="radio" name="filter-by" id="events" value="events" <?= (!$has_overview && $filter_by == '') || $filter_by == 'events' ? 'checked': '' ?>>
        <label class="filter-option  category-item" for="events">
            <?= __('Events', 'film-africa-wp') ?>
        </label>
        <?php
        }

        if($check_news) {
        ?>
        <input class="hidden filter" type="radio" name="filter-by" id="news" value="news" <?= (!$has_overview && $filter_by == '') ||  $filter_by == 'post' || $filter_by == 'news' ? 'checked': '' ?>>
        <label class="filter-option  category-item" for="news">
            <?= __('News', 'film-africa-wp') ?>
        </label>
        <?php } ?>
    </div>
</div>
</section>