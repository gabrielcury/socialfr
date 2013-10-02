<?php


/**
* Registers the sidebar(s).
*/

register_sidebar(
	array(
		'name'			=>	'Footer',
		'id'			=>	'sidebar-footer',
		'before_widget'	=>	'<div class="widget">',
		'after_widget'	=>	'</div>'
	)
);


/**
* Registers the primary menu.
*/

register_nav_menu('primary', 'Primary Menu');

function fluxipress_nav_menu_args($args = '')
{
	$args['container'] = false;
	return $args;
}
add_filter('wp_nav_menu_args', 'fluxipress_nav_menu_args');


/**
* Configure general theme settings and register styles & scripts.
*/

if(!isset($content_width)) $content_width = 1140;
add_theme_support('automatic-feed-links');
add_theme_support('post-thumbnails');

function fluxipress_add_stylesheets()
{
	wp_register_style(
		'fluxpiress-css-magnific',
		get_template_directory_uri() . '/css/magnific-popup.css'
	);
	wp_enqueue_style('fluxpiress-css-magnific');
	
	wp_register_style(
		'fluxpiress-css-fonts',
		'http' . ($_SERVER['SERVER_PORT'] == 443 ? 's' : '') . '://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,400,700,300'
	);
	wp_enqueue_style('fluxpiress-css-fonts');
}
add_action('wp_enqueue_scripts', 'fluxipress_add_stylesheets');


function fluxipress_add_scripts()
{
	wp_deregister_script('jquery');
	wp_register_script(
		'jquery',
		'http' . ($_SERVER['SERVER_PORT'] == 443 ? 's' : '') . '://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js',
		array(),
		false,
		true
	);
	wp_enqueue_script('jquery');
	
	wp_register_script(
		'fluxpiress-js-magnific',
		get_template_directory_uri() . '/js/jquery.magnific-popup.min.js',
		array(),
		false,
		true
	);
	wp_enqueue_script('fluxpiress-js-magnific');
	
	wp_register_script(
		'fluxpiress-js-init',
		get_template_directory_uri() . '/js/init.js',
		array(),
		false,
		true
	);
	wp_enqueue_script('fluxpiress-js-init');
}
if(!is_admin()) add_action('wp_enqueue_scripts', 'fluxipress_add_scripts', 11);


/**
* Filter meta title.
* 
* @param mixed $title
* @param mixed $sep
*/

function fluxipress_wp_title($title, $sep)
{
	return $title . get_bloginfo('name');
}
add_filter('wp_title', 'fluxipress_wp_title', 10, 2);


/**
* Setup theme customization.
* 
* @param mixed $wp_customize
*/

