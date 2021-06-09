<?php
use FilmAfricaWP\classes\Utilities;
use FilmAfricaWP\classes\Pagination;

//apply filters to only return title image and link to posts
add_filter('filter_posts_to_return_title_images_link', function ($posts) {
    $return_data = [];
    foreach ($posts as $post) {
        $post_thumbnail = (has_post_thumbnail($post->ID)) ? get_the_post_thumbnail_url($post->ID) : null;
        $return_data[] = [
            'title' => $post->post_title,
            'image' => $post_thumbnail,
            'link' => get_permalink($post->ID),
        ];
    }

    return $return_data;
}, 100, 1);

//apply classes on past festivals based on count
add_filter('apply_class_names_on_past_festivals', function ($count) {
    $class = '';
    switch ($count) {
        case '3':
            $class .= 'left-7 lg:right-25';
            break;
        case '2':
            $class .= 'left-7';
            break;
        default:
            $class .= 'left-7 lg:left-25';
    }

    return $class;
}, 100);

//apply filter on he past festival page
add_filter('apply_class_names_on_past_festivals_page', function ($count) {
    $class = '';
    switch ($count) {
        case '1':
            $class .= 'lg:col-span-2 md:col-span-1';
            break;
        default:
            $class .= '';
    }

    return $class;
}, 100);

//apply filters to get the featured images
add_filter('apply_get_featured_image', function ($post_id) {
    return has_post_thumbnail($post_id) ? get_the_post_thumbnail_url($post_id) : null;
});

//function to be called when there's no items in the menu
function no_primary_menu()
{
    echo "<h3 style='color: #ffffff'> No Menu Found, Please add an item to this menu</h3>";
}

//hook into wp nav menu objects to insert css classes
add_filter('wp_nav_menu_objects', function ($objects, $args) {
    switch ($args->theme_location) {
        case 'primary-menu':
            foreach ($objects as $key => $value) {
                //check if the menu is not a parent menu
                if ($objects[$key]->menu_item_parent != 0) {
                    $objects[$key]->classes[] = 'nav-item';
                } else {
                    $objects[$key]->classes[] = 'nav-list-item';
                }
            }
            break;
        default:
            foreach ($objects as $key => $value) {
                //check if the menu is not a parent menu
                $objects[$key]->classes[] = 'mb-6 focus:outline-black hover:underline';
            }
    }

    return $objects;
}, 10, 2);

if (!function_exists('custom_breadcrumb')) {

    function custom_breadcrumb()
    {
        $html = '';
        $sep = '<span class="mx-3.5 text-red">&rarr;</span>';

        //explode the path
        $crumbs = explode("/", strtok($_SERVER["REQUEST_URI"], '?'));
        array_shift($crumbs);
        $crumbs = array_filter($crumbs);

        if (!is_front_page()) {
            $html .= '<section class="breadcrumbs">';
            $html .= '<a href="';
            $html .= get_option('home');
            $html .= '">';
            $html .= get_the_title(get_option('page_on_front'));
            $html .= '</a>' . $sep;

            if (is_single()) {
                $crumb = end($crumbs);
                if (!empty($crumb)) {
                    $args = [
                        'name' => $crumb,
                        'post_type' => get_post_types('', 'names'),
                        'post_status' => 'publish',
                        'numberposts' => 1,
                    ];

                    $page = get_posts($args);
                    $page = isset($page[0]) ? $page[0] : $page;
                    if (!empty($page)) {
                        $post_types = get_post_type_object($page->post_type);
                        $post_types = $post_types->labels->name;
                        $html .= '<span><a href="'. get_post_type_archive_link( $page->post_type ) .'">' . $post_types . '</a></span>' . $sep;
                        $title = $page->post_title;
                        if (get_the_ID() != $page->ID) {
                            $html .= '<span><a href="' . get_permalink($page->ID) . '" title="' . $title . '">' . $title . '</a></span>' . $sep;
                        } else {
                            $html .= '<span>' . $title . '</span>' . $sep;
                        }

                    }
                }
            } else {
                foreach ($crumbs as $key => $crumb) {
                    if (!empty($crumb)) {
                        $args = [
                            'name' => $crumb,
                            'post_type' => get_post_types('', 'names'),
                            'post_status' => 'publish',
                            'numberposts' => 1,
                        ];
                        $page = get_posts($args);
                        if(!empty($page)) {
                            $page = isset($page[0]) ? $page[0] : $page;
                            if (!empty($page)) {
                                $title = $page->post_title;
                                if (get_the_ID() != $page->ID) {
                                    $html .= '<span><a href="' . get_permalink($page->ID) . '" title="' . $title . '">' . $title . '</a></span>' . $sep;
                                } else {
                                    $html .= '<span>' . $title . '</span>' . $sep;
                                }

                            }
                        }
                    }
                }
            }

            if(is_archive()) {
                $terms = get_term_by('slug', $crumbs[2], $crumbs[1], ARRAY_N);
            }

            $html .= '</section>';

            return $html;
        }
    }}

