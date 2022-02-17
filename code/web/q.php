<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/functs.php");

    $qr = param("r");
    $machine = readObject("machines", ["qr" => $qr], 1);

    if ($machine == null) {
        redirect("/admin/assign.php");
    }

    redirect("/load.php?id=" . $machine["loadID"]);
?>