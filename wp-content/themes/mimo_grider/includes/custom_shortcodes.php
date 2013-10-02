<?php 

/*
Theme Name: Plus
Theme URI: http://www.mimothemes.com
Description: Wordpress theme by mimothemes
Version: 1.0
Author: Mimo Studio
Author URI: http://www.mimothemes.com */




 

/* Youtube Shortcode 

************************************************************************** */
	
function pixel_youtube($atts)	{
	// WP-Pixel-YouTube v1.0 http://pxsol.info/p0wOuK

	//configuration
	extract(shortcode_atts(array(
		'the_id' =>			'',			// the ID of the YouTube video * SHOULD STAY EMPTY *
		'width' =>				'640',		// the width for the player
		'height' =>				'390',		// the height for the player
		'allowFullScreen' =>	'true',		// offer or not full screen access
		'controls' =>			'true',		// display or not the control buttons
		'autohide' =>			'true',		// hide or not the controls after video start
	), $atts));

	//URL creation
	$optionsSwitch = '';
	if ($allowFullScreen = 'true') {
		$optionsSwitch = $optionsSwitch.'&fs=1';
	} else {
		$optionsSwitch = $optionsSwitch.'&fs=0';
	};
	if ($controls = 'true') {
		$optionsSwitch = $optionsSwitch.'&controls=1';
	} else {
		$optionsSwitch = $optionsSwitch.'&controls=0';
	};
	if ($autohide = 'true') {
		$optionsSwitch = $optionsSwitch.'&autohide=1';
	} else {
		$optionsSwitch = $optionsSwitch.'&autohide=0';
	};

	//generation
	$generated_output = '<object style="height: '.$height.'px; width: '.$width.'px">
	<param name="movie" value="http://www.youtube.com/v/'.$the_id.'?version=3'.$optionsSwitch.'"></param>
	<param name="allowFullScreen" value="'.$allowFullScreen.'"></param><param name="allowScriptAccess" value="always"></param><embed src="http://www.youtube.com/v/'.$the_id.'?version=3'.$optionsSwitch.'" type="application/x-shockwave-flash" allowfullscreen="'.$allowFullScreen.'" allowScriptAccess="always" width="'.$width.'"	height="'.$height.'"></embed></object>';

	//error catcher
	if (empty($the_id)) {
		$generated_output = '<span class="error-pixel_youtube">You must set the ID of the YouTube video.</span>';
	};

	//output
	return $generated_output;
}
add_shortcode('youtube', 'pixel_youtube');



/* Columns Shortcode 

************************************************************************** */

function webtreats_one_third( $atts, $content = null ) {
   return '<div class="one_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_third', 'webtreats_one_third');

function webtreats_one_third_last( $atts, $content = null ) {
   return '<div class="one_third last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_third_last', 'webtreats_one_third_last');

function webtreats_two_third( $atts, $content = null ) {
   return '<div class="two_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_third', 'webtreats_two_third');

