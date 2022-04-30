<?php
    global $config;
    $config = [
        "mysql" => [
            "web" => [
                "host" => "falconclean.db",
                "database" => "falconclean",
                "user" => "root",
                "password" => $_ENV["MYSQL_PASSWORD"],
            ]
        ],
        "security" => [
            "password" => "1337",
        ],
        "deployment" => [
            "domain" => "falconclean.app",
        ],
        "messages" => [
            "notify" => [
                "title" => "Falcon Clean",
                "msg" => "Your laundry is done, please pick it up!",
            ],
        ],
        "notification" => [
            "public_key" => $_ENV["PUSH_PUBLIC_KEY"],
            "private_key" => $_ENV["PUSH_PRIVATE_KEY"],
            "status" => [
                "unsent" => 0,
                "sent" => 1,
                "read" => 2,
            ],
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