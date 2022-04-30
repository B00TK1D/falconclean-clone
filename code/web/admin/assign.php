<?php
  include_once($_SERVER["DOCUMENT_ROOT"] . "/functs.php");

  $qr = param("qr");
  $typeList = readObject("types");
  $roomList = readObject("rooms");

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Assign</title>
    <meta content="Assign" property="og:title" />
    <meta content="Assign" property="twitter:title" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="Webflow" name="generator" />
    <link href="/style.css" rel="stylesheet" type="text/css" />
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
    <link href="https://uploads-ssl.webflow.com/6206a703bfc23d0004aa37f4/62080eebb3a3557acbcb8ef3_falconclean-logo-32.png" rel="shortcut icon" type="image/x-icon" />
    <link href="https://uploads-ssl.webflow.com/6206a703bfc23d0004aa37f4/62080eef3653fa29c1604605_falconclean-logo-256.png" rel="apple-touch-icon" />
  </head>
  <body class="body">
    <div class="div-block">
      <h1>Register QR Code</h1>
      <div class="w-form">
        <form action="/api/machine/create.php" method="get" class="form">
          <select name="typeID"required="" class="select-field w-select">
            <option value="">Type</option>
            <?php foreach ($typeList as $type) { ?>
              <option value="<?php print($type["id"]); ?>"><?php print($type["name"]); ?></option>
            <?php } ?>
          </select>
          <select name="roomID" required="" class="select-field w-select">
            <option value="">Location</option>
            <?php foreach ($roomList as $room) { ?>
              <option value="<?php print($room["id"]); ?>"><?php print($room["name"]); ?></option>
            <?php } ?>
          </select>
          <input type="number" hidden="" name="qr" value="<?php print($qr); ?>" />
          <input type="submit" value="Save" class="submit-button w-button" />
        </form>
      </div>
    </div>
    <script src="/js/jquery.js" type="text/javascript"></script>
  </body>
</html>