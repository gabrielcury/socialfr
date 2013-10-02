 /**
 * @author       Rob W <gwnRob@gmail.com>
 * @website      http://stackoverflow.com/a/7513356/938089
 * @version      20120724
 * @description  Executes function on a framed YouTube video (see website link)
 *               For a full list of possible functions, see:
 *               https://developers.google.com/youtube/js_api_reference
 * @param String frame_id The id of (the div containing) the frame
 * @param String func     Desired function to call, eg. "playVideo"
 *        (Function)      Function to call when the player is ready.
 * @param Array  args     (optional) List of arguments to pass to function func*/
 
function callPlayer(frame_id, func, args) {
    if (window.jQuery && frame_id instanceof jQuery) frame_id = frame_id.get(0).id;
    var iframe = document.getElementById(frame_id);
    if (iframe && iframe.tagName.toUpperCase() != 'IFRAME') {
        iframe = iframe.getElementsByTagName('iframe')[0];
    }

    // When the player is not ready yet, add the event to a queue
    // Each frame_id is associated with an own queue.
    // Each queue has three possible states:
    //  undefined = uninitialised / array = queue / 0 = ready
    if (!callPlayer.queue) callPlayer.queue = {};
    var queue = callPlayer.queue[frame_id],
        domReady = document.readyState == 'complete';

    if (domReady && !iframe) {
        // DOM is ready and iframe does not exist. Log a message
        window.console && console.log('callPlayer: Frame not found; id=' + frame_id);
        if (queue) clearInterval(queue.poller);
    } else if (func === 'listening') {
        // Sending the "listener" message to the frame, to request status updates
        if (iframe && iframe.contentWindow) {
            func = '{"event":"listening","id":' + JSON.stringify(''+frame_id) + '}';
            iframe.contentWindow.postMessage(func, '*');
        }
    } else if (!domReady || iframe && (!iframe.contentWindow || queue && !queue.ready)) {
        if (!queue) queue = callPlayer.queue[frame_id] = [];
        queue.push([func, args]);
        if (!('poller' in queue)) {
            // keep polling until the document and frame is ready
            queue.poller = setInterval(function() {
                callPlayer(frame_id, 'listening');
            }, 250);
            // Add a global "message" event listener, to catch status updates:
            messageEvent(1, function runOnceReady(e) {
                var tmp = JSON.parse(e.data);
                if (tmp && tmp.id == frame_id && tmp.event == 'onReady') {
                    // YT Player says that they're ready, so mark the player as ready
                    clearInterval(queue.poller);
                    queue.ready = true;
                    messageEvent(0, runOnceReady);
                    // .. and release the queue:
                    while (tmp = queue.shift()) {
                        callPlayer(frame_id, tmp[0], tmp[1]);
                    }
                }
            }, false);
        }
    } else if (iframe && iframe.contentWindow) {
        // When a function is supplied, just call it (like "onYouTubePlayerReady")
        if (func.call) return func();
        // Frame exists, send message
        iframe.contentWindow.postMessage(JSON.stringify({
            "event": "command",
            "func": func,
            "args": args || [],
            "id": frame_id
        }), "*");
    }
    /* IE8 does not support addEventListener... */
    function messageEvent(add, listener) {
        var w3 = add ? window.addEventListener : window.removeEventListener;
        w3 ?
            w3('message', listener, !1)
        :
            (add ? window.attachEvent : window.detachEvent)('onmessage', listener);
    }
}
jQuery(document).ready(function(){
	
jQuery('.gallery-size-slider').find('br,p').remove();
jQuery('.gallery-size-slider').addClass('flexslider');
jQuery('.gallery img').css('border','0px'); 

jQuery('.gallery-size-slider').flexslider({
		selector: '.gallery-item',
	    directionNav: true,
		slideshow: false,
		pauseOnAction: true,
		pauseOnHover: true,
		easing: 'swing',
		video:true,
		controlNav: false, 
		before: function(slider){
			if ( jQuery('#youtube_video')[0] ) { 
		callPlayer('youtube_video', 'pauseVideo');}
		if ( jQuery('#player_1')[0] ) { 
		var myid ='player_1';
		jQuery("[id*="+myid+"]").each(function(){
			Froogaloop(  jQuery(this)[0] ).api('pause');});
      	}              //{NEW} String: Determines the easing method used in jQuery transitions. jQuery easing plugin is supported!
 
	  
		}});



jQuery(function() {
	jQuery('ul.da-thumbs > li').hoverdir();
});
});
jQuery(window).load(function(){
	jQuery('.gotopost, .gotoposthide').each(function(){
	var gotopost = jQuery(this)
	gotopost.css({ height: gotopost.parent().height() } );
	gotopost.find('.info_inside_normal').css({ height: gotopost.parent().height() } );
	});});
	jQuery(window).smartresize( function(){
  	jQuery('.gotopost, .gotoposthide').each(function(){
	var gotopost = jQuery(this)
	gotopost.css({ height: gotopost.parent().height() } );
	gotopost.find('.info_inside_normal').css({ height: gotopost.parent().height() } );
	});
	});
