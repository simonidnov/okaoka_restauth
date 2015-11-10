var front_page = {
    init:function(){
        $('#screen').on('mousemove', function(e){
            $('#hand').css({'top':'200px', 'left':'200px'});
        });
    }
}
$(document).ready(function(){
    front_page.init();
});