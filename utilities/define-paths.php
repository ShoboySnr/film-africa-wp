<?php

//define some path
define('FILM_AFRICA_ASSETS_DIR', get_template_directory_uri() . '/assets');
define('FILM_AFRICA_ASSETS_ICONS_DIR', FILM_AFRICA_ASSETS_DIR . '/icons');
define('FILM_AFRICA_ASSETS_IMAGES_DIR', FILM_AFRICA_ASSETS_DIR . '/images');
define('FILM_AFRICA_PARTIAL_VIEWS', get_template_directory() . '/partials');
define('FILM_AFRICA_API_BASE_ROUTE', 'film-africa-wp/v1');
define('FILM_AFRICA_API_BASE', get_home_url().'/wp-json/'. FILM_AFRICA_API_BASE_ROUTE);