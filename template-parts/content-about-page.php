<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Film_Africa_Theme
 */

$page_title = get_field('page_title');
$about_page_banner = get_field('about_page_banner');

$about_descriptions = get_field('about_descriptions');
$below_description_link = get_field('below_description_link');

$meet_the_team_title = get_field('meet_the_team_title');
$meet_the_team_button = get_field('meet_the_team_button');
$meet_the_team_banner = get_field('meet_the_team_banner');

$film_africa_young_audiences_title = get_field('film_africa_young_audiences_title');
$film_africa_young_audiences_button = get_field('film_africa_young_audiences_button');
$film_africa_young_audiences_banner = get_field('film_africa_young_audiences_banner');
?>
<section id="post-<?php the_ID(); ?>" <?php post_class('relative bg-gray-1'); ?>>
    <div class="custom-container py-20">
        <?php
        if(!empty($page_title)) {
            ?>
            <h1 class="text-5xl font-black">
                <?= $page_title ?>
            </h1>
        <?php } ?>

        <div class="text-lg font-normal pt-12 mt-0.5 leading-7.5 overflow-y-hidden">
            <?= get_the_content(); ?>
        </div>
    </div>
</section>

<!-- gave this section an id of submenu, please don't remove -->
<section class="flex flex-col lg:flex-row justify-center items-center py-9 leading-3 font-bold" id="submenu">
<?php
$args = [
    'child_of'          => get_the_ID(),
    'depth'             => 1,
    'title_li'          => '',
    'sort_column'       => 'menu_order',
    'link_before'       => '',
    'link_after'        => '',
    'walker'            => new \FilmAfricaWP\classes\SubMenuWalker()
];
wp_list_pages($args);

?>
</section>
<?php
    if(!empty($about_page_banner)) {
?>
<picture class="w-full block h-99">
    <img src="<?= $about_page_banner['url'] ?>" title="<?= $about_page_banner['title'] ?>" alt="<?= $about_page_banner['alt'] ?>" class="w-full h-full object-cover object-center">
</picture>
<?php
    }
?>

<article class="custom-container text-gray-4">
    <div class="text-editor">
        <?= $about_descriptions ?>
    </div>
    <?php

    if(!empty($below_description_link)) {
    ?>
    <a href="<?= $below_description_link['url'] ?>" class="py-14 hover:text-red underline inline-block">
        <?= $below_description_link['title'] ?>
    </a>
    <?php } ?>
</article>

<section class="flex flex-col md:flex-row overflow-hidden">
    <figure class="relative h-97 md:w-1/2">
        <picture>
            <img src="<?= $meet_the_team_banner['url'] ?>" title="<?= $meet_the_team_banner['title']  ?>" alt="<?= $meet_the_team_banner['alt'] ?>" class="w-full h-full object-cover object-center">
        </picture>
        <figcaption class="absolute bottom-20 left-0 px-20 lg:px-36">
            <p class="font-black text-5xl pb-3.5 max-w-xs capitalize text-white">
                <?= $meet_the_team_title ?>
            </p>
            <a href="<?= $meet_the_team_button['url'] ?>" title="<?= $meet_the_team_button['title'] ?>" target="<?= $meet_the_team_button['target'] ?>" type="button" class="bg-red px-3.5 py-2 mt-4 capitalize text-white">
               <?= $meet_the_team_button['title'] ?>
            </a>
        </figcaption>
    </figure>
    <figure class="relative h-97 md:w-1/2">
        <img src="<?= $film_africa_young_audiences_banner['url'] ?>" title="<?= $film_africa_young_audiences_banner['title']  ?>" alt="<?= $film_africa_young_audiences_banner['alt'] ?>" class="w-full h-full object-cover object-center">
        <figcaption class="absolute bottom-20 left-0 px-20 lg:px-36">
            <p class="font-black text-5xl pb-3.5 max-w-2xl capitalize text-white">
                <?= $film_africa_young_audiences_title ?>
            </p>
            <a href="<?= $film_africa_young_audiences_button['url'] ?>" title="<?= $film_africa_young_audiences_button['title'] ?>" target="<?= $film_africa_young_audiences_button['target'] ?>" class="bg-red px-3.5 py-2 inline-block mt-4 capitalize text-white">
               <?= $film_africa_young_audiences_button['title'] ?>
            </a>
        </figcaption>
    </figure>
</section>
<!-- #post-
<?php the_ID(); ?> -->
