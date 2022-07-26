<?php
use FilmAfricaWP\classes\Utilities;

$press_terms = Utilities::get_instance()->get_terms_of_posts('year_category');

?>
<div class="overflow-x-auto overflow-y-hidden">
    <div class="filter-tabs" id="filters-input">
        <?php
            foreach ($press_terms as $press_term) {
        ?>
        <input
            class="hidden filter-tab"
            type="radio"
            name="filter-by"
            id="<?= $press_term['slug'] ?>"
            value="<?= $press_term['slug'] ?>"
            <?= $filter_by == $press_term['slug'] ? 'checked' : '' ?>
        >
        <label for="<?= $press_term['slug'] ?>"><?= $press_term['title'] ?></label>
        <?php } ?>
    </div>
</div>
