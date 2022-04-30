<?php

  include_once($_SERVER["DOCUMENT_ROOT"] . "/functs.php");

  $machineID = param("machineID", ["sticky" => true]);

  $load = readObject("loads", ["machineID" => $machineID], 1);

  if ($load != null) {
    $user = readObject("users", ["id" => $load["userID"]], 1);
  }

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
    <script src="/js/webfont.js" type="text/javascript"></script>
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
      <?php if($load == null) { ?>
        <h1>Nobody has used FalconClean on this machine yet</h1>
      <?php } else { ?>
        <h1>This laundry was loaded by <br /><?php print($user["name"] . "<br />" . time_elapsed_string($load["created"])); ?><br /></h1>
      <?php } ?>
      <a href="/load.php?machineID=<?php print($machineID); ?>" class="submit-button w-button">Back</a>
    </div>
    <script src="/js/jquery.js" type="text/javascript"></script>
  </body>
</html>
