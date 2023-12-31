/*функции для плеера*/
 /* AudioManager */
 const AudioManager = {
   init() {
     console.log('AudioManager.init()');
       $(document).on("click", ".audio > .play", this.play.bind(this));
       $(document).on("click", ".audio > .stop", this.stop.bind(this));
       $(document).on("click", ".audio > .pause", this.pause.bind(this));
   },
   reinit(e){
     console.log('AudioManager.reinit()');
     $(".audio").each(function () {
         const player = $(this).find("audio").get(0);
         player.pause();
         player.currentTime = 0;

         $(this).find(".play").css("display", "inline-block");
         $(this).find(".stop").css("display", "none");
         $(this).find(".pause").css("display", "none");
     });
   },
   play(e) {
       const currAudio = $(e.target).closest(".audio");

       AudioManager.addUniq(currAudio.find("audio"));

       $(".audio").each(function () {
           const player = $(this).find("audio").get(0);
           player.pause();
           player.currentTime = 0;

           $(this).find(".play").css("display", "inline-block");
           $(this).find(".stop").css("display", "none");
           $(this).find(".pause").css("display", "none");
       });

       const currentPlayer = currAudio.find("audio").get(0);

       currentPlayer.play();

       const playButton = currAudio.find(".play");
       const stopButton = currAudio.find(".stop");

       playButton.css("display", "none");
       stopButton.css("display", "inline-block");
       currAudio.find(".pause").css("display", "none");

       currentPlayer.onended = function () {
           playButton.css("display", "inline-block");
           stopButton.css("display", "none");
           AudioManager.addUniq(currAudio.find("audio"));
       };
   },

   stop(e) {
       const currAudio = $(e.target).closest(".audio");

       const currentPlayer = currAudio.find("audio").get(0);
       currentPlayer.pause();
       currAudio.find(".play").css("display", "none");
       currAudio.find(".stop").css("display", "none");
       currAudio.find(".pause").css("display", "inline-block");
   },

   pause(e) {
       const currAudio = $(e.target).closest(".audio");
       const currentPlayer = currAudio.find("audio").get(0);
       currentPlayer.play();
       currAudio.find(".play").css("display", "none");
       currAudio.find(".stop").css("display", "inline-block");
       currAudio.find(".pause").css("display", "none");
   },
   addUniq(currentPlayer) {
       const playerSrc = currentPlayer.attr("src");

       currentPlayer.attr("src", makeUniqUrl(playerSrc));
   },
 };
function makeUniqUrl(t) {var e = makeUrlByPath(t = clearPathFromUniqParam(t));if (null === e)return t;var n = "uniq=".concat(Math.floor(9999999999999 * Math.random()), 1);return "" !== e.search ? t += "&".concat(n) : t += "?".concat(n),t}
function clearPathFromUniqParam(path) {try {let uniqParamPos = path.indexOf("?uniq");uniqParamPos =uniqParamPos === -1 ? path.indexOf("&uniq") : uniqParamPos;if (uniqParamPos !== -1) {path = path.substring(0, uniqParamPos);}return path;} catch (e) {return path;}}
function makeUrlByPath(path) {let url = null;try {url = new URL(path);} catch (e) {url = null;}if (url === null) {try {const host = `${window.location.protocol}//${window.location.hostname}`;const urlString = host + path;url = new URL(urlString);if (url.origin !== host) {url = null;}} catch (e) {url = null;}}if (url === null || url.host.indexOf(".") === -1) {return null;}return url;}
/*функции для плеера*/
function alignCenter() {
  // console.log('[alignCenter()]');
    var window_width = $(window).width();
    var window_height = $(window).height();
    var body_width = $('#hide-layout').width();
    var body_height = $('#hide-layout').height();
    $('.popup').each(function() {
        var left_pos = (((window_width > body_width ? window_width : body_width) - $(this).width()) / 2).toFixed() + 'px'; // получаем координату центра по ширине
        var top_pos = ( (window_height - $(this).height()) / 2).toFixed() + 'px' // получаем координату центра по высоте
        var min_height = (window_height * 0.95);
       // console.log('id: '+$(this).attr('id')+' width: '+$(this).width()+' height: '+$(this).height()+' top: '+top_pos+' left: '+left_pos);
        $(this).find('.popup-content').css({
            'max-height' : min_height.toFixed() + 'px',
            'max-width' : (body_width * 0.95 ).toFixed()+ 'px',
        })
        $(this).css({
            left : left_pos,
            top : top_pos
        })
    })
}
function isnull(variable,ret){
  if(typeof variable !=="undefined"){
      return variable;
  }else{
      if(typeof ret !=="undefined"){
          return ret;
      }else{
          return null;
      }
  }
}
function remove_popup(popup_selector){
  if ( typeof popup_selector !== "undefined") {
    $(popup_selector).remove();
  }
}
function hide_popup(popup_id) {
    if ( typeof popup_id !== "undefined") {
        $('.popup' + '#' + popup_id).hide();
    } else {
        $('.popup').hide();
    }
    if(!$('.popup:visible').length){
        $('#hide-layout').fadeOut(0);
       // clearInterval(alignCenter_Interval);
    }
}
var alignCenter_Interval = null;
function show_popup(popup_id,on_show_function) {
  console.log('[show_popup('+popup_id+')]');
    if ( typeof popup_id !== "undefined") {
        $('#hide-layout, .popup' + '#' + popup_id).fadeIn(10,function(){
            alignCenter();
            if(typeof on_show_function == 'function'){
                on_show_function();
            }
        });
    } else {
        //$('#hide-layout, #popup').fadeIn(300);
    }
    alignCenter_Interval = setTimeout(function(){
        alignCenter();
    },150);
}

