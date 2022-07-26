<?php
global $post;

$term_id = get_queried_object()->term_id;
$taxonomy = get_queried_object()->taxonomy;
$terms = get_term_by('id', $term_id, $taxonomy);


$past_festivals = \FilmAfricaWP\classes\Utilities::get_instance()->get_single_taxonomy($terms->slug, 'fallow_years');
$download = FILM_AFRICA_ASSETS_ICONS_DIR.'/download.svg';

if(!empty($past_festivals)) {
//set the global posts to affect the linked big banner at the bottom
$post = get_post($past_festivals['id'], OBJECT);
$page_title = get_field('page_title', $post->ID);
setup_postdata( $post );

?>
    <section class="relative bg-gray-1">
        <div class="custom-container pt-20">
            <div class="grid grid-cols-1 lg:flex justify-between items-center">
                <h1 class="text-4xl font-black lg:w-2/3">
                    <?= $page_title ?>
                </h1>
                <?php
                if(!empty($past_festivals['download_brochure'])) {
                    ?>
                    <button type="button"
                            class="w-4/5 sm:w-3/5 lg:w-auto bg-yellow text-black mt-9 lg:mt-0 py-3 px-5 font-bold text-lg flex items-center justify-center"
                    >
              <span class="mx-2">
                <img src="<?= $download; ?>" alt="" >
              </span>
                        <?= $past_festivals['download_brochure']['title'] ?>
                    </button>
                <?php } ?>
            </div>
            <!-- add whitespace-pre-line to class list -->
            <div class="whitespace-pre-line text-lg font-normal py-12 mt-0.5 leading-7.5 overflow-y-hidden snippet expand-snippet">
                <?= $past_festivals['content'] ?>
            </div>
        </div>
    </section>
    <?php
    if(strlen($past_festivals['content']) > 70) {
        include_once FILM_AFRICA_PARTIAL_VIEWS . '/read-all.php';
    }
} ?>