//sub category filter on the whats on page
$(document).on('click', '#filters-input input', function(event) {

    const subcategory_val = $(this).val();
    const name = $(this).attr('name');

    //return pages i don't want it to load
    if(subcategory_val === 'calender') return;

    event.preventDefault();

    document.location.href = path(window.location.href, name, subcategory_val);
});

//sub category filter on the whats on page
$(document).on('change', '#filters select', function(event) {

    const subcategory_val = $(this).val();
    const name = $(this).attr('name');

    event.preventDefault();

    document.location.href = path(window.location.href, name, subcategory_val);
});

//sub category filter on the films page
$(document).on('click', '#tabs input', function(event) {

    const subcategory_val = $(this).val();
    const name = $(this).attr('name');

    //return pages i don't want it to load
    if(subcategory_val === 'calender') return;

    event.preventDefault();

    document.location.href = path(window.location.href, name, subcategory_val);
});

$(document).on('click', '#stop-btn', function(event) {
   $('#play-btn').removeClass('hidden');
   $('.watch-trailer').removeClass('opacity-0');
   $('#trailer').removeClass('show-trailer').addClass('hide-trailer').html('');
});

//read more button
let count_click_see_more = 1;
$(document).on('click', '.page-template-page-whats-on #read-more-button, #nominees-section #read-more-button', function (event) {
    event.preventDefault();
    const read_more = $('#read-more-loader');
    const read_more_button = $(this);

    read_more_button.hide();
    read_more.show();
    count_click_see_more++;

    const api_endpoint = $(this).attr('data-api') + '&paged=' + count_click_see_more;
    const left_arrow = $(this).attr('data-arrow');

    $append_html = '';

    $.ajax(api_endpoint, {
        dataType: 'json',
        type: 'GET',
        success: function (data, status, xhr) {
            if(data.data.data.length > 0) {
                $.each(data.data.data, function (index, value) {
                    let post_type_color = '';
                    if( value.post_type === 'Films') {
                        post_type_color = '<span class="bg-yellow post-tag">' + value.post_type + '</span>';
                    } else if (value.post_type === 'Events') {
                        post_type_color = '<span class="bg-red text-white post-tag">'+ value.post_type + '</span>';
                    }
                    let category = value.category.length > 0 ? '<span class="text-gray-4">' + value.category.title + '</span>' : '';
                    let location = value.location.length > 0 ? '<span class="font-black">' + value.location.title + '</span>' : '';
                    $append_html += '<figure class="custom-grid">' +
                        '    <div class="relative h-full w-full">' +
                        '        <img' +
                        '            class="h-full w-full object-cover object-center"' +
                        '            src="' + value.image +'"' +
                        '            alt="' + value.title + '"' +
                        '            title="' + value.title + '"' +
                        '            height="282"' +
                        '            width="390"' +
                        '        >' + post_type_color +
                        '    </div>' +
                        '    <figcaption class="post-caption">' +
                        '        <div class="post-content">' +
                        '            <p class="post-venue">' + category + location + '</p>' +
                        '            <a href="' + value.link + '" title="' + value.title + '" class="post-title">' + value.title + '</a>' +
                        '            <p class="post-details">' +
                        '                <time datetime="' + value.date + '">' + value.date + '</time>' +
                        '                <a' +
                        '                    href="' + value.link + '"' +
                        '                    class="arrow-btn"' +
                        '                    title="See more"' +
                        '                >' + left_arrow +
                        '                </a>' +
                        '            </p>' +
                        '        </div>' +
                        '    </figcaption>' +
                        '</figure>';
                });

                $('#ajax-contents').append($append_html);

            }

            if(data.data.max_num_pages > 0 && data.data.max_num_pages > count_click_see_more) {
                read_more_button.show();
                read_more.hide();
            } else {
                read_more_button.hide();
                read_more.html('<p>You\'ve reached the end.</p>');
            }
        },
        error: function (jqXhr, textStatus, errorMessage) {

        }
    });
});

