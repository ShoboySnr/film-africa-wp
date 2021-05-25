<?php
use FilmAfricaWP\classes\Calender;
use FilmAfricaWP\pages\WhatsOn;

$chevron_left = FILM_AFRICA_ASSETS_ICONS_DIR.'/chevron-left.svg';
$chevron_right = FILM_AFRICA_ASSETS_ICONS_DIR.'/chevron-right.svg';

$get_date = isset($_GET['goto']) && $_GET['goto'] != '' ? $_GET['goto'] : strtotime(date('F Y'));

$previous_month_link = add_query_arg([
        'goto'  => strtotime('-1 month', $get_date)
]);

$next_month_link = add_query_arg([
    'goto'  => strtotime('+1 month', $get_date),
]);

//$whats_on = WhatsOn::get_instance()->get_all_whatson($filter_by, $see_more);
?>
<div
    class="font-bold text-black-2 flex items-center bg-white px-2 py-4"
>
    <p class="mr-auto" data-calendar-label="month"><?= date('F Y', $get_date) ?></p>
    <a href="<?= $previous_month_link ?>" data-calendar-toggle="<?= __('previous', 'film-africa-wp') ?>" class="mr-4">
        <img src="<?= $chevron_left ?>" title="<?= __('Previous', 'film-africa-wp'); ?>" alt="<?= __('previous', 'film-africa-wp'); ?>" >
    </a>

    <a href="<?= $next_month_link ?>" data-calendar-toggle="next">
        <img src="<?= $chevron_right; ?>" title="<?= __('Next', 'film-africa-wp') ?>" alt="<?= __('next', 'film-africa-wp') ?>" >
    </a>
</div>
<?php
    echo Calender::get_instance()->draw_calender(date('01-m-Y', $get_date), $whats_on);
?>

