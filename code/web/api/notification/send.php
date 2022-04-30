<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/functs.php");
    includeUtil(["notification"]);

    $targets["user"] = param(["user", false]);
    $targets["users"] = param(["users", false]);
    $title = param("title");
    $msg = param("msg");

    if (!$targets["user"] && !$targets["users"]) {
        authenticate("global-admins");
        foreach (readObject("users") as $user) {
            $targets["users"][] = $user["id"];
        }
    }

    notificationSend($title, $msg, "/help/mac", $targets);
?>