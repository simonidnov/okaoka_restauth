var front_page = {
    _ideas_form : null,
    init:function(){
        if(this.is_logged()){
            $('#logged_menu').css('display', 'table');
            $('#default_menu').css('display', 'none');
        }
        $('#screen').on('mousemove', function(e){
            TweenMax.killAll();
            var rotate_hand = (e.screenX - window.innerWidth/2)/50;
            TweenMax.set($('#hand'), {rotation:rotate_hand});
            $('#hand').css({'top':(e.screenY+($(window).scrollTop()))+'px', 'left':(e.screenX-50)+'px', 'display':'block', 'margin':"inherit"});
        }).on('mouseleave', function(e){
            TweenMax.to($('#hand'), .5, {css:{'top':'500%', 'left':(e.screenX-50)+'px'}, onComplete:function(){
                $('#hand').css('display', 'none');
            }, ease:Power4.easeIn});
        });
        
        this._ideas_form = new formular('ideas_form', function(e){
            console.log(e);
        });
        $('#submit_ideas').on('click', function(){
            front_page.send_ideas();
        });
        $('#ideas_type').on('change', function(){
            if($('#ideas_type').val() === '0'){
                $('#ideas_type').addClass('error');
            }else{
                if($('#ideas_type').hasClass('error')){
                    $('#ideas_type').removeClass('error');
                    $('#ideas_type').addClass('valid');
                    setTimeout(function(){
                        $('#ideas_type').removeClass('valid');
                    },2500);
                }
            }
            
        });
    },
    send_ideas : function(){
        if($('#ideas_type').val() === "0"){
            var pop = new okaoka_pop("Ideas", "Merci de choisir le type de votre demande parmis les choix.", ["OK"], function(e){
                console.log(e)
                delete pop;
            });
            $('#ideas_type').addClass('error');
            return false;
        }
        if($('#ideas_email').val() === ""){
            var pop = new okaoka_pop("Ideas", "Merci d'indiquer votre email", ["OK"], function(e){
                console.log(e)
                delete pop;
            });
            $('#ideas_email').addClass('error');
            return false;
        }
        if($('#ideas_title').val() === ""){
            var pop = new okaoka_pop("Ideas", "Merci d'indiquer un titre à votre demande", ["OK"], function(e){
                console.log(e)
                delete pop;
            });
            $('#ideas_title').addClass('error');
            return false;
        }
        if($('#ideas_message').val() === ""){
            var pop = new okaoka_pop("Ideas", "Veuillez écrire un court message pour que nous puissions vous répondre au besoin.", ["OK"], function(e){
                delete pop;
            });
            $('#ideas_message').addClass('error');
            return false;
        }
        var type = $('#ideas_type').val();  
        var ideas_email = $('#ideas_email').val();
        var datas = {
            "email":$('#ideas_email').val(),
            "title":$('#ideas_subject').val(),
            "message":$('#ideas_message').val(),
            "is_newsletter":($('#news_check').hasClass('checked'))? 1: 0,
            "type":$('#ideas_type').val()
        }
        ajax_request.post('ideas', datas, function(e){
            console.log(e);
            if(typeof e.title !== "undefined" && e.message !== "undefined"){
                var pop = new okaoka_pop(e.title, e.message, ["OK"], function(e){
                    console.log(e)
                    delete pop;
                });
            }
            $('#ideas_form').remove();
            $('#ideas_infos').html(e.message+'<br/><h1 class="big_title">MERCI !</h1>');
        });
    },
    is_logged : function(){
        if(localStorage.getItem('user_infos') !== "" && localStorage.getItem('user_infos') !== null){
            this._user = JSON.parse(localStorage.getItem('user_infos'));
            if(typeof this._user.email === "undefined" && typeof this._user.token === "undefined" && this._user.access === "undefined"){
                return false;
            }else{
                return true;
            }
        }else{
            return false;
        }
    }
}
$(document).ready(function(){
    front_page.init();
});