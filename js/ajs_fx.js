AJS.fx={_shades:{0:"ffffff",1:"ffffee",2:"ffffdd",3:"ffffcc",4:"ffffbb",5:"ffffaa",6:"ffff99"},highlight:function(t,i){var s=new AJS.fx.Base;return s.elm=AJS.$(t),s.setOptions(i),s.options.duration=600,AJS.update(s,{increase:function(){t.style.backgroundColor=7==this.now?"transparent":"#"+AJS.fx._shades[Math.floor(this.now)]}}),s.custom(6,0)},fadeIn:function(t,i){i=i||{},i.from||(i.from=0,AJS.setOpacity(t,0)),i.to||(i.to=1);var s=new AJS.fx.Style(t,"opacity",i);return s.custom(i.from,i.to)},fadeOut:function(t,i){i=i||{},i.from||(i.from=1),i.to||(i.to=0),i.duration=300;var s=new AJS.fx.Style(t,"opacity",i);return s.custom(i.from,i.to)},setWidth:function(t,i){var s=new AJS.fx.Style(t,"width",i);return s.custom(i.from,i.to)},setHeight:function(t,i){var s=new AJS.fx.Style(t,"height",i);return s.custom(i.from,i.to)}},AJS.fx.Base=new AJS.Class({init:function(){AJS.bindMethods(this)},setOptions:function(t){this.options=AJS.update({onStart:function(){},onComplete:function(){},transition:AJS.fx.Transitions.sineInOut,duration:500,wait:!0,fps:50},t||{})},step:function(){var t=(new Date).getTime();t<this.time+this.options.duration?(this.cTime=t-this.time,this.setNow()):(setTimeout(AJS.$b(this.options.onComplete,this,[this.elm]),10),this.clearTimer(),this.now=this.to),this.increase()},setNow:function(){this.now=this.compute(this.from,this.to)},compute:function(t,i){var s=i-t;return this.options.transition(this.cTime,t,s,this.options.duration)},clearTimer:function(){return clearInterval(this.timer),this.timer=null,this},_start:function(t,i){return this.options.wait||this.clearTimer(),this.timer?void 0:(setTimeout(AJS.$p(this.options.onStart,this.elm),10),this.from=t,this.to=i,this.time=(new Date).getTime(),this.timer=setInterval(this.step,Math.round(1e3/this.options.fps)),this)},custom:function(t,i){return this._start(t,i)},set:function(t){return this.now=t,this.increase(),this},setStyle:function(t,i,s){"opacity"==this.property?AJS.setOpacity(t,s):AJS.setStyle(t,i,s)}}),AJS.fx.Style=AJS.fx.Base.extend({init:function(t,i,s){this.parent(),this.elm=t,this.setOptions(s),this.property=i},increase:function(){this.setStyle(this.elm,this.property,this.now)}}),AJS.fx.Styles=AJS.fx.Base.extend({init:function(t,i){this.parent(),this.elm=AJS.$(t),this.setOptions(i),this.now={}},setNow:function(){for(p in this.from)this.now[p]=this.compute(this.from[p],this.to[p])},custom:function(t){if(!this.timer||!this.options.wait){var i={},s={};for(p in t)i[p]=t[p][0],s[p]=t[p][1];return this._start(i,s)}},increase:function(){for(var t in this.now)this.setStyle(this.elm,t,this.now[t])}}),AJS.fx.Transitions={linear:function(t,i,s,n){return s*t/n+i},sineInOut:function(t,i,s,n){return-s/2*(Math.cos(Math.PI*t/n)-1)+i}},script_loaded=!0,script_loaded=!0;