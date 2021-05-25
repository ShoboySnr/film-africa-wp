<?php

namespace FilmAfricaWP\classes;

class Pagination {

    public function get_all_whatson($post_type = ['events', 'films'], $location = '', $subcategory_filter = '', $paged = 1, $start_date = '') {
        $return_post = [];

        if (empty($post_type) || $post_type == 'calender') $post_type = ['events', 'films'];

        $args = [
            'post_type'         => $post_type,
            'paged'             => $paged,
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
                    'post_type' => ucfirst($post->post_type),
                    'image'     => apply_filters('apply_get_featured_image', $post->ID),
                    'day'       => date('d', strtotime(get_field('start_date', $post->ID))),
                    'month'       => date('n', strtotime(get_field('start_date', $post->ID))),
                    'year'       => date('Y', strtotime(get_field('start_date', $post->ID))),
                ];
            }

            $return_post['count'] = count($get_posts);
        }

        $return_post['max_num_pages'] = $max_num_pages;

        return wp_send_json_success($return_post);
    }

    public function get_next_search_results($s, $filter_by = ['posts', 'films', 'events', 'page', 'press'], $paged = 1) {
        $return_post = [];

        global $wp_query;

        if(empty($filter_by)) {
            $filter_by = ['posts', 'films', 'events', 'page', 'press'];
        }

        $args = [
            'post_type'     => $filter_by,
            'paged'         => $paged,
            's'             => $s,
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
                $category = Utilities::get_instance()->return_category($post->ID, 'whats_on_category');
                if($post->post_type == 'post') {
                    $category = Utilities::get_instance()->return_category($post->ID, 'category');
                }

                $post_type = $post->post_type;
                if($post_type === 'page') $post_type = 'Web Page';
                if($post_type == 'post') $post_type = 'News';

                $return_post['data'][] =  [
                    'id'        => $post->ID,
                    'title'     => $post->post_title,
                    'excerpt'     => strip_tags($post->post_excerpt),
                    'content'     => Utilities::get_instance()->shorten_text(strip_tags($post->post_content)),
                    'link'      => get_permalink($post->ID),
                    'category'  => $category,
                    'date'      => date('jS M Y', strtotime(get_field('start_date', $post->ID))),
                    'location'  => Utilities::get_instance()->return_category($post->ID, 'location_category'),
                    'post_type' => ucfirst($post_type),
                    'image'     => apply_filters('apply_get_featured_image', $post->ID),
                    'day'       => date('d', strtotime(get_field('start_date', $post->ID))),
                    'month'       => date('n', strtotime(get_field('start_date', $post->ID))),
                    'year'       => date('Y', strtotime(get_field('start_date', $post->ID))),
                    'press_release_format'  => ucfirst(get_field('press_release_format', $post->ID)),
                    'press_date'  => date('j M Y', strtotime(get_field('press_date', $post->ID)))
                ];
            }

            $return_post['count'] = count($get_posts);
        }

        $return_post['max_num_pages'] = $max_num_pages;



        return wp_send_json_success($return_post);
    }

    public function get_awards($award, $award_category = '', $paged = 1, $year_only = false)
    {
        $return_post = [];
        $args = [
            'post_type' => $award,
            'paged' => $paged,
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

        return wp_send_json_success($return_post);
    }

    public function get_all_news($category, $festival_year, $paged = 1) {
        $return_post = [];
        $args = [
            'post_type'           => 'post',
            'ignore_sticky_posts' => 1,
            'tax_query'           => [],
            'paged'             => $paged,
            'order'				=> 'DESC',
        ];

        if(!empty($category)) {
            $sub_category_args = [
                [
                    'taxonomy'      => 'category',
                    'field'         => 'slug',
                    'terms'         => $category
                ]
            ];
            $args['tax_query'][] = array_merge($sub_category_args, $args['tax_query']);
        }

        if(!empty($festival_year)) {
            $sub_category_args = [
                [
                    'taxonomy'  => 'year_category',
                    'field'     => 'slug',
                    'terms'     => $festival_year
                ]
            ];
            $args['tax_query'][] = array_merge($sub_category_args, $args['tax_query']);
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
                    'id'                    => $post->ID,
                    'slug'                  => $post->post_name,
                    'title'                 => $post->post_title,
                    'image'                 => $post_thumbnail,
                    'summary'               => empty($post->post_excerpt) ? wp_trim_words($post->post_content, 15, '...') : $post->post_excerpt,
                    'category'              => Utilities::get_instance()->return_category($post->ID),
                    'link'                  => get_permalink($post->ID),
                ];
            }

            $return_post['count'] = count($get_posts);
        }

        $return_post['max_num_pages'] = $max_num_pages;

        return wp_send_json_success($return_post);
    }

    /**
     * Singleton poop.
     *
     * @return Pagination|null
     */
    public static function get_instance() {
        static $instance = null;

        if (is_null($instance)) {
            $instance = new self();
        }

        return $instance;
    }
}