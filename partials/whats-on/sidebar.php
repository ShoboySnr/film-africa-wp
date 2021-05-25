<div class="film-details">
    <?php
    if(!empty($categories)) {
        foreach ($categories as $category) {
            ?>
            <p class="bg-yellow px-6 py-3 inline-block text-sm">
                <?= $category['title']; ?>
            </p>
        <?php } } ?>
    <div class="pt-11 font-semibold">
        <div class="flex items-center">
            <picture class="mr-4">
                <img src="<?= $calender ?>" alt="<?= __('calendar', 'film-africa-wp') ?>" >
            </picture>
            <span>
                  <time datetime="<?= date('j F Y', strtotime(get_field('start_date'))) ?>"><?= date('j F Y', strtotime(get_field('start_date'))) ?></time>
                </span>
        </div>
        <?php

        if(!empty($location)) {
            ?>
            <div class="flex pt-4 items-center">
                <picture class="mr-4">
                    <img src="<?= $location_pin ?>" alt="<?= __('location', 'film-africa-wp') ?>" >
                </picture>
                <span><?= $location ?></span>
            </div>
        <?php }

        if (!empty($time)) {
            ?>
            <div class="flex pt-4 items-center">
                <picture class="mr-4">
                    <img src="<?= $clock ?>" alt="<?= __('Time', 'film-africa-wp') ?>" >
                </picture>
                <span><?= $time ?></span>
            </div>
        <?php } ?>
    </div>
    <div class="pt-11">
        <?php

        if(!empty($runtime)) {

            ?>
            <p>
                <span class="font-semibold"><?= __('Runtime:', 'film-africa-wp') ?> </span>
                <time class="font-bold"><?= $runtime ?></time>
            </p>
            <?php
        }
        if(!empty($language)) {
            ?>
            <p class="pt-2.5 font-semibold">
                <?= __('Language(s):', 'film-africa-wp') ?>

                <span><?= $language; ?></span>
            </p>
        <?php }

        if(!empty($film_year)) {
            ?>
            <p class="pt-2.5 font-semibold">
                <?= __('Year:', 'film-africa-wp') ?>

                <span><?= $film_year; ?></span>
            </p>
        <?php } ?>

    </div>
    <?php

    if(!empty($book_now['url'])) {
    ?>
    <div class="pt-11">
        <a href="<?= $book_now['url'] ?>" type="button" target="<?= $book_now['target'] ?>"
           class="px-12 py-2.5 bg-black-2 text-white flex items-center font-bold book-now-button"
        >
                <span class="mx-2 fill-current flex-shrink-0">
                  <img src="<?= $note_white ?>" alt="<?= __('note', 'film-africa-wp') ?>" >
                </span>

            <span><?= $book_now['title'] ?> </span>
        </a>
    </div>
    <?php } ?>
    <div class="pt-10">
        <small class="uppercase tracking-widest"><?= __('share', 'film-africa-wp') ?></small>
        <ul class="flex gap-5 items-center pt-6">
            <li>
                <a href="#">
                    <img src="<?= $twitter; ?>" alt="<?= __('twitter', 'film-africa-wp') ?>" >
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="<?= $facebook ?>" alt="<?= __('facebook', 'film-africa-wp') ?>" >
                </a>
            </li>

            <li>
                <a href="#">
                    <img src="<?= $mail; ?>" alt="<?= __('mail', 'film-africa-wp') ?>" >
                </a>
            </li>
        </ul>
    </div>
    <?php

    if($tags && !empty($tags))
    {
        ?>
        <div class="flex flex-wrap gap-3 pt-10">
            <?php

            foreach($tags as $tag) {
                ?>
                <span class="border border-black-2 p-2"><?= $tag->name; ?></span>
            <?php } ?>
        </div>
    <?php } ?>
</div>