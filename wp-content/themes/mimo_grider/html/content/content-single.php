<?php
/**
 * @version   4.0.4 March 22, 2013
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2013 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
// no direct access
defined( 'ABSPATH' ) or die( 'Restricted access' );

// Create a shortcut for params.
$category = get_the_category();
?>

			<?php /** Begin Post **/ ?>
					
			<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">

				

				

				<?php /** Begin Featured Image **/ ?>
			<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
							?>	
							<!-- Begin Thumbnail -->
							<div class="all_image_inside_content">
							<!-- Begin Thumbnail -->
                            
					<div class="blog_thumb_image">
                    
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

				<?php if( $gantry->get( 'single-title-enabled', '1' ) ) : ?>
<div class="article-title">
					<h2>
						<?php if( $gantry->get( 'single-title-link', '0' ) ) : ?>
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

				<?php if( $gantry->get( 'single-meta-author-enabled', '1' ) || $gantry->get( 'single-meta-category-enabled', '0' ) || $gantry->get( 'single-meta-category-parent-enabled', '0' ) || $gantry->get( 'single-meta-date-enabled', '1' ) || $gantry->get( 'single-meta-modified-enabled', '0' ) || $gantry->get( 'single-meta-comments-enabled', '1' ) ) : ?>
				
					<dl class="article-info">

						<?php /** Begin Parent Category **/ ?>
							
						<?php if( $gantry->get( 'single-meta-category-parent-enabled', '0' ) && !empty( $category ) && $category[0]->parent != '0' ) : ?>

							<dd class="parent-category-name"> 
								<?php
									$parent_category = get_category( ( int ) $category[0]->parent );
									$title = $parent_category->cat_name;
									$link = get_category_link( $parent_category );
									$url = '<a href="' . esc_url( $link ) . '">' . $title . '</a>'; 
								?>

								<?php if( $gantry->get( 'single-meta-category-parent-prefix' ) != '' ) echo $gantry->get( 'single-meta-category-parent-prefix' ); ?>
			
								<?php if( $gantry->get( 'single-meta-category-parent-link', '0' ) ) : ?>
									<?php echo $url; ?>
								<?php else : ?>
									<?php echo $title; ?>
								<?php endif; ?>
							</dd>

						<?php endif; ?>

						<?php /** End Parent Category **/ ?>
	
						<?php /** Begin Category **/ ?>

						<?php if( $gantry->get( 'single-meta-category-enabled', '0' ) && !empty( $category ) ) : ?>

							<dd class="category-name"> 
								<?php 
									$title = $category[0]->cat_name;
									$link = get_category_link( $category[0]->cat_ID );
									$url = '<a href="' . esc_url( $link ) . '">' . $title . '</a>';
								?>

								<?php if( $gantry->get( 'single-meta-category-prefix' ) != '' ) echo $gantry->get( 'single-meta-category-prefix' ); ?>
			
								<?php if( $gantry->get( 'single-meta-category-link', '0' ) ) : ?>
									<?php echo $url; ?>
								<?php else : ?>
									<?php echo $title; ?>
								<?php endif; ?>
							</dd>

						<?php endif; ?>

						<?php /** End Category **/ ?>

						<?php /** Begin Date & Time **/ ?>

						<?php if( $gantry->get( 'single-meta-date-enabled', '1' ) ) : ?>

							<dd class="create"> <?php if( $gantry->get( 'single-meta-date-prefix' ) != '' ) echo $gantry->get( 'single-meta-date-prefix' ) . ' '; ?><?php the_time( $gantry->get( 'single-meta-date-format', 'd F Y' ) ); ?></dd>

						<?php endif; ?>

						<?php /** End Date & Time **/ ?>

						<?php /** Begin Modified Date **/ ?>

						<?php if( $gantry->get( 'single-meta-modified-enabled', '1' ) ) : ?>

							<dd class="modified"> <?php if( $gantry->get( 'single-meta-modified-prefix' ) != '' ) echo $gantry->get( 'single-meta-modified-prefix' ) . ' '; ?><?php the_modified_date( $gantry->get( 'single-meta-modified-format', 'd F Y' ) ); ?></dd>

						<?php endif; ?>

						<?php /** End Modified Date **/ ?>

						<?php /** Begin Author **/ ?>
					
						<?php if( $gantry->get( 'single-meta-author-enabled', '1' ) ) : ?>

							<dd class="createdby"> <?php if( $gantry->get( 'single-meta-author-prefix' ) != '' ) echo $gantry->get( 'single-meta-author-prefix' ) . ' '; ?><?php the_author(); ?></dd>

						<?php endif; ?>

						<?php /** End Author **/ ?>

						<?php /** Begin Comments Count **/ ?>

						<?php if( $gantry->get( 'single-meta-comments-enabled', '1' ) ) : ?>

							<?php if( $gantry->get( 'single-meta-comments-link', '0' ) ) : ?>

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

						<?php if( $gantry->get( 'single-meta-rating-enabled', '1' ) ) : 
						global $review_mb;$metareview = $review_mb->the_meta($post->ID);
					$review_mb->have_fields_and_multi('reviews');$review_mb->the_field ('reviews');
					$review_mb->the_field ('note'); 
					if($metareview): 
				 					$sum = 0; $n = 0; $note =  $metareview['note'];
									foreach($metareview['reviews'] as $itemreview){
									$itemcriteria = $itemreview['ids'];
									$itemvalue = $itemreview['s_field'];
									$sum = $sum + $itemvalue;
									$n++;$total = $sum/$n;
									$totalnodecimal = number_format($total, 2, '.', ' '); }?><?php endif; ?>

							<?php if( $gantry->get( 'single-meta-rating-link', '0' ) ) : ?>

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
				<?php the_content(); ?>
                
				</div>
               
                 <?php  global $review_mb;$metareview = $review_mb->the_meta($post->ID);$review_mb->have_fields_and_multi('reviews');$review_mb->the_field ('reviews'); 
				
				
				 if($metareview): ?>
				  <div class="review">
                  <div class="review-title"><h2>Review Overview</h2></div>	
                  <?php
				 $sum = 0; $n = 0; 
