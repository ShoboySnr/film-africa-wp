<?php
use FilmAfricaWP\pages\Press;

$filter_by = $_GET['filter-by'] ?? '';
$release_type = $_GET['subcategory-filter'] ?? '';
$press_releases = Press::get_instance()->get_press_release($filter_by, $release_type);

$page_title = get_field('page_title');
$access_toolkits_button = get_field('access_toolkits_button');

$carbon_pdf = FILM_AFRICA_ASSETS_ICONS_DIR.'/carbon_pdf.svg';

include_once(FILM_AFRICA_PARTIAL_VIEWS.'/press/content.php');

if($release_type != 'coverage') {
?>

<section class="custom-container">
    <?php include_once FILM_AFRICA_PARTIAL_VIEWS.'/press/top-filter.php'; ?>
    <div class="flex flex-wrap lg:flex-nowrap items-start justify-between pt-20">
        <?php include_once FILM_AFRICA_PARTIAL_VIEWS.'/press/side-filter.php'; ?>
        <div class="release-container">
            <?php
            if(!empty($press_releases)) {
            foreach($press_releases as $press_release) {
                ?>
                    <a class="release" href="<?= $press_release['link']['url'] ?>" target="<?= $press_release['link']['target'] ?>" title="<?= $press_release['link']['title'] ?>">
                        <img
                                class="h-16 w-20"
                                src="<?= $carbon_pdf ?>"
                                alt="<?= __('pdf', 'film-africa-wp') ?>"
                        >
                        <p class="text-base pt-5 pb-1">
                            <?= $press_release['details'] ?>
                        </p>
                        <?php
                        if(!empty($press_release['date'])) {
                            ?>
                            <div class="pt-16 font-bold mt-auto"><?= $press_release['date'] ?></div>
                            <?php } ?>
                    </a>
            <?php } }
            else {
                ?>
                    <p class="text-black-2"><?= __('There are no release for this selection', 'film-africa-wp'); ?></p>
            <?php
                }
            ?>
        </div>
    </div>
</section>
<?php

} else {

    ?>
    <section class="custom-container">
        <?php include_once FILM_AFRICA_PARTIAL_VIEWS.'/press/top-filter.php'; ?>
        <div class="flex flex-wrap lg:flex-nowrap items-start lg:gap-40 pt-20">
            <?php include_once FILM_AFRICA_PARTIAL_VIEWS.'/press/side-filter.php'; ?>
            <section class="release-container">
                <?php
                    foreach($press_releases as $press_release) {
                ?>
                <a class="press" href="<?= $press_release['link'] ?>" title="<?= $press_release['title'] ?>" style="overflow-y: hidden">
                    <div class="w-full">
                        <img class="press-img" src="<?= $press_release['image'] ?>" alt="<?= $press_release['slug'] ?>" title="<?= $press_release['title'] ?>">
                    </div>
                    <figcaption class="h-full absolute top-0 left-7 mt-7 w-1/3 lg:w-3/5 2xl:w-1/2 flex flex-col">
                        <?php
                        if(!empty($press_release['format'])) {
                        ?>
                        <p>
                            <span class="inline-block bg-white p-4 text-lg font-bold"><?= $press_release['format'] ?></span>
                        </p>
                         <?php } ?>
                        <p class="text-4xl font-medium pt-12 leading-tight text-white">
                            <?= $press_release['title'] ?>
                        </p>
                        <?php
                        if(!empty($press_release['date'])) {
                            ?>
                        <p class="pb-12 mt-auto font-bold text-white">
                           <?= $press_release['date'] ?>
                        </p>
                            <?php } ?>
                    </figcaption>
                </a>
                 <?php } ?>
            </section>
        </div>
    </section>
<?php
}