function webtreats_two_third_last( $atts, $content = null ) {
   return '<div class="two_third last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('two_third_last', 'webtreats_two_third_last');

function webtreats_one_half( $atts, $content = null ) {
   return '<div class="one_half">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_half', 'webtreats_one_half');

function webtreats_one_half_last( $atts, $content = null ) {
   return '<div class="one_half last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_half_last', 'webtreats_one_half_last');

function webtreats_one_fourth( $atts, $content = null ) {
   return '<div class="one_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fourth', 'webtreats_one_fourth');

function webtreats_one_fourth_last( $atts, $content = null ) {
   return '<div class="one_fourth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_fourth_last', 'webtreats_one_fourth_last');

function webtreats_three_fourth( $atts, $content = null ) {
   return '<div class="three_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fourth', 'webtreats_three_fourth');

function webtreats_three_fourth_last( $atts, $content = null ) {
   return '<div class="three_fourth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('three_fourth_last', 'webtreats_three_fourth_last');

function webtreats_one_fifth( $atts, $content = null ) {
   return '<div class="one_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fifth', 'webtreats_one_fifth');

function webtreats_one_fifth_last( $atts, $content = null ) {
   return '<div class="one_fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_fifth_last', 'webtreats_one_fifth_last');

function webtreats_two_fifth( $atts, $content = null ) {
   return '<div class="two_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_fifth', 'webtreats_two_fifth');

function webtreats_two_fifth_last( $atts, $content = null ) {
   return '<div class="two_fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('two_fifth_last', 'webtreats_two_fifth_last');

function webtreats_three_fifth( $atts, $content = null ) {
   return '<div class="three_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fifth', 'webtreats_three_fifth');

function webtreats_three_fifth_last( $atts, $content = null ) {
   return '<div class="three_fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('three_fifth_last', 'webtreats_three_fifth_last');

function webtreats_four_fifth( $atts, $content = null ) {
   return '<div class="four_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('four_fifth', 'webtreats_four_fifth');

function webtreats_four_fifth_last( $atts, $content = null ) {
   return '<div class="four_fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('four_fifth_last', 'webtreats_four_fifth_last');

function webtreats_one_sixth( $atts, $content = null ) {
   return '<div class="one_sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_sixth', 'webtreats_one_sixth');

function webtreats_one_sixth_last( $atts, $content = null ) {
   return '<div class="one_sixth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_sixth_last', 'webtreats_one_sixth_last');

function webtreats_five_sixth( $atts, $content = null ) {
   return '<div class="five_sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('five_sixth', 'webtreats_five_sixth');

function webtreats_five_sixth_last( $atts, $content = null ) {
   return '<div class="five_sixth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('five_sixth_last', 'webtreats_five_sixth_last');

/* Shortcodes for frases 

************************************************************************** */

function frase_shortcode( $atts, $content = null ) {
   return '<span class="frase">' . do_shortcode($content) . '</span>';
}
add_shortcode('frase', 'frase_shortcode');

function mediumfrase_shortcode( $atts, $content = null ) {
   return '<span class="mediumfrase">' . do_shortcode($content) . '</span>';
}
add_shortcode('mediumfrase', 'mediumfrase_shortcode');

function smallfrase_shortcode( $atts, $content = null ) {
   return '<span class="smallfrase">' . do_shortcode($content) . '</span>';
}
add_shortcode('smallfrase', 'smallfrase_shortcode');


function fraseblock_shortcode( $atts, $content = null ) {
   return '<span class="fraseblock">' . do_shortcode($content) . '</span>';
}
add_shortcode('fraseblock', 'fraseblock_shortcode');

function mediumfraseblock_shortcode( $atts, $content = null ) {
   return '<span class="mediumfraseblock">' . do_shortcode($content) . '</span>';
}
add_shortcode('mediumfraseblock', 'mediumfraseblock_shortcode');

function smallfraseblock_shortcode( $atts, $content = null ) {
   return '<span class="smallfraseblock">' . do_shortcode($content) . '</span>';
}
add_shortcode('smallfraseblock', 'smallfraseblock_shortcode');


/* Add shortcode buttons in Editor 

************************************************************************** */


add_action('init', 'add_button'); 
    function add_button() {  
       if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )  
       {  
         add_filter('mce_external_plugins', 'add_plugin');  
         add_filter('mce_buttons_3', 'register_button');  
       }  
    }  
        function register_button($buttons) {  
       array_push($buttons, '|', "quote");  
       return $buttons;  
    }  
        function add_plugin($plugin_array) {  
       $plugin_array['quote'] = get_template_directory_uri().'/js/admin/customcodes.js';  
       return $plugin_array;  
    }  
 add_action('init', 'add_button1'); 
    function add_button1() {  
       if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )  
       {  
         add_filter('mce_external_plugins', 'add_plugin1');  
         add_filter('mce_buttons_3', 'register_button1');  
       }  
    }  
        function register_button1($buttons) {  
       array_push($buttons, "3col");  
       return $buttons;  
    }  
        function add_plugin1($plugin_array) {  
       $plugin_array['3col'] = get_template_directory_uri().'/js/admin/customcodes.js';  
       return $plugin_array;  
    }  

add_action('init', 'add_button2'); 
    function add_button2() {  
       if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )  
       {  
         add_filter('mce_external_plugins', 'add_plugin2');  
         add_filter('mce_buttons_3', 'register_button2');  
       }  
    }  
        function register_button2($buttons) {  
       array_push($buttons, "4col");  
       return $buttons;  
    }  
        function add_plugin2($plugin_array) {  
       $plugin_array['4col'] = get_template_directory_uri().'/js/admin/customcodes.js';  
       return $plugin_array;  
    }  
    add_action('init', 'add_button3'); 
    function add_button3() {  
       if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )  
       {  
         add_filter('mce_external_plugins', 'add_plugin3');  
         add_filter('mce_buttons_3', 'register_button3');  
       }  
    }  
        function register_button3($buttons) {  
       array_push($buttons, "5col");  
       return $buttons;  
    }  
        function add_plugin3($plugin_array) {  
       $plugin_array['5col'] = get_template_directory_uri().'/js/admin/customcodes.js';  
       return $plugin_array;  
    }  
    
    add_action('init', 'add_button4'); 
    function add_button4() {  
       if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )  
       {  
         add_filter('mce_external_plugins', 'add_plugin4');  
         add_filter('mce_buttons_3', 'register_button4');  
       }  
    }  
        function register_button4($buttons) {  
       array_push($buttons, "6col");  
       return $buttons;  
    }  
        function add_plugin4($plugin_array) {  
       $plugin_array['6col'] = get_template_directory_uri().'/js/admin/customcodes.js';  
       return $plugin_array;  
    }  
 add_action('init', 'add_button5'); 
    function add_button5() {  
       if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )  
       {  
         add_filter('mce_external_plugins', 'add_plugin5');  
         add_filter('mce_buttons_3', 'register_button5');  
       }  
    }  
        function register_button5($buttons) {  
       array_push($buttons, '|', "tabs");  
       return $buttons;  
    }  
        function add_plugin5($plugin_array) {  
       $plugin_array['tabs'] = get_template_directory_uri().'/js/admin/customcodes.js';  
       return $plugin_array;  
    }  
	
	add_action('init', 'add_button6'); 
    function add_button6() {  
       if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )  
       {  
         add_filter('mce_external_plugins', 'add_plugin6');  
         add_filter('mce_buttons_3', 'register_button6');  
       }  
    }  
        function register_button6($buttons) {  
       array_push($buttons, "accordion");  
       return $buttons;  
    }  
        function add_plugin6($plugin_array) {  
       $plugin_array['accordion'] = get_template_directory_uri().'/js/admin/customcodes.js';  
       return $plugin_array;  
    }  
add_action('init', 'add_button7'); 
    function add_button7() {  
       if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )  
       {  
         add_filter('mce_external_plugins', 'add_plugin7');  
         add_filter('mce_buttons_3', 'register_button7');  
       }  
    }  
        function register_button7($buttons) {  
       array_push($buttons, "soundcloud");  
       return $buttons;  
    }  
        function add_plugin7($plugin_array) {  
       $plugin_array['soundcloud'] = get_template_directory_uri().'/js/admin/customcodes.js';  
       return $plugin_array;  
    }  
	
        
	add_action('init', 'add_button9'); 
    function add_button9() {  
       if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )  
       {  
         add_filter('mce_external_plugins', 'add_plugin9');  
         add_filter('mce_buttons_3', 'register_button9');  
       }  
    }  
        function register_button9($buttons) {  
       array_push($buttons, '|', "frase");  
       return $buttons;  
    }  
        function add_plugin9($plugin_array) {  
       $plugin_array['frase'] = get_template_directory_uri().'/js/admin/customcodes.js';  
       return $plugin_array;  
    } 
	add_action('init', 'add_button10'); 
    function add_button10() {  
       if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )  
       {  
         add_filter('mce_external_plugins', 'add_plugin10');  
         add_filter('mce_buttons_3', 'register_button10');  
       }  
    }  
        function register_button10($buttons) {  
       array_push($buttons, "mediumfrase");  
       return $buttons;  
    }  
        function add_plugin10($plugin_array) {  
       $plugin_array['mediumfrase'] = get_template_directory_uri().'/js/admin/customcodes.js';  
       return $plugin_array;  
    }
	add_action('init', 'add_button11'); 
    function add_button11() {  
       if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )  
       {  
         add_filter('mce_external_plugins', 'add_plugin11');  
         add_filter('mce_buttons_3', 'register_button11');  
       }  
    }  
        function register_button11($buttons) {  
       array_push($buttons, "smallfrase");  
       return $buttons;  
    }  
        function add_plugin11($plugin_array) {  
       $plugin_array['smallfrase'] = get_template_directory_uri().'/js/admin/customcodes.js';  
       return $plugin_array;  
    } 
	add_action('init', 'add_button12'); 
    function add_button12() {  
       if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )  
       {  
         add_filter('mce_external_plugins', 'add_plugin12');  
         add_filter('mce_buttons_3', 'register_button12');  
       }  
    }  
        function register_button12($buttons) {  
       array_push($buttons, "fraseblock");  
       return $buttons;  
    }  
        function add_plugin12($plugin_array) {  
       $plugin_array['fraseblock'] = get_template_directory_uri().'/js/admin/customcodes.js';  
       return $plugin_array;  
    }   


