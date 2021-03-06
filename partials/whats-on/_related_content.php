<?php

$left_arrow = FILM_AFRICA_ASSETS_ICONS_DIR.'/left-arrow.svg';

$post_type = '';
if($new['post_type'] == 'films') {
    $post_type = '<span class="bg-yellow post-tag">'.ucfirst($new['post_type']) .'</span>';
} else if ($new['post_type'] == 'events') {
    $post_type = '<span class="bg-red text-white post-tag">'.ucfirst($new['post_type']) .'</span>';
}
?>
<figure class="film-post">
    <div class="film-post-image">
      <a href="<?= $new['link'] ?>" title="<?= $new['title'] ?>">
          <img
              src="<?= $new['image'] ?>"
              alt="<?= $new['title'] ?>"
              title="<?= $new['title'] ?>"
              height="282"
              width="390">
      </a>
        <?= $post_type ?>
    </div>

    <figcaption class="post-caption">
        <div class="post-content">
            <p class="post-venue">
                <?php

                if (isset($new['category']['title'])) {
                    ?>
                    <a href="<?= get_term_link($new['category']['id']) ?>" class="text-gray-4 hover:text-red" title="<?= $new['category']['title']; ?>">
                        <span class="text-gray-4 hover:text-red"><?= $new['category']['title']; ?></span>
                    </a>
                <?php }
                if(isset($new['location']['title'])) {
                    ?>
                    <span class="font-black"><?= $new['location']['title'] ?></span>
                <?php } ?>
            </p>
            <a href="<?= $new['link'] ?>" title="<?= $new['title'] ?>" class="post-title">
                <?= $new['title'] ?>
            </a>
            <p class="post-details ">
                <time><?= $new['date'] ?></time>
                <a href="<?= $new['link'] ?>" class="arrow-btn" title="<?= __('See more', 'film-africa-wp') ?>">
                    <?= file_get_contents($left_arrow); ?>
                </a>
            </p>
        </div>
    </figcaption>
</figure>