<?php

namespace FilmAfricaWP\pages;

class Partners
{

    public function get_partners($filter_by_partners = '', $sub_category = '')
    {
        $return_data = [];
        $args = [
            'post_type'     => 'partners',
            'numberposts'   => -1,
            'tax_query'     => [],
        ];

        if (!empty($filter_by_partners)) {
            $partner_args = [
                'taxonomy' => 'partners_year_category',
                'field' => 'slug',
                'terms' => $filter_by_partners,
            ];

            $args['tax_query'][] = array_merge($args['tax_query'], $partner_args);
        }

        if (!empty($sub_category)) {
            $partner_args = [
                'taxonomy' => 'partner_category',
                'field' => 'slug',
                'terms' => $sub_category,
            ];

            $args['tax_query'][] = array_merge($args['tax_query'], $partner_args);
        }

        if(!empty($sub_category) && !empty($filter_by_partners)) {
            $args['tax_query']['relation'] = 'AND';
        }

        $get_all_partners = get_posts($args);

        if (!empty($get_all_partners)) {
            foreach ($get_all_partners as $post) {
                $post_thumbnail = (has_post_thumbnail($post->ID)) ? get_the_post_thumbnail_url($post->ID) : null;

                $return_data[] = [
                    'title' => $post->post_title,
                    'images' => $post_thumbnail,
                ];
            }

        }

        return $return_data;
    }

    /**
     * Singleton poop.
     *
     * @return Partners|null
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