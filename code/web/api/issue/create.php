<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/functs.php");

    $issue = schemaParam(objectFields("issues"));
    $issue["userID"] = checkJoined();

    $issueID = createObject("issues", $issue);

    redirect("/success/report.php");
?>