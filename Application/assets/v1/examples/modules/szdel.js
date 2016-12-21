/**
 * SZdel jQuery Plugin - Copyright (c) 2016 liushizhan
 * For szwxq
 */
 ;(function(){
 	var defaults = {
 		scW : $(window).width(),
 		delhtml : '<div class="delbtn">删除</div>',
 		ismove : true,				//左侧是否移动
 		maskhtml : '<div id="SZdelMask" style="position:fixed;left:0px;top:0px;right:0px;bottom:0px;z-index:99999;display:none;"></div>',
        delCallback:''
 	};

 	var IsPC = function() {
	    var userAgentInfo = navigator.userAgent;
	    var Agents = ["Android", "iPhone",
	                "SymbianOS", "Windows Phone",
	                "iPad", "iPod"];
	    var flag = true;
	    for (var v = 0; v < Agents.length; v++) {
	        if (userAgentInfo.indexOf(Agents[v]) > 0) {
	            flag = false;
	            break;
	        }
	    }
	    return flag;
	}

 	var touchEvents = {
        touchstart: "touchstart",
        touchmove: "touchmove",
        touchend: "touchend",
        initTouchEvents: function () {
            if (IsPC()) {
                this.touchstart = "mousedown";
                this.touchmove = "mousemove";
                this.touchend = "mouseup";
            }
        }
    };
    touchEvents.initTouchEvents();

 	$.fn.szdel = function(options){
 		var options = $.extend({
            //events
            delCallback : ''
        },defaults,options);
 		var list = this.children('li');
 		var del = {
 			touchStartLeft : 0,
 			btnStartLeft : 0,
 			listStartLeft : 0,
 			moveDistance : 0,//左负右正
 			_moveDistance : 0,
 			leftWidth : 0,
 			btnWidth : 0,
 			btn : '',
 			list : '',
 			moveEle : '',
 			init : function(e,ele){
 				this.touchStartLeft = e.originalEvent.targetTouches[0].pageX;
 				this.list = ele.hasClass('szdel-list')?ele:ele.closest('.szdel-list');
 				this.listStartLeft = this.list.offset().left;
 				this.btn = this.list.find('.delbtn');
 				this.btnWidth = this.btn.width();
 				this.btnStartLeft = this.btn.offset().left;
 				this.leftWidth = options.scW - this.btnWidth;
 			},
 			move : function(e){
 				this.moveDistance = e.originalEvent.targetTouches[0].pageX - this.touchStartLeft;
 				if(this.moveDistance + this.btnStartLeft < this.leftWidth){
 					this._moveDistance = this.leftWidth - this.btnStartLeft;
 				}else if(this.moveDistance + this.btnStartLeft > options.scW){
 					this._moveDistance = options.scW - this.btnStartLeft;
 				}else{
 					this._moveDistance = this.moveDistance;
 				}
 				this.animate();
 			},
 			animate : function(){
 				if(options.ismove){
 					this.list.css({left:this.listStartLeft+this._moveDistance});
 					this.moveEle = this.list;
 				}else{
 					this.btn.css({left:this.btnStartLeft+this._moveDistance});
 					this.moveEle = this.btn;
 				}
 			},
 			end : function(ele){
 				this.moveDistance = 0;
 				this._moveDistance = 0;
 				var nowLeft = this.moveEle.position().left;
 				if(options.ismove){
 					var flag = Math.abs(nowLeft) > this.btnWidth/2;
 				}else{
 					var flag = nowLeft - this.leftWidth < this.btnWidth/2;
 				}
 				if(flag){
 					this.openbtn();
 				}else{
 					this.closebtn();
 				}
 			},
 			openbtn : function(){
 				if(options.ismove){
 					this.list.animate({left:-this.btnWidth},300);
 				}else{
 					this.btn.animate({left:this.leftWidth},300);
 				}
 				$("#SZdelMask").show();
 			},
 			closebtn : function(){
 				if(options.ismove){
 					this.list.animate({left:0},300);
 				}else{
 					this.btn.animate({left:options.scW},300);
 				}
 				setTimeout(function(){
 					$("#SZdelMask").hide();
 				},310)
 			}
 		};
 		$(this).after(options.maskhtml);
 		$("#SZdelMask").bind(touchEvents.touchstart,function(e){
 			del.closebtn();
 			e.preventDefault();
 			return false;
 		});
 		$(list).each(function(){
 			$(this).addClass('szdel-list');
 			$(this).css({position:'relative'});
 			$(this).append(options.delhtml);
 			$(this).find('.delbtn').css({display:'block',left:options.scW,top:0});
 			$(this).on('click','.delbtn',function(){
                $.isFunction( options.delCallback ) && options.delCallback.call(this,$(this).closest('li'));
 				return false;
 			});
 			$(this).bind(touchEvents.touchstart, function (e) {
	            var handle = $(e.target);
	            if(handle.hasClass('delbtn')) return;
	            del.init(e,handle);
	        });
	        $(this).bind(touchEvents.touchmove, function (e) {
	            var handle = $(e.target);
	            if(handle.hasClass('delbtn')) return;
	            del.move(e);
	        });
	        $(this).bind(touchEvents.touchend, function (e) {
	            var handle = $(e.target);
	            if(handle.hasClass('delbtn')) return;
	            del.end(handle);
	        });
 		});
 	}

 })()