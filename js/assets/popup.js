var okaoka_pop = function(title, message, buttons, callBack){
    this.title = title;
    this.message = message;
    this.buttons = buttons;
    this.callBack = callBack;
    this.init();
}
okaoka_pop.prototype.init = function(){
    var self = this;
    if($('.pop_component').length > 0){
        $('.pop_component').remove();
    }
    $('body').append(self.get_template());
    for(var i=0; i<this.buttons.length; i++){
        $('#pop_button_'+i).on('click', function(){
            self.callBack($(this).attr('data-id'));
            self.destroy();
        });   
    }
    TweenMax.to($('.pop_component'), .5, {css:{"top":"0"}, ease:Back.easeOut});
}
okaoka_pop.prototype.get_template = function(){
    var temp = '<div class="pop_content"><div class="pop_component">';
            temp+= '<div class="pop_title">'+this.title+'</div>';
            temp+= '<div class="pop_message">'+this.message+'</div>';
            temp+= '<div class="pop_buttons center">';
            for(var i=0; i<this.buttons.length; i++){
                temp+= '<div id="pop_button_'+i+'" data-id="'+i+'" class="formular_button left">'+this.buttons[i]+'</div>';   
                if(i<this.buttons.length-1){
                    temp+= '<div class="spacer left" style="height:10px;width:10px;"></div>';
                }
            }
            temp+= '</div>';
        temp+= "</div></div>";
    return temp;
}
okaoka_pop.prototype.destroy = function(){
    var self = this;
    TweenMax.to($('.pop_component'), .5, {css:{"top":"200%"}, ease:Back.easeIn, onComplete : function(){
        $('.pop_content').remove();
        delete self;
    }});
}