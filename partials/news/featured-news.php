<?php
use FilmAfricaWP\pages\News;

$sticky_posts = News::get_instance()->get_sticky_posts();

if(!empty($sticky_posts)) {

?>
<section class="flex flex-col lg:flex-row frame border-t">
    <div class="w-full lg:w-3/5 h-97">
        <img
            src="<?= $sticky_posts['image'] ?>"
            alt=""
            class="w-full h-full object-cover object-top"
        >
    </div>
    <div class="w-full lg:w-2/5 pl-7 lg:pl-12 h-97">
        <?php
            if(isset($sticky_posts['category']['title'])) {
        ?>
        <p class="pt-9">
            <span class="inline-block bg-black text-white px-3 py-2 text-xs"
            ><?= $sticky_posts['category']['title'] ?></span
            >
        </p>
        <?php } ?>
        <h2 class="pt-6 text-5xl font-black max-w-sm">
            <?= $sticky_posts['title'] ?>
        </h2>
        <p class="text-lg mt-7.5 max-w-sm">
            <?= $sticky_posts['summary'] ?>
        </p>
        <a
            href="<?= $sticky_posts['link'] ?>"
            class="text-base font-bold text-gray-4 mt-7.5 py-2 inline-block underline hover:text-red"
            title="<?= $sticky_posts['title'] ?>"
        ><?= __('Read more', 'film-africa-wp') ?></a
        >
    </div>
</section>
<?php
}
wp_reset_postdata();
