<?php
/**
 
 * Newswall Widget by mimo
 
 **/ 
 
defined('GANTRY_VERSION') or die();

gantry_import('core.gantrywidget');

add_action('widgets_init', array("GantryWidgetNewsWall","init"));
add_action('admin_head-widgets.php', array('GantryWidgetNewsWall','addHeaders'),-1000);


class GantryWidgetNewsWall extends GantryWidget {
    var $short_name = 'mimonewswall';
    var $wp_name = 'gantry_newswall';
    var $long_name = 'Mimo NewsWall';
    var $description = 'Mimo NewsWall Widget';
    var $css_classname = 'widget_gantry_newswall rt-block';
    var $width = 200;
    var $height = 400;
    
  

    function init() {
        register_widget("GantryWidgetNewsWall");
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
		$ntax 	 = $instance['ntax']; // Post Categories
		$nshow 	 = $instance['nshow']; // Number of Post
		$ncol 	 = $instance['ncol']; // Number of Columns
		$nfilter 	 = $instance['nfilter']; // Show Filter or not
		$npag 	 = $instance['npag']; // Show Pagination or not
		$infinitescroll 	 = $instance['infinitescroll']; 
		$showrating = $instance['showrating'];
		
		
		

 
		
		
        // Output
		?> 
			<?php echo '<div class="all_portfolio">'; ?>
			
			<?php if ($nfilter == 'yes'){
				
				if($ntax ==! '') {
					
					 $terms = get_terms('category', array(
 	'include' => $ntax,
 	'hide_empty' => 1,
	'depth' => 1,
 ));  
					 
					} else {
						
						$terms = get_terms('category', array(
 	'hide_empty' => 1,
	'depth' => 1,
 ));    };
       
                 $count = count($terms); 
				  echo '<ul id="newswallmimo-filter">';  
                   
                 echo '<li><a class="selected" href="#" data-filter="*" title="">All</a></li>';  
                 if ( $count > 0 ){  
  
                        foreach ( $terms as $term ) {  
  
                            $termname = strtolower($term->name);  
                            $termname = str_replace(' ', '-', $termname);  
                            echo '<li><a href="#" title="" data-filter=".'.$termname.'">'.$term->name.'</a></li>';  
                        }  
                 }  
                 echo '</ul>'; 
             
                         }  

			 echo '<div class="rock_newswall">'; 
			wp_reset_query(); ?> 
            
            

						<ul id="container_newswall" class="container_newswall_class large<?php echo $ncol;?> da-thumbs"> 

 
	
			<?php global $more, $post;    // Declare global $more (before the loop).
		
if ( get_query_var('paged') ) {
$paged = get_query_var('paged');
} elseif ( get_query_var('page') ) {
$paged = get_query_var('page');
} else {
$paged = 1;
};


			$newswall_query = new WP_Query(array(  'paged' => $paged, 
			 'cat' => $ntax, 'showposts' => $nshow , 'orderby' => $gantry->get('blog-order')));
			
			if( $newswall_query->have_posts() ) : 
			 
			while($newswall_query->have_posts() ) : $newswall_query->the_post(); 
			$terms = get_the_terms( $post->ID, 'category' );  

            if ( $terms && ! is_wp_error( $terms ) ) :  
            $links = array();  
  
            foreach ( $terms as $term )  
            {  
            $links[] = $term->name;  
            }  
            $links = str_replace(' ', '-', $links);  
            $tax = join( " ", $links );  
            else :  
            $tax = '';  
            endif;  
                       
           $more = 0;  ?> <!-- Open Item --> 
                      <li  class="mimo_newswall covernews <?php echo strtolower($tax); ?> item2 <?php  if (has_post_format( 'image' ) ):?>imageitem<?php endif; ?><?php if (has_post_format( 'link' ) ):?>linkitem<?php endif; ?><?php if (has_post_format( 'audio' ) ):?>audioitem<?php endif; ?><?php if (has_post_format( 'video' ) ):?>videoitem<?php endif; ?><?php if ( !get_post_format() ) { ?>standarditem<?php }; ?>">
                    <!-- Open Item Content  -->
                       <div class="item-content">
                       <div class="single_link"  ><?php  the_post_thumbnail('feature'); ?> 
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

					<?php endif; };?></div>
                       <!-- Open Gotopost Content  -->
                       		<div  class="<?php global $custom_checkbox_mb;$meta = $custom_checkbox_mb->the_meta($post->ID);$custom_checkbox_mb->the_field('cb_single');
 if ($custom_checkbox_mb->get_the_value()) { ?>gotoposthide<?php }else{  ?>gotopost<?php }; ?> <?php if ($custom_checkbox_mb->get_the_value()) { ?><?php }else{ ?>da-animate da-slideFromRight<?php }; ?>"  style="display: block;">
                           <!-- Open Inside Normal -->
                            				<div class="info_inside_normal <?php  if (has_post_format( 'image' ) ):?>imagepost<?php endif; ?><?php if (has_post_format( 'link' ) ):?>linkpost<?php endif; ?><?php if (has_post_format( 'audio' ) ):?>audiopost<?php endif; ?><?php if (has_post_format( 'video' ) ):?>videopost<?php endif; ?><?php if ( !get_post_format() ) { ?>standardpost<?php }; ?>">
                                            <div class="clickable inside_inside <?php  if (has_post_format( 'image' ) ):?>gotopostimage<?php endif; ?><?php if (has_post_format( 'link' ) ):?>gotopostlink<?php endif; ?><?php if (has_post_format( 'audio' ) ):?>gotopostaudio<?php endif; ?><?php if (has_post_format( 'video' ) ):?>gotopostvideo<?php endif; ?><?php if ( !get_post_format() ) { ?>gotopoststandard<?php }?>" url="<?php the_permalink(); ?>">
                                                    <!-- Open Inside Inside -->
                                                    <div class="mimo_title"><div class="mimo_titlespan" ><span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span></div>
                                                   
