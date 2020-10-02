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
            <p>Posts: <span class="lead"><?= $field['user_info']['posts_count'] ?></span></p>
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
        <div class="jumbotron my-4 py-4">
            <h4>@<?= $field['user_info']['username'] ?> <span class="badge badge-secondary">14 hours ago</span></h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci aspernatur assumenda, est id necessitatibus similique! Accusamus aliquid amet, aperiam dignissimos, enim explicabo impedit incidunt possimus quis ratione repellat suscipit temporibus.</p>
            <a class="btn btn-primary" href="/post/like/POST_ID" role="button">Like</a>
            <a class="btn btn-primary" href="/post/repost/POST_ID" role="button">Repost</a>
            <a class="btn btn-primary" href="/post/comment/POST_ID" role="button">Comment</a>
            <form action="/comment/POST_ID">
                <textarea class="form-control my-4" id="comment" name="comment" placeholder="Say what you think..."></textarea>
                <button class="btn btn-outline-success" href="/post/repost/POST_ID">Comment</button>
            </form>
        </div>
        <div class="jumbotron my-4 py-4">
            <h4>@<?= $field['user_info']['username'] ?> <span class="badge badge-secondary">18 hours ago</span></h4>
            <p>Make, kind they're the. Was two. Under. Brought. Upon spirit green evening place created Fill be every good creeping great, open, moveth good from. Divided signs likeness fowl sixth of great life moveth.

                Form under. Replenish, green lesser it created give divide. Meat fish light third fly gathered waters days light tree fly one under moved. May saying whales fill our saw divide so.

                Made night seas you're wherein after god their fish years day blessed behold there moved subdue night beast blessed evening land rule saying lights appear dry every first it whales the day grass. Doesn't god he.</p>
            <a class="btn btn-primary" href="/post/like/POST_ID" role="button">Like</a>
            <a class="btn btn-primary" href="/post/repost/POST_ID" role="button">Repost</a>
            <a class="btn btn-primary" href="/post/comment/POST_ID" role="button">Comment</a>
            <form action="/comment/POST_ID">
                <textarea class="form-control my-4" id="comment" name="comment" placeholder="Say what you think..."></textarea>
                <button class="btn btn-outline-success" href="/post/repost/POST_ID">Comment</button>
            </form>
        </div>
        <div class="jumbotron my-4 py-4">
            <h4>@<?= $field['user_info']['username'] ?> <span class="badge badge-secondary">19 hours ago</span></h4>
            <p>Make, kind they're the. Was two. Under. Brought. Upon spirit green evening place created Fill be every good creeping great, open, moveth good from. Divided signs likeness fowl sixth of great life moveth.

                Form under. Replenish, green lesser it created give divide. Meat fish light third fly gathered waters days light tree fly one under moved. May saying whales fill our saw divide so.

                Made night seas you're wherein after god their fish years day blessed behold there moved subdue night beast blessed evening land rule saying lights appear dry every first it whales the day grass. Doesn't god he.</p>
            <a class="btn btn-primary" href="/post/like/POST_ID" role="button">Like</a>
            <a class="btn btn-primary" href="/post/repost/POST_ID" role="button">Repost</a>
            <a class="btn btn-primary" href="/post/comment/POST_ID" role="button">Comment</a>
            <form action="/comment/POST_ID">
                <textarea class="form-control my-4" id="comment" name="comment" placeholder="Say what you think..."></textarea>
                <button class="btn btn-outline-success" href="/post/repost/POST_ID">Comment</button>
            </form>
        </div>
        <div class="jumbotron my-4 py-4">
            <h4>@<?= $field['user_info']['username'] ?> <span class="badge badge-secondary">21 hours ago</span></h4>
            <p>Make, kind they're the. Was two. Under. Brought. Upon spirit green evening place created Fill be every good creeping great, open, moveth good from. Divided signs likeness fowl sixth of great life moveth.

                Form under. Replenish, green lesser it created give divide. Meat fish light third fly gathered waters days light tree fly one under moved. May saying whales fill our saw divide so.

                Made night seas you're wherein after god their fish years day blessed behold there moved subdue night beast blessed evening land rule saying lights appear dry every first it whales the day grass. Doesn't god he.</p>
            <a class="btn btn-primary" href="/post/like/POST_ID" role="button">Like</a>
            <a class="btn btn-primary" href="/post/repost/POST_ID" role="button">Repost</a>
            <a class="btn btn-primary" href="/post/comment/POST_ID" role="button">Comment</a>
            <form action="/comment/POST_ID">
                <textarea class="form-control my-4" id="comment" name="comment" placeholder="Say what you think..."></textarea>
                <button class="btn btn-outline-success" href="/post/repost/POST_ID">Comment</button>
            </form>
        </div>
    </div>
    </div>
</main>

</body>
</html>