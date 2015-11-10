<link rel="stylesheet" href="/css/pages/developper.css">
<h1 class="big_title">Developper Guideline</h1>
<div class="page_content whiteg">
    <div class="nav_column">
        <ul>
            <li data-action="okaoka">OkaOka</li>
            <li class="sub" data-action="what">OkaOka games</li>
            <li data-action="app">Appli</li>
            <li class="sub" data-action="get_started">Monter le projet</li>
            <li class="sub" data-action="build">Compiler le projet</li>
            <li class="sub" data-action="create_game">Créer un jeu</li>
            <li class="sub_sub" data-action="libraries">Descripteur json</li>
            <li class="sub_sub" data-action="libraries">Visuel de l'app</li>
            <li class="sub_sub" data-action="libraries">Animation intro</li>
            <li class="sub_sub" data-action="libraries">Animation intro</li>
            <li class="sub_sub" data-action="libraries">Utiliser une librairie</li>
            <li class="sub" data-action="create_game">Okaoka components</li>
            <li class="sub_sub" data-action="libraries">les popups</li>
            <li class="sub_sub" data-action="libraries">afficher un chronos</li>
            <li class="sub_sub" data-action="libraries">sauvegarder un score</li>
            <li class="sub" data-action="create_game">Tester le projet facilement</li>
            <li data-action="api">API</li>
            <li class="sub" data-action="how">Comment c'est fait</li>
            <li class="sub" data-action="save_stats">Sauvegarde des stats</li>
            <li class="sub" data-action="save_scores">Sauvegarde des scores</li>
            <li class="sub" data-action="save_pictures">Sauvegarde des images</li>
            <li data-action="deploy">Borne</li>
            <li class="sub" data-action="game_access">Accèder aux jeux</li>
            <li class="sub" data-action="video_access">Accèder aux vidéos</li>
            <li class="sub" data-action="settings_access">Accèder aux options</li>
            <li class="sub" data-action="admin_access">Quitter l'application</li>
            <li class="sub" data-action="back_access">Retour à l'accueil</li>
        </ul>
    </div>
    <div class="content_reader">
        <h1>OkaOka games</h1>
        <p>Cette page va vous guider pour récupérer le projet, re-compiler l'application et modifier ou encore créer de nouveaux jeux facilement via les languages HTML JS et CSS.</p>
        <div class="separator"></div>
        <h2>Récupérer et monter le projet borne Okaoka</h2>
        <p>
            Le projet borne enfant okaoka embarque nodejs, node webkit et chromium de façon à porter facilement l'application en cross-plateforme et également de façon à utiliser un language commun utilisé par le plus grand nombre de développeur Web.<br/>
            De façon à simplifier l'installation du projet sur votre machine, un repository GULP est en place.<br/><br/>
            Pour commencer téléchargez les sources de l'application et rangez le répertoire à votre emplacement favoris sur votre machine.<br>
        </p>
        <div class="classic_button center red">Télécharger les sources</div><br/>
        <p>
            Nous vous recommandons pour une prise en main rapide du projet sans avoir besoin de configuration spécifique sur votre machine d'utiliser l'IDE Brackets en téléchargement ci-dessous<br/>
        </p>
        <div class="classic_button center">Télécharger Brackets</div><br/>
        <p>
            Pour tester le projet sur votre machine en local, ouvrez Brackets, puis ouvrez le dossier du projet.<br/>Ensuite ouvrez le fichier situé dans le dossier /src/index.html<br/>Pour terminer cliquez sur l'éclair situé en haut à droite de votre IDE brackets.<br/>
            Brackets va alors lancer votre Web Browser favoris et créer une instance locale du projet.<br/>
            Vous pouvez dès à présent naviguer dans la borne via votre Web Browser et débuguer comme un site web classique.
        </p>
        <div class="separator"></div>
        <h3>Pré-recquis pour compiler le projet</h3>
        <p>
            Pour pouvoir builder l'application vous devez installer les composants suivants sur votre machine :<br/>
            1. NPM<br/>
            2. GULP<br/>
            3. BOWER
        </p>
        <h3>Lancer une Build de l'application</h3>
        <p>
            Pour builder rendez-vous dans le dossier racine du projet via votre terminal<br/>
            <b>cd /Users/{votre nom d'utilisateur}/Sites/BorneOkaOka/</b><br/>
            Puis tapez simplement la ligne de commande suivante<br/>
            gulp build:{ os que vous souhaitez builder }<br/>
            La package vous permet de builder sous les plateformes suivantes :
        </p>
        <p>
            win32<br/>
            win64<br/>
            osx64<br/>
            linux32<br/>
            linux64
        </p>
        <p>pour builder sous osx entrez la commande : <b>$ gulp build:osx64</b></p>
        <div class="separator"></div>
        <h1>Créer un jeu</h1>
        <p>Pour créer un jeu rendez-vous dans le dossier /src/pages/ puis commencez par créer un dossier portant le nom de votre jeu<br>ATTENTION : chaque nom de jeu doit être unique, le fait de créer le dossier manuellement force votre machine à créer un nom propre à votre jeu n'existant pas au préalable dans le dossier.</p>
        <h2>Le Descripteur JSON de votre jeu</h2>
        <p>
            Chaque jeu comporte un descriptor.json avec un format bien spécifique.<br/>
            ce descripteur va s'occuper de charger toutes les dépendances recquises pour lancer votre jeux,
            nous allons voir en détail l'ensemble des fonctionnalités de ce fichier qui est le plus important pour constituer votre projet de jeu.<br/>
            Pour gagner du temps si vous le souhaitez vous pouvez télécharger un exemple de jeu ci-dessous, vous n'aurez plus qu'à renomer les fichiers de façon à adapter vos sources au nom de votre gameplay.
        </p>
        <div class="classic_button center red">Télécharger exemple de jeu</div>
        <h2>L'image de votre jeu</h2>
        <p>
            L'image ou picto de votre jeu doit-être au format .svg et se situer dans le dossier /images/game_preview.svg du dossier de votre jeu.<br/>
            Si vous le souhaitez, votre game-preview peut comporter un claque nommé 'shadow', la forme contenu dans ce calque prendra automatiquement la couleur de votre jeu avec une nuance supérieur.<br/>
            Il est conseillé de préserver le fichier téléchargé précédemment pour éviter les conflits avec la shadow.<br/>
            Si un problème avec Shadow apparaît, ouvrez le fichier .svg dans votre éditeur Brackets puis vérifiez qu'illustrator à bien préservé l'id Shadow, il peut arriver qu'illustrator renomme en shadow_01 selon votre version ou encore les divers manipulations effectuées dans le document.
        </p>
        <h2>L'animation d'intro</h2>
        <p>
            Chaque jeu comporte une animation d'intro, pour en réaliser une, utilisez Flash CC de préférence. Pour les versions antérieur à flash CC vous devez installer le plugin CreateJS disponible en téléchargement gratuit.<br/>
            Il est Important de préserver les fichiers fournis dans l'exemple en téléchargement, les étiquettes et autres actions et CallBacks intégrés à la timeline aide au bon fonctionnement de votre jeu.<br/> 
        </p>
        <h2>Utiliser des Librairies</h2>
        <p>
            Chaque jeu peux nécéssiter l'utilisation de librairies, cependant il est important de savoir que les librairies suivantes sont déjà présentes dans le projet global :.<br/> <br/>
            -TweenMax<br/>
            -Ease<br/>
            -Underscore<br/>
            -Backbone<br/>
            -CREATEJS<br/>
            -EASELJS<br/>
            -SOUNDJS<br/><br/>
            il est donc important pour éviter tout conflit de version de ne pas surcharger ces librairies.
        </p>
        <h1>Les Composants d'origine OkaOka</h1>
        <p>plusieurs composants sont présents dans le projet pour vous simplifier le developpement et harmoniser l'UI globale du projet. Merci de les utiliser.</p>
        <p>TODO DEFINIR LES COMPOSANTS</p>
        <h1>L'API OKAOKA</h1>
        <p>L'api Okaoka est une version restFull modifiée d'un codeigniter, il est cependant possible et facile de mettre à jour codeigniter au besoin.</p>
        <p>TODO definir les fonctionnalités de l'API et L'OAUTH okaoka</p>
        <a href="/user_guide/"><div class="classic_button center red">En savoir plus sur codeigniter</div></a>
        <h1>Utiliser l'interface vendeur de la borne</h1>
        <p>La borne okaoka permet de switcher entre vidéo et jeux ou encore de paramètrer certaines fonctionnalités. voici comment ça marche :</p>
        <h3>Accèder aux jeux (dessiner un G comme game)</h3>
        <img class="illus center" src="/images/pages/developper/unlock_game.gif" width="550"/>
        <h3>Accèder aux Vidéos (dessiner un V comme vidéo)</h3>
        <img class="illus center" src="/images/pages/developper/unlock_video.gif" width="550"/>
        <h3>Accèder aux Options (dessiner un S comme settings)</h3>
        <img class="illus center" src="/images/pages/developper/unlock_settings.gif" width="550"/>
        <h3>Retour au bureau (dessiner un A comme admin)</h3>
        <img class="illus center" src="/images/pages/developper/unlock_admin.gif" width="550"/>
        <h3>Retour à l'écran de vérouillage</h3>
        <img class="illus center" src="/images/pages/developper/screen_back.gif" width="550"/>
        <p></p>
    </div>
</div>
<script src="/js/pages/developper.js"></script>