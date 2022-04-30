<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/functs.php");
    includeUtil(["composer"]);

    use Minishlink\WebPush\WebPush;
    use Minishlink\WebPush\Subscription;


    function notificationSend($title, $msg, $url, $targets) {
        $endpoints = [];
        if (isset($targets["user"])) {
            $endpoint = readObject("notification_endpoints", ["user" => $targets["user"]], 1);
            if ($endpoint) $endpoints[] = $endpoint;
        }
        if (isset($targets["users"])) {
            foreach ($targets["users"] as $user) {
                $userEndpoints = readObject("notification_endpoints", ["user" => $user]);
                foreach($userEndpoints as $endpoint) {
                    $endpoints[] = $endpoint;
                }
            }
        }

        $auth = array(
            'VAPID' => array(
                'subject' => config("notification.subject"),
                'publicKey' => config("notification.public_key"),
                'privateKey' => config("notification.private_key"),
            ),
        );


        foreach ($endpoints as $endpoint) {
            $notification["status"] = config("notification.status.sent");
            $notification["redirect"] = $url;
            $notification["endpoint"] = $endpoint["id"];
            $notification["id"] = createObject("notifications", $notification);

            $subscription = Subscription::create([
                "endpoint" => $endpoint["endpoint"],
                "keys" => [
                    "p256dh" => $endpoint["p256dh"],
                    "auth" => $endpoint["auth"],
                ],
                "contentEncoding" => "aes128gcm"
            ]);

            $webPush = new WebPush($auth);

            $payload = json_encode([
                "type" => "push",
                "title" => $title,
                "msg" => $msg,
                "icon" => "/img/icon.png",
                "badge" => "/img/icon.png",
                "image" => "/img/icon.png",
                "tag" => time(),
                "vibrate" => [100, 100, 300, 100, 100, 300],
                "url" => "https://" . config("deployment.domain") . "/api/notification/redirect?notification=" . $notification["id"],
            ]);

            $result = $webPush->sendOneNotification(
                $subscription,
                $payload
            );
        }
    }

?>