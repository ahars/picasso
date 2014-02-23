Introduction
============
Le picasso est une association étudiante de l'Université de Technologie de Compiègne. Cette association s'occupe du foyer étudiant.
Les étudiants peuvent s'y détendre en jouant au babby-foot, en sirotant des sodas et en grignotant des snacks.
Les différentes associations de l'UTC tiennent des persmanences le matin, midi et soir afin de servir les étudiants et animer la salle.
Le site est disponible à l'adresse suivante [Site du Picasso](http://assos.utc.fr/picasso/).

Frameworks
============
Le site utilise le framework PHP Slim. La documentation est en ligne : [Doc Slim](http://docs.slimframework.com/).

Pour le design, le framework [Compass](http://compass-style.org/install/) avec le Plugin [Susy](http://susydocs.oddbird.net/en/latest/) sont utilisés.
Ces derniers sont des Gem Ruby.

Installation
============
Le projet utilise Composer pour la gestion des dépendances.

Après avoir cloné le dépôt, il faut installer Composer :

`curl -s https://getcomposer.org/installer | php`

Puis, installer les dépendances :

`php composer.phar install`

Ensuite il faut importer la base de donnée de dev `picasso_%date%.sql`.

La configuration de la base de donnée ce fait directement dans le fichier `classes/db.class.php`.

Il faut y renseigner l'adresse, le username, le password et la table à utiliser.

Compass
======
Pour activer le script de compilation des fichiers SCSS en CSS, il faut entrer la commande : 

`compass watch /path/to/the/config.rb/folder`

Celui cherchera dans ce dossier le fichier `config.rb` pour compiler les fichiers avec la bonne configuration (dossiers etc).

Développement
======
Le site effectue des requètes sur deux services :
* [Payutc](https://github.com/payutc/server)
* [Portail des associations](https://github.com/simde-utc/portail)

Le serveur de Payutc permet de récupérer les informations suivantes :
* Tarifs
* Articles en vente
On utilise le [JSONClientMiddleware](https://github.com/payutc/casper/tree/master/src/Payutc/Casper) pour faire des requêtes.

Le portail des associations permet de récupérer les informations suivantes :
* Calendrier des permanences
* Dernière News
On utilise la classe CURL pour faire des requêtes.
