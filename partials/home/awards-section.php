<?php
$awards_section = $home_data['awards_section'];
?>
<section class="custom-container grid grid-cols-1 lg:grid-cols-2 gap-2 pt-8 pb-5">
    <div class="award">
        <h3 class="text-5xl lg:text-7xl font-black"><?= $awards_section['baobab_awards_title'] ?></h3>
        <p class="mt-6">
            <?= $awards_section['baobab_awards_details'] ?>
        </p>

        <a href="<?= $awards_section['baobab_link']['url'] ?>" class="inline-block font-semibold text-lg underline mt-6 hover:text-red">
            <?=  $awards_section['baobab_link']['title'] ?>
        </a>
    </div>
    <div class="award">
        <h3 class="text-5xl lg:text-7xl font-black"><?= $awards_section['audience_awards_title'] ?></h3>
        <p class="mt-6">
            <?= $awards_section['audience_awards_details'] ?>
        </p>
        <a href="<?= $awards_section['audience_link']['url'] ?>" class="inline-block font-semibold text-lg underline mt-6 hover:text-red">
            <?=  $awards_section['audience_link']['title'] ?>
        </a>
    </div>
</section>
