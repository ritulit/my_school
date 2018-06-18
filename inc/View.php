<?php
class View {
    const PATH = 'mvc/views/';


    public static function render($view_name, $data) {
        $view_filename  = sprintf("%s.php", $view_name);
        //profile.php

        $view_path      = self::PATH . $view_filename;


        if(!file_exists($view_path)) {

            $view_path      = self::PATH . "notFound.php";
        }

        extract($data);

        include($view_path);
    }
}
