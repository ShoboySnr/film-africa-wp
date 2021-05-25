<?php

use FilmAfricaWP\pages\Awards;


$filter_by = $_GET['filter-by'] ?? '';
$see_more = $_GET['see-more'] ?? get_option('posts_per_page');

$year_on = false;
$post_type_field = 'films';
$get_awards = Awards::get_instance()->get_awards($post_type_field, $taxonomy, $see_more);
if($filter_by == 'previous-winners') {
    $year_on = true;
    $taxonomy = '';
    $post_type_field = 'awards';
    $get_awards = Awards::get_instance()->get_awards($post_type_field, $taxonomy, $see_more, $year_on);
}

$max_number_pages = $get_awards['max_num_pages'];
$count = $get_awards['count'];
$get_awards = $get_awards['data'];
$api_link = esc_html(FILM_AFRICA_API_BASE."/awards/pages?filter_by=$post_type_field&taxonomy=$taxonomy&year_on=$year_on");

include_once (FILM_AFRICA_PARTIAL_VIEWS.'/read-all.php');
?>
  <section id="filters-input" class="filters custom-container pt-1.5">
      <div class="category pt-14">
          <input class="hidden filter" type="radio" name="filter-by" id="nominees" value="nominees"
              <?=$filter_by != 'previous-winners' ? 'checked' : '';?>>
          <label class="filter-option  category-item" for="nominees"><?=__('Nominees', 'film-africa-wp')?></label>
          <input class="hidden filter" type="radio" name="filter-by" value="previous-winners" id="previous-winners"
              <?=$filter_by == 'previous-winners' ? 'checked' : ''?>>
          <label class="filter-option  category-item"
              for="previous-winners"><?=__('Previous Winners', 'film-africa-wp')?></label>
      </div>
  </section>
  <section class="custom-container mt-20 nominees" id="nominees-section">
      <div class="grid lg:grid-cols-3 gap-2 mt-8" id="ajax-contents">
          <?php
            foreach ($get_awards as $new) {
                include FILM_AFRICA_PARTIAL_VIEWS.'/whats-on/_content.php';
            }
          ?>
      </div>
      <?php include FILM_AFRICA_PARTIAL_VIEWS . '/pagination.php'; ?>
  </section>