<?php
global $posts;
$post = $posts[0];

?>
<!-- Hero -->
<picture class="img-banner">
    <img
        class="h-full w-full object-cover object-top"
        src="<?= get_the_post_thumbnail_url($post->ID) ?>"
        alt=""
    >
</picture>
<div class="custom-container flex justify-end">

    <div class="trapezium-banner banner top-64">
        <h1 class="banner-text"><?= $post->post_title ?></h1>
    </div>
</div>
