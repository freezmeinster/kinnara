/* This compressed file is part of Xinha. For uncompressed sources, forum, and bug reports, go to xinha.org */
Opera._pluginInfo={name:"Opera",origin:"Xinha Core",version:"$LastChangedRevision: 1084 $".replace(/^[^:]*:\s*(.*)\s*\$$/,"$1"),developer:"The Xinha Core Developer Team",developer_url:"$HeadURL: http://svn.xinha.org/trunk/modules/Opera/Opera.js $".replace(/^[^:]*:\s*(.*)\s*\$$/,"$1"),sponsor:"Gogo Internet Services Limited",sponsor_url:"http://www.gogo.co.nz/",license:"htmlArea"};function Opera(a){this.editor=a;a.Opera=this}Opera.prototype.onKeyPress=function(t){var f=this.editor;var j=f.getSelection();if(f.isShortCut(t)){switch(f.getKey(t).toLowerCase()){case"z":if(f._unLink&&f._unlinkOnUndo){Xinha._stopEvent(t);f._unLink();f.updateToolbar();return true}break;case"a":sel=f.getSelection();sel.removeAllRanges();range=f.createRange();range.selectNodeContents(f._doc.body);sel.addRange(range);Xinha._stopEvent(t);return true;break;case"v":if(!f.config.htmlareaPaste){return true}break}}switch(f.getKey(t)){case" ":var e=function(y,m){var x=y.nextSibling;if(typeof m=="string"){m=f._doc.createElement(m)}var s=y.parentNode.insertBefore(m,x);Xinha.removeFromParent(y);s.appendChild(y);x.data=" "+x.data;j.collapse(x,1);f._unLink=function(){var a=s.firstChild;s.removeChild(a);s.parentNode.insertBefore(a,s);Xinha.removeFromParent(s);f._unLink=null;f._unlinkOnUndo=false};f._unlinkOnUndo=true;return s};if(f.config.convertUrlsToLinks&&j&&j.isCollapsed&&j.anchorNode.nodeType==3&&j.anchorNode.data.length>3&&j.anchorNode.data.indexOf(".")>=0){var n=j.anchorNode.data.substring(0,j.anchorOffset).search(/\S{4,}$/);if(n==-1){break}if(f._getFirstAncestor(j,"a")){break}var h=j.anchorNode.data.substring(0,j.anchorOffset).replace(/^.*?(\S*)$/,"$1");var d=h.match(Xinha.RE_email);if(d){var k=j.anchorNode;var c=k.splitText(j.anchorOffset);var w=k.splitText(n);e(w,"a").href="mailto:"+d[0];break}RE_date=/([0-9]+\.)+/;RE_ip=/(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)/;var o=h.match(Xinha.RE_url);if(o){if(RE_date.test(h)){break}var g=j.anchorNode;var b=g.splitText(j.anchorOffset);var q=g.splitText(n);e(q,"a").href=(o[1]?o[1]:"http://")+o[2];break}}break}switch(t.keyCode){case 27:if(f._unLink){f._unLink();Xinha._stopEvent(t)}break;break;case 8:case 46:if(!t.shiftKey&&this.handleBackspace()){Xinha._stopEvent(t)}default:f._unlinkOnUndo=false;if(j.anchorNode&&j.anchorNode.nodeType==3){var v=f._getFirstAncestor(j,"a");if(!v){break}if(!v._updateAnchTimeout){if(j.anchorNode.data.match(Xinha.RE_email)&&v.href.match("mailto:"+j.anchorNode.data.trim())){var u=j.anchorNode;var i=function(){v.href="mailto:"+u.data.trim();v._updateAnchTimeout=setTimeout(i,250)};v._updateAnchTimeout=setTimeout(i,1000);break}var l=j.anchorNode.data.match(Xinha.RE_url);if(l&&v.href.match(new RegExp("http(s)?://"+Xinha.escapeStringForRegExp(j.anchorNode.data.trim())))){var p=j.anchorNode;var r=function(){l=p.data.match(Xinha.RE_url);if(l){v.href=(l[1]?l[1]:"http://")+l[2]}v._updateAnchTimeout=setTimeout(r,250)};v._updateAnchTimeout=setTimeout(r,1000)}}}break}return false};Opera.prototype.handleBackspace=function(){var a=this.editor;setTimeout(function(){var e=a.getSelection();var g=a.createRange(e);var f=g.startContainer;var i=g.startOffset;var c=g.endContainer;var h=g.endOffset;var j=f.nextSibling;if(f.nodeType==3){f=f.parentNode}if(!(/\S/.test(f.tagName))){var d=document.createElement("p");while(f.firstChild){d.appendChild(f.firstChild)}f.parentNode.insertBefore(d,f);Xinha.removeFromParent(f);var b=g.cloneRange();b.setStartBefore(j);b.setEndAfter(j);b.extractContents();e.removeAllRanges();e.addRange(b)}},10)};Opera.prototype.inwardHtml=function(a){a=a.replace(/<(\/?)del(\s|>|\/)/ig,"<$1strike$2");return a};Opera.prototype.outwardHtml=function(a){return a};Opera.prototype.onExecCommand=function(g,e,f){switch(g){case"removeformat":var c=this.editor;var d=c.getSelection();var l=c.saveSelection(d);var k=c.createRange(d);var h=c._doc.body.getElementsByTagName("*");var a=(k.startContainer.nodeType==1)?k.startContainer:k.startContainer.parentNode;var j,b;if(d.isCollapsed){k.selectNodeContents(c._doc.body)}for(j=0;j<h.length;j++){b=h[j];if(k.isPointInRange(b,0)||(h[j]==a&&k.startOffset==0)){b.removeAttribute("style")}}this.editor._doc.execCommand(g,e,f);c.restoreSelection(l);return true;break}return false};Opera.prototype.onMouseDown=function(a){};Xinha.prototype.insertNodeAtSelection=function(b){if(b.ownerDocument!=this._doc){try{b=this._doc.adoptNode(b)}catch(f){}}this.focusEditor();var d=this.getSelection();var a=this.createRange(d);a.deleteContents();var c=a.startContainer;var h=a.startOffset;var g=b;d.removeAllRanges();switch(c.nodeType){case 3:if(b.nodeType==3){c.insertData(h,b.data);a=this.createRange();a.setEnd(c,h+b.length);a.setStart(c,h+b.length);d.addRange(a)}else{c=c.splitText(h);if(b.nodeType==11){g=g.firstChild}c.parentNode.insertBefore(b,c);this.selectNodeContents(g);this.updateToolbar()}break;case 1:if(b.nodeType==11){g=g.firstChild}c.insertBefore(b,c.childNodes[h]);this.selectNodeContents(g);this.updateToolbar();break}};Xinha.prototype.getParentElement=function(c){if(typeof c=="undefined"){c=this.getSelection()}var a=this.createRange(c);try{var d=a.commonAncestorContainer;if(!a.collapsed&&a.startContainer==a.endContainer&&a.startOffset-a.endOffset<=1&&a.startContainer.hasChildNodes()){d=a.startContainer.childNodes[a.startOffset]}while(d.nodeType==3){d=d.parentNode}return d}catch(b){return null}};Xinha.prototype.activeElement=function(a){if((a===null)||this.selectionEmpty(a)){return null}if(!a.isCollapsed){if(a.anchorNode.childNodes.length>a.anchorOffset&&a.anchorNode.childNodes[a.anchorOffset].nodeType==1){return a.anchorNode.childNodes[a.anchorOffset]}else{if(a.anchorNode.nodeType==1){return a.anchorNode}else{return null}}}return null};Xinha.prototype.selectionEmpty=function(a){if(!a){return true}if(typeof a.isCollapsed!="undefined"){return a.isCollapsed}return true};Xinha.prototype.saveSelection=function(){return this.createRange(this.getSelection()).cloneRange()};Xinha.prototype.restoreSelection=function(b){var a=this.getSelection();a.removeAllRanges();a.addRange(b)};Xinha.prototype.selectNodeContents=function(c,a){this.focusEditor();this.forceRedraw();var b;var e=typeof a=="undefined"?true:false;var d=this.getSelection();b=this._doc.createRange();if(e&&c.tagName&&c.tagName.toLowerCase().match(/table|img|input|textarea|select/)){b.selectNode(c)}else{b.selectNodeContents(c)}d.removeAllRanges();d.addRange(b);if(typeof a!="undefined"){if(a){d.collapse(b.startContainer,b.startOffset)}else{d.collapse(b.endContainer,b.endOffset)}}};Xinha.prototype.insertHTML=function(c){var e=this.getSelection();var a=this.createRange(e);this.focusEditor();var b=this._doc.createDocumentFragment();var f=this._doc.createElement("div");f.innerHTML=c;while(f.firstChild){b.appendChild(f.firstChild)}var d=this.insertNodeAtSelection(b)};Xinha.prototype.getSelectedHTML=function(){var b=this.getSelection();if(b.isCollapsed){return""}var a=this.createRange(b);return Xinha.getHTML(a.cloneContents(),false,this)};Xinha.prototype.getSelection=function(){var c=this._iframe.contentWindow.getSelection();if(c&&c.focusNode&&c.focusNode.tagName&&c.focusNode.tagName=="HTML"){var b=this._doc.getElementsByTagName("body")[0];var a=this.createRange();a.selectNodeContents(b);c.removeAllRanges();c.addRange(a);c.collapseToEnd()}return c};Xinha.prototype.createRange=function(b){this.activateEditor();if(typeof b!="undefined"){try{return b.getRangeAt(0)}catch(a){return this._doc.createRange()}}else{return this._doc.createRange()}};Xinha.prototype.isKeyEvent=function(a){return a.type=="keypress"};Xinha.prototype.getKey=function(a){return String.fromCharCode(a.charCode)};Xinha.getOuterHTML=function(a){return(new XMLSerializer()).serializeToString(a)};Xinha.cc=String.fromCharCode(8286);Xinha.prototype.setCC=function(c){var f=Xinha.cc;try{if(c=="textarea"){var h=this._textArea;var i=h.selectionStart;var k=h.value.substring(0,i);var b=h.value.substring(i,h.value.length);if(b.match(/^[^<]*>/)){var a=b.indexOf(">")+1;h.value=k+b.substring(0,a)+f+b.substring(a,b.length)}else{h.value=k+f+b}h.value=h.value.replace(new RegExp("(&[^"+f+"]*?)("+f+")([^"+f+"]*?;)"),"$1$3$2");h.value=h.value.replace(new RegExp("(<script[^>]*>[^"+f+"]*?)("+f+")([^"+f+"]*?<\/script>)"),"$1$3$2");h.value=h.value.replace(new RegExp("^([^"+f+"]*)("+f+")([^"+f+"]*<body[^>]*>)(.*?)"),"$1$3$2$4");h.value=h.value.replace(f,'<span id="XinhaOperaCaretMarker">MARK</span>')}else{var d=this.getSelection();var g=this._doc.createElement("span");g.id="XinhaOperaCaretMarker";d.getRangeAt(0).insertNode(g)}}catch(j){}};Xinha.prototype.findCC=function(c){if(c=="textarea"){var i=this._textArea;var j=i.value.search(/(<span\s+id="XinhaOperaCaretMarker"\s*\/?>((\s|(MARK))*<\/span>)?)/);if(j==-1){return}var f=RegExp.$1;var h=j+f.length;var k=i.value.substring(0,j);var b=i.value.substring(h,i.value.length);i.value=k;i.scrollTop=i.scrollHeight;var e=i.scrollTop;i.value+=b;i.setSelectionRange(j,j);i.focus();i.scrollTop=e}else{var g=this._doc.getElementById("XinhaOperaCaretMarker");if(g){this.focusEditor();var a=this.createRange();a.selectNode(g);var d=this.getSelection();d.addRange(a);d.collapseToStart();this.scrollToElement(g);g.parentNode.removeChild(g);return}}};Xinha.getDoctype=function(a){var b="";if(a.doctype){b+="<!DOCTYPE "+a.doctype.name+" PUBLIC ";b+=a.doctype.publicId?'"'+a.doctype.publicId+'"':"";b+=a.doctype.systemId?' "'+a.doctype.systemId+'"':"";b+=">"}return b};Xinha.prototype._standardInitIframe=Xinha.prototype.initIframe;Xinha.prototype.initIframe=function(){if(!this._iframeLoadDone){if(this._iframe.contentWindow&&this._iframe.contentWindow.xinhaReadyToRoll){this._iframeLoadDone=true;this._standardInitIframe()}else{var a=this;setTimeout(function(){a.initIframe()},5)}}};Xinha._addEventOperaOrig=Xinha._addEvent;Xinha._addEvent=function(b,a,c){if(b.tagName&&b.tagName.toLowerCase()=="select"&&a=="change"){return Xinha.addDom0Event(b,a,c)}return Xinha._addEventOperaOrig(b,a,c)};