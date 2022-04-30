<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/functs.php");

    $qr = param("r");
    $machine = readObject("machines", ["qr" => $qr], 1);

    if ($machine == null) {
        checkAdmin();
        redirect("/admin/assign.php?qr=" . $qr);
    }

    setParam("machineID", $machine["id"]);
    setParam("qr", $qr); 

    $userID = checkJoined();

    $currentLoad = readObject("loads", ["machineID" => $machine["id"]], 1);
    $machineType = readObject("types", ["id" => $machine["typeID"]], 1);
    
    if ($currentLoad != null && time_elapsed_minutes($currentLoad["load"]) < $machineType["cycleTime"]) {
      redirect("/busy.php");
    }

    $issues = readObject("issues", ["machineID" => $machine["id"]]);

    if (count($issues) > 0) {
        redirect("/alert.php");
    }

    redirect("/load.php");
?>