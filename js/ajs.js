AJS={BASE_URL:"http://www.trachtengruppe-merenschwand.ch/images/galerie_js/",drag_obj:null,drag_elm:null,_drop_zones:[],_cur_pos:null,join:function(e,n){try{return n.join(e)}catch(t){var r=n[0]||"";return AJS.map(n,function(n){r+=e+n},1),r+""}},getScrollTop:function(){var e;return document.documentElement&&document.documentElement.scrollTop?e=document.documentElement.scrollTop:document.body&&(e=document.body.scrollTop),e},addClass:function(){var e=AJS.forceArray(arguments),n=e.pop(),t=function(e){new RegExp("(^|\\s)"+n+"(\\s|$)").test(e.className)||(e.className+=(e.className?" ":"")+n)};AJS.map(e,function(e){t(e)})},setStyle:function(){var e=AJS.forceArray(arguments),n=e.pop(),t=e.pop();AJS.map(e,function(e){e.style[t]=AJS.getCssDim(n)})},_getRealScope:function(e,n,t,r){var i=window;return n=AJS.$A(n),e._cscope&&(i=e._cscope),function(){var a=[],s=0;return t&&(s=1),AJS.map(arguments,function(e){a.push(e)},s),a=a.concat(n),r&&(a=a.reverse()),e.apply(i,a)}},preloadImages:function(){AJS.AEV(window,"load",AJS.$p(function(e){AJS.map(e,function(e){var n=new Image;n.src=e})},arguments))},_createDomShortcuts:function(){var _1a=["ul","li","td","tr","th","tbody","table","input","span","b","a","div","img","button","h1","h2","h3","br","textarea","form","p","select","option","iframe","script","center","dl","dt","dd","small","pre"],_1b=function(elm){var _1d="return AJS.createDOM.apply(null, ['"+elm+"', arguments]);",_1e="function() { "+_1d+"    }";eval("AJS."+elm.toUpperCase()+"="+_1e)};AJS.map(_1a,_1b),AJS.TN=function(e){return document.createTextNode(e)}},documentInsert:function(e){"string"==typeof e&&(e=AJS.HTML2DOM(e)),document.write('<span id="dummy_holder"></span>'),AJS.swapDOM(AJS.$("dummy_holder"),e)},getWindowSize:function(e){e=e||document;var n,t;return self.innerHeight?(n=self.innerWidth,t=self.innerHeight):e.documentElement&&e.documentElement.clientHeight?(n=e.documentElement.clientWidth,t=e.documentElement.clientHeight):e.body&&(n=e.body.clientWidth,t=e.body.clientHeight),{w:n,h:t}},flattenList:function(e){var n=[],t=function(e,n){AJS.map(n,function(n){null==n||(AJS.isArray(n)?t(e,n):e.push(n))})};return t(n,e),n},setEventKey:function(e){switch(e.key=e.keyCode?e.keyCode:e.charCode,window.event?(e.ctrl=window.event.ctrlKey,e.shift=window.event.shiftKey):(e.ctrl=e.ctrlKey,e.shift=e.shiftKey),e.key){case 63232:e.key=38;break;case 63233:e.key=40;break;case 63235:e.key=39;break;case 63234:e.key=37}},removeElement:function(){var e=AJS.forceArray(arguments);AJS.map(e,function(e){AJS.swapDOM(e,null)})},_unloadListeners:function(){AJS.listeners&&AJS.map(AJS.listeners,function(e,n,t){AJS.REV(e,n,t)}),AJS.listeners=[]},partial:function(e){var n=AJS.forceArray(arguments);return AJS.$b(e,null,n.slice(1,n.length).reverse(),!1,!0)},getIndex:function(e,n,t){for(var r=0;r<n.length;r++)if(t&&t(n[r])||e==n[r])return r;return-1},isDefined:function(e){return"undefined"!=e&&null!=e},isArray:function(e){return e instanceof Array},setLeft:function(){var e=AJS.forceArray(arguments);e.splice(e.length-1,0,"left"),AJS.setStyle.apply(null,e)},appendChildNodes:function(e){return arguments.length>=2&&AJS.map(arguments,function(n){AJS.isString(n)&&(n=AJS.TN(n)),AJS.isDefined(n)&&e.appendChild(n)},1),e},isOpera:function(){return-1!=navigator.userAgent.toLowerCase().indexOf("opera")},isString:function(e){return"string"==typeof e},hideElement:function(){var e=AJS.forceArray(arguments);AJS.map(e,function(e){e.style.display="none"})},setOpacity:function(e,n){e.style.opacity=n,e.style.filter="alpha(opacity="+100*n+")"},setHeight:function(){var e=AJS.forceArray(arguments);e.splice(e.length-1,0,"height"),AJS.setStyle.apply(null,e)},setWidth:function(){var e=AJS.forceArray(arguments);e.splice(e.length-1,0,"width"),AJS.setStyle.apply(null,e)},createArray:function(e){return AJS.isArray(e)&&!AJS.isString(e)?e:e?[e]:[]},isDict:function(e){var n=String(e);return-1!=n.indexOf(" Object")},isMozilla:function(){return-1!=navigator.userAgent.toLowerCase().indexOf("gecko")&&navigator.productSub>=20030210},_listenOnce:function(e,n,t){var r=function(){AJS.removeEventListener(e,n,r),t(arguments)};return r},addEventListener:function(e,n,t,r,i){i||(i=!1);var a=AJS.$A(e);AJS.map(a,function(a){if(r&&(t=AJS._listenOnce(a,n,t)),AJS.isIn(n,["submit","load","scroll","resize"])){var s=e["on"+n];return void(e["on"+n]=function(){return s?(t(arguments),s(arguments)):t(arguments)})}if(AJS.isIn(n,["keypress","keydown","keyup","click"])){var o=t;t=function(e){return AJS.setEventKey(e),o.apply(null,arguments)}}a.attachEvent?a.attachEvent("on"+n,t):a.addEventListener&&a.addEventListener(n,t,i),AJS.listeners=AJS.$A(AJS.listeners),AJS.listeners.push([a,n,t])})},createDOM:function(e,n){var t,r=0;if(elm=document.createElement(e),AJS.isDict(n[r])){for(k in n[0])t=n[0][k],"style"==k?elm.style.cssText=t:"class"==k||"className"==k?elm.className=t:elm.setAttribute(k,t);r++}return null==n[0]&&(r=1),AJS.map(n,function(e){e&&((AJS.isString(e)||AJS.isNumber(e))&&(e=AJS.TN(e)),elm.appendChild(e))},r),elm},setTop:function(){var e=AJS.forceArray(arguments);e.splice(e.length-1,0,"top"),AJS.setStyle.apply(null,e)},getElementsByTagAndClassName:function(e,n,t){var r=[];AJS.isDefined(t)||(t=document),AJS.isDefined(e)||(e="*");var a=t.getElementsByTagName(e),s=a.length,o=new RegExp("(^|\\s)"+n+"(\\s|$)");for(i=0,j=0;i<s;i++)(o.test(a[i].className)||null==n)&&(r[j]=a[i],j++);return r},removeClass:function(){var e=AJS.forceArray(arguments),n=e.pop(),t=function(e){e.className=e.className.replace(new RegExp("\\s?"+n,"g"),"")};AJS.map(e,function(e){t(e)})},bindMethods:function(e){for(var n in e){var t=e[n];"function"==typeof t&&(e[n]=AJS.$b(t,e))}},log:function(e){if(AJS.isMozilla())console.log(e);else{var n=AJS.DIV({style:"color: green"});AJS.ACN(AJS.getBody(),AJS.setHTML(n,""+e))}},isNumber:function(e){return"number"==typeof e},map:function(e,n,t,r){var i=0,a=e.length;for(t&&(i=t),r&&(a=r),i;a>i;i++)n.apply(null,[e[i],i])},removeEventListener:function(e,n,t,r){r||(r=!1),e.removeEventListener?(e.removeEventListener(n,t,r),AJS.isOpera()&&e.removeEventListener(n,t,!r)):e.detachEvent&&e.detachEvent("on"+n,t)},getCssDim:function(e){return AJS.isString(e)?e:e+"px"},setHTML:function(e,n){return e.innerHTML=n,e},bind:function(e,n,t,r,i){return e._cscope=n,AJS._getRealScope(e,t,r,i)},forceArray:function(e){var n=[];return AJS.map(e,function(e){n.push(e)}),n},update:function(e,n){for(var t in n)e[t]=n[t];return e},getBody:function(){return AJS.$bytc("body")[0]},HTML2DOM:function(e,n){var t=AJS.DIV();return t.innerHTML=e,n?t.childNodes[0]:t},getElement:function(e){return AJS.isString(e)||AJS.isNumber(e)?document.getElementById(e):e},showElement:function(){var e=AJS.forceArray(arguments);AJS.map(e,function(e){e.style.display=""})},swapDOM:function(e,n){e=AJS.getElement(e);var t=e.parentNode;return n?(n=AJS.getElement(n),t.replaceChild(n,e)):t.removeChild(e),n},isIn:function(e,n){var t=AJS.getIndex(e,n);return-1!=t?!0:!1}},AJS.$=AJS.getElement,AJS.$$=AJS.getElements,AJS.$f=AJS.getFormElement,AJS.$p=AJS.partial,AJS.$b=AJS.bind,AJS.$A=AJS.createArray,AJS.DI=AJS.documentInsert,AJS.ACN=AJS.appendChildNodes,AJS.RCN=AJS.replaceChildNodes,AJS.AEV=AJS.addEventListener,AJS.REV=AJS.removeEventListener,AJS.$bytc=AJS.getElementsByTagAndClassName,AJS.addEventListener(window,"unload",AJS._unloadListeners),AJS._createDomShortcuts(),AJS.Class=function(e){var n=function(){return"no_init"!=arguments[0]?this.init.apply(this,arguments):void 0};return n.prototype=e,AJS.update(n,AJS.Class.prototype),n},AJS.Class.prototype={extend:function(e){var n=new this("no_init");for(k in e){var t=n[k],r=e[k];t&&t!=r&&"function"==typeof r&&(r=this._parentize(r,t)),n[k]=r}return new AJS.Class(n)},implement:function(e){AJS.update(this.prototype,e)},_parentize:function(e,n){return function(){return this.parent=n,e.apply(this,arguments)}}},AJS.$=AJS.getElement,AJS.$$=AJS.getElements,AJS.$f=AJS.getFormElement,AJS.$b=AJS.bind,AJS.$p=AJS.partial,AJS.$FA=AJS.forceArray,AJS.$A=AJS.createArray,AJS.DI=AJS.documentInsert,AJS.ACN=AJS.appendChildNodes,AJS.RCN=AJS.replaceChildNodes,AJS.AEV=AJS.addEventListener,AJS.REV=AJS.removeEventListener,AJS.$bytc=AJS.getElementsByTagAndClassName,AJSDeferred=function(e){this.callbacks=[],this.errbacks=[],this.req=e},AJSDeferred.prototype={excCallbackSeq:function(e,n){for(var t=e.responseText;n.length>0;){var r=n.pop(),i=r(t,e);i&&(t=i)}},callback:function(){this.excCallbackSeq(this.req,this.callbacks)},errback:function(){0==this.errbacks.length&&alert("Error encountered:\n"+this.req.responseText),this.excCallbackSeq(this.req,this.errbacks)},addErrback:function(e){this.errbacks.unshift(e)},addCallback:function(e){this.callbacks.unshift(e)},addCallbacks:function(e,n){this.addCallback(e),this.addErrback(n)},sendReq:function(e){this.req.send(AJS.isObject(e)?AJS.queryArguments(e):AJS.isDefined(e)?e:"")}},script_loaded=!0,script_loaded=!0;