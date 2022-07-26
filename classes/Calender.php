<?php

namespace FilmAfricaWP\classes;

use FilmAfricaWP\pages\WhatsOn;

class Calender {

    public function get_calender($post_type = ['events', 'films']) {
        $return_data = [];
        $args = [
            'post_type'         => $post_type,
            'meta_key'          => 'start_date',
            'meta_compare'      =>  '>',
            'meta_type'         => 'DATE',
            'meta_value'        => date ('2011-01-01'), //set this as a comparison that if date is greater than date('2011-01-01')
            'posts_per_page'    => -1,
            'orderby'           => 'meta_value',
            'order'             => 'DESC'
        ];

        $get_posts = new \WP_Query($args);

        if(!empty($get_posts)) {
            foreach($get_posts as $key => $post) {
                $start_date = get_field('start_date', $post->ID);

                //assign the value of the events month
                $start_month = date('F Y', strtotime($start_date));

                $return_data[] = [
                    'name'      => $start_month,
                    'value'     => strtotime($start_month),
                ];
            }
        }

        return $return_data;
    }

    public function draw_calender($date = '') {
        if(empty($date)) $date = date('01-m-Y');

        $year = date('Y', strtotime($date));
        $month = date('n', strtotime($date));

        $html = '<div id="v-cal-body" class="cal-week pt-3 text-black-2 text-xs font-semibold bg-white border-1-5">';

        //table heading
        $headings = array('Su', 'Mo','Tu','We','Th','Fr','Sa');
        $html  .= '<span class="vcal-day">'.implode('</span><span class="vcal-day">', $headings).'</span>';

        //current or running days
        $running_day = date('w',mktime(0,0,0,$month,1,$year));
        $days_in_month = date('t',mktime(0,0,0,$month,1,$year));
        $previous_month_days = $month != 1 ? date('t', mktime(0,0,0,$month-1,1,$year)) : date('t', mktime(0,0,0,12,1,$year-1));
        $next_month_days = $month < 12 ? date('t', mktime(0,0,0,$month+1,1,$year)) : date('t', mktime(0,0,0,1,1,$year+1));
        $days_in_this_week = 1;
        $day_counter = 0;
        $dates_array = array();

        //what's on lists
        $sub_category = $_GET['subcategory-filter'] ?? '';
        $filter_by = $_GET['filter-by'] ?? '';
        $location = $_GET['location'] ?? '';
        $see_more = $_GET['see-more'] ?? get_option('posts_per_page');

        $whats_on = WhatsOn::get_instance()->get_all_whatson($filter_by, $location, $sub_category, '');
        $whats_on = $whats_on['data'];

        /* print "blank" days until the first of the current week */
        for($x = $running_day; $x > 0; $x--) {
            $day_diff = $previous_month_days - $x;
            $begin_loop = '';
            $end_loop = '';
            $selected = '';
            foreach ($whats_on as $post) {
                if ($post['day'] == ($day_diff + 1) && $post['month'] == $month - 1 && $post['year'] == $year) {
                    $add_date_query = add_query_arg([
                        'date'   => strtotime($post['date']),
                    ]);
                    $begin_loop = "<a href='$add_date_query'>";
                    $end_loop = "</a>";
                    $selected = ' vcal-date--selected';
                    break;
                }
            }
            $html .= sprintf('<div class="vcal-date'. $selected.'">%s'. ($day_diff + 1) .'%s</div>', $begin_loop, $end_loop);

            $days_in_this_week++;
        }


        /* keep going with days.... */
        for($list_day = 1; $list_day <= $days_in_month; $list_day++) {
            $begin_loop = '';
            $end_loop = '';
            $selected = '';
            foreach ($whats_on as $post) {
                if ($post['day'] == $list_day && $post['month'] == $month && $post['year'] == $year) {
                   $add_date_query = add_query_arg([
                       'date'   => strtotime($post['date']),
                   ]);
                    $begin_loop = "<a href='$add_date_query'>";
                    $end_loop = "</a>";
                   $selected = ' vcal-date--selected';
                    break;
                }
            }
            $html .= sprintf('<div class="vcal-date'. $selected.'">%s'.$list_day.'%s</div>', $begin_loop, $end_loop);

            if($running_day == 6) {
                $running_day = -1;
                $days_in_this_week = 0;
            }

            $days_in_this_week++; $running_day++; $day_counter++;
        }

        // finish the rest of the days
        if($days_in_this_week < 8) {
            $month = $month != 12 ? $month + 1 : 1;
            $begin_loop = '';
            $end_loop = '';
            $selected = '';
            for($x = 1; $x <= (8 - $days_in_this_week); $x++) {
                foreach ($whats_on as $post) {
                    if ($post['day'] == $x && $post['month'] == $month && $post['year'] == $year) {
                        $add_date_query = add_query_arg([
                            'date'   => strtotime($post['date']),
                        ]);
                        $begin_loop = "<a href='$add_date_query'>";
                        $end_loop = "</a>";
                        $selected = ' vcal-date--selected';
                        break;
                    }
                }
                $html .= sprintf('<div class="vcal-date'. $selected.'">%s'.$x.'%s</div>', $begin_loop, $end_loop);
            }
        }

        $html .= '</div><div class="cal-body border" data-calendar-area="month"></div>';

        return $html;
    }

    public function show_calender($post_type = ['events', 'films'], $post_per_page = 6, $get_date = '', $sub_category = '') {
        $return_data = [];
        $args = [
            'post_type'         => $post_type,
            'posts_per_page'    => $post_per_page,
            'meta_key'          => 'start_date',
            'order'             => 'DESC',
            'meta_compare'      => '>=',
            'meta_value'        => $get_date != '' ? date('d/n/Y', $get_date) : strtotime('first day of ' . date( 'n Y')),
            'meta_type'         => 'DATE',
            'orderby'  => 'meta_value',
        ];

        if(!empty($sub_category)) {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'whats_on_category',
                    'field' => 'slug',
                    'terms' => $sub_category,
                    'current_category' => 1,
                ]
            ];
        }

        $get_posts = new \WP_Query($args);

        if(!empty($get_posts)) {
            foreach ($get_posts as $key => $post) {
                $start_date = explode('/', get_field('start_date', $post->ID));

                $return_data[] = [
                    'day'         => $start_date[0],
                    'month'       => $start_date[1],
                    'year'        => $start_date[2],
                    'title'       => $post->post_title,
                    'link'        => get_permalink($post->ID)
                ];
            }
        }
    }

    /**
     * Singleton poop.
     *
     * @return Calender|null
     */
    public static function get_instance() {
        static $instance = null;

        if (is_null($instance)) {
            $instance = new self();
        }

        return $instance;
    }
}