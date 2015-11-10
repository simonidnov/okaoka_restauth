var application_page = {
    _upload_form : null,
    _versions_list : null,
    init : function(){
        var _user = JSON.parse(localStorage.getItem('user_infos'));
        /*ajax_request.get('application', {user_id:_user.id}, function(e){
            console.log(e);
            application_page._versions_list = e.datas;
            application_page.display_list();
        });*/
        this._switch_os_form = new formular('switch_os_form', function(e){
            switch(e.datas.switch_os_tab){
                case 0:
                    $('.item').css('display', 'none');
                    $('[data-plateform="osx64"]').css('display', 'block');
                    break;
                case 1:
                    $('.item').css('display', 'none');
                    $('[data-plateform="win32"]').css('display', 'block');
                    break;
                case 2:
                    $('.item').css('display', 'none');
                    $('[data-plateform="win64"]').css('display', 'block');
                    break;
                case 3:
                    $('.item').css('display', 'none');
                    $('[data-plateform="linux64"]').css('display', 'block');
                    break;
            }
        });
        this._upload_form = new formular('app_upload_form', function(e){
            console.log(e);
            if(e.status === "success"){
                application_page.send_new_app(e);
            }
        });
        /*$("#file_upload").on('change', function(e){
            e.preventDefault();
            alert('change');
            var input = this;
            var url = $(this).val();
            console.log(url);
            var input_file = $(this);
            ajax_request.post('largezip', {local_file_name:url}, function(e){
            
            });
        });*/
    },
    display_list : function(){
        $.each(this._versions_list, function(index, version){
            var temp = _.template($('#list_app_template').html());
            $('#app_list_content').append(temp(version)); 
        });
    },
    send_new_app : function(e){
        if(e.datas.file_upload === ""){
            console.log('return false ', e.datas.file_upload);
            return false;
        }
        var os = "";
        switch(e.datas.os_picker){
            case 0 : 
                os = "osx64";
                break;
            case 1 : 
                os = "win32";
                break;
            case 2 : 
                os = "win64";
                break;
            case 3 : 
                os = "linux32";
                break;
            case 4 : 
                os = "linux64";
                break;
        }
        var is_install = 0;
        switch(e.datas.installer_check){
            case true:
                is_install = 1;
                break;
            case false:
                is_install = 0;
                break;
        }
        if(localStorage.getItem('user_infos') !== "" && localStorage.getItem('user_infos') !== null){
            var _user = JSON.parse(localStorage.getItem('user_infos'));
        }else{
            return false;
        }
        var formData = new FormData();
        formData.append("user_id", _user.id);
        formData.append("release_version", $('#version_number').val());
        formData.append("whats_new", $("#whats_new").val());
        formData.append("os", os);
        formData.append("is_install", is_install);
        formData.append("datas_zip", e.datas.file_upload);
        
        var request = new XMLHttpRequest();
        request.open("POST", ajax_request._base_url+"application");
        request.send(formData);
    }
}
$(document).ready(function(){
    application_page.init();
});