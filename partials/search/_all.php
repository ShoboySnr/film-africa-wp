<?php

$post_type = get_post_type();

if($post_type == 'page') $post_type = 'Web Page';
if($post_type == 'post') $post_type = 'News';
?>

<div class="pt-14 pb-16 mb-3 border-b">
          <span class="inline-block bg-black text-white px-3 py-2 text-xs"
          ><?= ucfirst($post_type) ?></span>

    <a href="<?= get_permalink(); ?>">
        <h3 class="font-bold text-xl leading-7.5 pt-9 hover:text-red">
            <?= get_the_title() ?>
        </h3>
    </a>
    <p>
       <?= strip_tags(the_excerpt()) ?>
    </p>
</div>