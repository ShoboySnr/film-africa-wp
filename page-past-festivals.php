<!--
Template Name: Past Festivals Template
-->
<?php
$past_festivals = \FilmAfricaWP\pages\PastsFestivals::get_instance()->get_all_pasts_festivals();

get_header();
?>
<main class="custom-container border-t grid lg:grid-cols-3 gap-2 grid-rows-2 lg:pb-36 pb-5">
    <?php
    $count = 1;
    foreach ($past_festivals as $past_festival) {
        include FILM_AFRICA_PARTIAL_VIEWS.'/past-festivals/content.php';
        $count++;
    }
    ?>
</main>


<?php
get_footer();

