var _okg = null;
function maze(){
    this._tile_size = 25;
    this._time_lap = 60000;
    this.maze_level = [];
    this.playlist_uri = "/playlist/";   
    this.playlist = null;
    this._current_maze = 0;
    this.init();
    this.game_infos = {
        great:0,
        wrong:0
    }
    _okg = this;
}
maze.prototype.init = function(){
    //this.create_interface();
}
maze.prototype.pause = function(){
    
}
maze.prototype.play = function(){
    
}
maze.prototype.draw_level = function(){
    this.maze_level = this.create_maze(5,5);
    for(var i=0; i<this.maze_level.length; i++){
        for(var l=0; l<this.maze_level[i].length; l++){
            for(var c=0; c<this.maze_level[i][l].length; c++){
                var brick = new createjs.Shape();
                if(this.maze_level[i][l][c] === 1){
                    brick.graphics.beginFill("#FFFFFF");
                    brick.graphics.drawRect(0,0,this._tile_size/2, this._tile_size/2);
                    switch(c){
                        case 0:
                            brick.x = this._tile_size*i;
                            brick.y = this._tile_size*l;
                            break;
                        case 1:
                            brick.x = this._tile_size*i + ((this._tile_size/2));
                            brick.y = this._tile_size*l;
                            break;
                        case 2:
                            brick.x = this._tile_size*i;
                            brick.y = this._tile_size*l + ((this._tile_size/2)*c);
                            break;
                        case 3:
                            brick.x = this._tile_size*i + ((this._tile_size/2)*c);
                            brick.y = this._tile_size*l + ((this._tile_size/2)*c);
                            break;
                    }
                    this.stage.addChild(brick);
                }else{
                    console.log('this is the wall');
                }
            }
        }
    }
}
maze.prototype.create_interface = function(){
    $('#maze_canvas')
        .css({"width":window.innerWidth, "height":window.innerHeight})
        .attr({"width":window.innerWidth, "height":window.innerHeight});
    
    this.stage = new createjs.Stage("maze_canvas");
    this.stage.autoClear = true;
    this.stage.update();
    this.build_chronos_line();
    this.create_taskbar();
    createjs.Touch.enable(this.stage);
    createjs.Ticker.addEventListener("tick", this.tick);
    createjs.Ticker.setFPS(60);
    utilities.show_popup(
        {color:navigation._current_interface_color, motion:"maze_tuto_popup", buttons:["play"]}, 
        function(e){
            _okg.count_start_chronos(function(){
                _okg.start_date = new Date().getTime();
                _okg.okaokasprite.gotoAndPlay('run');
                _okg.started = true;
                _okg.draw_level();
            });
        }
    );
}
maze.prototype.tick = function(){
    if( _okg.started ){
        _okg.update_chronos();
    }
    _okg.stage.update();
}
maze.prototype.destroy = function(callBack){
    $('.okaoka_maze').html('');
    callBack();
}


maze.prototype.create_maze = function(x, y){
    var totalCells = x*y;
    var cells = new Array();
    var unvis = new Array();
    for (var i = 0; i < y; i++) {
        cells[i] = new Array();
        unvis[i] = new Array();
        for (var j = 0; j < x; j++) {
            cells[i][j] = [0,0,0,0];
            unvis[i][j] = true;
        }
    }
    
    // Set a random position to start from
    var currentCell = [Math.floor(Math.random()*y), Math.floor(Math.random()*x)];
    var path = [currentCell];
    unvis[currentCell[0]][currentCell[1]] = false;
    var visited = 1;
    
    // Loop through all available cell positions
    while (visited < totalCells) {
        // Determine neighboring cells
        var pot = [[currentCell[0]-1, currentCell[1], 0, 2],
                [currentCell[0], currentCell[1]+1, 1, 3],
                [currentCell[0]+1, currentCell[1], 2, 0],
                [currentCell[0], currentCell[1]-1, 3, 1]];
        var neighbors = new Array();
        
        // Determine if each neighboring cell is in game grid, and whether it has already been checked
        for (var l = 0; l < 4; l++) {
            if (pot[l][0] > -1 && pot[l][0] < y && pot[l][1] > -1 && pot[l][1] < x && unvis[pot[l][0]][pot[l][1]]) { neighbors.push(pot[l]); }
        }
        
        // If at least one active neighboring cell has been found
        if (neighbors.length) {
            // Choose one of the neighbors at random
            next = neighbors[Math.floor(Math.random()*neighbors.length)];
            
            // Remove the wall between the current cell and the chosen neighboring cell
            cells[currentCell[0]][currentCell[1]][next[2]] = 1;
            cells[next[0]][next[1]][next[3]] = 1;
            
            // Mark the neighbor as visited, and set it as the current cell
            unvis[next[0]][next[1]] = false;
            visited++;
            currentCell = [next[0], next[1]];
            path.push(currentCell);
        }
        // Otherwise go back up a step and keep going
        else {
            currentCell = path.pop();
        }
    }
    return cells;
}







