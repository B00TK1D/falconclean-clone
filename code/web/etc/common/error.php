<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/functs.php");
    includeUtil("messages");

    function error($code = 0, $displayError = true) {
        if ($displayError) {
            redirect("/utils/error?code=" . $code);
        }
        die();
    }
?>