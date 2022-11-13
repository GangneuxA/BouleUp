-Procédure d'installation

prérequis -> symfony

Pour commencer récupérer le projet sur le GitHub : https://github.com/GangneuxA/BouleUp
Ensuite lancez vos serveurs Apache et MySQL à l’aide de XAMPP par exemple et placé le dossier BouleUP dans vos fichiers xampp. Ouvrez un navigateur et allez sur phpmyadmin, créer une nouvelle base de données “bouleup” et importer le script SQL : “BouleUp.sql” qui se situe dans le dossier BouleUp. Lancé un terminal et placez vous dans le dossier télécharger et lancer les commande suivante :
-composer install
-composer require symfony/webpack-encore-bundle
-npm install
-npm install @symfony/webpack-encore --save-dev
-npm run dev
puis lancé la commande “symfony serve”. Retournez ensuite sur un navigateur est allez à l’adresse suivante : http://127.0.0.1:8000/home .