maze.prototype.update_chronos = function(){
     var now = new Date().getTime();
     var elapsed = now - this.start_date;
     var rest = (this._time_lap - elapsed);
     this.chronostext.text = Math.ceil(rest/1000);
     this.greattext.text = this.game_infos.great;
     this.wrongtext.text = this.game_infos.wrong;
     /* CHECKING TIME AND RENDER BAR + CHRONOS _okg.party.start */
     var percent_progress = 100 - ((rest * 100 ) / this._time_lap);
     this.chronos_line_progress.scaleX = percent_progress / 100;
     this.okaokasprite.x = (window.innerWidth) * (percent_progress/ 100) - 50;
     /* on check si il reste du temps */
     /*if(Math.round(rest) === 5){
         if(typeof _okg.five_last_sound === "undefined"){
             audio_manager.play_sound('chronos_five_seconds', 0, function(e){
                 _okg.five_last_sound = e;
             });
         }
     }*/
     if(rest <= 0){
         console.log('le jeu est fini chronos');
         //audio_manager.play_sound('chronos_end', 0, function(e){});
         /* si le temps est écoulé c'est la fin de la partie */
         this.started = false;
         this.okaokasprite.gotoAndStop('stand');
         //_okg.fivehits.gotoAndStop('stop');
         this.end_game();
     }
}

