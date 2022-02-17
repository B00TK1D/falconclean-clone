<?php
    global $config;
    $config = [
        "mysql" => [
            "web" => [
                "host" => "localhost",
                "database" => "falconclean",
                "user" => "falconclean",
                "password" => "falconcleansupersecretlongasspassword4db",
            ]
        ],
        "security" => [
            "password" => "6716",
        ],
    ];

    function config($key) {
        global $config;
        $exploded_key = explode(".", $key);
        $current_obj = $config;
        foreach ($exploded_key as $subkey) {
            if (isset($current_obj[$subkey]) ) {
                $current_obj = $current_obj[$subkey];
            } else {
                return null;
            }
        }
        return $current_obj;
    }

    function configValue(&$val, $pre = "") {
        if (is_string($val)) {
            return config($pre . "." . $val);
        }
        return $val;
    }
?>