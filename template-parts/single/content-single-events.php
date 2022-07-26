<?php
use FilmAfricaWP\classes\Utilities;

global $post;

$filter_by = $_GET['filter-by'] ?? 'overview';

$twitter = FILM_AFRICA_ASSETS_ICONS_DIR.'/twitter.svg';
$facebook = FILM_AFRICA_ASSETS_ICONS_DIR.'/facebook.svg';
$mail = FILM_AFRICA_ASSETS_ICONS_DIR.'/mail.svg';
$note_white = FILM_AFRICA_ASSETS_ICONS_DIR.'/note-white.svg';
$calender = FILM_AFRICA_ASSETS_ICONS_DIR.'/calendar.svg';
$location_pin = FILM_AFRICA_ASSETS_ICONS_DIR.'/location-pin.svg';
$clock = FILM_AFRICA_ASSETS_ICONS_DIR.'/clock.svg';

$categories = Utilities::get_instance()->get_post_taxonomy($post->ID, 'whats_on_category');
$book_now = get_field('event_link');

$location = get_field('location');
$language = get_field('languages');
$time = get_field('time');
$runtime = get_field('runtime');
$film_year = get_field('film_year');

$tags = get_the_tags();
?>
<section class="bg-gray-1">
    <div class="custom-container">
        <div class="relative w-full overflow-hidden flex previous-winner-hero">
            <img
                    src="<?= get_the_post_thumbnail_url() ?>"
                    alt="<?= $posts[0]->post_name ?>"
                    class="w-full object-cover object-center flex-shrink-0" height="510" />
        </div>
        <div class="flex flex-col xl:flex-row pt-20 pb-32 relative">
            <article class="film-overview">
                <?php
                include_once FILM_AFRICA_PARTIAL_VIEWS.'/whats-on/events/content.php';
                ?>
            </article>
            <?php include_once(FILM_AFRICA_PARTIAL_VIEWS.'/whats-on/sidebar.php'); ?>
        </div>
    </div>
</section>

<?php include_once FILM_AFRICA_PARTIAL_VIEWS.'/related/related-films.php'; ?>
