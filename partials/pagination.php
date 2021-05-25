<?php

$number_of_posts = isset($_GET['see-more']) ? $_GET['see-more'] : '6';
$link = add_query_arg([
    'see-more' => $number_of_posts + 3,
]);

$read_more_loader = FILM_AFRICA_ASSETS_DIR.'/loading.gif';

if ($max_number_pages > 1) {
    ?>
<div class="py-16">
    <button type="button" id="read-more-button" class="text-center w-full underline font-black" data-api="<?= $api_link ?>" data-arrow='<?= file_get_contents($left_arrow); ?>'>
        <?=__('See More', 'film-africa-wp')?>
    </button>
    <div id="read-more-loader" class="w-full text-center" style="display: none">
        <img src="<?= $read_more_loader ?>" alt="" title="<?= __('loading', 'film-africa-wp') ?>" />
    </div>
</div>
<?php }?>