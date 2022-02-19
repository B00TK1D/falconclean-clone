<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/functs.php");
    includeUtil("security");

    function param($param, $options = []) {
        $value = null;
        startSession();
        arrayify($param);
        $displayError = value($options, "displayError");
        $sanitize = value($options, "sanitize");
        $sticky = value($options, "sticky");
        if ($sanitize == null) {
            $sanitize = true;
        }
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if (isset($_GET[$param[0]])) {
                if ($sanitize) {
                    $value = sanitize($_GET[$param[0]]);
                } else {
                    $value = $_GET[$param[0]];
                }
                if ($sticky) {
                    $_SESSION[$_SERVER["SCRIPT_NAME"]][$param[0]] = $value;
                }
            } elseif ($sticky) {
                if (isset($_SESSION["global"][$param[0]])) {
                    $value = $_SESSION["global"][$param[0]];
                } elseif (isset($_SESSION[$_SERVER["SCRIPT_NAME"]][$param[0]])) {
                    $value = $_SESSION[$_SERVER["SCRIPT_NAME"]][$param[0]];
                } elseif (array_key_exists(1, $param)) {
                    $value = $param[1];
                }
            }  elseif (array_key_exists(1, $param)) {
                $value = $param[1];
            } else {
                error("missing-params", $displayError);
            }
        } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST[$param[0]])) {
                if ($sanitize) {
                    $value = sanitize($_POST[$param[0]]);
                } else {
                    $value = $_POST[$param[0]];
                }
                if ($sticky) {
                    $_SESSION[$_SERVER["SCRIPT_NAME"]][$param[0]] = $value;
                }
            } elseif ($sticky) {
                if (isset($_SESSION["global"][$param[0]])) {
                    $value = $_SESSION["global"][$param[0]];
                } elseif (isset($_SESSION[$_SERVER["SCRIPT_NAME"]][$param[0]])) {
                    $value = $_SESSION[$_SERVER["SCRIPT_NAME"]][$param[0]];
                } elseif (array_key_exists(1, $param)) {
                    $value = $param[1];
                }
            } elseif (array_key_exists(1, $param)) {
                $value = $param[1];
            } else {
                error("missing-params", $displayError);
            }
        }
        return $value;
    }

    function setParam($param, $value, $global = true) {
        if ($global) {
            $_SESSION["global"][$param] = $value;
        } else {
            $_SESSION[$_SERVER["SCRIPT_NAME"]][$param] = $value;
        }
    }

    function clearParam($param, $global = false) {
        if ($global) {
            unset($_SESSION["global"][$param]);
        } else {
            unset($_SESSION[$_SERVER["SCRIPT_NAME"]][$param]);
        }
    }

    function schemaParam($fields, $requirements = []) {
        $params = [];
        foreach ($fields as $field => $value) {
            $param = param([$field, null], ["sticky" => true]);
            if ($param != null) $params[$field] = $param;
        }
        foreach ($requirements as $requirement) {
            if (!isset($params[$requirement])) error("missing-params");
        }
        return $params;
    }

    function prefixParam($prefix) {
        $params = [];
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, strlen($prefix)) == $prefix) {
                $params[substr($key, strlen($prefix))] = $value;
            }
        }
        foreach ($_POST as $key => $value) {
            if (substr($key, 0, strlen($prefix)) == $prefix) {
                $params[substr($key, strlen($prefix))] = $value;
            }
        }
        return $params;
    }
?>