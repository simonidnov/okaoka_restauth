<footer>
    <div class="page_content" style="height:100%; display:none;" id="logged_footer">
        <div class="column">
            <div class="label">Application</div>
            <ul>
                <a href="/download"><li>Télécharger la dernière version</li></a>
                <a href="/users"><li>Gérer les utilisateurs</li></a>
                <a href="/developper"><li>Accès développeur</li></a>
            </ul>
        </div>
        <div class="column">
            <div class="label">Statistiques</div>
            <ul>
                <a href="/dashboard"><li>Dashboard Statistiques</li></a>
                <a href="/gallery"><li>Gallery des dessins</li></a>
                <a href="/ideas_box"><li>Ouvrir la boîte à idées</li></a>
            </ul>
        </div>
        <div class="column">
            <div class="label">Mon compte</div>
            <ul>
                <a href="/account"><li>Éditer mon compte</li></a>
                <a href="/logout"><li>Me déconnecter</li></a>
            </ul>
        </div>
    </div>
    <div class="page_content" style="height:100%; display:block;" id="default_footer">
        <div class="column">
            <div class="label">Le concept</div>
            <ul>
                <a href="/concept"><li>Pourquoi une borne enfant ?</li></a>
                <a href="/concept"><li>Commment ça marche ?</li></a>
            </ul>
        </div>
        <div class="column">
            <div class="label">Application</div>
            <ul>
                <a href="/how_to_use"><li>Comment l'utiliser ?</li></a>
                <a href="/play"><li>Jouer avec chrome</li></a>
            </ul>
        </div>
        <div class="column">
            <div class="label">Mon compte</div>
            <ul>
                <a href="/login"><li>Me connecter</li></a>
                <a href="/login"><li>Créer un compte administrateur</li></a>
            </ul>
        </div>
    </div>
</footer>
<script src="/js/ajax_request.js"></script>
<script src="/js/okaoka_navigation.js"></script>
<script src="/js/formular/formular.js"></script>
<script src="/js/assets/popup.js"></script>
<script src="/js/lib/TweenMax.min.js"></script>
<script src="/js/lib/underscore/underscore-min.js"></script>
<script>
    $(document).ready(function(){
        console.log('init second way');
        okaoka_navigation.init();
    });
</script>
</body>    
</html>