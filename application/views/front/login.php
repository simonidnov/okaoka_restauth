<br/>
<h1 class="big_title">Connexion OkaOka</h1>

<div class="formulaire" id="login_form" style="display:none;">
    <div class="line">
        <div class="tabs" id="switch_account_tab" data-type="radio">
            <div class="tab thirty checked" data-list="switch_account_tab">Connexion</div>
            <div class="tab thirty" data-list="switch_account_tab">créer compte</div>
            <div class="tab thirty" data-list="switch_account_tab">Pssw perdu</div>
        </div>
    </div>
    <div id="login_in">
        <div class="line">
            <label class="edit" for="email_login"><span class="">Email</span></label>
            <input type="text" id="email_login" class=""/>
            <label class="edit" for="password_login"><span class="">Mot de passe</span></label>
            <input type="password" id="password_login" class=""/>
        </div>
        <div class="line_separator compact"></div>
        <div class="line">
            <div class="switch small left checked" id="stay_check">
                <div class="dot"></div>
            </div>
            <h4 data-for="stay_check">Rester connecté</h4>
        </div>
        <div class="line_separator compact"></div>
        <div class="line">
            <div class="formular_button center" id="validate_login_form">Me connecter</div>
        </div>
    </div>
    <div id="request_account" style="display:none;">
        <div class="line">
            <label class="edit" for="email_request_account"><span class="">Email</span></label>
            <input type="text" id="email_request_account" class=""/>
            <label class="edit" for="password_request_account"><span class="">Mot de passe</span></label>
            <input type="password" id="password_request_account" class=""/>
            <p class="small_title">Définissez ci-dessous les raisons pour lesquelles vous devez obtenir un accès aux statistiques des bornes idKids Okaïdi</p>
            <label class="edit" for="why_request_account"><span class="">Pourquoi vous ?</span></label>
            <textarea type="text" id="why_request_account" class=""></textarea>
        </div>
        <div class="line_separator compact"></div>
        <div class="line">
            <div class="switch small left checked" id="cgu_check">
                <div class="dot"></div>
            </div>
            <h4 data-for="cgu_check">Accepter toutes les conditions idKids</h4>
        </div>
        <div class="line_separator compact"></div>
        <div class="line">
            <div class="formular_button center" id="validate_request_account_form">Créer mon compte</div>
        </div>
    </div>
    <div id="request_password" style="display:none;">
        <div class="line">
            <p class="small_title">Entrez votre email pour recevoir un nouveau mot de passe.</p>
            <label class="edit" for="email_request_password"><span class="">Email</span></label>
            <input type="text" id="email_request_password" class=""/>
        </div>
        <div class="line">
            <div class="formular_button center" id="validate_request_password_form">Recevoir mon mot de passe</div>
        </div>
    </div>
</div>
<script src="/js/pages/login.js"></script>