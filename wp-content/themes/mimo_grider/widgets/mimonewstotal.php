<?php
/**
 
 * Recent Posts Widget by framecero
 
 **/ 
 
defined('GANTRY_VERSION') or die();

gantry_import('core.gantrywidget');

add_action('widgets_init', array("GantryWidgetMimoNewsTotal","init"));
add_action('admin_head-widgets.php', array('GantryWidgetMimoNewsTotal','addHeaders'),-1000);
add_action('comment_post', array("GantryWidgetMimoNewsTotal", 'gantry_flush_widget_cache'));
add_action('transition_comment_status', array("GantryWidgetMimoNewsTotal", 'gantry_flush_widget_cache'));


class GantryWidgetMimoNewsTotal extends GantryWidget {
    var $short_name = 'mimonewstotal';
    var $wp_name = 'gantry_mimonewstotal';
    var $long_name = 'Mimo News Total';
    var $description = 'Mimo News Total Special Widget';
    var $css_classname = 'widget_gantry_mimonewstotal';
    var $width = 200;
    var $height = 400;
    
    function gantry_flush_widget_cache() {
		wp_cache_delete('gantry_mimonewstotal', 'widget');
	}

    function init() {
        register_widget("GantryWidgetMimoNewsTotal");
    }
    
    function render_title($args, $instance) {
    	global $gantry;
    	if($instance['title'] != '') :
    		echo $instance['title'];
    	endif;
    }

    function render($args, $instance){
        global $gantry;global  $post;
	    $id2 = $args['widget_id'];
	    ob_start();
	    
	    $menu_class = $instance['menu_class'];
	    $numbertotal = $instance['numbertotal'];
	    $cattotal = $instance['cattotal'];
		$postperpagetotal = $instance['postperpagetotal'];
		$startslidertotal = $instance['startslidertotal'];
		$showcontenttotal = $instance['showcontenttotal'];
		$showtitletotal = $instance['showtitletotal'];
		$showimagetotal = $instance['showimagetotal'];
		$showinfototal = $instance['showinfototal'];
		$showreadontotal = $instance['showreadontotal'];
		$showpagtotal = $instance['showpagtotal'];
		$showrating = $instance['showrating'];

	
			
		if($menu_class != '') :
			$menu_class = ' class="'.$menu_class.'"';
		else :
			$menu_class = '';
		endif;
		
		
		
		$cache = wp_cache_get('gantry_mimonewstotal', 'widget');

		if (!is_array($cache))
			$cache = array();

		if (isset($cache[$args['widget_id']])) {
			echo $cache[$args['widget_id']];
			return;
		}
		
?> 
<div class="cn_wrapper_total <?php echo $id2;?> flexslider">
		

<?php
 		$rp4 = new WP_Query(array('showposts' => $numbertotal, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1, 'category_name' => $cattotal));
		$e = 1;
		if ($rp4->have_posts()) : ?>
       
		
        <ul id="cn_newstotal" class="cn_newstotal  slides">
        <li class="cn_newstotal_page" style="display:block;">
		
		
			<?php  while ($rp4->have_posts() ) : $rp4->the_post();  ?>
           
<div class="cn_total_item <?php if($e == 1) : echo 'selected'; endif;?>" >
<?php if ($showimagetotal !== 'no'){ ?>
			 <div class="cn_total_recent_thumb"><a class="imgbg" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('feature'); ?></a></div>
             <?php };?>
             <div class="recent_content_news"> 
                    
	 <?php if ($showtitletotal !== 'no' || $showrating !== 'no'){ ?>
     
      <div class="recent-title">
       <?php if ($showtitletotal !== 'no'){ ?>
       <h2>
		<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php  };?>
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
	<?php  };?></div>
			   <?php };?>		
                     <?php if (($showinfototal !== 'no')): ?>
               <dl class="article-info">
                <dd class="create">
		<?php the_time('F j, Y') ?>
        </dd>
			
				<dd class="comments-count">
		<a href="<?php comments_link(); ?>">
										<?php comments_number( _r( '0 Comments' ), _r( '1 Comment' ), _r( '% Comments' ) ); ?>
									</a></dd></dl> <?php endif; ?>
     <?php if ($showcontenttotal !== 'no'){ ?>
     <div class="mimo_recent_content">
   
		<?php
     
     
     
      $excerpt = get_the_content();
     
    $new_excerpt = explode(' ', $excerpt, 20);
     
    array_pop($new_excerpt);
     
    $new_excerpt = implode(' ', $new_excerpt);
     
     
     
      echo $new_excerpt; ?>
			</div>	<div class="clear"></div>
             <?php };?>	
           
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
    
					
</div>
	     <?php if((($e % $postperpagetotal)==0)  && ($e != $numbertotal)) echo '</li><li class="cn_newstotal_page" >';?>	
			 <?php $e++; endwhile; ?>
		
		</li>
       
        </ul>
        
       
	<script type="text/javascript">
    jQuery(window).load(function(){
      jQuery('.<?php echo $id2;?>').flexslider({
        animation: 'slide',
        animationLoop: true,
        easing: 'swing',
		controlNav: false,               //{NEW} String: Determines the easing method used in jQuery transitions. jQuery easing plugin is supported!
smoothHeight: true,            //{NEW} Boolean: Allow height of the slider to animate smoothly in horizontal mode
slideshow: <?php echo $startslidertotal;?>,                //Boolean: Animate slider automatically
slideshowSpeed: 7000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
animationSpeed: 700,            //Integer: Set the speed of animations, in milliseconds
randomize: false,               //Boolean: Randomize slide order

touch: true,                    //{NEW} Boolean: Allow touch swipe navigation of the slider on touch-enabled devices
video: false,
pauseOnAction: true,                   //{NEW} Boolean: If using video in the slider, will prevent CSS3 3D Transforms to avoid graphical glitches
 
 
directionNav: <?php echo $showpagtotal;?>,             //Boolean: Create navigation for previous/next navigation? (true/false)
prevText: 'Previous',           //String: Set the text for the "previous" directionNav item
nextText: 'Next', 
        });
    });
</script>

		<?php wp_reset_query(); ?><?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;
		
?><div class="clear"></div>
	</div>	
     
	<?php	 
		
		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('gantry_mimonewstotal', $cache, 'widget');
	    
	}
	function addHeaders(){
        global $gantry;
        $gantry->addScript(get_template_directory_uri() .'/js/admin/mimonewstotal.js');
		
    }	
}