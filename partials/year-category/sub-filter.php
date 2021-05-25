<?php
use FilmAfricaWP\pages\PastsFestivals;

$subcategory_filter = isset($_GET['subcategory-filter']) ? $_GET['subcategory-filter'] : '';
$sub_categories = PastsFestivals::get_instance()->get_sub_taxonomy($terms->slug, $filter_by, 'whats_on_category');
$get_filter = $filter_by == 'post' ? 'News' : $filter_by;

if(!empty($sub_categories)) {
?>
<div class="subcategory" id="filters-input">
    <input
        class="hidden filter"
        type="radio"
        name="subcategory-filter"
        id="all-films"
        value=""
        <?= $subcategory_filter == '' ? 'checked' : '' ?>
        checked
    >
    <label
        class="cursor-pointer text-sm font-semibold filter-option"
        for="all-films"
    ><?= __('All '.ucfirst($get_filter), 'film-africa-wp') ?></label
    >
    <?php

    foreach ($sub_categories as $sub_category) {
    ?>
    <input
        class="hidden filter"
        type="radio"
        name="subcategory-filter"
        id="<?= $sub_category['slug'] ?>"
        value="<?= $sub_category['slug'] ?>"
        <?= $subcategory_filter == $sub_category['slug'] ? 'checked' : '' ?>
    >
    <label
        class="cursor-pointer text-sm font-semibold filter-option"
        for="<?= $sub_category['slug'] ?>"
    ><?= $sub_category['title'] ?></label>
    <?php  } ?>
</div>
<?php } ?>