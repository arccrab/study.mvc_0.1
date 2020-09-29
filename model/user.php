<?php

class UserModel {
    public static function getUserInfo ($id) {

        $db_type = DB::type();
        $db = DB::init();

        if (!$db) {
            return false;
        }

        if ($db_type === 'redis') {
            $result = $db->hgetall('user:'.$id);
        } else {
            $result = false;
        }


//        add return array with fields, will use in controller
//        now only printing (String)

        return $result;
    }

    public static function getUserId ($username) {

        $db_type = DB::type();
        $db = DB::init();

        if (!$db) {
            return false;
        }

        $username = Auth::filter_str($username);

        if ($db_type === 'redis') {
            $result = $db->hget('users', $username);

            if (!$result) {
                return false;
            }
        } else {
            $result = false;
        }


//        add return array with fields, will use in controller
//        now only printing (String)

        return $result;
    }

    public static function checkPassword(String $password, $user_id) {
        $db_type = DB::type();
        $db = DB::init();

        if (!$db) {
            return false;
        }

        if ($db_type === 'redis') {
            $result = $db->hget('user:'.$user_id, 'passkey');

            if (!Auth::check_hash($password, $result)) {
                return false;
            }
            return true;
        }

        return false;
    }

    public static function editUserInfo ($id, $data) {

        $db_type = DB::type();
        $db = DB::init();

        if (!$db) {
            return false;
        }

        if ($db_type === 'redis') {

            if ($db->exists('user:'.$id)) {

                $db->hset('user:'.$id, 'username', $data['username']);

                $data['password'] = Service::get_post_param('password');

                if (!$data['password']) {
                    return false;
                }

                $data['passkey'] = Auth::create_hash($data['password']);

                $db->hset('user:'.$id, 'username', $data['username']);
                $db->hset('user:'.$id, 'passkey', $data['passkey']);

                return true;

            } else {
                return false;
            }
        } else {
            $result = false;
        }

//        add return array with fields, will use in controller
//        now only printing (String)

        return $result;
    }

    public static function createUser($data) {

        $db_type = DB::type();
        $db = DB::init();

        if (!$db) {
            return false;
        }

        if ($db_type === 'redis') {
            $id = $db->get('next_user_id');

            $db->hset('user:'.$id, 'username', $data['username']);

            $data['passkey'] = Auth::create_hash($data['password']);

            $db->hset('user:'.$id, 'username', $data['username']);
            $db->hset('user:'.$id, 'passkey', $data['passkey']);
            $db->hset('users', $data['username'], $id);

            $db->incr('next_user_id');

            return $id;
        }

        return false;
    }
}