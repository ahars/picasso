<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="Site web du Pic'Asso UTC">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Pic'Asso UTC</title>
        <link rel="shortcut icon" href="res/img/favicon.png" />
        <link rel="stylesheet" href="res/css/main.css">

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
            <ul class="menu-left">
              <li><a id="menu-news" href="#news"></a></li>
              <li><a id="menu-calendrier" href="#calendrier"></a></li>
              <li><a id="menu-weekbieres" href="#weekbieres"></a></li>
              <li><a id="menu-goodies" href="#goodies"></a></li>
              <li><a id="menu-tarifs" href="#tarifs"></a></li>
            </ul>
            <ul class="menu-right">
              <li><a id="menu-payutc" href="https://assos.utc.fr/payutc"></a></li>
              <li><a id="menu-facebook" href="https://www.facebook.com/pic.asso.5"></a></li>
            </ul>
            <div class="clear"></div>
          </div>
        </header>
        <div id="main-container">
          <div class="container">
            <section class="slider">
              <section class="slides" id="news">
                <h1>Dernière News</h1>
                <h3><?php echo $article_titre . ' - ' . $article_date; ?></h3>
                <section class="box">
                  <img src="<?php echo $article_img; ?>" width="<?php echo $article_width; ?>" height="<?php echo $article_height; ?>" class="picture">
                  <div class="article">
                    <?php echo $article_corps; ?>
                  </div>
                </section>
                <section class="selectors">
                  <ul>
                    <li><a class="selector-news active" href="#news"></a></li>
                    <li><a class="selector-calendrier" href="#calendrier"></a></li>
                    <li><a class="selector-weekbieres" href="#weekbieres"></a></li>
                    <li><a class="selector-goodies" href="#goodies"></a></li>
                    <li><a class="selector-tarifs" href="#tarifs"></a></li>
                  </ul>
                </section>
              </section>
              <section class="slides" id="calendrier">
                <h1>Calendrier</h1>
                <h3></h3>
                <section class="box">
                  <!-- TODO -->
                  <h3 id="comming_soon">Coming Soon !</h3>
                </section>
                <section class="selectors">
                  <ul>
                    <li><a class="selector-news" href="#news"></a></li>
                    <li><a class="selector-calendrier active" href="#calendrier"></a></li>
                    <li><a class="selector-weekbieres" href="#weekbieres"></a></li>
                    <li><a class="selector-goodies" href="#goodies"></a></li>
                    <li><a class="selector-tarifs" href="#tarifs"></a></li>
                  </ul>
                </section>
              </section>
              <section class="slides" id="weekbieres">
                <h1>Bières de la semaine</h1>
                <h3></h3>
                <section class="box">
                  <!-- TODO -->
                  <h3 id="comming_soon">Coming Soon !</h3>
                </section>
                <section class="selectors">
                  <ul>
                    <li><a class="selector-news" href="#news"></a></li>
                    <li><a class="selector-calendrier" href="#calendrier"></a></li>
                    <li><a class="selector-weekbieres active" href="#weekbieres"></a></li>
                    <li><a class="selector-goodies" href="#goodies"></a></li>
                    <li><a class="selector-tarifs" href="#tarifs"></a></li>
                  </ul>
                </section>
              </section>
              <section class="slides" id="goodies">
                <h1>Goodies</h1>
                <h3></h3>
                <section class="box">
                  <!-- TODO -->
                  <h3 id="comming_soon">Coming Soon !</h3>
                  <?php /*foreach ($datas['goodies'] as $k => $v): ?>
                    <tr class="col-sm-4">
                      <td><?php echo $v['numero'] ?></td>
                      <td><?php echo $v['nom'] ?></td>
                      <td><?php echo $v['prenom'] ?></td>
                    </tr>
                  <?php endforeach */?>
                </section>
                <section class="selectors">
                  <ul>
                    <li><a class="selector-news" href="#news"></a></li>
                    <li><a class="selector-calendrier" href="#calendrier"></a></li>
                    <li><a class="selector-weekbieres" href="#weekbieres"></a></li>
                    <li><a class="selector-goodies active" href="#goodies"></a></li>
                    <li><a class="selector-tarifs" href="#tarifs"></a></li>
                  </ul>
                </section>
              </section>
              <section class="slides" id="tarifs">
                <h1>Tarifs</h1>
                <h3></h3>
                <section class="box">
                  <!-- TODO -->
                  <h3 id="comming_soon">Coming Soon !</h3>
                </section>
                <section class="selectors">
                  <ul>
                    <li><a class="selector-news" href="#news"></a></li>
                    <li><a class="selector-calendrier" href="#calendrier"></a></li>
                    <li><a class="selector-weekbieres" href="#weekbieres"></a></li>
                    <li><a class="selector-goodies" href="#goodies"></a></li>
                    <li><a class="selector-tarifs active" href="#tarifs"></a></li>
                  </ul>
                </section>
              </section>
            </section>
            <div class="clear"></div>
          </div>
        </div>
        <script src="res/js/jquery-1.9.1.min.js"></script>
        <script src="res/js/jquery.easing.js"></script>
        <!--script src="res/js/jquery.scrollspy.js"></script-->
        <script src="res/js/main.js"></script>
    </body>
</html>
