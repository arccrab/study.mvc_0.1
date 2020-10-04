$(function() {

    $('#create-post button').on('click ', function(){
        let postBody = $('#create-post textarea#new_post').val();

        function appendNewPost (a) {
            a = JSON.parse(a);

            $('#create-post textarea#new_post').val('');

            $('#post-template h4 .badge').html(a.time);
            $('#post-template p').html(a.body);

            let newPost = '<div class="jumbotron my-4 py-4">' + $('#post-template').html() + '</div>';

            let counterPost = $('#user-info #post-counter .lead').html();
            counterPost++;

            $(newPost).insertAfter('#post-template');
            $('#user-info #post-counter .lead').html(counterPost);



        }

        $.post('/post/create', { body: postBody }, appendNewPost);

    });



});