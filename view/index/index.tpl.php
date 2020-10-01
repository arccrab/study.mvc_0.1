<?php
MVC::use_view('app/head');
MVC::use_view('app/header');
?>

    <main class="container">
        <div class="jumbotron my-4">
            <h1 class="display-4">Hi!</h1>
            <p>This is a simple social networking project.</p>
            <p class="lead">Let's start!</p>
            <hr class="my-4">
            <a class="btn btn-primary btn-lg" href="/login" role="button">Existing user</a>
            /
            <a class="btn btn-primary btn-lg" href="/register" role="button">New user</a>
        </div>
    </main>

<?php
MVC::use_view('app/footer');
?>