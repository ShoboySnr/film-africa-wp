<?php
$release_type = isset($_GET['subcategory-filter']) ? $_GET['subcategory-filter'] : 'releases';

?>
<div class="w-full flex items-baseline pt-20">
          <span class="font-medium text-lg mr-auto flex-shrink-0">
            <?= __('Filter by year', 'film-africa-wp') ?>
          </span>

    <div class="subcategory" id="filters-input">
        <input
            class="hidden filter"
            type="radio"
            name="subcategory-filter"
            id="releases"
            value="releases"
            <?= $release_type == 'releases' ? 'checked' : '' ?>
        >
        <label
            class="cursor-pointer text-sm font-semibold filter-option"
            for="releases"
        ><?= __('Releases', 'film-africa-wp') ?></label
        >

        <input
            class="hidden filter"
            type="radio"
            name="subcategory-filter"
            id="coverage"
            value="coverage"
            <?= $release_type == 'coverage' ? 'checked' : '' ?>
        >
        <label class="cursor-pointer text-sm font-semibold filter-option" for="coverage">
            <?= __('Coverage', 'film-africa-wp') ?>
        </label>
    </div>
</div>
