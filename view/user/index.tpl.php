<?php
MVC::use_view('app/head');
MVC::use_view('app/header');
?>

<main class="container">
    <div class="row px-0">
    <div class="col-lg-4" id="user-info">
        <div class="jumbotron my-4">
            <h1 class="display-4">@<?= $field['user_info']['username'] ?></h1>
            <p class="lead">Hello, I'm fine, thanks =)</p>
            <p>Registered: <span class="lead">11 Aug 2045</span></p>
            <p id="post-counter">Posts: <span class="lead"><?= $field['user_info']['posts_count'] ?></span></p>
            <p>Followers: <span class="lead"><?= $field['user_info']['followers_count'] ?></span></p>
            <p>Following: <span class="lead"><?= $field['user_info']['following_count'] ?></span></p>
            <hr class="my-4">
            <?php
            if (isset($field['follow']) && $field['follow']) {
            ?>
                <a class="btn btn-outline-secondary btn-lg" href="/unfollow/<?= $field['user_info']['user_id'] ?>" role="button">Unfollow</a>
            <?php
            } elseif (isset($field['follow']) && !$field['follow']) {
            ?>
                <a class="btn btn-primary btn-lg" href="/follow/<?= $field['user_info']['user_id'] ?>" role="button">Follow</a>
            <?php
            }
            ?>
        </div>
    </div>
    <div class="col-lg-8" id="user-posts">
        <div class="jumbotron my-4 py-4" id="create-post">
            <h4>New Post</span></h4>
            <form action="/post/create" method="post">
                <textarea class="form-control my-4" id="new_post" name="new_post" placeholder="Say what you think..."></textarea>
                <button class="btn btn-outline-primary my-2" type="button">Post</button>
            </form>
        </div>
        <hr style="border-color: white">
<!-------------------------------------------------------------------->
        <div class="jumbotron my-4 py-4 d-none" id="post-template">
            <h4>@<?= $field['user_info']['username'] ?> <span class="badge badge-secondary"></span></h4>
            <p class="post-body"></p>
<!--            <a class="btn btn-primary" href="/post/like/--><?//= $post_id ?><!--" role="button">Like</a>-->
<!--            <a class="btn btn-primary" href="/post/comment/--><?//= $post_id ?><!--" role="button">Comment</a>-->
<!--            <form action="/post/edit/" method="post">-->
<!--                <textarea class="form-control my-4" id="comment" name="comment" placeholder="Say what you think..."></textarea>-->
<!--                <button class="btn btn-primary" type="button">Edit</button>-->
<!--            </form>-->
        </div>
<!-------------------------------------------------------------------->
        <?php
        foreach ($field['posts'] as $post_id => $post) {
        ?>
            <div class="jumbotron my-4 py-4 post">
                <nav class="post-setting float-right py-2 my-1">
                    <button class="btn btn-primary btn-edit fa fa-pencil"></button>
<!--                    <button class="btn btn-primary btn-comment fa fa-comment"></button>-->
                    <button class="btn btn-primary btn-like fa fa-heart"></button>
                </nav>
                <div class="post-heading"><h4>@<?= $field['user_info']['username'] ?> <span class="badge badge-secondary"><?= $post['time'] ?></span></h4></div>
                <div class="post-body"><?= $post['body'] ?></div>
                <div class="post-forms">
                    <form class="post-edit d-none" action="/post/<?= $post['post_id'] ?>/edit" method="post">
                        <label for="body">Edit post</label>
                        <textarea class="form-control mb-4" name="body" id="body"><?= $post['body'] ?></textarea>
                        <button class="btn btn-success btn-edit-submit" type="button">Edit</button>
                    </form>
                    <form class="post-comment d-none" action="/post/<?= $post['post_id'] ?>/comment" method="post">
                        <label for="comment">Add comment</label>
                        <textarea class="form-control mb-4" name="comment" id="comment"><?= $post['body'] ?></textarea>
                        <button class="btn btn-success btn-comment-submit" type="button">Comment</button>
                    </form>
                </div>
                <span class="post-id"><?= $post['post_id'] ?></span>
            </div>
        <?php
        }
        ?>
    </div>
    </div>
</main>

</body>
</html>