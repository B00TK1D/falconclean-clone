<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/functs.php");

    $subscription = json_decode(file_get_contents('php://input'), true);

    if (!isset($subscription['endpoint'])) {
        print("Error: not a subscription");
        return;
    }

    $method = $_SERVER['REQUEST_METHOD'];

    $user = checkJoined();

    print(file_get_contents('php://input'));

    $endpoint["endpoint"] = $subscription["endpoint"];

    if ($method == "POST") {
        $endpoint["auth"] = $subscription["keys"]["auth"];
        $endpoint["p256dh"] = $subscription["keys"]["p256dh"];
        $endpoint["user"] = $user;
        $endpoint["device"] = 0;
        createObject("notification_endpoints", $endpoint);
    } elseif ($method == "PUT") {
        if ($user != null) $endpoint["user"] = $user["id"];
        if ($admin != null) $endpoint["user"] = (-$admin["id"]);
        $endpoint["device"] = 0;
        updateObject("notification_endpoints", $endpoint, ["endpoint" => $endpoint["endpoint"]]);
    } elseif ($method == "DELETE") {
        deleteObject("notification_endpoints", ["endpoint" => $endpoint["endpoint"]]);
    } else {
        print("Error: method not handled");
    }

?>