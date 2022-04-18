<?php

  include_once($_SERVER["DOCUMENT_ROOT"] . "/functs.php");

  $machineID = param("machineID", ["sticky" => true]);

  $load = readObject("loads", ["machineID" => $machineID], 1);

  $user = readObject("users", ["id" => $load["userID"]], 1);

?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Notify</title>
    <meta content="Notify" property="og:title" />
    <meta content="Notify" property="twitter:title" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <link href="https://uploads-ssl.webflow.com/6206a703bfc23d0004aa37f4/css/falconclean.webflow.00b3c006b.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
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
      <h1>This laundry was loaded by <br /><?php print($user["name"] . "<br />" . time_elapsed_string($load["created"])); ?><br /></h1>
      <a href="/load.php?machineID=<?php print($machineID); ?>" class="submit-button w-button">Back</a>
    </div>
    <script src="/jquery.js" type="text/javascript"></script>
  </body>
</html>
