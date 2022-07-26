<?php

namespace FilmAfricaWP\pages;

use FilmAfricaWP\classes\Utilities;

class News {

    public function get_news($post_per_page = 6, $sticky = 0, $category = '', $festival_year = '') {
        $return_post = [];
        $args = [
            'posts_per_page'   => $post_per_page,
            'post__not_in'    => $sticky,
            'ignore_sticky_posts' => 1,
            'tax_query'           => [],
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


        $posts = new \WP_Query($args);

        $max_num_pages = $posts->max_num_pages;

        $posts = $posts->posts;

        $return_post['data'] = [];
        $return_post['count'] = 0;

        if(!empty($posts)) {
            foreach ($posts as $post) {
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

            $return_post['count'] = count($posts);
        }

        $return_post['max_num_pages'] = $max_num_pages;

        return $return_post;

    }

    public function get_sticky_posts() {
        $return_post = [];
        $get_sticky_posts = get_option( 'sticky_posts' );
        $sticky_args = [
            'numberposts'  => 1,
            'post__in'        => $get_sticky_posts,
            'ignore_sticky_posts' => 0,
        ];

        $sticky_posts = get_posts($sticky_args);

        if(!empty($sticky_posts) && isset($sticky_posts[0])) {
            $sticky_posts = $sticky_posts[0];

            $post_thumbnail = ( has_post_thumbnail( $sticky_posts->ID ) ) ? get_the_post_thumbnail_url( $sticky_posts->ID ) : null;
            $return_post =  [
                'id'                    => $sticky_posts->ID,
                'slug'                  => $sticky_posts->post_name,
                'title'                 => $sticky_posts->post_title,
                'image'                 => $post_thumbnail,
                'summary'               => empty($sticky_posts->post_excerpt) ? wp_trim_words($sticky_posts->post_content, 15, '...') : $sticky_posts->post_excerpt,
                'category'              => Utilities::get_instance()->return_category($sticky_posts->ID),
                'link'                  => get_permalink($sticky_posts->ID),
            ];
        }

        return $return_post;
    }


    public function get_categories() {
        $data = [];

        $categories = $this->get_categories();

        if(!empty($categories)) {
            foreach($categories as $category) {
                $data[] = [
                    'id' => $category->term_id,
                    'title' => html_entity_decode($category->name),
                    'slug' => $category->slug,
                ];
            }
        } else return [];

        return $data;
    }

    public function get_related_news($post) {
        $return_post = [];

        $args = [
            'post__not_in' => [$post->ID],
            'post_type'      => 'post',
            'posts_per_page'  => 3,
            'ignore_sticky_posts' => 1
        ];

        $get_posts = get_posts($args);

        if(!empty($get_posts)) {
            foreach ($get_posts as $post) {
                $post_thumbnail = ( has_post_thumbnail( $post->ID ) ) ? get_the_post_thumbnail_url( $post->ID ) : null;
                $return_post[] =  [
                    'id'                    => $post->ID,
                    'slug'                  => $post->post_name,
                    'title'                 => $post->post_title,
                    'image'                 => $post_thumbnail,
                    'summary'               => empty($post->post_excerpt) ? wp_trim_words($post->post_content, 15, '...') : $post->post_excerpt,
                    'category'              => Utilities::get_instance()->return_category($post->ID),
                    'link'                  => get_permalink($post->ID),
                ];
            }
        }

        return $return_post;
    }

    /**
     * Singleton poop.
     *
     * @return News|null
     */
    public static function get_instance() {
        static $instance = null;

        if (is_null($instance)) {
            $instance = new self();
        }

        return $instance;
    }
}