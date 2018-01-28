<?php
/**
 * Class Autologin
 */

class Autologin
{
    /**
     * @return array
     */
    function credentials()
    {
        return array($_ENV['MYSQL_HOST'], 'root', $_ENV['MYSQL_ROOT_PASSWORD']);
    }

    /**
     * @return mixed
     */
    function database()
    {
        return $_ENV['MYSQL_DATABASE'];
    }

    /**
     * @return bool
     */
    function loginForm()
    {
        ?>
        <table cellspacing="0">
            <select name='auth[driver]'><option value="server" selected>MySQL</select>
            <tr><th>Server<td><input name="auth[server]" value="<?=$_ENV['MYSQL_HOST']?>" title="hostname[:port]" autocapitalize="off">
            <tr><th>Username<td><input name="auth[username]" id="username" value="<?='root'?>" autocapitalize="off">
            <tr><th>Password<td><input type="password" name="auth[password]" value="<?=$_ENV['MYSQL_ROOT_PASSWORD']?>">
            <tr><th>Database<td><input name="auth[db]" value="<?=$_ENV['MYSQL_DATABASE']?>" autocapitalize="off" placeholder="WordPress">
        </table>
        <p><input id="submit-button" type="submit" value="<?php echo lang('Login'); ?>">
        <script>document.getElementById("submit-button").click()</script>
        <?php
        echo checkbox("auth[permanent]", 1, $_COOKIE["adminer_permanent"], lang('Permanent login')) . "\n";
        return true;
    }
}

// return singleton module
return new Autologin();
