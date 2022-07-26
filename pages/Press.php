<?php

namespace FilmAfricaWP\pages;

class Press
{

    public function get_press_release($filter_by_year = '', $release_type = '')
    {
        $return_data = [];
        $args = [
            'post_type' => 'press',
            'numberposts' => -1,
        ];

        if (!empty($filter_by)) {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'year_category',
                    'field' => 'slug',
                    'terms' => $filter_by_year,
                ],
            ];
        }

        if (!empty($release_type)) {
            $args['meta_key'] = 'release_type';
            $args['meta_value'] = $release_type;
            $args['meta_compare'] = '=';
        }

        $press_releases = get_posts($args);

        if (!empty($press_releases)) {
            foreach ($press_releases as $press_release) {
                $link = get_field('press_link', $press_release->ID);
                if($release_type == 'coverage') {
                    $link = get_permalink($press_release->ID);
                }
                $post_thumbnail = ( has_post_thumbnail( $press_release->ID ) ) ? get_the_post_thumbnail_url( $press_release->ID ) : null;
                $return_data[] = [
                    'title' => $press_release->post_title,
                    'details' => empty($press_release->post_excerpt) ? wp_trim_words($press_release->post_content, 20, '...') : $press_release->post_excerpt,
                    'slug' => $press_release->slug,
                    'date' => get_field('press_date', $press_release->ID),
                    'type'  => get_field('release_type', $press_release->ID),
                    'format'  => get_field('press_release_format', $press_release->ID),
                    'link'  => $link,
                    'image'  => $post_thumbnail
                ];
            }
        }

        return $return_data;
    }

    /**
     * Singleton poop.
     *
     * @return Press|null
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