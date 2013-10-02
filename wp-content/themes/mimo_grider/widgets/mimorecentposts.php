<?php
/**
 
 * Recent Posts Widget by framecero
 
 **/ 
 
defined('GANTRY_VERSION') or die();

gantry_import('core.gantrywidget');

add_action('widgets_init', array("GantryWidgetMimoRecentPosts","init"));
add_action('admin_head-widgets.php', array('GantryWidgetMimoRecentPosts','addHeaders'),-1000);
add_action('comment_post', array("GantryWidgetMimoRecentPosts", 'gantry_flush_widget_cache'));
add_action('transition_comment_status', array("GantryWidgetMimoRecentPosts", 'gantry_flush_widget_cache'));


class GantryWidgetMimoRecentPosts extends GantryWidget {
    var $short_name = 'mimorecentposts';
    var $wp_name = 'gantry_mimorecentposts';
    var $long_name = 'Mimo Custom Recent Posts';
    var $description = 'Mimo Custom Recent Posts Widget';
    var $css_classname = 'widget_gantry_mimorecentposts';
    var $width = 200;
    var $height = 400;
    
    function gantry_flush_widget_cache() {
		wp_cache_delete('gantry_mimorecentposts', 'widget');
	}

    function init() {
        register_widget("GantryWidgetMimoRecentPosts");
    }
    
    function render_title($args, $instance) {
    	global $gantry;
    	if($instance['title'] != '') :
    		echo $instance['title'];
    	endif;
    }

    function render($args, $instance){
        global $gantry;
	    $id1 = $args['widget_id'];
	    ob_start();
	    
	    $menu_class = $instance['menu_class'];
	    $numberrecent = $instance['numberrecent'];
		$postperpagerecent = $instance['postperpagerecent'];
	    $cat = $instance['cat'];
		$showexcerptrecent = $instance['showexcerptrecent'];
		$showtitlerecent = $instance['showtitlerecent'];
		$showimagerecent = $instance['showimagerecent'];
		$showdaterecent = $instance['showdaterecent'];
		$showcommentsrecent = $instance['showcommentsrecent'];
		$showreadontotal = $instance['showreadontotal'];
		$showpag = $instance['showpag'];
		$startsliderrecent = $instance['startsliderrecent'];
			
		if($menu_class != '') :
			$menu_class = ' class="'.$menu_class.'"';
		else :
			$menu_class = '';
		endif;
		
		
		
		$cache = wp_cache_get('gantry_recentposts', 'widget');

		if (!is_array($cache))
			$cache = array();

		if (isset($cache[$args['widget_id']])) {
			echo $cache[$args['widget_id']];
			return;
		}?>
		<div class="cn_wrapper flexslider <?php echo $id1;?>">
		
		<?php 
 		$rp = new WP_Query(array('showposts' => $numberrecent, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1, 'category_name' => $cat));
		$r = 1;
		if ($rp->have_posts()) : ?>
        <ul class="cn_list_recent slides slides<?php echo $id1;?>">
		 <li class="cn_page_recent" style="display:block;">
		
		
			<?php  while ($rp->have_posts()) : $rp->the_post(); ?>
<div class="recent">
				<?php if ($showimagerecent !== 'no'){ ?>
		<div class="recent_thumb"><a class="" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('feature'); ?></a></div>
					<?php  };?>
                    <div class="recent_content">
	 <?php if ($showtitlerecent !== 'no'){ ?>
     <div class="recent-title"><h2>
		<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" ><?php the_title(); ?></a></h2></div>
					<?php  };?>
                    <?php if (($showdaterecent !== 'no') || ($showcommentsrecent !== 'no')): ?>
                    <dl class="article-info">
	 <?php if ($showdaterecent !== 'no'){ ?>
   <dd class="create">
		<?php the_time('F j, Y') ?>
       </dd>
					<?php  };?>
                    
                     <?php if ($showcommentsrecent !== 'no'){ ?>
                    <dd class="comments-count">
		<a href="<?php comments_link(); ?>">
										<?php comments_number( _r( '0 Comments' ), _r( '1 Comment' ), _r( '% Comments' ) ); ?>
									</a>
       </dd>
					<?php  };?></dl><?php endif;?>
	 
   
    <?php if ($showexcerptrecent !== 'no'){ ?>
    <div class="mimo_recent_content">
		<?php
     
     
     
      $excerpt = get_the_content();
     
    $new_excerpt = explode(' ', $excerpt, 10);
     
    array_pop($new_excerpt);
     
    $new_excerpt = implode(' ', $new_excerpt);
     
     
     
      echo $new_excerpt; ?>
      </div>
					<?php  };?>
                   
                  <?php if ($showreadontotal !== 'no'){ ?>
                      <?php  global $post;?>
                     <div class="show_readon">
		<?php if(preg_match('/<!--more(.*?)?-->/', $post->post_content)) : ?>
                                 <a href="<?php the_permalink(); ?>" ><?php _re('more...'); ?></a>
							
							
                            <?php else: ?>
							<?php endif; ?>
                            </div>
                           
					     <?php };?>	      
         
	      
    </div></div>
          
                    <div class="clear"></div>
			<?php if((($r % $postperpagerecent)==0) && ($r != $numberrecent)) echo '</li><li class="cn_page_recent" style="display:block;">';?>	
			 <?php $r++; endwhile; ?>
		
		</li>
	
       </ul>
       
      <?php if ($showpag !== 'false'){ ?>
 <script type="text/javascript">
    jQuery(window).load(function(){
      jQuery('.<?php echo $id1;?>').flexslider({
		selector: '.slides<?php echo $id1;?> > li', 
        animation: 'slide',
        animationLoop: true,
		pauseOnAction: true,
        directionNav: true,
		easing: 'swing',
		controlNav: false,               //{NEW} String: Determines the easing method used in jQuery transitions. jQuery easing plugin is supported!
smoothHeight: true,            //{NEW} Boolean: Allow height of the slider to animate smoothly in horizontal mode
slideshow: <?php echo $startsliderrecent;?>,                //Boolean: Animate slider automatically
slideshowSpeed: 6000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
animationSpeed: 500,            //Integer: Set the speed of animations, in milliseconds
randomize: false,
pauseOnAction: false,                 //Boolean: Randomize slide order
useCSS: true,                   //{NEW} Boolean: Slider will use CSS3 transitions if available
touch: true,                    //{NEW} Boolean: Allow touch swipe navigation of the slider on touch-enabled devices
video: false,                //{NEW} Boolean: If using video in the slider, will prevent CSS3 3D Transforms to avoid graphical glitches
prevText: 'Previous',           //String: Set the text for the "previous" directionNav item
nextText: 'Next', 
        });
    }); 
</script>	
<?php  };?>
		<?php wp_reset_query(); ?><?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;
		?><div class="clear"></div>
	</div>	
     
	<?php	
		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('gantry_recentposts', $cache, 'widget');
	    
	}
	function addHeaders(){
        global $gantry;
        $gantry->addScript(get_template_directory_uri() .'/js/admin/mimorecentposts.js');
		
    }	
}