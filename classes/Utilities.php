<?php

namespace FilmAfricaWP\classes;

class Utilities
{

    /**
     * @param $post_id
     * @param $category_type
     * @return array|mixed|null
     */
    public function return_category($post_id, $category_type = 'category')
    {
        $return_cat = [];
        $categories = get_the_terms($post_id, $category_type);

        if (!empty($categories)) {
            foreach ($categories as $category) {
                $return_cat[] = [
                    'id' => $category->term_id,
                    'title' => html_entity_decode($category->name),
                    'slug' => $category->slug,
                    'link' => get_term_link($category->term_id),
                ];
            }
        } else {
            return [];
        }

        return $return_cat[0];
    }

    public function return_taxonomies($post_id, $post_type)
    {
        $terms = [];

        $taxonomies = get_object_taxonomies($post_type);

        foreach ($taxonomies as $taxonomy) {
            $get_terms = get_the_terms($post_id, $taxonomy);
            if (!empty($get_terms)) {
                foreach ($get_terms as $get_term) {
                    if ($get_term->parent != 0) {
                        $parent_terms = get_term($get_term->parent);
                        $terms[] = [
                            'id' => $parent_terms->term_id,
                            'title' => $parent_terms->name,
                            'slug' => $parent_terms->slug,
                        ];
                    }
                }
            }
        }

        return array_unique($terms, SORT_REGULAR);
    }

    public function filter_custom_taxonomies()
    {
        return ['post_tag'];
    }

    public function get_post_taxonomy($post_id, $category_type)
    {
        $return_cat = [];
        $categories = get_the_terms($post_id, $category_type);

        if (!empty($categories)) {
            foreach ($categories as $category) {
                $return_cat[] = [
                    'id' => $category->term_id,
                    'title' => html_entity_decode($category->name),
                    'slug' => $category->slug,
                    'link'  => get_term_link($category->term_id),
                ];
            }
        } else {
            return [];
        }

        return $return_cat;
    }

    public function get_directors_cast_crew($post) {
        $return_post = [];

        for($count = 0; $count < 8; $count++) {
            $cast_name = get_field('cast_name_' . $count, $post);
            $details = get_field('details_' . $count, $post);
            $picture = '';
            if (isset($cast_name) && $cast_name != '') {
                $picture = get_field('picture_' . $count, $post);
            }

            if (!empty($cast_name)) {
                $return_post[] = [
                    'name' => $cast_name,
                    'picture' => $picture,
                    'details' => $details,
                ];
            }
        }

        return $return_post;
    }

    public function get_awards_posts($award_type)
    {
        $return_post = [];
        $args = [
            'post_type' => 'films',
            'numberposts' => -1,
            'ignore_sticky_posts' => false,
            'tax_query' => [
                [
                    'taxonomy' => 'awards_category',
                    'field' => 'slug',
                    'terms' => $award_type,
                ],
            ],
        ];

        $awards = get_posts($args);

        if (!empty($awards)) {
            foreach ($awards as $post) {
                $return_post['data'][] = [
                    'id' => $post->ID,
                    'title' => $post->post_title,
                    'link' => get_permalink($post->ID),
                    'category' => Utilities::get_instance()->return_category($post->ID, 'whats_on_category'),
                    'date' => date('jS M Y', strtotime(get_field('start_date', $post->ID))),
                    'location' => get_field('location', $post->ID),
                    'post_type' => $post->post_type,
                    'image' => apply_filters('apply_get_featured_image', $post->ID),
                ];
            }

            $return_post['count'] = count($awards);
        }

        return $return_post;
    }

    public function get_diff_awards($post_type, $award_type, $post_per_page = 1)
    {
        $return_post = [];
        $args = [
            'post_type' => $post_type,
            'post_per_page' => $post_per_page,
            'ignore_sticky_posts' => false,
            'tax_query' => [
                [
                    'taxonomy' => 'awards_category',
                    'field' => 'slug',
                    'terms' => $award_type,
                ],
            ],
        ];

        $posts = new \WP_Query($args);

        $max_num_pages = $posts->max_num_pages;

        $posts = $posts->posts;

        $return_post['data'] = [];

        if (!empty($posts)) {
            foreach ($posts as $post) {
                $return_post['data'][] = [
                    'id' => $post->ID,
                    'title' => $post->post_title,
                    'link' => get_permalink($post->ID),
                    'category' => Utilities::get_instance()->return_category($post->ID, 'awards_category'),
                    'date' => date('jS M Y', strtotime(get_field('start_date', $post->ID))),
                    'location' => get_field('location', $post->ID),
                    'post_type' => $post->post_type,
                    'image' => apply_filters('apply_get_featured_image', $post->ID),
                ];
            }
        }

        $return_post['max_num_pages'] = $max_num_pages;

        return $return_post;
    }

    //get the lists of terms
    public function get_terms_of_posts($taxonomy = 'category')
    {
        $return_cat = [];
        $args = [
            'taxonomy' => $taxonomy,
            'include_parent' => 0,
            'hide_empty' => true,
        ];

        $categories = get_terms($args);

        if (is_wp_error($categories)) {
            return [];
        }

        if (!empty($categories)) {
            foreach ($categories as $category) {
                $return_cat[] = [
                    'id' => $category->term_id,
                    'title' => $category->name,
                    'slug' => $category->slug,
                ];
            }
        }

        return $return_cat;
    }