                                                     </div>
                            				<!--  Close Inside Inside -->
                                            </div>
                                          
                                        	<!-- Close Inside Normal --> 
                                       </div>
                                      
                              </div>
                            
                             <!-- Close Item Content  -->
                        </div>
                   </li>		
	    
        			<?php endwhile; ?>
        			<?php else: ?>
        			<?php endif; ?> 

					</ul><div class="clear"></div>
    					</div>
            <?php if ($infinitescroll == 'button'){ ?>
					<div class="navigation">
<?php next_posts_link('More Posts',$newswall_query->max_num_pages) ?>
</div>

            		<?php }; ?>
           
             <?php if ($infinitescroll == 'auto' ){ ?>
					<div class="navigation hidden">
<?php next_posts_link('More Posts',$newswall_query->max_num_pages) ?>
</div>
            		</div>
            		<?php }; ?>
            <?php if ($npag == 'yes'){ ?>
					

        			<?php if($newswall_query->max_num_pages > 1) : ?>
					
			 		<?php gantry_pagination($newswall_query); ?>
        			
						
					<?php endif; ?>
            	
            		<?php }; ?>
                  
                 
    		<div class="clear"></div>	
            
            </div>

	<script type="text/javascript">
    
	jQuery(window).load(function(){ 
	 
  jQuery("div.clickable").click(
function()
{
    window.location = jQuery(this).attr("url");
    return false;
}); 
	
	
	
var mimonewswall = function () {
  
	  var mimocontainer = jQuery('#container_newswall');
      mimoitems = jQuery('.item2');
	  var LargeItem = mimoitems.filter('.large');
	  mimocontainer.imagesLoaded( function(){
      mimocontainer.isotope({
      itemSelector: '.item2',
	
      resizesContainer : true,
	  masonry: { rowHeight: jQuery('#container_newswall .item2:last').outerWidth(true) },
      getSortData : {
      fitOrder : function( mimoitems ) {
        var order,
            index = mimoitems.index();
        
        if ( mimoitems.hasClass('large') && index % 2 ) {
          order = index + 1.5;
        } else {
          order = index;
        }
        return order;
      }
     },
     sortBy : 'fitOrder'
     })
	 .isotope('reLayout' )
      
      // trigger layout and sort
      .isotope({
    // update columnWidth to a percentage of container width
    masonry: { rowHeight: jQuery('#container_newswall .item2:last').outerWidth(true) }
  	});
 	 });
 
	jQuery(window).smartresize( function(){
  	mimocontainer.isotope({
    // update columnWidth to a percentage of container width
    masonry: { rowHeight: jQuery('#container_newswall .item2:last').outerWidth(true) }
  	});
	});
	<?php if ($infinitescroll == 'auto'){ ?>
	
   jQuery(function() {
    var jQuerycontainer = jQuery('#container_newswall');
        jQuerycontainer.infinitescroll({
        navSelector  : '.navigation',    // selector for the paged navigation 
        nextSelector : '.navigation a',  // selector for the NEXT link (to page 2)
        itemSelector : '.item2', 
		behavior: 'twitter',    // selector for all items you'll retrieve
		finishedMsg: "There are no more posts",    // selector for all items you'll retrieve
		msgText: "Loading the next set of posts...",
        debug: false,
		img:'../images/loaderscroll.gif',
        errorCallback: function() { 
          // fade out the error message after 2 seconds
          jQuery('#infscr-loading').animate({opacity:0},500);   
        }
        },
         // trigger Isotope as a callback
    function( newElements ) {
      // hide new items while they are loading
      var $newElems = jQuery( newElements ).css({ opacity: 0 });
      // ensure that images load before adding to Isotope layout
      $newElems.imagesLoaded(function() {
        // show elems now they're ready
        $newElems.animate({ opacity: 1 });
	jQuerycontainer.append( $newElems ).isotope( 'appended', $newElems );
	
	
					
				jQuery(function() {
	$newElems.hoverdir();
});	
	 
      });
    });

});
  	<?php }; ?>
	<?php if ($infinitescroll == 'button'){ ?>
	
	
		
	
	
    var jQuerycontainer = jQuery('#container_newswall');
        jQuerycontainer.infinitescroll({
         navSelector  : '.navigation',  // selector for the paged navigation 
        nextSelector : '.navigation a',  // selector for the NEXT link (to page 2)
        itemSelector : '.item2', 
		behavior: 'twitter',
		finishedMsg: "There are no more posts",    // selector for all items you'll retrieve
		msgText: "Loading the next set of posts...",
        debug: false,
		img:'../images/loaderscroll.gif',
        errorCallback: function() { 
          // fade out the error message after 2 seconds
          jQuery('#infscr-loading').animate({opacity:0},500);   
        }
        },
         // trigger Isotope as a callback
    function( newElements ) {
      // hide new items while they are loading
      var $newElems = jQuery( newElements ).css({ opacity: 0 });
      // ensure that images load before adding to Isotope layout
      $newElems.imagesLoaded(function() {
        // show elems now they're ready
        $newElems.animate({ opacity: 1 });
	jQuerycontainer.append( $newElems ).isotope( 'appended', $newElems );
	
					
		$newElems.hoverdir();			
	 
      });
    });
jQuery(window).unbind('.infscr');

		jQuery('.navigation a').click(function(){
    jQuery('#container_newswall').infinitescroll('retrieve');
	jQuery('.navigation').show();
	
 return false;
 
});

	<?php }; ?>
	
	
  
  
  
	
};

	
mimonewswall();
	});
jQuery('#newswallmimo-filter a').click(function(){
	  var mimocontainer = jQuery('#container_newswall');
      var selected2 = jQuery(this);
      // don't proceed if already selected
      if ( selected2.hasClass('selected') ) {
        return;
      }

      var optionSet2 = selected2.parents('#newswallmimo-filter');
      // change selected class
      optionSet2.find('.selected').removeClass('selected');
      selected2.addClass('selected');

       var selector = jQuery(this).data('filter');
      mimocontainer.isotope({ filter: selector });

      return false;
    });

    </script>
 

		<?php
		// echo widget closing tag
		
		echo ob_get_clean();
	}

function addHeaders(){
        global $gantry;
          $gantry->addScript(get_template_directory_uri() .'/js/admin/mimonewswall.js');
		  $gantry->addStyle(get_template_directory_uri() .'/css/admin/mimo_admin_widgets.css');
		
    }	    
	
} 