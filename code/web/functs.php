<?php
    includeCommon();
    startSession();

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    function redirect($url, &$exists = null) {
        if ($exists && isset($exists)) {
            header("Location: " . $exists);
            die();
        }
        header("Location: " . $url);
        die();
    }


    function startSession() {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_set_cookie_params(315360000,"/");
            session_start();
        }
    }


    function resetSession() {
        $_SESSION["user"] = -1;
        $_SESSION["admin"] = -1;
    }


    function parseBetween($string, $start, $end){
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }


    function fromUTC($utc) {
        $time = new DateTime();
        $time->setTimestamp($utc);
        $tz =  new DateTimeZone('America/Denver');
        $offset = $tz->getOffset($time);
        $utc += $offset;
        return $utc;
    }


    function includeAll($ends) {
        arrayify($ends);
        foreach($ends as $end) {
            $file = $_SERVER["DOCUMENT_ROOT"] . "/" . $end . ".php";
            if(is_file($file)) {
                include_once($file);
            }
        }
        $dir = dirname($_SERVER["PHP_SELF"]);
        while ($dir != "/") {
            foreach($ends as $end) {
                $file = $_SERVER["DOCUMENT_ROOT"] . $dir . "/" . $end . ".php";
                if(is_file($file)) {
                    include_once($file);
                }
            }
            $dir = dirname($dir);
        }
    }


    function includeUtil($utils) {
        arrayify($utils);
        foreach($utils as $util) {
            if (is_file($_SERVER["DOCUMENT_ROOT"] . "/etc/" . $util . ".php")) {
                include_once($_SERVER["DOCUMENT_ROOT"] . "/etc/" . $util . ".php");
            }
            if (is_file($_SERVER["DOCUMENT_ROOT"] . "/etc/common/" . $util . ".php")) {
                include_once($_SERVER["DOCUMENT_ROOT"] . "/etc/common/" . $util . ".php");
            }
        }
    }


    function includeCommon() {
        foreach (glob($_SERVER["DOCUMENT_ROOT"] . "/etc/common/*.php") as $filename) {
            include_once($filename);
        }
    }


    function arrayify(&$arg) {
        if (!is_array($arg)) {
            return $arg = [$arg];
        }
        return $arg;
    }

    function verifyArray($arr, $checks, $error = null) {
        if ($error == null) {
            $error = function() {
                error("missing-params");
            };
        }
        foreach($checks as $check) {
            if (!isset($arr[$check])) {
                $error();
                return 0;
            }
        }
        return 1;
    }

    function assocArray($array) {
        return array_filter($array, function($key) {
            return is_string($key);
        }, ARRAY_FILTER_USE_KEY);
    }

    function value($array, $key) {
        if (isset($array[$key])) {
            return $array[$key];
        }
        return null;
    }


    function debug($params, $options = []) {
        $stack = (new Exception)->getTraceAsString();
        $stack = str_replace("\n", "\\n", $stack);
        arrayify($params);
        print('<script>console.log("');
        print('Debug:\n');
        foreach ($params as $param) {
            print(htmlspecialchars(json_encode($param)));
            print('\n');
        }
        print('\nTrace: ' . $stack);
        print('");</script>');
    }

    function setSession($key, $value) {
        $_SESSION[$key] = $value;
    }

    function getSession($key) {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
        return null;
    }

?>