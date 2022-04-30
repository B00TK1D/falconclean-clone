<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Join</title>
    <meta content="Join" property="og:title" />
    <meta content="Join" property="twitter:title" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
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
        <form action="/api/user/join.php" method="post" class="form">
            <input type="text" class="w-input" maxlength="256" name="name" placeholder="Name"/>
            <label class="field-label-2"> (This is just so other people can contact you about your laundry)</label>
            <a class="submit-button w-button" id="push-subscription-button">Allow Notifications</a>
            <input type="submit" value="Join" class="submit-button w-button" id="after-push-approval" disabled=""/>
        </form>
      </div>
    </div>
    <script src="/js/jquery.js" type="text/javascript"></script>
    <script src="/js/notification.js" type="text/javascript"></script>
  </body>
</html>
