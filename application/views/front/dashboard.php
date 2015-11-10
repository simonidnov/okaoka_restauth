<br/>
<link rel="stylesheet" href="/js/lib/c3/c3.min.css">
<link rel="stylesheet" href="/css/pages/dashboard.css">
<!--<link rel="stylesheet" href="/js/lib/leaflet/leaflet.css">-->
<div class="dashboard">
    <h1 class="big_title">Statistiques des bornes OkaOka</h1>
    <div class="stat_timeline">
        <div class="title">Temps moyen par page / ms</div>
        <div id="time_stats"></div>
    </div>
    <div class="stat_line">
        <div class="stat_block">
            <div class="title">Visites/page</div>
            <div id="page_stat_graph">
                
            </div>
        </div>
        <div class="stat_block">
            <div class="title">Détail/sélection</div>
            <div class="detail_label" id="page_name"></div>
            <div class="detail_label" id="nb_visits"></div>
            <div class="detail_label" id="timelap"></div>
            <div class="detail_label" id="total_time"></div>
        </div>
        <div class="stat_block">
            <div class="title">Bornes/connectées</div>
            <div class="big_number" id="total_bornes">
                
            </div>
        </div>
    </div>
    <div class="stat_timeline">
    </div>
</div>
<script src="/js/pages/dashboard.js"></script>
<script src="/js/lib/c3/c3.min.js"></script>
<script src="/js/lib/d3/d3.min.js"></script>
<!--<script src="/js/lib/leaflet/leaflet.js"></script>-->