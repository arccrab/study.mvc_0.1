<?php

class IndexController {

    public function index () {

        if (Auth::check()) {
            $id = Service::get_session_param('user_id');

            Service::redirect('user/'.$id);
        }

        MVC::use_view('index/index');

        return true;
    }

}