$(document).on('click', '.blog #read-more-button', function (event) {
    event.preventDefault();
    const read_more = $('#read-more-loader');
    const read_more_button = $(this);

    read_more_button.hide();
    read_more.show();
    count_click_see_more++;

    const api_endpoint = $(this).attr('data-api') + '&paged=' + count_click_see_more;

    $append_html = '';

    $.ajax(api_endpoint, {
        dataType: 'json',
        type: 'GET',
        success: function (data, status, xhr) {
            if(data.data.data.length > 0) {
                $.each(data.data.data, function (index, value) {
                    let category = value.category.title.length > 0 ? '<p class="post-venue"><span class="inline-block bg-black text-white px-3 py-2 text-xs">' + value.category.title + '</span></p>' : '';
                    $append_html += '<figure class="custom-grid grid-rows-1">' +
                        '    <div class="w-full max-h-96 overflow-hidden">' +
                        '        <img' +
                        '            class="h-full w-full object-cover object-center"' +
                        '            src="' + value.image +'"' +
                        '            alt="' + value.title + '"' +
                        '            title="' + value.title + '"' +
                        '        >' +
                        '    </div>' +
                        '    <figcaption' +
                        '        class="post-caption"' +
                        '    >' +
                        '        <div class="bg-white p-4 xl:p-6 w-full">' +
                                    category +
                        '            <a href="' + value.link + '" class="post-title" title="' + value.title + '">' +
                                        value.title +
                        '            </a>' +
                        '            <p class="post-details  text-gray-4">' +
                        '                <a href="' + value.link + '" class="underline hover:text-red">Read more</a>' +
                        '            </p>' +
                        '        </div>' +
                        '    </figcaption>' +
                        '</figure>';
                });

                $('#ajax-contents').append($append_html);

            }

            if(data.data.max_num_pages > 0 && data.data.max_num_pages > count_click_see_more) {
                read_more_button.show();
                read_more.hide();
            } else {
                read_more_button.hide();
                read_more.html('<p>You\'ve reached the end.</p>');
            }
        },
        error: function (jqXhr, textStatus, errorMessage) {

        }
    });
});

