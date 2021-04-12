_creator name_ : _**PascalL7**_

_document version_ :  0.1

_language_ : fr_FR (Français-French)

_license_ : **CC BY-NC-SA**
---------------------------

This license allows reusers to distribute, remix, adapt, and build upon the material in any medium or format for noncommercial purposes only, and only so long as attribution is given to the creator. If you remix, adapt, or build upon the material, you must license the modified material under identical terms.

**CC BY-NC-SA** includes the following elements:

**BY** – Credit must be given to the creator

**NC** – Only noncommercial uses of the work are permitted

**SA** – Adaptations must be shared under the same terms

Git avec la ligne de commande
=============================

Pourquoi connaître la ligne de commande pour Git ?
--------------------------------------------------

* Il est utile de connaître les commandes Git, par exemple si vous changez d'IDE (passer de PHPStorm à Visual Studio Code ou encore Eclipe), vous devrez réapprendre où se trouvent les menus et comment ils se nomment pour chaque IDE.
* Il y a des opérations plus fines que vous pourrez faire dans Git avec des options de la ligne de commande pas toujours présentes dans les interfaces graphiques des IDE

La documentation officielle de Git
---------------------------------

https://git-scm.com/

Qu'est-ce-que Git ?
-------------------

https://fr.wikipedia.org/wiki/Git

Commandes Git courantes
=======================

Accès à l'aide détaillée d'une commande
---------------------------------------

commande_git help

_exemples :_ 
* git help 
* git status help

Accès aux options d'une commande
--------------------------------

commande_git help -g

_exemples : _
* git help -g
* git status -g

Affichage de votre version de Git
---------------------------------

* git version

_note_ : git évoluant au fil des années, certaines commandes ou options sont ajoutées ou modifiées, d'où l'importance de connaître la version de Git.

Cloner un dépôt Git distant sur votre ordinateur
------------------------------------------------

* git clone https://github.com/NomDuDeveloppeur/projet1.git

Savoir si votre dépôt local est relié à un dépôt distant
--------------------------------------------------------

* git remote -v

Créer votre dépôt local
-----------------------

git init

Connaître à tout instant où vous en êtes
----------------------------------------

* git status

_note_ : git status est intéressant par exemple avant un git add et après un git add

git status vous indique également sur quelle branche vous vous trouvez.


Ajouter TOUS les fichiers en attente en une seule fois
------------------------------------------------------

* git add .

Ajouter UN fichier en attente
-----------------------------

* git add répertoire/nom_du_fichier

Réaliser un Commit avec un message descriptif
---------------------------------------------

* git commit -m "mon message"

Connaître les détails de vos commits
------------------------------------

* git log

Les branches
============

Par défaut après la commande git init, une branche nommée "master" est créée.

Une bonne pratique consiste à créer au moins une branche de développement, voir selon votre workflow git, ou l'usage que vous souhaitez en faire, une branche par développeur par exemple.

Le but étant de travailler, sur la branche qui vous est attribuée par le Git Master, de votre équipe, et d'éviter de polluer le dépôt Master avec vos modfications, qui ne pourraient pas concerner toute l'équipe des développeurs.

Documentation avec schémas explicatifs : https://git-scm.com/book/fr/v2/Les-branches-avec-Git-Les-branches-en-bref#s_create_new_branch


Connaître le nom de la branche sur laquelle vous êtes
------------------------------------------------------

* git branch

Créer une nouvelle branche et basculer dessus
---------------------------------------------

* git branch developpement
* git checkout developpement
* git branch

Raccourci de la création de branche et du basculement dessus :

* git checkout -b "nouvelle branche"

Vous pouvez aussi créer une branche "testing", dédiée aux tests.

Lorsque vous créez une nouvelle branche et que vous basculez dessus, les modifications en cours de la branche précédente ne sont pas perdues, mais restent en l'état. Tandis que les modifications que vous apportez à votre nouvelle branche, vivent de leur côté.

Basculer sur une autre branche
------------------------------

* git checkout nom_de_la_branche
* git switch nom_de_la_branche (depuis la version 2.23 de git)

Revenir sur votre branche précédente
------------------------------------

* git switch -

Fusion des branches
-------------------

Documentation avec schémas : https://git-scm.com/book/fr/v2/Les-branches-avec-Git-Branches-et-fusions%C2%A0%3A-les-bases

Lorsque vous avez, par exemple, fixé un bug dans une branche de travail dédiée à ce dernier, il est nécessaire de commiter les modifications apportées par un git commit -a -m "correction du bug x"

Ensuite, pour fusionner vos modifications dans la branche master, par exemple, ou testing, il faut faire :

* git checkout master
* git merge nom_de_la_branche_de_correction

Suppression d'une branche
-------------------------

Lorsque vous avez terminé de travailler sur une branche, il est utile de la supprimer.

