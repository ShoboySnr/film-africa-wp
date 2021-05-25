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
                $return_data[] = [
                    'title' => $press_release->post_title,
                    'details' => $press_release->post_content,
                    'slug' => $press_release->slug,
                    'date' => date('jS M Y', strtotime(get_field('press_date', $press_release->ID))),
                    'type'  => get_field('release_type', $press_release->ID),
                    'format'  => get_field('press_release_format', $press_release->ID),
                    'link'  => get_field('press_link', $press_release->ID),
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