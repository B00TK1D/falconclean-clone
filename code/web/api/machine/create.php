<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/functs.php");

    checkAdmin();

    $machine = schemaParam(objectFields("machines"));

    $machineID = createObject("machines", $machine);

    redirect("/admin/success.php");
?>