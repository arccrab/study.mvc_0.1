<?php

/**
 * param example user/1001 - info
 * param example user/edit - edit
 * param example user/delete - delete
 * param example user/create - create
 * param example follow/1001 - follow
 * param example unfollow/1001 - unfollow
 *
 */
class UserController
{

    public function checkData($data) {
        return true;
    }



//
    public function info($request) {

//      ___________
//      $this->checkData($request);
//      $this->checkAuth($request);
//		____________

        $id = Service::get_uri_param($request, 1);

		MVC::use_model('user');
		$field = UserModel::getUserInfo($id);

		if ($field) {
            MVC::use_view('user/index', $field);
        }

		return true;
	}

    public function edit() {
//      ___________
//      $this->checkAuth($request);
//		____________
        if (!Auth::check()) {
            return false;
        }

        $id = Service::get_session_param('user_id');

        MVC::use_model('user');
        $field = UserModel::getUserInfo($id);
        $result = UserModel::editUserInfo($id, $field);

        if ($result) {
            $field['message'] = DB::get_state_message('user_edit_success');
        } else {
            $field['message'] = DB::get_state_message('user_edit_fail');
        }

        if ($field) {
            MVC::use_view('user/edit', $field);
        }

        return true;

    }

	public function create($request) {

//      ___________
//      $this->checkData($request);
//      $this->checkAuth($request);
//		____________

    }


    public function delete($request) {

    }

    public function follow($request) {

    }

    public function unfollow($request) {

    }

    public function login() {
        $data['password'] = Service::get_post_param('password');
        $data['username'] = Service::get_post_param('username');

        MVC::use_model('user');

        $user_id = UserModel::getUserId($data['username']);

        if  (!$user_id) {
            return false;
        }

        if (!UserModel::checkPassword($data['password'], $user_id)) {
            return false;
        }

        $_SESSION['user_id'] = $user_id;
        return true;
    }

}