add_action('init', 'add_button13'); 
    function add_button13() {  
       if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )  
       {  
         add_filter('mce_external_plugins', 'add_plugin13');  
         add_filter('mce_buttons_3', 'register_button13');  
       }  
    }  
        function register_button13($buttons) {  
       array_push($buttons, "mediumfraseblock");  
       return $buttons;  
    }  
        function add_plugin13($plugin_array) {  
       $plugin_array['mediumfraseblock'] = get_template_directory_uri().'/js/admin/customcodes.js';  
       return $plugin_array;  
    }
	add_action('init', 'add_button14'); 
    function add_button14() {  
       if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )  
       {  
         add_filter('mce_external_plugins', 'add_plugin14');  
         add_filter('mce_buttons_3', 'register_button14');  
       }  
    }  
        function register_button14($buttons) {  
       array_push($buttons, "smallfraseblock");  
       return $buttons;  
    }  
        function add_plugin14($plugin_array) {  
       $plugin_array['smallfraseblock'] = get_template_directory_uri().'/js/admin/customcodes.js';  
       return $plugin_array;  
    }
 /* Add shortcodes to tynimc editor */
 
 if ( ! defined( 'ABSPATH' ) )
	die( "Can't load this file directly" );




/* Tabs shortcode 

************************************************************************** */


