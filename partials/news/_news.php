<?php
//var_dump($new);
?>
<figure class="custom-grid grid-rows-1">
    <div class="w-full max-h-96 overflow-hidden">
        <img
            class="h-full w-full object-cover object-center"
            src="<?= $new['image'] ?>"
            alt="<?= $new['title'] ?>"
            title="<?= $new['title'] ?>"
        >
    </div>
    <figcaption
        class="post-caption"
    >
        <div class="bg-white p-4 xl:p-6 w-full">
            <?php
                if(isset($new['category']['title'])) {
            ?>
            <p class="post-venue">
                <a href="<?= get_term_link($new['category']['id']) ?>" title="<?= $new['category']['title'] ?>">
                    <span class="inline-block bg-black text-white px-3 py-2 text-xs hover:bg-transparent hover:text-red"
                    ><?= $new['category']['title']  ?></span
                    >
                </a>
            </p>
            <?php } ?>
            <a href="<?= $new['link'] ?>" class="post-title">
               <?= $new['title'] ?>
            </a>
            <p class="post-details  text-gray-4">
                <a href="<?= $new['link'] ?>" class="underline hover:text-red"><?= __('Read more', 'film-africa-wp') ?></a>
            </p>
        </div>
    </figcaption>
</figure>