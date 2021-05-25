<?php
use FilmAfricaWP\classes\Utilities;

$left_arrow = FILM_AFRICA_ASSETS_ICONS_DIR.'/left-arrow.svg';
$categories = Utilities::get_instance()->get_post_taxonomy($post->ID, 'whats_on_category');

?>
<figure class="custom-grid overflow-hidden">
    <div class="relative h-full w-full">
        <img
            class="h-full w-full object-cover object-center"
            src="<?= get_the_post_thumbnail_url() ?>"
            alt="<?= get_the_title() ?>"
            height="282"
            width="390"
        >
        <span class="bg-yellow post-tag"><?= __('Films', 'film-africa-wp') ?> </span>
    </div>

    <figcaption
        class="post-caption"
    >
        <div class="post-content">
            <p class="post-venue">
                <?php
                    if(isset($categories[0]['title'])) {
                ?>
                <span class="text-gray-4"><?= $categories[0]['title'] ?></span>
                <?php } ?>
                <span class="font-black"><?= get_field('location') ?></span>
            </p>
            <a href="<?= get_permalink()?>" title="<?= get_the_title() ?>" class="post-title">
                <?= get_the_title() ?>
            </a>
            <p class="post-details ">
                <time><?= custom_date_format(get_field('start_date'), get_field('end_date')); ?></time>
                <a
                    href="<?= get_permalink() ?>"
                    class="arrow-btn" title="See Film"
                >
                    <?= file_get_contents($left_arrow) ?>
                </a>
            </p>
        </div>
    </figcaption>
</figure>