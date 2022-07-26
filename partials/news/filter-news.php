<?php

$categories = \FilmAfricaWP\classes\Utilities::get_instance()->get_terms_of_posts();
$get_festival_year = $_GET['festival-year'] ?? '';
$get_category = $_GET['categories'] ?? '';
$festival_years = \FilmAfricaWP\classes\Utilities::get_instance()->get_terms_of_posts('year_category');

?>
<div class="flex gap-2.5" id="filters">
  <span class="flex items-center px-4 py-2.5 bg-gray-1 cursor-pointer">
    <select name="categories" id="categories" class="appearance-none bg-gray-1 text-black font-semibold ">
      <option value="">
        <?= __('All categories', 'film-africa-wp') ?>
      </option>
        <?php
        foreach($categories as $category) {
        ?>
        <option value="<?= $category['slug'] ?>" <?= $get_category == $category['slug'] ? 'selected' : '' ?>><?= $category['title'] ?></option>
        <?php } ?>
    </select>
    <img src="<?= FILM_AFRICA_ASSETS_ICONS_DIR.'/chevron-down.svg' ?>" alt="" class="ml-3" >
  </span>
  <span class="flex items-center px-4 py-2.5 bg-gray-1 cursor-pointer">
    <select name="festival-year" id="festival-year" class="appearance-none bg-gray-1 text-black font-semibold ">
      <option value="">
        <?= __('Festival Year', 'film-africa-wp') ?>
      </option>
     <?php
     foreach($festival_years as $festival_year) {
         ?>
         <option value="<?= $festival_year['slug'] ?>" <?= $get_festival_year == $festival_year['slug'] ? 'selected' : '' ?>><?= $festival_year['title'] ?></option>
     <?php } ?>
    </select>
    <img src="<?= FILM_AFRICA_ASSETS_ICONS_DIR.'/chevron-down.svg' ?>" alt="" class="ml-3" >
  </span>
</div>