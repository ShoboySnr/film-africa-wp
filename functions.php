<?php
/**
 * Film Africa Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Film_Africa_Theme
 */

require __DIR__ . '/vendor/autoload.php';

//custom define paths
require get_template_directory() . '/utilities/define-paths.php';

if ( ! defined( '_S_VERSION' ) ) {
    // Replace the version number of the theme on each release.
    define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'film_africa_wp_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function film_africa_wp_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Film Africa Theme, use a find and replace
         * to change 'film-africa-wp' to the name of your theme in all the template files.
         */
        load_theme_textdomain( 'film-africa-wp', get_template_directory() . '/languages' );
        
        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );
        
        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );
        
        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );
        
        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(
            array(
                'primary-menu' => esc_html__( 'Primary Menu', 'film-africa-wp' ),
            )
        );
        
        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
            )
        );
        
        // Set up the WordPress core custom background feature.
        add_theme_support(
            'custom-background',
            apply_filters(
                'film_africa_wp_custom_background_args',
                array(
                    'default-color' => 'ffffff',
                    'default-image' => '',
                )
            )
        );
        
        // Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );
        
        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support(
            'custom-logo',
            array(
                'height'      => 250,
                'width'       => 250,
                'flex-width'  => true,
                'flex-height' => true,
            )
        );
    }
