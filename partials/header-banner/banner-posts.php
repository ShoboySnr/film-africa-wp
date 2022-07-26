<?php
$news_posts = get_post(get_option( 'page_for_posts' ));

?>
<section>
    <picture class="img-banner">
        <img class="h-full w-full object-cover object-top" src="<?= get_the_post_thumbnail_url($news_posts->ID) ?>"  alt=""
        >
    </picture>
    <div class="trapezium-banner right-10 lg:right-20 banner top-64">
        <h1 class="banner-text"><?= $news_posts->post_title ?></h1>
    </div>
</section>
