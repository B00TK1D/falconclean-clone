<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/functs.php");

    checkAdmin();

    $id = param("id");
    deleteObject("invoices", ["id" => $id]);

    redirect("/admin/dashboard.php");
?>