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
            <div id="menu-right">
              <ul class="menu-right">
                <li><a id="menu-info" href="#info"><span id="icon-info"></span></a></li>
                <li><a id="menu-payutc" href="https://assos.utc.fr/payutc"><span id="icon-payutc"></span></a></li>
                <li><a id="menu-facebook" href="https://www.facebook.com/pic.asso.5"><span id="icon-facebook"></span></a></li>
              </ul>
            </div>
            <div class="clear"></div>
          </div>
        </header>
        <div id="main-container">
          <div class="container">
            <section class="slider">
              <section class="slides" id="main_countdown">
                <h1>Début de la perm</h1>
                <h3></h3>
                <section class="box" id="compteur" title=<?php echo $ouverture_matin . '/' . $ouverture_soir; ?>>
                  <div id="countdown3"></div>
                  <div class="clear"></div>
                </section>
              </section>
            </section>
            <div class="clear"></div>
          </div>
        </div>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="res/js/jquery-1.9.1.min.js"></script>
        <script src="res/js/jquery.plugin.js"></script>
        <script src="res/js/jquery.easing.js"></script>
        <script src="res/js/jquery.scrollspy.js"></script>
        <script src="res/js/jquery.countdown.js"></script>
        <!--script src="res/js/main.js"></script-->
        <script src="res/js/countdown.js"></script>
    </body>
</html>