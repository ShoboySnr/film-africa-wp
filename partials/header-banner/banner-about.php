<?php
global $posts;
$post = $posts[0];

?>
<section class="relative">
    <div class="img-banner-2 w-full" id="slideshow">
        <picture class="h-full w-full absolute top-0 left-0">
            <img class="h-full w-full object-cover object-center" src="<?= get_the_post_thumbnail_url($post->ID) ?>" alt="">
        </picture>
    </div>
    <div class="about-banner">
        <div class="banner trapezium-banner sm:trapezium-banner">
            <h1 class="banner-text"><?= $post->post_title ?></h1>
        </div>
    </div>
    <div class="text-white absolute bottom-20 w-full hidden md:flex flex-col justify-center text-center">
        <p class="text-lg font-black"><?= __('Scroll down', 'film-africa-wp') ?></p>
        <picture class="my-4 mx-auto">
            <img src="<?= FILM_AFRICA_ASSETS_ICONS_DIR.'/arrow-down.svg' ?>" alt="arrow-down">
        </picture>
    </div>
</section>
