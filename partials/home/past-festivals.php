<?php

$past_festivals = $home_data['past_festivals'];

?>
<!-- Past Events -->
<section class="grid md:flex flex-wrap md:flex-nowrap">
    <?php
        $count = 0;
        foreach ($past_festivals as $past_festival) {
    ?>
    <figure class="past-event">
        <img
            class="h-full w-full object-cover object-center hover:filter-none filter-dim"
            src="<?= $past_festival['image'] ?>"
            alt="<?= $past_festival['title'] ?>"
            title="<?= $past_festival['title'] ?>"
        >
        <figcaption
            class="event-title absolute top-48 md:top-80 <?= apply_filters('apply_class_names_on_past_festivals', $count) ?>"
        >
            <?= $past_festival['title'] ?>
        </figcaption>
    </figure>
    <?php
            $count++;
        }
    ?>
</section>
