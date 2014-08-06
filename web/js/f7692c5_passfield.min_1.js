/*! Pass*Field v1.1.8  | (c) 2014 Antelle | https://github.com/antelle/passfield/blob/master/MIT-LICENSE.txt */
!function(a,b,c){"use strict";var d=c.PassField=c.PassField||{};d.Config=d.Config||{},d.Config.locales={en:{lower:!0,msg:{pass:"password",and:"and",showPass:"Show password",hidePass:"Hide password",genPass:"Random password",passTooShort:"password is too short (min. length: {})",noCharType:"password must contain {}",digits:"digits",letters:"letters",letters_up:"letters in UPPER case",symbols:"symbols",inBlackList:"password is in list of top used passwords",passRequired:"password is required",equalTo:"password is equal to login",repeat:"password consists of repeating characters",badChars:"password contains bad characters: “{}”",weakWarn:"weak",invalidPassWarn:"*",weakTitle:"This password is weak",generateMsg:"To generate a strong password, click {} button."}},de:{lower:!1,msg:{pass:"Passwort",and:"und",showPass:"Passwort anzeigen",hidePass:"Passwort verbergen",genPass:"Zufallspasswort",passTooShort:"Passwort ist zu kurz (Mindestlänge: {})",noCharType:"Passwort muss {} enthalten",digits:"Ziffern",letters:"Buchstaben",letters_up:"Buchstaben in GROSSSCHRIFT",symbols:"Symbole",inBlackList:"Passwort steht auf der Liste der beliebtesten Passwörter",passRequired:"Passwort wird benötigt",equalTo:"Passwort ist wie Anmeldung",repeat:"Passwort besteht aus sich wiederholenden Zeichen",badChars:"Passwort enthält ungültige Zeichen: “{}”",weakWarn:"Schwach",invalidPassWarn:"*",weakTitle:"Dieses Passwort ist schwach",generateMsg:"Klicken Sie auf den {}-Button, um ein starkes Passwort zu generieren."}},fr:{lower:!0,msg:{pass:"mot de passe",and:"et",showPass:"Montrer le mot de passe",hidePass:"Cacher le mot de passe",genPass:"Mot de passe aléatoire",passTooShort:"le mot de passe est trop court (min. longueur: {})",noCharType:"le mot de passe doit contenir des {}",digits:"chiffres",letters:"lettres",letters_up:"lettres en MAJUSCULES",symbols:"symboles",inBlackList:"le mot de passe est dans la liste des plus utilisés",passRequired:"le mot de passe est requis",equalTo:"le mot de passe est le même que l'identifiant",repeat:"le mot de passe est une répétition de caractères",badChars:"le mot de passe contient des caractères incorrects: “{}”",weakWarn:"faible",invalidPassWarn:"*",weakTitle:"Ce mot de passe est faible",generateMsg:"Pour créer un mot de passe fort cliquez sur le bouton {}."}},it:{lower:!1,msg:{pass:"password",and:"e",showPass:"Mostra password",hidePass:"Nascondi password",genPass:"Password casuale",passTooShort:"la password è troppo breve (lunghezza min.: {})",noCharType:"la password deve contenere {}",digits:"numeri",letters:"lettere",letters_up:"lettere in MAIUSCOLO",symbols:"simboli",inBlackList:"la password è nella lista delle password più usate",passRequired:"è necessaria una password",equalTo:"la password è uguale al login",repeat:"la password è composta da caratteri che si ripetono",badChars:"la password contiene caratteri non accettati: “{}”",weakWarn:"debole",invalidPassWarn:"*",weakTitle:"Questa password è debole",generateMsg:"Per generare una password forte, clicca sul tasto {}."}},ru:{lower:!0,msg:{pass:"пароль",and:"и",showPass:"Показать пароль",hidePass:"Скрыть пароль",genPass:"Случайный пароль",passTooShort:"пароль слишком короткий (мин. длина: {})",noCharType:"в пароле должны быть {}",digits:"цифры",letters:"буквы",letters_up:"буквы в ВЕРХНЕМ регистре",symbols:"символы",inBlackList:"этот пароль часто используется в Интернете",passRequired:"пароль обязателен",equalTo:"пароль совпадает с логином",repeat:"пароль состоит из повторяющихся символов",badChars:"в пароле есть недопустимые символы: «{}»",weakWarn:"слабый",invalidPassWarn:"*",weakTitle:"Пароль слабый, его легко взломать",generateMsg:"Чтобы сгенерировать пароль, нажмите кнопку {}."}},ua:{lower:!0,msg:{pass:"пароль",and:"i",showPass:"Показати пароль",hidePass:"Сховати пароль",genPass:"Випадковий пароль",passTooShort:"пароль є занадто коротким (мiн. довжина: {})",noCharType:"пароль повинен містити {}",digits:"цифри",letters:"букви",letters_up:"букви у ВЕРХНЬОМУ регістрі",symbols:"cимволи",inBlackList:"пароль входить до списку паролей, що використовуються найчастіше",passRequired:"пароль є обов'язковим",equalTo:"пароль та логін однакові",repeat:"пароль містить повторювані символи",badChars:"пароль містить неприпустимі символи: «{}»",weakWarn:"слабкий",invalidPassWarn:"*",weakTitle:"Цей пароль є слабким",generateMsg:"Щоб ​​створити надійний пароль, натисніть кнопку {}."}},es:{lower:!0,msg:{pass:"contraseña",and:"y",showPass:"Mostrar contraseña",hidePass:"Ocultar contraseña",genPass:"Contraseña aleatoria",passTooShort:"contraseña demasiado corta (longitud mín.: {})",noCharType:"la contraseña debe contener {}",digits:"dígitos",letters:"letras",letters_up:"letras en MAYÚSCULAS",symbols:"símbolos",inBlackList:"la contraseña está en la lista de las contraseñas más usadas",passRequired:"se requiere contraseña",equalTo:"la contraseña es igual al inicio de sesión",repeat:"la contraseña tiene caracteres repetidos",badChars:"la contraseña contiene caracteres no permitidos: “{}”",weakWarn:"débil",invalidPassWarn:"*",weakTitle:"Esta contraseña es débil",generateMsg:"Para generar una contraseña segura, haga clic en el botón de {}."}},el:{lower:!0,msg:{pass:"πρόσβασης",and:"και",showPass:"Προβολή κωδικού πρόσβασης",hidePass:"Απόκρυψη κωδικού πρόσβασης",genPass:"Τυχαίος κωδικός πρόσβασης",passTooShort:"ο κωδικός πρόσβασης είναι πολύ μικρός (ελάχιστο μήκος: {})",noCharType:"ο κωδικός πρόσβασης πρέπει να περιέχει {}",digits:"ψηφία",letters:"λατινικά γράμματα",letters_up:"λατινικά γράμματα με ΚΕΦΑΛΑΙΑ",symbols:"σύμβολα",inBlackList:"ο κωδικός πρόσβασης βρίσκεται σε κατάλογο δημοφιλέστερων κωδικών",passRequired:"απαιτείται κωδικός πρόσβασης",equalTo:"ο κωδικός είναι όμοιος με το όνομα χρήστη",repeat:"ο κωδικός αποτελείται από επαναλαμβανόμενους χαρακτήρες",badChars:"ο κωδικός περιέχει μη επιτρεπτούς χαρακτήρες: “{}”",weakWarn:"αδύναμος",invalidPassWarn:"*",weakTitle:"Αυτός ο κωδικός πρόσβασης είναι αδύναμος",generateMsg:"Για να δημιουργήσετε δυνατό κωδικό πρόσβασης, κάντε κλικ στο κουμπί {}."}},pt:{lower:!0,msg:{pass:"senha",and:"e",showPass:"Mostrar senha",hidePass:"Ocultar senha",genPass:"Senha aleatória",passTooShort:"senha muito curta (tamanho mínimo: {})",noCharType:"Senha deve conter {}",digits:"dígito",letters:"letras",letters_up:"letras maiúsculas",symbols:"símbolos",inBlackList:"senha está na lista das senhas mais usadas",passRequired:"senha é obrigatória",equalTo:"senha igual ao login",repeat:"senha consiste em uma repetição de caracteres",badChars:"senha tem caracteres inválidos: “{}”",weakWarn:"fraca",invalidPassWarn:"*",weakTitle:"Esta senha é fraca",generateMsg:"Para gerar uma senha forte, clique no botão {}."}}}}(window.jQuery,document,window),function(a,b,c,d){"use strict";var e=c.PassField=c.PassField||{};e.CharTypes={DIGIT:"digits",LETTER:"letters",LETTER_UP:"letters_up",SYMBOL:"symbols",UNKNOWN:"unknown"},e.CheckModes={MODERATE:0,STRICT:1},e.Config={defaults:{pattern:"abcdef12",acceptRate:.8,allowEmpty:!0,isMasked:!0,showToggle:!0,showGenerate:!0,showWarn:!0,showTip:!0,tipPopoverStyle:{},strengthCheckTimeout:500,validationCallback:null,blackList:[],locale:"",localeMsg:{},warnMsgClassName:"help-inline",errorWrapClassName:"error",allowAnyChars:!0,checkMode:e.CheckModes.MODERATE,chars:{digits:"1234567890",letters:"abcdefghijklmnopqrstuvwxyzßабвгедёжзийклмнопрстуфхцчшщъыьэюяґєåäâáàãéèêëíìîїóòôõöüúùûýñçøåæþðαβγδεζηθικλμνξοπρσςτυφχψω",letters_up:"ABCDEFGHIJKLMNOPQRSTUVWXYZАБВГЕДЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯҐЄÅÄÂÁÀÃÉÈÊËÍÌÎЇÓÒÔÕÖÜÚÙÛÝÑÇØÅÆÞÐΑΒΓΔΕΖΗΘΙΚΛΜΝΞΟΠΡΣΤΥΦΧΨΩ",symbols:"@#$%^&*()-_=+[]{};:<>/?!"},events:{generated:null,switched:null},nonMatchField:null,length:{min:null,max:null}},locales:e.Config?e.Config.locales:{},blackList:["password","123456","12345678","abc123","qwerty","monkey","letmein","dragon","111111","baseball","iloveyou","trustno1","1234567","sunshine","master","123123","welcome","shadow","ashley","football","jesus","michael","ninja","mustang","password1","p@ssw0rd","miss","root","secret"],generationChars:{digits:"1234567890",letters:"abcdefghijklmnopqrstuvwxyz",letters_up:"ABCDEFGHIJKLMNOPQRSTUVWXYZ"},dataAttr:"PassField.Field"},e.Field=function(g,h){function i(){j(),k()&&(l(),n(),C(),o(),E(),N(Cb.isMasked,!1),Q(),tb(e.Config.dataAttr,this))}function j(){Cb.blackList=(Cb.blackList||[]).concat(e.Config.blackList)}function k(){return"string"==typeof g&&(g=b.getElementById(g)),Bb.mainInput=g,!!Bb.mainInput}function l(){var a="en",b=Cb.locale;!b&&navigator.language&&(b=navigator.language.replace(/\-.*/g,"")),b&&(ub=Ab.locales[b]),ub&&(ub=f.extend({},Ab.locales[a],ub)),ub||(ub=f.extend({},Ab.locales[a])),Cb.localeMsg&&f.extend(ub.msg,Cb.localeMsg)}function m(a){Bb.mainInput.value=a,Bb.clearInput&&(Bb.clearInput.value=a),H()}function n(){vb=Bb.mainInput.id,vb||(vb="i"+Math.round(1e5*Math.random()),Bb.mainInput.id=vb)}function o(){var a=ib(Bb.mainInput);a.top+=lb(Bb.mainInput,"marginTop"),p(),q(),r(),s(),t(),u(),v(a),w(a),x(),setTimeout(y,0)}function p(){Bb.wrapper=Bb.mainInput.parentNode,pb(Bb.wrapper,"wrap"),zb.hasInlineBlock||pb(Bb.wrapper,"wrap-no-ib"),"static"==kb(Bb.wrapper,"position")&&(Bb.wrapper.style.position="relative")}function q(){Cb.length&&Cb.length.max&&Bb.mainInput.setAttribute("maxLength",Cb.length.max.toString())}function r(){if(!zb.changeType){Bb.clearInput=cb("input",{type:"text",id:"txt-clear",className:"txt-clear",value:Bb.mainInput.value},{display:"none"});var a=Bb.mainInput.className;a&&pb(Bb.clearInput,a,!0);var b=Bb.mainInput.style.cssText;b&&(Bb.clearInput.style.cssText=b),f.each(["maxLength","size","placeholder"],function(a){var b=Bb.mainInput.getAttribute(a);b&&Bb.clearInput.setAttribute(a,b)}),mb(Bb.mainInput,Bb.clearInput)}pb(Bb.mainInput,"txt-pass")}function s(){Cb.showWarn&&(Bb.warnMsg=cb("div",{id:"warn",className:"warn"},{margin:"0 0 0 3px"}),Cb.warnMsgClassName&&pb(Bb.warnMsg,Cb.warnMsgClassName,!0),mb(Bb.clearInput||Bb.mainInput,Bb.warnMsg))}function t(){Cb.showToggle&&(Bb.maskBtn=cb("div",{id:"btn-mask",className:"btn-mask",title:ub.msg.showPass},{position:"absolute",margin:"0",padding:"0"}),pb(Bb.maskBtn,"btn"),nb(Bb.maskBtn,"abc"),mb(Bb.mainInput,Bb.maskBtn))}function u(){Cb.showGenerate&&(Bb.genBtn=cb("div",{id:"btn-gen",className:"btn-gen",title:ub.msg.genPass},{position:"absolute",margin:"0",padding:"0"}),pb(Bb.genBtn,"btn"),mb(Bb.mainInput,Bb.genBtn),Bb.genBtnInner=cb("div",{id:"btn-gen-i",className:"btn-gen-i",title:ub.msg.genPass}),Bb.genBtn.appendChild(Bb.genBtnInner))}function v(b){if(Cb.showTip)if(Cb.tipPopoverStyle&&a&&"function"==typeof a.fn.popover)a(Bb.mainInput).popover(f.extend({title:null,placement:Cb.tipPopoverStyle.placement||function(b,d){var e=a(d).position().top-a(c).scrollTop(),f=a(c).height()-e;return f>300||f>e?"bottom":"top"},animation:!1},Cb.tipPopoverStyle,{trigger:"manual",html:!0,content:function(){return Lb}}));else{Bb.tip=cb("div",{id:"tip",className:"tip"},{position:"absolute",margin:"0",padding:"0",width:b.width+"px"}),mb(Bb.mainInput,Bb.tip);var d=cb("div",{id:"tip-arr-wrap",className:"tip-arr-wrap"});Bb.tip.appendChild(d),d.appendChild(cb("div",{id:"tip-arr",className:"tip-arr"})),d.appendChild(cb("div",{id:"tip-arr-in",className:"tip-arr-in"})),Bb.tipBody=cb("div",{id:"tip-body",className:"tip-body"}),Bb.tip.appendChild(Bb.tipBody)}}function w(a){if(zb.placeholders)!Bb.mainInput.getAttribute("placeholder")&&Bb.mainInput.getAttribute("data-placeholder")&&Bb.mainInput.setAttribute("placeholder",Bb.mainInput.getAttribute("data-placeholder"));else{var b=Bb.mainInput.getAttribute("placeholder")||Bb.mainInput.getAttribute("data-placeholder");b&&(Bb.placeholder=cb("div",{id:"placeholder",className:"placeholder"},{position:"absolute",margin:"0",padding:"0",height:a.height+"px",lineHeight:a.height+"px"}),nb(Bb.placeholder,b),mb(Bb.mainInput,Bb.placeholder))}}function x(){zb.passSymbol&&(Bb.passLengthChecker=cb("div",{id:"len"},{position:"absolute",height:kb(Bb.mainInput,"height"),top:"-10000px",left:"-10000px",display:"block",color:"transparent",border:"none"}),mb(Bb.mainInput,Bb.passLengthChecker),setTimeout(function(){f.each(["marginLeft","fontFamily","fontSize","fontWeight","fontStyle","fontVariant"],function(a){var b=kb(Bb.mainInput,a);b&&(Bb.passLengthChecker.style[a]=b)})},50))}function y(){A(),B();var a=ib(D()),b=z();Bb.maskBtn&&"none"!=Bb.maskBtn.style.display&&(b+=lb(Bb.maskBtn,"width"),jb(Bb.maskBtn,{top:a.top,left:a.left+a.width-b,height:a.height})),Bb.genBtn&&"none"!=Bb.genBtn.style.display&&(b+=lb(Bb.genBtn,"width"),jb(Bb.genBtn,{top:a.top,left:a.left+a.width-b,height:a.height}),Bb.genBtnInner.style.marginTop=Math.max(0,Math.round((a.height-19)/2))+"px"),Bb.placeholder&&"none"!=Bb.placeholder.style.display&&jb(Bb.placeholder,{top:a.top,left:a.left+7,height:a.height}),Bb.tip&&"none"!=Bb.tip.style.display&&jb(Bb.tip,{left:a.left,top:a.top+a.height,width:a.width})}function z(){var a=lb(D(),"paddingRight");return Math.max(Ob,a)}function A(){Bb.genBtn&&(Bb.genBtn.style.display=Gb||Hb&&!Ib?"block":"none"),Bb.maskBtn&&(Bb.maskBtn.style.display=Gb||Hb&&!Jb?"block":"none")}function B(){if(Cb.showTip)if(Bb.tip)Bb.tip.style.display=Eb&&Hb?"block":"none";else if(Eb&&Hb){if(!Kb||Lb!=Kb){var b=a(Bb.mainInput).data("popover")||a(Bb.mainInput).data("bs.popover"),c=b.options,d=c.animation;Kb&&(c.animation=!1);var e=D().offsetWidth-2,f=b.$tip;f?f.width(e):b.options.template&&(b.options.template=b.options.template.replace('class="popover"','class="popover" style="width: '+e+'px"')),Bb.clearInput&&(b.$element=a(D())),a(Bb.mainInput).popover("show"),Kb=Lb,c.animation=d}}else Kb&&(Kb=null,a(Bb.mainInput).popover("hide"))}function C(){var a=!0,c=!0,d=b.createElement("input");"placeholder"in d||(a=!1),d.setAttribute("style","position:absolute;left:-10000px;top:-10000px;"),b.body.appendChild(d);try{d.setAttribute("type","password")}catch(e){c=!1}b.body.removeChild(d);var f=b.createElement("div");f.setAttribute("style","display:inline-block"),f.style.paddingLeft=f.style.width="1px",b.body.appendChild(f);var g=2==f.offsetWidth,h="inline-block"===kb(f,"display");b.body.removeChild(f);var i=navigator.userAgent.indexOf("AppleWebKit")>=0||navigator.userAgent.indexOf("Opera")>=0||navigator.userAgent.indexOf("Firefox")>=0&&navigator.platform.indexOf("Mac")>=0?"•":"●";zb={placeholders:a,changeType:c,boxModel:g,hasInlineBlock:h,passSymbol:i}}function D(){return Db?Bb.mainInput:Bb.clearInput||Bb.mainInput}function E(){if(f.each(Bb.clearInput?[Bb.mainInput,Bb.clearInput]:[Bb.mainInput],function(a){f.attachEvent(a,"onkeyup",H),f.attachEvent(a,"onfocus",K),f.attachEvent(a,"onblur",L),f.attachEvent(a,"onmouseover",G),f.attachEvent(a,"onmouseout",G),Bb.placeholder&&f.attachEvent(a,"onkeydown",J)}),f.attachEvent(c,"onresize",y),Bb.maskBtn&&(f.attachEvent(Bb.maskBtn,"onclick",function(){N()}),f.attachEvent(Bb.maskBtn,"onmouseover",G),f.attachEvent(Bb.maskBtn,"onmouseout",G)),Bb.genBtn&&(f.attachEvent(Bb.genBtn,"onclick",function(){R()}),f.attachEvent(Bb.genBtn,"onmouseover",G),f.attachEvent(Bb.genBtn,"onmouseout",G)),Bb.placeholder&&f.attachEvent(Bb.placeholder,"onclick",F),Cb.nonMatchField){var a=ob(Cb.nonMatchField);a&&f.attachEvent(a,"onkeyup",M)}}function F(){D().focus()}function G(a){var b="mouseover"===a.type,c=a.relatedTarget?a.relatedTarget:b?a.fromElement:a.toElement;(!c||!c.id||0!=c.id.indexOf(Mb+"btn")&&c!==Bb.mainInput&&c!==Bb.clearInput)&&(Gb=b,y())}function H(a){var b,c=a?a.which||a.keyCode:null,d=c===Qb||c===Pb;b=Bb.clearInput?Db?Bb.clearInput.value=Bb.mainInput.value:Bb.mainInput.value=Bb.clearInput.value:Bb.mainInput.value,Cb.strengthCheckTimeout>0&&!Eb&&!d?(wb&&clearTimeout(wb),wb=setTimeout(S,Cb.strengthCheckTimeout)):S(),Bb.placeholder&&!b&&(Bb.placeholder.style.display="block"),I()}function I(){if(Bb.passLengthChecker){var a=D().value;Db&&(a=a.replace(/./g,zb.passSymbol)),nb(Bb.passLengthChecker,a);var b=Bb.passLengthChecker.offsetWidth;b+=lb(Bb.mainInput,"paddingLeft");var c=0,d=0,e=hb(D()),f=e.width,g=!1,h=z();if(Bb.maskBtn){c=lb(Bb.maskBtn,"width");var i=f-c-h,j=b>i;Jb!=j&&(g=!0,Jb=j)}if(Bb.genBtn){d=lb(Bb.genBtn,"width");var k=f-c-d-h,l=b>k;Ib!=l&&(g=!0,Ib=l)}g&&y()}}function J(){Bb.placeholder&&(Bb.placeholder.style.display="none")}function K(){xb&&(clearTimeout(xb),xb=null),yb&&(clearTimeout(yb),yb=null),Hb=!0,y()}function L(){xb=setTimeout(function(){xb=null,Hb=!1,y(),Cb.isMasked&&!yb&&(yb=setTimeout(function(){yb=null,N(!0,!1)},1500))},100)}function M(){Eb&&S()}function N(a,b){b===d&&(b=!0);var c=a!=Db;if(a=a===d?!Db:!!a,zb.changeType){var e=D(),g=O(e);e.setAttribute("type",a?"password":"text"),b&&(P(e,g),e.focus())}else{var h=kb(D(),"display")||"block",i=a?Bb.clearInput:Bb.mainInput,j=a?Bb.mainInput:Bb.clearInput;Db!=a&&f.each(["paddingRight","width","backgroundImage","backgroundPosition","backgroundRepeat","backgroundAttachment","border"],function(a){var b=i.style[a];b&&(j.style[a]=b)});var k=O(i);j.style.display=h,i.style.display="none",j.value=i.value,b&&(P(j,k),j.focus()),Bb.mainInput.nextSibling!=Bb.clearInput&&mb(Bb.mainInput,Bb.clearInput)}Bb.maskBtn&&(nb(Bb.maskBtn,a?"abc":"&bull;&bull;&bull;"),Bb.maskBtn.title=a?ub.msg.showPass:ub.msg.hidePass),Db=a,I(),y(),c&&sb("switched",Db)}function O(a){return"number"==typeof a.selectionStart&&"number"==typeof a.selectionEnd?{start:a.selectionStart,end:a.selectionEnd}:null}function P(a,b){b&&"number"==typeof a.selectionStart&&"number"==typeof a.selectionEnd&&(a.selectionStart=b.start,a.selectionEnd=b.end)}function Q(){("function"==typeof Bb.mainInput.hasAttribute&&Bb.mainInput.hasAttribute("autofocus")||Bb.mainInput.getAttribute("autofocus"))&&(Bb.mainInput.focus(),K())}function R(){var a=$();Bb.mainInput.value=a,Bb.clearInput&&(Bb.clearInput.value=a),sb("generated",a),N(!1),wb&&(clearTimeout(wb),wb=null),S(),Bb.placeholder&&(Bb.placeholder.style.display="none")}function S(){wb&&(clearTimeout(wb),wb=null);var a=D().value,b=T(a);if(0==a.length)b={strength:Cb.allowEmpty?0:null,messages:[ub.msg.passRequired]};else{!Cb.allowAnyChars&&b.charTypes[e.CharTypes.UNKNOWN]&&(b={strength:null,messages:[ub.msg.badChars.replace("{}",b.charTypes[e.CharTypes.UNKNOWN])]}),delete b.charTypes;var c=!1;f.each(Cb.blackList,function(b){return b==a?(c=!0,!1):!0}),c&&(b={strength:0,messages:[ub.msg.inBlackList]}),a&&a===X()&&(b={strength:0,messages:[ub.msg.equalTo]})}if("function"==typeof Cb.validationCallback){var d,g,h=Cb.validationCallback(Bb.mainInput,b);h&&h.messages&&f.isArray(h.messages)&&(d=h.messages),h&&Object.prototype.hasOwnProperty.call(h,"strength")&&("number"==typeof h.strength||null===h.strength)&&(g=h.strength),d&&d.length?(b.messages=d,b.strength=g):g&&g>b.strength&&(b.strength=g)}return 0==a.length&&Cb.allowEmpty?(W(),Fb={strength:0},!0):null===b.strength||b.strength<Cb.acceptRate?(V(b.strength,b.messages),!1):(W(),Fb={strength:b.strength},!0)}function T(a){var b=_(Cb.pattern,e.CharTypes.SYMBOL),c=_(a,Cb.allowAnyChars?e.CharTypes.SYMBOL:e.CharTypes.UNKNOWN),d=[],g=0;f.each(b,function(a){if(g++,!c[a]){var b=ub.msg[a];if(a==e.CharTypes.SYMBOL){var f=4,h=Cb.chars[a];h.length>f&&(h=h.substring(0,f)),b=b+" ("+h+")"}d.push(b)}});var h=1-d.length/g;if(d.length&&(d=[U(d)]),Cb.checkMode==e.CheckModes.MODERATE){var i=0;f.each(c,function(a){b[a]||i++}),h+=i/g}var j=Cb.pattern.length,k=a.length/j-1;if(Cb.length&&Cb.length.min&&a.length<Cb.length.min&&(k=-10,Cb.length.min>j&&(j=Cb.length.min)),0>k?(h+=k,d.push(ub.msg.passTooShort.replace("{}",j.toString()))):Cb.checkMode==e.CheckModes.MODERATE&&(h+=k/g),a.length>2){for(var l=a.charAt(0),m=!0,n=0;n<a.length;n++)if(a.charAt(n)!=l){m=!1;break}m&&(h=0,d=[ub.msg.repeat])}return 0>h&&(h=0),h>1&&(h=1),{strength:h,messages:d,charTypes:c}}function U(a){for(var b=a[0],c=1;c<a.length;c++)b+=c==a.length-1?" "+ub.msg.and+" ":", ",b+=a[c];return ub.msg.noCharType.replace("{}",b)}function V(a,b){var c="",d="";if(null===a)c=ub.msg.invalidPassWarn,d=b[0].charAt(0).toUpperCase()+b[0].substring(1);else if(c=ub.msg.weakWarn,d="",b)for(var e=0;e<b.length;e++){var f=b[e].charAt(0);0==e?(d+=ub.msg.weakTitle+": ",ub.lower&&(f=f.toLowerCase())):(d+="<br/>",f=f.toUpperCase()),d+=f+b[e].substring(1),d&&"."!=d.charAt(d.length-1)&&(d+=".")}if(d&&"."!=d.charAt(d.length-1)&&(d+="."),Fb={strength:a,message:d},Bb.warnMsg&&(nb(Bb.warnMsg,c),Bb.warnMsg.title=d,Cb.errorWrapClassName&&pb(Bb.wrapper,Cb.errorWrapClassName,!0)),Cb.showTip){var g=d;Bb.genBtn&&(g+="<br/>"+ub.msg.generateMsg.replace("{}",'<div class="'+bb("btn-gen-help")+'"></div>')),Lb=g,Bb.tipBody&&nb(Bb.tipBody,g)}Eb=!0,y()}function W(){Bb.warnMsg&&(nb(Bb.warnMsg,""),Bb.warnMsg.title="",Cb.errorWrapClassName&&qb(Bb.wrapper,Cb.errorWrapClassName,!0)),Lb=null,Eb=!1,y()}function X(){if(!Cb.nonMatchField)return null;var a=ob(Cb.nonMatchField);return a?a.value:null}function Y(){return Fb?Fb.message:null}function Z(){return Fb?Fb.strength:-1}function $(){var a="",b=_(Cb.pattern,e.CharTypes.SYMBOL),c=[];return f.each(b,function(a,b){for(var d=0;d<b.length;d++)c.push(a)}),c.sort(function(){return.7-Math.random()}),f.each(c,function(b){var c=Ab.generationChars[b];c?Cb.chars[b]&&Cb.chars[b].indexOf(c)<0&&(c=Cb.chars[b]):c=Cb.chars[b],a+=f.selectRandom(c)}),a}function _(a,b){for(var c={},d=0;d<a.length;d++){var e=a.charAt(d),g=b;f.each(Cb.chars,function(a,b){return b.indexOf(e)>=0?(g=a,!1):!0}),c[g]=(c[g]||"")+e}return c}function ab(a){return Mb+a+"-"+vb}function bb(a){return Mb+a}function cb(a,b,c){return b.id&&(b.id=ab(b.id)),b.className&&(b.className=bb(b.className)),f.newEl(a,b,c)}function db(a){try{return a.getBoundingClientRect()}catch(b){return{top:0,left:0}}}function eb(a){var b=a.ownerDocument;if(!b)return{top:0,left:0};var d=db(a);return{top:d.top+(c.pageYOffset||0)-(b.documentElement.clientTop||0),left:d.left+(c.pageXOffset||0)-(b.documentElement.clientLeft||0)}}function fb(a){var c;try{c=a.offsetParent}catch(d){}for(c||(c=b.documentElement);c&&"html"!=c.nodeName.toLowerCase()&&"static"===kb(c,"position");)c=c.offsetParent;return c||b.documentElement}function gb(a){var b,c={top:0,left:0};if("fixed"===kb(a,"position"))b=db(a);else{var d=fb(a);b=eb(a),"html"!=d.nodeName.toLowerCase()&&(c=eb(d)),c.top+=lb(d,"borderTopWidth"),c.left+=lb(d,"borderLeftWidth")}return{top:b.top-c.top-lb(a,"marginTop"),left:b.left-c.left-lb(a,"marginLeft")}}function hb(a){return{width:a.offsetWidth,height:a.offsetHeight}}function ib(a){return f.extend(eb(a),hb(a))}function jb(a,b){if(b.height&&!isNaN(b.height)&&(a.style.height=b.height+"px",a.style.lineHeight=b.height+"px"),b.width&&!isNaN(b.width)&&(a.style.width=b.width+"px"),b.top||b.left){if("none"==kb(a,"display"))return a.style.top=b.top+"px",a.style.left=b.left+"px",void 0;var c,d,e;if(e=eb(a),d=kb(a,"top")||0,c=kb(a,"left")||0,(d+c+"").indexOf("auto")>-1){var f=gb(a);d=f.top,c=f.left}else d=parseFloat(d)||0,c=parseFloat(c)||0;b.top&&(a.style.top=b.top-e.top+d+"px"),b.left&&(a.style.left=b.left-e.left+c+"px")}}function kb(a,b){var d="function"==typeof c.getComputedStyle?c.getComputedStyle(a,null):a.currentStyle;return d?d[b]:null}function lb(a,b){var c=kb(a,b);if(!c)return 0;var d=parseFloat(c);return isNaN(d)?0:d}function mb(a,b){a.parentNode&&a.parentNode.insertBefore(b,a.nextSibling)}function nb(a,c){try{a.innerHTML=c}catch(d){var e=b.createElement("c");for(e.innerHTML=c;a.firstChild;)a.removeChild(a.firstChild);a.appendChild(e)}}function ob(a){return"string"==typeof a?b.getElementById(a):a.jquery?a[0]:a}function pb(a,b,c){rb(a,b,c)||(a.className=a.className+(a.className?" ":"")+(c===!0?b:bb(b)))}function qb(a,b,c){rb(a,b,c)&&(a.className=(" "+a.className+" ").replace((c===!0?b:bb(b))+" ","").replace(/^\s+|\s+$/g,""))}function rb(a,b,c){return b=" "+(c===!0?b:bb(b))+" ",(" "+a.className+" ").replace(/[\n\t]/g," ").indexOf(b)>-1}function sb(b,c){if(a)try{a(Bb.mainInput).trigger(Nb+b,c)}catch(d){}if(Cb.events&&"function"==typeof Cb.events[b])try{Cb.events[b].call(Bb.mainInput,c)}catch(d){}}function tb(b,c){a&&a(Bb.mainInput).data(b,c)}var ub,vb,wb,xb,yb,zb,Ab=e.Config,Bb={},Cb=f.extend({},Ab.defaults,h),Db=!0,Eb=!1,Fb=null,Gb=!1,Hb=!1,Ib=!1,Jb=!1,Kb=!1,Lb=null,Mb="a_pf-",Nb="pass:",Ob=5,Pb=46,Qb=8;this.toggleMasking=function(a){N(a)},this.setPass=m,this.validatePass=S,this.getPassValidationMessage=Y,this.getPassStrength=Z,i.call(this)};var f={};f.extend=function(){for(var a=arguments,b=1;b<a.length;b++)f.each(a[b],function(b,c){a[0][b]=f.isArray(a[0][b])||f.isArray(c)?a[0][b]?a[0][b].concat(c||[]):c:f.isElement(c)?c:"object"==typeof a[0][b]&&"object"==typeof c&&null!==c?f.extend({},a[0][b],c):"object"==typeof c&&null!==c?f.extend({},c):c});return a[0]},f.newEl=function(a,c,d){var e=b.createElement(a);return c&&f.each(c,function(a,b){b&&(e[a]=b)}),d&&f.each(d,function(a,b){b&&(e.style[a]=b)}),e},f.attachEvent=function(a,b,d){var e=a[b];a[b]=function(a){a||(a=c.event),d(a),"function"==typeof e&&e(a)}},f.each=function(a,b){if(f.isArray(a)){for(var c=0;c<a.length;c++)if(b(a[c])===!1)return}else for(var d in a)if(Object.prototype.hasOwnProperty.call(a,d)&&b(d,a[d])===!1)return},f.isArray=function(a){return"[object Array]"===Object.prototype.toString.call(a)},f.isElement=function(b){if(!b)return!1;try{return b instanceof HTMLElement||a&&b instanceof jQuery}catch(c){return"object"==typeof b&&b.nodeType||b.jquery}},f.selectRandom=function(a){var b=Math.floor(Math.random()*a.length);return f.isArray(a)?a[b]:a.charAt(b)},f.contains=function(a,b){if(!a)return!1;var c=!1;return f.each(a,function(a){return a===b?(c=!0,!1):!0}),c},a&&(a.fn.passField=function(a){return this.each(function(){new e.Field(this,a)})},a.fn.togglePassMasking=function(b){return this.each(function(){var c=a(this).data(e.Config.dataAttr);c&&c.toggleMasking(b)})},a.fn.setPass=function(b){return this.each(function(){var c=a(this).data(e.Config.dataAttr);c&&c.setPass(b)})},a.fn.validatePass=function(){var b=!0;return this.each(function(){var c=a(this).data(e.Config.dataAttr);c&&!c.validatePass()&&(b=!1)}),b},a.fn.getPassValidationMessage=function(){var a=this.first();if(a){var b=a.data(e.Config.dataAttr);if(b)return b.getPassValidationMessage()}return null},a.fn.getPassStrength=function(){var a=this.first();if(a){var b=a.data(e.Config.dataAttr);if(b)return b.getPassStrength()}return null}),a&&a.validator&&jQuery.validator.addMethod("passfield",function(b,c){return a(c).validatePass()},function(b,c){return a(c).getPassValidationMessage()})}(window.jQuery,document,window);