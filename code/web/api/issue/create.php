<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/functs.php");

    $issue = schemaParam(objectFields("issues"));
    $issue["userID"] = checkJoined();

    $issueID = createObject("loads", $load);

    redirect("/success/report.php");
?>