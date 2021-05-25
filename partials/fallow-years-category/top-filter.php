<?php

$filter_by = isset($_GET['filter-by']) ? $_GET['filter-by'] : 'films'; //films is the default
?>
<div class="category" id="filters-input">
    <input
        class="hidden filter"
        type="radio"
        name="filter-by"
        id="films"
        value="films"
        <?= $filter_by == 'films' ? 'checked': '' ?>
    >
    <label
        class="filter-option  category-item"
        for="films"
    ><?= __('Films', 'film-africa-wp') ?></label
    >
    <input
        class="hidden filter"
        type="radio"
        name="filter-by"
        id="events"
        value="events"
        <?= $filter_by == 'events' ? 'checked': '' ?>
    >
    <label
        class="filter-option  category-item"
        for="events"
    ><?= __('Events', 'film-africa-wp') ?></label
    >
    <input
        class="hidden filter"
        type="radio"
        name="filter-by"
        id="post"
        value="post"
        <?= $filter_by == 'post' ? 'checked': '' ?>
    >
    <label
        class="filter-option  category-item"
        for="post"
    ><?= __('News', 'film-africa-wp') ?></label
    >
</div>
