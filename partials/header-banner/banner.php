<?php
global $posts;

if(isset($posts[0])) {
    $post = $posts[0];
?>
<section>
    <picture class="img-banner">
        <img
            class="h-full w-full object-cover object-top"
            src="<?= get_the_post_thumbnail_url($post->ID) ?>"
            alt="<?= $post->post_name ?>"
        >
    </picture>
    <div class="custom-container flex justify-end">
        <div class="trapezium-banner banner top-64">
            <h1 class="banner-text"><?= $post->post_title ?></h1>
        </div>
    </div>
</section>
<?php
} else {
var_dump($posts);
    ?>
    <section class="h-356 bg-black-2">
        <div class="custom-container flex justify-end">
            <div class="trapezium-banner banner top-64">
                <h1 class="banner-text"><?= get_the_title() ?></h1>
            </div>
        </div>
    </section>
    <?php
}

?>

