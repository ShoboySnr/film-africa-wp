<?php

$left_arrow = FILM_AFRICA_ASSETS_ICONS_DIR.'/left-arrow.svg';

?>
<div class="bg-grey pt-12 pb-6 px-5 h-60 bg-gray-1 relative">
    <img
        class="object-cover"
        src="<?= $ticket['image'] ?>"
        alt="<?= $ticket['title'] ?>"
        title="<?= $ticket['title'] ?>"
    >
    <p class="text-2xl font-black pt-5 leading-7.5 overflow-y-hidden">
       <?= $ticket['title'] ?>
    </p>
    <div class="mt-9 flex justify-between">
        <span class="font-medium text-base"><?= __('Book Now', 'film-africa-wp') ?> </span>
        <a href="<?= $ticket['link'] ?>" class="arrow-btn">
            <?= file_get_contents(FILM_AFRICA_ASSETS_ICONS_DIR.'/left-arrow.svg'); ?>
        </a>
    </div>
    <hr class="border-black absolute -bottom-1.5 w-full left-0" >
</div>