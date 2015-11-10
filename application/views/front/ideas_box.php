<br/>
<link rel="stylesheet" href="/css/pages/ideas_box.css">
<div class="page_content">
    <h1 class="big_title">Ideas Box la boîte à idée</h1>
    <div class="line_list" id="ideas_list">
        
    </div>
</div>
<script src="/js/pages/ideas_box.js"></script>
<script type="text/template" id="idea_template">
    <div class="item" id="idea_<%= id %>" data-item="<%= id %>">
        <div class="label"><%= title %></div>
        <div class="description"><%= message.substr(0,120) %></div>
        <div class="right_pos">
            <div class="classic_button lighblue" id="reading" data-item="<%= id %>">Lire</div>
            <% if(parseInt(status) === 0){ %>
                <div class="classic_button grey" id="read" data-item="<%= id %>">LU</div>
            <% } %>
            <% if(parseInt(status) < 2){ %>
                <div class="classic_button green" id="public" data-item="<%= id %>">Publier</div>
            <% }else{ %>
                <div class="classic_button green" id="unpublic" data-item="<%= id %>">Ne plus publier</div>
            <% } %>    
            <div class="classic_button red" id="delete" data-item="<%= id %>">Supprimer</div>
        </div>
    </div>
</script>