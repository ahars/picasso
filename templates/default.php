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
                <a href="http://assos.utc.fr/picasso"><img src="res/img/logo_A14.png" alt="Picasso Logo"></a>
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

              <!-- ########### CALENDRIER ########## -->
              <section class="slides" id="calendrier">
                <h1>Calendrier</h1>
                <h3>Semestre <?php echo $semestre; ?> - Semaine du <?php echo preg_replace('#(.*)/(.*)/(.*)$#', '$1/$2', $semaine_start); ?> au <?php echo preg_replace('#(.*)/(.*)/(.*)$#', '$1/$2', $semaine_end); ?></h3>
                <section class="box">
                  <div class="grid5">
                    <?php
/*                      // Parcours des jours.
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
*/ /*
                        list($perm1_start, $perm1_end) = explode(';', $perms[0]);
                        list($perm2_start, $perm2_end) = explode(';', $perms[1]);
                        list($perm3_start, $perm3_end) = explode(';', $perms[2]);
                        list($perm4_start, $perm4_end) = explode(';', $perms[3]);

                        // Perm normale.
                        for ($j = 0; $j < 4; $j++) {

                          $found = false;
                          for ($k = 0; $k < count($cal_titre); $k++) {

                            list($cal_date_s, $cal_date_e) = explode(';', $cal_date[$k]);
                            list($cal_horaire_s, $cal_horaire_e) = explode(';', $cal_horaire[$k]);

                            if ($cal_tag[$k] == $perm AND $cal_date_s == ($semaine_start + $i) AND $cal_date_e == ($semaine_start + $i)) {

                              switch ($j) {
                                case 0:
                                  if ($cal_horaire_s >= $perm1_start AND $cal_horaire_e <= $perm1_end AND $cal_horaire_s < $perm2_start AND !found) {
                                    $number = $j + 1;
                                    $found = true;
                                  }
                                  break;
                                
                                case 1:
                                  if ($cal_horaire_s >= $perm2_start AND $cal_horaire_e <= $perm2_end AND $cal_horaire_s < $perm3_start AND !found) {
                                    $number = $j + 1;
                                    $found = true;
                                  }
                                  break;

                                case 2:
                                  if ($cal_horaire_s >= $perm3_start AND $cal_horaire_e <= $perm3_end AND $cal_horaire_s < $perm4_start AND !found) {
                                    $number = $j + 1;
                                    $found = true;
                                  }
                                  break;

                                case 3:
                                  if ($cal_horaire_s >= $perm4_start AND $cal_horaire_e <= $perm4_end AND AND !found) {
                                    $number = $j + 1;
                                    $found = true;
                                  }
                                  break;
                              }
                            }

                            if (found) {
                              echo '<a href="' . $cal_url[$k] . '">';
                              echo '<div class="block">';
                              echo '<span class="perm_asso">' . $cal_asso[$k] . '</span>';
                              if ($i < 3) {
                                echo '<div class="detail d-left d-' . $number . '">';
                              } else {
                                echo '<div class="detail d-right d-' . $number . '">';
                              }
                              echo '<div class="date">' . $cal_date[$k] . '</div>';
                              echo '<div class="perm">' . preg_replace('#(.*)\:(.*)\:00$#', '$1h$2', $cal_horaire_s) . ' - ' . preg_replace('#(.*)\:(.*)\:00$#', '$1h$2', $cal_horaire_e) . '</div>';
                              echo '<div class="asso">' . $cal_asso[$k] . '</div>';
                              echo '<div class="titre">' . $cal_titre[$k] . '</div>';
                              echo '<div class="corps">' . $cal_corps[$k] . '</div>';
                              echo '<div class="lien">[Clique pour plus d\'infos]</div>'
                            }
                          }

                          if (!$found) {
                            echo '<a href="#"><div class="block"></div></a>';
                         }
                        }
                        echo '</div></div></a></div>';
                      }
                    ?>
                  </div>
                  <div class="clear"></div>
                </section>
              </section>

<a href="#">
<div class="block"></div>
</a>

*/  ?>

                    <!-- LUNDI -->
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
                      <a href="http://assos.utc.fr/event/show/502">
                        <div class="block">
                          <span clas="perm_asso">Pompom Rugby</span>
                          <div class="detail d-left d-4">
                            <div class="date">Lundi 16 Juin</div>
                            <div class="perm">18h30 - 22h00</div>
                            <div class="asso">Pompom - Rugby</div>
                            <div class="titre">Perm Lundi (Pompom - Rugby)</div>
                            <div class="corps">Des Pompoms, des Rugbywomen et du fun</div>
                            <div class="lien">[Clique pour plus d'infos]</div>
                          </div>
                        </div>
                      </a> 
                    </div>
                    <!-- MARDI -->
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
                    <!-- MERCREDI -->
                    <div class="columns">
                      <a href="#">
                        <div class="block"></div>
                      </a>
                      <a href="http://assos.utc.fr/event/show/500">
                        <div class="block">
                          <span clas="perm_asso">Club Chine</span>
                          <div class="detail d-left d-2">
                            <div class="date">Mercredi 18 Juin</div>
                            <div class="perm">12h15 - 14h15</div>
                            <div class="asso">Club Chine</div>
                            <div class="titre">Déjeuner chaud! Nouilles à wok!</div>
                            <div class="corps">Déjeuner chaud! Nouilles à wok!</div>
                            <div class="lien">[Clique pour plus d'infos]</div>
                          </div>
                        </div>
                      </a>
                      <a href="#">
                        <div class="block"></div>
                      </a>
                      <a href="#">
                        <div class="block"></div>
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
                      <a href="http://assos.utc.fr/event/show/503">
                        <div class="block">
                          <span clas="perm_asso">Motherfuckers</span>
                          <div class="detail d-right d-4">
                            <div class="date">Jeudi 19 Juin</div>
                            <div class="perm">18h30 - 22h00</div>
                            <div class="asso">Motherfuckers</div>
                            <div class="titre">Perm Full Moon Party</div>
                            <div class="corps">le Pic'Asso ouvre pour une des DERNIÈRES fois ses portes, pour une soirée enflammée sur la plage Thaïlandaise</div>
                            <div class="lien">[Clique pour plus d'infos]</div>
                          </div>
                        </div>
                      </a>
                    </div>
                    <!-- VENDREDI -->
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


<?php  /*
list($perm1_start, $perm1_end) = explode(';', $perms[0]);
list($perm2_start, $perm2_end) = explode(';', $perms[1]);
list($perm3_start, $perm3_end) = explode(';', $perms[2]);
list($perm4_start, $perm4_end) = explode(';', $perms[3]);

// Parcours des 5 jours
for ($i = 0; $i < 5; $i++) {
?>

  <div class="columns">

  <?php
  // Pour chaque perm d'une journée
  for ($j = 0; $j < 4; $j++) {

    $found = false;
    $nb = 0;

    for ($k = 0; $k < count($cal_titre); $k++) {

      list($cal_date_s, $cal_date_e) = explode(';', $cal_date[$k]);
      list($cal_horaire_s, $cal_horaire_e) = explode(';', $cal_horaire[$k]);

      if ($cal_tag[$k] == $perm) {

        $nb = $nb + 1;

        if () {
          
        }
      }
    }
    


    if (!$found) { ?>
      <a href="#">
        <div class="block">
          <span class="perm_asso"><?php echo $nb; ?></span>
        </div>
      </a>
    <?php } else { ?>
      <a href=<?php echo $cal_url[$nb]; ?>>
        <div class="block">
          <span class="perm_asso"><?php echo $cal_asso[$nb]; ?></span>
          <?php if($i < 3) { ?> 
            <div class="detail d-left d-"<?php echo $j;?>>
          <?php } else { ?>
            <div class="detail d-right d-"<?php echo $j;?>>
          <?php } ?>
            <div class="date"><?php echo $cal_date_s; ?></div>
            <div class="perm"><?php echo $cal_horaire_s; ?></div>
            <div class="asso"><?php echo $cal_asso[$nb]; ?></div>
            <div class="titre"><?php echo $cal_titre[$nb]; ?></div>
            <div class="corps"><?php echo $cal_corps[$nb]; ?></div>
            <div class="lien">[Clique pour plus d'infos]</div>
          </div>
        </div>
      </a>
    <?php }
    } ?>
  </div>
<?php } */?>

                  </div>
                  <div class="clear"></div>
                </section>
              </section>

              <!-- ########### WEEKBIERE ########## -->
              <section class="slides" id="weekbieres">
                <h1>Bières de la semaine</h1>
                <h3>Semestre <?php echo $semestre; ?> - Semaine du <?php echo preg_replace('#(.*)/(.*)/(.*)$#', '$1/$2', $semaine_start); ?> au <?php echo preg_replace('#(.*)/(.*)/(.*)$#', '$1/$2', $semaine_end); ?></h3>
                <section class="box">
                  <div class="grid2">
                    <div class="columns" id="pression">
                      <h2>Pression</h2>
                      <table class="liste">
                        <?php foreach ($datas['weekpressions'] as $k => $v): ?>
                        <tr>
                          <td class="image"><img src=<?php echo $v['img_url']; ?> width="100px" length="100px"></td>
                          <td class="titre"><?php echo $v['nom']; ?></td>
                          <td class="prix"><?php echo $v['prix']; ?>€</td>
                          <td class="degre"><?php echo $v['degre']; ?>°</td>
                        </tr>
                        <?php endforeach ?>
                      </table>
                      <br/>
                    </div>
                    <div class="columns" id="bouteille">
                      <h2>Bouteilles</h2>
                      <table class="liste">
                        <?php foreach ($datas['weekbouteilles'] as $k => $v): ?>
                        <tr>
                          <td class="image"><img src=<?php echo $v['img_url']; ?> width="100px" length="100px"></td>
                          <td class="titre"><?php echo $v['nom']; ?></td>
                          <td class="prix"><?php echo $v['prix']; ?>€</td>
                          <td class="degre"><?php echo $v['degre']; ?>°</td>
                        </tr>
                        <?php endforeach ?>
                      </table>
                    </div>
                  <div class="clear"></div>
                </section>
              </section>

              <!-- ########### GOODIES ########## -->
              <section class="slides" id="goodies">
                <h1>Goodies</h1>
                <h3>Les gagnants - Semaine du <?php echo preg_replace('#(.*)/(.*)/(.*)$#', '$1/$2', $semaine_start); ?> au <?php echo preg_replace('#(.*)/(.*)/(.*)$#', '$1/$2', $semaine_end); ?></h3>
                <section class="box"> 
                  <div class="grid4">
                    <div class="columns">
                      <table class="liste">
                        <?php $i = 0;
                          foreach ($datas['goodies'] as $k => $v):
                            $i = $i + 1;
                          ?>  
                          <tr>
                            <td class="degre"><?php echo $v['numero']; ?></td>
                            <td class="titre"><?php echo $v['prenom'] . ' ' . $v['nom']; ?></td>
                          </tr>
                          <?php if (($i % 5) == 0) { ?>
                            </table>
                            </div>
                            <div class="columns">
                            <table class="liste">
                          <?php }
                          endforeach ?>
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
        <!--script src="res/js/jquery-1.9.1.min.js"></script-->
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
