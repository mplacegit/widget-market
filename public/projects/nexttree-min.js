!function e(t,n,r){function o(s,c){if(!n[s]){if(!t[s]){var a="function"==typeof require&&require;if(!c&&a)return a(s,!0);if(i)return i(s,!0);throw new Error("Cannot find module '"+s+"'")}var h=n[s]={exports:{}};t[s][0].call(h.exports,function(e){var n=t[s][1][e];return o(n||e)},h,h.exports,e,t,n,r)}return n[s].exports}for(var i="function"==typeof require&&require,s=0;s<r.length;s++)o(r[s]);return o}({1:[function(e,t,n){"use strict";var r={ajax:function(e,t){var n=e,r=(t=t||{}).errorFn||function(){},o=t.successFn||function(){},i=t.type||"GET",s=t.data||{},c=JSON.stringify(s);if(i=i.toUpperCase(),window.XMLHttpRequest)a=new XMLHttpRequest;else var a=new ActiveXObject("Microsoft.XMLHTTP");if("GET"==i){c=null,n.indexOf("?")<0&&(n+="?1=1");for(var h in s)s.hasOwnProperty(h)&&(n+="&"+h+"="+s[h])}a.open(i,n,!0),a.onreadystatechange=function(){4==a.readyState?200==a.status?o({response:a.responseText}):r({status:a.status}):r({status:a.readyState})},a.onreadystatechange=function(){4==a.readyState&&(console.log([17,a.status]),200==a.status?o(a.responseText):r({status:a.status}))};try{a.withCredentials=t.withCredentials||!1,a.send(c)}catch(e){}}};t.exports=r},{}],2:[function(e,t,n){"use strict";function r(e){this.parent=e,this.li=null,this.ul=null,this.name=null,this.calculated=0,this.checkbox=null,this.id=null,this.checkedTops={},this.onclickFn=function(e){},this.oncheckFn=function(e){}}r.prototype.clearBranch=function(e){for(;e.firstChild;){var t=e.firstChild.querySelector("ul");t&&this.clearBranch(t),e.removeChild(e.firstChild)}e.parentNode.removeChild(e)},r.prototype.checkResult=function(e,t){for(var n=e&&e.firstChild;n;n=n.nextSibling)if(1===n.nodeType&&"li"===n.nodeName.toLowerCase())if(n.firstChild.querySelector("input").checked)t[n.dataset.id]=n.firstChild.lastChild.innerHTML;else{var r=n.querySelector("ul");r&&this.checkResult(r,t)}},r.prototype.setInputByChildren=function(){var e=0,t=!0;if(this.ul){for(var n=this.ul.querySelectorAll("li input"),r=0,o=n.length;r<o;r++)e++,n[r].checked||(t=!1);e&&(this.checkbox.checked=t)}this.parent?this.parent.setInputByChildren():(this.checkedTops={},this.checkResult(this.ul,this.checkedTops),this.afterChecked.call(this))},r.prototype.checkInput=function(e){return!(!this.checkbox||!this.checkbox.checked)},r.prototype.getContailer=function(e){this.ul=e,this.li&&this.li.appendChild(e)},r.prototype.show=function(e,t){this.parent,e.appendChild(this.createTopNode(t))},r.prototype.createTopNode=function(e){var t=this;console.log([22,e.calculated]),e.calculated&&(this.calculated=e.calculated),this.name=e.name,this.id=e.id,this.li=document.createElement("LI"),this.li.dataset.id=e.id;var n=document.createElement("DIV");this.checkbox=document.createElement("input"),this.checkbox.type="checkbox",e.hasOwnProperty("ch2")&&e.ch2&&(this.checkbox.checked=!0),this.checkbox.onclick=function(){if(t.ul)for(var e=t.ul.querySelectorAll("li input"),n=0,r=e.length;n<r;n++)e[n].checked=this.checked;t.parent&&t.parent.setInputByChildren()},this.parent&&this.parent.checkInput()&&(this.checkbox.checked=!0);var r=document.createElement("span");r.className="pushopen";var o=document.createElement("span");e.hasOwnProperty("found")&&e.found&&(o.style.color="#0000FF"),0==e.id&&(o.style.color="red"),o.innerHTML=this.name,e.childrenCount?(r.innerHTML="+",r.style.cursor="pointer",r.onclick=function(){t.onclickFn.call(t)},o.onclick=function(){t.onclickFn.call(t)}):r.innerHTML=" ",this.li.appendChild(n),n.appendChild(r),n.appendChild(this.checkbox),n.appendChild(o);var i=document.createElement("span");return i.innerHTML=this.calculated+' &nbsp; <a href="https://widget.market-place.su/rekrut-product/next/category/form/'+e.id+'" target="_blank">прав.</a>',i.style.position="absolute",i.style.right="0",e.rule&&(i.style.backgroundColor="#FF69FF"),n.appendChild(i),this.li},t.exports=r},{}],3:[function(e,t,n){"use strict";function r(e){this.rootId=90401,this.rootName="Категории",this.body=e,this.rootNode=new o(null),this.rootNode.afterChecked=function(){};var t=document.createElement("UL");this.body.appendChild(t);var n={name:this.rootName,id:this.rootId};this.rootNode.show(t,n)}var o=e("./nextnode"),i=e("./httpclient");r.prototype.setFunctionCh2=function(e){this.rootNode.afterChecked=e},r.prototype.openInd=function(e){if(e.psg.length){var t="https://widget.market-place.su/rekrut-product/categories/0/open?data="+encodeURIComponent(JSON.stringify(e)),n=this,r=this.rootNode;i.ajax(t,{errorFn:function(e){console.log([1,"error",e])},successFn:function(e){try{var t=JSON.parse(e);t.hasOwnProperty(n.rootId)&&(n.openTree(t,{parent:r}),r.setInputByChildren())}catch(e){console.log("битая конфигурация",e)}},withCredentials:!0})}},r.prototype.openSearch=function(e){if(e.name){e.psg=[];var t;for(t in this.rootNode.checkedTops)e.psg.push(t);var n="https://widget.market-place.su/rekrut-product/categories/0/research?data="+encodeURIComponent(JSON.stringify(e)),r=this,o=this.rootNode;i.ajax(n,{errorFn:function(e){console.log([1,"error",e])},successFn:function(e){try{var t=JSON.parse(e);t.hasOwnProperty(r.rootId)&&(r.rootNode.clearBranch(r.rootNode.ul),r.openTree(t,{parent:o}))}catch(e){console.log("битая конфигурация",e)}},withCredentials:!0})}},r.prototype.openStart=function(e){var t="https://widget.market-place.su/rekrut-product/categories";(e=e||{}).hasOwnProperty("id")&&(t+="/"+e.id);n=this.rootNode;if(e.hasOwnProperty("parent"))var n=e.parent;var r=this;i.ajax(t,{errorFn:function(e){console.log([1,"error",e])},successFn:function(e){try{var t=JSON.parse(e);r.openBranch(t.data,{parent:n})}catch(e){console.log("битая конфигурация",e)}},withCredentials:!0})},r.prototype.openTree=function(e,t){var n=this;if(e.hasOwnProperty([t.parent.id])){var r=document.createElement("UL");t.parent.getContailer(r);var i;for(i in e[t.parent.id]){var s=new o(t.parent);s.onclickFn=function(e){var t=this.li.querySelector("span.pushopen");if(this.ul)""==this.li.className?(this.li.className="cl",t.innerHTML="+"):(this.li.className="",t.innerHTML="-");else{t.innerHTML="-";var r={id:this.id,parent:this};n.openStart(r)}},s.show(r,e[t.parent.id][i]),n.openTree(e,{parent:s})}}},r.prototype.openBranch=function(e,t){var n=this;e=e||[{name:"лист 1",id:1},{name:"лист 2",id:2},{name:"лист 3",id:3},{name:"лист 4",id:4},{name:"лист 5",id:5}];var r=document.createElement("UL");t.parent.getContailer(r);for(var i=0,s=e.length;i<s;i++){var c=new o(t.parent);c.onclickFn=function(e){var t=this.li.querySelector("span.pushopen");if(this.ul)""==this.li.className?(this.li.className="cl",t.innerHTML="+"):(this.li.className="",t.innerHTML="-");else{t.innerHTML="-";var r={id:this.id,parent:this};n.openStart(r)}},c.show(r,e[i])}},t.exports=r},{"./httpclient":1,"./nextnode":2}],4:[function(e,t,n){"use strict";function r(e,t,n,r,i,s,c,a){this.src_id=e.dataset.id,this.searchInput=n.querySelector("input.microsearch_input"),this.searchInput.value="",this.searchButton=n.querySelector("button.microsearch_button"),this.TreeBody=n.querySelector("#teletree"),this.TreeBody.innerHTML="",this.mytree=new o(this.TreeBody);h=this;this.selfCloseNode=function(e){e.parentNode.removeChild(e),"function"==typeof c&&c()},this.mytree.setFunctionCh2(function(){if(r){r.innerHTML="";var e;for(e in this.checkedTops){var t=document.createElement("DIV");t.className="btn btn-default btn-sm posit-rel",t.onclick=function(){h.selfCloseNode(this)};var n=document.createElement("input");n.type="hidden",n.name=a?"caftuya["+h.src_id+"][]["+e+"]":"cattuya["+h.src_id+"]["+e+"]",n.value=e,t.appendChild(n),t.appendChild(document.createTextNode(this.checkedTops[e]));var o=document.createElement("li");o.appendChild(t),o.onclick=function(){h.selfCloseNode(this)},r.appendChild(o)}"function"==typeof s&&s()}}),this.rootId=90401;var h=this;if(this.searchButton.onclick=function(){var e={name:h.searchInput.value};h.mytree.openSearch(e)},this.searchInput.onkeyup=function(e){if(13==(e=e||window.event).keyCode){var t={name:h.searchInput.value};return h.mytree.openSearch(t),!1}},i.length){l={psg:i};this.mytree.openInd(l)}else{var l={id:[this.rootId]};this.mytree.openStart(l)}}var o=e("./../models/nexttree");t.exports=r,window.ContextCategory=r},{"./../models/nexttree":3}]},{},[4]);