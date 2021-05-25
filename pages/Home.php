<?php

namespace FilmAfricaWP\pages;

use FilmAfricaWP\classes\Utilities;

class Home {

    public function __construct()
    {

    }

    /**
     * @return array
     *
     */
    public function get_home_fields() {
        $home_data = [];

        $home_data['hero_sliders'] = $this->get_hero_sliders();
        $home_data['past_festivals'] = $this->get_past_festivals();
        $home_data['whats_on'] = $this->get_whats_on();
        $home_data['news'] = $this->get_news();
        $home_data['awards_section'] = $this->get_awards_section();


        return $home_data;
    }

    /**
     * @return array
     */
    public function get_hero_sliders() {
        $sliders = [];
        for($count = 1; $count <= 5; $count++) {
            $slider_image = get_field('slider_image_'.$count);
            if(!empty($slider_image)) {
                $sliders[] = get_field('slider_image_' . $count);
            }

        }

        return array_filter($sliders);
    }

    /**
     * @return mixed|void
     */
    public function get_past_festivals() {
        $args = [
            'post_type'     =>  'past_festivals',
            'numberposts'   => 3,
        ];

        $posts = get_posts($args);

        return apply_filters('filter_posts_to_return_title_images_link', $posts);
    }


    /**
     * @return array
     */
    public function get_whats_on() {
        $return_data = [];
        $args = [
            'post_type'     => ['events', 'films'],
            'numberposts'   => 4,
            'meta_key'      => 'start_date',
            'order_by'      => 'meta_value'
        ];

        $posts = get_posts($args);

        if(!empty($posts)) {
            foreach ($posts as $post) {

                $return_data['whats_on'][] = [
                    'id'        => $post->ID,
                    'title'     => $post->post_title,
                    'link'      => get_permalink($post->ID),
                    'category'  => Utilities::get_instance()->return_category($post->ID, 'whats_on_category'),
                    'date'      => date('jS M Y', strtotime(get_field('start_date', $post->ID))),
                    'location'  => Utilities::get_instance()->return_category($post->ID, 'location_category'),
                    'post_type' => $post->post_type,
                    'image'     => apply_filters('apply_get_featured_image', $post->ID),
                ];
            }
        }

        $return_data['see_more'] = get_permalink(get_page_by_path('whats-on'));

        return $return_data;
    }

    public function get_news() {
        $return_data = [];
        $args = [
            'numberposts'   => 3,
        ];

        $posts = get_posts($args);

        if(!empty($posts)) {
            foreach ($posts as $post) {

                $return_data['news'][] = [
                    'id'        => $post->ID,
                    'title'     => $post->post_title,
                    'link'      => get_permalink($post->ID),
                    'category'  => Utilities::get_instance()->return_category($post->ID, 'category'),
                    'image'     => apply_filters('apply_get_featured_image', $post->ID),
                ];
            }
        }

        $return_data['see_more'] = get_permalink(get_option('page_for_posts' ));

        return $return_data;
    }

    public function get_awards_section() {
        return [
            'baobab_awards_title'   => get_field('baobab_awards_title'),
            'baobab_awards_details'   => get_field('baobab_awards_details'),
            'baobab_link'   => get_field('baobab_link'),
            'audience_awards_title'   => get_field('audience_awards_title'),
            'audience_awards_details'   => get_field('audience_awards_details'),
            'audience_link'   => get_field('audience_link'),
        ];
    }


    /**
     * Singleton poop.
     *
     * @return Home|null
     */
    public static function get_instance() {
        static $instance = null;

        if (is_null($instance)) {
            $instance = new self();
        }

        return $instance;
    }
}