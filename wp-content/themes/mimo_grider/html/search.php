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

<?php global $post, $posts, $query_string, $wp_query, $page_type, $s; ?>

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
			
				<h1>
					<?php echo $gantry->get( $page_type . '-page-heading-text' ); ?>
				</h1>
			
			<?php else : ?>
																												
				<h1>
					<?php printf( _r( 'Search Results for: %s' ), '<span>' . get_search_query() . '</span>' ); ?>
				</h1>

			<?php endif; ?>

		<?php endif; ?>
		
		<?php /** End Page Heading **/ ?>

		<?php /** Begin Posts **/ ?>
														
		<?php while ($custom_query->have_posts()) : $custom_query->the_post(); ?>

			<?php $this->gantry_get_template_part( 'content/content' ); ?>
		
		<?php endwhile; ?>
		
		<?php /** End Posts **/ ?>

		<?php /** Begin Pages Navigation **/ ?>
			
		<?php if( $gantry->get( 'pagination-enabled', '1' ) && $custom_query->max_num_pages > 1 ) gantry_pagination($custom_query); ?>

		<?php /** End Pages Navigation **/ ?>
	
	<?php else : ?>
																															
		<h1>
			<?php _re('Sorry, but nothing matched your search criteria. Please try again with some different keywords.'); ?>
		</h1>
													
	<?php endif; ?>
													
	<?php wp_reset_query(); ?>