//the template includes
add_filter('template_include', 'var_template_include', 1000);
function var_template_include($t)
{
    $GLOBALS['current_theme_template'] = basename($t);
    return $t;
}

function get_current_template($echo = false)
{
    if (!isset($GLOBALS['current_theme_template'])) {
        return false;
    }

    if ($echo) {
        echo $GLOBALS['current_theme_template'];
    } else {
        return $GLOBALS['current_theme_template'];
    }

}

//check which header file to include
function render_header_banner_template()
{
    global $posts;

    if (is_search() || get_current_template() == 'page-search.php') {
        return include_once FILM_AFRICA_PARTIAL_VIEWS . '/header-banner/banner-search.php';
    }

    if (is_front_page()) {
        return include_once FILM_AFRICA_PARTIAL_VIEWS . '/home/hero-slider.php';

    }

    if (get_current_template() == 'page-about.php') {
        return include_once FILM_AFRICA_PARTIAL_VIEWS . '/header-banner/banner-about.php';
    }


    if (get_current_template() == 'page-past-festivals.php' || get_current_template() == 'page-fallow-years.php') {
        return include_once FILM_AFRICA_PARTIAL_VIEWS . '/header-banner/banner-past-festivals.php';
    }

    if (is_tax('year_category')) {
        $post_type = 'past_festivals';
        return include_once FILM_AFRICA_PARTIAL_VIEWS . '/header-banner/banner-taxonomy-festivals.php';
    }

    if (is_tax('fallow_years_category')) {
        $post_type = 'fallow_years';
        return include_once FILM_AFRICA_PARTIAL_VIEWS . '/header-banner/banner-taxonomy-festivals.php';

    }

    if(is_archive()) {
        return include_once FILM_AFRICA_PARTIAL_VIEWS . '/header-banner/banner-taxonomy.php';
    }

    if (is_home()) {
        return include_once FILM_AFRICA_PARTIAL_VIEWS . '/header-banner/banner-posts.php';
    }

    if (is_single()) {
        if (get_post_type() == 'films' || get_post_type() == 'events') {
            return include_once FILM_AFRICA_PARTIAL_VIEWS . '/header-banner/banner-films-events.php';
        }
        return include_once FILM_AFRICA_PARTIAL_VIEWS . '/header-banner/banner-single.php';
    }

    if(isset($posts[0]) && $posts[0]->post_name == 'press') {
        return include_once FILM_AFRICA_PARTIAL_VIEWS . '/header-banner/banner-press.php';
    }

    return include_once FILM_AFRICA_PARTIAL_VIEWS . '/header-banner/banner.php';
}

//format the date as Mon 16 - Sat 23 August
function custom_date_format($start_date, $end_date = '')
{
    $html = date('D jS', strtotime($start_date));

    if (!empty($end_date)) {
        $html .= ' - ' . date('D jS F', strtotime($end_date));
    } else {
        $html = date('D jS F', strtotime($start_date));
    }

    return $html;
}

//include additional sections for pages
function load_additional_page_section()
{
    global $post;
    switch ($post->post_name) {
        case 'team':
            include_once FILM_AFRICA_PARTIAL_VIEWS . '/team/_team.php';
            break;
        case 'press':
            include_once FILM_AFRICA_PARTIAL_VIEWS . '/press-release/press.php';
            break;
        case 'audience-awards':
            $taxonomy = 'audience-award';
            include_once FILM_AFRICA_PARTIAL_VIEWS . '/awards/_awards.php';
            break;
        case 'baobab-awards':
            $taxonomy = 'baobab-award';
            include_once FILM_AFRICA_PARTIAL_VIEWS . '/awards/_awards.php';
            break;
        case 'become-a-partner':
            include_once FILM_AFRICA_PARTIAL_VIEWS . '/support/become-a-partner.php';
            break;
        case 'donate':
            include_once FILM_AFRICA_PARTIAL_VIEWS . '/support/donate.php';
            break;
        case 'partner':
            include_once FILM_AFRICA_PARTIAL_VIEWS . '/support/partner.php';
            break;
        case 'join':
            include_once FILM_AFRICA_PARTIAL_VIEWS . '/support/join.php';
            break;
        case 'volunteer':
            include_once FILM_AFRICA_PARTIAL_VIEWS . '/support/volunteer.php';
            break;
        default:
            //
    }
}

//chnage the wordpress default search
add_action( 'template_redirect', function() {
    if ( is_search() && ! empty( $_GET['s'] ) ) {
        wp_redirect( home_url( "/search/" ) . urlencode( get_query_var( 's' ) ) );
        exit();
    }
} );

//the search form
add_filter('get_search_form', function ($form) {
    $form = '<form class="custom-container w-full flex flex-col md:flex-row pt-20 pb-6" action="' . home_url('/') . '">
              <input value="' . get_search_query() . '" type="text" name="s" id="search-query" placeholder="' . esc_attr__('Enter your search term here', 'film-africa-wp') . '"
              aria-label="search-query" class="bg-gray-1 border-gray-5 border text-lg px-10 py-7 md:rounded-bl-md rounded-tl-md rounded-tr-md md:rounded-tr-none w-full"
            >
            <button type="submit" class="bg-black-2 text-white py-7 px-24 rounded-br-md rounded-bl-md md:rounded-bl-none md:rounded-tr-md ">' . esc_attr__('Search', 'film-africa-wp') . '</button>
    </form>';

    return $form;
});

