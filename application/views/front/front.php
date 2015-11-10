<link rel="stylesheet" href="/css/pages/front_view.css">
<div class="page_content">
    <div class="okaoka_screen" id="screen">
        <div class="fake_camera">
            <div class="fake_camera_dot green"></div>
        </div>
        <video class="screen" autoplay controls>
            <source src="/videos/demo_okaoka.mp4" type="video/mp4">
        </video>
    </div>
    <div class="center" id="logged_menu" style="display:none;">
        <a href="/dashboard">
            <div class="classic_button orange">Dashboard</div>
        </a>
        <a href="/download">
            <div class="classic_button green" style="margin-left:10px;">Télécharger l'Application</div>
        </a>
        <a href="/play">
            <div class="classic_button lighblue" style="margin-left:10px;">Bac à sable</div>
        </a>
    </div>
    <div class="center" id="default_menu">
        <a href="/how_to_use">
            <div class="classic_button pink">Comment utiliser l'interface ?</div>
        </a>
        <a href="/play">
            <div class="classic_button lighblue" style="margin-left:10px;">jouer en ligne avec Chrome</div>
        </a>
    </div>
</div>
<br/>
<br/>
<div class="large_line sblue">
    <div class="top_shadow"></div>
    <div class="page_content">
        <br/><h1 class="big_title">Du ludique pour le Concept Store Okaïdi</h1>
        <p class="description">
            La borne enfant Okaïdi ou OkaOka est un concept ludique destiné à créer<br/>
            une valeur ajoutée au concept store Okäidi.
            <br/><br/>
            Elle se veut simple d’utilisation et accèssible au plus grand nombre.
            <br/>
            <br/>
            Cette page est destinée aux administrateurs réseau IdKids et aux <br/>
            intervenants du projet ludo éducatif IdKids Okaïdi.
        </p>
        <br/>
    </div>
    <div class="bottom_shadow"></div>
</div>
<br/>
<div class="page_content">
    <div class="thirty_col">
        <div class="icon">
            <img src="/images/assets/icon_play.png"/>
        </div>
        <h3>OkaOka Play</h3>
        <p class="description">
            Le player vidéo intégré à la solution<br/>
            permet de diffuser du contenu<br/>
            passif pendant les périodes de forte<br/>
            activité en boutique.
        </p>
    </div>
    <div class="thirty_col">
        <div class="icon">
            <img src="/images/assets/icon_game.png"/>
        </div>
        <h3>OkaOka Game</h3>
        <p class="description">
            Un accès à des jeux ludo éducatifs<br/>
            faciles à utiliser, accéssibles aux enfants<br/>
            de 4 ans et plus produits en accord <br/>
            avec la marque et ses valeurs.
        </p>
    </div>
    <div class="thirty_col">
        <div class="icon">
            <img src="/images/assets/icon_api.png"/>
        </div>
        <h3>OkaOka Services</h3>
        <p class="description">
            Une API conçue pour analyser<br/>
            les effets de la borne en magasin<br/>
            et permettre aux développeurs<br/>
            de participer au projet global.
        </p>
    </div>
</div>
<br/>
<br/>
<div class="large_line sblue">
    <div class="top_shadow"></div>
    <div class="page_content center">
        <img src="/images/assets/icon_stat.png" class="center_icon"/>
        <br/><h1 class="big_title">Obtenir un accès administrateur</h1>
        <p class="description">
            Chaque jour les bornes connectées remontent des données sur l’utilisation des jeux en magasin.<br/>
            <br/>
            Vous souhaitez accèder à ces données, télécharger l’application ou participer au projet ?<br/>
            Inscrivez-vous pour être placé sur la liste de validation des comptes admin. <br/>
            Cet accès est strictement réservé aux personnel IdKids <br/>
            ayant une relation avec les infrastructures réseau et\ou au personnel de la <br/>
            marque Okaïdi dans le cadre d’études sur la marque.<br/>
        </p>
        <a href="/login">
            <div class="classic_button center pink">Obtenir mon compte admin</div>
        </a>
        <br/>
    </div>
    <div class="bottom_shadow"></div>
</div>
<br/>
<br/>
<br/>
<div class="page_content">
    <h1 class="big_title">La boîte à idée !</h1>
    <p class="description" id="ideas_infos">
        Vous êtes intérréssés par le projet ?<br/>
        Vous voulez en savoir plus ?<br/>
        Le projet ludo éducatif est ouvert au plus grand nombre, que vous soyez vendeur, <br/>
        intervenant sur la marque, développeur (...) vos idées nous interressent.<br/>
        <br/>
        Vous pouvez vous exprimer via ce formulaire et par la même occasion être tenu au<br/>
        courant des avancées du projet par newsletter si vous le souhaitez.<br/>
    </p>
    <div class="formulaire" id="ideas_form">
        <div class="line">
            <div class="small_title">Votre demande concerne :</div>
            <select id="ideas_type">
                <option value="0">Sélectionnez parmis les choix suivants</option>
                <option value="1">Je souhaite proposer une idée</option>
                <option value="2">Je souahite recevoir les actus</option>
                <option value="3">Je souhaite participer au développement</option>
                <option value="4">J'ai une autre question</option>
                <option value="5">Je ne reçois pas mes identifiants admin</option>
                <option value="5">Autre</option>
            </select>
            <label for="ideas_email"><span>Email</span></label>
            <input type="text" id="ideas_email"/>
            <label for="ideas_subject"><span>Sujet</span></label>
            <input type="text" id="ideas_subject"/>
            <label for="ideas_message"><span>Donnez votre avis, vos envies ou laissez simplement un message ici.</span></label>
            <textarea id="ideas_message"></textarea>
        </div>
        <div class="line_separator compact"></div>
        <div class="line">
            <div class="switch small right" id="news_check">
                <div class="dot"></div>
            </div>
            <h4 data-for="news_check">Recevoir les actus du projet</h4>
        </div>
        <div class="line_separator compact"></div>
        <div class="classic_button center sblue" id="submit_ideas">Soumettre ma demande</div>
        <br/>
    </div>
</div>
    
<div class="okaoka_hand" id="hand"></div>
   
<script src="/js/pages/front.js"></script>