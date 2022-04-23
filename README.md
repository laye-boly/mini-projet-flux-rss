# MiniProjetFluxRss

Ce mini projet est proposé dans le cadre de ma candidature à la formation de fullstack engineer offerte par EDACY

Il s'agit ici de lire un flux rss (des articles de presse) disponible à l'adresse `https://www.lemonde.fr/rss/en_continu.xml`. L'objectif est de récupérer, pour chaque article, son titre, son extrait, son image d'illustration.

On doit stocké les données reçus dans une base de données pour pouvoir les modifier ultérieurement

# Le Backend

Dans ce projet, j'ai utilisé le langage PHP pour le backend et le serveur MySQL pour la base de données

Le script server/loadDatabase.php est celui qui récupère le flux rss et charge articles dans la base de données news au niveau de la table article

La table article a les champs suivants : id (La clé primaire de type INTEGER), title(son titre de type MEDIUMTEXT), extrait(son extrait de type MEDIUMTEXT) et img (l'url de son image d'illustration en VARCHAR)

Pour démarrer le serveur PHP, il faut se deplacer au niveau du terminal dans le dossier serveur et lancer la commande `php -S localhost:8000`

Ensuite se rendre à `http://localhost:8000/loadDatabase.php`. Ainsi les articles sont récupérés et chargés dans MySQL. On doit appeler cette page une seule fois, sinon il récupéreras les mêmes articles et les ajouteras dans MySQL

# Le Frontend

J'ai utlisé Angular pour le frontend
Pour démarrer le client angular, il fautt se placer à la racine du projet et lancer la commande `ng serve` et se rendre à `http://localhost:4200/`. La page d'accueil affiche les 5 derniers articles

Pour afficher les 5 articles qui suivent, il faut appuyer sur le button `Suivant` et pour revenir sur les 5 précédents, appuyer sur le button `Précédent`

On peut aussi modifier chaque article en appuyant sur le button modiffier qui lui correspond

# Video de démonstration du projet

J'ai fait une capture d'écran et audio démontrant les fonctionnalité du projet

On peut y avoir accèss en cliquant sur ce lien : `https://drive.google.com/drive/folders/1nF8lw29FqSmpfywGSQxdLR3RwHo4wPLG`
