<?php

namespace FilmAfricaWP\pages;

use FilmAfricaWP\classes\Utilities;

class Awards {

    public function get_awards($award, $award_category = '', $paged = 1, $year_only = false)
    {
        $return_post = [];
        $args = [
            'post_type' => $award,
            'paged' => 1,
            'tax_query' => [],
        ];

        if(!empty($award_category)) {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'awards_category',
                    'field' => 'slug',
                    'terms' => $award_category,
                ]
            ];
        }

        $get_awards = new \WP_Query($args);

        $max_num_pages = $get_awards->max_num_pages;

        $get_awards = $get_awards->posts;

        $return_post['count'] = 0;
        $return_post['data'] = [];

        if(!empty($get_awards)) {
            foreach ($get_awards as $post) {
                $post_thumbnail = ( has_post_thumbnail( $post->ID ) ) ? get_the_post_thumbnail_url( $post->ID ) : null;

                $date = date('jS M Y', strtotime(get_field('start_date', $post->ID)));
                if($year_only) {
                    $date = date('Y', strtotime(get_field('start_date', $post->ID)));
                }

                $return_post['data'][] =  [
                    'id'        => $post->ID,
                    'title'     => $post->post_title,
                    'link'      => get_permalink($post->ID),
                    'category'  => Utilities::get_instance()->return_category($post->ID, 'whats_on_category'),
                    'date'      => $date,
                    'location'  => Utilities::get_instance()->return_category($post->ID, 'location_category'),
                    'post_type' => '',
                    'image'     => apply_filters('apply_get_featured_image', $post->ID),
                ];
            }

            $return_post['count'] = count($get_awards);
        }

        $return_post['max_num_pages'] = $max_num_pages;

        return $return_post;
    }


    /**
     * Singleton poop.
     *
     * @return Awards|null
     */
    public static function get_instance() {
        static $instance = null;

        if (is_null($instance)) {
            $instance = new self();
        }

        return $instance;
    }
}