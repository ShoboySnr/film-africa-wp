<?php
global $post;

$related_films = \FilmAfricaWP\pages\WhatsOn::get_instance()->get_related_films($post);
if(!empty($related_films)) {
?>
<section class="mt-20 custom-container">
    <h4 class="font-black capitalize pt-20 text-4xl text-center">
        <?= __('Related films', 'film-africa-wp') ?>
    </h4>
    <div class="related-films-container frame">
    <?php
        foreach ($related_films as $new) {
            include FILM_AFRICA_PARTIAL_VIEWS.'/whats-on/_related_content.php';
        }
    ?>
    </div>
</section>
<?php } ?>