jQuery(document).ready(function(){
	
(function() {

  var root = (typeof exports == 'undefined' ? window : exports);

  var config = {
    // Ensure Content-Type is an image before trying to load @2x image
    // https://github.com/imulus/retinajs/pull/45)
    check_mime_type: true
  };



  root.Retina = Retina;

  function Retina() {}

  Retina.configure = function(options) {
    if (options == null) options = {};
    for (var prop in options) config[prop] = options[prop];
  };

  Retina.init = function(context) {
    if (context == null) context = root;

    var existing_onload = context.onload || new Function;

    context.onload = function() {
      var images = document.getElementsByTagName("img"), retinaImages = [], i, image;
      for (i = 0; i < images.length; i++) {
        image = images[i];
        retinaImages.push(new RetinaImage(image));
      }
      existing_onload();
    }
  };

  Retina.isRetina = function(){
    var mediaQuery = "(-webkit-min-device-pixel-ratio: 1.5),\
                      (min--moz-device-pixel-ratio: 1.5),\
                      (-o-min-device-pixel-ratio: 3/2),\
                      (min-resolution: 1.5dppx)";

    if (root.devicePixelRatio > 1)
      return true;

    if (root.matchMedia && root.matchMedia(mediaQuery).matches)
      return true;

    return false;
  };


  root.RetinaImagePath = RetinaImagePath;

  function RetinaImagePath(path) {
    this.path = path;
    this.at_2x_path = path.replace(/\.\w+$/, function(match) { return "@2x" + match; });
  }

  RetinaImagePath.confirmed_paths = [];

  RetinaImagePath.prototype.is_external = function() {
    return !!(this.path.match(/^https?\:/i) && !this.path.match('//' + document.domain) )
  }

  RetinaImagePath.prototype.check_2x_variant = function(callback) {
    var http, that = this;
    if (this.is_external()) {
      return callback(false);
    } else if (this.at_2x_path in RetinaImagePath.confirmed_paths) {
      return callback(true);
    } else {
      http = new XMLHttpRequest;
      http.open('HEAD', this.at_2x_path);
      http.onreadystatechange = function() {
        if (http.readyState != 4) {
          return callback(false);
        }

        if (http.status >= 200 && http.status <= 399) {
          if (config.check_mime_type) {
            var type = http.getResponseHeader('Content-Type');
            if (type == null || !type.match(/^image/i)) {
              return callback(false);
            }
          }

          RetinaImagePath.confirmed_paths.push(that.at_2x_path);
          return callback(true);
        } else {
          return callback(false);
        }
      }
      http.send();
    }
  }



  function RetinaImage(el) {
    this.el = el;
    this.path = new RetinaImagePath(this.el.getAttribute('src'));
    var that = this;
    this.path.check_2x_variant(function(hasVariant) {
      if (hasVariant) that.swap();
    });
  }

  root.RetinaImage = RetinaImage;

  RetinaImage.prototype.swap = function(path) {
    if (typeof path == 'undefined') path = this.path.at_2x_path;

    var that = this;
    function load() {
      if (! that.el.complete) {
        setTimeout(load, 5);
      } else {
        that.el.setAttribute('width', that.el.offsetWidth);
        that.el.setAttribute('height', that.el.offsetHeight);
        that.el.setAttribute('src', path);
      }
    }
    load();
  }




  if (Retina.isRetina()) {
    Retina.init(root);
  }

})();


		
        jQuery('.activator.class').BAToolTip({
            tipOpacity: 0.9,
            tipOffset: 20
        });
    
	var vimeoPlayers = jQuery('.flexslider').find('iframe'), player;        

for (var i = 0, length = vimeoPlayers.length; i < length; i++) {            
        player = vimeoPlayers[i];           
        $f(player).addEvent('ready', ready);        
}       

function addEvent(element, eventName, callback) {           
    if (element.addEventListener) {                 
        element.addEventListener(eventName, callback, false)            
    } else {                
        element.attachEvent(eventName, callback, false);            
    }       
}       

function ready(player_id) {             
    var froogaloop = $f(player_id);             
    froogaloop.addEvent('play', function(data) {                
        jQuery('.flexslider').flexslider("pause");  
          
    });             
    froogaloop.addEvent('pause', function(data) {               
        jQuery('.flexslider').flexslider("play"); 
             
    });         
}  
	jQuery('.connections').css({'border-top':'0px'});
	jQuery('.fbConnectWidgetFooter').hide();
	var fixed = false;
	jQuery(document).scroll(function() {
    if( jQuery(this).scrollTop() >= 10 ) {
        if( !fixed ) {
            fixed = true;
			
            jQuery('.mimologo2').animate({
    opacity: 1,
    width: '39px',
    height: '40px',
	}, 500, function() {
    // Animation complete.
  });
			
			 // Or set top:20px; in CSS
        }                                           // It won't matter when static
    } else {
        if( fixed ) {
            fixed = false;
			
            jQuery('.mimologo2').animate({
    opacity: 0,
    width: '0px',
    height: '0px',
	}, 500);
			
        }
    }
});

 
jQuery(window).scroll(function(){
            if (jQuery(this).scrollTop() > 100) {
                jQuery('#gantry-totop').fadeIn();
            } else {
                jQuery('#gantry-totop').fadeOut();
            }
        }); 
 
jQuery('.scrollup').click(function(){
            jQuery("html, body").animate({ scrollTop: 0 }, 600);
            return false;
        });
 
  
jQuery('.custom_repeatable').sortable({
		opacity: 0.6,
		revert: true,
		cursor: 'move',
		handle: '.sort',
	});

	jQuery('div.ca-content-wrapper').show();
	jQuery('.loading').hide();
	var n = 1;	
	
/* Hovers

********************************************************************************** */
    
	
	
		jQuery('.button_link,button[type=submit],button,input[type=submit],input[type=button],input[type=reset]').hover(
		function() {
				jQuery(this).stop().animate({opacity:0.8},400);
			},
			function() {
				jQuery(this).stop().animate({opacity:1},400);
		});
	jQuery('#newswallmimo-filter li a').hover(function(){
					jQuery(this).stop().animate({padding: '10px 20px'});
					}, function(){
					jQuery(this).stop().animate({padding: '10px 12px'});
				});
	jQuery('.flex-direction-nav a').hover(function(){
					jQuery(this).stop().animate({opacity : 1},'fast');
					}, function(){
					jQuery(this).stop().animate({opacity : 0.7},'fast');
				});
	jQuery('.flexslider, .gallery').hover(function(){
					jQuery(this).children('.flex-direction-nav').stop().animate({height : 'show'},'fast');
					}, function(){
					jQuery(this).children('.flex-direction-nav').stop().animate({height : 'hide'},'fast');
				});
	jQuery('.slideshow, #allimg_id').hover(function(){
					jQuery(this).children('.rslides_nav').stop().animate({opacity : 1},'fast');
					}, function(){
					jQuery(this).children('.rslides_nav').stop().animate({opacity : 0},'fast');
				});
	jQuery('.ca-container').hover(function(){
					jQuery(this).children('.ca-nav').stop().animate({opacity : 1},'fast');
					}, function(){
					jQuery(this).children('.ca-nav').stop().animate({opacity : 0},'fast');
				});
				jQuery('.ca-container-slider').hover(function(){
					jQuery(this).children('.ca-nav').stop().animate({opacity : 1},'fast');
					}, function(){
					jQuery(this).children('.ca-nav').stop().animate({opacity : 0},'fast');
				});
				jQuery('.cn-list').hover(function(){
					jQuery(this).children('.ca-nav').stop().animate({opacity : 1},'fast');
					}, function(){
					jQuery(this).children('.ca-nav').stop().animate({opacity : 0},'fast');
				});
				jQuery('.readon_standard').hover(function(){
					jQuery(this).children('.readon_hide').stop().animate({opacity : 1},'fast');
					}, function(){
					jQuery(this).children('.readon_hide').stop().animate({opacity : 0},'fast');
				});
				
	
	
				jQuery('.nav-prev').hover(function(){
					jQuery(this).find('.previous_post_link').stop().animate({width : 'show'},'fast');
					
					}, function(){
					jQuery(this).find('.previous_post_link').stop().animate({width : 'hide'},'fast');
					
				});
				jQuery('.nav-next').hover(function(){
					jQuery(this).find('.next_post_link').stop().animate({width : 'show'},'fast');
					
					}, function(){
					jQuery(this).find('.next_post_link').stop().animate({width : 'hide'},'fast');
					
				});
	
	
	jQuery('.ca-item-main').hover(function(){
					jQuery(this).children('.ca-icon').stop().animate({opacity : 0},'fast');
						jQuery(this).children('.ca-content-wrapper').stop().animate({opacity : 1},'fast');
					}, function(){
					jQuery(this).children('.ca-icon').stop().animate({opacity : 1},'fast');
						jQuery(this).children('.ca-content-wrapper').stop().animate({opacity : 0},'fast');
				});
	jQuery('.blog_thumb_standard').hover(function(){
					jQuery(this).find('.rt-image').stop().animate({opacity : 0.5},'fast');
						
					}, function(){
					jQuery(this).find('.rt-image').stop().animate({opacity : 1},'fast');
				});

/* Search

********************************************************************************** */


	
	jQuery('.accordiondiv').slideUp('slow');
	jQuery('.accordiondiv:first').parent().addClass('current');
	jQuery('.accordiondiv:first').slideToggle('slow');
	jQuery('ul#accordion a.heading').click(function() {
		jQuery(this).css('outline','none');
		if(jQuery(this).parent().hasClass('current')) {
			jQuery(this).siblings('div').slideUp('slow',function() {
				jQuery(this).parent().removeClass('current');
				
			});
		} else {
			jQuery('ul#accordion li.current div').slideUp('slow',function() {
				jQuery(this).parent().removeClass('current');
			});
			jQuery(this).siblings('div').slideToggle('slow',function() {
				jQuery(this).parent().toggleClass('current');
				
			});
			
		}
		return false;
	});


/* Tabs 

********************************************************************************** */

	jQuery('#tabvanilla > ul').tabs({ fx: { height: 'toggle', opacity: 'toggle' } });
	jQuery('#tabvanilla_widget > ul').tabs({ fx: { height: 'toggle', opacity: 'toggle' } });
	jQuery('#featuredvid > ul').tabs();
	
	
/* Code for left tabs */


	jQuery('#lefttabvanilla > ul').tabs({ fx: { height: 'toggle', opacity: 'toggle' } });
	
	
	
});


