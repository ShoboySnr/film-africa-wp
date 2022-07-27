<?php
use FilmAfricaWP\pages\Press;


//$filter_by = isset($_GET['filter-by']) ? $_GET['filter-by'] :  'year_category';
//$release_type = isset($_GET['subcategory-filter']) ? $_GET['subcategory-filter'] : 'releases';

$filter_by = $_GET['filter-by'] ?? '';
$release_type = $_GET['subcategory-filter'] ?? '';
$paged = $_GET['page'] ?? '';

$press_releases = Press::get_instance()->get_press_release($filter_by, $release_type, $paged);
$max_number_pages = $press_releases['max_num_pages'];
$count_number_pages = $press_releases['count'];
$press_releases = $press_releases['data'];

$api_link = esc_html(FILM_AFRICA_API_BASE."/about/press?filter_by=$filter_by&subcategory-filter=$release_type");


$page_title = get_field('page_title');
$access_toolkits_button = get_field('access_toolkits_button');

$carbon_pdf = FILM_AFRICA_ASSETS_ICONS_URI.'/carbon_pdf.svg';

include_once(FILM_AFRICA_PARTIAL_VIEWS.'/press/content.php');

if($release_type != 'coverage') {
    ?>

  <section class="custom-container" id="press">
      <?php include_once FILM_AFRICA_PARTIAL_VIEWS.'/press/top-filter.php'; ?>
    <div class="flex flex-wrap lg:flex-nowrap items-start justify-between pt-20">
        <?php include_once FILM_AFRICA_PARTIAL_VIEWS.'/press/side-filter.php'; ?>
      <div style="margin-bottom: 9rem">
        <div class="release-container" id="ajax-contents">
            <?php
                if(!empty($press_releases)) {
                foreach($press_releases as $press_release) {
                
                if(!empty($press_release['link']['url'])) { ?>
          <a class="release flex-wrap" href="<?= (!empty($press_release['link']['url'])) ? $press_release['link']['url'] : 'javascript:void(0);'; ?>" target="<?= $press_release['link']['target'] ?>" title="<?= $press_release['link']['title'] ?>">
              <?php } else { ?>
            <div class="release">
                <?php } ?>
              <img
                  class="h-16 w-20"
                  src="<?= $carbon_pdf ?>"
                  alt="<?= __('pdf', 'film-africa-wp') ?>"
              >
              <p class="text-base pt-5 pb-1">
                  <?= $press_release['details'] ?>
              </p>
                <?php
                    if(!empty($press_release['date'])) {
                        ?>
                      <div class="pt-8 font-bold mt-auto"><?= $press_release['date'] ?></div>
                    <?php } ?>
                <?php if(!empty($press_release['link']['url'])) { ?>
          </a>
            <?php } else { ?>
        </div>
          <?php }
              } }
              else {
                  ?>
                <p class="text-black-2"><?= __('There are no release for this selection', 'film-africa-wp'); ?></p>
                  <?php
              }
          ?>
      </div>
        <?php include_once FILM_AFRICA_PARTIAL_VIEWS . '/pagination.php'; ?>
    </div>

    </div>
  </section>
    <?php
    
} else {
    
    ?>

  <section class="custom-container" id="press">
      <?php include_once FILM_AFRICA_PARTIAL_VIEWS.'/press/top-filter.php'; ?>
    <div class="flex flex-wrap lg:flex-nowrap items-start lg:gap-40 pt-20">
      <div class="pt-2 gap-2 lg:gap-0 inline-flex flex-shrink-0 lg:flex-col filter-tabs mr-auto">
          <?php include_once FILM_AFRICA_PARTIAL_VIEWS.'/press/side-filter.php'; ?>
      </div>
      <div class="pb-36">
        <section class="pt-2 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2" id="ajax-contents">
            <?php
                foreach($press_releases as $press_release) {
                    ?>

                  <a href="<?= (!empty($press_release['link']['url'])) ? $press_release['link']['url'] : 'javascript:void(0);'; ?>" target="<?= $press_release['link']['target'] ?>" title="<?= $press_release['link']['title'] ?>" class="press">
                    <div class="w-full">
                      <img class="press-img" src="<?= $press_release['image'] ?>" alt="<?= $press_release['slug'] ?>" title="<?= $press_release['title'] ?>">
                    </div>
                    <figcaption class="h-full absolute top-0 left-7 mt-7 w-1/3 lg:w-3/5 2xl:w-1/2 flex flex-col">
                        <?php
                            if(!empty($press_release['format'])) {
                                ?>
                              <p>
                                <span class="inline-block bg-white p-2 text-sm font-bold"><?= $press_release['format'] ?></span>
                              </p>
                            <?php } ?>
                      <p class="text-4xl font-medium pt-12 leading-tight text-white">
                          <?= $press_release['title'] ?>
                      </p>
                        <?php
                            if(!empty($press_release['date'])) {
                                ?>
                              <p class="pb-12 mt-auto font-bold text-white press-date">
                                  <?= $press_release['date'] ?>
                              </p>
                            <?php } ?>
                    </figcaption>
                  </a>
                <?php } ?>
        </section>
          <?php include_once FILM_AFRICA_PARTIAL_VIEWS . '/pagination.php'; ?>
      </div>
    </div>
      <?php include_once FILM_AFRICA_PARTIAL_VIEWS . '/pagination.php'; ?>
  </section>
    <?php
}