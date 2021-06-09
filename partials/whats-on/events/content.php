<h1 class="text-5xl font-black">
    <?= get_the_title(); ?>
</h1>
<?php
if(!empty($subtitle)) {
    ?>
    <p class="font-extrabold text-lg pb-10">
        <?= $subtitle; ?>
    </p>
<?php } ?>
<div class="text-editor">
    <?= the_content(); ?>
</div>
