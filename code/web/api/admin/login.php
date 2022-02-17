<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/functs.php");

    $password = param("password");
    if ($password == config("security.password")) {
        setSession("admin", true);
    }

    redirect("/admin/dashboard.php");
?>