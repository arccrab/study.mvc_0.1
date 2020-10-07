<?php

class PostModel {

    public static function createPost($user_id, $data) {
        $db_type = DB::type();
        $db = DB::init();

        if (!$db) {
            return false;
        }

        if ($db_type === 'redis') {
            $post_id = $db->get('next_post_id');

            $db->hset('post:'.$post_id, 'body', $data['body']);
            $db->hset('post:'.$post_id, 'time', time());
            $db->hset('post:'.$post_id, 'user_id', $user_id);
            $db->lpush('posts:'.$user_id, [$post_id]);

            $db->incr('next_post_id');

            return self::getPost($post_id);
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
            $list = array_reverse($list);

            $posts = [];
            $range[0]--;

            for ($i = $range[0]; $i < $range[1]; $i++) {
                if (isset($list[$i])) {
                    $posts[$list[$i]] = self::getPost($list[$i]);
                } else {
                    break;
                }

            }

            return $posts;
        }

        return false;
    }

    public static function getPost($post_id) {
        $db_type = DB::type();
        $db = DB::init();

        if (!$db) {
            return false;
        }

        if ($db_type === 'redis') {
            $post = $db->hgetall('post:'.$post_id);
            $post['post_id'] = $post_id;
            $post['time'] = date('Y-m-d H:i:s', $post['time']);

            return $post;
        }

        return false;
    }

    public static function editPost($post_id, $data) {
        $db_type = DB::type();
        $db = DB::init();

        if (!$db) {
            return false;
        }

        if ($db_type === 'redis') {
            $db->hset('post:'.$post_id, 'body', $data['body']);
            $db->hset('post:'.$post_id, 'time', time());

            return self::getPost($post_id);
        }

        return false;
    }
}