//read more button for search page
$(document).on('click', '.search-results #read-more-button', function (event) {
    event.preventDefault();
    const read_more = $('#read-more-loader');
    const read_more_button = $(this);

    read_more_button.hide();
    read_more.show();
    count_click_see_more++;

    const api_endpoint = $(this).attr('data-api') + '&paged=' + count_click_see_more;
    const left_arrow = $(this).attr('data-arrow');

    //find the checked filter input
    const current_state = $('#filters-input input:checked').val();

    $append_html = '';

    $.ajax(api_endpoint,  {
        dataType: 'json',
        type: 'GET',
        success: function (data, status, xhr) {
            console.log(api_endpoint, data);
            if(data.data.data.length > 0) {
                if(current_state === '' || current_state === null || current_state === 'page') {
                    $.each(data.data.data, function (index, value) {
                        let details = value.excerpt;
                        if(details === '') {
                            details = value.content;
                        }
                        $append_html += '<div class="pt-14 pb-16 mb-3 border-b">' +
                            '          <span class="inline-block bg-black text-white px-3 py-2 text-xs"' +
                            '          >' + value.post_type + '</span>' +
                            '    <a href="' + value.link +'"><h3 class="font-bold text-xl leading-7.5 pt-9 hover:text-red">' +
                            value.title +
                            '    </h3></a>' +
                            '    <p>' +
                            details +
                            '    </p>' +
                            '</div>'
                    });
                }

                if(current_state === 'post') {
                    $.each(data.data.data, function (index, value) {
                        let category = value.category.title && value.category.title.length > 0 ? '<p class="post-venue"><span class="inline-block bg-black text-white px-3 py-2 text-xs">' + value.category.title + '</span></p>' : '';
                        $append_html += '<figure class="custom-grid overflow-hidden">' +
                            '    <div class="w-full h-full">' +
                            '        <img' +
                            '            class="h-full max-h-96 w-full object-cover object-center"' +
                            '            src="' + value.image +'"' +
                            '            alt="' + value.title + '"' +
                            '            title="' + value.title + '"' +
                            '            height="282"' +
                            '            width="390"' +
                            '        >' +
                            '    </div>' +
                            '    <figcaption' +
                            '        class="border-b border-black-2 break-words mx-6 2xl:max-w-md relative justify-self-center bottom-16"\n' +
                            '    >' +
                            '        <div class="post-content">' +
                                        category +
                            '            <a href="' + value.link + '" class="post-title" title="' + value.title + '">' +
                                            value.title +
                            '            <p class="post-details  text-gray-4">' +
                            '                <a href="' + value.link + '" title="Read more" class="underline hover:text-red">Read more</a>' +
                            '            </p>' +
                            '        </div>' +
                            '    </figcaption>' +
                            '</figure>';
                    });
                }

                if(current_state === 'films' || current_state === 'events') {
                    $.each(data.data.data, function (index, value) {
                        let post_type_color = '';
                        if( value.post_type === 'Films') {
                            post_type_color = '<span class="bg-yellow post-tag">' + value.post_type + '</span>';
                        } else if (value.post_type === 'Events') {
                            post_type_color = '<span class="bg-red text-white post-tag">'+ value.post_type + '</span>';
                        }
                        let category = value.category.length > 0 ? '<span class="text-gray-4">' + value.category.title + '</span>' : '';
                        let location = value.location.length > 0 ? '<span class="font-black">' + value.location.title + '</span>' : '';

                        $append_html += '<figure class="custom-grid overflow-hidden">' +
                            '    <div class="relative h-full w-full">' +
                            '        <img' +
                            '            class="h-full w-full object-cover object-center"' +
                            '            src="' + value.image +'"' +
                            '            alt="' + value.title + '"' +
                            '            title="' + value.title + '"' +
                            '            height="282"' +
                            '            width="390"' +
                            '        >' + post_type_color +
                            '    </div>' +
                            '    <figcaption' +
                            '        class="post-caption"' +
                            '    >' +
                            '        <div class="post-content">' +
                            '            <p class="post-venue">'  + category + location +
                            '            </p>' +
                            '            <a href="'+ value.link + '" title="' + value.title +'" class="post-title">' +
                                            value.title +
                            '            </a>' +
                            '            <p class="post-details ">' +
                            '                <time datetime="' + value.date + '">' + value.date + '</time>' +
                            '                <a' +
                            '                    href="'+ value.link + '"' +
                            '                    class="arrow-btn" title="' + value.title +'"' +
                            '                >' + left_arrow +
                            '                </a>' +
                            '            </p>' +
                            '        </div>' +
                            '    </figcaption>' +
                            '</figure>';
                        });
                }

                if(current_state ==='press') {
                    $.each(data.data.data, function (index, value) {
                        $append_html += '<figure class="press">' +
                            '    <div class="w-full">' +
                            '        <img' +
                            '            class="press-img"' +
                            '            src="' + value.image +'"' +
                            '            alt="' + value.title + '"' +
                            '            title="' + value.title + '"' +
                            '        >' +
                            '    </div>' +
                            '    <figcaption class="h-full absolute top-0 left-7 mt-7 w-3/5 2xl:w-2/5 flex flex-col">' +
                            '        <p>' +
                            '            <span class="inline-block bg-white p-4 text-lg font-bold">' + value.press_release_format +
                            '            </span>' +
                            '        </p>' +
                            '        <p class="text-4xl font-medium pt-12 leading-tight text-white">' + value.title +
                            '        </p>' +
                            '        <p class="pb-12 mt-auto font-bold text-white">'+ value.press_date +'</p>' +
                            '    </figcaption>' +
                            '</figure>'
                    });
                }

            $('#ajax-contents').append($append_html);

            }

            if(data.data.max_num_pages > 0 && data.data.max_num_pages > count_click_see_more) {
                read_more_button.show();
                read_more.hide();
            } else {
                read_more_button.hide();
                read_more.html('<p>You\'ve reached the end.</p>');
            }
        },
        error: function (jqXhr, textStatus, errorMessage) {

        }
    });
});

