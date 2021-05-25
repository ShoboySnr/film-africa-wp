<?php
use FilmAfricaWP\pages\Home;


$home_data = Home::get_instance()->get_home_fields();
$hero_sliders = $home_data['hero_sliders'];
$banner_link = get_field('banner_link');
$page_title = get_field('page_title');

?>
<!-- Hero -->
<div class="h-screen custom-container" id="slideshow">
    <?php
    $count = 0;
    foreach($hero_sliders as $hero_slider) {
    ?>
    <input class="hidden-slide-btn" type="radio" name="currentSlide" id="slide-<?= ++$count; ?>-btn" <?= $count == 1 ? 'checked' : '' ?>>
    <label for="slide-<?= $count; ?>-btn" class="slide-btn z-10 top-4/5"> </label>
    <?php } ?>
    <section class="slide-wrapper -z-99 mx-auto h-full w-full">
        <?php
        $count = 0;
        foreach($hero_sliders as $hero_slider) {
        ?>
        <picture class="h-full w-full absolute top-0 left-0 slide-<?= ++$count ?>">
            <img class="h-full w-full object-cover"
                 src="<?= $hero_slider['url'] ?>"
                 alt="<?= $hero_slider['alt'] ?>"
                 title="<?= $hero_slider['title'] ?>"
                 sizes="<?= $hero_slider['sizes']['large'] ?>"
            >
        </picture>
        <?php } ?>
    </section>
</div>
<div class="custom-container flex justify-end">
    <div class="home-banner">
        <?php
        if(!empty($page_title)) {
        ?>
        <div class="polygon-banner banner">
            <h1 class="banner-text">
                <?= $page_title ?>
            </h1>
        </div>
        <?php
        }

        if(isset($banner_link['url']) && $banner_link['url'] != '') { ?>
            <a href="<?= $banner_link['url'] ?>" class="cursor-pointer bg-white font-black text-2xl mt-10 px-6 py-2 inline-block hover:text-red"><?= $banner_link['title'] ?></a>
        <?php } ?>
    </div>
</div>