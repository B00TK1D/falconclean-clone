<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/functs.php");

    checkAdmin();

    $machine = schemaParam(objectFields("machine"));

    $machineID = createObject("machines", $machine);

    print($machineID);

    //redirect("/admin/success.php");
?>