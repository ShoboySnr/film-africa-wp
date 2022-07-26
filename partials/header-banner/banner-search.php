<?php
global $posts;
$post = get_page_by_title('Search', OBJECT, 'page');
?>
<section>
    <picture class="img-banner filter-dim">
        <img class="h-full w-full object-cover object-top" src="<?= get_the_post_thumbnail_url($post->ID) ?>"  alt=""
        >
    </picture>
    <div class="custom-container flex justify-end">
        <div class="flex-trapezium-banner banner top-48 sm:top-64">
            <h1 class="banner-text"><?= $post->post_title ?></h1>
        </div>
    </div>
</section>