function create_popup(popup_id, html) {
    if ( typeof popup_id !== "undefined") {
      remove_popup('#'+popup_id);
        var clon = $('.popup').eq(0).removeClass('big').clone();
        clon.addClass('created_popup').attr('id', popup_id).hide().find('.popup-content').html(isnull(html, ''));
        $('body').append(clon);
    }
}
function scrolto(to){
    if(to)
        $('body,html').animate({
            scrollTop: to
        }, 2000);
}
function load_content(url,data,callback){
    //d(url);
    //d(data);
    if(isnull(url)){
        $.ajax({
            url: url,
            type: 'post',
            dataType: "json",
            data: isnull(data),
            //timeout: 2000,
            cache: false,
            success: function (data, status, XHR) {
                console.log(data);

                if(typeof data == 'object' && data  != null){
                    if(data.return_text !== null && data.return_text.length){
                        callback(data.return_text);
                    }processing_of_returned_data(data);

                }else{}
            },
            complete: function (data) {
                //console.log(data);
                 },
            error: function (data) {processing_of_returned_data(data);
                console.error(data);
            }
        });
    }

  }
function load_content_to_popup(popup_id,url,data){
  console.log('[load_content_to_popup('+popup_id+','+url+')]');
    var clon = $('.popup').eq(0).clone();
    if(typeof (popup_id) === undefined){
        popup_id = str_rand(10);
    }
    remove_popup('#'+popup_id);
    if(isnull(url)){
        $.ajax({
            url: url,
            type: 'post',
            dataType: "json",
            data: isnull(data),
            //timeout: 2000,
            cache: false,
            success: function (data, status, XHR) {
                processing_of_returned_data(data,popup_id);
            },
            complete: function (data) {
                processing_of_returned_data(data);
                 },
            error: function (data) {
              processing_of_returned_data(data);
            }
        });
    }

  }
