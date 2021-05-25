<?php
$filter_by = isset($_GET['filter-by']) ? $_GET['filter-by'] : '';

?>
<section id="filters" class="filters custom-container">
    <div class="relative category" id="filters-input">
        <input
            class="hidden filter"
            type="radio"
            name="filter-by"
            id="all"
            value=""
            <?= $filter_by == '' ? 'checked' : '' ?>
        >

        <label
                class="filter-option  category-item"
                for="all"
        >
            <?=  __('All', 'film-africa-wp') ?>
        </label>

        <input
            class="hidden filter"
            type="radio"
            name="filter-by"
            id="films"
            value="films"
            <?= $filter_by == 'films' ? 'checked' : '' ?>
        >

        <label
            class="filter-option  category-item"
            for="films"
        >
            <?=  __('Films', 'film-africa-wp') ?>
        </label>
        <input
            class="hidden filter"
            type="radio"
            name="filter-by"
            id="events"
            value="events"
            <?= $filter_by == 'events' ? 'checked' : '' ?>
        >
        <label
            class="filter-option  category-item"
            for="events"
        >
            <?= __('Events', 'film-africa-wp') ?>
        </label>
        <input
            class="hidden filter"
            type="radio"
            name="filter-by"
            id="news"
            value="post"
            <?= $filter_by == 'post' ? 'checked' : '' ?>
        >
        <label
            class="filter-option  category-item"
            for="news"
        >
            <?= __('News', 'film-africa-wp') ?>
        </label>

        <input
            class="hidden filter"
            type="radio"
            name="filter-by"
            id="press"
            value="press"
            <?= $filter_by == 'press' ? 'checked' : '' ?>
        >
        <label
            class="filter-option  category-item"
            for="press"
        >
           <?= __('Press', 'film-africa-wp') ?>
        </label>

        <input
            class="hidden filter"
            type="radio"
            name="filter-by"
            id="pages"
            value="page"
            <?= $filter_by == 'page' ? 'checked' : '' ?>
        >
        <label
            class="filter-option  category-item"
            for="pages"
        >
           <?= __('Pages', 'film-africa-wp') ?>
        </label>
    </div>
</section>