* git branch -d nom_de_la_branche

Les conflits de fusion
----------------------

Ils peuvent survenir dès lors que le processus de Merge ne s'est pas correctement déroulé.

Un git status vous indiquera les conflits à résoudre.

Lorsque vous ouvrirez dans votre IDE, un fichier source en conflit aurez un affichage similaire à celui-ci :

<<<<<<< HEAD:index.html
<div id="footer">contact : email.support@github.com</div>
.======
<div id="footer">
 please contact us at support@github.com
</div>
>>>>>>> iss53:index.html

La partie <<<<<< HEAD indique ce qui se trouve dans la branche Master avec laquelle vous avez voulu fusionner.

La partie en dessous des .======, est la version de code de votre branche de modification.

Il convient donc de choisir entre l'une ou l'autre de ces versions dans votre code.

_note_ : après la résolution d'un conflit il est recommandé de lancer la commande git status pour savoir si il n'existe pas d'autres problèmes à résoudre.

La commande git branch plus en détail
-------------------------------------

* git branch -v : vous indique les derniers commits sur chaque branche.
* git branch --merged : vous indique les travaux qui ont été fusionnés.
* git branch --no-merged, vous indique les branches qui contiennent des travaux qui n'ont pas encore été fusionnés.

Si vous tentez de supprimer une branche sur laquelle les travaux non pas été intégrés, vous aboutirez à un échec.

Pour afficher l'état de fusion par rapport à la branche master :
* git checkout testing
* git branch --no-merged master

Renommer une branche
--------------------

* git branch --move ancien_nom_de_la_branche nouveau_nom_de_la_branche

_note_: ceci ne s'applique qu'à votre dépôt git local. Pour changer également, le nom de votre branche sur le serveur distant, il convient de faire :

* git push --set-upstream origin nouveau_nom_de_la_branche

* git branch --all : vous indiquera les branches locales et distantes, (vérification utile après ces manipulations).

Renommer le nom de la branche master
------------------------------------

* git branch --move master main
* git push --set-upstream origin main
* git branch --all : et là vous constaterez que vous avez encore une branche master sur le serveur distant en plus de la branche main !
Par contre votre branche master locale a disparu et a été remplacée par la branche main.
  
Pour terminer cette transition :
* tous les autres projets dépendants de celui-ci doivent avoir leur code modifié en conséquence.
* mettez à jour tous vos fichiers de configuration de test
* ajuster les scripts de construction & de publication
* réglages sur votre hôte de dépôt, tels que la branche par défaut, les règles de fusion et tout ce qui a trait aux noms de la branche
* mettez à jours la documentation
* fermez ou fusionnez toutes les demandes destinées à l'ancienne branche
* **seulement ensuite** supprimez la branche master

git push origin --delete master

Pousser une branche de correction sur le serveur distant
--------------------------------------------------------

Si vous souhaitez partager vos modifications sur le serveur distant avec le reste du monde :

* git push origin votre_nom_de_branche

Tirer une branche
-----------------

* git pull : tentative brute de fusion entre la branche distante d'un serveur et votre branche locale.

Il est préférable, selon la documentation officielle (https://git-scm.com/book/fr/v2/Les-branches-avec-Git-Branches-de-suivi-%C3%A0-distance) de faire :

* git fetch
* git merge (si nécessaire)

Suppression d'une branche distante (non master ou main !)
---------------------------------------------------------

* git push origin --delete nom_de_la_branche_mineure

Rebase (Attention !)
====================

Je préfère vous renvoyer à la documention officielle qui est très bien faite, car il y a des dangers à faire un rebase.

https://git-scm.com/book/fr/v2/Les-branches-avec-Git-Rebaser-Rebasing

Annulation d'un mauvais ajout de fichier
========================================

Option 1 : annulation avec un simple retour en arrière

*git reset --soft HEAD^

Option 2 : annuler les 4 dernières versions

* git reset --hard HEAD-4

Renommer un commit
==================

* git commit --amend -m "nouveau message"

Revenir à une version antérieure d'un commit
============================================

* git log : vous indique un long numéro composé de lettres et de chiffres associé à votre commit. Copiez le.

---

Si vos commits non pas été _**publiés**_ :

* git reset --hard numéro du commit

Si vous avez des modifications en cours et que vous souhaitez les conserver :

* git stash
* git reset --hard numéro du commit
* git stash pop (applique les modifications sauvegardées)

---

Si vos commits ont été _**pubiés**_ :

Il est _possible_ de créer un patch correspondant aux modifications demandées, puis de revenir en arrière :

* git revert numero du commit

OU BIEN
  
* git revert HEAD-4 .HEAD (annule 4 enregistrements dans ce cas)

Puis sauvegardez votre travail en spécifiant un message correct

* git commit -m "pourquoi j'ai fait ces modifications"




