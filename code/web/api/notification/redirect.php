<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/functs.php");

    $id = param("notification");
    $notification = readObject("notifications", ["id" => $id], 1);
    if ($notification == null) {
        error();
    }
    $notification["status"] = config("notification.status.read");
    updateObject("notifications", $notification, ["id" => $id]);
    redirect($notification["redirect"]);
?>