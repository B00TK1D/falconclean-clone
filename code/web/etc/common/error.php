<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/functs.php");
    includeUtil("messages");

    function error($code = 0, $displayError = true) {
        if ($displayError) {
            if (is_string($code)) {
                $code = code($code);
            }
            redirect("/utils/error?code=" . $code);
        }
        die();
    }
?>