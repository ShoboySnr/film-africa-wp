<?php
namespace FilmAfricaWP\classes;

use Walker_Page;

class SubMenuWalker extends Walker_Page {

    public function start_el(&$output, $page, $depth = 0, $args = array(), $current_page = 0)
    {
        $output .= sprintf('<a href="%s" class="btn-link">%s</a><hr class="text-gray-5 w-4 lg:h-4 border-t-2 lg:border-t-0 lg:border-r-2">',
            get_permalink($page->ID),
            apply_filters( 'the_title', $page->post_title, $page->ID)
        );
    }

}