/* Menu 

********************************************************************************** */

jQuery(document).ready(
    function() {
        jQuery( ".select-menu" ).change(
            function() { 
                window.location = jQuery(this).find("option:selected").val();
            }
        );
    }
);

/* Walls 

********************************************************************************** */



/* PrettyPhoto 

********************************************************************************** */


       
  jQuery(document).ready(function(){
		jQuery("a[data-rel^='prettyPhoto']").prettyPhoto({
			animation_speed: 'fast', /* fast/slow/normal */
			slideshow: 5000, /* false OR interval time in ms */
			autoplay_slideshow: false, /* true/false */
			opacity: 0.80, /* Value between 0 and 1 */
			show_title: true, /* true/false */
			allow_resize: true, /* Resize the photos bigger than viewport. true/false */
			default_width: 500,
			default_height: 344,
			counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
			theme: 'light_square', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
			horizontal_padding: 20, /* The padding on each side of the picture */
			hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
			wmode: 'transparent', /* Set the flash wmode attribute */
			autoplay: true, /* Automatically start videos: True/False */
			modal: false, /* If set to true, only the close button will close the window */
			deeplinking: true, /* Allow prettyPhoto to update the url to enable deeplinking. */
			overlay_gallery: true, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
			keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
			changepicturecallback: function(){}, /* Called everytime an item is shown/changed */
			callback: function(){}, /* Called when prettyPhoto is closed */
			ie6_fallback: true,
			markup: '<div class="pp_pic_holder"> \
						<div class="ppt">&nbsp;</div> \
						<div class="pp_top"> \
							<div class="pp_left"></div> \
							<div class="pp_middle"></div> \
							<div class="pp_right"></div> \
						</div> \
						<div class="pp_content_container"> \
							<div class="pp_left"> \
							<div class="pp_right"> \
								<div class="pp_content"> \
									<div class="pp_loaderIcon"></div> \
									<div class="pp_fade"> \
										<a href="#" class="pp_expand" title="Expand the image">Expand</a> \
										<div class="pp_hoverContainer"> \
											<a class="pp_next" href="#">next</a> \
											<a class="pp_previous" href="#">previous</a> \
										</div> \
										<div id="pp_full_res"></div> \
										<div class="pp_details"> \
											<div class="pp_nav"> \
												<a href="#" class="pp_arrow_previous">Previous</a> \
												<p class="currentTextHolder">0/0</p> \
												<a href="#" class="pp_arrow_next">Next</a> \
											</div> \
											<p class="pp_description"></p> \
											{pp_social} \
											<a class="pp_close" href="#">Close</a> \
										</div> \
									</div> \
								</div> \
							</div> \
							</div> \
						</div> \
						<div class="pp_bottom"> \
							<div class="pp_left"></div> \
							<div class="pp_middle"></div> \
							<div class="pp_right"></div> \
						</div> \
					</div> \
					<div class="pp_overlay"></div>',
			gallery_markup: '<div class="pp_gallery"> \
								<a href="#" class="pp_arrow_previous">Previous</a> \
								<div> \
									<ul> \
										{gallery} \
									</ul> \
								</div> \
								<a href="#" class="pp_arrow_next">Next</a> \
							</div>',
			image_markup: '<img id="fullResImage" src="{path}" />',
			flash_markup: '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="{width}" height="{height}"><param name="wmode" value="{wmode}" /><param name="allowfullscreen" value="true" /><param name="allowscriptaccess" value="always" /><param name="movie" value="{path}" /><embed src="{path}" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="{width}" height="{height}" wmode="{wmode}"></embed></object>',
			quicktime_markup: '<object classid="clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B" codebase="http://www.apple.com/qtactivex/qtplugin.cab" height="{height}" width="{width}"><param name="src" value="{path}"><param name="autoplay" value="{autoplay}"><param name="type" value="video/quicktime"><embed src="{path}" height="{height}" width="{width}" autoplay="{autoplay}" type="video/quicktime" pluginspage="http://www.apple.com/quicktime/download/"></embed></object>',
			iframe_markup: '<iframe src ="{path}" width="{width}" height="{height}" frameborder="no"></iframe>',
			inline_markup: '<div class="pp_inline">{content}</div>',
			custom_markup: '',
			social_tools: '<div class="pp_social"><div class="twitter"><a href="http://twitter.com/share" class="twitter-share-button" data-count="none">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div><div class="facebook"><iframe src="http://www.facebook.com/plugins/like.php?locale=en_US&href='+location.href+'&amp;layout=button_count&amp;show_faces=true&amp;width=500&amp;action=like&amp;font&amp;colorscheme=light&amp;height=23" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:500px; height:23px;" allowTransparency="true"></iframe></div></div>' /* html or false to disable */
		});
	});
	