<section id="tabs" class="tabs">
    <input
        class="hidden tab"
        type="radio"
        name="filter-by"
        id="overview"
        <?= $filter_by == '' || $filter_by == 'overview' ? 'checked' : '' ?>
        value="overview"
    >
    <label
        class="tab-label"
        for="overview"
    ><?= __('Overview', 'film-africa-wp') ?></label>

    <input
        class="hidden tab"
        type="radio"
        name="filter-by"
        id="cast-and-creators"
        <?= $filter_by == 'cast-and-creators' ? 'checked' : '' ?>
        value="cast-and-creators"
    >
    <label
        class="tab-label"
        for="cast-and-creators">
        <?= __('Cast and Creators', 'film-africa-wp') ?>
    </label>
</section>