<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/functs.php");

    $qr = param("r");
    $machine = readObject("machines", ["qr" => $qr], 1);

    if ($machine == null) {
        checkAdmin();
        redirect("/admin/assign.php?qr=" . $qr);
    }

    setParam("machineID", $machine["id"]);

    $userID = checkJoined();

    $issues = readObject("issues", ["machineID" => $machine["id"]]);

    if (count($issues) > 0) {
        redirect("/alert.php");
    }

    redirect("/load.php");
?>