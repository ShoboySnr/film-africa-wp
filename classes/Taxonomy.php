<?php

namespace FilmAfricaWP\classes;

class Taxonomy {

    public function check_if_taxonomy_exists($taxonomy_name, $taxonomy, $post_type = 'post')
    {
        $args = [
            'post_type' => $post_type,
            'numberposts' => 1,
            'tax_query' => [
                [
                    'taxonomy' => $taxonomy,
                    'field' => 'slug',
                    'terms' => $taxonomy_name,
                ]
            ]
        ];

        $posts = get_posts($args);

        if (!empty($posts)) {
            return true;
        }

        return false;
    }


    public function get_all_whatson($taxonomy_name, $taxonomy, $post_type = 'events') {
        $return_post = [];

        $args = [
            'post_type'         => $post_type,
            'tax_query' => [
                [
                    'taxonomy' => $taxonomy,
                    'field' => 'slug',
                    'terms' => $taxonomy_name,
                ]
            ]

        ];

        $return_post['count'] = 0;
        $return_post['max_num_pages'] = 0;

        $posts = new \WP_Query($args);

        $max_num_pages = $posts->max_num_pages;

        $get_posts = $posts->posts;

        $return_post['data'] = [];
        if(!empty($get_posts)) {
            foreach($get_posts as $key => $post) {
                $post_thumbnail = ( has_post_thumbnail( $post->ID ) ) ? get_the_post_thumbnail_url( $post->ID ) : null;
                $return_post['data'][] =  [
                    'id'        => $post->ID,
                    'title'     => $post->post_title,
                    'link'      => get_permalink($post->ID),
                    'category'  => Utilities::get_instance()->return_category($post->ID, 'whats_on_category'),
                    'date'      => date('jS M Y', strtotime(get_field('start_date', $post->ID))),
                    'location'  => Utilities::get_instance()->return_category($post->ID, 'location_category'),
                    'post_type' => $post->post_type,
                    'image'     => apply_filters('apply_get_featured_image', $post->ID),
                    'day'       => date('d', strtotime(get_field('start_date', $post->ID))),
                    'month'       => date('n', strtotime(get_field('start_date', $post->ID))),
                    'year'       => date('Y', strtotime(get_field('start_date', $post->ID))),
                ];
            }

            $return_post['count'] = count($get_posts);
        }

        $return_post['max_num_pages'] = $max_num_pages;

        return $return_post;
    }

    /**
     * Singleton poop.
     *
     * @return Taxonomy|null
     */
    public static function get_instance()
    {
        static $instance = null;

        if (is_null($instance)) {
            $instance = new self();
        }

        return $instance;
    }
}