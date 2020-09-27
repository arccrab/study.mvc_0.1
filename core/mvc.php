<?php

class MVC {

    public static function use_model(String $model) {
        if (require_once DIR."/model/".$model.".php") {
            return true;
        }

        return false;
    }

    public static function use_view(String $view, Array $field) {

        if (require_once DIR."/view/".$view.".tpl.php") {
            return true;
        }

        return false;
    }
}