var gallery_page = {
    _drawings : null,
    init : function(){
        var _user = JSON.parse(localStorage.getItem('user_infos'));
        ajax_request.get('picture', {user_id:_user.id}, function(e){
            gallery_page._drawings = e.datas;
            gallery_page.display_list();
        });
    },
    display_list : function(){
        $.each(this._drawings, function(index, draw){
            var temp = _.template($('#picture_template').html());
            $('#gallery_content').append(temp(draw));
        });
        
        $('.drawing').on('click', function(){
            console.log($(this).outerWidth());
            if($(this).width() <= 150){
                $('.drawing').css({'width':'130px', 'height':'130px'});
                $(this).css({'width':'100%', 'height':'550px'});
            }else{
                $(this).css({'width':'130px', 'height':'130px'});
            }
        });
    },
    get_real_uri : function(url){
        var url_array = url.split('');
        return 'uploads/'+url_array[0]+'/'+url_array[1]+'/'+url_array[2]+'/'+url_array[3]+'/'+url+'.png';
    }
}
$(document).ready(function(){
    gallery_page.init();
});