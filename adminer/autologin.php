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

    function loginForm() {
        ?>
        AAA
        <table cellspacing="0">
            <tr><th>System<td><select name='auth[driver]'><option value="server" selected>MySQL</select>
            <tr><th>Server<td><input name="auth[server]" value="" title="hostname[:port]" placeholder="localhost" autocapitalize="off">
            <tr><th>Username<td><input name="auth[username]" id="username" value="" placeholder="WordPress" autocapitalize="off">
            <tr><th>Password<td><input type="password" name="auth[password]" placeholder="WordPress">
            <tr><th>Database<td><input name="auth[db]" value="" autocapitalize="off" placeholder="WordPress">
        </table>
        <p><input type="submit" value="<?php echo lang('Login'); ?>">
        <?php
        echo checkbox("auth[permanent]", 1, $_COOKIE["adminer_permanent"], lang('Permanent login')) . "\n";
        return true;
    }

}

return new Autologin();
