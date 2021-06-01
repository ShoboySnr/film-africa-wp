<?php
global $post;

$term_id = get_queried_object()->term_id;
$taxonomy = get_queried_object()->taxonomy;
$terms = get_term_by('id', $term_id, $taxonomy);

get_header();

?>
<main class="border-t">
    <?php
    while ( have_posts() ) :
        the_post();
        get_template_part( 'template-parts/content', 'taxonomy' );

    endwhile; // End of a the loop.


    ?>
</main>
<?php
get_footer();
