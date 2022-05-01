<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/functs.php");

    $user["name"] = param("name");
    $userID = createObject("users", $user);

    setSession("name", $user["name"]);
    setSession("userID", $userID);

    redirect("/load.php");
?>