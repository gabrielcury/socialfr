<?php
/**
 * @version   4.0.4 March 22, 2013
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2013 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
defined( 'GANTRY_VERSION' ) or die();

gantry_import( 'core.gantrylayout' );

/**
 *
 * @package gantry
 * @subpackage html.layouts
 */
class GantryLayoutCommentsTempl_Standard extends GantryLayout {
	var $render_params = array(
		'commentLayout' => 'standard'
	);

	function render( $params = array() ) {
		global $wp_query, $withcomments, $post, $wpdb, $id, $comment, $user_login, $user_ID, $user_identity, $aria_req, $overridden_cpage;
		global $gantry;

		$fparams = $this->_getParams( $params );
		$comment_layout_name = 'comment_' . $fparams->commentLayout;
		$layout = $gantry->_getLayout( $comment_layout_name );
		$className = 'GantryLayout' . ucfirst( $comment_layout_name );
				
		// Do not delete these lines

		ob_start();
 
		if ( post_password_required() ) { ?>
		
			<div class="rt-block">
				<p class="error">
					<?php _re( 'This post is password protected. Enter the password to view comments.' ); ?>
				</p>
			</div>

			<?php return ob_get_clean();
		}
				
		?>
		
		<!-- You can start editing here. -->
		
		<div id="comments-section">
		
			<?php if( have_comments() ) : ?>
			
				<div id="comments">
				
					<div class="comments-section-title">
						<h2>
							<?php printf( _rn( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number() ), number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );?>
						</h2>
					</div>
					
					<div class="comments-list">
						<ol>
							<?php wp_list_comments( array( 'style' => 'ol', 'callback' => array( $className, 'render_comment' ), 'reply_text' => _r( 'Reply' ) ) ); ?>
						</ol>
					</div>
					
					<?php if( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
					
					<div class="comments-pagination">
						<ul>
							<li class="pagination-prev">
								<?php previous_comments_link( '<span class="icon-arrow-left"></span> ' . _r( 'Older Comments' ) ); ?>
							</li>
							<li class="pagination-next">
								<?php next_comments_link( _r( 'Newer Comments' ) . ' <span class="icon-arrow-right"></span>'  ); ?>
							</li>
						</ul>
					</div>
					
					<?php endif; ?>
					
				</div>

			<?php else : // this is displayed if there are no comments so far ?>
			
				<?php if( comments_open() ) : ?>
				
					<!-- Silence is golden -->
					
				<?php else : // comments are closed ?>
				
					<div class="rt-block">
						<p class="warning">
							<?php _re( 'Comments are closed.' ); ?>
						</p>
					</div>
					
				<?php endif; ?>
				
			<?php endif; ?>
			
			<!-- RESPOND -->
			
			<?php if( comments_open() ) : ?>
			
			<div id="respond">

				<div class="comments-section-title">
					<h2>
						<?php comment_form_title( _r( 'Leave a Reply' ), _r( 'Leave a Reply to %s' ) ); ?>
					</h2>
				</div>

				<div class="cancel-comment-reply">
					<small>
						<?php cancel_comment_reply_link( _r('Cancel Reply') ); ?>
					</small>
				</div>
				
				<?php if( get_option('comment_registration' ) && !is_user_logged_in() ) : ?>

					<div class="rt-block">
						<p class="error">
							<?php printf( 'You must be <a href="%1$s">logged in</a> to post a comment.', wp_login_url( get_permalink() ) ); ?>
						</p>
					</div>
					
				<?php else : ?>
				
					<!-- Begin Form -->
					
					<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="comments-form">
					
						<?php if( is_user_logged_in() ) : ?>
						
							<p class="logged-in-as">
								<?php echo sprintf( _r( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" class="btn btn-mini" title="Log out of this account">Log out?</a>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( get_permalink() ) ); ?>
							</p>
								   
						<?php else : ?>

							<p class="comment-notes">
								<small>
									<?php _re( 'Your email address will not be published. Required fields are marked *' ); ?>
								</small>
							</p>

							<div class="control-group">
								<div class="comment-form-author">
									<label for="author">
										<?php _re( 'Name'); ?>
										<span class="required">*</span>
									</label>
									<input class="input-xxlarge" id="author" name="author" type="text" value="" <?php if (isset($req)) echo "aria-required='true'"; ?> />
								</div>
							</div>
							
							<div class="control-group">
								<div class="comment-form-email">
									<label for="email">
										<?php _re( 'Email'); ?>
										<span class="required">*</span>
									</label>
									<input class="input-xxlarge" id="email" name="email" type="text" value="" <?php if (isset($req)) echo "aria-required='true'"; ?> />
								</div>
							</div>

							<div class="control-group">
								<div class="comment-form-url">
									<label for="url">
										<?php _re( 'Website'); ?>
									</label>
									<input class="input-xxlarge" id="url" name="url" type="text" value="" <?php if (isset($req)) echo "aria-required='true'"; ?> />
								</div>
							</div>
							
						<?php endif; ?>
						
						<div class="control-group">
							<p class="comment-form-comment">
								<label for="comment">
									<?php _re( 'Comment' ); ?>
								</label>
								<textarea id="comment" name="comment" class="input-xxlarge" aria-required="true" rows="8"></textarea>
							</p>
						</div>

						<?php ( is_single() ) ? $current_page_type = 'single' : $current_page_type = 'page'; ?>

						<?php if( $gantry->get( $current_page_type . '-comments-form-html-tags', '1' ) ) : ?>

							<p>
								<small>
									<?php printf( _r( 'You may use these <abbr title="HyperText Markup Language" class="initialism">HTML</abbr> tags and attributes: <code>%1$s</code>' ), allowed_tags() ); ?>
								</small>
							</p>

						<?php endif; ?>
						
						<div id="comments-form-buttons">
							<button class="btn btn-primary" type="submit" name="submit" tabindex="5" id="submit">
								<?php _re( 'Post Comment' ); ?>
							</button>
						</div>
				  
						<?php comment_id_fields(); ?>
						<?php do_action( 'comment_form', $post->ID ); ?>
				  
					</form>
					
					<!-- End Form -->
				
				<?php endif; // If registration required and not logged in ?>
				
			</div>
				
			<?php endif; // if you delete this the sky will fall on your head ?>
		
		</div>
		
		<?php return ob_get_clean();
	}
}