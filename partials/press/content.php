<section class="text-black pt-20 pb-14 bg-gray-1 border-t">
    <div class="custom-container">
        <div class="sm:flex justify-between items-baseline pb-7">
            <h1 class="font-black text-4xl"><?= $page_title ?></h1>
            <a href="<?= $access_toolkits_button['url'] ?>"  target="<?= $access_toolkits_button['target'] ?>" class="bg-yellow mt-9 lg:mt-0 py-2.5 px-11 focus:outline-none text-lg font-bold text-black access-button">
                <?= $access_toolkits_button['title'] ?>
            </a>
        </div>
        <div class="text-lg font-normal">
            <p>
                <?= get_the_content(); ?>
            </p>
            <br >
        </div>
    </div>
</section>