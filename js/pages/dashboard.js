var dashboard_page = {
    _stats  : null,
    _user   : null,
    _users  : null,
    init : function(){
        this._user = JSON.parse(localStorage.getItem('user_infos'));
        if(typeof this._user.email === "undefined" && typeof this._user.token === "undefined" && this._user.access === "undefined"){
            window.location.href = 'login';
        }else{
            $('#login_form').css('display', 'block');
        }
        this.load_stats();
    },
    load_stats : function(){
        var self = this;
        //self.create_map();
        console.log('this._user.user_id :: ', this._user.id);
        ajax_request.get('stats', {user_id:this._user.id}, function(e){
            self._stats = e.datas;
            self.display_stats();
            
            ajax_request.get('users', {user_id:self._user.user_id}, function(e){
                console.log(e);
                self._users = e.datas;
                self.display_users_stats();
                //self.create_users_markers();
            });
        });
        
        /**/
    },
    display_stats : function(){
        var _okg = {}
        _okg.stats = this._stats;
        _okg.list_datas = _.sortBy(this._stats, 'date').reverse();
        _okg.pages = _.groupBy(_okg.list_datas, "page_name");
        /* display stats */
        var cols = [];
        $.each(_.keys(_okg.pages), function(i, key){
            cols.push([key, _okg.pages[key].length])
        });
        var chart_browser = c3.generate({
            bindto: '#page_stat_graph',
            data: {
                columns: cols,
                type : 'donut',
                onclick: function (d, i) { 
                    dashboard_page.show_page_stat(d.id); 
                },
                onmouseover: function (d, i) {  },
                onmouseout: function (d, i) {  }
            },
            donut: {
                title: "Pages Visitées"
            }
        });
        
        this.show_time_by_page();
    },
    show_page_stat : function(page){
        _okg = { stats: this._stats};
        var time = 0;
        var nb_visits = 0;
        $.each(_okg.stats, function(i, stat){
            if(stat.page_name === page && i<_okg.stats.length-2){
                nb_visits++;
                time += _okg.stats[i+1].date - _okg.stats[i].date;
            }
        });
        var timelap = time/nb_visits;
        $('#page_name').html("nom de la page : <b>"+page+"</b>");
        $('#nb_visits').html("Nombre de visites : <b>"+nb_visits+"</b>");
        $('#timelap').html("temps moyen : <b>"+this.ms_to_date(timelap)+"</b>");
        $('#total_time').html("Temps total : <b>"+this.ms_to_date(Math.abs(time))+"</b>");
    },
    show_time_by_page : function(){
        var self = this;
        _okg = {pages:null, details:{}};
        _okg.list_datas = _.sortBy(this._stats, 'date').reverse();
        _okg.pages = _.groupBy(_okg.list_datas, "page_name");
        delete _okg.list_datas['null'];
        $.each(_.keys(_okg.pages), function(i, key){
            console.log('key , ', key);
            _okg.details[key] = self.get_page_time(key);
        });
        //setTimeout(function(){
            delete _okg.details['null'];
            console.log(_okg.details);
            var time_array = [];
            $.each(_.keys(_okg.details), function(index, key){
                time_array.push([key, Math.abs(_okg.details[key].timelap)])
            });
            console.log('time_array :: ', time_array);
            console.log('time_array :: ', time_array);
            var chart_browser = c3.generate({
                bindto: '#time_stats',
                data: {
                    columns: time_array,
                    type : 'bar',
                    onclick: function (d, i) { 
                        dashboard_page.show_page_stat(d.id); 
                    },
                    onmouseover: function (d, i) {  },
                    onmouseout: function (d, i) {  }
                },
                donut: {
                    title: "Pages Visitées"
                }
            });
        //},2000);
    },
    get_page_time : function(page){
        console.log("get_page_time :: ", page);
        var self = this;
        var time = 0;
        var nb_visits = 0;
        $.each(this._stats, function(i, stat){
            if(stat.page_name === page && i<self._stats.length-2){
                nb_visits++;
                time += self._stats[i+1].date - self._stats[i].date;
            }
        });
        var timelap = time/nb_visits;
        console.log({nb_visits:nb_visits, timelap:timelap, total_time:time});
        return {nb_visits:nb_visits, timelap:timelap, total_time:time};
    },
    display_users_stats : function(){
        $('#total_bornes').html(this._users.length);
    },
    create_map : function(){
        this.map = L.map('map', {
            center: [51.505, -0.09],
            zoom: 13
        }); 
        
        L.tileLayer('https://api.tiles.mapbox.com/v4/simondelamarre.o306la09/{z}/{x}/{y}.png?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
            maxZoom: 18,
            id: 'okaoka',
            accessToken: 'sk.eyJ1Ijoic2ltb25kZWxhbWFycmUiLCJhIjoiY2lnbDFsMndhMDA4YXdqa3RianB1bjNzeCJ9.z5hmkPuyvR7IJ9DOtxAKrw'
        }).addTo(this.map);
        
        //var marker = L.marker([51.5, -0.09]).addTo(map);
    },
    create_users_markers : function(){
        var self = this;
        $.each(this._users, function(index, user){
            if(user.location !== ""){
                var latitude = user.location.split(':')[0];
                var longitude = user.location.split(':')[1];
                var marker = L.marker([latitude, longitude]).addTo(self.map);
            }
        });
    },
    ms_to_date : function(ms){
        var x = ms / 1000;
        seconds = x % 60;
        x /= 60;
        minutes = x % 60;
        x /= 60;
        hours = x % 24;
        x /= 24;
        days = x;
        return Math.floor(days)+'j '+Math.floor(hours)+'h '+Math.floor(minutes)+'min '+Math.floor(seconds)+'sec';
    },
    destroy : function(){
        
    }
}
$(document).ready(function(){
    dashboard_page.init();
});