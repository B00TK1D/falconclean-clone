<?php

  include_once($_SERVER["DOCUMENT_ROOT"] . "/functs.php");

  $machineID = param("machineID", ["sticky" => true]);

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Load</title>
    <meta content="Load" property="og:title" />
    <meta content="Load" property="twitter:title" />
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
        <a href="/api/load/create.php?machineID=<?php print($machineID); ?>" class="submit-button w-button">I&#x27;m loading laundry</a>
        <a href="/success/notify.php" class="submit-button w-button">Somebody left their laundry</a>
        <a href="/report.php" class="submit-button w-button">This machine is broken</a>
    </div>
    <script src="/jquery.js" type="text/javascript"></script>
  </body>
</html>