<?php
/**
 
 * Carousel Widget by framecero
 
 **/  
 
defined('GANTRY_VERSION') or die();

gantry_import('core.gantrywidget');

add_action('widgets_init', array("GantryWidgetMimoCarousel","init"));
add_action('admin_head-widgets.php', array('GantryWidgetMimoCarousel','addHeaders'),-1000);


class GantryWidgetMimoCarousel extends GantryWidget {
    var $short_name = 'mimocarousel';
    var $wp_name = 'gantry_mimocarousel';
    var $long_name = 'Mimo Carousel';
    var $description = 'Mimo Carousel Widget';
    var $css_classname = 'widget_gantry_mimocarousel rt-block';
    var $width = 200;
    var $height = 400;
    
  

    function init() {
        register_widget("GantryWidgetMimoCarousel");
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
		// These are our own options
		
		$title 	 = $instance['title']; // Widget title
		$ctax 	 = $instance['ctax']; // Post taxonomy
		$cshow 	 = $instance['cshow']; // Post taxonomy
		$ccol = $instance['ccol']; // Carousel Columns
		$showcat = $instance['showcat']; // Show Category
		$showrating = $instance['showrating'];

		
		
        // Output
		?> 
			
		<div class="ca-container<?php echo $args['widget_id'] ?> ca-container">
   			 <ul class="ca-wrapper<?php echo $args['widget_id'] ?> da-thumbs ca-wrapper">
			<?php global $more, $post;
			$carousel_query = new WP_Query(array( 'category_name' => $ctax, 'showposts' => $cshow ));
			
			if( $carousel_query->have_posts() ) : 
			  
			while($carousel_query->have_posts()) : $carousel_query->the_post(); 
			$terms = get_the_terms( $post->ID, 'tagcarousel' );  
  
            
                       
           ?>  
           		<li class="ca-item ca-item<?php echo $ccol; ?>col id<?php echo $args['widget_id'] ?>">
            		<div class="ca-item-main">
           
               			 <div class="ca-icon imgbg">
                         	<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('feature'); ?></a>
                            <?php if(($showcat !== 'no') || ($showrating !== 'no')){ ?>
                         <?php if($showcat !== 'no'){ ?><div class="thecategory"><?php $parentscategory ="";
foreach((get_the_category()) as $category) {
if ($category->category_parent == 0) {
$parentscategory .= ' <a href="' . get_category_link($category->cat_ID) . '" title="' . $category->name . '">' . $category->name . '</a>/ ';
}
}
echo substr($parentscategory,0,-2); ?>

  </div><?php }; ?><?php if($showrating !== 'no'){ ?>
  
  <?php  				global $review_mb;$metareview = $review_mb->the_meta($post->ID);
					$review_mb->have_fields_and_multi('reviews');$review_mb->the_field ('reviews');
					$note = $review_mb->the_field ('note'); $review_mb->the_field ('summary'); $summary = $review_mb->the_field ('summary');
					if($metareview): 
				 					$sum = 0; $n = 0; 
									foreach($metareview['reviews'] as $itemreview){
									$itemcriteria = $itemreview['ids'];
									$itemvalue = $itemreview['s_field'];
									$sum = $sum + $itemvalue;
									$n++;$total = $sum/$n;$totalnodecimal = number_format($total, 0, ',', ' '); }?>
                                    	<div class="therating"><a href="<?php the_permalink(); ?>"><?php echo $totalnodecimal;?></a></div>

					<?php endif; ?>
<?php } ?><?php }; ?>





                         </div>
                         <div class="gotopost da-animate da-slideFromRight">
                		<div class="ca-content-wrapper <?php  if (has_post_format( 'image' ) ):?>imagepost<?php endif; ?><?php if (has_post_format( 'link' ) ):?>linkpost<?php endif; ?><?php if (has_post_format( 'audio' ) ):?>audiopost<?php endif; ?><?php if (has_post_format( 'video' ) ):?>videopost<?php endif; ?><?php if ( !get_post_format() ) { ?>standardpost<?php }; ?>">
                			<div class="ca-content <?php  if (has_post_format( 'image' ) ):?>gotopostimage<?php endif; ?><?php if (has_post_format( 'link' ) ):?>gotopostlink<?php endif; ?><?php if (has_post_format( 'audio' ) ):?>gotopostaudio<?php endif; ?><?php if (has_post_format( 'video' ) ):?>gotopostvideo<?php endif; ?><?php if ( !get_post_format() ) { ?>gotopoststandard<?php }?>">
                    			
                                	<a href="<?php the_permalink(); ?>" class="mimo_recent_link"><?php the_title(); ?></a>
                               
                    	 	
                    	</div>
           			 </div>
         </div>
            	</div>
            </li>
           
           <?php endwhile; ?>
           <?php else: ?>
           <?php endif; ?> 
		   <?php wp_reset_query();?>
		   <?php global $post, $posts, $query_string; ?>
			
		</ul>
    </div>
	<script type="text/javascript">
    jQuery(window).load(function(){  
     var heightfunction = function(){
	 var caheight = jQuery('.id<?php echo $args['widget_id'] ?>:first-child .ca-icon img').outerHeight();
	 var pxcaheight = caheight + 'px';
     jQuery('.ca-container<?php echo $args['widget_id'] ?>').css('height' , pxcaheight);
	 jQuery('.ca-wrapper<?php echo $args['widget_id'] ?>').css('height' , pxcaheight);
	 
	 jQuery('.ca-container<?php echo $args['widget_id'] ?>').contentcarousel({visible:true}); 
	 };
	 heightfunction();
	 jQuery(window).smartresize( function() {
     heightfunction();
});
	});
    // debulked onresize handler





    </script>
 
 

		<?php
		// echo widget closing tag
		
		echo ob_get_clean();
	}

function addHeaders(){
        global $gantry;
          $gantry->addScript(get_template_directory_uri() .'/js/admin/mimocarousel.js');
		
    }	    
	
} 