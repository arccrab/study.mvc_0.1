<?php
MVC::use_view('app/head');
MVC::use_view('app/header');
?>

<main class="container">
    <div class="jumbotron my-4">
        <h1 class="display-4">Edit user</h1>
        <form action="/user/edit" method="post">
            <div class="col-md-6 pl-0 my-3">
                <label for="username">Username</label>
                <input class="form-control" type="text" id="username" name="username" value="<?= $field['user_info']['username']; ?>">
            </div>

            <div class="col-md-6 pl-0 my-3">
                <label for="password">Password</label>
                <input class="form-control" type="password" id="password" name="password" placeholder="Password">
            </div>
            <hr class="my-4">
            <p><?= $field['message']; ?></p>
            <button class="btn btn-primary btn-lg">Edit</button>
        </form>
    </div>
</main>

<?php
MVC::use_view('app/footer');
?>