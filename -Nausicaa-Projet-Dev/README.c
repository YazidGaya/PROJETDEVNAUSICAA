//NOM: Gaya,Hagen
//PRENOM: Yazid,Florent
//Fichier: README

/* 
Ce projet a été réalisé dans le cadre du module Développement et Applications de la deuxième année de licence informatique.
 L'objectif était de créer un jeu de type Battleship (Bataille Navale) utilisant plusieurs technologies (C, HTML/CSS, JavaScript, PHP, SQL).

Le joueur peut jouer à Battleship via une interface web en 2D. 
Il doit deviner où se trouvent les bateaux cachés sur une grille en suivant des indices. 
La logique du jeu est codée en C, tandis que l'interface et la communication entre les parties utilisent PHP et JavaScript.

Caractéristiques principales :

Jeu solo avec une grille de taille configurable (6x6, 8x8 ou 10x10).
Les bateaux sont placés aléatoirement sur la grille selon des contraintes strictes.
Le joueur clique sur les cases pour les marquer comme "eau" ou "bateau".
Un système de vérification détermine si le joueur a gagné ou perdu.
Les statistiques (temps, nombre de coups) sont enregistrées dans une base de données.

Technologies utilisées
C : Implémentation de la logique du jeu (placement des bateaux, validation des coups).
PHP : Interface entre la logique en C et l'interface web.
HTML/CSS : Création de l'interface graphique.
JavaScript : Gestion des interactions utilisateur et dynamisation de l'interface.
SQL : Enregistrement des statistiques et des parties jouées.


Comment exécuter le projet ?
1. Pré-requis :
Un serveur local tel que MAMP ou XAMPP.
Un compilateur C (par exemple GCC ou visuel studio code).
Un navigateur web pour accéder à l'interface.
2. Installation :
Clonez ou téléchargez ce dépôt sur votre machine.
Placez les fichiers dans le répertoire racine de votre serveur web
Importez le fichier SQL fourni (battleship.sql) dans la base de données MySQL.
Compilez le fichier C avec GCC ou visuel studio code et "placez l'exécutable dans le répertoire backend"/.
Configurez votre serveur local pour exécuter les scripts PHP.
. Lancer le jeu :
Accédez à http://localhost/battleship via votre navigateur.
Suivez les instructions à l'écran pour démarrer une partie.

Contribution:
Organisation des tâches
Chaque membre de l'équipe a contribué à une partie spécifique du projet :
C : Gestion des règles et logique du jeu.
PHP : Communication entre la logique et l'interface.
HTML/CSS/JS : Création de l'interface et gestion des interactions.
SQL : Conception et gestion de la base de données.

Sans oublier le GitHub qui nous permet de crée une nouvelle branche pour nos modifications
à fin d'effectuer nos changement (push pull), ajoutez des commentaires 

*/

