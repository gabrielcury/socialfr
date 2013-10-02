<?php
/**
 
 * Recent Posts Widget by framecero
 
 **/ 
 
defined('GANTRY_VERSION') or die();

gantry_import('core.gantrywidget');

add_action('widgets_init', array("GantryWidgetMimoNews","init"));
add_action('admin_head-widgets.php', array('GantryWidgetMimoNews','addHeaders'),-1000);
add_action('comment_post', array("GantryWidgetMimoNews", 'gantry_flush_widget_cache'));
add_action('transition_comment_status', array("GantryWidgetMimoNews", 'gantry_flush_widget_cache'));


class GantryWidgetMimoNews extends GantryWidget {
    var $short_name = 'mimonews';
    var $wp_name = 'gantry_mimonews';
    var $long_name = 'Mimo News';
    var $description = 'Mimo News Special Widget';
    var $css_classname = 'widget_gantry_mimonews';
    var $width = 200;
    var $height = 400;
    
    function gantry_flush_widget_cache() {
		wp_cache_delete('gantry_mimonews', 'widget');
	}

    function init() {
        register_widget("GantryWidgetMimoNews");
    }
    
    function render_title($args, $instance) {
    	global $gantry;
    	if($instance['title'] != '') :
    		echo $instance['title'];
    	endif;
    }

    function render($args, $instance){
        global $gantry;global $post;
	    $id = $args['widget_id'];
	    ob_start();
	    
	    $menu_class = $instance['menu_class'];
	    $number = $instance['number'];
	    $cat = $instance['cat'];
		$postperpage= $instance['postperpage'];
		$showexcerpt = $instance['showexcerpt'];
		$showtitle = $instance['showtitle'];
		$showdate = $instance['showdate'];
		$showcomments = $instance['showcomments'];
		$showreadontotal = $instance['showreadontotal'];
		$showpagnews = $instance['showpagnews'];
		$startslider = $instance['startslider'];
		$showrating = $instance['showrating'];
	
			
		if($menu_class != '') :
			$menu_class = ' class="'.$menu_class.'"';
		else :
			$menu_class = '';
		endif;
		
		
		
		$cache = wp_cache_get('gantry_news', 'widget');

		if (!is_array($cache))
			$cache = array();

		if (isset($cache[$args['widget_id']])) {
			echo $cache[$args['widget_id']];
			return;
		}
		
?> 
<div class="cn_wrapper flexslider  <?php echo $id;?>">
		

<?php
 		$rp = new WP_Query(array('showposts' => $number, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1, 'category_name' => $cat));
		$n = 1;
		if ($rp->have_posts()) : ?>
       
		
        <ul class="cn_list slides slides<?php echo $id;?>">
        <li class="cn_page" style="display:block;">
		
		
			<?php  while ($rp->have_posts() ) : $rp->the_post();  ?>
           
<div class="cn_item <?php if($n == 1) : echo 'selected'; endif;?>" >

			 <div class="cn_recent_thumb"><a class="imgbg" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('feature'); ?></a></div>
            
             
            <?php if ($showtitle !== 'no' || ($showrating !== 'no')){ ?>    
             <div class="recent-title">    
	 <?php if ($showtitle !== 'no'){ ?>
    <h2>
		<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" ><?php the_title(); ?></a></h2>
		
		 <?php if ($showrating !== 'no'){ ?>
		 <?php  				global $review_mb;$metareview = $review_mb->the_meta($post->ID);
					$review_mb->have_fields_and_multi('reviews');$review_mb->the_field ('reviews');
					$note = $review_mb->the_field ('note'); $review_mb->the_field ('summary'); $summary = $review_mb->the_field ('summary');
					if($metareview): 
				 					$sum = 0; $n = 0; 
									foreach($metareview['reviews'] as $itemreview){
									$itemcriteria = $itemreview['ids'];
									$itemvalue = $itemreview['s_field'];
									$sum = $sum + $itemvalue;
									$n++;$total = $sum/$n;
									$totalnodecimal = number_format($total, 0, ',', ' '); }?>
                                    	<div class="therating"><a href="<?php the_permalink(); ?>"><?php echo $totalnodecimal;?></a></div>

					<?php endif; ?>
                    <?php  };?>
					<?php  };?></div><?php  };?>
                    
                     <?php if (($showdate !== 'no') || ($showcomments !== 'no')): ?>
               <dl class="article-info">      
	 <?php if ($showdate !== 'no'){ ?>
	 <dd class="create">
		<?php the_time('F j, Y') ?>
        </dd>
			<?php  };?>
                     <?php if ($showcomments !== 'no'){ ?>
				<dd class="comments-count">
		<a href="<?php comments_link(); ?>">
										<?php comments_number( _r( '0 Comments' ), _r( '1 Comment' ), _r( '% Comments' ) ); ?>
									</a>
	 <?php  };?></dl><?php endif;?>
     
    <?php if ($showexcerpt !== 'no'){ ?>
	 
   <div class="mimo_recent_content">
   
		<?php
     
     
     
      $excerpt = get_the_content();
     
    $new_excerpt = explode(' ', $excerpt, 20);
     
    array_pop($new_excerpt);
     
    $new_excerpt = implode(' ', $new_excerpt);
     
     
     
      echo $new_excerpt; ?>
					
             </div>      
         <?php  };?>  
                   
   <div class="clear"></div>
                  <?php if ($showreadontotal !== 'no'){ ?>
                      <?php  global $post;?>
                     <div class="show_readon">
		<?php if(preg_match('/<!--more(.*?)?-->/', $post->post_content)) : ?>
                                 <a href="<?php the_permalink(); ?>" ><?php _re('more...'); ?></a>
							
							
                            <?php else: ?>
							<?php endif; ?>
                            </div>
                           
					     <?php };?>	      
	   </div>
       
       
       
      
    <?php if((($n % $postperpage)==0) && ($n != $number))
	
	echo '</li><li class="cn_page" style="display:block;">';?>	
			 <?php $n++; endwhile; ?>
		</li>
        </ul>
		 <?php if ($showpagnews !== 'no'){ ?>
 <script type="text/javascript">
    jQuery(window).load(function(){
      jQuery('.<?php echo $id;?>').flexslider({
		selector: '.slides<?php echo $id;?> > li', 
        animation: 'slide',
        animationLoop: true,
        directionNav: true,
		easing: 'swing',
		controlNav: false,               //{NEW} String: Determines the easing method used in jQuery transitions. jQuery easing plugin is supported!
smoothHeight: true,            //{NEW} Boolean: Allow height of the slider to animate smoothly in horizontal mode
slideshow: <?php echo $startslider;?>,                //Boolean: Animate slider automatically
slideshowSpeed: 5000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
animationSpeed: 600,            //Integer: Set the speed of animations, in milliseconds
randomize: false,
pauseOnAction: false,                 //Boolean: Randomize slide order
                   //{NEW} Boolean: Slider will use CSS3 transitions if available
touch: true,                    //{NEW} Boolean: Allow touch swipe navigation of the slider on touch-enabled devices
video: true,                //{NEW} Boolean: If using video in the slider, will prevent CSS3 3D Transforms to avoid graphical glitches
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
		wp_cache_set('gantry_news', $cache, 'widget');
	    
	}
	function addHeaders(){
        global $gantry;
        $gantry->addScript(get_template_directory_uri() .'/js/admin/mimonews.js');
		
    }	
}