maze.prototype.create_taskbar = function(){
    this.score_infos = this.stage.addChild(new createjs.Container());
    this.score_infos_ground = new createjs.Shape();
    this.score_infos.addChild(this.score_infos_ground);
    
    this.greatsprite = new createjs.Bitmap("pages/simplediscs/images/great.png");
    this.wrongsprite = new createjs.Bitmap("pages/simplediscs/images/wrong.png");
    this.chronosprite = new createjs.Bitmap("pages/simplediscs/images/chronos.png");
    
    this.greattext = new createjs.Text();
    this.greattext.font = "100 35px Roboto";
    this.greattext.color = "#FFFFFF";
    this.greattext.text = '0';
    
    this.wrongtext = new createjs.Text();
    this.wrongtext.font = "100 35px Roboto";
    this.wrongtext.color = "#FFFFFF";
    this.wrongtext.text = '0';
    
    this.chronostext = new createjs.Text();
    this.chronostext.font = "100 35px Roboto";
    this.chronostext.color = "#FFFFFF";
    this.chronostext.text = '60';
    
    this.greatsprite.regX = this.greatsprite.regY = this.wrongsprite.regX = this.wrongsprite.regY = this.chronosprite.regX =  this.chronosprite.regY = 20; 
    
    this.greattext.textAlign = "center"; 
    this.wrongtext.textAlign = "center"; 
    this.chronostext.textAlign = "center"; 
    
    this.greatsprite.y = this.wrongsprite.y = this.chronosprite.y = 20;
    
    this.chronosprite.x = 20;
    this.chronostext.x = 20;
    this.chronostext.y = 50;
    
    this.greatsprite.x = 110;
    this.greattext.x = 110;
    this.greattext.y = 50;
    
    this.wrongsprite.x = 200;
    this.wrongtext.x = 200;
    this.wrongtext.y = 50;
    
    var data = {
        images: ["./pages/dots/images/five_hits_sprite.png"],
        frames: {width:100, height:100},
        animations: {
            hit:[0,15,true],
            stop:16
        }
    };
    var spriteSheet = new createjs.SpriteSheet(data);
    
    data = null;
    delete data;
    
    this.fivehits = new createjs.Sprite(spriteSheet, "stop");
    this.fivehits.regX = this.fivehits.regY = 25;
    this.fivehits.x = -3;
    this.fivehits.y = 45;
    
    this.score_infos.addChild(this.fivehits);
    
    this.score_infos.addChild(this.greatsprite);
    this.score_infos.addChild(this.wrongsprite);
    this.score_infos.addChild(this.chronosprite);
    this.score_infos.addChild(this.greattext);
    this.score_infos.addChild(this.wrongtext);
    this.score_infos.addChild(this.chronostext);
    
    this.score_infos.x = (window.innerWidth/2) - (this.score_infos.getBounds().width/2);
    this.score_infos.y = 20;
}
maze.prototype.destroy_circles = function(){
    for(var i=0; i<this.stage.getNumChildren(); i++){
        if(this.stage.getChildAt(i).name !== null){
            console.log(this.stage.getChildAt(i).name.indexOf('circle'));
            if(this.stage.getChildAt(i).name.indexOf('circle') !== -1){
                TweenMax.to(this.stage.getChildAt(i), .2, {scaleX:0, scaleY:0, onComplete:function(){
                    _okg.stage.removeChild($(this));
                }});
            }
        }
    }
}
maze.prototype.end_game = function(){
    this.destroy_circles();
    TweenMax.to(_okg.score_infos, .5, {
        y       : window.innerHeight/2 - (_okg.score_infos.getBounds().height/2),
        x       : (window.innerWidth/2) - (_okg.score_infos.getBounds().width/2),
        ease    : Power4.easeInOut,
        delay   : .5,
        onComplete : function(){
            _okg.destroy_circles();
            utilities.create_over_motion({
                size:{width:400, height:200},
                position:{x:((window.innerWidth/2)-200), y:((window.innerHeight/2) - 265)},
                motion:"winning_dance_top_motion"
            }, function(){
            });
            createjs.Ticker.setFPS(30);
            _okg.total_score_text = new createjs.Text();
            _okg.total_score_text.font = "700 100px Roboto";
            _okg.total_score_text.color = "#FFFFFF";
            _okg.total_score_text.text = "00000";
            _okg.total_score_text.textAlign = "center";
            _okg.total_score_text.x = window.innerWidth/2;
            _okg.total_score_text.y = _okg.score_infos.y + _okg.score_infos.getBounds().height;
            _okg.stage.addChild(_okg.total_score_text);
            /* CALCUL SCORE */
            var total_score = (_okg.game_infos.great-_okg.game_infos.wrong)*_okg.level;
            if(total_score < 0){
                total_score = 0;
            }
            var scored = {total:0};
            audio_manager.play_sound('total_count', 0, function(e){});
            TweenMax.to(scored, 2.5, {
                total : total_score,
                delay:.6,
                onUpdate : function(){
                    var score = "";
                    var num = Math.ceil(scored.total);
                    if(num.toString().length < 5){
                        var dif = 5 - num.toString().length;
                        for(var i=0; i<dif; i++){
                            score+="0";
                        }
                    }
                    score+= num.toString();
                    _okg.total_score_text.text = score;
                },
                ease:Power4.easeOut,
                onComplete:function(){
                    _okg.replay_button = new createjs.Bitmap("./images/assets/btn_replay.png");
                    _okg.replay_button.x = window.innerWidth/2 + 70;
                    _okg.replay_button.y = _okg.total_score_text.y + _okg.total_score_text.getBounds().height + 70;
                    _okg.replay_button.regX = _okg.replay_button.regY = 50;
                    _okg.replay_button.scaleX = _okg.replay_button.scaleY = 0;
                    
                    _okg.stats_button = new createjs.Bitmap("./images/assets/btn_podium.png");
                    _okg.stats_button.x = window.innerWidth/2 - 70;
                    _okg.stats_button.y = _okg.total_score_text.y + _okg.total_score_text.getBounds().height + 70;
                    _okg.stats_button.regX = _okg.stats_button.regY = 50;
                    _okg.stats_button.scaleX = _okg.stats_button.scaleY = 0;
                    
                    var hitAreaG = new createjs.Graphics();
                    hitAreaG.beginFill(navigation._current_interface_color);
                    hitAreaG.drawCircle(50, 50, 50);
                    hitAreaG.endFill();
                    _okg.replay_button.hitArea = new createjs.Shape(hitAreaG);
                    _okg.stats_button.hitArea = new createjs.Shape(hitAreaG);
                    
                    utilities.save_score_game('number', total_score);
                    _okg.replay_button.addEventListener("click", function(event) { 
                        window.location.href = "#page/"+navigation._current_page_name+"/intro/false/date/"+new Date().getTime();
                    });
                    _okg.stats_button.addEventListener("click", function(event) { 
                        utilities.show_score_game('number', total_score);
                    });
                    TweenMax.to(_okg.replay_button, .5, {
                        scaleX:1,
                        scaleY:1
                    });
                    TweenMax.to(_okg.stats_button, .5, {
                        scaleX:1,
                        scaleY:1,
                        delay:.2
                    });
                    _okg.stage.addChild(_okg.replay_button);
                    _okg.stage.addChild(_okg.stats_button);
                }
            });
        }
    });
}
maze.prototype.count_start_chronos = function(callBack){
    this.countGround = new createjs.Shape();
    this.countGround.graphics.beginFill(navigation._current_interface_color);
    this.countGround.graphics.drawCircle(0,0,70);
    this.countGround.scaleX = this.countGround.scaleY = 0;
    this.countGround.x = window.innerWidth/2;
    this.countGround.y = window.innerHeight/2;
    TweenMax.to(this.countGround, .5, {scaleX:1, scaleY:1});
    
    this.stage.addChild(this.countGround);
    //this.drawShape( this.dots[cur], cur_color); 
    
    this.countMotion = new lib["count_3"]();
    this.countMotion.regX = 275;
    this.countMotion.regY = 200;
    this.countMotion.x = window.innerWidth/2;
    this.countMotion.y = window.innerHeight/2;
    //this.countMotion.shadow = new createjs.Shadow(utilities.colorLuminance(navigation._current_interface_color, -.2), 3, 3, 0);
    this.stage.addChild(this.countMotion);
    utilities.countCallBack = function(){
        TweenMax.to(_okg.countGround, .5, {scaleX:0, scaleY:0});
        _okg.stage.removeChild(_okg.countMotion);
        _okg.stage.removeChild(_okg.countGround);
        callBack();
    }
}

