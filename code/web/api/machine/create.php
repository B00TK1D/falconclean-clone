<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/functs.php");

    checkAdmin();

    $machine = schemaParam(objectFields("machine"));

    $machineID = createObject("machines", $machine);

    redirect("/admin/success.php");
?>