$(document).on('click', '.archive #read-more-button', function (event) {
    event.preventDefault();
    const read_more = $('#read-more-loader');
    const read_more_button = $(this);

    read_more_button.hide();
    read_more.show();
    count_click_see_more++;

    const api_endpoint = $(this).attr('data-api') + '&paged=' + count_click_see_more;
    const left_arrow = $(this).attr('data-arrow');


    $append_html = '';

    $.ajax(api_endpoint, {
        dataType: 'json',
        type: 'GET',
        success: function (data, status, xhr) {
            if(data.data.data.length > 0) {
                $.each(data.data.data, function (index, value) {
                    if(value.post_type === 'Post') {
                        let category = value.category?.title?.length > 0 ? '<p class="post-venue"><span class="inline-block bg-black text-white px-3 py-2 text-xs">' + value.category.title + '</span></p>' : '';
                        $append_html += '<figure class="custom-grid grid-rows-1">' +
                            '    <div class="w-full max-h-96 overflow-hidden">' +
                            '        <img' +
                            '            class="h-full w-full object-cover object-center"' +
                            '            src="' + value.image +'"' +
                            '            alt="' + value.title + '"' +
                            '            title="' + value.title + '"' +
                            '        >' +
                            '    </div>' +
                            '    <figcaption' +
                            '        class="post-caption"' +
                            '    >' +
                            '        <div class="bg-white p-4 xl:p-6 w-full">' +
                            category +
                            '            <a href="' + value.link + '" class="post-title" title="' + value.title + '">' +
                            value.title +
                            '            </a>' +
                            '            <p class="post-details  text-gray-4">' +
                            '                <a href="' + value.link + '" class="underline hover:text-red">Read more</a>' +
                            '            </p>' +
                            '        </div>' +
                            '    </figcaption>' +
                            '</figure>';
                    } else {
                        let post_type_color = '';
                        if( value.post_type === 'Films') {
                            post_type_color = '<span class="bg-yellow post-tag">' + value.post_type + '</span>';
                        } else if (value.post_type === 'Events') {
                            post_type_color = '<span class="bg-red text-white post-tag">'+ value.post_type + '</span>';
                        }
                        let category = value.category.length > 0 ? '<span class="text-gray-4">' + value.category.title + '</span>' : '';
                        let location = value.location.length > 0 ? '<span class="font-black">' + value.location.title + '</span>' : '';
                        $append_html += '<figure class="custom-grid">' +
                            '    <div class="relative h-full w-full">' +
                            '        <img' +
                            '            class="h-full w-full object-cover object-center"' +
                            '            src="' + value.image +'"' +
                            '            alt="' + value.title + '"' +
                            '            title="' + value.title + '"' +
                            '            height="282"' +
                            '            width="390"' +
                            '        >' + post_type_color +
                            '    </div>' +
                            '    <figcaption class="post-caption">' +
                            '        <div class="post-content">' +
                            '            <p class="post-venue">' + category + location + '</p>' +
                            '            <a href="' + value.link + '" title="' + value.title + '" class="post-title">' + value.title + '</a>' +
                            '            <p class="post-details">' +
                            '                <time datetime="' + value.date + '">' + value.date + '</time>' +
                            '                <a' +
                            '                    href="' + value.link + '"' +
                            '                    class="arrow-btn"' +
                            '                    title="See more"' +
                            '                >' + left_arrow +
                            '                </a>' +
                            '            </p>' +
                            '        </div>' +
                            '    </figcaption>' +
                            '</figure>';
                    }
                });

                $('#ajax-contents').append($append_html);

            }

            if(data.data.max_num_pages > 0 && data.data.max_num_pages > count_click_see_more) {
                read_more_button.show();
                read_more.hide();
            } else {
                read_more_button.hide();
                read_more.html('<p>You\'ve reached the end.</p>');
            }
        },
        error: function (jqXhr, textStatus, errorMessage) {

        }
    });
});