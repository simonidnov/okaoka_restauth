var ajax_request = {
    _ajax : null,
    _base_url : "http://ws.okaoka.local/api/okaoka/",
    _format : 'json',
    _callBack : null,
    init : function(){
        this._ajax = $();
    },
    get : function(uri, params, callBack){
        this.call(uri, "GET", params, callBack);
    },
    put : function(uri, params, callBack){
        this.call(uri, "PUT", params, callBack);
    },
    post : function(uri, params, callBack){
        this.call(uri, "POST", params, callBack);
    },
    delete : function(uri, params, callBack){
        this.call(uri, "delete", params, callBack);
    },
    call : function(uri, type, datas, callBack){
        this._callBack = callBack;
        $.ajax({
            url: this._base_url+uri,
            type: type,
            data: datas,
            dataType: this._format,
            timeout: 10000,
        }).done(this.success)
          .fail(this.fail)
          .always(this.always);
    },
    always : function(e){
    },
    success : function(e){
        ajax_request._callBack(e);
    },
    fail : function(error){
        if(error.statusText === "timeout") {
            var pop = new okaoka_pop("Timeout", "Le serveur n'a pas répondu assez vite, veuillez réessayer plus tard", ["OK"], function(e){
                console.log(e)
                delete pop;
            });
            console.log('le service n\'a pas répondu dans des délais suffisant, veuillez réessayer plus tard');
        }else{
            if(typeof error.responseText !== "undefined"){
                var datas = JSON.parse(error.responseText);
                if(error.status === 403){
                    if(typeof datas.title !== "undefined" && typeof datas.message !== "undefined"){
                        var pop = new okaoka_pop(datas.title, datas.message, ["Retour à l'accueil"], function(e){
                            window.location.href = '/';
                            delete pop;
                        });
                    }
                }else{
                    if(typeof datas.title !== "undefined" && typeof datas.message !== "undefined"){
                        var pop = new okaoka_pop(datas.title, datas.message, ["OK"], function(e){
                            delete pop;
                        });
                    }
                }
            }
        }
    }
}