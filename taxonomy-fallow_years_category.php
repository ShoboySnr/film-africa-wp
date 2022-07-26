<?php
global $post;

$term_id = get_queried_object()->term_id;
$taxonomy = get_queried_object()->taxonomy;
$terms = get_term_by('id', $term_id, $taxonomy);


$past_festivals = \FilmAfricaWP\classes\Utilities::get_instance()->get_single_taxonomy($terms->slug, 'fallow_years');
$download = FILM_AFRICA_ASSETS_ICONS_DIR.'/download.svg';

//set the global posts to affect the linked big banner at the bottom
$post = get_post($past_festivals['id'], OBJECT);
setup_postdata( $post );

get_header();

?>
<main>
    <?php
    get_template_part( 'template-parts/content', 'fallow-years-category' );
    wp_reset_postdata();


    ?>

</main>



<?php
get_footer();
