<!--
Template Name: Support Template
-->
<?php

use FilmAfricaWP\classes\Utilities;

$filter_by = $_GET['filter-by'] ?? '';
$sub_category = $_GET['subcategory-filter'] ?? '';

$year_cat = Utilities::get_instance()->get_terms_of_posts('partners_year_category');
$partners_cat = Utilities::get_instance()->get_terms_of_posts('partner_category');

get_header();
?>

<main>
    <?php
        include FILM_AFRICA_PARTIAL_VIEWS.'/support/submenu.php';

        while (have_posts()):
            the_post();
                load_additional_page_section();
        endwhile; // End of the loop.
        ?>
</main><!-- #main -->

<?php
get_footer();