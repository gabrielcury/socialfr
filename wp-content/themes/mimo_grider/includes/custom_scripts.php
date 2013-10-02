<?php

/*
Theme Name: Plus
Theme URI: http://www.mimothemes.com
Description: Wordpress theme by mimothemes
Version: 1.0
Author: Mimo Studio
Author URI: http://www.mimothemes.com


 /* Register and Enqueue Scripts 
 
************************************************************************** */


  add_action( 'init', 'mimojs' );
	function mimojs() { if( !is_admin() ){
		
    	
		wp_register_script( 'flexslider', get_template_directory_uri() . '/js/flexslider.js',  'jquery' ,"", true ); 
		wp_register_script( 'carousel', 						        	get_template_directory_uri() . '/js/jquery.contentcarousel.js',  'jquery' ,"", true ); 
		wp_register_script( 'mouse_wheel', get_template_directory_uri() . '/js/jquery.mousewheel.js',  'jquery' ,"", true ); 
		wp_register_script( 'responsive-images', get_template_directory_uri() . '/js/responsive-images.js',  'jquery' ,"", true ); 
		wp_register_script( 'mimo_js', get_template_directory_uri() . '/js/mimo.js',  'jquery' ,"", true ); 
		wp_register_script( 'frogaloop', get_template_directory_uri() . '/js/frogaloop.js',  'jquery' ,"", true );
		wp_register_script( 'hover', get_template_directory_uri() . '/js/hover.js',  'jquery' ,"", true );
		wp_register_script( 'spin', get_template_directory_uri() . '/js/spin.js',  'jquery' ,"", true );
		wp_register_script( 'jqueryspin', get_template_directory_uri() . '/js/jquery.spin.js',  'jquery' ,"", true );
		wp_register_script( 'tooltip', get_template_directory_uri() . '/js/jquery.BA.ToolTip.js',  'jquery' ,"", true );  
		wp_register_script( 'custom_ui', get_template_directory_uri() . '/js/jquery-ui-1.9.2.custom.min.js',  'jquery' ,"", true ); 
		wp_register_script( 'filterable', get_template_directory_uri() . '/js/filterable.js',  'jquery' ,"", true ); 
		wp_register_script( 'raty', get_template_directory_uri() . '/js/jquery.raty.js',  'jquery' ,"", true );
		wp_register_script( 'infinitescroll', get_template_directory_uri() . '/js/infinitescroll.js',  'jquery' ,"", true );
		wp_register_script('html5', 'http://html5shim.googlecode.com/svn/trunk/html5.js',  'jquery' ,"", true);
		wp_register_script( 'prettyPhotoscript', get_template_directory_uri() . '/js/prettyPhoto.js',  'jquery' ,"", true ); 
		wp_register_script('css3', 'http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js',  'jquery' ,"", true);
	
		
		//Begin enqueuing
		
		wp_enqueue_script('jquery'); 
		wp_enqueue_script('custom_ui');
		wp_enqueue_script('filterable');
		wp_enqueue_script('mimo_js');
		wp_enqueue_script('frogaloop');
		wp_enqueue_script('hover');
		wp_enqueue_script('spin');
		wp_enqueue_script('jqueryspin');
		wp_enqueue_script('tooltip');
		wp_enqueue_script('mouse_wheel');
		wp_enqueue_script('raty');
		wp_enqueue_script('infinitescroll');
	   wp_enqueue_script('carousel'); 
		wp_enqueue_script('flexslider');
		wp_enqueue_script('responsive-images');
		wp_enqueue_script('prettyPhotoscript');
		wp_enqueue_script('html5');
		wp_enqueue_script('google');
		wp_enqueue_script('css3');
		wp_enqueue_style('jquery-ui-css', get_template_directory_uri() .'/css/jquery-ui.css',false, '1.0', 'all');
		wp_enqueue_style('prettyPhotostyle', get_template_directory_uri() .'/css/prettyPhoto.css',false, '1.0', 'all');
		
	/* Uncomment this if you need to use camera slideshow in widgets
		global $plugindir;
		wp_enqueue_style('camera-css-front', WP_PLUGIN_URL.'/camera-slideshow/css/camera_front.css',
false, '1.0', 'all');
		wp_enqueue_style('camera-css-colorbox', WP_PLUGIN_URL.'/camera-slideshow/css/colorBox'.camera_get_option('camera_colorbox_skin').'/colorbox.css',false, '1.0', 'all');

		*/wp_enqueue_script('jquery-pix');
		wp_enqueue_script('swfobject');
		wp_enqueue_script('jquery-hoverIntent');
		wp_enqueue_script('jquery-easing');
		/*if(camera_get_option('camera_colorbox')=='true') {
		wp_enqueue_script('camera-colorbox');
	}
		if(camera_detectMobile() &&
		camera_get_option('camera_jquerymobile')=='true') {
		wp_enqueue_script('camera-jquery-mobile');
	}

		wp_enqueue_script('camera-slide');
		wp_enqueue_script('camera-init');
	*/
     		}
		
		}



 



?>