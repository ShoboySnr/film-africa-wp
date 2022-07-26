<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Film_Africa_Theme
 */

//get the theme custom logo
$theme_logo_id = get_theme_mod( 'custom_logo' );
$theme_logo_url = wp_get_attachment_image_url( $theme_logo_id , 'full' );

//get the search and open icon url
$search_icon_url = FILM_AFRICA_ASSETS_ICONS_DIR.'/search.svg';
$open_icon_url = FILM_AFRICA_ASSETS_ICONS_DIR.'/nav-menu.svg';
$close_icon_url = FILM_AFRICA_ASSETS_ICONS_DIR.'/close-menu.svg';

//search page link
$search_page_url = get_permalink(get_page_by_path('search'));

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
    <header class="relative">
        <nav class="absolute top-0 left-0 w-full z-20">
            <div class="nav-header">
                <div class="mr-auto">
                    <a href="<?= esc_url(home_url('/')) ?>"  rel="home" title="<?= get_bloginfo('name', 'display') ?>">
                        <img
                            class="h-auto w-10/12 sm:w-full"
                            src="<?= $theme_logo_url ?>"
                            alt="<?= get_bloginfo('name', 'display') ?>"
                            title="<?= get_bloginfo('name', 'display') ?>"
                        >
                    </a>
                </div>
                <div class="flex items-center">
                    <a href="<?= $search_page_url ?>" class="focus:outline-white mr-6 sm:mr-12 flex-shrink-0">
                        <img src="<?= $search_icon_url ?>" alt="search" title="<?= __('search', 'fim-africa-wp') ?>">
                    </a>
                    <a href="<?= get_permalink(get_page_by_path('support/become-a-partner')); ?>" class="focus:outline-white btn mr-6 md:mr-12">
                        <?= __('Support', 'film-africa-wp') ?>
                    </a>
                    <button type="button" class="focus:outline-white px-2 flex-shrink-0" id="open-btn">
                        <img src="<?= $open_icon_url ?>" alt="open-icon" title="<?= __('Open Menu', 'fim-africa-wp') ?>" >
                    </button>
                </div>
            </div>

            <div id="nav-content" class="nav-content">
                <div class="nav-header">
                    <div class="mr-auto">
                        <a href="<?= esc_url(home_url('/')) ?>"  rel="home" title="<?= get_bloginfo('name', 'display') ?>">
                            <img
                                    class="h-auto w-10/12 sm:w-full"
                                    src="<?= $theme_logo_url ?>"
                                    alt="<?= get_bloginfo('name', 'display') ?>"
                                    title="<?= get_bloginfo('name', 'display') ?>"
                            >
                        </a>
                    </div>
                    <div class="flex items-center">
                        <a
                                class="focus:outline-white mr-6 sm:mr-12 flex-shrink-0"
                                href="<?= $search_page_url ?>"
                        >
                            <img src="<?= $search_icon_url ?>" alt="search" title="<?= __('search', 'fim-africa-wp') ?>">
                        </a>
                        <a href="<?= get_permalink(get_page_by_path('support/become-a-partner')); ?>" class="focus:outline-white btn mr-6 md:mr-12">
                            <?= __('Support', 'film-africa-wp') ?>
                        </a>
                        <button
                                type="button"
                                class="focus:outline-white px-2 flex-shrink-0"
                                id="close-btn"
                        >
                            <img src="<?= $close_icon_url ?>" alt="open-icon"  title="<?= __('Close Menu', 'fim-africa-wp') ?>">
                        </button>
                    </div>
                </div>
                <?php
                    $args = [
                        'menu_class'        => 'nav-list',
                        'menu_id'           => 'primary-menu',
                        'container'         => 'ul',
                        'container_class'   => 'nav-list-item',
                        'theme_location'    => 'primary-menu',
                        'fallback_cb'       => 'no_primary_menu',
                    ];
                    wp_nav_menu($args);
                ?>
            </div>
        </nav>

        <?php
            //wrap this in a function instead

            render_header_banner_template();
            //link to the breadcrumb
            include_once(FILM_AFRICA_PARTIAL_VIEWS.'/breadcrumb.php')
        ?>
    </header>