//hook into search results filter
add_action('pre_get_posts', function ($query) {
    if (!is_admin() && $query->is_main_query()) {
        if ($query->is_search) {
            //get the filter by search
            $allowed_post_types = ['posts', 'films', 'events', 'page', 'press'];
            $filter_by = isset($_GET['filter-by']) && $_GET['filter-by'] != '' ? $_GET['filter-by'] : $allowed_post_types;
            $see_more = isset($_GET['see-more']) ? $_GET['see-more'] : get_option('posts_per_page');
            $query->set('post_type', $filter_by);
            $query->set('posts_per_page', $see_more);
        }
    }
});

//automatically create some categories when you create a new posts
add_action('save_post', function ($post_id, $post) {
    $post_type = $post->post_type;
    $include_post_types = ['fallow_years', 'past_festivals'];
    if ('publish' == $post->post_status && in_array($post_type, $include_post_types)) {
        switch ($post_type) {
            case 'fallow_years':
                Utilities::get_instance()->auto_create_categories_content($post, ['fallow_years_category'], $post_type);
                break;
            default:
                Utilities::get_instance()->auto_create_categories_content($post, ['year_category'], $post_type);
        }
    }
}, 10, 2);

//hook into when deleting a new post
add_action('trashed_post', function ($post_id) {
    $post = get_post($post_id);
    $post_type = $post->post_type;
    switch ($post_type) {
        case 'fallow_years':
            Utilities::get_instance()->auto_delete_categories_content($post, ['fallow_years_category'], $post_type);
            break;
        default:
            Utilities::get_instance()->auto_delete_categories_content($post, ['year_category'], $post_type);
    }

}, 1, 1);

//Rest API to handle pagination
add_action('rest_api_init', 'register_rest_routes');
function register_rest_routes() {
    register_rest_route( FILM_AFRICA_API_BASE_ROUTE, '/whats-on/pages', array(
        'methods' => 'GET',
        'callback' => function($requests) {
            $paged = $requests->get_param('paged');
            $filter_by = $requests->get_param('filter_by');
            $location = $requests->get_param('location');
            $sub_category = $requests->get_param('sub_category');
            $current_date = $requests->get_param('current_date');
            return Pagination::get_instance()->get_all_whatson($filter_by, $location, $sub_category, $paged, $current_date);
        },
        'permission_callback' => '__return_true',
    ));

    register_rest_route( FILM_AFRICA_API_BASE_ROUTE, '/taxonomy/pages', array(
        'methods' => 'GET',
        'callback' => function($requests) {
            $paged = $requests->get_param('paged');
            $filter_by = $requests->get_param('filter_by');
            $taxonomy_name = $requests->get_param('taxonomy_name');
            $taxonomy = $requests->get_param('taxonomy');
            return Pagination::get_instance()->get_next_taxonomies($taxonomy_name, $taxonomy, $filter_by, $paged);
        },
        'permission_callback' => '__return_true',
    ));

    register_rest_route( FILM_AFRICA_API_BASE_ROUTE, '/search/pages', array(
        'methods' => 'GET',
        'callback' => function($requests) {
            $filter_by = $requests->get_param('filter_by');
            $s = $requests->get_param('s');
            $paged = $requests->get_param('paged');
            return Pagination::get_instance()->get_next_search_results($s, $filter_by, $paged);
        },
        'permission_callback' => '__return_true',
    ));

    register_rest_route( FILM_AFRICA_API_BASE_ROUTE, '/awards/pages', array(
        'methods' => 'GET',
        'callback' => function($requests) {
            $filter_by = $requests->get_param('filter_by');
            $paged = $requests->get_param('paged');
            $year_on = $requests->get_param('year_on');
            $taxonomy = $requests->get_param('taxonomy');
            return Pagination::get_instance()->get_awards($filter_by, $taxonomy, $paged, $year_on);
        },
        'permission_callback' => '__return_true',
    ));

    register_rest_route( FILM_AFRICA_API_BASE_ROUTE, '/news/pages', array(
        'methods' => 'GET',
        'callback' => function($requests) {
            $paged = $requests->get_param('paged');
            $category = $requests->get_param('categories');
            $festival_year = $requests->get_param('festival_year');
            return Pagination::get_instance()->get_all_news($category, $festival_year, $paged);
        },
        'permission_callback' => '__return_true',
    ));
}

/**
 * remove term descriptions from post editor
 */
function filmafrica_wp_hide_cat_descr() { ?>
    <style type="text/css">
        .term-description-wrap {
            display: none;
        }
    </style>

<?php }

add_action( 'admin_head-term.php', 'filmafrica_wp_hide_cat_descr' );
add_action( 'admin_head-edit-tags.php', 'filmafrica_wp_hide_cat_descr' );
