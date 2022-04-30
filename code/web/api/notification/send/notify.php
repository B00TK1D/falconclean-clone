<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/functs.php");
    includeUtil(["notification"]);

    $qr = param("qr");

    $machine = readObject("machines", ["qr" => $qr], 1);
    if ($machine == null) {
        redirect("/success/notify.php");
    }

    $load = readObject("loads", ["machineID" => $machine["id"]], 1);
    if ($load == null) {
        redirect("/success/notify.php");
    }

    $user = readObject("users", ["id" => $load["userID"]], 1);
    if ($user == null) {
        redirect("/success/notify.php");
    }

    notificationSend(config("messages.notify.title"), config("messages.notify.msg"), "/", ["users" => [$user]]);

    redirect("/success/notify.php");
?>