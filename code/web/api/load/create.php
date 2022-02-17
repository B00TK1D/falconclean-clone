<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/functs.php");

    $load = schemaParam(objectFields("loads"));
    $load["userID"] = checkJoined();

    $loadID = createObject("loads", $load);

    redirect("/success/load.php");
?>