maze.prototype.build_chronos_line = function(){
    
    this.okaokarun = new Image();
    this.okaokarun.src = "pages/simplediscs/images/simple_run.png";
    
    this.chronos_line = this.stage.addChild(new createjs.Container());
    this.chronos_line.regY = 25;
    this.chronos_line.y = window.innerHeight;
    this.chronos_line_ground = new createjs.Shape();
    this.chronos_line_ground.graphics.beginFill('rgba(0,0,0,.3)');
    this.chronos_line_ground.graphics.drawRect(0,0,window.innerWidth, 25);
    this.chronos_line.addChild(this.chronos_line_ground);
    
    this.chronos_line_progress = new createjs.Shape();
    this.chronos_line_progress.graphics.beginFill('#FFFFFF');
    this.chronos_line_progress.graphics.drawRect(0,0,window.innerWidth, 25);
    this.chronos_line_progress.scaleX = 0;
    this.chronos_line.addChild(this.chronos_line_progress);
    
    var data = {
        images: [this.okaokarun],
        frames: {width:80, height:80},
        animations: {
            stand:{frames:[0]},
            run:{frames:[0,0,1,1,2,2,3,3,4,4,5,5,6,6], frequency:50},
            great:{frames:[7,7,8,8,9,9,10,10,11,11,12,12,13,13,14,14,15,15,16], next:"run"},
            wrong:{frames:[17,17,18,18,19,19,20,20,21,21,22,22,23,23,24], next:"wrongslide"},
            wrongslide:{frames:[21,21,22,22,23,23,21,21,22,22,23,23,21,21,22,22,23,23,21,21,22,22,23,23], next:"run"}
        },
        framerate: 5
    };
    var spriteSheet = new createjs.SpriteSheet(data);
    this.okaokasprite = new createjs.Sprite(spriteSheet, "run");
    this.okaokasprite.scaleX = this.okaokasprite.scaleY = .7;
    this.okaokasprite.y = -55;
    this.okaokasprite.gotoAndStop('stand');
    this.chronos_line.addChild(this.okaokasprite);   
}