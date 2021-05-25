<?php
use FilmAfricaWP\pages\Press;

$filter_by = $_GET['filter-by'] ?? '';
$release_type = $_GET['subcategory-filter'] ?? '';
$press_releases = Press::get_instance()->get_press_release($filter_by, $release_type);

$page_title = get_field('page_title');
$access_toolkits_button = get_field('access_toolkits_button');

$carbon_pdf = FILM_AFRICA_ASSETS_ICONS_DIR.'/carbon_pdf.svg';

include_once(FILM_AFRICA_PARTIAL_VIEWS.'/press/content.php');
?>

<section class="custom-container">
    <?php include_once FILM_AFRICA_PARTIAL_VIEWS.'/press/top-filter.php'; ?>
    <div class="flex flex-wrap lg:flex-nowrap items-start justify-between pt-20">
        <?php include_once FILM_AFRICA_PARTIAL_VIEWS.'/press/side-filter.php'; ?>
        <div class="release-container">
            <?php
            foreach($press_releases as $press_release) {
                ?>
                    <div class="release" href="<?= $press_release['link']['url'] ?>" target="<?= $press_release['link']['target'] ?>" title="<?= $press_release['link']['title'] ?>">
                        <img
                                class="h-16 w-20"
                                src="<?= $carbon_pdf ?>"
                                alt="<?= __('pdf', 'film-africa-wp') ?>"
                        >
                        <p class="text-base pt-5 pb-1">
                            <?= $press_release['details'] ?>
                        </p>
                        <div class="pt-16 font-bold mt-auto"><?= $press_release['date'] ?></div>
                    </div>
            <?php } ?>
        </div>
    </div>
</section>



