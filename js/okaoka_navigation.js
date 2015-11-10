okaoka_navigation = {
    init:function(){
        $(window).on('scroll', function(e){
            if($(window).scrollTop() >= 60 && !$('header').hasClass('sticky')){
                $('header').addClass('sticky');
            }
            if($(window).scrollTop() < 60 && $('header').hasClass('sticky')){
                $('header').removeClass('sticky');
            }
        });
        this.check_header();
    },
    check_header : function(){
        if(localStorage.getItem('user_infos') !== "" && localStorage.getItem('user_infos') !== null){
            var _user = JSON.parse(localStorage.getItem('user_infos'));
            if(typeof _user.email === "undefined" || typeof _user.token === "undefined" || _user.access === "undefined"){
                $('#default_footer').css('display', 'block');
                $('#logged_footer').css('display', 'none');
                $('#login_button').css('display', 'block');
            }else{
                $('#default_footer').css('display', 'none');
                $('#logged_footer').css('display', 'block');
                $('#logout_button').css('display', 'block');
                $('#download_button').css('display', 'block');
                $('#drawing_button').css('display', 'block');
                $('#dashboard_button').css('display', 'block');
                $('#dev_button').css('display', 'block');
            }
            if(parseInt(_user.is_valid) === 2){
                $('#user_button').css('display', 'block');
            }
        }else{
            $('#default_footer').css('display', 'block');
            $('#logged_footer').css('display', 'none');
            $('#login_button').css('display', 'block');
        }
        $('#dev_button').on('click', function(){
            window.location.href = "developper";
        });
        $('#dashboard_button').on('click', function(){
            window.location.href = "dashboard";
        });
        $('#download_button').on('click', function(){
            window.location.href = "download";
        });
        $('#drawing_button').on('click', function(){
            window.location.href = "gallery";
        });
        $('#login_button').on('click', function(){
            window.location.href = "login";
        });
        $('#logout_button').on('click', function(){
            localStorage.setItem('user_infos', '');
            window.location.href = "/";
        });
    }
}