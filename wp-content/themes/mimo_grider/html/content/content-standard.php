<?php
/**
 * @version   4.0.4 March 22, 2013
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2013 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
// no direct access
defined( 'ABSPATH' ) or die( 'Restricted access' );

global $page_type,$post_type;
// Create a shortcut for params.
$category = get_the_category();

 
 
 if (is_blog()) { $page_type = 'blog'; }
 if (is_single()) { $page_type = 'single'; } ?>



			<?php /** Begin Post **/ ?>
					
			<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">

				

				

				<?php /** Begin Featured Image **/ ?>
			<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
							?>	
							<!-- Begin Thumbnail -->
							<div class="all_image_inside_content">
							<!-- Begin Thumbnail -->
                            
					<div class="blog_thumb_image audio">
                    
                     <?php 
					   global $custom_mb;$meta = $custom_mb->the_meta($post->ID);$custom_mb->have_fields_and_multi('docs');$custom_mb->the_field ('docs');
					  
					  global $vimeo_mb;$metavimeo = $vimeo_mb->the_meta($post->ID);$vimeo_mb->have_fields_and_multi('vimeos');$vimeo_mb->the_field ('vimeos');
					  
					  global $youtube_mb;$metayoutube = $youtube_mb->the_meta($post->ID);$youtube_mb->have_fields_and_multi('youtubes');$youtube_mb->the_field ('youtubes');


						
					
						$urlnewswall = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );?>
    
    
					 <?php 
							
					
					 if(($meta) || ($metavimeo) || ($metayoutube)) { ?>
                    <div id="flexslider" class="flexslider portfolio_slider format_images" >

                 
                <ul id="allimg_id<?php the_Id(); ?>" class="format_images slides">
                <?php
		if($meta):		
foreach ($meta['docs'] as $item )
{
 
  $imagen = wp_get_attachment_image_src($item, 'feature'); // Obtenemos la imagen "full". En vez de full podemos poner otro que dispongamos en nuestro tema
  $n = 0;$n++;
 $laurl = $item['imgurl'];
 
  echo '<li class="selector delujo"><a data-rel="prettyPhoto" class="lightbox nopretty" href="'. $laurl .'"><img  src="'. $laurl .'"  title="'. $n .'"';
   echo ' alt="none"';
  echo ' /></a></li>';
 
} ;endif;
?>
	
	
  <?php
  if($metavimeo):	
foreach($metavimeo['vimeos'] as $itemvideo){
 
$vimeourl = $itemvideo['ids'];
  echo '<li class="selector"><div class="js-video [vimeo, widescreen]">
      <iframe id="player_1" class="vimeoiframe" src="http://player.vimeo.com/video/'. $vimeourl .'?api=1&player_id=player_1"  frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
     </div></li>';
 
 
}  ;endif; ?>
    
   
  <?php
   if($metayoutube):
foreach($metayoutube['youtubes'] as $itemyoutube){
 
 $youtubeurl = $itemyoutube['youtubeids'];
  echo '<li class="selector"><div id="youtube_video"  class="js-video [vimeo, widescreen]">
      <iframe id="player_1"  height="100%" src="http://www.youtube.com/embed/'.$youtubeurl.'?enablejsapi=1" frameborder="0" wmode="Opaque" allowfullscreen></iframe>
	   
     </div></li>';
 
 ?>
 
 <?php
};endif;
?></ul>

	
	<?php
	
	 ?>
    
 <script type="text/javascript">
    jQuery(document).ready(function(){
	


	jQuery('.format_images').flexslider({
		selector: '.selector',
	    directionNav: true,
		slideshow: false,
		pauseOnAction: true,
		pauseOnHover: true,
		easing: 'swing',
		video:true,
		controlNav: false, 
		before: function(slider){
			if ( jQuery('#youtube_video')[0] ) { 
		callPlayer('youtube_video', 'pauseVideo');}
		if ( jQuery('#player_1')[0] ) { 
		var myid ='player_1';
		jQuery("[id*="+myid+"]").each(function(){
			Froogaloop(  jQuery(this)[0] ).api('pause');});
      	}              //{NEW} String: Determines the easing method used in jQuery transitions. jQuery easing plugin is supported!
 
	  
		}});
		});
    	</script> 
<div class="clear"></div>	</div>


<?php } else if($urlnewswall) {   ?>
							<div class="newswall-image portfolio_slider">
								<a data-rel="prettyPhoto" href="<?php echo $urlnewswall; ?>"><?php if(function_exists('the_post_thumbnail') && has_post_thumbnail()) : the_post_thumbnail('feature', array('class' => 'rt-image '.$gantry->get('thumb-position')
)); endif; ?>					<div class="clear"></div></a>				
		</div>	<?php } else {}; ?>				
