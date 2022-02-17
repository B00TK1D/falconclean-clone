<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/functs.php");

    $qr = param("r");
    $machine = readObject("machines", ["qr" => $qr], 1);

    if ($machine == null) {
        redirect("/admin/assign.php?qr=" . $qr);
    }

    $userID = checkJoined();

    $issues = readObjects("issues", ["machineID" => $machine["id"]]);

    if (count($issues) > 0) {
        redirect("/alert.php?machineID=" . $machine["id"]);
    }

    redirect("/load.php?machineID=" . $machine["loadID"]);
?>