endif;
add_action( 'after_setup_theme', 'film_africa_wp_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function film_africa_wp_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'film_africa_wp_content_width', 640 );
}
add_action( 'after_setup_theme', 'film_africa_wp_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function film_africa_wp_widgets_init() {
    register_sidebar(
        array(
            'name'          => esc_html__( 'Sidebar', 'film-africa-wp' ),
            'id'            => 'sidebar-1',
            'description'   => esc_html__( 'Add widgets here.', 'film-africa-wp' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
    
    register_sidebar(
        array(
            'name'          => esc_html__( 'Footer Area 1', 'film-africa-wp' ),
            'id'            => 'footer-area-1',
            'description'   => esc_html__( 'Add widgets here.', 'film-africa-wp' ),
            'before_widget' => '<dl id="%1$s" class="footer-nav-col widget %2$s">',
            'after_widget'  => '</div></dl>',
            'before_title'  => '<dt class="font-black text-lg">',
            'after_title'   => '</dt><div class="text-gray-4 mt-12">',
        )
    );
    
    register_sidebar(
        array(
            'name'          => esc_html__( 'Footer Area 2', 'film-africa-wp' ),
            'id'            => 'footer-area-2',
            'description'   => esc_html__( 'Add widgets here.', 'film-africa-wp' ),
            'before_widget' => '<dl id="%1$s" class="footer-nav-col widget %2$s">',
            'after_widget'  => '</div></dl>',
            'before_title'  => '<dt class="font-black text-lg">',
            'after_title'   => '</dt><div class="text-gray-4 mt-12">',
        )
    );
    
    register_sidebar(
        array(
            'name'          => esc_html__( 'Footer Area 3', 'film-africa-wp' ),
            'id'            => 'footer-area-3',
            'description'   => esc_html__( 'Add widgets here.', 'film-africa-wp' ),
            'before_widget' => '<dl id="%1$s" class="footer-nav-col widget %2$s">',
            'after_widget'  => '</div></dl>',
            'before_title'  => '<dt class="font-black text-lg">',
            'after_title'   => '</dt><div class="text-gray-4 mt-12">',
        )
    );
    
    register_sidebar(
        array(
            'name'          => esc_html__( 'Footer Area 4', 'film-africa-wp' ),
            'id'            => 'footer-area-4',
            'description'   => esc_html__( 'Add widgets here.', 'film-africa-wp' ),
            'before_widget' => '<dl id="%1$s" class="footer-nav-col widget %2$s">',
            'after_widget'  => '</div></dl>',
            'before_title'  => '<dt class="font-black text-lg">',
            'after_title'   => '</dt><div class="text-gray-4 mt-12">',
        )
    );
    
    register_sidebar(
        array(
            'name'          => esc_html__( 'Footer Area 5', 'film-africa-wp' ),
            'id'            => 'footer-area-5',
            'description'   => esc_html__( 'Add widgets here.', 'film-africa-wp' ),
            'before_widget' => '<dl id="%1$s" class="footer-nav-col widget %2$s">',
            'after_widget'  => '</div></dl>',
            'before_title'  => '<dt class="font-black text-lg">',
            'after_title'   => '</dt><div class="text-gray-4 mt-12">',
        )
    );
    
}
add_action( 'widgets_init', 'film_africa_wp_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function film_africa_wp_scripts() {
    wp_enqueue_style( 'film-africa-wp-style', get_stylesheet_uri(), array(), _S_VERSION );
    wp_style_add_data( 'film-africa-wp-style', 'rtl', 'replace' );
    wp_enqueue_style( 'film-africa-wp-custom-style', get_template_directory_uri().'/styles/output/index.css', array(), _S_VERSION );
    wp_enqueue_style( 'film-africa-wp-custom-css', get_template_directory_uri().'/styles/custom.css', array(), _S_VERSION );
    
    wp_enqueue_script('film-africa-jquery', '//code.jquery.com/jquery-3.5.1.min.js', false, null, true);
    wp_enqueue_script('film-africa-jquery-ui', '//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js', false, null, true);
    
    wp_enqueue_script( 'film-africa-wp-navigation', get_template_directory_uri() . '/scripts/nav.js', array(), _S_VERSION, true );
    
    if(is_front_page()) {
        wp_enqueue_script( 'film-africa-wp-home', get_template_directory_uri() . '/scripts/home.js', array(), _S_VERSION, true );
    }
    wp_enqueue_script( 'film-africa-slide-js', get_template_directory_uri() . '/scripts/slide.js', array('film-africa-jquery'), _S_VERSION, true );
    
    
    wp_enqueue_script( 'film-africa-util-js', get_template_directory_uri() . '/scripts/utils/path.js', array('film-africa-custom-js'), _S_VERSION, true );
    wp_enqueue_script( 'film-africa-custom-js', get_template_directory_uri() . '/scripts/custom.js', array(), _S_VERSION, true );
    wp_enqueue_script( 'film-africa-modal-js', get_template_directory_uri() . '/scripts/modal.js', array('film-africa-jquery'), _S_VERSION, true );
    wp_enqueue_script( 'film-africa-video-player-js', get_template_directory_uri() . '/scripts/video-player.js', array('film-africa-jquery'), _S_VERSION, true );
    wp_enqueue_script( 'film-africa-snippet-js', get_template_directory_uri() . '/scripts/snippet.js', array('film-africa-jquery'), _S_VERSION, true );
    wp_enqueue_script( 'film-africa-wp-calendar', get_template_directory_uri() . '/scripts/calendar.js', array('film-africa-jquery'), _S_VERSION, true );
    
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'film_africa_wp_scripts', 20 );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Require Custom Functions
 *
 */
require get_template_directory() . '/utilities/functions.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
    require get_template_directory() . '/inc/jetpack.php';
}

function film_africa_video_popup_attributes( $video_url ) {
    $video_url .= '&amp;autoplay=1&amp;modestbranding=1';
    return $video_url;
}
add_filter( 'wp_video_popup', 'film_africa_video_popup_attributes' );


function wp_press_permalink( $return ) {
    if ( get_post_type() === 'press' ) {
        $return = '';
    }
    return $return;
}
add_filter( 'get_sample_permalink_html', 'wp_press_permalink' );

add_filter( 'page_row_actions', 'wp_press_row_actions', 10, 2 );
add_filter( 'post_row_actions', 'wp_press_row_actions', 10, 2 );
function wp_press_row_actions( $actions, $post ) {
    if ( get_post_type() === 'press' ) {
        unset( $actions['inline hide-if-no-js'] );
        unset( $actions['view'] );
    }
    return $actions;
}

add_action('admin_head', 'wp_hide_press_preview_button_as_admin');
function wp_hide_press_preview_button_as_admin() {
    if ( get_post_type() === 'press' ) {
        echo '<style>
                            #post-preview, .block-editor-post-preview__dropdown {
                                            display:none !important;
                            }
                    </style>';
    }
}

