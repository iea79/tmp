/* jQuery Select Styler v1.5.4  */
!function(e){e.fn.styler=function(t){var s=e.extend({wrapper:"form",idSuffix:"-styler",filePlaceholder:"u0424u0430u0439u043b u043du0435 u0432u044bu0431u0440u0430u043d",fileBrowse:"u041eu0431u0437u043eu0440...",selectSearch:!0,selectSearchLimit:10,selectSearchNotFound:"u0421u043eu0432u043fu0430u0434u0435u043du0438u0439 u043du0435 u043du0430u0439u0434u0435u043du043e",selectSearchPlaceholder:"u041fu043eu0438u0441u043a...",selectVisibleOptions:0,singleSelectzIndex:"100",selectSmartPositioning:!0,onSelectOpened:function(){},onSelectClosed:function(){},onFormStyled:function(){}},t);return this.each(function(){function t(){var e="",t="",i="",o="";void 0!==l.attr("id")&&""!==l.attr("id")&&(e=' id="'+l.attr("id")+s.idSuffix+'"'),void 0!==l.attr("title")&&""!==l.attr("title")&&(t=' title="'+l.attr("title")+'"'),void 0!==l.attr("class")&&""!==l.attr("class")&&(i=" "+l.attr("class"));for(var c=l.data(),a=0;a<c.length;a++)""!==c[a]&&(o+=" data-"+a+'="'+c[a]+'"');this.id=e+o,this.title=t,this.classes=i}var l=e(this);l.is("select")?l.each(function(){if(1>l.parent("div.jqselect").length){var o=function(){function o(t){t.off("mousewheel DOMMouseScroll").on("mousewheel DOMMouseScroll",function(t){var s=null;"mousewheel"==t.type?s=-1*t.originalEvent.wheelDelta:"DOMMouseScroll"==t.type&&(s=40*t.originalEvent.detail),s&&(t.stopPropagation(),t.preventDefault(),e(this).scrollTop(s+e(this).scrollTop()))})}function c(){for(i=0,len=d.length;len>i;i++){var e="",t="",s=e="",l="",o="";d.eq(i).prop("selected")&&(t="selected sel"),d.eq(i).is(":disabled")&&(t="disabled"),d.eq(i).is(":selected:disabled")&&(t="selected sel disabled"),void 0!==d.eq(i).attr("class")&&(s=" "+d.eq(i).attr("class"),o=' data-jqfs-class="'+d.eq(i).attr("class")+'"');var c,a=d.eq(i).data();for(c in a)""!==a[c]&&(e+=" data-"+c+'="'+a[c]+'"');e="<li"+o+e+' class="'+t+s+'">'+d.eq(i).text()+"</li>",d.eq(i).parent().is("optgroup")&&(void 0!==d.eq(i).parent().attr("class")&&(l=" "+d.eq(i).parent().attr("class")),e="<li"+o+' class="'+t+s+" option"+l+'">'+d.eq(i).text()+"</li>",d.eq(i).is(":first-child")&&(e='<li class="optgroup'+l+'">'+d.eq(i).parent().attr("label")+"</li>"+e)),r+=e}}function a(){var i=new t,a=e("<div"+i.id+' class="jq-selectbox jqselect'+i.classes+'" style="display: inline-block; position: relative; z-index:'+s.singleSelectzIndex+'"><div class="jq-selectbox__select"'+i.title+' style="position: relative"><div class="jq-selectbox__select-text"></div><div class="jq-selectbox__trigger"><div class="jq-selectbox__trigger-arrow"></div></div></div></div>');l.css({margin:0,padding:0}).after(a).prependTo(a);var i=e("div.jq-selectbox__select",a),n=e("div.jq-selectbox__select-text",a),h=d.filter(":selected");n.html(h.length?h.text():d.first().text()),c();var u="";s.selectSearch&&(u='<div class="jq-selectbox__search"><input type="search" autocomplete="off" placeholder="'+s.selectSearchPlaceholder+'"></div><div class="jq-selectbox__not-found">'+s.selectSearchNotFound+"</div>");var f=e('<div class="jq-selectbox__dropdown" style="position: absolute">'+u+'<ul style="position: relative; list-style: none; overflow: auto; overflow-x: hidden">'+r+"</ul></div>");a.append(f);var p=e("ul",f),v=e("li",f),g=e("input",f),m=e("div.jq-selectbox__not-found",f).hide();v.length<s.selectSearchLimit&&g.parent().hide();var x=0,b=0;v.each(function(){var t=e(this);t.css({display:"inline-block","white-space":"nowrap"}),t.innerWidth()>x&&(x=t.innerWidth(),b=t.width()),t.css({display:"block"})});var u=a.clone().appendTo("body").width("auto"),w=u.width();u.remove(),w==a.width()&&(n.width(b),x+=a.find("div.jq-selectbox__trigger").width()),x>a.width()&&f.width(x),l.css({position:"absolute",left:0,top:0,width:"100%",height:"100%",opacity:0});var q=a.outerHeight(),C=g.outerHeight(),y=p.css("max-height"),u=v.filter(".selected");1>u.length&&v.first().addClass("selected sel"),void 0===v.data("li-height")&&v.data("li-height",v.outerHeight());var j=f.css("top");return"auto"==f.css("left")&&f.css({left:0}),"auto"==f.css("top")&&f.css({top:q}),f.hide(),u.length&&(d.first().text()!=h.text()&&a.addClass("changed"),a.data("jqfs-class",u.data("jqfs-class")),a.addClass(u.data("jqfs-class"))),l.is(":disabled")?(a.addClass("disabled"),!1):(i.click(function(){if(e("div.jq-selectbox").filter(".opened").length&&s.onSelectClosed.call(e("div.jq-selectbox").filter(".opened")),l.focus(),!navigator.userAgent.match(/(iPad|iPhone|iPod)/g)){var t=e(window),i=v.data("li-height"),c=a.offset().top,n=t.height()-q-(c-t.scrollTop()),d=s.selectVisibleOptions,r=5*i,h=i*d;d>0&&6>d&&(r=h),0===d&&(h="auto");var d=function(){f.height("auto").css({bottom:"auto",top:j});var e=function(){p.css("max-height",Math.floor((n-20-C)/i)*i)};e(),p.css("max-height",h),"none"!=y&&p.css("max-height",y),n<f.outerHeight()+20&&e()},u=function(){f.height("auto").css({top:"auto",bottom:j});var e=function(){p.css("max-height",Math.floor((c-t.scrollTop()-20-C)/i)*i)};e(),p.css("max-height",h),"none"!=y&&p.css("max-height",y),c-t.scrollTop()-20<f.outerHeight()+20&&e()};return!0===s.selectSmartPositioning?n>r+C+20?d():u():!1===s.selectSmartPositioning&&n>r+C+20&&d(),e("div.jqselect").css({zIndex:s.singleSelectzIndex-1}).removeClass("opened"),a.css({zIndex:s.singleSelectzIndex}),f.is(":hidden")?(e("div.jq-selectbox__dropdown:visible").hide(),f.show(),a.addClass("opened focused"),s.onSelectOpened.call(a)):(f.hide(),a.removeClass("opened"),e("div.jq-selectbox").filter(".opened").length&&s.onSelectClosed.call(a)),v.filter(".selected").length&&(0!==p.innerHeight()/i%2&&(i/=2),p.scrollTop(p.scrollTop()+v.filter(".selected").position().top-p.innerHeight()/2+i)),g.length&&(g.val("").keyup(),m.hide(),g.keyup(function(){var t=e(this).val();v.each(function(){e(this).html().match(RegExp(".*?"+t+".*?","i"))?e(this).show():e(this).hide()}),1>v.filter(":visible").length?m.show():m.hide()})),o(p),!1}}),v.hover(function(){e(this).siblings().removeClass("selected")}),v.filter(".selected").text(),v.filter(".selected").text(),v.filter(":not(.disabled):not(.optgroup)").click(function(){l.focus();var t=e(this),i=t.text();if(!t.is(".selected")){var o=t.index(),o=o-t.prevAll(".optgroup").length;t.addClass("selected sel").siblings().removeClass("selected sel"),d.prop("selected",!1).eq(o).prop("selected",!0),n.html(i),a.data("jqfs-class")&&a.removeClass(a.data("jqfs-class")),a.data("jqfs-class",t.data("jqfs-class")),a.addClass(t.data("jqfs-class")),l.change()}g.length&&(g.val("").keyup(),m.hide()),f.hide(),a.removeClass("opened"),s.onSelectClosed.call(a)}),f.mouseout(function(){e("li.sel",f).addClass("selected")}),l.on("change.styler",function(){n.html(d.filter(":selected").text()),v.removeClass("selected sel").not(".optgroup").eq(l[0].selectedIndex).addClass("selected sel"),d.first().text()!=v.filter(".selected").text()?a.addClass("changed"):a.removeClass("changed")}).on("focus.styler",function(){a.addClass("focused"),e("div.jqselect").not(".focused").removeClass("opened")}).on("blur.styler",function(){a.removeClass("focused")}).on("keydown.styler keyup.styler",function(e){var t=v.data("li-height");n.html(d.filter(":selected").text()),v.removeClass("selected sel").not(".optgroup").eq(l[0].selectedIndex).addClass("selected sel"),38!=e.which&&37!=e.which&&33!=e.which&&36!=e.which||p.scrollTop(p.scrollTop()+v.filter(".selected").position().top),40!=e.which&&39!=e.which&&34!=e.which&&35!=e.which||p.scrollTop(p.scrollTop()+v.filter(".selected").position().top-p.innerHeight()+t),32==e.which&&e.preventDefault(),13==e.which&&(e.preventDefault(),f.hide(),a.removeClass("opened"),s.onSelectClosed.call(a))}),void e(document).on("click",function(t){e(t.target).parents().hasClass("jq-selectbox")||"OPTION"==t.target.nodeName||(e("div.jq-selectbox").filter(".opened").length&&s.onSelectClosed.call(e("div.jq-selectbox").filter(".opened")),g.length&&g.val("").keyup(),f.hide().find("li.sel").addClass("selected"),a.removeClass("focused opened"))}))}function n(){var s=new t,i=e("<div"+s.id+' class="jq-select-multiple jqselect'+s.classes+'"'+s.title+' style="display: inline-block; position: relative"></div>');l.css({margin:0,padding:0}).after(i),c(),i.append("<ul>"+r+"</ul>");var a=e("ul",i).css({position:"relative","overflow-x":"hidden","-webkit-overflow-scrolling":"touch"}),n=e("li",i).attr("unselectable","on").css({"-webkit-user-select":"none","-moz-user-select":"none","-ms-user-select":"none","-o-user-select":"none","user-select":"none","white-space":"nowrap"}),s=l.attr("size"),h=a.outerHeight(),u=n.outerHeight();a.css(void 0!==s&&s>0?{height:u*s}:{height:4*u}),h>i.height()&&(a.css("overflowY","scroll"),o(a),n.filter(".selected").length&&a.scrollTop(a.scrollTop()+n.filter(".selected").position().top)),l.prependTo(i).css({position:"absolute",left:0,top:0,width:"100%",height:"100%",opacity:0}),l.is(":disabled")?(i.addClass("disabled"),d.each(function(){e(this).is(":selected")&&n.eq(e(this).index()).addClass("selected")})):(n.filter(":not(.disabled):not(.optgroup)").click(function(t){l.focus();var s=e(this);if(t.ctrlKey||t.metaKey||s.addClass("selected"),t.shiftKey||s.addClass("first"),t.ctrlKey||t.metaKey||t.shiftKey||s.siblings().removeClass("selected first"),(t.ctrlKey||t.metaKey)&&(s.is(".selected")?s.removeClass("selected first"):s.addClass("selected first"),s.siblings().removeClass("first")),t.shiftKey){var i=!1,o=!1;s.siblings().removeClass("selected").siblings(".first").addClass("selected"),s.prevAll().each(function(){e(this).is(".first")&&(i=!0)}),s.nextAll().each(function(){e(this).is(".first")&&(o=!0)}),i&&s.prevAll().each(function(){return e(this).is(".selected")?!1:void e(this).not(".disabled, .optgroup").addClass("selected")}),o&&s.nextAll().each(function(){return e(this).is(".selected")?!1:void e(this).not(".disabled, .optgroup").addClass("selected")}),1==n.filter(".selected").length&&s.addClass("first")}d.prop("selected",!1),n.filter(".selected").each(function(){var t=e(this),s=t.index();t.is(".option")&&(s-=t.prevAll(".optgroup").length),d.eq(s).prop("selected",!0)}),l.change()}),d.each(function(t){e(this).data("optionIndex",t)}),l.on("change.styler",function(){n.removeClass("selected");var t=[];d.filter(":selected").each(function(){t.push(e(this).data("optionIndex"))}),n.not(".optgroup").filter(function(s){return-1<e.inArray(s,t)}).addClass("selected")}).on("focus.styler",function(){i.addClass("focused")}).on("blur.styler",function(){i.removeClass("focused")}),h>i.height()&&l.on("keydown.styler",function(e){38!=e.which&&37!=e.which&&33!=e.which||a.scrollTop(a.scrollTop()+n.filter(".selected").position().top-u),40!=e.which&&39!=e.which&&34!=e.which||a.scrollTop(a.scrollTop()+n.filter(".selected:last").position().top-a.innerHeight()+2*u)}))}var d=e("option",l),r="";l.is("[multiple]")?n():a()};o(),l.on("refresh",function(){l.off(".styler").parent().before(l).remove(),o()})}}):l.is(":reset")&&l.on("click",function(){setTimeout(function(){l.closest(s.wrapper).find("input, select").trigger("refresh")},1)})}).promise().done(function(){s.onFormStyled.call()})}}(jQuery);