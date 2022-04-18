<?php

  include_once($_SERVER["DOCUMENT_ROOT"] . "/functs.php");

  $machineID = param("machineID", ["sticky" => true]);

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Report</title>
    <meta content="Report" property="og:title" />
    <meta content="Report" property="twitter:title" />
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
      <div class="w-form">
        <form method="post" action="/api/issue/create.php" class="form">
          <h1>Report</h1>
          <textarea placeholder="What&#x27;s broken?" maxlength="5000" name="description" class="textarea w-input"></textarea>
          <input type="number" hidden="" name="machineID" value="<?php print($machineID); ?>" />
          <input type="submit" value="Submit" class="submit-button w-button" />
        </form>
      </div>
    </div>
    <script src="/jquery.js" type="text/javascript"></script>
  </body>
</html>