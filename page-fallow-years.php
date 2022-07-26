<!--
Template Name: Fallow Years Template
-->
<?php
use FilmAfricaWP\pages\FallowYears;

get_header();
$get_fallow_years = FallowYears::get_instance()->get_all_fallow_years();

?>
<main class="custom-container overflow-x-hidden border-t grid grid-cols-1 lg:grid-cols-3 gap-2 grid-rows-2 pb-36">
    <?php

    foreach ($get_fallow_years as $fallow_year) {
        include FILM_AFRICA_PARTIAL_VIEWS.'/fallow-years/content.php';
        }
    ?>

</main>

<?php
get_footer();
