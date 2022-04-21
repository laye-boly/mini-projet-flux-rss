# MiniProjetFluxRss

Ce proposé est proposé dans le cadre de ma candidature à la formation de fullstack enginner offerte par udacy

Il s'agit ici de lire un flux rss (des articles de presse) disponible à l'adresse `https://www.lemonde.fr/rss/en_continu.xml`. L'objectif est de récupérer, pour chaque article, son titre, son extrait, son image d'illustration.

On doit stocké les données recus dans une base de données pour pouvoiir les modifier

# Le Backend

Dans ce projet, j'ai utilisé le langage PHP pour le backend et le serveur MySQL pour la base de données

Le script server/loadDatabase.php est celui qui récupéré le flux rss et le charge les article dans la base de données news de au niveau de la table article

La table article a les champs suivants : id (La clé primaire de type INTEGER), title(son titre de type MEDIUMTEXT), extrait(son extrait de type MEDIUMTEXT) et img (l'url de son image d'illustration en VARCHAR)

Pour démarrer le serveur, il faut se deplacer au niveau du terminal dans le dossier serveur et lancer la commande `php -S localhost:8000`

Ensuite se rendre à http://localhost:8000/loadDatabase.php. Ainsi les articles sont récupéré et chargé dans MySQL. On doit appeler cette page une seule fois, sinon il récupéreras les mêmes articles et les ajouteras dans MySQL

# Le Frontend

J'ai utlisé Angular pour le frontend
Pour démarrer le client angular, il fautt se placer à la racine du projet et lancer la commande `ng serve` et se rendre à `http://localhost:4200/`. La page d'accueil affiche les 5 derniers articles

Pour afficher les 5 articles qui suivent, il faut appuyer sur le button `Suivant` et pour revenir sur les cinq précédent, appuyer sur le button `Précédent`

On peut aussi modifier chaque article en appuyant sur le button modiffier qui lui correspond

This project was generated with [Angular CLI](https://github.com/angular/angular-cli) version 13.3.3.

## Development server

Run `ng serve` for a dev server. Navigate to `http://localhost:4200/`. The application will automatically reload if you change any of the source files.

## Code scaffolding

Run `ng generate component component-name` to generate a new component. You can also use `ng generate directive|pipe|service|class|guard|interface|enum|module`.

## Build

Run `ng build` to build the project. The build artifacts will be stored in the `dist/` directory.

## Running unit tests

Run `ng test` to execute the unit tests via [Karma](https://karma-runner.github.io).

## Running end-to-end tests

Run `ng e2e` to execute the end-to-end tests via a platform of your choice. To use this command, you need to first add a package that implements end-to-end testing capabilities.

## Further help

To get more help on the Angular CLI use `ng help` or go check out the [Angular CLI Overview and Command Reference](https://angular.io/cli) page.
