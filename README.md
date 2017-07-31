<h1/>OC_BLOG</h1>

OC_BLOG est un projet réalisé dans le cadre de la formation "Dévelopeur d'application" d'OpenClassrooms.


<h2/>Installation</h2>

Pour installer le projet, utilisez Git pour récupérer le code source et le placer dans votre dossier web.

Assurez vous d'avoir accès aux comandes PHP dans votre console.

Ouvrer votre console et placez vous dans le dossier du projet.

Vous aurez besoin du composant "Composer", lancer la commande suivante dans la console : 
C:\wamp\www> php -r "eval('?>'.file_get_contents('http://getcomposer.org/installer'));"

Utiliser la commande "php composer.phar update" pour mettre à jour toutes les dépendances du projet.

Configurer le fichier "config.yml" situé dans le dossier "app/config/" pour renseigner vos paramètres de votre 
base de données ainsi que les données de votre adresse mail.

Créer les tables de la base de données en utilisant les commandes suivantes dans la console:
<br/>
php vendor/doctrine/orm/bin/doctrine orm:schema-tool:create
<br/>
php vendor/doctrine/orm/bin/doctrine orm:schema-tool:update --force




