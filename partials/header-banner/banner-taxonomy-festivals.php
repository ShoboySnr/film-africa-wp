<?php
$term_id = get_queried_object()->term_id;
$taxonomy = get_queried_object()->taxonomy;
$terms = get_term_by('id', $term_id, $taxonomy);

$featured_image = get_field('featured_image', $terms);
$single_post_taxonomy = \FilmAfricaWP\classes\Utilities::get_instance()->get_single_taxonomy($terms->slug, $post_type);
$post = get_post($single_post_taxonomy['id'], OBJECT);
$slider_images = acf_photo_gallery('banner_slider_images', $post->ID);
$number_of_sliders = count($slider_images);
$featured_image = get_the_post_thumbnail_url($post->ID);
if(!empty($featured_image)) {
    $number_of_sliders += 1;
}

$play = FILM_AFRICA_ASSETS_ICONS_DIR.'/play.svg';
$pause = FILM_AFRICA_ASSETS_ICONS_DIR.'/pause.svg';

//trailer
$trailer = get_field('trailer', $post->ID);

?>
<!-- Hero -->
<section class="img-banner-2 custom-container" id="slideshow">
    <?php
    for($count = 1; $count <= $number_of_sliders; ++$count) {
    ?>
    <input class="hidden-slide-btn" type="radio" name="currentSlide" id="slide-<?= $count; ?>-btn" <?= $count == 1 ? 'checked': '' ?>>
    <label for="slide-<?= $count ?>-btn" class="slide-btn top-4/5 z-10"> </label>
    <?php } ?>
        <section class="slide-wrapper top-0 h-full w-full">
            <div class="slide-1 z-10">
                <video
                    class="trailer h-full w-full object-cover object-bottom absolute top-0 left-0"
                    poster="<?= $featured_image ?>"
                >
                    <source src="<?= $trailer ?>" type="video/mp4" >
                    <?= __('Your browser does not support the video tag.', 'film-africa-wp') ?>
                </video>
                <?php
                if(!empty($trailer)) {
                ?>
                <button
                    type="button"
                    class="absolute top-1.5/5 left-2.5/5 play-btn focus:outline-white z-10"
                >
                    <picture>
                        <img src="<?= $play; ?>" alt="<?= __('play', 'film-africa-wp') ?>" title="Play" >
                    </picture>
                </button>
                <button
                    type="button"
                    class="absolute top-1.5/5 left-2.5/5 pause-btn border-2 rounded-full p-4 z-10 opacity-10 hover:opacity-100 hidden"
                >
                    <picture>
                        <img src="<?= $pause ?>" alt="<?= __('Pause', 'film-africa-wp') ?>" title="Pause" >
                    </picture>
                </button>
                <p class="font-black text-white inline text-2xl absolute uppercase w-24 top-1/3 left-1/2 leading-6 watch-trailer">
                    <?= __('Watch trailer', 'film-africa-wp') ?>
                </p>
                <?php } ?>
            </div>
            <?php
            $count = 1;
            foreach ($slider_images as $slider_image) {
            ?>
            <picture class="h-full w-full absolute top-0 left-0 slide-<?= ++$count ?>">
                <img
                    class="h-full w-full object-cover object-top"
                    src="<?= $slider_image['full_image_url'] ?>"
                    alt="<?= $slider_image['caption'] ?>"
                    title="<?= $slider_image['title'] ?>"
                >
            </picture>
            <?php } ?>
        </section>
    <div class="flex justify-end">
        <div class="flex-trapezium-banner banner bottom-40 lg:bottom-20">
            <h1 class="banner-text"><?= $terms->name ?></h1>
        </div>
    </div>
</section>