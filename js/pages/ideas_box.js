var ideas_box = {
    _ideas : null,
    init:function(){
        var _user = JSON.parse(localStorage.getItem('user_infos'));
        ajax_request.get('ideas', {'user_id':_user.id}, function(e){
            ideas_box._ideas = e.datas;
            ideas_box.display_list();
        });
    },
    display_list : function(){
        var _user = JSON.parse(localStorage.getItem('user_infos'));
        //add templates idea_template on ideas_list
        $.each(this._ideas, function(index, idea){
            var temp = _.template($('#idea_template').html());
            $('#ideas_list').append(temp(idea));
            $('#idea_'+idea.id+' #reading').on('click', function(){
                var idea = _.where(ideas_box._ideas, {"id": $(this).attr('data-item')})[0];
                var pop = new okaoka_pop(idea.title, idea.message, ["OK", "Supprimer"], function(e){
                    if(parseInt(e) === 1){
                        ideas_box.delete(idea.id);
                    }           
                    delete pop;
                });
            });
            $('#idea_'+idea.id+' #read').on('click', function(){
                ajax_request.put('ideas', {
                    'user_id':_user.id, 
                    'id':$(this).attr('data-item'), 
                    'status':1
                }, function(e){
                });
                $(this).remove();
            });
            $('#idea_'+idea.id+' #public').on('click', function(){
                ajax_request.put('ideas', {
                    'user_id':_user.id, 
                    'id':$(this).attr('data-item'), 
                    'status':2
                }, function(e){
                });
                $(this).remove();
            });
            $('#idea_'+idea.id+' #unpublic').on('click', function(){
                ajax_request.put('ideas', {
                    'user_id':_user.id, 
                    'id':$(this).attr('data-item'), 
                    'status':1
                }, function(e){
                });
                $(this).remove();
            });
            $('#idea_'+idea.id+' #delete').on('click', function(){
                ideas_box.delete(idea.id);   
            });
        });
    },
    delete : function(id){
        console.log('remove');
        var _user = JSON.parse(localStorage.getItem('user_infos'));
        ajax_request.delete('ideas', {
            'user_id':_user.id, 
            'id':id
        }, function(e){
        });
        $('[data-item="'+id+'"]').remove();
    }
}
$(document).ready(function(){
    ideas_box.init();
});