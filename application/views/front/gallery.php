<br/>
<link rel="stylesheet" href="/css/pages/gallery.css">
<div class="page_content">
    <h1 class="big_title">Gallerie de dessins</h1>
    <div id="gallery_content"></div>
</div>
<script src="/js/pages/gallery.js"></script>
<script type="text/template" id="picture_template">
    <div class="drawing" style="background-image:url(<%= gallery_page.get_real_uri(url) %>);">
    </div>
</script>