function fluxipress_customize_register( $wp_customize )
{
	// color options section
	$wp_customize->add_section(
		'fluxipress_color_options',
		array(
			'title'		=> __('Color Options', 'fluxipress'),
			'priority'	=> 31,
		)
	);
	
	// background color
	$wp_customize->add_setting(
		'fluxipress_background_color',
		array(
			'default'	=> '#f0f0f0',
			'transport'	=> 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'fluxipress_background_color',
			array(
				'label'		=> __('Background Color', 'fluxipress'),
				'section'	=> 'fluxipress_color_options',
				'settings'	=> 'fluxipress_background_color',
			)
		)
	);
	
	// post box color
	$wp_customize->add_setting(
		'fluxipress_postbox_color',
		array(
			'default'	=> '#ffffff',
			'transport'	=> 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'fluxipress_postbox_color',
			array(
				'label'		=> __('Post Box Color', 'fluxipress'),
				'section'	=> 'fluxipress_color_options',
				'settings'	=> 'fluxipress_postbox_color',
			)
		)
	);
	
	// text color
	$wp_customize->add_setting(
		'fluxipress_text_color',
		array(
			'default'	=> '#333333',
			'transport'	=> 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'fluxipress_text_color',
			array(
				'label'		=> __('Text Color', 'fluxipress'),
				'section'	=> 'fluxipress_color_options',
				'settings'	=> 'fluxipress_text_color',
			)
		)
	);
	
	// text hover color
	$wp_customize->add_setting(
		'fluxipress_text_hover_color',
		array(
			'default'	=> '#ffffff',
			'transport'	=> 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'fluxipress_text_hover_color',
			array(
				'label'		=> __('Text Color (Hover)', 'fluxipress'),
				'section'	=> 'fluxipress_color_options',
				'settings'	=> 'fluxipress_text_hover_color',
			)
		)
	);
	
	// highlight color
	$wp_customize->add_setting(
		'fluxipress_highlight_color',
		array(
			'default'	=> '#ff0099',
			'transport'	=> 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'fluxipress_highlight_color',
			array(
				'label'		=> __('Highlight Color', 'fluxipress'),
				'section'	=> 'fluxipress_color_options',
				'settings'	=> 'fluxipress_highlight_color',
			)
		)
	);
	
	
	// category options section
	$wp_customize->add_section(
		'fluxipress_category_options',
		array(
			'title'		=> __('Category Options', 'fluxipress'),
			'priority'	=> 32,
		)
	);
	
	// display excerpts
	$wp_customize->add_setting(
		'fluxipress_display_excerpts',
		array(
			'default'	=> true,
			'transport'	=> 'refresh',
		)
	);
	 
	$wp_customize->add_control(
		'fluxipress_display_excerpts',
		array(
			'label' => __('Display Excerpts', 'fluxipress'),
			'section' => 'fluxipress_category_options',
			'settings' => 'fluxipress_display_excerpts',
			'type' => 'checkbox',
		)
	);
	
	// display more link
	$wp_customize->add_setting(
		'fluxipress_display_more',
		array(
			'default'	=> true,
			'transport'	=> 'refresh',
		)
	);
	 
	$wp_customize->add_control(
		'fluxipress_display_more',
		array(
			'label' => __('Display More Link', 'fluxipress'),
			'section' => 'fluxipress_category_options',
			'settings' => 'fluxipress_display_more',
			'type' => 'checkbox',
		)
	);
	
	// more link text
	$wp_customize->add_setting(
		'fluxipress_more_link',
		array(
			'default' => 'more&hellip;',
		)
	);
	
	$wp_customize->add_control(
		'fluxipress_more_link',
		array(
			'label' => 'Post Box Link Text',
			'section' => 'fluxipress_category_options',
			'type' => 'text',
		)
	);
	
	
	// post options section
	$wp_customize->add_section(
		'fluxipress_post_options',
		array(
			'title'		=> __('Post Options', 'fluxipress'),
			'priority'	=> 33,
		)
	);
	
	// display tags
	$wp_customize->add_setting(
		'fluxipress_display_tags',
		array(
			'default'	=> true,
			'transport'	=> 'refresh',
		)
	);
	 
	$wp_customize->add_control(
		'fluxipress_display_tags',
		array(
			'label' => __('Display Tags', 'fluxipress'),
			'section' => 'fluxipress_post_options',
			'settings' => 'fluxipress_display_tags',
			'type' => 'checkbox',
		)
	);
	
}
add_action('customize_register', 'fluxipress_customize_register');


/**
* Parse custom css code.
*/

