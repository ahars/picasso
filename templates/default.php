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

        <!-- ########### HEADER ########## -->
        <header class="fixed">
            <div class="container-header">
              <div id="main-logo">
                <a href="http://assos.utc.fr/picasso"><img src="res/img/logo_P14.png" alt="Picasso Logo"></a>
            </div>
              <ul class="menu-right">
                <!--li><a id="menu-info" class="visible-desktop" href="#info"><span id="icon-info"></span></a></li-->
                <li><a id="menu-payutc" href="https://assos.utc.fr/payutc"><span id="icon-payutc"></span></a></li>
                <li><a id="menu-facebook" class="visible-desktop" href="https://www.facebook.com/pic.asso.5"><span id="icon-facebook"></span></a></li>
              </ul>
              <ul class="menu-left visible-desktop">
                <li><a id="menu-news" href="#news"><span id="icon-news"></span></a></li>
                <li><a id="menu-calendrier" href="#calendrier"><span id="icon-calendrier"></span></a></li>
                <li><a id="menu-weekbieres" href="#weekbieres"><span id="icon-weekbieres"></span></a></li>
                <li><a id="menu-goodies" href="#goodies"><span id="icon-goodies"></span></a></li>
                <li><a id="menu-tarifs" href="#tarifs"><span id="icon-tarifs"></span></a></li>
              </ul>
            <div class="clear"></div>
          </div>
        </header>

        <!-- ########### CONTENT ########## -->
        <div id="main-container">
          <div class="container-content">
            <section class="slider">

              <!-- ########### NEWS ########## -->
              <section class="slides" id="news">
                <?php if ($now >= $date_ouverture_matin) { ?>
                  <h1>Dernière News</h1>
                  <h3><?php echo $article_titre . ' - ' . $article_date; ?></h3>
                  <section class="box">
                    <?php 
                      if (!empty($article_img)) {
                        echo '<img src="' . $article_img . '" width="' . $article_width . '" height="' . $article_height . '" class="picture">';
                      }
                    ?>
                    <div class="article">
                      <?php echo $article_corps; ?>
                    </div>
                    <div id="compteur" title=<?php echo $ouverture_matin . '/' . $ouverture_soir; ?>><div id="countdown2"></div></div>
                    <div class="clear"></div>
                  </section>
                <?php } else { ?>
                  <h1>Ouverture</h1>
                  <h3>Semestre <?php echo $semestre; ?></h3>
                  <section class="box" id="compteur" title=<?php echo $ouverture_matin . '/' . $ouverture_soir; ?>>
                    <div id="countdown"></div>
                    <div class="clear"></div>
                  </section>
                <?php } ?>
              </section>

              <!-- ########### CALENDRIER ########## -->
              <section class="slides" id="calendrier">
                <h1>Calendrier</h1>
                <h3>Semestre <?php echo $semestre; ?> - Semaine du <?php echo preg_replace('#(.*)/(.*)/(.*)$#', '$1/$2', $semaine_start); ?> au <?php echo preg_replace('#(.*)/(.*)/(.*)$#', '$1/$2', $semaine_end); ?></h3>
                <section class="box visible-desktop">
                  <div class="grid6">
                    <?php
                      // Parcours des jours.
                      for ($i = 0; $i < 6; $i++) { 
                        
                        $journee = false;
                        echo '<div class="columns">';

                        // Perm allDay.
                        for ($k = 0; $k < count($cal_titre); $k++) {
                          list($cal_date_s, $cal_date_e) = explode(';', $cal_date[$k]);
                          list($perm_start, $p) = explode(';', $perms[0]);
                          list($p, $perm_end) = explode(';', $perms[3]);
                          list($cal_horaire_s, $cal_horaire_e) = explode(';', $cal_horaire[$k]);

                          if (($cal_horaire_s == $perm_start AND $cal_horaire_e == $perm_end) AND $cal_date_s == ($semaine_start + $i) AND $cal_date_e == ($semaine_start + $i)) {
                            
                            for ($j = 0; $j < 4; $j++) {
                              echo '<div class="block">';
                              echo '<a href="' . $cal_url[$k] . '">' . $cal_asso[$k] . '</a>';
                              if ($i < 3) {
                                echo '<div class="detail d-left d-' . ($j + 1) . '">';
                              } else {
                                echo '<div class="detail d-right d-' . ($j + 1) . '">';
                              }
                              echo '<div class="asso">' . $cal_asso[$k] . '</div>';
                              echo '<div class="titre">' . $cal_titre[$k] . ' (' . preg_replace('#(.*)\:(.*)\:00$#', '$1h$2', $cal_horaire_s) . ' - ' . preg_replace('#(.*)\:(.*)\:00$#', '$1h$2', $cal_horaire_e) . ')</div>';
                              echo $cal_corps[$k] . '</div></div>';
                            }
                            $journee = true;
                          }
                        }

                        // Perm normale.
                        for ($j = 0; $j < 4; $j++) {

                          list($perm_start, $perm_end) = explode(';', $perms[$j]);

                          $found = false;
                          for ($k = 0; $k < count($cal_titre); $k++) {

                            list($cal_date_s, $cal_date_e) = explode(';', $cal_date[$k]);
                            list($cal_horaire_s, $cal_horaire_e) = explode(';', $cal_horaire[$k]);

                            if ($cal_tag[$k] == $perm AND $cal_date_s == ($semaine_start + $i) AND $cal_date_e == ($semaine_start + $i) AND $cal_horaire_s == $perm_start AND $cal_horaire_e == $perm_end AND !$found) {
                              echo '<div class="block">';
                              echo '<a href="' . $cal_url[$k] . '">' . $cal_asso[$k] . '</a>';
                              if ($i < 3) {
                                echo '<div class="detail d-left d-' . ($j + 1) . '">';
                              } else {
                                echo '<div class="detail d-right d-' . ($j + 1) . '">';
                              }
                              echo '<div class="asso">' . $cal_asso[$k] . '</div>';
                              echo '<div class="titre">' . $cal_titre[$k] . ' (' . preg_replace('#(.*)\:(.*)\:00$#', '$1h$2', $cal_horaire_s) . ' - ' . preg_replace('#(.*)\:(.*)\:00$#', '$1h$2', $cal_horaire_e) . ')</div>';
                              echo $cal_corps[$k] . '</div></div>';
                              $found = true;
                            }
                          }

                          if (!$found AND !$journee) {
                            echo '<div class="block"></div>';
                         }
                        }
                        echo '</div>';
                      }
                    ?>
                  </div>
                  <div class="clear"></div>
                </section>
                <section class="box visible-phone">
                  <div class="coming_soon">Coming Soon !</div>
                </section>
              </section>

              <!-- ########### WEEKBIERE ########## -->
              <section class="slides" id="weekbieres">
                <h1>Bières de la semaine</h1>
                <h3>Semestre <?php echo $semestre; ?> - Semaine du <?php echo preg_replace('#(.*)/(.*)/(.*)$#', '$1/$2', $semaine_start); ?> au <?php echo preg_replace('#(.*)/(.*)/(.*)$#', '$1/$2', $semaine_end); ?></h3>
                <section class="box">
                  <!-- TODO -->
                  <div class="coming_soon">Coming Soon !</div>
                  <div class="clear"></div>
                </section>
              </section>

              <!-- ########### GOODIES ########## -->
              <section class="slides" id="goodies">
                <h1>Goodies</h1>
                <h3>Les gagnants - Semaine du <?php echo preg_replace('#(.*)/(.*)/(.*)$#', '$1/$2', $semaine_start); ?> au <?php echo preg_replace('#(.*)/(.*)/(.*)$#', '$1/$2', $semaine_end); ?></h3>
                <section class="box"> 
                  <div class="grid4">              
                  <!-- TODO -->
                  <div class="coming_soon">Coming Soon !</div>
                    <?php /*foreach ($datas['goodies'] as $k => $v): ?>
                      <tr class="col-sm-4">
                        <td><?php echo $v['numero'] ?></td>
                        <td><?php echo $v['nom'] ?></td>
                        <td><?php echo $v['prenom'] ?></td>
                      </tr>
                    <?php endforeach */?>
                   </div>
                  <div class="clear"></div>
                </section>
              </section>

              <!-- ########### TARIFS ########## -->
              <section class="slides" id="tarifs">
                <h1>Tarifs</h1>
                <h3>Semestre <?php echo $semestre; ?></h3>
                <section class="box">
                  <div class="grid4">
                    <!-- TODO -->
                    <div class="coming_soon">Coming Soon !</div>
                  </div>
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
        <script src="res/js/main.js"></script>
        <script src="res/js/countdown.js"></script>
    </body>
</html>