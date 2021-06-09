<section id="tabs" class="tabs">
    <input
        class="hidden tab"
        type="radio"
        name="filter-by"
        id="synopsis-and-directors"
        <?= $filter_by == '' || $filter_by == 'synopsis' ? 'checked' : '' ?>
        value="synopsis-and-directors"
    >
    <label
        class="tab-label"
        for="synopsis-and-directors"
    ><?= __('Synopsis', 'film-africa-wp') ?></label>

    <?php

    if(!empty($casts)) {
    ?>
    <input
        class="hidden tab"
        type="radio"
        name="filter-by"
        id="directors-cast-and-crew"
        <?= $filter_by == 'directors-cast-and-crew' ? 'checked' : '' ?>
        value="directors-cast-and-crew"
    >
    <label
        class="tab-label"
        for="directors-cast-and-crew">
        <?= __('Directors, Cast and Crew', 'film-africa-wp') ?>
    </label>
    <?php  } ?>
</section>