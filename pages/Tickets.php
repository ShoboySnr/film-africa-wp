<?php

namespace FilmAfricaWP\pages;

use FilmAfricaWP\classes\Utilities;

class Tickets {

    /**
     * @return array
     */
    public function get_all_tickets() {
        $return_data = [];
        $args = [
            'post_type'     => 'tickets',
            'numberposts'   => -1,
        ];

        $get_tickets = get_posts($args);

        if(!empty($get_tickets)) {
            foreach ($get_tickets as $post) {
                $post_thumbnail = ( has_post_thumbnail( $post->ID ) ) ? get_the_post_thumbnail_url( $post->ID ) : null;
                $return_data[] = [
                    'id'                    => $post->ID,
                    'slug'                  => $post->post_name,
                    'title'                 => $post->post_title,
                    'image'                 => $post_thumbnail,
                    'book_link'             => get_field('book_link', $post->ID),
                ];
            }
        }

        return $return_data;
    }


    /**
     * Singleton poop.
     *
     * @return Tickets|null
     */
    public static function get_instance() {
        static $instance = null;

        if (is_null($instance)) {
            $instance = new self();
        }

        return $instance;
    }
}