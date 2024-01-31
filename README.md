<div align="center">
    <a href="https://iut-info.univ-reims.fr/gitlab/bayf0001/ms103"><img src="https://www.univ-reims.fr/media-images/4748/logo-urca-impression.jpg" alt="URCA logo" height="128" style="border-radius: 10%"></a>
    <h1>SAÉ 3.01 - Développement d’une application</h1>
    <h2>Zoo d'Agueran</h2>
    <strong><p>Réalisé par : Yoan LEMAIRE, Gwendal RODRIGUES, Nino SAUVAGEOT et Paul BAYFIELD</p></strong>
</div>

## Sommaire :

- Informations sur le projet [↓](#informations-sur-le-projet)
- Les installations [↓](#les-installations-)
  - Installation de symfony [↓](#installation-de-symfony-)
    - Sur un environnement Windows [↓](#sur-un-environnement-windows-)
    - Sur un environnement Linux [↓](#sur-un-environnement-linux-)
    - Mettre à jour la version de Symfony pour le projet [↓](#mettre-à-jour-la-version-de-symfony-pour-le-projet-)
  - Installation de Composer [↓](#installation-de-composer-)
    - Sur un environnement Windows [↓](#sur-un-environnement-windows--1)
    - Sur un environnement Linux [↓](#sur-un-environnement-linux--1)
    - Mettre à jour Composer [↓](#mettre-à-jour-composer-)
  - Installation complémentaire [↓](#installation-complémentaire-)
    - Installation de PHP CS Fixer [↓](#installation-de-php-cs-fixer-)
    - Installation du Greffon «Symfony Support» [↓](#installation-du-greffon-symfony-support-)
    - Installation des packages webpack-encore, ux-chartjs et stimulus-bundle [↓](#installation-des-packages-webpack-encore-ux-chartjs-et-stimulus-bundle-)
- Utilisations des scripts [↓](#utilisations-des-scripts-)
- Les login et mot de passe [↓](#les-login-et-mot-de-passe-)
- Element important du projet [↓](#element-important-du-projet)
  - La page de connexion [↓](#la-page-de-connexion-)
  - La page « Votre Profil » [↓](#la-page--votre-profil--)
  - Le pannel EasyAdmin [↓](#le-pannel-easyadmin-)
  - La page « Billetterie » [↓](#la-page--billetterie--)
  - La page « Reservation » [↓](#la-page--reservation--)


## Informations sur le projet :

La version utilisée de Composer pour ce projet est la **2.6.5**.  
La version utilisée de Symfony pour ce projet est la **6.3.8**.  
La version utilisée de PHP CS-Fixer pour ce projet est la **3 .38.2**.
La version de NodeJs doit être supérieur à la **14.0.0**.


Le site est héberger à l'adresse suivante : https://agueran.bayfield.dev/

## Les installations :

### Installation de symfony :

#### Sur un environnement Windows :

1. Ouvrir _Windows Powershell_, si ce dernier n'est pas installé sur votre machine, se référer à [ce lien](https://learn.microsoft.com/en-us/powershell/scripting/install/installing-powershell-on-windows?view=powershell-7.3).
2. Dans _Windows Powershell_, écrire
```shell
Set-ExecutionPolicy -ExecutionPolicy RemoteSigned -Scope CurrentUser 
irm get.scoop.sh | iex 
```
Le paquet scoop devrait s'installer.
3. Une fois le paquet **scoop** installé, aller dans votre terminal (terminal windows/phpstorm) et entrée la commande `scoop install symfony-cli`.


#### Sur un environnement Linux :

1. Si vous n'avez pas le paquet wget, installez-le avec la commande : `[sudo] apt-get install wget`.
2. Ouvrir votre terminal et entrée la commande : `wget https://get.symfony.com/cli/installer -O - | bash` ou la commande : `curl -sS https://get.symfony.com/cli/installer | bash`.
3. Ouvrir votre fichier `~/.bashrc` et modifiez-le afin qu'il contienne : `export PATH="$HOME/.symfony5/bin:$PATH"`.
4. Chargez les modifications avec la commande `source ~/.bashrc`.
5. Vérifiez le bon fonctionnement de l'exécutable "Symfony" : `symfony self:version`.
6. Contrôler la compatibilité du système avec la commande : `symfony check:requirements  --verbose`.

#### Mettre à jour la version de Symfony pour le projet :

1. Si le projet utilise une version dépréciée de Symfony, et que vous voulez le mettre à jour, il vous suffit d'aller dans le fichier composer.json.
2. Une fois dans ce fichier, à la fin de ce dernier devrait ce trouvé un block `extra` dans lequel se trouve les paramètres de version de Symfony.
3. Il vous suffit juste de modifier la version dans le require tel quel :
```json
"extra": {
      "symfony": {
          "allow-contrib": false, 
-          "require": "5.4.*"
+          "require": "6.0.*"
      }
  }
```
4. Une fois ceci fait, il vous suffira de faire la commande `composer update "symfony/*"` dans le terminal de votre éditeur.


### Installation de Composer :

#### Sur un environnement Windows :

1. Rendez-vous sur la [page de téléchargment de **Composer** pour Windows](https://getcomposer.org/doc/00-intro.md#installation-windows).
2. Téléchargez le fichier "Composer-setup.exe" et lancez-le.
3. Choisissez le mode d'installation multi-utilisateur (vous devez être administrateur de l'ordinateur).
4. Choisissez ensuite de conserver l'option de désinstallation de Composer.
5. Vérifiez le chemin de l'exécutable de **PHP** qui a été détecté.
6. Précisez le serveur mandataire à utiliser pour que Composer accède à internet.
7. Vérifiez vos choix et validez.
8. Pour vérifier que Composer soit bien installé, ouvrez votre terminal et entrez la commande suivante : `composer -v`

#### Sur un environnement Linux :

1. Ouvrez un terminal
2. Placez-vous dans le répertoire « **bin** » votre répertoire d'accueil : `cd ~/bin`. Ci ce dernier n'existe pas, faite la commande : `mkdir ~/bin`.
3. Entrez les commandes suivantes afin d'installer Composer :
    ```shell
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
    php -r "if (hash_file('sha384', 'composer-setup.php') === 'e21205b207c3ff031906575712edab6f13eb0b361f2085f1f1237b7126d785e826a450292b6cfd1d64d92e6563bbde02') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
    php composer-setup.php
    php -r "unlink('composer-setup.php');"
    ```
Vous devriez maintenant trouver le fichier « **composer.phar** » dans votre répertoire courant.
4. Afin d'utiliser la version à jour de Composer fraîchement téléchargée plutôt que celle installée sur votre poste de travail qui n'est plus à jour, vous allez renommer le fichier « composer.phar » en « composer ».
5. Si vous ne l'avez pas déjà fait, ajoutez le répertoire « ~/bin » à la variable « PATH » en modifiant le fichier « ~/.bashrc » pour y insérer la ligne suivante : ``` export PATH="$HOME/bin:$PATH" ```.
6. Si vous avez modifié le script shell « ~/.bashrc », rechargez-le dans votre environnement en passant la commande : `source ~/.bashrc`.
7. Pour vérifier que Composer soit bien installé, ouvrez votre terminal et entrez la commande suivante : `composer -v

#### Mettre à jour Composer :

1. Pour mettre à jour Composer, utilisez la commande :`composer self-update`.

### Installation complémentaire :

#### Installation de PHP CS Fixer :

1. Si ce n'est pas déjà fait, installez Composer à l'aide du tutoriel ci-dessus dédié.
2. Lancez l'installation de PHP CS Fixer en utilisant la commande require combinée à l'option --dev de composer : `composer require friendsofphp/php-cs-fixer --dev`.
3. Rendez-vous dans les préférences de PhpStorm dans « Languages & Frameworks → PHP → Quality Tools ».
4. Lancez la configuration de PHP CS Fixer.
5. Recherchez l'exécutable **php-cs-fixer** dans **vendor/bin** dans votre projet. Si vous êtes sur Windows, le fichier que vous devrez sélectionner sera **php-cs-fixer.bat**.
6. Vérifiez le bon fonctionnement de php-cs-fixer en appuyant sur le bouton « Validate ».
7. Si tout est correct, vous devez observer le message « OK, PHP CS FIXER 3.38.* Yellow Bird by Fabien Potencier and Dariusz Ruminski » en bas de la fenêtre.
8. Maintenant, il faut activer PHP CS Fixer. Pour ça, rendez-vous dans les paramètres de PhpStorm dans «Editor → Inspections → Quality tools → PHP CS Fixer validation » et cochez la case.
9. Retournez dans les paramètres de quality tools et choisissez le jeu de règle qui correspond au style de codage désiré, ici nous choisirons **Custom** et nous mettrons comme fichier **.php-cs-fixer.dist.php**.

#### Installation du Greffon «Symfony Support» :

1. Pour installer le greffon, rendez-vous dans les préférences de PhpStorm dans «Plugins».
2. Cherchez le greffon « **Symfony Support** ».
3. Activez le greffon « **Symfony Support** » si ce n'était pas déjà fait et que cela vous est proposé

#### Installation des packages webpack-encore, ux-chartjs et stimulus-bundle :

Prérequis :
- Posséder NodeJs est le seul prérequis. Si vous ne possédez pas NodeJs, aller installer sa dernière version [ici](https://nodejs.org/en/download/).

1. Pour ce projet, il suffit de faire un ```composer install``` afin d'installer les 3 packages utiles pour les graphiques des dashboards.
2. Il faudra ensuite faire la commande ```npm install``` puis ```npm run show```. Une fois ces 2 commandes faites, le projet devrait être fonctionnel.

## Les scripts :

### Utilisations des scripts :

- Le script « **start:linux** » permet de lancer le serveur, sans arrêt définit, en local symfony sous un environnement Linux.
- Le script « **test:cs** » permet de lister tous les changements à faire, sans les faire.
- Le script « **fix:cs** » permet de faire les changements donnés par la commande « **test:cs** ».
- Le script « **start:windows** » permet de lancer le serveur, sans arrêt définit, en local symfony sous un environnement Windows.
- Le script « **start** » fait un appel au script « **start:linux** » et permet ainsi de lancer le server en local sous un environnement Linux.
- Le script « **db** » permet de générer la base de données grâce aux fixtures.
- Le script « **test:codeception** » permet de nettoyer le répertoire (_output) puis de lancer les tests de Codeception.
- Le script « **test** » fait un appel au script « **test:cs** » puis un appel au script « **test:codeception** ».

## Les login et mot de passe :

### Login et mot de passe pour un utilisateur sans droit :

`Login : user@example.com`

`Mot de passe : azerty01`

### Login et mot de passe pour un utilisateur avec droit :

`Login : root@example.com`

`Mot de passe : azerty01`

## Element important du projet

### La page de connexion :

Le site demandera automatiquement d'être connecté pour pouvoir acheter un billet ou réserver une activité. 
Si vous n'êtes pas connecté alors le site vous redirigera vers cette page :

![pageDeConnexion1](/public/screenshot/pageDeConnexion1.png)

Si vous scrollez vers le bas ou cliquez sur le bouton vert vous arriverez ici :

![pageDeConnexion1](/public/screenshot/pageDeConnexion2.png)

Dans le cas où seul la connexion vous intéresse, utilisez les logins et mot de passe fournis plus haut.

Dans le cas où vous souhaitez créé votre propre compte, cliquez sur le bouton « Créer un compte ».

Cette action vous redirigera automatiquement sur une nouvelle page, la page de création du compte :

![pageDeCreation1](/public/screenshot/pageDeCreation1.png)

Si vous scrollez vers le bas ou cliquez sur le bouton vert vous arriverez ici :

![pageDeCreation2](/public/screenshot/pageDeCreation2.png)

Vous pourrez donc entrer les informations que vous souhaitez puis créé votre compte en appuyant sur le bouton vert.

### La page « Votre Profil » :

La page « Votre Profil » n'apparaît que si vous êtes connecté lorsque vous cliquez sur le lien 
dans le footer « Mon compte ».

Vous arriverez donc sur cette page :

![pageVotreProfil1](/public/screenshot/pageVotreProfil1.png)

Si vous scrollez vers le bas ou cliquez sur le bouton vert vous arriverez ici :

![pageVotreProfil2](/public/screenshot/pageVotreProfil2.png)

Vous pourrez donc consulter vos informations, supprimer votre compte ou le modifier ! 
Si vous appuyez sur « Supprimer votre Compte », votre compte sera supprimé complètement.

Si vous cliquez sur « Modifier votre Profil » vous arriverez sur cet page :

![pageModificationDeVotreProfil1](/public/screenshot/pageModificationDeVotreProfil1.png)

Si vous scrollez vers le bas ou cliquez sur le bouton vert vous arriverez ici :

![pageModificationDeVotreProfil2](/public/screenshot/pageModificationDeVotreProfil2.png)

Vous aurez accès à un formulaire qui vous permettra de modifier vos informations. 
**Attention**, pour valider ces changements, vous devrez à nouveau entrer votre mot de passe.

### Le pannel EasyAdmin :

EasyAdmin est un « bundle » Symfony spécialement conçu pour construire
la partie administration d'une application Symfony. Comme ce « bundle » Symfony est réservé aux administrateurs
vous devrez impérativement avoir un rôle administrateur pour y accéder. Pour ce faire utiliser le login et le mot de passe de l'utilisateur ayant des droits.
Si vous tentez de vous connecter sans en avoir les droits vous serez automatiquement redirigé sur cette page :

![pageAccesNonAutorise1](/public/screenshot/pageAccesNonAutorise1.png)

Si vous scrollez vers le bas ou cliquez sur le bouton vert vous arriverez ici :

![pageAccesNonAutorise2](/public/screenshot/pageAccesNonAutorise2.png)

De plus, cette page n'est pas référencée. Il faudra entrer manuellement dans la barre d'URL le chemin `/admin`.

Une fois toutes ces conditions réunies, vous serez amener vers cette page :

![pannelEasyAdmin](/public/screenshot/pannelEasyAdmin.png)

### La page « Le programme du parc » :

Depuis la page d'accueil dans la barre de navigation il est possible de cliquer sur « Programme » pour se rendre sur cette page :

![pageLeProgrammeDuParc1](/public/screenshot/pageLeProgrammeDuParc1.png)

Si vous scrollez vers le bas ou cliquez sur le bouton vert vous arriverez ici :

![pageLeProgrammeDuParc2](/public/screenshot/pageLeProgrammeDuParc2.png)

Vous aurez ici accès à la liste complète des activités proposées par le zoo.
Si votre curiosité vous emporte vous pourrez cliquer sur les boutons « Plus d'informations » 
ce qui vous redirigera sur une page similaire à celle-ci :

![pageInformationProgramme1](/public/screenshot/pageInformationProgramme1.png)

Pour l'exemple ici j'ai cliqué sur le bouton « Plus d'informations » de l'activité « le vol des rapaces », cependant, chaque bouton vous redirigera
sur l'activité le concernant et non pas forcément sur cette page !

Si vous scrollez vers le bas ou cliquez sur le bouton vert vous arriverez ici :

![pageInformationProgramme2](/public/screenshot/pageInformationProgramme2.png)

Vous avez donc accès aux différentes informations concernant l'activité comme sa localisation dans le parc, les horaires ou encore les places restantes, ce compteur se décrémente
si vous prenez des places mais **attentions**, si vos faites un `composer db` il est possible que les valeurs aléatoires provoquent un problème au niveau des places restantes.

Comme vous pouvez le voir, il y a en bas a droite de cette capture d'écran un bouton Réserver. Si vous cliquez dessus vous serez redirigé sur cette page :

![pageReservationDuProgramme1](/public/screenshot/pageReservationDuProgramme1.png)

Si vous scrollez vers le bas ou cliquez sur le bouton vert vous arriverez ici :

![pageReservationDuProgramme2](/public/screenshot/pageReservationDuProgramme2.png)

Ici vous pourrez donc réserver le nombre de places que vous souhaitez mais **attention**
le nombre de places réserver ne doit pas excéder le nombre de places restantes, sinon vous ne pourrez pas réserver.

Une fois que vous avez choisi le nombre de places que vous vouliez, le site vous redirigera
sur la page des réservations et vous pourrez constater l'ajout de vos billets dans la case « Événement ».

### La page « Les animaux du parc » :

Depuis la page d'accueil dans la barre de navigation il est possible de cliquer sur « Animaux » pour se rendre sur cette page :

![pageLesAnimauxDuParc1](/public/screenshot/pageLesAnimauxDuParc1.png)

Si vous scrollez vers le bas ou cliquez sur le bouton vert vous arriverez ici :

![pageLeProgrammeDuParc2](/public/screenshot/pageLesAnimauxDuParc2.png)

Vous aurez ici accès à la liste complète des animaux du zoo.
Si votre curiosité vous emporte vous pourrez cliquez sur les boutons
« Plus d'information » ce qui vous redirigera sur cette page :

![pageInformationAnimal1](/public/screenshot/pageInformationAnimal1.png)

Si vous scrollez vers le bas ou cliquez sur le bouton vert vous arriverez ici :

![pageInformationAnimal2](/public/screenshot/pageInformationAnimal2.png)

Vous pourrez ainsi voir les activités dans lesquels l'animal participe.

### La page « Administration » :

Pour accéder à cette page vous devrez être administrateur du site et être connecté. 
Dans le cas contraire vous serez redirigé vers la page « accès refusé » ou vers la page de connexion.

Si vous respectez les conditions, vous arriverez sur cette page :

![pageAdministration1](/public/screenshot/pageAdministration1.png)

Si vous scrollez vers le bas ou cliquez sur le bouton vert vous arriverez ici :

![pageAdministration2](/public/screenshot/pageAdministration2.png)

Le panel d'administration va permettre beaucoup de choses à l'administrateur.

Si l'administrateur clique sur « Voie les clients », il sera redirigé sur cette page :

![pageListeDesClients](/public/screenshot/pageListeDesClients.png)

Il pourra entrer dans les différentes cases de quoi filtrer les données !
Ainsi, il pourra récupérer les clients qu'il souhaite.

Maintenant, si l'administrateur clique sur « Voir les animaux », il sera redirigé sur cette page :

![pageListeDesAnimaux](/public/screenshot/pageListeDesAnimaux.png)

Ici aussi, l'administrateur pourra entrer dans les différentes cases de quoi filtrer les données.
Ainsi, il pourra récupérer les animaux qu'il souhaite.

Maintenant, si l'administrateur clique sur « Voir les animaux », il sera redirigé sur cette page :

![pageListeDesBillets](/public/screenshot/pageListeDesBillets.png)

Ici aussi, l'administrateur pourra entrer dans les différentes cases de quoi filtrer les données.
Ainsi, il pourra récupérer les billets qu'il souhaite et voir la date d'achat du ou des billet(s).

![pageListeDesEnclos](/public/screenshot/pageListeDesEnclos.png)

Enfin, si l'administrateur clique sur « Voir les évènements », il sera redirigé sur cette page :

![pageListeDesEvenements1](/public/screenshot/pageListeDesEvenements1.png)

Ici aussi, l'administrateur pourra entrer dans les différentes cases de quoi filtrer les données.
Ainsi, il pourra récupérer les évènements proposés par le parc à la date qu'il souhaite. 
Il aura également accès aux réservations effectuées sur ces évènements.

Si l'administrateur clique sur le bouton vert à côté de l'évènement, il sera redirigé sur cette page :

![pageListeDesEvenements2](/public/screenshot/pageListeDesEvenements2.png)

L'administrateur aura donc accès à la liste des personnes ayant réservé pour les évènements correspondants.

### La page « Billetterie » :

Depuis la page d'accueil dans la barre de navigation il est possible de cliquer sur « Billetterie » pour se rendre sur cette page :

![pageBilletterie1](/public/screenshot/pageBilletterie1.png)

Si vous scrollez vers le bas ou cliquez sur le bouton vert vous arriverez ici :

![pageBilletterie2](/public/screenshot/pageBilletterie2.png)

Vous aurez ici accès à la billetterie, vous pourrez choisir le nombre de places que vous souhaitez, le récapitulatif
vous permet de voir le nombre de places prises ainsi que le cout d'achat.

Vous pourrez également choisir la date de la visite. Une fois cela fait, vous pourrez appuyer sur le bouton « Réserver ». une fois cela fait, vous serez redirigé sur cette page :

![pageAchatBillet(s)1](/public/screenshot/pageAchatBillet(s)1.png)

Si vous scrollez vers le bas ou cliquez sur le bouton vert vous arriverez ici :

![pageAchatBillet(s)2](/public/screenshot/pageAchatBillet(s)2.png)

Vous pourrez donc consulter votre achat !

### La page « Reservation » :

Depuis la page d'accueil dans la barre de navigation il est possible de cliquer sur « Réservations » pour se rendre sur cette page :

![pageMesReservations1](/public/screenshot/pageMesReservations1.png)

Si vous scrollez vers le bas ou cliquez sur le bouton vert vous arriverez ici :

![pageMesReservations2](/public/screenshot/pageMesReservations2.png)

Vous aurez ici accès à vos réservations ! Vous pourrez consulter vos billets mais 
aussi les évènements auxquels vous participez.


