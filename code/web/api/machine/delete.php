<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/functs.php");

    checkAdmin();

    $id = param("id");
    deleteObject("machines", ["id" => $id]);

    redirect("/admin/dashboard.php");
?>