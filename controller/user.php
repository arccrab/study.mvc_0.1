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

    public function info($request) {

        $id = Service::get_uri_param($request, 1);
        $user_id = Service::get_session_param('user_id');

		MVC::use_model('user');
		$field['user_info'] = UserModel::getUserInfo($id);
		$field['user_info']['user_id'] = $id;

		if ($id !== $user_id) {
            $field['follow'] = UserModel::checkFollow($id);
        }

		MVC::use_view('user/index', $field);

		return true;
	}

    public function edit() {

        if (!Auth::check()) {
            Service::redirect('login');
        }

        $field['message'] = '';

        $id = Service::get_session_param('user_id');

        MVC::use_model('user');
        $field['user_info'] = UserModel::getUserInfo($id);

        if (!$_POST) {
            MVC::use_view('user/edit', $field);

            return true;
        }

        $data['password'] = Service::get_post_param('password');
        $data['username'] = Service::get_post_param('username');

        $result = UserModel::editUser($id, $data);

        if ($result) {
            $field['message'] = DB::get_state_message('user_edit_success');

            Service::redirect('user/'.$id);
        } else {
            $field['message'] = DB::get_state_message('user_edit_fail');

            MVC::use_view('user/edit', $field);
        }

        return true;
    }

	public function create() {
        if (Auth::check()) {
            Service::redirect('user/'.$_SESSION['user_id']);
        }

        $field['message'] = '';
        $field['username'] = '';

        if (!$_POST) {
            MVC::use_view('user/register');
            return true;
        }

        $data['password'] = Service::get_post_param('password');
        $data['password_check'] = Service::get_post_param('password_check');
        $data['username'] = Service::get_post_param('username');

        if  ($data['password'] !== $data['password_check']) {
            $field['message'] = DB::get_state_message('passwords_not_match');
            $field['username'] = $data['username'];

            MVC::use_view('user/register');
            return true;
        }

        if  (!$data['password'] || !$data['username']) {
            $field['message'] = DB::get_state_message('user_login_nodata');
            $field['username'] = $data['username'];

            MVC::use_view('user/register');
            return true;
        }

        MVC::use_model('user');
        $user_id = UserModel::createUser($data);

        if (!$user_id) {
            Debug::error('User "'.$data['username'].'" not created');

            Service::redirect('');
        }

        Service::set_session_param('user_id', $user_id);

        Service::redirect('user/'.$user_id);

        return true;
    }

    public function delete() {
        if (!Auth::check()) {
            Service::redirect('login');
        }

        MVC::use_model('user');

        $user_id = Service::get_session_param('user_id');

        if (!UserModel::deleteUser($user_id)) {
            Debug::error('user not deleted');
        }

        $field['message'] = DB::get_state_message('user_deleted');

        $this->logout();

        return true;
    }

    public function login() {

        if (Auth::check()) {
            Service::redirect('user/'.$_SESSION['user_id']);
        }

        $field['message'] = '';

        if (!$_POST) {
            MVC::use_view('user/login');

            return true;
        }

        $data['password'] = Service::get_post_param('password');
        $data['username'] = Service::get_post_param('username');

        if  (!$data['password'] || !$data['username']) {
            $field['message'] = DB::get_state_message('user_login_nodata');

            MVC::use_view('user/login');
            return true;
        }

        MVC::use_model('user');
        $user_id = UserModel::getUserId($data['username']);

        if (!$user_id || !UserModel::checkPassword($data['password'], $user_id)) {
            $field['message'] = DB::get_state_message('user_login_fail');

            MVC::use_view('user/login');
            return true;
        }

        $_SESSION['user_id'] = $user_id;

        Service::redirect('user/'.$user_id);

        return true;
    }

    public function logout() {
        session_destroy();
        Service::redirect('');
    }

    public function follow($request) {

        $follow_id = Service::get_uri_param($request, 1);
        $user_id = Service::get_session_param('user_id');

        if ($follow_id === $user_id) {
            return true;
        }

        MVC::use_model('user');
        UserModel::followUser($follow_id);

        Service::redirect('user/'.$follow_id);

        return true;
    }

    public function unfollow($request) {

        $follow_id = Service::get_uri_param($request, 1);
        $user_id = Service::get_session_param('user_id');

        if ($follow_id === $user_id) {
            return true;
        }

        MVC::use_model('user');
        UserModel::unfollowUser($follow_id);

        Service::redirect('user/'.$follow_id);

        return true;
    }
}
