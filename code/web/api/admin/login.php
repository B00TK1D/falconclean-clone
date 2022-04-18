<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/functs.php");

    $redirect = param("redirect");

    $password = param("password");
    if ($password == config("security.password")) {
        setSession("admin", true);
    }
    
    if ($redirect != "") {
        redirect($redirect);
    }
    redirect("/admin/dashboard.php");
?>