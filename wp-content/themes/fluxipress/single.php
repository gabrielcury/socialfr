<?php get_header(); ?>

	<div id="post">
<?php
	while(have_posts()) :
			
			the_post();
		
			$displayTags = (bool) get_theme_mod('fluxipress_display_tags', true);
?>
			<div class="post-content clear">
				<h1><?php the_title(); ?></h1>
				<?php the_content(); ?>
				<?php
					wp_link_pages(array(
						'before'           => '<p class="tr post-pages">' . __('Pages:', 'fluxibox'),
						'after'            => '</p>',
						'nextpagelink'     => __('Next page', 'fluxibox'),
						'previouspagelink' => __('Previous page', 'fluxibox'),
					));
				?>
				<?php if($displayTags) : ?><?php the_tags('<div id="tags">', ', ', '</div>'); ?><?php endif; ?>
			</div>
			<?php comments_template(); ?>
<?php endwhile; ?>
	</div>

<?php get_footer(); ?>