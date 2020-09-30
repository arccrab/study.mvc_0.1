<?php

class IndexController {

    public function index () {

        MVC::use_view('index/index');

        return true;
    }

}