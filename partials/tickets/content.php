<?php
use FilmAfricaWP\pages\Tickets;


$tickets = Tickets::get_instance()->get_all_tickets();
?>
<div class="bg-white grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-2 gap-y-9">
    <?php
        foreach ($tickets as $ticket) {
            include FILM_AFRICA_PARTIAL_VIEWS.'/tickets/_content.php';
        }

    ?>
</div>
