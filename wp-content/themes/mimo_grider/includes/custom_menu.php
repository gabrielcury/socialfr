<?php global $registered_skins;

class dc_jqaccordion {

	function dc_jqaccordion(){
		global $registered_skins;
	
		if(!is_admin()){
		
			// Header styles
			add_action( 'init', array('dc_jqaccordion', 'header') );
		
			
		}
		add_action( 'wp_footer', array('dc_jqaccordion', 'footer') );
		
		$registered_skins = array();
	}
function get_plugin_directory(){
		return get_template_directory_uri();	
	}

	function header(){
		
		// Scripts
		
		wp_enqueue_script( 'jqueryhoverintent', get_template_directory_uri() . '/js/jquery.hoverIntent.minified.js', array('jquery') );
		wp_enqueue_script( 'jquerycookie', get_template_directory_uri() . '/js/jquery.cookie.js', array('jquery') );
		wp_enqueue_script( 'dcjqaccordion', get_template_directory_uri() . '/js/jquery.dcjqaccordion.2.9.js', array('jquery') );
	}
	
	function footer(){
		//echo "\n\t";
	}
	
	function options(){}

	
};


// Initialize the plugin.
$dcjqaccordion = new dc_jqaccordion();



?>