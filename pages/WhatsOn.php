<?php

namespace FilmAfricaWP\pages;

use FilmAfricaWP\classes\Utilities;


class WhatsOn {

    public function get_all_whatson($post_type = ['events', 'films'], $location = '', $subcategory_filter = '', $start_date = '') {
        $return_post = [];

        if (empty($post_type) || $post_type == 'calender') $post_type = ['events', 'films'];

        $args = [
            'post_type'         => $post_type,
            'tax_query'         => [],
        ];

        if(!empty($start_date)) {
            $args['meta_key'] = 'start_date';
            $args['meta_value'] = date('Y-m-d', $start_date);
            $args['meta_compare'] = '=';
            $args['meta_type'] = 'DATE';
            $args['meta_orderby'] = 'meta_value';
            $args['meta_order'] = 'DESC';
        }

        if(!empty($location)) {
            $location_args = [
                [
                    'taxonomy'      => 'location_category',
                    'field'         => 'slug',
                    'terms'         => $location
                ],
            ];

            $args['tax_query'] = array_merge($location_args, $args['tax_query']);
        }

        if(!empty($subcategory_filter)) {
            $subcategory_filter_args = [
                [
                    'taxonomy'      => 'whats_on_category',
                    'field'         => 'slug',
                    'terms'         => $subcategory_filter
                ],
            ];

            $args['tax_query'] = array_merge($subcategory_filter_args, $args['tax_query']);
        }

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

    public function get_sub_taxonomy($taxonomy = 'category', $post_type = ['events', 'films']) {
        $return_cat = [];

        if (empty($post_type)) $post_type = ['events', 'films'];
        $posts_in_post_type = get_posts( array(
            'fields' => 'ids',
            'post_type' => $post_type,
            'posts_per_page' => -1,
        ) );

        $args = [
            'taxonomy'          => $taxonomy,
            'include_parent'    => 0,
        ];

        $categories = wp_get_object_terms($posts_in_post_type, $taxonomy);

        if(!empty($categories)) {
            foreach($categories as $category) {
                $return_cat[] = [
                    'id' => $category->term_id,
                    'title' => $category->name,
                    'slug' => $category->slug,
                ];
            }
        };

        return $return_cat;
    }

    public function get_related_films($post) {
        $return_post = [];

        $args = [
            'post__not_in' => [$post->ID],
            'post_type'      => 'films',
            'posts_per_page'  => 3,
            'ignore_sticky_posts' => 1
        ];

        $get_posts = get_posts($args);

        if(!empty($get_posts)) {
            foreach ($get_posts as $post) {
                $return_post[] =  [
                    'id'        => $post->ID,
                    'title'     => $post->post_title,
                    'link'      => get_permalink($post->ID),
                    'category'  => Utilities::get_instance()->return_category($post->ID, 'whats_on_category'),
                    'date'      => date('jS M Y', strtotime(get_field('start_date', $post->ID))),
                    'location'  => get_field('location', $post->ID),
                    'post_type' => $post->post_type,
                    'image'     => apply_filters('apply_get_featured_image', $post->ID),
                ];
            }
        }

        return $return_post;
    }


    /**
     * Singleton poop.
     *
     * @return WhatsOn|null
     */
    public static function get_instance() {
        static $instance = null;

        if (is_null($instance)) {
            $instance = new self();
        }

        return $instance;
    }
}