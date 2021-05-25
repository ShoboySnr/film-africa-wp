<h1 class="text-lg font-black w-3/5"><?= get_field('page_title'); ?></h1>
<p class="text-lg font-normal py-12 mt-0.5 leading-7.5 overflow-y-hidden">
    <?= strip_tags(get_the_content()) ?>
</p>