<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Film_Africa_Theme
 */

$page_title = get_field('page_title');
?>
    <section id="post-<?php the_ID(); ?>" <?php post_class('relative bg-gray-1 pt-20'); ?>>
        <div class="custom-container">
            <?php
                if(!empty($page_title)) {
            ?>
                <h1 class="text-4xl font-black sm:w-5/6 lg:w-2/3 2xl:w-5/12">
                    <?= $page_title ?>
                </h1>
            <?php } ?>

            <div class="text-lg font-normal mt-0.5 leading-7.5 overflow-y-hidden snippet expand-snippet" id="content_area">
                <?php the_content(); ?>
            </div>
        </div>
    </section>
<!-- #post-
<?php the_ID(); ?> -->
