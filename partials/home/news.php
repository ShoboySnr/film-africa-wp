<?php

$news = $home_data['news'];

?>
<!-- News -->
<article class="custom-container mt-20 overflow-x-hidden">
    <h2 class="w-full flex justify-between items-end">
        <span class="text-4xl font-black"><?= __('News', 'film-africa-wp') ?> </span>
        <a href="<?= $news['see_more'] ?>" class="see-more-btn" title="<?= __('See more', 'film-africa-wp') ?>">See more</a>
    </h2>
    <div class="relative grid lg:grid-cols-3 grid-rows-1 gap-2 mt-8">
        <?php
            foreach ($news['news'] as $new) {
                include(FILM_AFRICA_PARTIAL_VIEWS.'/news/_news.php');
            }
        ?>
    </div>
</article>