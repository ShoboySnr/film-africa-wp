<?php
$filter_by = $_GET['filter-by'] ?? '';

$term_id = get_queried_object()->term_id;
$taxonomy = get_queried_object()->taxonomy;
$terms = get_term_by('id', $term_id, $taxonomy);

$has_overview = get_field('has_overview', $terms);
var_dump($has_overview);
?>
<div id="filters" class="filters custom-container">
    <div class="relative category" id="filters-input">
        <input class="hidden filter" type="radio" name="filter-by" id="overview" <?= $filter_by == '' ? 'checked': '' ?>>
        <label class="filter-option  category-item" for="overview">
            <?= __('Overview', 'film-africa-wp') ?>
        </label>

        <input class="hidden filter" type="radio" name="filter-by" id="films" value="films" <?= $filter_by == 'films' ? 'checked': '' ?>>
        <label class="filter-option  category-item" for="films">
           <?= __('Films', 'film-africa-wp') ?>
        </label>
        <input class="hidden filter" type="radio" name="filter-by" id="events" value="events" <?= $filter_by == 'events' ? 'checked': '' ?>>
        <label class="filter-option  category-item" for="events">
            <?= __('Events', 'film-africa-wp') ?>
        </label>
        <input class="hidden filter" type="radio" name="filter-by" id="news" value="news" <?= $filter_by == 'news' ? 'checked': '' ?>>
        <label class="filter-option  category-item" for="news">
            <?= __('News', 'film-africa-wp') ?>
        </label>
    </div>
</div>