add_shortcode( 'tabgroup', 'jqtools_tab_group' );
function jqtools_tab_group( $atts, $content ){
$GLOBALS['tab_count'] = 0;

do_shortcode( $content );

if( is_array( $GLOBALS['tabs'] ) ){
foreach( $GLOBALS['tabs'] as $tab ){
	
$tabs[] = '<li><a href="#'.$tab['name'].'">'.$tab['title'].'</a></li>';
$panes[] = '<div id="'.$tab['name'].'" class="tabdiv">' . do_shortcode($tab['content']) .'</div>';
}


$return = "\n".'<!-- the tabs --><div id="tabvanilla" class="widget"><ul class="tabnav">'.implode( "\n", $tabs ).'</ul>'."\n".'<!-- tab "panes" -->'.implode( "\n", do_shortcode( $panes ) ).''."\n".'</div>';


}
return str_replace("\r\n\<p>\</p>\<br>\<br/>", '', $return);

}

add_shortcode( 'tab', 'jqtools_tab' );
function jqtools_tab( $atts, $content ){
extract(shortcode_atts(array(
'title' => 'Tab %d',
'name' => 'tab%d'
), $atts));

$x = $GLOBALS['tab_count'];

$GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ),'name' => sprintf( $name, $GLOBALS['tab_count'] ), 'content' =>  do_shortcode( $content ) );

$GLOBALS['tab_count']++;

}

/* Left Tab Shortcode 

************************************************************************** */

