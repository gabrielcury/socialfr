<?php

 /**
 
 * Share Widget by framecero
 
 **/ 
 
defined('GANTRY_VERSION') or die();

gantry_import('core.gantrywidget');

add_action('widgets_init', array("GantryWidgetMimoShare","init"));
add_action('admin_head-widgets.php', array('GantryWidgetMimoShare','addHeaders'),-1000);


class GantryWidgetMimoShare extends GantryWidget {
    var $short_name = 'mimoshare';
    var $wp_name = 'gantry_mimoshare';
    var $long_name = 'Mimo Custom Share';
    var $description = 'Mimo Custom Share Widget';
    var $css_classname = 'widget_gantry_mimoshare';
    var $width = 200;
    var $height = 400;
    
    

    function init() {
        register_widget("GantryWidgetMimoShare");
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
	    $twitter = $instance['twitter'];
		$facebook = $instance['facebook'];
		$rss_link = $instance['rss_link'];
	    
		if($menu_class != '') :
			$menu_class = ' class="'.$menu_class.'"';
		else :
			$menu_class = '';
		endif;
		
		
		
		
 
 		?>
		
		<?php


?>

<ul class="icons da-thumbs">
<li class="rss_count"><div class="share-info"><a href="<?php echo $rss_link;?>" target="_blank"><?php _e('Subscribe',"grider"); ?><br/><?php _re('Here',"grider"); ?></a><div class="gotopost da-animate da-slideFromRight"  style="display: block;"><div class="rss_count_in"><div class="share-info"><a href="<?php echo $rss_link;?>" target="_blank"><?php _re('Subscribe',"grider"); ?><br/><?php _re('Here',"grider"); ?></a></div></div></div><div class="clear"></div></div>

</li>
<li class="twitter_count"><div class="share-info"><a href="https:&#47;&#47;twitter.com&#47;<?php echo $twitter; ?>" target="_blank"><?php echo twitterCounts($twitter);?><br/><?php _e('Followers',"grider"); ?></a><div class="gotopost da-animate da-slideFromRight"  style="display: block;"><div class="twitter_count_in"><div class="share-info"><a href="https:&#47;&#47;twitter.com&#47;<?php echo $twitter; ?>" target="_blank"><?php echo twitterCounts($twitter);?><br/><?php _e('Followers',"grider"); ?></a></div></div></div><div class="clear"></div></div>

</li>
<li class="facebook_count"><div class="share-info"><a href="https:&#47;&#47;facebook.com&#47;<?php echo $facebook ?>" target="_blank"><?php echo facebook_like_count($facebook);?><br/><?php _e('Likes',"grider"); ?></a><div class="gotopost da-animate da-slideFromRight"  style="display: block;"><div class="facebook_count_in"><div class="share-info"><a href="https:&#47;&#47;facebook.com&#47;<?php echo $facebook ?>" target="_blank"><?php echo facebook_like_count($facebook);?><br/><?php _e('Likes',"grider"); ?></a></div></div></div><div class="clear"></div></div>

</li>

</ul>



<div class="clear"></div>	
		<?php
		echo ob_get_clean();
	}

function addHeaders(){
        global $gantry;
         $gantry->addScript(get_template_directory_uri() .'/js/admin/mimoshare.js');
		
    }	    
	
} 