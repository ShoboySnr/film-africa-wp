<?php
global $post;

$related_news = \FilmAfricaWP\pages\News::get_instance()->get_related_news($post);

?>
<section class="custom-container">
    <h4 class="font-black capitalize pt-20 text-4xl text-center">
        <?= __('Related News', 'film-africa-wp') ?>
    </h4>
    <div class="grid lg:grid-cols-3 gap-2 mt-8 -mx-4 lg:-mx-0 overflow-x-hidden">
        <?php
        if(!empty($related_news)) {
            foreach ($related_news as $new) {
                include FILM_AFRICA_PARTIAL_VIEWS . '/news/_news.php';
            }
        }
        ?>
    </div>
</section>
