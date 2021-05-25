<!--
Template Name: Home Template
-->
<?php
use FilmAfricaWP\pages\Home;

get_header();

$home_data = Home::get_instance()->get_home_fields();
include_once(FILM_AFRICA_PARTIAL_VIEWS.'/home/past-festivals.php');
include_once(FILM_AFRICA_PARTIAL_VIEWS.'/home/whats-on.php');
include_once(FILM_AFRICA_PARTIAL_VIEWS.'/home/news.php');
include_once(FILM_AFRICA_PARTIAL_VIEWS.'/home/awards-section.php');

?>


<?php
get_footer();
