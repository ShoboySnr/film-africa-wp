<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Film_Africa_Theme
 */

?>
<footer>
    <!-- Footer -->
    <section class="bg-black text-center py-30">
        <h4 class="subscription-form-title">
            <?= __('Get insights and updates delivered to your inbox.', 'film-africa-wp') ?>
        </h4>
        <?= do_shortcode('[mc4wp_form id="135"]') ?>
    </section>
    <section
            class="bg-gray-1"
    >
        <div class="footer-nav">
            <picture
                    class="justify-self-center md:justify-self-auto text-center md:text-left"
            >
                <img src="<?= get_theme_mod('theme_dark_logo', FILM_AFRICA_ASSETS_ICONS_DIR.'/logo-black.svg') ?>" alt="film-africa" title="<?= __('Film Africa', 'film-africa-wp') ?>">
            </picture>
            <dl class="footer-nav-col">
                <?php dynamic_sidebar('footer-area-1'); ?>
            </dl>
            <dl class="justify-self-center md:justify-self-auto text-center md:text-left">
                <?php dynamic_sidebar('footer-area-2'); ?>
            </dl>
            <dl class="justify-self-center md:justify-self-auto text-center md:text-left">
                <?php dynamic_sidebar('footer-area-3'); ?>
            </dl>
            <dl class="justify-self-center md:justify-self-auto text-center md:text-left">
                <?php dynamic_sidebar('footer-area-4'); ?>
            </dl>
            <dl class="justify-self-center md:justify-self-auto text-center md:text-left">
                <?php dynamic_sidebar('footer-area-5'); ?>
            </dl>
        </div>
    </section>
    <a href="<?= get_permalink(get_page_by_path('terms-and-conditions')) ?>" class="block text-gray-4 py-3 text-center">
        &copy; <?= date('Y') ?> <?= __('Royal African Society. All Rights Reserved. Legal', 'film-africa-wp') ?>
    </a>
</footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
