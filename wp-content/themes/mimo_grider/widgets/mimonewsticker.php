<?php
/**
 
 * News Ticker Widget by framecero
 
 **/ 
 
defined('GANTRY_VERSION') or die();

gantry_import('core.gantrywidget');

add_action('widgets_init', array("GantryWidgetMimoNewsTicker","init"));
add_action('admin_head-widgets.php', array('GantryWidgetMimoNewsTicker','addHeaders'),-1000);
add_action('comment_post', array("GantryWidgetMimoNewsTicker", 'gantry_flush_widget_cache'));
add_action('transition_comment_status', array("GantryWidgetMimoNewsTicker", 'gantry_flush_widget_cache'));


class GantryWidgetMimoNewsTicker extends GantryWidget {
    var $short_name = 'mimonewsticker';
    var $wp_name = 'gantry_mimonewsticker';
    var $long_name = 'Mimo NewsTicker';
    var $description = 'Mimo Custom NewsTicker Widget';
    var $css_classname = 'widget_gantry_mimonewsticker';
    var $width = 200;
    var $height = 400;
    
    function gantry_flush_widget_cache() {
		wp_cache_delete('gantry_mimonewsticker', 'widget');
	}

    function init() {
        register_widget("GantryWidgetMimoNewsTicker");
    }
    
    function render_title($args, $instance) {
    	global $gantry;
    	if($instance['title'] != '') :
    		echo $instance['title'];
    	endif;
    }

    function render($args, $instance){
        global $gantry;global $post;
	    
	    ob_start();
	    
	    $textbefore = $instance['textbefore'];
	    $number = $instance['number'];
	    $cat = $instance['cat'];
		$showexcerpt = $instance['showexcerpt'];
		$showtitle = $instance['showtitle'];
		$showdate = $instance['showdate'];
		$showcomments = $instance['showcomments'];
		$showreadon = $instance['showreadon'];
		$showrating = $instance['showrating'];
			
		
		
		
		
		$cache = wp_cache_get('gantry_newsticker', 'widget');

		if (!is_array($cache))
			$cache = array();

		if (isset($cache[$args['widget_id']])) {
			echo $cache[$args['widget_id']];
			return;
		}

 		$rp = new WP_Query(array('showposts' => $number, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1, 'category_name' => $cat));
		if ($rp->have_posts()) : ?>
		
        <div class="all-ticker">
        <div class="animate_left">
        <span class="mimo_ticker_left" ><?php echo $textbefore; ?></span>
        </div>
        <div class="uls">
		<ul id="ticker"  >
		
			<?php  while ($rp->have_posts()) : $rp->the_post(); ?>
<li class="recent news-item"><?php if ($showrating !== 'no'){ ?>
			<?php  				global $review_mb;$metareview = $review_mb->the_meta($post->ID);
					$review_mb->have_fields_and_multi('reviews');$review_mb->the_field ('reviews');
					$review_mb->the_field ('note');$note = $review_mb->the_field ('note'); $review_mb->the_field ('summary'); $summary = $review_mb->the_field ('summary');
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
	 <?php if ($showtitle !== 'no'){ ?>
		<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" class="mimo_ticker_link"><?php the_title(); ?></a>
					<?php  };?>
                    
	 <?php if ($showdate !== 'no'){ ?>
     <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" class="recent_com_ticker">
		 <?php the_time('F j, Y') ?>
					</a><?php  };?>
                  
                     <?php if ($showcomments !== 'no'){ ?>
                     <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" class="recent_com_ticker">
		 / <?php comments_number(_r('0 Comments'), _r('1 Comments'), _r('% Comments')); ?>
					</a><?php  };?>
	 
	 
   
    <?php if ($showexcerpt !== 'no'){ ?>
    <span class="ticker_content">
		<?php
     $excerpt = get_the_content();
     $new_excerpt = explode(' ', $excerpt, 10);
     array_pop($new_excerpt);
     $new_excerpt = implode(' ', $new_excerpt);
     echo $new_excerpt; ?>
       </span>
					<?php  };?>
                  
                     <?php  global $post; if ($showreadon !== 'no'){ ?>
		<?php if(preg_match('/<!--more(.*?)?-->/', $post->post_content)) : ?>
                                <a href="<?php the_permalink(); ?>" class="readon_ticker"><?php _r('Learn more ...'); ?></a>
							<div class="clear"></div>
							
                            <?php else: ?>
							<?php endif; ?>
					<?php  };?>
    
      
</li>
	
			<?php endwhile; ?>
		
		</ul>
        </div>
        </div>
<div class="clear"></div>
<script>

	function tick(){
		jQuery('#ticker li:first').slideUp( function () { jQuery(this).appendTo(jQuery('#ticker')).slideDown(); });
	}
	setInterval(function(){ tick () }, 5000);


</script>
<script type="text/javascript">
        
        jQuery(function() {
			jQuery('.animate_left').animate({width:'hide'}, 500, "easeOutExpo");
			
			jQuery('#ticker').hover(function(){
				
				
				jQuery('.animate_left').animate({width:'show'}, 500, "easeOutExpo");
					
				
				
			}, function(){
					jQuery('.animate_left').animate({width:'hide'}, 500, "easeOutExpo");
			
			
			
			
			
			})});</script>	
        
		<?php wp_reset_query(); ?><?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;
		
		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('gantry_newsticker', $cache, 'widget');
	    
	}
	function addHeaders(){
        global $gantry;
        $gantry->addScript(get_template_directory_uri() .'/js/admin/mimonewsticker.js');
		
    }	
}