add_shortcode( 'lefttabgroup', 'leftjqtools_tab_group' );
function leftjqtools_tab_group( $atts, $content ){
$GLOBALS['lefttab_count'] = 0;

do_shortcode( $content );

if( is_array( $GLOBALS['lefttabs'] ) ){
foreach( $GLOBALS['lefttabs'] as $lefttab ){
	
$lefttabs[] = '<li><a class="" href="#'.$lefttab['name'].'">'.$lefttab['title'].'</a></li>';
$leftpanes[] = '<div id="'.$lefttab['name'].'" class="lefttabdiv">' . do_shortcode($lefttab['content']) .'</div>';
}


$return = "\n".'<!-- the tabs --><div id="lefttabvanilla" class="widget"><ul class="lefttabnav">'.implode( "\n", $lefttabs ).'</ul>'."\n".'<!-- tab "leftpanes" -->'.implode( "\n", $leftpanes ).''."\n".'<div class="clear"></div></div>';


}
return $return;
}

add_shortcode( 'lefttab', 'leftjqtools_tab' );
function leftjqtools_tab( $atts, $content ){
extract(shortcode_atts(array(
'title' => 'leftTab %d',
'name' => 'lefttab%d'
), $atts));

$leftx = $GLOBALS['lefttab_count'];
$GLOBALS['lefttabs'][$leftx] = array( 'title' => sprintf( $title, $GLOBALS['lefttab_count'] ),'name' => sprintf( $name, $GLOBALS['lefttab_count'] ), 'content' =>  $content );

$GLOBALS['lefttab_count']++;
}


/* jQuery Tools - accordions shortcode

************************************************************************** */


add_shortcode( 'accordiongroup', 'jqtools_accordion_group' );
function jqtools_accordion_group( $atts, $content ){
$GLOBALS['accordion_count'] = 0;

do_shortcode( $content );

if( is_array( $GLOBALS['accordions'] ) ){
foreach( $GLOBALS['accordions'] as $accordion ){
	
$accordions[] = '<li><a class="heading" href="#'.$accordion['name'].'">'.$accordion['title'].'</a><div id="'.$accordion['name'].'" class="accordiondiv">'.$accordion['content'].'</div></li>';
$panes[] = '';
}


$return = "\n".'<!-- the accordions --><ul id="accordion">'.implode( "\n", $accordions ).''."\n".'</ul>';


}
return $return;
}

add_shortcode( 'accordion', 'jqtools_accordion' );
function jqtools_accordion( $atts, $content ){
extract(shortcode_atts(array(
'title' => 'accordion %d',
'name' => 'accordion%d'
), $atts));

$x = $GLOBALS['accordion_count'];
$GLOBALS['accordions'][$x] = array( 'title' => sprintf( $title, $GLOBALS['accordion_count'] ),'name' => sprintf( $name, $GLOBALS['accordion_count'] ), 'content' =>  $content );
$GLOBALS['accordion_count']++;
}




/* Styles Dropdown 

************************************************************************** */

