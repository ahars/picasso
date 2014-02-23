
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="Site web du Pic'Asso UTC">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Administration :: Pic'Asso UTC</title>
    <link rel="shortcut icon" href="res/img/favicon.png" />
    <link rel="stylesheet" href="res/css/bootstrap.min.css">
    <link rel="stylesheet" href="res/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="res/css/admin.css">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body data-spy="scroll" data-target="#main-navbar">

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="admin">Administration</a>
        </div>
        <div id="main-navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="#goodies">Goodies</a></li>
            <li><a href="#bieres">Bières</a></li>
            <li><a href="#snacks">Snacks</a></li>
            <li><a href="#softs">Softs</a></li>
            <li><a href="#users">Utilisateurs</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    <div class="container main-container">
        <?php if (isset($flash['error'])): ?>
        <section class="flash row">
          <div class="alert alert-error">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Erreur !</strong> <?php echo $flash['error']; ?>
          </div>
        </section>
        <?php endif ?>
        <?php if (isset($flash['success'])): ?>
          <section class="flash row">
            <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Bravo !</strong> <?php echo $flash['success']; ?>
            </div>
          </section>
        <?php endif ?>

      <!-- Goodies -->
      <div class="row" id="goodies">
        <div class="col-md-3 well" >
          <section class="section-menu">
            <h3 class="first">Ajouter un goody</h3>
            <form class="form-horizontal" role="form" action="goodies" id="navbar-goodies" method="post">
              <div class="col-sm-6">
                <div class="form-group ">
                  <input name="data[semaine]" type="week" class="form-control input-group input-sm" id="inputSemaine" placeholder="Semaine" required>
                </div>
              </div> 
              <div class="col-sm-6">
                <div class="form-group ">
                  <input name="data[numero]" type="number" class="form-control input-group input-sm" id="inputNumero" placeholder="Numéro" required>
                </div>   
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <input name="data[nom]" type="text" maxlength="80" class="form-control input-group input-sm" id="inputNom" placeholder="Nom" required>
                </div>   
              </div> 
              <div class="col-sm-12">
                <div class="form-group">
                  <input name="data[prenom]" type="text" maxlength="80" class="form-control input-group input-sm" id="inputPrenom" placeholder="Prénom" required>
                </div>   
              </div> 
              <button type="submit" class="btn btn-primary">Valider</button>
              <button type="reset" class="btn btn-danger">Vider</button>
            </form>
          </section>
        </div>
        <!-- Tableau -->
        <div class="col-md-9">
          <section class="section paginable">
            <h3>Goodies</h3>
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <td>Semaine</td>
                  <td>Numéro</td>
                  <td>Nom</td>
                  <td>Prénom</td>
                  <td><span class="glyphicon glyphicon-pencil"></span></td>
                  <td><span class="glyphicon glyphicon-trash"></span></td>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($datas['goodies'] as $k => $v): ?>
                  <tr class="goodies-<?php echo $v['id'];?>">
                    <td><?php echo $v['semaine']; ?></td>
                    <td><?php echo $v['numero']; ?></td>
                    <td><?php echo $v['nom']; ?></td>
                    <td><?php echo $v['prenom']; ?></td>
                    <td><a class="editable" href="edit-goodies-<?php echo $v['id'];?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
                    <td><a class="deletable" href="delete-goodies-<?php echo $v['id'];?>"><span class="glyphicon glyphicon-trash"></span></a></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>              
            <ul class="pagination">
            </ul>
          </section>
        </div>
      </div>

      <!-- Bières -->
      <div class="row" id="bieres">
        <div class="col-md-3 well">        
          <section class="section-menu">
            <h3 class="first">Ajouter une bière</h3>
            <form class="form-horizontal" role="form" action="bieres" id="navbar-bieres" enctype="multipart/form-data" method="post">
              <div class="col-sm-12">
                <div class="form-group">
                  <input name="data[nom]" type="text" maxlength="80" class="form-control input-sm" id="inputNom" placeholder="Nom" required>
                </div>   
              </div> 
              <div class="col-sm-12">
                <div class="form-group">
                  <textarea name="data[description]" maxlength="255" class="form-control input-sm" id="inputDescritpion">Description</textarea> 
                </div>   
              </div> 
              <div class="col-sm-12">
                <div class="form-group">
                  <select name="data[category]" class="form-control input-sm" id="inputCategory">
                    <option value="PRESSION">Pression</option>
                    <option value="BOUTEILLE">Bouteille</option>
                  </select> 
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <input name="data[prix]" type="number" min="0" step=".01" class="form-control input-sm" id="inputPrix" placeholder="Prix" required>
                </div>   
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <input name="data[degre]" type="number" min="0" step=".01" class="form-control input-sm" id="inputDegre" placeholder="Degré" required>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <input name="img_url" type="file" class="form-control input-sm" id="inputImgUrl" >
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">Week Bière ?&nbsp;
                    <input name="data[checkbox]" type="checkbox" id="checkbox-biere"><br>
                </div>
              </div> 
              <div class="col-sm-6">
                <div class="form-group">
                  <p class="text-center">Off/On ?&nbsp;
                  <input name="data[disabled]" type="checkbox">
                  </p>
                </div>   
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <input name="data[semaine]" type="week" class="form-control hide input-sm" id="inputSemaine" placeholder="Semaine" >
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Valider</button>
              <button type="reset" class="btn btn-danger">Vider</button>
            </form>
          </section>
        </div>
        <!-- Tableau -->
        <div class="col-md-9">
          <section class="section paginable">
            <h3>Bières</h3>
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <td>Off/On</td>
                  <td>Semaine</td>
                  <td>Nom</td>
                  <td>Catégorie</td>
                  <td>Prix</td>
                  <td>Degré</td>
                  <td><span class="glyphicon glyphicon-pencil"></span></td>
                  <td><span class="glyphicon glyphicon-trash"></span></td>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($datas['bieres'] as $k => $v): ?>
                  <tr class="bieres-<?php echo $v['id'];?>">
                    <td class="small"><input type="checkbox" name="disabled" <?php echo $v['disabled'] ? "checked" : ""; ?>></td>
                    <td><?php echo $v['semaine']; ?></td>
                    <td><?php echo $v['nom']; ?></td>
                    <td><?php echo $v['category']; ?></td>
                    <td><?php echo $v['prix']; ?></td>
                    <td><?php echo $v['degre']; ?></td>
                    <td><a class="editable" href="edit-bieres-<?php echo $v['id'];?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
                    <td><a class="deletable" href="delete-bieres-<?php echo $v['id'];?>"><span class="glyphicon glyphicon-trash"></span></a></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>              
            <ul class="pagination">
            </ul>
          </section>
        </div>
      </div>

      <!-- Snacks -->
      <div class="row" id="snacks">
        <div class="col-md-3 well">        
          <section class="section-menu">
            <h3 class="first">Ajouter un snack</h3>
            <form class="form-horizontal" role="form" action="snacks" id="navbar-snacks" method="post">
              <div class="col-sm-12">
                <div class="form-group">
                  <input name="data[nom]" type="text" maxlength="80" class="form-control input-sm" id="inputNom" placeholder="Nom" required>
                </div>   
              </div> 
              <div class="col-sm-12">
                <div class="form-group">
                  <textarea name="data[description]" maxlength="255" class="form-control input-sm" id="inputDescritpion">Description</textarea> 
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <input name="data[prix]" type="number" min="0" step=".01" class="form-control input-sm" id="inputPrix" placeholder="Prix" required>
                </div>   
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <p class="text-center">Off/On ?&nbsp;
                  <input name="data[disabled]" type="checkbox">
                  </p>
                </div> 
              </div> 
              <button type="submit" class="btn btn-primary">Valider</button>
              <button type="reset" class="btn btn-danger">Vider</button>
            </form>
          </section>
        </div>

        <!-- Tableau -->
        <div class="col-md-9">
          <section class="section paginable">
            <h3>Snacks</h3>
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <td>Off/On</td>
                  <td>Nom</td>
                  <td>Prix</td>
                  <td><span class="glyphicon glyphicon-pencil"></span></td>
                  <td><span class="glyphicon glyphicon-trash"></span></td>
                </tr>
              </thead>
              <tbody>
                <?php foreach($datas['snacks'] as $k => $v): ?>
                  <tr class="snacks-<?php echo $v['id'];?>">
                    <td class="small"><input type="checkbox" name="disabled" <?php echo $v['disabled'] ? "checked" : ""; ?>></td>
                    <td><?php echo $v['nom']; ?></td>
                    <td><?php echo $v['prix']; ?></td>
                    <td><a class="editable" href="edit-snacks-<?php echo $v['id'];?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
                    <td><a class="deletable" href="delete-snacks-<?php echo $v['id'];?>"><span class="glyphicon glyphicon-trash"></span></a></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>              
            <ul class="pagination">
            </ul>
          </section>
        </div>
      </div>

      <!-- Softs -->
      <div class="row" id="softs">
        <div class="col-md-3 well">    
          <section class="section-menu">
            <h3 class="first">Ajouter un soft</h3>
            <form class="form-horizontal" role="form" action="softs" id="navbar-softs" method="post">
              <div class="col-sm-12">
                <div class="form-group">
                  <input name="data[nom]" type="text" maxlength="80" class="form-control input-group input-sm" id="inputNom" placeholder="Nom" required>
                </div>   
              </div> 
              <div class="col-sm-12">
                <div class="form-group">
                  <textarea name="data[description]" maxlength="255" class="form-control input-sm" id="inputDescritpion">Description</textarea> 
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <input name="data[prix]" min="0" step=".01" type="number" class="form-control input-group input-sm" id="inputPrix" placeholder="Prix" required>
                </div>   
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <p class="text-center">Off/On ?&nbsp;
                  <input name="data[disabled]" type="checkbox" name="disabled">
                  </p>
                </div> 
              </div> 
              <button type="submit" class="btn btn-primary">Valider</button>
              <button type="reset" class="btn btn-danger">Vider</button>
            </form>
          </section>
        </div>

        <!-- Tableau -->
        <div class="col-md-9">
          <section class="section paginable">
            <h3>Softs</h3>
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <td>Off/On</td>
                  <td>Nom</td>
                  <td>Prix</td>
                  <td><span class="glyphicon glyphicon-pencil"></span></td>
                  <td><span class="glyphicon glyphicon-trash"></span></td>
                </tr>
              </thead>
              <tbody>
                <?php foreach($datas['softs'] as $k => $v): ?>
                  <tr class="softs-<?php echo $v['id'];?>">
                    <td class="small"><input type="checkbox" name="disabled" <?php echo $v['disabled'] ? "checked" : "";  ?>></td>
                    <td><?php echo $v['nom']; ?></td>
                    <td><?php echo $v['prix']; ?></td>
                    <td><a class="editable" href="edit-softs-<?php echo $v['id'];?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
                    <td><a class="deletable" href="delete-softs-<?php echo $v['id'];?>"><span class="glyphicon glyphicon-trash"></span></a></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>              
            <ul class="pagination">
            </ul>
          </section>
        </div>
      </div>

      <!-- Users -->
      <div class="row" id="users">
        <div class="col-md-3 well"> 
          <section class="section-menu">
            <h3 class="first">Ajouter un utilisateur</h3>
            <form class="form-horizontal" role="form" action="users" id="navbar-users" method="post">
              <div class="form-group">
                <div class="col-sm-12">
                  <input name="data[login]" type="text" maxlength="8" class="form-control input-group input-sm" id="inputLogin" placeholder="Login" required>
                </div>   
              </div>
              <button type="submit" class="btn btn-primary">Valider</button>
              <button type="reset" class="btn btn-danger">Vider</button>
            </form>
          </section>
        </div>
        <div class="col-md-9">
          <section class="section paginable">
            <h3>Utilisateurs</h3>
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <td>Login</td>
                  <td><span class="glyphicon glyphicon-pencil"></span></td>
                  <td><span class="glyphicon glyphicon-trash"></span></td>
                </tr>
              </thead>
              <tbody>
                <?php foreach($datas['users'] as $k => $v):?>
                  <tr class="users-<?php echo $v['login'];?>">
                    <td><?php echo $v['login']; ?></td>
                    <td><a class="editable" href="edit-users-<?php echo $v['login'];?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
                    <td><a class="deletable" href="delete-users-<?php echo $v['login'];?>"><span class="glyphicon glyphicon-trash"></span></a></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>              
            <ul class="pagination">
            </ul>
          </section>
        </div>
      </div>

    </div><!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="res/js/jquery-1.10.2.min.js"></script>
    <script src="res/js/jquery.form.min.js"></script>
    <script src="res/js/bootstrap.min.js"></script>
    <script src="res/js/mustache.js"></script>
    <script src="res/js/admin.js"></script>
  </body>
</html>
