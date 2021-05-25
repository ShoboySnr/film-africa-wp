<?php

namespace FilmAfricaWP\pages;

use FilmAfricaWP\classes\Utilities;

class FallowYears {

    public function get_all_fallow_years() {
        $return_data = [];
        $args = [
            'post_type'     => 'fallow_years',
            'numberposts'   => -1
        ];

        //get the lists of posts
        $get_posts = get_posts($args);

        if(!empty($get_posts)) {
            foreach ($get_posts as $post) {
                $post_thumbnail = ( has_post_thumbnail( $post->ID ) ) ? get_the_post_thumbnail_url( $post->ID ) : null;
                $terms = get_term_by('slug', $post->post_name, 'fallow_years_category');
                $return_data[] =  [
                    'id'                    => $post->ID,
                    'slug'                  => $post->post_name,
                    'title'                 => $post->post_title,
                    'image'                 => $post_thumbnail,
                    'link'                  => get_term_link($terms),
                ];
            }
        }
        
        return $return_data;
    }


    /**
     * Singleton poop.
     *
     * @return FallowYears|null
     */
    public static function get_instance() {
        static $instance = null;

        if (is_null($instance)) {
            $instance = new self();
        }

        return $instance;
    }
}