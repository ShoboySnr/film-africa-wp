<?php

namespace FilmAfricaWP\classes;

use Walker_Page;

class SupportMenuWalker extends Walker_Page
{

    public function start_el(&$output, $page, $depth = 0, $args = array(), $current_page = 0)
    {
        $checked = '';
        if($current_page == $page->ID) $checked = 'checked';
        $output .= sprintf('<input class="hidden tab" type="radio" name="filter-by" id="%s"'.$checked.'><label class="cursor-pointer text-2xl font-extrabold flex-shrink-0" for="%s"
                    ><a href="%s">%s</a></label>', $page->post_name, $page->post_name, get_permalink($page->ID),  apply_filters('the_title', $page->post_title, $page->ID));
    }

}