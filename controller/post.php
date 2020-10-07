<?php

/*

post:id - body, time, user_id

*/

class PostController {

    public function create() {

        if (!Auth::check()) {
            Service::redirect('login');
            return false;
        }

        $user_id = Service::get_session_param('user_id');

        if (!$_POST) {
           Service::redirect('user/'.$user_id);
        }

        $data['body'] = Service::get_post_param('body');

        if (!$data['body']) {
            $field['message'] = DB::get_state_message('empty_post');

            Service::redirect('user/'.$user_id);
        }

        MVC::use_model('post');
        $new_post = PostModel::createPost($user_id, $data);

//        Service::redirect('user/'.$user_id);

        echo json_encode($new_post, JSON_UNESCAPED_UNICODE);
    }

    public function edit($request) {
        // TODO: check owner!

        if (!Auth::check()) {
            Service::redirect('login');
        }


        $data['body'] = Service::get_post_param('body');

        if (!$_POST || !$data['body']) {
            return false;
        }

        $post_id = Service::get_uri_param($request, 1);

        MVC::use_model('post');
        $post = PostModel::editPost($post_id, $data);

        echo json_encode($post, JSON_UNESCAPED_UNICODE);
    }

    public function delete() {

    }

}