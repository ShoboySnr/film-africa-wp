<?php

$press_release_banner = get_field('press_release_banner');
$press_release_title = get_field('press_release_title');
$press_release_subtitle = get_field('press_release_subtitle');
$press_release_button = get_field('press_release_button');

if(!empty($press_release_title)) {
?>
<section class="grid grid-rows-1 lg:flex">
    <div class="lg:w-3/5 h-97">
        <img
            title="<?= $press_release_banner['title'] ?>"
            src="<?= $press_release_banner['url'] ?>"
            alt="<?= $press_release_banner['alt'] ?>"
            class="w-full h-full object-cover object-top"
        >
    </div>
    <div class="lg:w-2/5 h-97 bg-black text-white pl-10 lg:pl-24.5">
        <h3 class="pt-20 text-5xl max-w-sm">
            <?=  $press_release_title ?>
        </h3>
        <p class="text-lg mt-7.5 max-w-sm">
           <?= $press_release_subtitle ?>
        </p>
        <a href="<?= $press_release_button['url'] ?>" title="<?= $press_release_button['title'] ?>" target="<?= $press_release_button['target']  ?>" type="button" class="bg-red mt-7.5 px-3.5 py-2"><?= $press_release_button['title'] ?></a>
    </div>
</section>
<?php } ?>
