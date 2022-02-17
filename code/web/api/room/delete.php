<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/functs.php");

    checkAdmin();

    $id = param("id");
    deleteObject("rooms", ["id" => $id]);

    redirect("/admin/dashboard.php");
?>