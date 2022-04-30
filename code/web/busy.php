<?php

  include_once($_SERVER["DOCUMENT_ROOT"] . "/functs.php");

  $machineID = param("machineID", ["sticky" => true]);

  $machine = readObject("machines", ["id" => $machineID], 1);
  
  $currentLoad = readObject("loads", ["machineID" => $machineID], 1);
  $machineType = readObject("types", ["id" => $machine["typeID"]], 1);

  $timeLeft = time_elapsed_minutes($currentLoad["load"]) - $machineType["cycleTime"];

  $alternatives = readObject("machines", ["typeID" => $machine["typeID"]]);
  $recommendedAlternative = null;
  $bestTime = 0;

  foreach ($alternatives as $alternative) {
    $load = readObject("loads", ["machineID" => $alternative["id"]], 1);
    if ($load != null) {
      $time = time_elapsed_minutes($load["load"]);
      if ($time > $bestTime) {
        $recommendedAlternative = $alternative;
        $bestTime = $time;
        break;
      }
    } else {
      $recommendedAlternative = $alternative;
      break;
    }
  }

  $bestTime = $machineType["cycleTime"] - $bestTime;

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Alert</title>
    <meta content="Busy" property="og:title" />
    <meta content="Busy" property="twitter:title" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
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
    <link href="/img/falconclean-logo-32.png" rel="shortcut icon" type="image/x-icon" />
    <link href="/img/falconclean-logo-256.png" rel="apple-touch-icon" />
  </head>
  <body class="body">
    <div class="div-block">
      <h1>Busy</h1>
      <div>This machine is currently busy.</div>
      <?php if ($recommendedAlternative) { ?>
        <?php if ($timeLeft > 0) { ?>
            <div>However, machine #<?php print($recommendedAlternative["qr"]) ?> will be open in <?php print($timeLeft) ?> minutes.</div>
        <?php } else { ?>
            <div>However, machine #<?php print($recommendedAlternative["qr"]) ?> is open now.</div>
        <?php } ?>
      <?php } ?>
      <a href="/load.php" class="submit-button w-button">Okay</a>
    </div>
    <script src="/jquery.js" type="text/javascript"></script>
  </body>
</html>