<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Film_Africa_Theme
 */

$filter_by = isset($_GET['filter-by']) ? $_GET['filter-by'] : '';
switch($filter_by) {
    case 'events':
        include FILM_AFRICA_PARTIAL_VIEWS . '/search/_events.php';
        break;
    case 'films':
        include FILM_AFRICA_PARTIAL_VIEWS . '/search/_films.php';
        break;
    case 'post':
        include FILM_AFRICA_PARTIAL_VIEWS . '/search/_news.php';
        break;
    case 'press':
        include FILM_AFRICA_PARTIAL_VIEWS . '/search/_press.php';
        break;
    default:
        include FILM_AFRICA_PARTIAL_VIEWS . '/search/_all.php';
}
?>
