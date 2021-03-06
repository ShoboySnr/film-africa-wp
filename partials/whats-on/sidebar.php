<?php

$url = get_permalink();
$content = substr(get_the_title(), 0, 100);
$title = get_the_title();
$excerpt = get_the_excerpt();
$note_black = FILM_AFRICA_ASSETS_ICONS_URI.'/note.svg';
$category_name = isset($category[0]) ? $category[0]->name : '';
$twitter_link = "https://twitter.com/share?text=$content&url=$url&hashtags=filmafrica,$category_name";
$facebook_link = "https://www.facebook.com/sharer/sharer.php?u=$url&t=$title";
$mail_link = "mailto:?subject=$title&body=$excerpt - $url";
$post_type = get_post_type();

?>

<div class="film-details">
    <?php
        
        if($post_type == 'events' && !empty($book_now['url'])) {
            
            ?>
          <a href="<?= $book_now['url'] ?>" target="<?= $book_now['target'] ?>" type="button" class="px-12 py-2.5 bg-yellow hidden xl:flex items-center font-bold absolute -top-24">
              <span class="mx-2 fill-current">
                <img src="<?= $note_black ?>" alt="<?= __('note', 'film-africa-wp') ?>">
              </span>
            <span><?= !empty($book_now['title']) ? $book_now['title'] : __('Book Now', 'film-africa-wp') ?></span>
          </a>
            <?php
        }
        
        if(!empty($categories)) {
            foreach ($categories as $category) {
                ?>
              <a href="<?= $category['link'] ?>" class="font-bold <?= $post_type =='films' ? 'bg-yellow px-6 py-3' : 'bg-red px-8 py-2 text-white'; ?>  inline-block text-13">
                  <?= $category['title']; ?>
              </a>
            <?php } } ?>
    <?php
        
        if($post_type === 'events') {
            ?>
          <p class="font-extrabold pt-11">
              <?= get_the_title(); ?>
          </p>
        <?php } ?>
  <div class="pt-11 font-semibold">
    <div class="flex items-center">
      <picture class="mr-4">
        <img src="<?= $calendar ?>" alt="<?= __('calendar', 'film-africa-wp') ?>" >
      </picture>
        <?php
            if($post_type === 'events') {
                ?>
              <span>
                  <time datetime="<?= date('j F Y', strtotime(get_field('start_date'))) ?>"><?= date('j F Y', strtotime(get_field('start_date'))) ?></time>
                </span>
                <?php
            }
            
            if($post_type === 'films') {
                ?>
              <span>
              <?= get_field('start_date'); ?>
          </span>
                <?php
            }
        ?>
    </div>
      <?php
          
          if(!empty($location)) {
              ?>
            <div class="flex pt-4 items-center">
              <picture class="mr-4 flex-shrink-0">
                <img src="<?= $location_pin ?>" alt="<?= __('location', 'film-africa-wp') ?>" >
              </picture>
              <span><?= $location ?></span>
            </div>
          <?php }
          
          if($post_type == 'events') {
              if (!empty($time)) {
                  ?>
                <div class="flex pt-4 items-center">
                  <picture class="mr-4">
                    <img src="<?= $clock ?>" alt="<?= __('Time', 'film-africa-wp') ?>" >
                  </picture>
                  <span><?= $time ?></span>
                </div>
              <?php }
          }
      ?>
  </div>
  <div class="pt-11">
      <?php
          
          if(!empty($runtime)) {
              
              ?>
            <p>
              <span class="font-semibold"><?= __('Runtime:', 'film-africa-wp') ?> </span>
              <time class="font-bold"><?= $runtime ?></time>
            </p>
              <?php
          }
          if(!empty($language)) {
              ?>
            <p class="pt-2.5 font-semibold">
                <?= __('Language(s):', 'film-africa-wp') ?>

              <span><?= $language; ?></span>
            </p>
          <?php } ?>

  </div>
    <?php
        
        if($post_type === 'events' && !empty($book_now['url'])) {
            ?>
          <div class="pt-11">
            <a href="<?= $book_now['url'] ?>" type="button" target="<?= $book_now['target'] ?>"
               class="px-12 py-2.5 bg-black-2 text-white flex items-center font-bold book-now-button"
            >
                <span class="mx-2 fill-current flex-shrink-0">
                  <img src="<?= $note_white ?>" alt="<?= __('note', 'film-africa-wp') ?>" >
                </span>

              <span><?= !empty($book_now['title']) ? $book_now['title'] : __('Book Now') ?> </span>
            </a>
          </div>
        <?php } ?>
  <div class="pt-10">
    <small class="uppercase tracking-widest font-bold"><?= __('share', 'film-africa-wp') ?></small>
    <ol class="flex gap-5 items-center pt-6">
      <li>
        <a href="<?= $twitter_link ?>" target="_blank" title="<?= __('Share this on twitter', 'film-africa-wp') ?>">
          <img src="<?= $twitter; ?>" alt="<?= __('twitter', 'film-africa-wp') ?>" >
        </a>
      </li>
      <li>
        <a href="<?= $facebook_link ?>" target="_blank" title="<?= __('Share this on facebook', 'film-africa-wp') ?>">
          <img src="<?= $facebook ?>" alt="<?= __('facebook', 'film-africa-wp') ?>" >
        </a>
      </li>

      <li>
        <a href="<?= $mail_link ?>" target="_blank" title="<?= __('Send as email', 'film-africa-wp') ?>">
          <img src="<?= $mail; ?>" alt="<?= __('mail', 'film-africa-wp') ?>" >
        </a>
      </li>
    </ol>
  </div>
    <?php
        
        if($tags && !empty($tags))
        {
            ?>
          <div class="flex flex-wrap gap-3 pt-10 tags-container">
              <?php
                  
                  foreach($tags as $tag) {
                      ?>
                    <span class="border border-black-2 p-2 font-bold"><?= $tag->name; ?></span>
                  <?php } ?>
          </div>
        <?php } ?>
</div>