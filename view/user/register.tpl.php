<?php
MVC::use_view('app/head');
MVC::use_view('app/header');
?>

<main class="container">
    <div class="jumbotron my-4">
        <h1 class="display-4">Register</h1>
        <form action="/register" method="post">
            <div class="col-md-6 pl-0 my-3">
                <label for="username">Username</label>
                <input class="form-control" type="text" id="username" name="username" placeholder="Username">
            </div>

            <div class="col-md-6 pl-0 my-3">
                <label for="password">Password</label>
                <input class="form-control" type="password" id="password" name="password" placeholder="Password">
            </div>

            <div class="col-md-6 pl-0 my-3">
                <label for="password_check">Confirm Password</label>
                <input class="form-control" type="password" id="password_check" name="password_check" placeholder="Confirm password">
            </div>
            <hr class="my-4">
            <button class="btn btn-primary btn-lg">Join!</button>
        </form>
    </div>
</main>

<?php
MVC::use_view('app/footer');
?>