function send_form_to_ajax(th) {
    if (typeof th !=="undefined") {
        var post = $(th).serializeArray();
        var action = th.action;
        console.log(post);
        if (typeof action !=="undefined") {
            $.ajax({
                url: action,
                type: th.method || 'post',
                dataType: "json",
                data: post,
                //timeout: 2000,
                cache: false,
                context: th,
                success: function (data, status, XHR) {
                  console.log(data);
                	if(typeof data == 'object'){
                    if(data.return_text){
                    	$(this).find('.return_text').slideUp(364);
	            				$(this).prepend('<div class="return_text hide">'+data.return_text+'</div>');
	            				$(this).find('.return_text.hide').slideDown(364).removeClass('hide');
                    }
                	}else{
                	}
                  processing_of_returned_data(data);
                },
                complete: function (data) {
                  console.log(data); },
                error: function (data) {
                  console.error(data);}
            });
        }
        return;
    }
}
function str_rand(len) {
		var result       = '';
		var words        = '0123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM';
		var max_position = words.length - 1;
			for( i = 0; i < len; ++i ) {
				position = Math.floor ( Math.random() * max_position );
				result = result + words.substring(position, position + 1);
			}
		return result;
}
function htmlspecialchars_decode(string, quote_style) {
  //       discuss at: http://phpjs.org/functions/htmlspecialchars_decode/
  //      original by: Mirek Slugen
  //      improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  //      bugfixed by: Mateusz "loonquawl" Zalega
  //      bugfixed by: Onno Marsman
  //      bugfixed by: Brett Zamir (http://brett-zamir.me)
  //         input by: ReverseSyntax
  //         input by: Slawomir Kaniecki
  //         input by: Scott Cariss
  //         input by: Francois
  //         input by: Ratheous
  //         input by: Mailfaker (http://www.weedem.fr/)
  //       revised by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // reimplemented by: Brett Zamir (http://brett-zamir.me)
  //        example 1: htmlspecialchars_decode("<p>this -&gt; &quot;</p>", 'ENT_NOQUOTES');
  //        returns 1: '<p>this -> &quot;</p>'
  //        example 2: htmlspecialchars_decode("&amp;quot;");
  //        returns 2: '&quot;'

  var optTemp = 0,
    i = 0,
    noquotes = false;
  if (typeof quote_style === 'undefined') {
    quote_style = 2;
  }
  string = string.toString()
    .replace(/&lt;/g, '<')
    .replace(/&gt;/g, '>');
  var OPTS = {
    'ENT_NOQUOTES': 0,
    'ENT_HTML_QUOTE_SINGLE': 1,
    'ENT_HTML_QUOTE_DOUBLE': 2,
    'ENT_COMPAT': 2,
    'ENT_QUOTES': 3,
    'ENT_IGNORE': 4
  };
  if (quote_style === 0) {
    noquotes = true;
  }
  if (typeof quote_style !== 'number') { // Allow for a single string or an array of string flags
    quote_style = [].concat(quote_style);
    for (i = 0; i < quote_style.length; i++) {
      // Resolve string input to bitwise e.g. 'PATHINFO_EXTENSION' becomes 4
      if (OPTS[quote_style[i]] === 0) {
        noquotes = true;
      } else if (OPTS[quote_style[i]]) {
        optTemp = optTemp | OPTS[quote_style[i]];
      }
    }
    quote_style = optTemp;
  }
  if (quote_style & OPTS.ENT_HTML_QUOTE_SINGLE) {
    string = string.replace(/&#0*39;/g, "'"); // PHP doesn't currently escape if more than one 0, but it should
    // string = string.replace(/&apos;|&#x0*27;/g, "'"); // This would also be useful here, but not a part of PHP
  }
  if (!noquotes) {
    string = string.replace(/&quot;/g, '"');
  }
  // Put this in last place to avoid escape being double-decoded
  string = string.replace(/&amp;/g, '&');

  return string;
}
function processing_of_returned_data(data,popup_id){
    if ( typeof data == 'object' ) {
      if( typeof popup_id == 'undefined'){
        var popup_id = str_rand(10);
      }
      if (isnull(data.message)) {add_message(data.message);}
      if (isnull(data.popup)) {create_popup(popup_id, data.popup);show_popup(popup_id);}
      if (isnull(data.error)) {$('#'+popup_id).addClass('error')}
      if (isnull(data.info)) {$('#'+popup_id).addClass('info')}
      if (isnull(data.script)) {eval(data.script);}
      //if (isnull(data.responseText)) {create_popup(popup_id, data.responseText);show_popup(popup_id);}
    }
}

function send_ajax(url,data,callback){
    if(typeof callback === 'function'){
       var success_f = callback;
    }else{
       var success_f = function(data, status, XHR) {
           processing_of_returned_data(data)
        }
    }
    $.ajax({
        url : url,
        type :'post',
        dataType : "json",
        data : data,
        cache : false,
        success : success_f,
        complete : function(data) {},
        error : function(data) {
          processing_of_returned_data(data);//$(this).after(data.responseText);console.error(data);
        }
    });
}
function add_message(text){
    var message_id = str_rand(10);
    $('#sistem_messages').prepend('<div class="message hide" id="'+message_id+'">'+text+'</div>');
    $('#'+message_id).slideDown(364).on('hover',function(){
        $(this).slideUp(364,function(){$(this).remove()});
    });
}

function go(link) {
    if ( typeof link !== "undefined") {
        $.ajax({
            url : link,
            type :  'get',
            dataType : "json",
            data : {'get':''},
            //timeout: 2000,
            cache : false,
            success : function(data, status, XHR) {
                processing_of_returned_data(data)
            },
            complete : function(data) {
                console.log(data);
            },
            error : function(data) {processing_of_returned_data(data);}
        });
    return;
    }
}
function setCookie(name, value, options) {
  options = options || {};

  var expires = options.expires;

  if (typeof expires == "number" && expires) {
    var d = new Date();
    d.setTime(d.getTime() + expires*1000);
    expires = options.expires = d;
  }
  if (expires && expires.toUTCString) {
    options.expires = expires.toUTCString();
  }

  value = encodeURIComponent(value);

  var updatedCookie = name + "=" + value;

  for(var propName in options) {
    updatedCookie += "; " + propName;
    var propValue = options[propName];
    if (propValue !== true) {
      updatedCookie += "=" + propValue;
     }
  }
  document.cookie = updatedCookie;
}

function getCookie(name) { //возвращает cookie с именем name:
  var matches = document.cookie.match(new RegExp(
    "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
  ));
  return matches ? decodeURIComponent(matches[1]) : undefined;
}
function get_max_height(selector){
  console.log('[get_max_height("'+selector+'")]');
  if(typeof selector != 'undefined'){
    var m_h = _m_h =0;
    $(selector).each(function() {
       _m_h = $(this).height();
       if (_m_h > m_h) {
           m_h = _m_h;
       }
    });
    return m_h;
  }
}
