<?php
$term_id = get_queried_object()->term_id;
$taxonomy = get_queried_object()->taxonomy;
$terms = get_term_by('id', $term_id, $taxonomy);

$featured_image = get_field('featured_image', $terms);



if(!empty($featured_image['url'])) {
?>
<section>
    <picture class="img-banner">
        <img
            class="h-full w-full object-cover object-top"
            src="<?= $featured_image['url'] ?>"
            alt="<?= $featured_image['alt'] ?>"
        >
    </picture>
    <div class="custom-container flex justify-end">
        <div class="trapezium-banner banner top-64">
            <h1 class="banner-text"><?= $terms->name ?></h1>
        </div>
    </div>
</section>
<?php
} else {
    ?>
<section class="h-356 bg-black-2">
    <div class="custom-container flex justify-end">
        <div class="trapezium-banner banner top-64">
            <h1 class="banner-text"><?= $terms->name ?></h1>
        </div>
    </div>
</section>
<?php
}