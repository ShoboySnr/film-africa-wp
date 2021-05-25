<?php
use FilmAfricaWP\classes\Utilities;


$filter_by = isset($_GET['filter-by']) ? $_GET['filter-by'] : '';
$sub_category = isset($_GET['subcategory-filter']) ? $_GET['subcategory-filter'] : '';

$year_cat = Utilities::get_instance()->get_terms_of_posts('partners_year_category');
$partners_cat = Utilities::get_instance()->get_terms_of_posts('partner_category');

$partners_img = FILM_AFRICA_ASSETS_IMAGES_DIR . '/partners.svg';

$get_partners = \FilmAfricaWP\pages\Partners::get_instance()->get_partners($filter_by, $sub_category);
?>
<section class="custom-container pb-20">
    <p class="text-lg pt-12">
        <?= strip_tags(get_the_content()); ?>
    </p>

    <div class="w-full flex items-baseline pt-20">
        <span class="font-medium text-lg mr-auto flex-shrink-0">
            <?= __('Filter by year', 'film-africa-wp') ?>
        </span>

        <div class="subcategory" id="filters-input">
            <input class="hidden filter" type="radio" name="subcategory-filter" value="" id="all-partners"
                <?=$sub_category == '' ? 'checked' : ''?>>
            <label class="cursor-pointer text-sm font-semibold filter-option" for="all-partners">
                <?=__('All Partners', 'film-africa-wp')?>
            </label>
            <?php foreach ($partners_cat as $key => $partner): ?>
                <input class="hidden filter" type="radio" name="subcategory-filter" value="<?=$partner['slug']?>"
                       id="<?=$partner['slug']?>" <?= $sub_category == $partner['slug'] ? 'checked' : ''?>>
                <label class="cursor-pointer text-sm font-semibold filter-option"
                       for="<?= $partner['slug'];?>"><?= ucfirst($partner['slug']); ?></label>
            <?php endforeach;?>
        </div>
    </div>
    <div class="flex flex-wrap lg:flex-nowrap items-start lg:gap-40 pt-20" id="filters-input">
        <div class="pt-2 gap-2 lg:gap-0 inline-flex flex-shrink-0 lg:flex-col filter-tabs mr-auto">
            <?php foreach ($year_cat as $key => $value) { ?>
                <input class="hidden filter-tab" type="radio" name="filter-by" id="<?= $value['slug']; ?>"
                       value="<?= $value['slug']; ?>" <?= $value['slug'] == $filter_by ? 'checked' : '' ?> >
                <label for="<?= $value['slug']; ?>"><?= $value['title']; ?></label>
            <?php }?>

        </div>
        <div class="pt-2">
            <!-- partners logo expected here -->
            <picture><img src="<?= $partners_img; ?>" alt=""></picture>
        </div>
    </div>


</section>