</div>
<div class="clear"></div>

</div> 


				
			

				<?php /** End Featured Image **/ ?>
				<?php /** Begin Article Title **/ ?>

				<?php if( $gantry->get($page_type .  '-post-title-enabled', '1' ) ) : ?>
<div class="article-title">
					<h2>
						<?php if( $gantry->get($page_type .  '-post-title-link', '0' ) ) : ?>
							<a href="<?php the_permalink(); ?>" title="<?php esc_attr_e( get_the_title() ); ?>"><?php the_title(); ?></a>
						<?php else : ?>
							<?php the_title(); ?>
						<?php endif; ?>
					</h2>
</div>
				<?php endif; ?>
                

				<?php /** End Article Title **/ ?>
                <?php /** Begin Post Content **/ ?>		
				<div class="blog_content_standard">	
                <?php /** Begin Extended Meta **/ ?>

				<?php if( $gantry->get($page_type . '-meta-author-enabled', '1' ) || $gantry->get( $page_type . '-meta-category-enabled', '0' ) || $gantry->get( $page_type . '-meta-category-parent-enabled', '0' ) || $gantry->get( $page_type . '-meta-date-enabled', '1' ) || $gantry->get( $page_type . '-meta-modified-enabled', '0' ) || $gantry->get( $page_type . '-meta-comments-enabled', '1' ) ) : ?>
				
					<dl class="article-info">

						<?php /** Begin Parent Category **/ ?>
							
						<?php if( $gantry->get( $page_type . '-meta-category-parent-enabled', '0' ) && !empty( $category ) && $category[0]->parent != '0' ) : ?>

							<dd class="parent-category-name"> 
								<?php
									$parent_category = get_category( ( int ) $category[0]->parent );
									$title = $parent_category->cat_name;
									$link = get_category_link( $parent_category );
									$url = '<a href="' . esc_url( $link ) . '">' . $title . '</a>'; 
								?>

								<?php if( $gantry->get( $page_type . '-meta-category-parent-prefix' ) != '' ) echo $gantry->get( $page_type . '-meta-category-parent-prefix' ); ?>
			
								<?php if( $gantry->get( $page_type . '-meta-category-parent-link', '0' ) ) : ?>
									<?php echo $url; ?>
								<?php else : ?>
									<?php echo $title; ?>
								<?php endif; ?>
							</dd>

						<?php endif; ?>

						<?php /** End Parent Category **/ ?>
	
						<?php /** Begin Category **/ ?>

						<?php if( $gantry->get( $page_type . '-meta-category-enabled', '0' ) && !empty( $category ) ) : ?>

							<dd class="category-name"> 
								<?php 
									$title = $category[0]->cat_name;
									$link = get_category_link( $category[0]->cat_ID );
									$url = '<a href="' . esc_url( $link ) . '">' . $title . '</a>';
								?>

								<?php if( $gantry->get( $page_type . '-meta-category-prefix' ) != '' ) echo $gantry->get( $page_type . '-meta-category-prefix' ); ?>
			
								<?php if( $gantry->get( $page_type . '-meta-category-link', '0' ) ) : ?>
									<?php echo $url; ?>
								<?php else : ?>
									<?php echo $title; ?>
								<?php endif; ?>
							</dd>

						<?php endif; ?>

						<?php /** End Category **/ ?>

						<?php /** Begin Date & Time **/ ?>

						<?php if( $gantry->get( $page_type . '-meta-date-enabled', '1' ) ) : ?>

							<dd class="create"> <?php if( $gantry->get( $page_type . '-meta-date-prefix' ) != '' ) echo $gantry->get( $page_type . '-meta-date-prefix' ) . ' '; ?><?php the_time( $gantry->get( $page_type . '-meta-date-format', 'd F Y' ) ); ?></dd>

						<?php endif; ?>

						<?php /** End Date & Time **/ ?>

						<?php /** Begin Modified Date **/ ?>

						<?php if( $gantry->get( $page_type . '-meta-modified-enabled', '1' ) ) : ?>

							<dd class="modified"> <?php if( $gantry->get( $page_type . '-meta-modified-prefix' ) != '' ) echo $gantry->get( $page_type . '-meta-modified-prefix' ) . ' '; ?><?php the_modified_date( $gantry->get( $page_type . '-meta-modified-format', 'd F Y' ) ); ?></dd>

						<?php endif; ?>

						<?php /** End Modified Date **/ ?>

						<?php /** Begin Author **/ ?>
					
						<?php if( $gantry->get( $page_type . '-meta-author-enabled', '1' ) ) : ?>

							<dd class="createdby"> <?php if( $gantry->get( $page_type . '-meta-author-prefix' ) != '' ) echo $gantry->get( $page_type . '-meta-author-prefix' ) . ' '; ?><?php the_author(); ?></dd>

						<?php endif; ?>

						<?php /** End Author **/ ?>

						<?php /** Begin Comments Count **/ ?>

						<?php if( $gantry->get( $page_type . '-meta-comments-enabled', '1' ) ) : ?>

							<?php if( $gantry->get( $page_type . '-meta-comments-link', '0' ) ) : ?>

								<dd class="comments-count"> 
									<a href="<?php comments_link(); ?>">
										<?php comments_number( _r( '0 Comments' ), _r( '1 Comment' ), _r( '% Comments' ) ); ?>
									</a>
								</dd>

							<?php else : ?>

								<dd class="comments-count"> <?php comments_number( _r( '0 Comments' ), _r( '1 Comment' ), _r( '% Comments' ) ); ?></dd>

							<?php endif; ?>

						<?php endif; ?>

						<?php /** End Comments Count **/ ?>
                         <?php /** Begin Rating Count **/ ?>

						<?php if( $gantry->get(  $page_type . '-meta-rating-enabled', '1' ) ) : 
						global $review_mb;$metareview = $review_mb->the_meta($post->ID);
					$review_mb->have_fields_and_multi('reviews');$review_mb->the_field ('reviews');
					$review_mb->the_field ('note'); $review_mb->the_field ('summary'); $note = $review_mb->the_field ('note'); $summary = $review_mb->the_field ('summary');
					if($metareview): 
				 					$sum = 0; $n = 0;
									foreach($metareview['reviews'] as $itemreview){
									$itemcriteria = $itemreview['ids'];
									$itemvalue = $itemreview['s_field'];
									$sum = $sum + $itemvalue;
									$n++;$total = $sum/$n;
									$totalnodecimal = number_format($total, 0, ',', ' '); }?><?php endif; ?>

							<?php if( $gantry->get(  $page_type . '-meta-rating-link', '0' ) ) : ?>

								<dd class="rating-count"> 
									
										 				
                                    	<a href="<?php the_permalink(); ?>"><?php echo $totalnodecimal;?></a>

					
									
								</dd>

							<?php else : ?>

								<dd class="rating-count"> <?php echo $totalnodecimal;?></dd>

							<?php endif; ?>

						<?php endif; ?>

						<?php /** End Rating Count **/ ?>

					</dl>
				
				<?php endif; ?>

				<?php /** End Extended Meta **/ ?>		
				
                 <div class="mimo-content">        		
				<?php if( $gantry->get( $page_type . '-content', 'content' ) == 'excerpt' ) : ?>
			
				<?php the_excerpt(); ?>
								
			<?php else : ?>

				<?php the_content( false ); ?>
									
			<?php endif; ?>
				</div>
				<?php wp_link_pages( 'before=<div class="pagination">' . _r( 'Pages:' ) . '&after=</div>' ); ?>

				<?php edit_post_link( _r( 'Edit' ), '<div class="edit-link">', '</div>' ); ?>

				<?php /** Begin Tags **/ ?>
				
				<?php if( ($page_type !== 'tag') && has_tag() && $gantry->get( $page_type . '-meta-tags-enabled', '1' ) ) : ?>
																																
					<div class="post-tags">
						<div class="rt-block">
							<div class="module-surround">
								<div class="module-content-tags">
									<?php the_tags('', '', ''); ?>
								</div>
							</div>
						</div>
					</div>

				<?php endif; ?>

				<?php /** End Tags **/ ?>
				
				<?php if( $gantry->get( 'blog-readmore-show', 'auto' ) == 'always' || ( $gantry->get( 'blog-readmore-show', 'auto' ) == 'auto' && ( preg_match( '/<!--more(.*?)?-->/', $post->post_content ) || $gantry->get( 'blog-content', 'content' ) == 'excerpt' ) ) && (is_single() !== true) ) : ?>
				
					<p class="readmore">																			
						<a href="<?php the_permalink(); ?>" title="<?php esc_attr_e( get_the_title() ); ?>"><?php echo $gantry->get( 'blog-readmore-text', 'Read more ...' ); ?></a>
					</p>
				
				<?php endif; ?>

				<?php /** End Post Content **/ ?>

				

			</div>
			</div>
			<?php /** End Post **/ ?>