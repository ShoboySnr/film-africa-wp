<?php
global $posts;

$twitter = FILM_AFRICA_ASSETS_ICONS_DIR.'/twitter.svg';
$facebook = FILM_AFRICA_ASSETS_ICONS_DIR.'/facebook.svg';
$mail = FILM_AFRICA_ASSETS_ICONS_DIR.'/mail.svg';

$category = get_the_category();
$subtitle = get_field('blog_subtitle');

$tags = get_the_tags();

//sharing links
$url = get_permalink();
$content = substr(get_the_title(), 0, 100);
$title = get_the_title();
$excerpt = get_the_excerpt();
$category_name = isset($category[0]) ? $category[0]->name : '';
$twitter_link = "https://twitter.com/share?text=$content&url=$url&hashtags=filmafrica,$category_name";
$facebook_link = "https://www.facebook.com/sharer/sharer.php?u=$url&t=$title";
$mail_link = "mailto:?subject=$title&body=$excerpt - $url";

?>
<section class="bg-gray-1">
    <div class="custom-container">
        <picture class="overflow-hidden flex -mx-4 lg:-mx-0">
            <img
                src="<?= get_the_post_thumbnail_url() ?>"
                alt="<?= $posts[0]->post_name ?>"
                class="w-full object-cover object-center flex-shrink-0 previous-winner-hero"
                height="510"
            >
        </picture>

        <div class="lg:flex pt-20 pb-32 text-lg">
            <div class="film-overview">
                <h1 class="font-black text-5xl w-2/3 2xl:w-3/5 pb-10">
                    <?= get_the_title(); ?>
                </h1>
                <?php
                if(!empty($subtitle)) {
                    ?>
                    <p class="font-extrabold text-lg pb-10">
                        <?= $subtitle; ?>
                    </p>
                <?php } ?>
                <div class="text-editor">
                    <?= the_content(); ?>
                </div>
            </div>
            <div class="film-details">
                <?php
                if(!empty($category)) {
                    ?>
                    <span class="inline-block bg-black text-white px-3 py-2 text-xs"
                    ><?= $category[0]->name; ?></span>
                    <?php
                } ?>
                <p class="font-extrabold pt-11">
                    <?= get_the_title(); ?>
                </p>

                <p class="pt-11">
                    <span class="font-semibold"><?= __('Published:', 'film-africa-wp'); ?> </span>

                    <time class="font-bold" datetime="<?= date('j M Y', strtotime($post->post_date)); ?>">
                        <?php the_date('j M Y'); ?>
                    </time>
                </p>
                <div class="pt-10">
                    <small class="uppercase tracking-widest"><?= __('share', 'film-africa-wp') ?></small>
                    <ol class="flex gap-5 items-center pt-6">
                        <li>
                            <a href="<?= $twitter_link ?>" target="_blank" title="<?= __('Share this on twitter', 'film-africa-wp') ?>">
                                <img src="<?= $twitter ?>" alt="<?= __('twitter', 'film-africa-wp') ?>" >
                            </a>
                        </li>
                        <li>
                            <a href="<?= $facebook_link ?>" target="_blank" title="<?= __('Share this on facebook', 'film-africa-wp') ?>">
                                <img src="<?= $facebook; ?>" alt="<?= __('facebook', 'film-africa-wp') ?>" >
                            </a>
                        </li>

                        <li>
                            <a href="<?= $mail_link ?>" title="<?= __('Send as email', 'film-africa-wp') ?>">
                                <img src="<?= $mail; ?>" alt="<?= __('mail', 'film-africa-wp') ?>" >
                            </a>
                        </li>
                    </ol>
                </div>
                <?php

                if($tags && !empty($tags))
                {
                    ?>
                    <div class="flex flex-wrap gap-3 pt-10">
                        <?php
                        foreach($tags as $tag) {
                            ?>
                            <span class="border border-black-2 p-2"><?= $tag->name; ?></span>
                        <?php } ?>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</section>

<?php include_once FILM_AFRICA_PARTIAL_VIEWS.'/related/related-'.get_post_type().'.php'; ?>