foreach($metareview['reviews'] as $itemreview){

 
$itemcriteria = $itemreview['ids'];
$itemvalue = $itemreview['s_field'];

$sum = $sum + $itemvalue;
  echo '<div class="mimo_review"><div class="criteria"><h4>'. $itemcriteria .'</h4></div>';
  echo '<div class="star" data-score="'. $itemvalue .'"></div></div>';
  $n++;$total = $sum/$n;
 ?> <script>
jQuery(document).ready(function(){
jQuery('.star').raty({
	down: .25, full: .6, up: .76,
	readOnly: true,
	path      : '<?php echo get_template_directory_uri() ?>/images/raty',
  score: function() {
    return jQuery(this).attr('data-score');
  }
});});
</script>
<?php 
$totalnodecimal = number_format($total, 2, '.', ' ');
                                 	
}  ?><div class="mimo_total"><div class="criteria_total"><h2><?php echo $totalnodecimal ?></h2><h4><?php $review_mb->the_field ('note'); echo  $review_mb->the_value();  ?></h4></div><div class="criteria_summary"><?php $review_mb->the_field ('summary'); echo  $review_mb->the_value();  ?></div> <div class="star <?php echo $sum;echo $n; ?> total-star" data-score="<?php echo $total ?>"></div></div></div>

