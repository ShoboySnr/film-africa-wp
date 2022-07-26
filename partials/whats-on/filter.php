<?php

use FilmAfricaWP\classes\Utilities;

$cheveron_down = FILM_AFRICA_ASSETS_ICONS_DIR.'/chevron-down.svg';
$filter_by = $_GET['filter-by'] ?? '';
$get_festival_year = $_GET['festival-year'] ?? '';
$get_location = $_GET['location'] ?? '';

$festival_years = Utilities::get_instance()->get_terms_of_posts('year_category');
$locations = Utilities::get_instance()->get_terms_of_posts('location_category');
$add_only_filterby_link = remove_query_arg(['festival-year', 'subcategory-filter', 'location', 'goto', 'date']);

?>

<section class="filters custom-container flex flex-col lg:flex-row items-center">
    <div class="subcategory" id="filters-input" data-reset-link="<?= $add_only_filterby_link ?>">
        <input
            class="hidden filter"
            type="radio"
            name="subcategory-filter"
            id="all-films"
            value=""
            <?= $sub_category == '' ? 'checked' : '' ?>
        >
        <label
            class="cursor-pointer text-sm font-semibold filter-option"
            for="all-films"
        ><?= __('All '.ucfirst($filter_by), 'film-africa-wp') ?></label>

        <?php
            foreach($get_sub_categories as $key =>  $get_sub_category) {
        ?>
        <input
            class="hidden filter"
            type="radio"
            name="subcategory-filter"
            id="<?= $get_sub_category['slug'] ?>"
            value="<?= $get_sub_category['slug'] ?>"
            <?= $sub_category == $get_sub_category['slug'] ? 'checked' : '' ?>
        >
        <label
            class="text-sm font-semibold filter-option"
            for="<?= $get_sub_category['slug'] ?>"
        ><?= $get_sub_category['title'] ?></label
        >
        <?php } ?>
    </div>
    <div class="pt-12 lg:pt-0 lg:ml-auto flex gap-2.5" id="filters">
          <span class="flex items-center px-4 py-2.5 bg-gray-1 cursor-pointer">

            <select name="festival-year" id="festival-year" class="appearance-none bg-gray-1 text-black font-semibold ">
              <option value="">
                <?= __('Festival Year', 'film-africa-wp') ?>
              </option>
                <?php
                foreach ($festival_years as $festival_year) {
                ?>
                <option value="<?= $festival_year['slug'] ?>" <?= $get_festival_year == $festival_year['slug'] ? 'selected' : '' ?>><?= $festival_year['title'] ?></option>
                <?php } ?>
            </select>
            <img src="<?= $cheveron_down; ?>" alt="" class="ml-3" >
          </span>
        <span class="flex items-center px-4 py-2.5 bg-gray-1 cursor-pointer">

            <select name="location" id="location" class="appearance-none bg-gray-1 text-black font-semibold ">
              <option value="">
                <?= __('Location', 'film-africa-wp') ?>
              </option>
             <?php
             foreach ($locations as $location) {
                 ?>
                 <option value="<?= $location['slug'] ?>" <?= $get_location == $location['slug'] ? 'selected' : '' ?>><?= $location['title'] ?></option>
             <?php } ?>
            </select>
            <img src="<?= $cheveron_down; ?>" alt="" class="ml-3" >
          </span>
    </div>
</section>
