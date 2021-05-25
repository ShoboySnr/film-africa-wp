<?php

global $posts;

$donate_link = get_field('donate_link');
$page_title = get_field('page_title');
?>
<section class="custom-container pb-20">
    <h1 class="text-2xl pt-12 font-extrabold">
        <?= $page_title; ?>
    </h1>
    <div class="text-editor donate-page">
        <?php the_content(); ?>
    </div>
    <?php
    if(!empty($donate_link)) {
        ?>
        <button type="button"
                class="inline-block mt-20 bg-red py-2.5 px-20 text-lg text-white" onclick="document.location.href='<?= $donate_link ?>'"
        >
            <?= __('Sign Up', 'film-africa-wp') ?>
        </button>
    <?php } ?>
</section>