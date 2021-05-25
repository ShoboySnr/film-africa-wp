<?php

$iframe_embed = get_field('google_map');
$address = get_field('address');
$email = get_field('email');
$phone = get_field('phone');

$contact_form = get_field('contact_form_shortcode');
?>
<section class="custom-container">
    <?php
        if(!empty($iframe_embed)) {
    ?>
    <div class="w-full overflow-hidden flex previous-winner-hero">
       <?= $iframe_embed ?>
    </div>
    <?php } ?>
    <div class="flex flex-wrap flex-col-reverse lg:flex-row lg:flex-nowrap pt-20 pb-32 text-lg">
        <div class="border-r pt-11 lg:pt-0 pr-6 w-full max-w-3xl 2xl:max-w-6xl">
            <div class="text-lg">
                <?php the_content() ?>
            </div>
            <?= do_shortcode($contact_form) ?>
        </div>
        <div class="lg:px-12">
            <span class="inline-block bg-black text-white px-3 py-2 text-xs"
            ><?= __('Address', 'film-africa-wp') ?></span>
            <address class="pt-10 font-semibold not-italic">
               <?= $address ?>
            </address>
            <div class="pt-10">
                <div class="flex items-center">
                    <picture class="mr-4 flex-shrink-0">
                        <img src="<?= FILM_AFRICA_ASSETS_ICONS_DIR.'/mail.svg' ?>" alt="email" >
                    </picture>
                    <span title="<?= __('Email us', 'film-africa-wp') ?>"><?= $email ?></span>
                </div>
                <div class="flex items-center pt-4">
                    <picture class="mr-4">
                        <img src="<?= FILM_AFRICA_ASSETS_ICONS_DIR.'/phone.svg' ?>" alt="phone-call" >
                    </picture>

                    <span title="Call us"><?= $phone ?></span>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- #post-
<?php the_ID(); ?> -->
