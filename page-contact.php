<!--
Template Name: Contact us Template
-->
<?php

get_header();
?>

<main>
    <?php
    while ( have_posts() ) :
        the_post();
        get_template_part( 'template-parts/content', 'contact-page' );

    endwhile; // End of the loop.
    ?>

</main><!-- #main -->

<?php
get_footer();