    public function auto_create_categories_content($post, $taxonomy = [], $post_type = '')
    {
        $title = $post->post_title;
        $slug = $post->post_name;
        $post_type = get_post_type_object($post->post_type)->labels->name;
        $post_type_slug = get_post_type_object($post->post_type)->name;

        $parent_args = [
            'slug' => $slug,
            'parent' => 0,
            'description' => "Category generated from $post_type",
        ];

        $insert_term = false;
        //loop through the taxonomy
        if (!empty($taxonomy)) {
            foreach ($taxonomy as $taxon) {
                $insert_term = wp_insert_term($title, $taxon, $parent_args);
            }
            if (!$insert_term) {
                return false;
            }
        }

        return $insert_term;
    }

    /**
     * @param $post
     * @param array $taxonomy
     * @param string $post_type
     * @return false
     */
    public function auto_delete_categories_content($post, $taxonomy = [], $post_type = '')
    {
        $title = $post->post_title;
        $slug = $post->post_name;
        $post_type = get_post_type_object($post->post_type)->labels->name;
        $post_type_slug = get_post_type_object($post->post_type)->name;

        $parent_args = [
            'slug' => $slug,
            'parent' => 0,
            'description' => "Category generated from $post_type",
        ];

        $insert_term = false;
        //loop through the taxonomy
        if (!empty($taxonomy)) {
            foreach ($taxonomy as $taxon) {
                //get the term
                $get_term = get_term_by('slug', $slug, $taxon);
                wp_delete_term($get_term->term_id, $get_term->taxonomy);
                $insert_term = true;
            }
        }

        return $insert_term;
    }

    public function get_single_taxonomy($taxonomy, $post_type = 'past_festivals')
    {
        $return_post = [];
        $args = [
            'name' => $taxonomy,
            'post_type' => $post_type,
            'numberposts' => 1,
        ];

        $past_festivals = get_posts($args);

        if (!empty($past_festivals)) {
            $past_festivals = $past_festivals[0];

            $return_post = [
                'id' => $past_festivals->ID,
                'title' => $past_festivals->post_title,
                'content' => $past_festivals->post_content,
                'download_brochure' => get_field('download_brochure', $past_festivals->ID),
            ];
        }

        return $return_post;
    }

    public function get_year_category_posts($taxonomy, $taxonomy_name = 'category', $post_type = 'films', $sub_category = '', $sub_category_value = '', $posts_per_page = 6)
    {
        $return_post = [];
        $args = [
            'post_type' => $post_type,
            'posts_per_page' => $posts_per_page,
            'tax_query' => [
                [
                    'taxonomy' => $taxonomy_name,
                    'field' => 'slug',
                    'terms' => $taxonomy,
                ],
            ],
        ];

        if (!empty($sub_category_value)) {
            $sub_category_args = [
                'taxonomy' => $sub_category,
                'field' => 'slug',
                'terms' => $sub_category_value,
            ];

            $args['tax_query']['relation'] = 'AND';
            $args['tax_query'][] = array_merge($sub_category_args, $args['tax_query']);
        }

        $get_posts = new \WP_Query($args);

        $max_num_pages = $get_posts->max_num_pages;

        $get_posts = $get_posts->posts;

        $return_post['data'] = [];
        $return_post['count'] = 0;

        if (!empty($get_posts)) {
            foreach ($get_posts as $post) {
                $return_post['data'][] = [
                    'id' => $post->ID,
                    'title' => $post->post_title,
                    'link' => get_permalink($post->ID),
                    'category' => Utilities::get_instance()->return_category($post->ID, 'whats_on_category'),
                    'date' => date('jS M Y', strtotime(get_field('start_date', $post->ID))),
                    'location' => get_field('location', $post->ID),
                    'post_type' => $post->post_type == 'post' ? 'news' : $post->post_type,
                    'image' => apply_filters('apply_get_featured_image', $post->ID),
                ];
            }

            $return_post['count'] = count($get_posts);
        }

        $return_post['max_num_pages'] = $max_num_pages;

        return $return_post;
    }

    public function get_sub_taxonomy($taxonomy_slug, $taxonomy_name = 'category', $post_type = 'films', $taxonomy = 'year_category')
    {
        $return_cat = [];

        if (empty($post_type)) {
            $post_type = ['events', 'films'];
        }

        $posts_in_post_type = get_posts(array(
            'fields' => 'ids',
            'post_type' => $post_type,
            'posts_per_page' => -1,
            'tax_query' => [
                [
                    'taxonomy' => $taxonomy_name,
                    'field' => 'slug',
                    'terms' => $taxonomy_slug,
                ],
            ],
        ));

        $args = [
            'taxonomy' => $taxonomy,
            'include_parent' => 0,
        ];

        $categories = wp_get_object_terms($posts_in_post_type, $taxonomy);

        if (!empty($categories)) {
            foreach ($categories as $category) {
                $return_cat[] = [
                    'id' => $category->term_id,
                    'title' => $category->name,
                    'slug' => $category->slug,
                ];
            }
        };

        return $return_cat;
    }

    public function shorten_text($text, $number = 400) {
        if(strlen($text) < $number) {
            return $text;
        }

        return substr($text, 0, $number). ' […]';
    }


    /**
     * Singleton poop.
     *
     * @return Utilities|null
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