function themeit_mce_buttons_2( $buttons ) {
  array_unshift( $buttons, 'styleselect' );
  return $buttons;
}
add_filter( 'mce_buttons_3', 'themeit_mce_buttons_2' );
function themeit_tiny_mce_before_init( $settings ) {
  $settings['theme_advanced_blockformats'] = 'p,a,div,span,h1,h2,h3,h4,h5,h6,tr,hr';
  $style_formats = array(
   	  array( 'title' => 'Frases' ),
      array( 'title' => 'Frase',         'inline' => 'span',  'classes' => 'frase' ),
      array( 'title' => 'Medium frase',   'inline' => 'span',  'classes' => 'mediumfrase' ),
      array( 'title' => 'Small Frase', 'inline' => 'span',  'classes' => 'smallfrase' ),
      array( 'title' => 'Block Frases' ),
      array( 'title' => 'Frase Block',         'inline' => 'span',  'classes' => 'fraseblock' ),
      array( 'title' => 'Medium frase Block',   'inline' => 'span',  'classes' => 'mediumfraseblock' ),
      array( 'title' => 'Small Frase Block', 'inline' => 'span',  'classes' => 'smallfraseblock' ),
	  array( 'title' => 'Color Frases' ),
	  array( 'title' => 'Fc Frase Block',         'inline' => 'span',  'classes' => 'fcfraseblock' ),
      array( 'title' => 'Fc Medium frase Block',   'inline' => 'span',  'classes' => 'fcmediumfraseblock' ),
      array( 'title' => 'Fc Small Frase Block', 'inline' => 'span',  'classes' => 'fcsmallfraseblock' ),
	  array( 'title' => 'Sc Frase Block',         'inline' => 'span',  'classes' => 'scfraseblock' ),
      array( 'title' => 'Sc Medium frase Block',   'inline' => 'span',  'classes' => 'scmediumfraseblock' ),
      array( 'title' => 'Sc Small Frase Block', 'inline' => 'span',  'classes' => 'scsmallfraseblock' ),
	  array( 'title' => 'Tc Frase Block',         'inline' => 'span',  'classes' => 'tcfraseblock' ),
      array( 'title' => 'Tc Medium frase Block',   'inline' => 'span',  'classes' => 'tcmediumfraseblock' ),
      array( 'title' => 'Tc Small Frase Block', 'inline' => 'span',  'classes' => 'tcsmallfraseblock' ),
  );
  $settings['style_formats'] = json_encode( $style_formats );
  return $settings;
}
add_filter( 'tiny_mce_before_init', 'themeit_tiny_mce_before_init' );


class BoostrapShortcodes {

  function __construct() {
    add_action( 'init', array( $this, 'add_shortcodes' ) ); 
  }


  /*--------------------------------------------------------------------------------------
    *
    * add_shortcodes
    *
    * @author Filip Stefansson
    * @since 1.0
    * 
    *-------------------------------------------------------------------------------------*/
  function add_shortcodes() {

    add_shortcode('button', array( $this, 'bs_button' ));    
    add_shortcode('alert', array( $this, 'bs_alert' ));
    add_shortcode('code', array( $this, 'bs_code' ));
    add_shortcode('span', array( $this, 'bs_span' ));
    add_shortcode('row', array( $this, 'bs_row' ));
    add_shortcode('label', array( $this, 'bs_label' ));
    add_shortcode('badge', array( $this, 'bs_badge' ));
    add_shortcode('icon', array( $this, 'bs_icon' ));
    add_shortcode('icon_white', array( $this, 'bs_icon_white' ));
    add_shortcode('table', array( $this, 'bs_table' ));
    add_shortcode('collapsibles', array( $this, 'bs_collapsibles' ));
    add_shortcode('collapse', array( $this, 'bs_collapse' ));
    add_shortcode('well', array( $this, 'bs_well' ));
    add_shortcode('tabs', array( $this, 'bs_tabs' ));
    add_shortcode('tab', array( $this, 'bs_tab' ));

  }



  /*--------------------------------------------------------------------------------------
    *
    * bs_button
    *
    * @author Filip Stefansson
    * @since 1.0
    * //DW mod added xclass var
    *-------------------------------------------------------------------------------------*/
  function bs_button($atts, $content = null) {
     extract(shortcode_atts(array(
        "type" => '',
        "size" => '',
        "link" => '',
        "xclass" => ''
     ), $atts));
     return '<a href="' . $link . '" class="btn btn-' . $type . ' btn-' . $size . ' ' . $xclass . '">' . do_shortcode( $content ) . '</a>';
  }
  


  /*--------------------------------------------------------------------------------------
    *
    * bs_alert
    *
    * @author Filip Stefansson
    * @since 1.0
    * 
    *-------------------------------------------------------------------------------------*/
  function bs_alert($atts, $content = null) {
     extract(shortcode_atts(array(
        "type" => '',
        "close" => true
     ), $atts));
     return '<div class="alert alert-' . $type . '">' . do_shortcode( $content ) . '<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
  }
  



  /*--------------------------------------------------------------------------------------
    *
    * bs_code
    *
    * @author Filip Stefansson
    * @since 1.0
    * 
    *-------------------------------------------------------------------------------------*/
  function bs_code($atts, $content = null) {
     extract(shortcode_atts(array(
        "type" => '',
        "size" => '',
        "link" => ''
     ), $atts));
     return '<pre><code>' . do_shortcode( $content ) . '</code></pre>';
  }
  



