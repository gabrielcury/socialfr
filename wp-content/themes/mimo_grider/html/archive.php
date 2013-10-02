<?php
/**
 * @version   4.0.4 March 22, 2013
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2013 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
// no direct access
defined( 'ABSPATH' ) or die( 'Restricted access' );
?>

<?php global $post, $posts, $query_string, $wp_query, $page_type; ?>

	<?php /** Begin Query Setup **/ ?>
	
	<?php

	// Page Type used as a prefix for gantry options ie. archive-content
	$page_type = basename( __FILE__, '.php' );

	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	
	$query = $wp_query->query;
	if ( !is_array( $query ) ) parse_str( $query, $query );
	
	$custom_query = new WP_Query( array_merge( $query, array( 'posts_per_page' => $gantry->get( $page_type . '-count', '5' ), 'paged' => $paged ) ) ); ?>

	<?php /** End Query Setup **/ ?>

	<?php if( $custom_query->have_posts() ) : ?>
	
		<?php /** Begin Page Heading **/ ?>
		
		<?php if( $gantry->get( $page_type . '-page-heading-enabled', '1' ) ) : ?>
		
			<?php if( $gantry->get( $page_type . '-page-heading-text' ) != '' ) : ?>
			<div class="article-title">
				<h1>
					<?php echo $gantry->get( $page_type . '-page-heading-text' ); ?>
				</h1>
			</div>
			<?php else : ?>
				<div class="article-title">																								
				<h1>
					<?php
						if ( is_day() ) :
							printf( _r( 'Daily Archives: %s' ), '<span>' . get_the_date() . '</span>' );
						elseif ( is_month() ) :
							printf( _r( 'Monthly Archives: %s' ), '<span>' . get_the_date( _r( 'F Y', 'monthly archives date format' ) ) . '</span>' );
						elseif ( is_year() ) :
							printf( _r( 'Yearly Archives: %s' ), '<span>' . get_the_date( _r( 'Y', 'yearly archives date format' ) ) . '</span>' );
						else :
							_re( 'Archives' );
						endif;
					?>
				</h1>
</div>
			<?php endif; ?>

		<?php endif; ?>
		
		<?php /** End Page Heading **/ ?>

		<?php /** Begin Posts **/ ?>
														
		<?php while ($custom_query->have_posts()) : $custom_query->the_post(); ?>

			<?php $this->gantry_get_template_part( 'content/content', ( post_type_supports( get_post_type(), 'post-formats' ) ? get_post_format() : get_post_type() ) ); ?>
		
		<?php endwhile; ?>
		
		<?php /** End Posts **/ ?>

		<?php /** Begin Pages Navigation **/ ?>
			
		<?php if( $gantry->get( 'pagination-enabled', '1' ) && $custom_query->max_num_pages > 1 ) gantry_pagination($custom_query); ?>

		<?php /** End Pages Navigation **/ ?>
	
	<?php else : ?>
																															
		<h1>
			<?php _re("Sorry, but there aren't any posts matching your query."); ?>
		</h1>
													
	<?php endif; ?>
													
	<?php wp_reset_query(); ?>