<?php  ;endif; ?> <?php if( $gantry->get( 'single-meta-share-enabled', '1' ) ) : ?><div class="jqueryshare">
                  <div class="mimo_review"><div class="criteria"><h4>Share</h4></div>	 <?php /** Begin Share **/ ?>
                <div class="share">
		<ul class="mimo_social">		
			<li>
				<div class="all_icon twitterall">
                	<div class="twitter">
                    	<a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>" target="_blank" >
                        	<span class="twitter_icon"></span>
                        </a>
					</div>
                </div>
			</li>
	
    		<li>
            	<div class="all_icon facebookall">
                	<div class="facebook">
                    	<a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" target="_blank" >
                        	<span class="facebook_icon"></span>
                        </a>
                    </div>
                </div>
            </li>
	
    		<li>
            	<div class="all_icon googleall">
                	<div class="google">
                    	<a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank" >
                        	<span class="google_icon"></span>
                        </a>
					</div>
                </div>
            </li>
	
    		<li>
            	<div class="all_icon stumbleuponall">
                	<div class="stumbleupon">
                    	<a href="http://www.stumbleupon.com/submit?url=<?php the_permalink(); ?>" target="_blank" >
                        	<span class="stumbleupon_icon"></span>
                        </a>
					</div>
                </div>
			</li>
	
    		<li>
            	<div class="all_icon linkedinall">
                	<div class="linkedin">
                    	<a href="https://www.linkedin.com/cws/share?url=<?php the_permalink(); ?>" target="_blank" >
                        	<span class="linkedin_icon"></span>
                        </a>
					</div>
                </div>
			</li>
    
     		<li>
            	<div class="all_icon pinterestall">
                	<div class="pinterest">
                    	<a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>" target="_blank" >
                        	<span class="pinterest_icon"></span>
                        </a>
					</div>
            	</div>
			</li>
		</ul>
        <div class="clear"></div>	
    </div>
    <?php /** End Share **/ ?></div></div>
    <?php  endif; ?>
				<?php wp_link_pages( 'before=<div class="pagination">' . _r( 'Pages:' ) . '&after=</div>' ); ?>

				<?php edit_post_link( _r( 'Edit' ), '<div class="edit-link">', '</div>' ); ?>

				<?php /** Begin Tags **/ ?>
				
				<?php if( has_tag() && $gantry->get( 'single-tags', '1' ) ) : ?>
																																
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
				
				<?php if( $gantry->get( 'single-footer', '1' ) ) : ?>

					<div class="post-footer">
						<small>
					
						<?php _re('This entry was posted'); ?>
						<?php /* This is commented, because it requires a little adjusting sometimes.
						You'll need to download this plugin, and follow the instructions:
						http://binarybonsai.com/archives/2004/08/17/time-since-plugin/ */
						/* $entry_datetime = abs(strtotime($post->post_date) - (60*120)); echo time_since($entry_datetime); echo ' ago'; */ ?>
						<?php _re('on'); ?> <?php the_time('l, F jS, Y') ?> <?php _re('at'); ?> <?php the_time() ?>
						<?php _re('and is filed under'); ?> <?php the_category(', ') ?>.
						<?php _re('You can follow any responses to this entry through the'); ?> <?php post_comments_feed_link('RSS 2.0'); ?> <?php _re('feed'); ?>.

						<?php if (('open' == $post->comment_status) && ('open' == $post->ping_status)) {
						// Both Comments and Pings are open ?>
						<?php _re('You can'); ?> <a href="#respond"><?php _re('leave a response'); ?></a>, <?php _re('or'); ?> <a href="<?php trackback_url(); ?>" rel="trackback"><?php _re('trackback'); ?></a> <?php _re('from your own site.'); ?>

						<?php } elseif (!('open' == $post->comment_status) && ('open' == $post->ping_status)) {
						// Only Pings are Open ?>
						<?php _re('Responses are currently closed, but you can'); ?> <a href="<?php trackback_url(); ?> " rel="trackback"><?php _re('trackback'); ?></a> <?php _re('from your own site.'); ?>

						<?php } elseif (('open' == $post->comment_status) && !('open' == $post->ping_status)) {
						// Comments are open, Pings are not ?>
						<?php _re('You can skip to the end and leave a response. Pinging is currently not allowed.'); ?>

						<?php } elseif (!('open' == $post->comment_status) && !('open' == $post->ping_status)) {
						// Neither Comments, nor Pings are open ?>
						<?php _re('Both comments and pings are currently closed.'); ?>

						<?php } edit_post_link(_r('Edit this entry'),'','.'); ?>

						</small>
					</div>
													
				<?php endif; ?>

				<?php /** End Post Content **/ ?>

				<?php /** Begin Comments **/ ?>
					
				<?php if( comments_open() && $gantry->get( 'single-comments-form-enabled', '1' ) ) : ?>
															
					<?php echo $gantry->displayComments( true, 'standard', 'standard' ); ?>
				
				<?php endif; ?>

				<?php /** End Comments **/ ?>
                <?php if( $gantry->get( 'single-pagination', '1' ) ) : ?>
                <div class="navigation-single">
                <div class=""><div class="first">
				<?php previous_post_link('%link', '%title'); ?></div>
    <div class="right"><?php next_post_link('%link', '%title'); ?></div></div><div class="clear"></div>
   </div>
                <?php endif; ?>

			</div>
			</div>
			<?php /** End Post **/ ?>
			
