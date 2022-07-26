<!--
Template Name: Press Template
-->
<?php
get_header();
?>

<main>
    <?php
    while ( have_posts() ) :
        the_post();
        get_template_part( 'template-parts/content', 'press' );

    endwhile; // End of the loop.


    ?>

</main><!-- #main -->

<?php
get_footer();
