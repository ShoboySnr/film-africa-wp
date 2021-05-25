<?php
use FilmAfricaWP\classes\Utilities;

$left_arrow = FILM_AFRICA_ASSETS_ICONS_DIR.'/left-arrow.svg';
$categories = Utilities::get_instance()->get_post_taxonomy($post->ID, 'category');
?>
<figure class="custom-grid overflow-hidden">
    <div class="w-full h-full">
        <img
            class="h-full max-h-96 w-full object-cover object-center"
            src="<?= get_the_post_thumbnail_url() ?>"
            alt="<?= get_the_title() ?>"
            height="282"
            width="390"
        >
    </div>
    <figcaption
        class="border-b border-black-2 break-words mx-6 2xl:max-w-md relative justify-self-center bottom-16"
    >
        <div class="post-content">
            <?php
                if(isset($categories[0]['title'])) {
            ?>
            <p class="post-venue">
                <span class="inline-block bg-black text-white px-3 py-2 text-xs"
                ><?= $categories[0]['title'] ?></span
                >
            </p>
            <?php } ?>
            <a href="<?= get_permalink(); ?>" title="<?= get_the_title() ?>" class="post-title">
                <?= get_the_title() ?>
            </a>
            <p class="post-details  text-gray-4">
                <a href="<?= get_permalink() ?>" title="Read more" class="underline hover:text-red"><?= __('Read more', 'film-africa-wp') ?></a>
            </p>
        </div>
    </figcaption>
</figure>
