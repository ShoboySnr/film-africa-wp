<?php

$play = FILM_AFRICA_ASSETS_ICONS_DIR.'/play.svg';
$pause = FILM_AFRICA_ASSETS_ICONS_DIR.'/pause.svg';
$note = FILM_AFRICA_ASSETS_ICONS_DIR.'/note.svg';

$book_now = get_field('event_link');
$trailer = get_field('trailer');
$date = custom_date_format(get_field('start_date'), get_field('end_date'));
?>
<section class="img-banner-2 w-full relative">
    <div class="relative mx-auto h-full w-full z-10">
        <img src="<?= get_the_post_thumbnail_url() ?>" alt="movie-poster" class="trailer h-full w-full object-cover object-bottom absolute top-0 left-0">
        <?php
        if(!empty($trailer)) {
            echo do_shortcode('[wp-video-popup video="https://vimeo.com/463645269", hide-related="1"]')
            ?>
            <button type="button" id="play-btn" class="z-10 absolute top-1.5/5 -ml-10 md:ml-0 left-2.5/5 focus:outline-white wp-video-popup">
                <picture>
                    <img src="<?= $play; ?>" alt="<?= __('play', 'film-africa-wp') ?>" title="<?= __('Play', 'film-africa-wp') ?>" >
                </picture>
            </button>
            <p class="font-black text-white inline text-2xl absolute uppercase w-24 top-1/3 left-1/2 leading-6 watch-trailer">
                <?= __('Watch trailer', 'film-africa-wp') ?>
            </p>
        <?php } ?>
    </div>
    <div class="custom-container flex justify-end">
        <div class="inline-block absolute text-right bottom-16 sm:bottom-24">
            <p class="text-white text-2xl font-bold pb-6">
                <?= $date; ?>
            </p>
            <h1 class="banner-text banner max-w-xl">
                <?= get_the_title() ?>
            </h1>
        </div>
    </div>

    <?php
    if(!empty($book_now)) {
    ?>
    <div class="custom-container flex justify-start">
        <a href="<?= $book_now ?>" class="px-12 py-2.5 bg-yellow items-center font-bold absolute bottom-16 hidden md:flex">
          <span class="mx-2">
            <img src="<?= $note; ?>" alt="note" >
          </span>

            <span><?=  __('Book Now', 'film-africa-wp') ?> </span>
        </a>

    </div>
    <?php } ?>
</section>