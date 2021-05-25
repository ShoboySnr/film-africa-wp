<?php

namespace FilmAfricaWP\pages;


class Team {

    public function get_teams() {
        $return_team = [];
        $args = [
            'post_type'     => 'team',
            'numberposts'   => -1
        ];

        $get_teams = get_posts($args);

        if(!empty($get_teams)) {
            foreach ($get_teams as $key => $get_team) {
                $post_thumbnail = ( has_post_thumbnail( $get_team->ID ) ) ? get_the_post_thumbnail_url( $get_team->ID ) : null;
                $return_team[] = [
                    'title'         => $get_team->post_title,
                    'position'      => get_field('team_position', $get_team->ID),
                    'image'         => $post_thumbnail,
                    'details'       => $get_team->post_content,
                ];
            }
        }


        return $return_team;
    }

    /**
     * Singleton poop.
     *
     * @return Team|null
     */
    public static function get_instance() {
        static $instance = null;

        if (is_null($instance)) {
            $instance = new self();
        }

        return $instance;
    }
}