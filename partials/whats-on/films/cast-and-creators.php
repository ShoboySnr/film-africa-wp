<article class="text-lg">
    <?php
        $count = 0;
        for($count = 0; $count < 8; $count++) {
            $cast_name = get_field('cast_name_'.$count);
            if(isset($cast_name) && $cast_name != '') {
                $picture = get_field('picture_'.$count);
    ?>
    <figure class="pt-16 flex gap-11 flex-col lg:flex-row">
        <div class="flex-shrink-0 flex-grow-0">
            <img
                    src="<?= $picture['url'] ?>"
                    alt="<?= $picture['alt'] ?>"
                    title="<?= $picture['title'] ?>"
                    class="w-44 h-44 object-center object-cover rounded-full"
            >
        </div>
        <figcaption>
            <h3 class="font-extrabold capitalize"><?= $cast_name ?></h3>
            <p class="pt-2.5">
               <?= get_field('details_'.$count); ?>
            </p>
        </figcaption>
    </figure>
    <?php }
        } ?>
</article>