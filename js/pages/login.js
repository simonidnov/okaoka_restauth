var login_page = {
    _login_form : null,
    init:function(){
        if(localStorage.getItem('user_infos') !== "" && localStorage.getItem('user_infos') !== null){
            _user = JSON.parse(localStorage.getItem('user_infos'));
            if(typeof _user.email !== "undefined" && typeof _user.token !== "undefined" && _user.access !== "undefined"){
                window.location.href = 'dashboard';
            }else{
                $('#login_form').css('display', 'block');
            }
        }else{
            $('#login_form').css('display', 'block');
        }
        this._login_form = new formular('login_form', function(e){
            switch(e.datas.switch_account_tab){
                case 0:
                    $('#login_in').css('display', 'block');
                    $('#request_account').css('display', 'none');
                    $('#request_password').css('display', 'none');
                    break;
                case 1:
                    $('#login_in').css('display', 'none');
                    $('#request_account').css('display', 'block');
                    $('#request_password').css('display', 'none');
                    break;
                case 2:
                    $('#login_in').css('display', 'none');
                    $('#request_account').css('display', 'none');
                    $('#request_password').css('display', 'block');
                    break;
            }
        });
        $('#validate_login_form').on('click', function(){
            ajax_request.get('admin_login', {
                email:$('#email_login').val(),
                password:$('#password_login').val()
            }, function(e){
                localStorage.setItem('user_infos', JSON.stringify(e.user_infos));
                window.location.href = 'dashboard';
            });
            /*var pop = new okaoka_pop("hello", "world", ["hello", "world"], function(e){
                console.log(e)
                delete pop;
            });*/
        });
        $('#validate_request_account_form').on('click', function(){
            ajax_request.post('admin_account', {
                email:$('#email_request_account').val(),
                password:$('#password_request_account').val(),
                why:$('#why_request_account').val()
            }, function(e){
                console.log(e);
            });
            /*var pop = new okaoka_pop("hello", "world", ["hello", "world"], function(e){
                console.log(e)
                delete pop;
            });*/
        });
        $('#validate_request_password_form').on('click', function(){
            var pop = new okaoka_pop("hello", "world", ["hello", "world"], function(e){
                console.log(e)
                delete pop;
            });
        });
    }
}
$(document).ready(function(){
    login_page.init();
});