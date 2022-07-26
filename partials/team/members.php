<?php
use FilmAfricaWP\pages\Team;

$teams = Team::get_instance()->get_teams();

if(!empty($teams)) {
?>
<section class="custom-container mt-20">
    <h2 class="text-2xl font-bold"><?= __('Film Africa Team Members', 'film-africa-wp') ?></h2>
    <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-20 mt-8 mb-28">
        <?php
        $count = 0;
        foreach($teams as $team) {
        ?>
        <details id="modal-<?= ++$count ?>" class="mx-auto modal-trigger">
            <summary>
                <img
                    class="h-56 w-56 object-cover object-center rounded-4xl"
                    src="<?= $team['image'] ?>"
                    alt="<?= $team['title'] ?>"
                    title="<?= $team['title'] ?>"
                >

                <div class="mx-6 bottom-16 justify-self-center mt-6 text-center">
                    <p class="font-bold text-lg"><?= $team['title'] ?></p>
                    <p class="text-base"><?= $team['position'] ?></p>
                </div>
            </summary>

            <div class="fixed top-0 left-0 h-screen w-full z-40 modal-overlay">
                <div class="flex justify-center items-center h-full w-full">
                    <article class="max-w-lg md:max-w-5xl relative flex modal">
                        <div class="h-full mx-12 border border-gray-500 flex flex-col md:flex-row justify-center">
                            <picture class="h-1/2 md:h-full w-full md:w-1/2 flex-shrink-0">
                                <img
                                    src="<?= $team['image'] ?>"
                                    alt="<?= $team['title'] ?>"
                                    title="<?= $team['title'] ?>"
                                    class="w-full h-full object-cover object-center">
                            </picture>
                            <div class="px-12 py-14 bg-white overflow-y-auto overscroll-y-none">
                                <h3 class="font-bold text-2xl"><?= $team['title'] ?></h3>
                                <p class="text-base"><?= $team['position'] ?></p>
                                <div class="text-base font-normal pt-8 pb-14">
                                   <?= $team['details'] ?>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="modal-close-btn" name="modal-<?= $count ?>">
                            &times;
                        </button>
                    </article>
                </div>
            </div>
        </details>
        <?php } ?>
    </div>
</section>
<?php
}