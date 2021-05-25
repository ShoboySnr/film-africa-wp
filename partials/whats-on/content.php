<section class="custom-container mt-20">
    <div class="grid lg:grid-cols-3 gap-2 mt-8" id="ajax-contents">
        <?php

            foreach ($whats_on as $new) {
                include FILM_AFRICA_PARTIAL_VIEWS.'/whats-on/_content.php';
            }
        ?>
    </div>

    <?php include_once FILM_AFRICA_PARTIAL_VIEWS.'/pagination.php'; ?>
</section>