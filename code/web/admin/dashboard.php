<?php
  include_once($_SERVER["DOCUMENT_ROOT"] . "/functs.php");

  $reportList = readObject("issues");
  $users = readObject("users");

  foreach ($reportList as $report) {
    $report["machine"] = readObject("machines", ["id" => $report["machineID"]]);
    $report["user"] = readObject("users", ["id" => $report["userID"]]);
    $report["room"] = readObject("rooms", ["id" => $report["machine"]["roomID"]]);
  }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Dashboard</title>
    <meta content="Reports" property="og:title" />
    <meta content="Reports" property="twitter:title" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="Webflow" name="generator" />
    <link href="/style.css" rel="stylesheet" type="text/css" />
    <script src="/webfont.js" type="text/javascript"></script>
    <script type="text/javascript">
      WebFont.load({
        google: {
          families: ["Oswald:200,300,400,500,600,700"]
        }
      });
    </script>
    <!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js" type="text/javascript"></script><![endif]-->
    <script type="text/javascript">
      ! function(o, c) {
        var n = c.documentElement,
          t = " w-mod-";
        n.className += t + "js", ("ontouchstart" in o || o.DocumentTouch && c instanceof DocumentTouch) && (n.className += t + "touch")
      }(window, document);
    </script>
    <link href="https://uploads-ssl.webflow.com/6206a703bfc23d0004aa37f4/62080eebb3a3557acbcb8ef3_falconclean-logo-32.png" rel="shortcut icon" type="image/x-icon" />
    <link href="https://uploads-ssl.webflow.com/6206a703bfc23d0004aa37f4/62080eef3653fa29c1604605_falconclean-logo-256.png" rel="apple-touch-icon" />
  </head>
  <body class="dashboard">
    <div class="dashboard-section">
      <h1>Reports</h1>
      <div class="list">
        <?php foreach ($reportList as $report) { ?>
          <div class="list-item"><a href="#" class="icon-button w-inline-block"></a>
            <div><?php print($report["room"]["name"] . " - #" . $report["id"] . ": " . $report["description"] . "(Reported by " . $report["user"]["name"] . " on " . $report["created"] . ")"); ?> - #0201: Not drying clothes (Reported by Josiah Stearns on 03 Jan 2022)</div>
          </div>
        <?php } ?>
      </div>
      <div class="horizontal-line"></div>
    </div>
    <div class="dashboard-section">
      <h1>Usage</h1>
      <div class="list">
        <div class="list-item">
          <div><?php print(sizeof($users)); ?> total users</div>
        </div>
        <!--<div class="list-item">
          <div><span>56 users over the last week (up 23%)</span></div>
        </div>-->
        <div class="horizontal-line"></div>
      </div>
    </div>
    <div class="dashboard-section">
      <h1>Management</h1><a href="/admin/codes" target="_blank" class="submit-button w-button">Print QR Codes</a>
      <div class="list">
        <div class="horizontal-line"></div>
      </div>
    </div>
    <script src="/jquery.js" type="text/javascript"></script>
  </body>
</html>
