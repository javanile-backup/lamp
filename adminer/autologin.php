<?php
/**
 * Created by PhpStorm.
 * User: mauro
 * Date: 07/09/17
 * Time: 00:34
 */

class Autologin {
    function credentials() {
        //if (!empty($_GET['username'])) return array(SERVER, $_GET["username"], get_password());
        return array($_ENV['ADMINER_SERVER'], $_ENV['ADMINER_USER'], $_ENV['ADMINER_PASSWORD']);
    }
    function database() {
        return $_ENV['ADMINER_DATABASE'];
    }
}

return new Autologin();