  /*--------------------------------------------------------------------------------------
    *
    * bs_span
    *
    * @author Filip Stefansson
    * @since 1.0
    * 
    *-------------------------------------------------------------------------------------*/
  function bs_span( $atts, $content = null ) {
    extract(shortcode_atts(array(
      "size" => 'size'
    ), $atts));

    return '<div class="span' . $size . '">' . do_shortcode( $content ) . '</div>';

  }

  


  /*--------------------------------------------------------------------------------------
    *
    * bs_row
    *
    * @author Filip Stefansson
    * @since 1.0
    * 
    *-------------------------------------------------------------------------------------*/
  function bs_row( $atts, $content = null ) {
    
    return '<div class="row-fluid">' . do_shortcode( $content ) . '</div>';

  }
  



  /*--------------------------------------------------------------------------------------
    *
    * bs_label
    *
    * @author Filip Stefansson
    * @since 1.0
    * 
    *-------------------------------------------------------------------------------------*/
  function bs_label( $atts, $content = null ) {
    extract(shortcode_atts(array(
      "type" => 'type'
    ), $atts));

    return '<span class="label label-' . $type . '">' . do_shortcode( $content ) . '</span>';

  }
  



  /*--------------------------------------------------------------------------------------
    *
    * bs_badge
    *
    * @author Filip Stefansson
    * @since 1.0
    * 
    *-------------------------------------------------------------------------------------*/
  function bs_badge( $atts, $content = null ) {
    extract(shortcode_atts(array(
      "type" => 'type'
    ), $atts));

    return '<span class="badge badge-' . $type . '">' . do_shortcode( $content ) . '</span>';

  }
  



  /*--------------------------------------------------------------------------------------
    *
    * bs_icon
    *
    * @author Filip Stefansson
    * @since 1.0
    *  //DW Mod to add icon sizing
    *-------------------------------------------------------------------------------------*/
  function bs_icon( $atts, $content = null ) {
    extract(shortcode_atts(array(
      "type" => 'type',
      "size" => 'normal',
    ), $atts));

    return '<i class="icon icon-' . $type . ' icon-' . $size .'"></i>'; 

  }
  



  /*--------------------------------------------------------------------------------------
    *
    * bs_icon_white
    *
    * @author Filip Stefansson
    * @since 1.0
    * 
    *-------------------------------------------------------------------------------------*/
  function bs_icon_white( $atts, $content = null ) {
    extract(shortcode_atts(array(
      "type" => 'type'
    ), $atts));

    return '<i class="icon icon-' . $type . ' icon-white"></i>';

  }
  




  /*--------------------------------------------------------------------------------------
    *
    * simple_table
    *
    * @author Filip Stefansson
    * @since 1.0
    * 
    *-------------------------------------------------------------------------------------*/
  function bs_table( $atts ) {
      extract( shortcode_atts( array(
          'cols' => 'none',
          'data' => 'none',
          'type' => 'type'
      ), $atts ) );
      $cols = explode(',',$cols);
      $data = explode(',',$data);
      $total = count($cols);
      $output = '';
      $output .= '<table class="table table-'. $type .' table-bordered"><tr>';
      foreach($cols as $col):
          $output .= '<th>'.$col.'</th>';
      endforeach;
      $output .= '</tr><tr>';
      $counter = 1;
      foreach($data as $datum):
          $output .= '<td>'.$datum.'</td>';
          if($counter%$total==0):
              $output .= '</tr>';
          endif;
          $counter++;
      endforeach;
          $output .= '</table>';
      return $output;
  }
  



  /*--------------------------------------------------------------------------------------
    *
    * bs_well
    *
    * @author Filip Stefansson
    * @since 1.0
    * 
    *-------------------------------------------------------------------------------------*/
    function bs_well( $atts, $content = null ) {
      extract(shortcode_atts(array(
        "size" => 'size'
      ), $atts));

      return '<div class="well well-' . $size . '">' . do_shortcode( $content ) . '</div>';
    }
  


}

new BoostrapShortcodes()


?>