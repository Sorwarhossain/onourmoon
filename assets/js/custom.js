/*
 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
 *
 * Template Name: Malic - Fishing & Hunting Club HTML Template  
 * Template URI: https://thememarch.com/demo/html/malic/
 * Description: Malic is a fully responsive fishing & hunting club HTML template which comes with the unique and clean design. It built with latest bootstrap 4 framework which makes the template fully customizable. It has also e-commerce support. E-commerce pages are included on this template.
 * Author: Thememarch
 * Author URI: https://thememarch.com
 * Version: 1.5
 *
 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
 */


(function ($) {
    'use strict';


    $(document).ready(function(){
        $('.event-carousel').slick({
            dots: true,
        });

        $('#switch_search').on('click', function(){
            $('.search_fields').slideToggle();

            var SelClass = $(this).find('i').attr('class');

            if('fa fa-search' == SelClass){
                $(this).find('i').attr('class', 'fa fa-close');
            }
            if('fa fa-close' == SelClass){
                $(this).find('i').attr('class', 'fa fa-search');
            }
        });




        var page = 1;
        // Load more article on homepage
        $('#load_more_articles').on('click', function(e){
            e.preventDefault(); 
            page++;
            $.ajax({
                url: onmoon_localise.admin_ajax,
                type: 'POST',
                dataType: 'html',
                data: {
                    action: 'loadmore_post_home',
                    paged: page,
                },
                beforeSend: function(){
                    $('#load_more_articles').text('Loading...');
                },
                success: function(resp){
                    $('#load_more_articles').text('More Articles');
                    $('#more_articles_wrapper').append(resp);
                
                    var hasNoResult = $(resp).hasClass('notResult');
                    if(hasNoResult) {
                        $('#load_more_articles').remove();
                    }
                },
                error: function( jqXHR, textStatus, errorThrown){
                    console.log( jqXHR, textStatus, errorThrown);
                }
            });
        });


        var page = 1;
        // Load more podcast on podcast page
        $('#load-more-podcast').on('click', function(e){
            e.preventDefault(); 
            page++;
            $.ajax({
                url: onmoon_localise.admin_ajax,
                type: 'POST',
                dataType: 'html',
                data: {
                    action: 'loadmore_podcast',
                    paged: page,
                },
                beforeSend: function(){
                    $('#load-more-podcast').text('Loading...');
                },
                success: function(resp){
                    $('#load-more-podcast').text('More Podcasts');
                    $('#podcasts_wrapper').append(resp);
                
                    var hasNoResult = $(resp).hasClass('notResult');
                    if(hasNoResult) {
                        $('#load-more-podcast').remove();
                    }
                },
                error: function( jqXHR, textStatus, errorThrown){
                    console.log( jqXHR, textStatus, errorThrown);
                }
            });
        });




        var page = 1;
        // Load more articles on author page
        $('#author_more_posts').on('click', function(e){
            e.preventDefault(); 
            var data_id = $(this).attr('data-id');
            page++;
            $.ajax({
                url: onmoon_localise.admin_ajax,
                type: 'POST',
                dataType: 'html',
                data: {
                    action: 'loadmore_author_posts',
                    paged: page,
                    data_id: data_id,
                },
                beforeSend: function(){
                    $('#author_more_posts').text('Loading...');
                },
                success: function(resp){
                    $('#author_more_posts').text('More Articles');
                    $('#author_posts_row').append(resp);
                
                    var hasNoResult = $(resp).hasClass('notResult');
                    if(hasNoResult) {
                        $('#author_more_posts').remove();
                    }
                },
                error: function( jqXHR, textStatus, errorThrown){
                    console.log( jqXHR, textStatus, errorThrown);
                }
            });
        });




        var page = 1;
        // Load more articles on archive page
        $('#archive_more_posts').on('click', function(e){
            e.preventDefault(); 
            var data_id = $(this).attr('data-id');
            page++;
            $.ajax({
                url: onmoon_localise.admin_ajax,
                type: 'POST',
                dataType: 'html',
                data: {
                    action: 'loadmore_archive_posts',
                    paged: page,
                    data_id: data_id,
                },
                beforeSend: function(){
                    $('#archive_more_posts').text('Loading...');
                },
                success: function(resp){
                    $('#archive_more_posts').text('More Articles');
                    $('#archive_posts_row').append(resp);
                
                    var hasNoResult = $(resp).hasClass('notResult');
                    if(hasNoResult) {
                        $('#archive_more_posts').remove();
                    }
                },
                error: function( jqXHR, textStatus, errorThrown){
                    console.log( jqXHR, textStatus, errorThrown);
                }
            });
        });





        // Ajax call for love react
        $('.love_this_comment').on('click', function(e){
            e.preventDefault(); 
            var data_id = $(this).attr('data-id');

            var oom_clicked_item = $(this);

            $.ajax({
                url: onmoon_localise.admin_ajax,
                type: 'POST',
                dataType: 'json',
                data: {
                    action: 'love_this_post',
                    data_id: data_id,
                },
                beforeSend: function(){
                   
                    //$('#archive_more_posts').text('Loading...');
                },
                success: function(resp){

                    if(resp.msg == 'success'){

                        oom_clicked_item.find('i').removeClass('fa-heart-o');
                        oom_clicked_item.find('i').addClass('fa-heart');
                        oom_clicked_item.prop('disabled', true);

                        oom_clicked_item.parent().siblings('.love_count').find('span').text(resp.new_likes);

                        if(resp.new_likes == 1){
                            oom_clicked_item.parent().after('<div class="love_count"><span>1</span> Likes</div>');
                        }
                    }
                    //console.log(resp);

                },
                error: function( jqXHR, textStatus, errorThrown){
                    console.log( jqXHR, textStatus, errorThrown);
                }
            });
        });





    });


})(jQuery);