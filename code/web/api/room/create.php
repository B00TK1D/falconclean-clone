<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/functs.php");

    checkAdmin();

    $machine = schemaParam(objectFields("room"));

    $machineID = createObject("rooms", $machine);

    redirect("/admin/dashboard.php");
?>