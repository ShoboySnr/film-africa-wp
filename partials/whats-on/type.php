<?php
$remove_query_link = remove_query_arg(['filter-by', 'festival-year', 'subcategory-filter', 'location', 'goto', 'date']);

?>
<div class="custom-container relative">
    <section class="w-full filters flex flex-col lg:flex-row items-start lg:items-center overflow-x-auto mb-6">
    <div class="category" id="filters-input">
        <input class="hidden filter" type="radio" name="filter-by" id="all" value=""
        <?= $filter_by == '' ? 'checked': '' ?>>
        <label
            class="filter-option  category-item"
            for="all"
        ><?= __('All', 'film-africa-wp') ?></label
        >

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
        ><?= __('Films', 'film-africa-wp'); ?></label
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
        <button name="filter-by" type="button" class="focus:outline-none appearance-none filter-option category-item calendar outline-none <?= $filter_by == 'calender' ? 'text-black': '' ?>"><?= __('Calendar', 'film-africa-wp') ?></button>
    </div>
    <button type="button" id="clear-filter" class="pb-12 lg:pb-0 lg:ml-auto text-black" onclick="document.location.href='<?= $remove_query_link ?>'">
        <span class="text-2xl mr-2.5">&times;</span>
        <span class="underline text-lg"><?= __('Clear Filter', 'film-africa-wp') ?> </span>
    </button>
</section>
    <div class="cal-container">
        <div id="v-cal" class="cal hidden">
            <?php include FILM_AFRICA_PARTIAL_VIEWS.'/whats-on/calender.php'; ?>
        </div>
        <div class="cal-overlay hidden fixed bottom-0 top-0 left-0 right-0"></div>
    </div>
</div>