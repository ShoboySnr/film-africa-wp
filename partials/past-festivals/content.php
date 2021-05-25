<figure class="<?= apply_filters('apply_class_names_on_past_festivals_page', $count) ?> relative past-festival">
    <picture class="filter-dim">
        <img
            class="past-festival-img"
            src="<?= $past_festival['image'] ?>"
            alt="<?= $past_festival['title'] ?>"
            title="<?= $past_festival['title'] ?>"
        >
    </picture>

    <figcaption class="event-title absolute bottom-24 left-7 lg:left-12">
        <a href="<?php echo $past_festival['link'] ?>"  title="<?= $past_festival['title'] ?>"> <?= $past_festival['title'] ?></a>
    </figcaption>
</figure>