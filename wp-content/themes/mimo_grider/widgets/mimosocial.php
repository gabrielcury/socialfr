<?php
/**
 
 * Social Widget by framecero
 
 **/ 
 
defined('GANTRY_VERSION') or die();

gantry_import('core.gantrywidget');

add_action('widgets_init', array("GantryWidgetMimoSocial","init"));
add_action('admin_head-widgets.php', array('GantryWidgetMimoSocial','addHeaders'),-1000);


class GantryWidgetMimoSocial extends GantryWidget {
    var $short_name = 'mimosocial';
    var $wp_name = 'gantry_mimosocial';
    var $long_name = 'Mimo Custom Social';
    var $description = 'Mimo Custom Social Widget';
    var $css_classname = 'widget_gantry_mimosocial';
    var $width = 200;
    var $height = 400;
    
    

    function init() {
        register_widget("GantryWidgetMimoSocial");
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
		  $google = $instance['google'];
		  $stumbleupon = $instance['stumbleupon'];
		  $linkedin = $instance['linkedin'];
		  $youtube = $instance['youtube'];
		  $rss = $instance['rss'];
		  $mail = $instance['mail'];
			
		
		
		
		
		

 		?>
		<div>
		<ul class="mimo_social">
        	
		
			<?php if ($twitter !== ''){ ?>
<li><div class="all_icon twitterall"><div class="twitter"><a href="<?php echo $twitter; ?>" target="_blank" ><span class="twitter_icon"></span></a>
	</div></div>
	</li>			
					<?php  };?>
                    
                    <?php if ($facebook !== ''){ ?>
<li><div class="all_icon facebookall"><div class="facebook"><a href="<?php echo $facebook; ?>" target="_blank" ><span class="facebook_icon"></span></a></div></div>
	
	</li>			
					<?php  };?>
            
            			<?php if ($google !== ''){  ?>
<li><div class="all_icon googleall"><div class="google"><a href="<?php echo $google; ?>" target="_blank" ><span class="google_icon"></span></a>
	</div></div>
	</li>			
			 		<?php  };?>	
                    <?php if ($stumbleupon !== ''){  ?>
<li><div class="all_icon stumbleuponall"><div class="stumbleupon"><a href="<?php echo $stumbleupon; ?>" target="_blank" ><span class="stumbleupon_icon"></span></a>
	</div></div>
	</li>			
			 		<?php  };?>	
                    <?php if ($linkedin !== ''){  ?>
<li><div class="all_icon linkedinall"><div class="linkedin"><a href="<?php echo $linkedin; ?>" target="_blank" ><span class="linkedin_icon"></span></a>
	</div></div>
	</li>			
			 		<?php  };?>	
                    <?php if ($youtube !== ''){  ?>
<li><div class="all_icon youtubeall"><div class="youtube"><a href="<?php echo $youtube; ?>" target="_blank" ><span class="youtube_icon"></span></a>
	</div></div>
	</li>			
			 		<?php  };?>	
                    <?php if ($rss !== ''){  ?>
<li><div class="all_icon rssall"><div class="rss"><a href="<?php echo $rss; ?>" target="_blank" ><span class="rss_icon"></span></a>
	</div></div>
	</li>			
			 		<?php  };?>	
                    <?php if ($mail !== ''){  ?>
<li><div class="all_icon mailall"><div class="mail"><a href="mailto:<?php echo $mail; ?>" target="_blank" ><span class="mail_icon"></span></a>
	</div></div><div class="clear"></div>
	</li>			
			 		<?php  };?>	
     
     
     
     
     
     
     
     
     

			
		
		</ul>
        <div class="clear"></div>	
        </div>
        <script type="text/javascript">
        
        jQuery(function() {
			jQuery('.twitterall').hover(function(){
				
				jQuery(this).stop().animate({opacity:'0.5'},500);
				
				
			}, function(){
					jQuery(this).stop().animate({opacity:1},500);
				
				
			});
			
			jQuery('.facebookall').hover(function(){
				
				jQuery(this).stop().animate({opacity:0.5},'fast');
				
				
			}, function(){
					jQuery(this).stop().animate({opacity:1},'fast');
				
				
			});
			
			jQuery('.googleall').hover(function(){
				
				jQuery(this).stop().animate({opacity:0.5},'fast');
				
				
			}, function(){
					jQuery(this).stop().animate({opacity:1},'fast');
				
					
			});
			
			jQuery('.stumbleuponall').hover(function(){
				
				jQuery(this).stop().animate({opacity:0.5},'fast');
				
				
			}, function(){
					jQuery(this).stop().animate({opacity:1},'fast');
				
					
			});
			
			jQuery('.linkedinall').hover(function(){
				
				jQuery(this).stop().animate({opacity:0.5},'fast');
				
				
			}, function(){
					jQuery(this).stop().animate({opacity:1},'fast');
				
					
			});
			
			jQuery('.youtubeall').hover(function(){
				
				jQuery(this).stop().animate({opacity:0.5},'fast');
				
				
			}, function(){
					jQuery(this).stop().animate({opacity:1},'fast');
				
					
			});
			
			jQuery('.rssall').hover(function(){
				
				jQuery(this).stop().animate({opacity:0.5},'fast');
				
				
			}, function(){
					jQuery(this).stop().animate({opacity:1},'fast');
				
					
			});
			
			jQuery('.mailall').hover(function(){
				
				jQuery(this).stop().animate({opacity:0.5},'fast');
					
				
			}, function(){
					jQuery(this).stop().animate({opacity:1},'fast');
				
			});
		});</script>

		<?php
		echo ob_get_clean();
	}

function addHeaders(){
        global $gantry;
        $gantry->addScript(get_template_directory_uri() .'/js/admin/mimosocial.js');
		
    }	    
	
} 