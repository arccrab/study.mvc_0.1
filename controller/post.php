<?php

/*

post:id - body, time, user_id



*/

class PostController {

    public function create() {

        if (!Auth::check()) {
            Service::redirect('login');
        }

        $user_id = Service::get_session_param('user_id');

        if (!$_POST) {
           Service::redirect('user/'.$user_id);
        }

        $data['body'] = Service::get_post_param('new_post');

        if (!$data['body']) {
            $field['message'] = DB::get_state_message('empty_post');

            Service::redirect('user/'.$user_id);
        }

        MVC::use_model('post');
        PostModel::createPost($user_id, $data);

        Service::redirect('user/'.$user_id);

        // TODO: it must return true, for future AJAX request

    }

    public function edit() {

    }

    public function delete() {

    }

}