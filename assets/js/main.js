$(function() {

    $('#create-post button').on('click ', function(){
        let postBody = $('#create-post textarea#new_post').val();

        function appendNewPost (a) {
            a = JSON.parse(a);

            $('#create-post textarea#new_post').val('');

            $('#post-template h4 .badge').html(a.time);
            $('#post-template p').html(a.body);
            $('#post-template p').insertAfter('<span class="d-none" id="post_id">' + a.post_id + '</span>');
            // $('#post-template form').attr('action', '/post/edit/' + a.post_id);

            let newPost = '<div class="jumbotron my-4 py-4">' + $('#post-template').html() + '</div>';

            let counterPost = $('#user-info #post-counter .lead').html();
            counterPost++;

            $(newPost).insertAfter('#post-template');
            $('#user-info #post-counter .lead').html(counterPost);
        }

        // ---
        $.post('/post/create', { body: postBody }, appendNewPost);
        // ---
    });

    $('.post .btn-edit').on('click', function(){
        $(this).parent().siblings('.post-forms').children('.post-edit').toggleClass('d-none');
        // $(this).parent().siblings('.post-forms').children('.post-comment').addClass('d-none');
        $(this).parent().siblings('.post-body').toggle();
        $(this).toggleClass('btn-primary');
        $(this).toggleClass('btn-outline-primary');
    });

    $('.post .btn-comment').on('click', function(){
        // $(this).parent().siblings('.post-forms').children('.post-comment').toggleClass('d-none');
        // $(this).parent().siblings('.post-forms').children('.post-edit').addClass('d-none');
        // $(this).toggleClass('btn-primary');
        // $(this).toggleClass('btn-outline-primary');
    });


    // send post

    $('.post .btn-edit-submit').on('click ', function(){

        let post_id = $(this).parent().parent().siblings('.post-id').html();
        let post_body = $(this).siblings('textarea').val();
        let self_element = $(this);

        function appendEditedPost (data) {
            data = JSON.parse(data);

            self_element.parent().parent().siblings('.post-body').html(data.body);
            self_element.parent().parent().siblings('.post-heading').children('h4').children('.badge').html(data.time);
            self_element.parent().parent().siblings('.post-setting').children('.btn-edit').trigger('click');
        }

        // ---
        $.post('/post/' + post_id + '/edit', { body: post_body }, appendEditedPost);
        // ---
    });

    $('.post .btn-comment-submit').on('click ', function(){

        let post_id = $(this).siblings('#post_id').html();

        // ---
        // $.post('/post/' + post_id + '/comment', { body: postBody }, appendNewPost);
        // ---
    });





});