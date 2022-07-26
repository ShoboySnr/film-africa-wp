<?php

namespace FilmAfricaWP\pages;

use FilmAfricaWP\classes\Utilities;

class PastsFestivals {

    public function get_all_pasts_festivals()  {
        $return_data = [];
        $args = [
            'post_type'     => 'past_festivals',
            'numberposts'   => -1,
            'show_empty'    => false,
        ];

        //get the lists of posts
        $get_posts = get_posts($args);

        if(!empty($get_posts)) {
            foreach ($get_posts as $post) {
                $post_thumbnail = ( has_post_thumbnail( $post->ID ) ) ? get_the_post_thumbnail_url( $post->ID ) : null;
                $terms = get_term_by('slug', $post->post_name, 'year_category');

                if(false == $terms) $terms = ''; else $terms = get_term_link($terms);

                $return_data[] =  [
                    'id'                    => $post->ID,
                    'title'                 => $post->post_title,
                    'image'                 => $post_thumbnail,
                    'link'                  => $terms,
                ];
            }
        }

        return $return_data;
    }

    public function get_year_category_posts($taxonomy, $post_type = 'films', $sub_category = '', $sub_category_value = '', $post_per_page = 6) {
        $return_post = [];
        $args = [
            'post_type'     => $post_type,
            'posts_per_page'   => $post_per_page,
            'tax_query'     => [
                [
                    'taxonomy'      => 'year_category',
                    'field'         => 'slug',
                    'terms'         => $taxonomy
                ]
            ]
        ];

        if(!empty($sub_category_value)) {
            $sub_category_args = [
                'taxonomy'      => $sub_category,
                'field'         => 'slug',
                'terms'         => $sub_category_value
            ];

            $args['tax_query']['relation'] = 'AND';
            $args['tax_query'][] = array_merge($sub_category_args, $args['tax_query']);
        }

        $get_posts = new \WP_Query($args);

        $max_num_pages = $get_posts->max_num_pages;

        $get_posts = $get_posts->posts;

        $return_post['data'] = [];
        $return_post['count'] = 0;

        if(!empty($get_posts)) {
            foreach ($get_posts as $post) {
                $return_post['data'][] =  [
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

            $return_post['count'] = count($get_posts);
        }

        $return_post['max_num_pages'] = $max_num_pages;

        return $return_post;
    }

    public function get_sub_taxonomy( $taxonomy_slug, $post_type = 'films', $taxonomy = 'year_category', $taxonomy_name = 'year_category') {
        $return_cat = [];

        if (empty($post_type)) $post_type = ['events', 'films'];
        $posts_in_post_type = get_posts( array(
            'fields' => 'ids',
            'post_type' => $post_type,
            'posts_per_page' => -1,
            'tax_query'     => [
                [
                    'taxonomy'      => $taxonomy_name,
                    'field'         => 'slug',
                    'terms'         => $taxonomy_slug
                ]
            ]
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

    public function get_single_festival($taxonomy, $taxonomy_name = 'year_category', $post_type = 'past_festivals') {
        $return_post = [];
        $args = [
            'post_type'     => $post_type,
            'numberposts'   => 1,
            'tax_query'     => [
                [
                    'taxonomy'      => $taxonomy_name,
                    'field'         => 'slug',
                    'terms'         => $taxonomy
                ]
            ]
        ];

        $past_festivals = get_posts($args);

        if(!empty($past_festivals)) {
            $past_festivals = $past_festivals[0];

            $return_post = [
                'id'        => $past_festivals->ID,
                'title'     => $past_festivals->post_title,
                'content'   => $past_festivals->post_content,
                'download_brochure' => get_field('download_brochure', $past_festivals->ID),
            ];
        }

        return $return_post;
    }

    /**
     * Singleton poop.
     *
     * @return PastsFestivals|null
     */
    public static function get_instance() {
        static $instance = null;

        if (is_null($instance)) {
            $instance = new self();
        }

        return $instance;
    }
}