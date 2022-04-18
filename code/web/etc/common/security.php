<?php
    function sanitize($string) {
        return htmlspecialchars($string);
    }

    function getHash($string) {
        return password_hash($string, PASSWORD_DEFAULT);
    }

    function checkHash($password, $hash) {
        return password_verify($password, $hash);
    }

    function basicAuth($password) {
        if (checkHash($password, config("security.password"))) {
            return true;
        }
        return false;
    }

    function checkAdmin() {
        if (getSession("admin") == true) {
            return true;
        }
        redirect("/admin/login.php");
    }

    function checkJoined() {
        if (getSession("userID") != null) {
            return getSession("userID");
        }
        redirect("/join.php");
    }
?>