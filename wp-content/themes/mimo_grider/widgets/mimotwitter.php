<?php

 /**
 
 * Twitter Widget by framecero
 
 **/ 
 
defined('GANTRY_VERSION') or die();

gantry_import('core.gantrywidget');

add_action('widgets_init', array("GantryWidgetMimoTwitter","init"));
add_action('admin_head-widgets.php', array('GantryWidgetMimoTwitter','addHeaders'),-1000);



class GantryWidgetMimoTwitter extends GantryWidget {
    var $short_name = 'mimotwitter';
    var $wp_name = 'gantry_mimotwitter';
    var $long_name = 'Mimo Custom Twitter';
    var $description = 'Mimo Custom Twitter Widget';
    var $css_classname = 'widget_gantry_mimotwitter';
    var $width = 200;
    var $height = 400;
    
    

    function init() {
        register_widget("GantryWidgetMimoTwitter");
    }
    
    function render_title($args, $instance) {
    	global $gantry;
    	if($instance['title'] != '') :
    		echo $instance['title'];
    	endif;
    }

    function render($args, $instance){
        global $gantry;
	    
	    ob_start();
		$menu_class = $instance['menu_class'];
	    $title 	 = $instance['title'];
	    $twitteruser = $instance['twitteruser'];
		$tweets = $instance['tweets'];
	    
		if($menu_class != '') :
			$menu_class = ' class="'.$menu_class.'"';
		else :
			$menu_class = '';
		endif;
		
		
		
	
$notweets = $tweets;
$consumerkey = "RX45W3VzO85jRo0pZZw";
$consumersecret = "jSRhhHvdBFPZ3RWlctk4dyH82bouCTJOZrMTldppTk4";
$accesstoken = "788867408-NEqh7Zn5Mocf38Uv8zfSXzrMcuSaLVMd8F9VenJQ";
$accesstokensecret = "pt0AeQXWooggR3srXfXeQrcljeZ8wiOziwTETLlz4g";

  
$connection = new TwitterOAuth($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
 
$tweets2 = $connection->get('statuses/user_timeline', array('screen_name'=>$twitteruser,'count'=>$notweets));


 
 		?>
		
		<ul class="tweet_list" >
        <?php foreach ($tweets2 as $obj){
			echo '<li ><div class="tweet_date">'.$obj->created_at.'</div><div class="tweet_text">'.$obj->text. '</div></li>';
			}
        ?>
        </ul>
        <div class="clear"></div>
        



		<?php
		echo ob_get_clean();
	}
function addHeaders(){
        global $gantry;
          $gantry->addScript(get_template_directory_uri() .'/js/admin/mimotwitter.js');
		  
		
    }	    
	    
	
} 