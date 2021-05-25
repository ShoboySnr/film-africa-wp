<?php
use FilmAfricaWP\classes\Utilities;

$categories = Utilities::get_instance()->get_post_taxonomy($post->ID, 'whats_on_category');
?>
<figure class="press">
    <div class="w-full">
        <img
            class="press-img"
            src="<?= get_the_post_thumbnail_url() ?>"
            alt="<?= get_the_title() ?>"
        >
    </div>
    <figcaption class="h-full absolute top-0 left-7 mt-7 w-3/5 2xl:w-2/5 flex flex-col">
        <p>
            <span class="inline-block bg-white p-4 text-lg font-bold">
                <?= ucfirst(get_field('press_release_format')) ?>
            </span>
        </p>
        <p class="text-4xl font-medium pt-12 leading-tight text-white">
           <?= get_the_title() ?>
        </p>
        <p class="pb-12 mt-auto font-bold text-white"><?= date('j M Y', strtotime(get_field('press_date'))) ?></p>
    </figcaption>
</figure>
