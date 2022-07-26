<section class="bg-gray-1">
    <div
    id="tabs"
    class="tabs custom-container flex justify-start items-end gap-5 py-10 overflow-x-auto"
    >
    <?php
    use FilmAfricaWP\classes\SupportMenuWalker;
    $args = [
        'child_of'          => wp_get_post_parent_id(get_the_ID()),
        'depth'             => 1,
        'title_li'          => '',
        'sort_column'       => 'menu_order',
        'link_before'       => '',
        'link_after'        => '',
        'walker'            => new SupportMenuWalker()
    ];
    wp_list_pages($args);
    ?>
    </div>
</section>
