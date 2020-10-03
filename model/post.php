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

            return $post_id;
        }

        return false;
    }

}