function fluxipress_customize_css()
{
	$bgColor = get_theme_mod('fluxipress_background_color', '#f0f0f0');
	$textColor = get_theme_mod('fluxipress_text_color', '#333333');
	$textHoverColor = get_theme_mod('fluxipress_text_hover_color', '#ffffff');
	$postBgColor = get_theme_mod('fluxipress_postbox_color', '#ffffff');
	$highlightColor = get_theme_mod('fluxipress_highlight_color', '#ff0099');
	$thumbnailWidth = (int) get_option('thumbnail_size_w');
	$thumbnailHeight = (int) get_option('thumbnail_size_h');
	
	
	$hex = $textColor;
	if($hex{0} === '#') $hex = substr($hex, 1);
	
	if(strlen($hex) == 6)
	{
		list($r, $g, $b) = array($hex{0} . $hex{1}, $hex{2} . $hex{3}, $hex{4} . $hex{5});
	}
	elseif(strlen($hex) == 3)
	{
		list($r, $g, $b) = array($hex{0} . $hex{0}, $hex{1} . $hex{1}, $hex{2} . $hex{2});
	}
	else
	{
		return array();
	}
	
	$r = hexdec($r);
	$g = hexdec($g);
	$b = hexdec($b);
	$textColorRGB = array('r' => $r, 'g' => $g, 'b' => $b);
?>
	<style type="text/css">
		body, .mfp-bg, #menu .menu > ul > li > .children, #menu .menu > li > .sub-menu { background: <?php echo $bgColor; ?>; }
		body, #blog-title a, #menu .menu a, #post-list .post .no-more, .comment-author a, .comment-meta a, .ti, .ta, .form .hint, .themeinfo, .mfp-title, .mfp-counter, .mfp-close-btn-in .mfp-close, #page.open #menu .menu .current_page_ancestor > a {
			color: <?php echo $textColor; ?>;
		}
		a, #blog-title a:hover, #menu .menu a:hover, #menu .menu .current-menu-item > a, #menu .menu .current_page_item > a, #menu .menu .current_page_ancestor > a, .bypostauthor .comment-author a, .bypostauthor .comment-author cite, #post-navi div, #post blockquote:before, #post blockquote:after, .form .req label span {
			color: <?php echo $highlightColor; ?>;
		}
		#header .inner { border-bottom: 1px solid <?php echo $textColor; ?>; }
		#menu .menu > ul > li > .children, #menu .menu > li > .sub-menu { border-top: 1px solid <?php echo $highlightColor; ?>; }
		.gt-800 #blog-title a:after { content: "<?php _e('Home', 'fluxibox'); ?>"; }
		#post-navi { border-top: 1px solid <?php echo $textColor; ?>; }
		#sidebar-footer { border-top: 1px solid <?php echo $textColor; ?>; }
		.mfp-title, .mfp-counter { text-shadow: 1px 1px 0 <?php echo $bgColor; ?>; }
		.mfp-arrow-left:after, .mfp-arrow-left .mfp-a { border-right-color: <?php echo $bgColor; ?>; }
		.mfp-arrow-left:before, .mfp-arrow-left .mfp-b { border-right-color: <?php echo $textColor; ?>; }
		.mfp-arrow-right:after, .mfp-arrow-right .mfp-a { border-left-color: <?php echo $bgColor; ?>; }
		.mfp-arrow-right:before, .mfp-arrow-right .mfp-b { border-left-color: <?php echo $textColor; ?>; }
		.post { background: <?php echo $postBgColor; ?>; }
		#post-list .post:hover { background: <?php echo $highlightColor; ?>; }
		#post-list .sticky-icon { border-color: transparent <?php echo $highlightColor; ?> transparent transparent; }
		#post-list .post:hover, #post-list .post:hover a { color: <?php echo $textHoverColor; ?>; }
		#post .gallery .gallery-item {
			width: <?php echo $thumbnailWidth . 'px'; ?>;
			height: <?php echo $thumbnailHeight . 'px'; ?>;
		}
		.comment, #footer .widget { border-bottom: 1px solid rgba(<?php echo $textColorRGB['r']; ?>, <?php echo $textColorRGB['g']; ?>, <?php echo $textColorRGB['b']; ?>, .3); }
		#page.open { box-shadow: 10px 0 20px 0 rgba(<?php echo $textColorRGB['r']; ?>, <?php echo $textColorRGB['g']; ?>, <?php echo $textColorRGB['b']; ?>, .3); }
		@media only screen and (max-width: 800px) {
			#menu { background: rgba(<?php echo $textColorRGB['r']; ?>, <?php echo $textColorRGB['g']; ?>, <?php echo $textColorRGB['b']; ?>, .2); }
		}
		#mobile-menu { background: rgba(<?php echo $textColorRGB['r']; ?>, <?php echo $textColorRGB['g']; ?>, <?php echo $textColorRGB['b']; ?>, .1); }
		#mobile-menu:before { border-color: rgba(<?php echo $textColorRGB['r']; ?>, <?php echo $textColorRGB['g']; ?>, <?php echo $textColorRGB['b']; ?>, .7); }
		#mobile-menu:hover { background: <?php echo $highlightColor; ?>; }
		#mobile-menu:hover:before { border-color: <?php echo $textHoverColor; ?>; }
	</style>
<?php
}
add_action('wp_head', 'fluxipress_customize_css');

 function remove_recent_comments_style() {
 global $wp_widget_factory;
 remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
}
add_action('widgets_init', 'remove_recent_comments_style');

?>