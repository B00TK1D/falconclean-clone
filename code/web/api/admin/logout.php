<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/functs.php");

    setSession("admin", false);
    redirect("/admin/login.php");

?>