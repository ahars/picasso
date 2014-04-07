<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="Site web du Pic'Asso UTC">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Pic'Asso UTC</title>
        <link rel="shortcut icon" href="res/img/favicon.png" />
        <link rel="stylesheet" href="res/css/main.css">
        <link rel="stylesheet" href="res/css/countdown.css">

        <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
          
    </head>
    <body>
        <header class="fixed">
          <div class="container">
            <div id="main-logo">
              <a href="http://assos.utc.fr/picasso"><img src="res/img/logo_P14.png" alt="Picasso Logo"></a>
            </div>
            <ul class="menu-right">
              <li><a id="menu-payutc" href="https://assos.utc.fr/payutc"></a></li>
              <li><a id="menu-facebook" href="https://www.facebook.com/pic.asso.5"></a></li>
            </ul>
            <div class="clear"></div>
          </div>
        </header>
        <section id="compteur" title=<?php echo $ouverture; ?>>
            <div id="countdown"></div>
        </section>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="res/js/jquery-1.9.1.min.js"></script>
        <script src="res/js/jquery.easing.js"></script>
        <script src="res/js/jquery.plugin.js"></script>
        <script src="res/js/jquery.countdown.js"></script>
        <script src="res/js/main.js"></script>
        <script src="res/js/countdown.js"></script>
    </body>
</html>
