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
            $result['followers_count'] = 0;
            $result['following_count'] = 0;
            $result['posts_count'] = 0;

            $followers = $db->lrange('followers:'.$id, 0, -1);

            if (is_countable($followers)) {
                $result['followers_count'] = count($followers);
            }

            $following = $db->lrange('following:'.$id, 0, -1);

            if (is_countable($following)) {
                $result['following_count'] = count($following);
            }

            $posts = $db->lrange('posts:'.$id, 0, -1);

            if (is_countable($following)) {
                $result['posts_count'] = count($posts);
            }

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

    public static function editUser ($id, $data) {

        $db_type = DB::type();
        $db = DB::init();

        if (!$db || !$data['password'] || !$data['username']) {
            return false;
        }

        if ($db_type === 'redis') {

            if ($db->exists('user:'.$id)) {

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

    public static function deleteUser($id) {
        $db_type = DB::type();
        $db = DB::init();

        if (!$db) {
            return false;
        }

        if ($db_type === 'redis') {
            $user = self::getUserInfo($id);
            $username = $user['username'];

            $db->del('user:'.$id);
            $db->hdel('users', $username);

            if  (self::getUserInfo($id)) {
                return false;
            }

            return true;
        }

        return false;
    }

    public static function followUser($follow_id) {

        $db_type = DB::type();
        $db = DB::init();

        if (!$db) {
            return false;
        }

        $user_id = Service::get_session_param('user_id');

        if ($db_type === 'redis') {
            $db->lpush('following:'.$user_id, [$follow_id]);
            $db->lpush('followers:'.$follow_id, [$user_id]);

            return true;
        }

        return false;
    }

    public static function unfollowUser($follow_id) {

        $db_type = DB::type();
        $db = DB::init();

        if (!$db) {
            return false;
        }

        $user_id = Service::get_session_param('user_id');

        if ($db_type === 'redis') {
            $db->lrem('following:'.$user_id, 0, $follow_id);
            $db->lrem('followers:'.$follow_id, 0, $user_id);

            return true;
        }

        return false;
    }

    public static function checkFollow($follow_id) {

        $db_type = DB::type();
        $db = DB::init();

        if (!$db) {
            return false;
        }

        $user_id = Service::get_session_param('user_id');

        if ($db_type === 'redis') {
            $followers = $db->lrange('followers:'.$follow_id, 0, -1);

            if (array_search($user_id, $followers) !== false) {
                return true;
            }

            return false;
        }

        return false;
    }

    public static function getUserPosts($id, Array $range) {

        $db_type = DB::type();
        $db = DB::init();

        if (!$db) {
            return false;
        }

        if ($db_type === 'redis') {
            $list = $db->lrange('posts:'.$id, 0, -1);
            natsort($list);

            $list = array_values($list);

            $posts = [];
            $range[0]--;

            for ($i = $range[0]; $i < $range[1]; $i++) {
                if (isset($list[$i])) {
                    $posts[$list[$i]] = $db->hgetall('post:'.$list[$i]);
                    $posts[$list[$i]]['time'] = date('Y-m-d H:i:s', $posts[$list[$i]]['time']);
                } else {
                    break;
                }

            }

            $posts = array_reverse($posts);

            return $posts;
        }

        return false;
    }
}