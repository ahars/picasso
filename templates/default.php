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
                <li><a id="menu-info" href="info"><span id="icon-info"></span></a></li>
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
<?php /*
              <!-- ########### CALENDRIER ########## -->
              <section class="slides" id="calendrier">
                <h1>Calendrier</h1>
                <h3>Semestre <?php echo $semestre; ?> - Semaine du <?php echo preg_replace('#(.*)/(.*)/(.*)$#', '$1/$2', $semaine_start); ?> au <?php echo preg_replace('#(.*)/(.*)/(.*)$#', '$1/$2', $semaine_end); ?></h3>
                <section class="box visible-desktop">
                  <div class="grid5">
                    <?php
                      // Parcours des jours.
                      for ($i = 0; $i < 5; $i++) { 
                        
                        $journee = false;
                        echo '<div class="columns">';

                        // Perm allDay.
                        for ($k = 0; $k < count($cal_titre); $k++) {
                          list($cal_date_s, $cal_date_e) = explode(';', $cal_date[$k]);
                          list($perm_start, $p) = explode(';', $perms[0]);
                          list($p, $perm_end) = explode(';', $perms[3]);
                          list($cal_horaire_s, $cal_horaire_e) = explode(';', $cal_horaire[$k]);

                          if (($cal_horaire_s >= $perm_start AND $cal_horaire_e <= $perm_end) AND $cal_date_s == ($semaine_start + $i) AND $cal_date_e == ($semaine_start + $i)) {
                            
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
*/ ?>
              <section class="slides" id="calendrier">
                <h1>Calendrier</h1>
                <h3>Semestre <?php echo $semestre; ?> - Semaine du 05/05 au 10/05</h3>
                <section class="box visible-desktop">
                  <div class="grid5">
                    <!-- LUNDI -->
                    <div class="columns">
                      <a href="http://assos.utc.fr/event/show/425">
                        <div class="block">
                          <span clas="perm_asso">Picasso</span>
                          <div class="detail d-left d-1">
                            <div class="date">Lundi 05 Mai</div>
                            <div class="perm">10h15 - 12h15</div>
                            <div class="asso">Picasso</div>
                            <div class="titre">Ouverture du Pic !</div>
                            <div class="corps">OPEN THE PIC</div>
                            <div class="lien">[Clique pour plus d'infos]</div>
                          </div>
                        </div>
                      </a>
                      <a href="http://assos.utc.fr/event/show/425">
                        <div class="block">
                          <span clas="perm_asso">Picasso</span>
                          <div class="detail d-left d-2">
                            <div class="date">Lundi 05 Mai</div>
                            <div class="perm">12h15 - 14h15</div>
                            <div class="asso">Picasso</div>
                            <div class="titre">Ouverture du Pic !</div>
                            <div class="corps">OPEN THE PIC</div>
                            <div class="lien">[Clique pour plus d'infos]</div>
                          </div>
                        </div>
                      </a>
                      <a href="http://assos.utc.fr/event/show/425">
                        <div class="block">
                          <span clas="perm_asso">Picasso</span>
                          <div class="detail d-left d-3">
                            <div class="date">Lundi 05 Mai</div>
                            <div class="perm">14h15 - 18h15</div>
                            <div class="asso">Picasso</div>
                            <div class="titre">Ouverture du Pic !</div>
                            <div class="corps">OPEN THE PIC</div>
                            <div class="lien">[Clique pour plus d'infos]</div>
                          </div>
                        </div>
                      </a>
                      <a href="http://assos.utc.fr/event/show/425">
                        <div class="block">
                          <span clas="perm_asso">Picasso</span>
                          <div class="detail d-left d-4">
                            <div class="date">Lundi 05 Mai</div>
                            <div class="perm">18h30 - 22h00</div>
                            <div class="asso">Picasso</div>
                            <div class="titre">Ouverture du Pic !</div>
                            <div class="corps">OPEN THE PIC</div>
                            <div class="lien">[Clique pour plus d'infos]</div>
                          </div>
                        </div>
                      </a>
                    </div>
                    <!-- MARDI -->
                    <div class="columns">
                      <a href="http://assos.utc.fr/event/show/429">
                        <div class="block">
                          <span clas="perm_asso">Etuville</span>
                          <div class="detail d-left d-1">
                            <div class="date">Mardi 06 Mai</div>
                            <div class="perm">10h15 - 12h15</div>
                            <div class="asso">Etuville</div>
                            <div class="titre">Matinée douceur avec etuville</div>
                            <div class="corps">Réveil en douceur avec la team d'Etuville</div>
                            <div class="lien">[Clique pour plus d'infos]</div>
                          </div>
                        </div>
                      </a>
                      <a href="http://assos.utc.fr/event/show/422">
                        <div class="block">
                          <span clas="perm_asso">Supporter'UTC</span>
                          <div class="detail d-left d-2">
                            <div class="date">Mardi 06 Mai</div>
                            <div class="perm">12h15 - 14h15</div>
                            <div class="asso">Supporter'UTC</div>
                            <div class="titre">American lunch par les pom-poms girls de l'utc</div>
                            <div class="corps">Les Pom-poms Girls de l'UTC t'invitent à leur American Lunch mardi 6 mai !</div>
                            <div class="lien">[Clique pour plus d'infos]</div>
                          </div>
                        </div>
                      </a>
                      <a href="http://assos.utc.fr/event/show/422">
                        <div class="block">
                          <span clas="perm_asso">Supporter'UTC</span>
                          <div class="detail d-left d-3">
                            <div class="date">Mardi 06 Mai</div>
                            <div class="perm">14h15 - 18h15</div>
                            <div class="asso">Supporter'UTC</div>
                            <div class="titre">American lunch par les pom-poms girls de l'utc</div>
                            <div class="corps">Les Pom-poms Girls de l'UTC t'invitent à leur American Lunch mardi 6 mai !</div>
                            <div class="lien">[Clique pour plus d'infos]</div>
                          </div>
                        </div>
                      </a>
                      <a href="http://assos.utc.fr/event/show/421">
                        <div class="block">
                          <span clas="perm_asso">PMDE</span>
                          <div class="detail d-left d-4">
                            <div class="date">Mardi 06 Mai</div>
                            <div class="perm">18h30 - 22h00</div>
                            <div class="asso">PMDE</div>
                            <div class="titre">Perm HAWAII par le PMDE</div>
                            <div class="corps">Du soleil, des fleurs, des palmiers et de la bière !</div>
                            <div class="lien">[Clique pour plus d'infos]</div>
                          </div>
                        </div>
                      </a>
                    </div>
                    <!-- MERCREDI -->
                    <div class="columns">
                      <a href="#">
                        <div class="block"></div>
                      </a>
                      <a href="http://assos.utc.fr/event/show/424">
                        <div class="block">
                          <span clas="perm_asso">Cac'Carotte</span>
                          <div class="detail d-right d-2">
                            <div class="date">Mercredi 07 Mai</div>
                            <div class="perm">12h15 - 14h15</div>
                            <div class="asso">Cac'Carotte</div>
                            <div class="titre">PERM CAC'CAROTTE</div>
                            <div class="corps">Des légumes dans votre assiette au Pic mercredi midi!</div>
                            <div class="lien">[Clique pour plus d'infos]</div>
                          </div>
                        </div>
                      </a>
                      <a href="#">
                        <div class="block"></div>
                      </a>
                      <a href="http://assos.utc.fr/event/show/426">
                        <div class="block">
                          <span clas="perm_asso">La Jolie Douche</span>
                          <div class="detail d-right d-4">
                            <div class="date">Mercredi 07 Mai</div>
                            <div class="perm">18h30 - 22h00</div>
                            <div class="asso">Jolie Douche</div>
                            <div class="titre">Pic'Asso - Jolie Douche</div>
                            <div class="corps">La Jolie Douche au Pic 1800</div>
                            <div class="lien">[Clique pour plus d'infos]</div>
                          </div>
                        </div>
                      </a>
                    </div>
                    <!-- JEUDI -->
                    <div class="columns">
                      <a href="#">
                        <div class="block"></div>
                      </a>
                      <a href="#">
                        <div class="block"></div>
                      </a>
                      <a href="#">
                        <div class="block"></div>
                      </a>
                      <a href="#">
                        <div class="block"></div>
                      </a>
                    </div>
                    <!-- VENDREDI -->
                    <div class="columns">
                      <a href="#">
                        <div class="block"></div>
                      </a>
                      <a href="http://assos.utc.fr/event/show/431">
                        <div class="block">
                          <span clas="perm_asso">BDE-UTC</span>
                          <div class="detail d-right d-2">
                            <div class="date">Vendredi 09 Mai</div>
                            <div class="perm">12h15 - 14h15</div>
                            <div class="asso">BDE-UTC</div>
                            <div class="titre">Quand le BDE se met aux fourneaux</div>
                            <div class="corps">Envie d'une ambiance sympas en mangeant un bout? Passe à la perm du BDE ;)</div>
                            <div class="lien">[Clique pour plus d'infos]</div>
                          </div>
                        </div>
                      </a>
                      <a href="#">
                        <div class="block"></div>
                      </a>
                      <a href="http://assos.utc.fr/event/show/427">
                        <div class="block">
                          <span clas="perm_asso">XK&QB</span>
                          <div class="detail d-right d-4">
                            <div class="date">Vendredi 09 Mai</div>
                            <div class="perm">18h30 - 22h00</div>
                            <div class="asso">xK&QB</div>
                            <div class="titre">Pic'Asso - xK&QB</div>
                            <div class="corps">XK&QB</div>
                            <div class="lien">[Clique pour plus d'infos]</div>
                          </div>
                        </div>
                      </a>
                    </div>
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
                <!--h3>Semestre <?php echo $semestre; ?> - Semaine du <?php echo preg_replace('#(.*)/(.*)/(.*)$#', '$1/$2', $semaine_start); ?> au <?php echo preg_replace('#(.*)/(.*)/(.*)$#', '$1/$2', $semaine_end); ?></h3-->
                <h3>Semestre <?php echo $semestre; ?> - Semaine du 05/05 au 10/05</h3>
                <section class="box">
                  <div class="grid2">
                    <div class="columns" id="pression">
                      <h2>Pression</h2>
                      <table class="liste">
                        <tr>
                          <td class="image"><img src="res/img/biere/deliria.jpg" width="100px" length="100px"></td>
                          <td class="titre">Deliria</td>
                          <td class="prix">1.80€</td>
                          <td class="degre">8.5°</td>
                        </tr>
                        <tr>
                          <td class="image"><img src="res/img/biere/nice_chouffe.jpg" width="100px" length="100px"></td>
                          <td class="titre">N'ice Chouffe</td>
                          <td class="prix">2.00€</td>
                          <td class="degre">10°</td>
                        </tr>
                        <tr>
                          <td class="image"><img src="res/img/biere/hopus.png" width="100px" length="100px"><br/></td>
                          <td class="titre">Hopus</td>
                          <td class="prix">1.85€</td>
                          <td class="degre">8.3°</td>
                        </tr>
                        <tr>
                          <td class="image"><img src="res/img/biere/maredsous.jpg" width="100px" length="100px"></td>
                          <td class="titre">Maredsous 6</td>
                          <td class="prix">1.70€</td>
                          <td class="degre">6°</td>
                        </tr>
                        <tr>
                          <td class="image"><img src="res/img/biere/carolus_classic.jpg" width="100px" length="100px"></td>
                          <td class="titre">Carolus Classic</td>
                          <td class="prix">1.60€</td>
                          <td class="degre">8.5°</td>
                        </tr>
                      </table>
                      <br/>
                    </div>
                    <div class="columns" id="bouteille">
                      <h2>Bouteilles</h2>
                      <table class="liste">
                        <tr>
                          <td class="image"><img src="res/img/biere/scotch_silly_barrel_aged.jpg" width="100px" length="100px"></td>
                          <td class="titre">Scotch Silly Barrel Aged 75cl</td>
                          <td class="prix">4.50€</td>
                          <td class="degre">8°</td>
                        </tr>
                        <tr>
                          <td class="image"><img src="res/img/biere/gulden_draak.jpg" width="100px" length="100px"></td>
                          <td class="titre">Gulden Draak</td>
                          <td class="prix">1.60€</td>
                          <td class="degre">10.7°</td>
                        </tr>
                        <tr>
                          <td class="image"><img src="res/img/biere/namur.jpg" width="100px" length="100px"></td>
                          <td class="titre">Blanche de Namur</td>
                          <td class="prix">1.20€</td>
                          <td class="degre">4.5°</td>
                        </tr>
                        <tr>
                          <td class="image"><img src="res/img/biere/loic_raison.jpg" width="100px" length="100px"></td>
                          <td class="titre">Cidre Loic Raison</td>
                          <td class="prix">1.10€</td>
                          <td class="degre">5.5°</td>
                        </tr>
                      </table>
                    </div>
                  <div class="clear"></div>
                </section>
              </section>

              <!-- ########### GOODIES ########## -->
              <section class="slides" id="goodies">
                <h1>Goodies</h1>
                <!--h3>Les gagnants - Semaine du <?php echo preg_replace('#(.*)/(.*)/(.*)$#', '$1/$2', $semaine_start); ?> au <?php echo preg_replace('#(.*)/(.*)/(.*)$#', '$1/$2', $semaine_end); ?></h3-->
                <h3>Les gagnants de la tombola du <?php echo preg_replace('#(.*)/(.*)/(.*)$#', '$1/$2', $semaine_start); ?></h3>
                <section class="box"> 
                  <div class="grid4">
                  <!--div class="coming_soon">Soon !</div-->
                    <?php /*foreach ($datas['goodies'] as $k => $v): ?>
                      <tr class="col-sm-4">
                        <td><?php echo $v['numero'] ?></td>
                        <td><?php echo $v['nom'] ?></td>
                        <td><?php echo $v['prenom'] ?></td>
                      </tr>
                    <?php endforeach */?>
                    <div class="columns">
                      <table class="liste">
                        <tr>
                          <td class="degre">1</td>
                          <td class="titre">Léo Thielin</td>
                        </tr>
                        <tr>
                          <td class="degre">2</td>
                          <td class="titre">Stephane Karagulmez</td>
                        </tr>
                        <tr>
                          <td class="degre">3</td>
                          <td class="titre">Quentin Ducluzaux</td>
                        </tr>
                        <tr>
                          <td class="degre">4</td>
                          <td class="titre">Florian Trois</td>
                        </tr>
                        <tr>
                          <td class="degre">5</td>
                          <td class="titre">Valentine Le Tournoulx</td>
                        </tr>
                        <tr>
                          <td class="degre">6</td>
                          <td class="titre">Quentin Ducluzaux</td>
                        </tr>
                        <tr>
                          <td class="degre">7</td>
                          <td class="titre">Fanny Saffroy</td>
                        </tr>
                        <tr>
                          <td class="degre">8</td>
                          <td class="titre">Alexandre Coden</td>
                        </tr>
                      </table>
                    </div>
                    <div class="columns">
                      <table class="liste">
                        <tr>
                          <td class="degre">9</td>
                          <td class="titre">Sarah Ouro-Yondou</td>
                        </tr>
                        <tr>
                          <td class="degre">10</td>
                          <td class="titre">Anthony Palaprat</td>
                        </tr>
                        <tr>
                          <td class="degre">11</td>
                          <td class="titre">Florian Conejos</td>
                        </tr>
                        <tr>
                          <td class="degre">12</td>
                          <td class="titre">Maxime Basset</td>
                        </tr>
                        <tr>
                          <td class="degre">13</td>
                          <td class="titre">Anthony Palaprat</td>
                        </tr>
                        <tr>
                          <td class="degre">14</td>
                          <td class="titre">Quentin Dermersedian</td>
                        </tr>
                        <tr>
                          <td class="degre">15</td>
                          <td class="titre">Romain Fayolle</td>
                        </tr>
                        <tr>
                          <td class="degre">16</td>
                          <td class="titre">Romain Fayolle</td>
                        </tr>
                      </table>
                    </div>
                    <div class="columns">
                      <table class="liste">
                        <tr>
                          <td class="degre">17</td>
                          <td class="titre">Julia Halioua</td>
                        </tr>
                        <tr>
                          <td class="degre">18</td>
                          <td class="titre">Nathalie Simon</td>
                        </tr>
                        <tr>
                          <td class="degre">19</td>
                          <td class="titre">Flore Cailloux</td>
                        </tr>
                        <tr>
                          <td class="degre">20</td>
                          <td class="titre">Grégoire Michenaud-Rague</td>
                        </tr>
                        <tr>
                          <td class="degre">21</td>
                          <td class="titre">Clément Vasseur</td>
                        </tr>
                        <tr>
                          <td class="degre">22</td>
                          <td class="titre">Léo Lemeray</td>
                        </tr>
                        <tr>
                          <td class="degre">23</td>
                          <td class="titre">Yu Jia François Phongphaysane</td>
                        </tr>
                        <tr>
                          <td class="degre">24</td>
                          <td class="titre">Léo Thielin</td>
                        </tr>
                      </table>
                    </div>
                    <div class="columns">
                      <table class="liste">
                        <tr>
                          <td class="degre">25</td>
                          <td class="titre">Sébastien Crest</td>
                        </tr>
                        <tr>
                          <td class="degre">26</td>
                          <td class="titre">Gwendoline Verot</td>
                        </tr>
                        <tr>
                          <td class="degre">27</td>
                          <td class="titre">Lise Murgue</td>
                        </tr>
                        <tr>
                          <td class="degre">28</td>
                          <td class="titre">Mathieu Nicolle</td>
                        </tr>
                        <tr>
                          <td class="degre">29</td>
                          <td class="titre">Sophie Jeandel</td>
                        </tr>
                        <tr>
                          <td class="degre">30</td>
                          <td class="titre">Constance Duncan</td>
                        </tr>
                      </table>
                    </div>
                  </div>
                  <div class="clear"></div>
                </section>
              </section>

              <!-- ########### TARIFS ########## -->
              <section class="slides" id="tarifs">
                <h1>Tarifs</h1>
                <h3>Semestre <?php echo $semestre; ?></h3>
                <section class="box">
                  <!--div class="grid4"-->
                  <div class="grid4">
                    <div class="columns">
                      <h2>Pression</h2>
                      <table class="liste">
                        <?php foreach ($datas['pressions'] as $k => $v): ?>
                        <tr>
                          <td class="titre"><?php echo $v['nom'] ?></td>
                          <td class="prix"><?php echo $v['prix'] ?>€</td>
                          <td class="degre"><?php echo $v['degre'] ?>°</td>
                        </tr>
                        <?php endforeach ?>
                      </table>
                      <br/><br/>
                      <h2>Bouteille</h2>
                      <table class="liste">
                        <?php foreach ($datas['bouteilles'] as $k => $v): ?>
                        <tr>
                          <td class="titre"><?php echo $v['nom'] ?></td>
                          <td class="prix"><?php echo $v['prix'] ?>€</td>
                          <td class="degre"><?php echo $v['degre'] ?>°</td>
                        </tr>
                        <?php endforeach ?>
                      </table>
                    </div>
                    <div class="columns">
                      <h2>Soft</h2>
                      <table class="liste">
                        <?php foreach ($datas['softs'] as $k => $v): ?>
                        <tr>
                          <td class="titre"><?php echo $v['nom'] ?></td>
                          <td class="prix"><?php echo $v['prix'] ?>€</td>
                        </tr>
                        <?php endforeach ?>
                      </table>
                    </div>
                    <div class="columns">
                      <h2>Snack sucré</h2>
                      <table class="liste">
                        <?php foreach ($datas['sucre'] as $k => $v): ?>
                        <tr>
                          <td class="titre"><?php echo $v['nom'] ?></td>
                          <td class="prix"><?php echo $v['prix'] ?>€</td>
                        </tr>
                        <?php endforeach ?>
                      </table>
                    </div>
                    <div class="columns">
                      <h2>Snack frais</h2>
                      <table class="liste">
                        <?php foreach ($datas['frais'] as $k => $v): ?>
                        <tr>
                          <td class="titre"><?php echo $v['nom'] ?></td>
                          <td class="prix"><?php echo $v['prix'] ?>€</td>
                        </tr>
                        <?php endforeach ?>
                      </table>
                      <br/><br/>
                      <h2>Snack matin</h2>
                      <table class="liste">
                        <?php foreach ($datas['matin'] as $k => $v): ?>
                        <tr>
                          <td class="titre"><?php echo $v['nom'] ?></td>
                          <td class="prix"><?php echo $v['prix'] ?>€</td>
                        </tr>
                        <?php endforeach ?>
                      </table>                      
                      <br/><br/>
                      <h2>Snack salé</h2>
                      <table class="liste">
                        <?php foreach ($datas['sale'] as $k => $v): ?>
                        <tr>
                          <td class="titre"><?php echo $v['nom'] ?></td>
                          <td class="prix"><?php echo $v['prix'] ?>€</td>
                        </tr>
                        <?php endforeach ?>
                      </table>
                    </div>
                  </div>
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
        <script src="res/js/main.js"></script>
        <script src="res/js/countdown.js"></script>
        <script src="res/js/angular.min.js"></script>
        <script src="res/js/payutc.js"></script>
    </body>
</html>
