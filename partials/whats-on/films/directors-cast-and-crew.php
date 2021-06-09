<?php

$find_cast = get_field('cast_name_1');

if(!empty($find_cast)) {
?>
<article class="text-lg">
    <?php
        $count = 0;
        foreach($casts as $cast) {
    ?>
    <figure class="pt-16 flex gap-11 flex-col lg:flex-row">
        <div class="flex-shrink-0 flex-grow-0">
            <img
                    src="<?= $cast['picture']['url'] ?>"
                    alt="<?= $cast['picture']['alt'] ?>"
                    title="<?= $cast['picture']['title'] ?>"
                    class="w-44 h-44 object-center object-cover rounded-full"
            >
        </div>
        <figcaption>
            <h3 class="font-extrabold capitalize"><?= $cast['name'] ?></h3>
            <p class="pt-2.5">
               <?= $cast['details'] ?>
            </p>
        </figcaption>
    </figure>
            <?php } ?>
</article>
<?php } ?>