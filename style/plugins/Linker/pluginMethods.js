/* This compressed file is part of Xinha. For uncompressed sources, forum, and bug reports, go to xinha.org */
Linker.prototype._createLink=function(o){if(!this._dialog){this._dialog=new Linker.Dialog(this)}if(!o&&this.editor.selectionEmpty(this.editor.getSelection())){alert(this._lc("You must select some text before making a new link."));return false}var c={type:"url",href:"http://www.example.com/",target:"",p_width:"",p_height:"",p_options:["menubar=no","toolbar=yes","location=no","status=no","scrollbars=yes","resizeable=yes"],to:"alice@example.com",subject:"",body:"",anchor:""};if(o&&o.tagName.toLowerCase()=="a"){var b=this.editor.fixRelativeLinks(o.getAttribute("href"));var e=b.match(/^mailto:(.*@[^?&]*)(\?(.*))?$/);var g=b.match(/^#(.*)$/);if(e){c.type="mailto";c.to=e[1];if(e[3]){var l=e[3].split("&");for(var n=0;n<l.length;n++){var h=l[n].match(/(subject|body)=(.*)/);if(h){c[h[1]]=decodeURIComponent(h[2])}}}}else{if(g){c.type="anchor";c.anchor=g[1]}else{if(o.getAttribute("onclick")){var e=o.getAttribute("onclick").match(/window\.open\(\s*this\.href\s*,\s*'([a-z0-9_]*)'\s*,\s*'([a-z0-9_=,]*)'\s*\)/i);c.href=b?b:"";c.target="popup";c.p_name=e[1];c.p_options=[];var l=e[2].split(",");for(var n=0;n<l.length;n++){var k=l[n].match(/(width|height)=([0-9]+)/);if(k){c["p_"+k[1]]=parseInt(k[2])}else{c.p_options.push(l[n])}}}else{c.href=b;c.target=o.target}}}}var d=this;this.a=o;var f=function(){var v=d.a;var x=d._dialog.hide();var w={href:"",target:"",title:"",onclick:""};if(x.type=="url"){if(x.href){w.href=x.href.trim();w.target=x.target;if(x.target=="popup"){if(x.p_width){x.p_options.push("width="+x.p_width)}if(x.p_height){x.p_options.push("height="+x.p_height)}w.onclick="if(window.parent && window.parent.Xinha){return false}window.open(this.href, '"+(x.p_name.replace(/[^a-z0-9_]/i,"_"))+"', '"+x.p_options.join(",")+"');return false;"}}}else{if(x.type=="anchor"){if(x.anchor){w.href=x.anchor.value}}else{if(x.to){w.href="mailto:"+x.to;if(x.subject){w.href+="?subject="+encodeURIComponent(x.subject)}if(x.body){w.href+=(x.subject?"&":"?")+"body="+encodeURIComponent(x.body)}}}}if(w.href){w.href=w.href.trim()}if(v&&v.tagName.toLowerCase()=="a"){if(!w.href){if(confirm(d._dialog._lc("Are you sure you wish to remove this link?"))){var m=v.parentNode;while(v.hasChildNodes()){m.insertBefore(v.removeChild(v.childNodes[0]),v)}m.removeChild(v);d.editor.updateToolbar();return}}else{for(var t in w){v.setAttribute(t,w[t])}if(Xinha.is_ie){if(/mailto:([^?<>]*)(\?[^<]*)?$/i.test(v.innerHTML)){v.innerHTML=RegExp.$1}}}}else{if(!w.href){return true}var s=Xinha.uniq("http://www.example.com/Link");d.editor._doc.execCommand("createlink",false,s);var u=d.editor._doc.getElementsByTagName("a");for(var t=0;t<u.length;t++){var q=u[t];if(q.href==s){if(!v){v=q}for(var r in w){q.setAttribute(r,w[r])}}}}d.editor.selectNodeContents(v);d.editor.updateToolbar()};this._dialog.show(c,f)};Linker.prototype._getSelectedAnchor=function(){var d=this.editor.getSelection();var c=this.editor.createRange(d);var b=this.editor.activeElement(d);if(b!=null&&b.tagName.toLowerCase()=="a"){return b}else{b=this.editor._getFirstAncestor(d,"a");if(b!=null){return b}}return null};Linker.Dialog_dTrees=[];Linker.Dialog=function(a){var b=this;this.Dialog_nxtid=0;this.linker=a;this.id={};this.ready=false;this.dialog=false;this._prepareDialog()};Linker.Dialog.prototype._prepareDialog=function(){var lDialog=this;var linker=this.linker;var files=this.linker.files;if(!linker.lConfig.dialog&&Xinha.Dialog){linker.lConfig.dialog=Xinha.Dialog}var dialog=this.dialog=new linker.lConfig.dialog(linker.editor,Linker.html,"Linker",{width:600,height:400});var dTreeName=Xinha.uniq("dTree_");this.dTree=new dTree(dTreeName,Xinha.getPluginDir("Linker")+"/dTree/");eval(dTreeName+" = this.dTree");this.dTree.add(this.Dialog_nxtid++,-1,linker.lConfig.treeCaption,null,linker.lConfig.treeCaption);this.makeNodes(files,0);var ddTree=this.dialog.getElementById("dTree");ddTree.innerHTML="";ddTree.style.overflow="auto";ddTree.style.height="300px";if(Xinha.is_ie){ddTree.style.styleFloat="left"}else{ddTree.style.cssFloat="left"}ddTree.style.backgroundColor="white";this.ddTree=ddTree;this.dTree._linker_premade=this.dTree.toString();var options=this.dialog.getElementById("options");options.style.width=320+"px";options.style.overflow="auto";this.dialog.rootElem.style.paddingBottom="0";this.dialog.onresize=function(){var h=parseInt(dialog.height)-dialog.getElementById("h1").offsetHeight;var w=parseInt(dialog.width)-330;if(w<0){w=0}if(h<0){h=0}lDialog.ddTree.style.height=h+"px";lDialog.ddTree.style.width=w+"px"};var self=this;this.dialog.getElementById("type_url").onclick=function(){self.showOptionsForType("url")};this.dialog.getElementById("type_mailto").onclick=function(){self.showOptionsForType("mailto")};this.dialog.getElementById("type_anchor").onclick=function(){self.showOptionsForType("anchor")};var hidePopupOptions=function(){self.showOptionsForTarget("none")};this.dialog.getElementById("noTargetRadio").onclick=hidePopupOptions;this.dialog.getElementById("sameWindowRadio").onclick=hidePopupOptions;this.dialog.getElementById("newWindowRadio").onclick=hidePopupOptions;this.dialog.getElementById("popupWindowRadio").onclick=function(){self.showOptionsForTarget("popup")};this.ready=true;ddTree=null;Xinha.freeLater(lDialog,"ddTree");options=null};Linker.Dialog.prototype.makeNodes=function(d,a){for(var b=0;b<d.length;b++){if(typeof d[b]=="string"){this.dTree.add(this.Dialog_nxtid++,a,d[b].replace(/^.*\//,""),"javascript:document.getElementsByName('"+this.dialog.id.href+"')[0].value=decodeURIComponent('"+encodeURIComponent(d[b])+"');document.getElementsByName('"+this.dialog.id.type+"')[0].click();document.getElementsByName('"+this.dialog.id.href+"')[0].focus();void(0);",d[b])}else{if(typeof d[b]=="object"&&d[b]&&typeof d[b].length==="number"){var f=this.Dialog_nxtid++;this.dTree.add(f,a,d[b][0].replace(/^.*\//,""),null,d[b][0]);this.makeNodes(d[b][1],f)}else{if(typeof d[b]=="object"){var f=this.Dialog_nxtid++;if(d[b].title){var e=d[b].title}else{if(d[b].url){var e=d[b].url.replace(/^.*\//,"")}else{var e="no title defined"}}if(d[b].url){var c="javascript:document.getElementsByName('"+this.dialog.id.href+"')[0].value=decodeURIComponent('"+encodeURIComponent(d[b].url)+"');document.getElementsByName('"+this.dialog.id.type+"')[0].click();document.getElementsByName('"+this.dialog.id.href+"')[0].focus();void(0);"}else{var c=""}this.dTree.add(f,a,e,c,e);if(d[b].children){this.makeNodes(d[b].children,f)}}}}}};Linker.Dialog.prototype._lc=Linker.prototype._lc;Linker.Dialog.prototype.show=function(e,q,r){if(!this.ready){var h=this;window.setTimeout(function(){h.show(e,q,r)},100);return}if(this.ddTree.innerHTML==""){this.ddTree.innerHTML=this.dTree._linker_premade}if(!this.linker.lConfig.canSetTarget){this.dialog.getElementById("target_options").style.display="none"}this.showOptionsForType(e.type);this.showOptionsForTarget(e.target);var g=this.dialog.getElementById("anchor");for(var k=g.length;k>=0;k--){g[k]=null}var l=this.linker.editor.getHTML();var o=new Array();var f=l.match(/<a[^>]+name="([^"]+)"/gi);if(f){for(k=0;k<f.length;k++){var d=f[k].match(/name="([^"]+)"/i);if(!o.contains(d[1])){o.push(d[1])}}}f=l.match(/id="([^"]+)"/gi);if(f){for(k=0;k<f.length;k++){d=f[k].match(/id="([^"]+)"/i);if(!o.contains(d[1])){o.push(d[1])}}}for(k=0;k<o.length;k++){var c=new Option(o[k],"#"+o[k],false,(e.anchor==o[k]));g[g.length]=c}if(this.linker.lConfig.disableMailto){this.dialog.getElementById("mailtofieldset").style.display="none"}if(g.length==0||this.linker.lConfig.disableAnchors){this.dialog.getElementById("anchorfieldset").style.display="none";if(this.linker.lConfig.disableMailto){this.dialog.getElementById("type").style.display="none"}}var a=this.linker.lConfig.disableTargetTypes;if(typeof a=="undefined"){a=[]}else{if(typeof a=="string"){a=[a]}}for(var k=0;k<a.length;k++){this.dialog.getElementById(a[k]).style.display="none"}if(a.length==3){if(a.contains("popupWindow")){this.dialog.getElementById("target_options").style.display="none"}else{this.dialog.getElementById("popupWindowRadio").style.display="none";this.showOptionsForTarget("popup")}}var p=new Array();if(!a.contains("noTarget")){p.push("noTargetRadio")}if(!a.contains("sameWindow")){p.push("sameWindowRadio")}if(!a.contains("newWindow")){p.push("newWindowRadio")}if(!a.contains("popupWindow")){p.push("popupWindowRadio")}if(e.href=="http://www.example.com/"&&e.to=="alice@example.com"){this.dialog.getElementById("clear").style.display="none"}else{var s=this.dialog.getElementById("clear");s.style.display="";if(q){s.onclick=function(){h.removeLink(q)}}}if(!this.linker.lConfig.canRemoveLink){this.dialog.getElementById("clear").style.display="none"}var b=this.dialog;var h=this;if(q){this.dialog.getElementById("ok").onclick=q}else{this.dialog.getElementById("ok").onclick=function(){h.hide()}}if(r){this.dialog.getElementById("cancel").onclick=r}else{this.dialog.getElementById("cancel").onclick=function(){h.hide()}}this.linker.editor.disableToolbar(["fullscreen","linker"]);this.dialog.show(e);var j=false;for(var k=0;k<p.length;k++){if(this.dialog.getElementById(p[k]).checked==true){j=true;break}}if(!j&&p.length>0){this.dialog.getElementById(p[0]).checked=true}this.dialog.onresize()};Linker.Dialog.prototype.hide=function(){this.linker.editor.enableToolbar();return this.dialog.hide()};Linker.Dialog.prototype.removeLink=function(a){this.dialog.getElementById("href").value="";this.dialog.getElementById("to").value="";return a()};Linker.Dialog.prototype.showOptionsForType=function(b){var c=this.dialog.getElementById("urltable");var d=this.dialog.getElementById("mailtable");var a=this.dialog.getElementById("anchortable");if(b=="anchor"){a.style.display="";c.style.display="none";d.style.display="none"}else{if(b=="mailto"){d.style.display="";c.style.display="none";a.style.display="none"}else{c.style.display="";d.style.display="none";a.style.display="none"}}};Linker.Dialog.prototype.showOptionsForTarget=function(b){var a=this.dialog.getElementById("popuptable");a.style.display=b=="popup"?"":"none"};