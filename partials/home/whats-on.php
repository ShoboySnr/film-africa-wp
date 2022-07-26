<?php

$whats_on = $home_data['whats_on'];
$whats_on_posts = $whats_on['whats_on']
?>
<!-- What's on -->
<section class="custom-container mt-20 overflow-x-hidden">
    <h2 class="w-full flex justify-between items-end">
        <span class="text-4xl font-black"><?= __('What\'s on', 'film-africa-wp') ?> </span>
        <?php
            if(!empty($whats_on['see_more'])) {
        ?>
        <a href="<?= $whats_on['see_more'] ?>" class="see-more-btn"
        ><?= __('See more','film-africa-wp') ?></a
        >
        <?php } ?>
    </h2>

    <div class="grid lg:grid-cols-7 gap-2 mt-8">
        <?php
            $count = 1;
            foreach($whats_on_posts as $whats_on_post) {
                $post_type = $whats_on_post['post_type'];
                if($count%2 != 0) {
        ?>
            <figure class="post mt-2 lg:col-span-4">
                <div class="relative h-full">
                    <img
                            class="h-full w-full object-cover object-center"
                            src="<?= $whats_on_post['image'] ?>"
                            alt="<?= $whats_on_post['title'] ?>"
                    >
                    <span class="<?= $whats_on_post['post_type'] == 'films' ? 'bg-yellow' : 'bg-red text-white' ?> post-tag"> <?= ucfirst($whats_on_post['post_type']) ?> </span>
                </div>

                <figcaption class="whatson-post-caption">
                    <div class="post-content">
                        <p class="post-venue">
                            <?php
                            if(isset($whats_on_post['category']['title']) && $whats_on_post['category']['title'] != '') {
                            ?>
                            <a href="<?= $whats_on_post['category']['link'] ?>" title="<?= $whats_on_post['category']['title'] ?>" class="text-gray-4 hover:text-red"><?= $whats_on_post['category']['title'] ?></a>
                            <?php
                            }
                            if(isset($whats_on_post['location']['title']) && $whats_on_post['location']['title'] != '') {
                            ?>
                                <span class="font-black"><?= $whats_on_post['location']['title'] ?></span>
                            <?php } ?>
                        </p>
                        <a href="<?= $whats_on_post['link'] ?>" class="post-title">
                            <?= $whats_on_post['title'] ?>
                        </a>
                        <p class="post-details">
                            <time datetime="<?= $whats_on_post['date'] ?>"><?= $whats_on_post['date'] ?></time>
                            <a href="<?= $whats_on_post['link'] ?>" class="arrow-btn cursor hover:scale-105 transition-all">
                                <?= file_get_contents(FILM_AFRICA_ASSETS_ICONS_DIR.'/left-arrow.svg') ?>
                            </a>
                        </p>
                    </div>
                </figcaption>
            </figure>
        <?php
                }
                else {
        ?>
             <figure class="post mt-2 lg:col-span-3">
                        <div class="relative h-full">
                            <img
                                    class="h-full w-full object-cover object-center"
                                    src="<?= $whats_on_post['image'] ?>"
                                    alt="placeholder"
                            >
                            <span class="<?= $whats_on_post['post_type'] == 'films' ? 'bg-yellow' : 'bg-red text-white' ?> post-tag"> <?= ucfirst($whats_on_post['post_type']) ?> </span>
                        </div>

                        <figcaption class="whatson-post-caption">
                            <div class="post-content">
                                <p class="post-venue">
                                    <?php
                                    if(isset($whats_on_post['category']['title']) && $whats_on_post['category']['title'] != '') {
                                        ?>
                                        <a href="<?= $whats_on_post['category']['link'] ?>" title="<?= $whats_on_post['category']['title'] ?>" class="text-gray-4 hover:text-red"><?= $whats_on_post['category']['title'] ?></a>
                                        <?php
                                    }
                                    if(isset($whats_on_post['location']['title']) && $whats_on_post['location']['title'] != '') {
                                        ?>
                                        <span class="font-black"><?= $whats_on_post['location']['title'] ?></span>
                                    <?php } ?>
                                </p>
                                <p class="post-title">
                                    <?= $whats_on_post['title'] ?>
                                </p>
                                <p class="post-details ">
                                    <time datetime="<?= $whats_on_post['date'] ?>"><?= $whats_on_post['date'] ?></time>
                                    <a href="<?= $whats_on_post['link'] ?>" class="arrow-btn cursor hover:scale-105 transition-all">
                                        <?= file_get_contents(FILM_AFRICA_ASSETS_ICONS_DIR.'/left-arrow.svg'); ?>
                                    </a>
                                </p>
                            </div>
                        </figcaption>
                    </figure>
        <?php
                }
                ++$count;
            }
        ?>
    </div>
</section>
