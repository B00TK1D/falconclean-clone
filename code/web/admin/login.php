<?php
  include_once($_SERVER["DOCUMENT_ROOT"] . "/functs.php");

  //$error = param("error");
  $error = 0;

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Login</title>
    <meta content="Login" property="og:title" />
    <meta content="Login" property="twitter:title" />
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
    <link href="/img/falconclean-logo-32.png" rel="shortcut icon" type="image/x-icon" />
    <link href="/img/falconclean-logo-256.png" rel="apple-touch-icon" />
  </head>
  <body class="body">
    <div class="div-block">
      <div class="w-form">
        <form action="/api/admin/login.php" method="post">
            <label for="password">Code</label>
            <input type="password" class="w-input" maxlength="256" name="password" placeholder="" id="email" required="" />
            <?php if ($error) { ?><label>Invalid Password</label><?php } ?>
            <input type="submit" value="Login" class="submit-button w-button" />
        </form>
      </div>
    </div>
    <script src="/js/jquery.js" type="text/javascript"></script>
  </body>
</html>
