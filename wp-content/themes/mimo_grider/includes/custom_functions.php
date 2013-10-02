<?php 
/*
Theme Name: Plus
Theme URI: http://www.mimothemes.com
Description: Wordpress theme by mimothemes
Version: 1.0
Author: Mimo Studio
Author URI: http://www.mimothemes.com

/* Index

**********************************************************************************
	#Pagination
	#Post formats
	#Responsive select Menu 
		
**********************************************************************************

/* Is Blog */
/**
 * WordPress' missing is_blog_page() function.  Determines if the currently viewed page is
 * one of the blog pages, including the blog home page, archive, category/tag, author, or single
 * post pages.
 *
 * @return bool
 */
function is_blog() {

    global $post;

    //Post type must be 'post'.
    $post_type = get_post_type($post);

    //Check all blog-related conditional tags, as well as the current post type, 
    //to determine if we're viewing a blog page.
    return (
        ( is_home()  )
        && ($post_type == 'post')
    ) ? true : false ;

}

/* Pagination 

************************************************************************** */


function mimo_pagination($pages = '', $range = 2)
{  
     $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
         echo "<div class='pagination'>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
         echo "</div>\n";
     }
}

/* Post formats

************************************************************************** */


add_theme_support(
	'post-formats', array(
		'image',
		'link',
		'audio',
		'video'
	)
);
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'custom-header');
add_theme_support( 'custom-background');
add_editor_style(); 
function mimo_enqueue_comments_reply() {
	if( get_option( 'thread_comments' ) )  {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'comment_form_before', 'mimo_enqueue_comments_reply' );
function mimo_comments() {
	$mimocomments = comments_template();
	return;
}

/* Responsive select Menu 

************************************************************************** */

register_nav_menus(
    array(
        'select-menu' => 'Select Menu',
    )
);
function wp_nav_menu_select( $args = array() ) {
     
    $defaults = array(
        'theme_location' => 'mimo_grider',
        'menu_class' => 'select-menu',
    );
     
    $args = wp_parse_args( $args, $defaults );
     
    if ( ( $menu_locations = get_nav_menu_locations() ) && isset( $menu_locations[ $args['theme_location'] ] ) ) {
        $menu = wp_get_nav_menu_object( $menu_locations[ $args['theme_location'] ] );
         
        $menu_items = wp_get_nav_menu_items( $menu->term_id );
        ?>
            <select id="menu-<?php echo $args['theme_location'] ?>" class="<?php echo $args['menu_class'] ?>">
                <option value="" class="option"><?php _e( 'Navigation',"grider" ); ?></option>
                <?php foreach( (array) $menu_items as $key => $menu_item ) : ?>
                    <option value="<?php echo $menu_item->url ?>" class="option"><?php echo $menu_item->title ?></option>
                <?php endforeach; ?>
            </select>
            
        <?php
    }
     
    else {
        ?>
            <select class="menu-not-found">
                <option value="" class="option" ><?php _e( 'Menu Not Found',"grider" ); ?></option>
            </option>
        <?php
    }
 
}   

function ValidateEmail($value)
{
	$regex = '/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i';

	if($value == '') { 
		return false;
	} else {
		$string = preg_replace($regex, '', $value);
	}

	return empty($string) ? true : false;
}
  
function admin_register_head() {
    
    $url = get_template_directory_uri() .'/css/admin/wp-admin.css';
    echo "<link rel='stylesheet' type='text/css' href=".$url." />\n";
}
add_action('admin_head', 'admin_register_head');

if ( ! isset( $content_width ) ) $content_width = 720;



/*Sharrre */






function get_shares($url) { 
     
    // retrieves data with HTTP GET method for current URL      
    $json_string = wp_remote_get(
        'https://graph.facebook.com/'.$url,
        array(
            // disable checking SSL sertificates
            'sslverify'=>false
        )
    );  
     
    // retrives only body from previous HTTP GET request    
    $json_string = wp_remote_retrieve_body($json_string);
     
    // convert body data to JSON format
    $json = json_decode($json_string, true);    
         
    if (isset($json['shares'])) {
        // return count of Facebook shares for requested URL
        return intval( $json['shares'] ); 
    } else {
        // return zero if response is error or current URL not shared yet
        return "0";
    }
}


function twitterCounts($username){

// WordPress Transient API Caching
$cacheKey = $username . '-cache';
$cached = get_transient($cacheKey);
if (false !== $cached)
	{return $cached;}

// Call and instantiate twitterOAuth. Modify the path to where you uploaded twitteroauth


// Replace the four parameters below with the information from your Twitter developer application.
$twitterConnection = new TwitterOAuth('RX45W3VzO85jRo0pZZw','jSRhhHvdBFPZ3RWlctk4dyH82bouCTJOZrMTldppTk4','788867408-NEqh7Zn5Mocf38Uv8zfSXzrMcuSaLVMd8F9VenJQ', 'pt0AeQXWooggR3srXfXeQrcljeZ8wiOziwTETLlz4g');

// Send the API request
$twitterData = $twitterConnection->get('users/show', array('screen_name' => $username));

// Extract the follower and tweet counts
$followerCount = $twitterData->followers_count;
$tweetCount = $twitterData->statuses_count;

$output = $followerCount ;
set_transient($cacheKey,$output,3600);
return $output;
} 



// Facebook followers

function facebook_like_count( $page = 'w4dev', $force= false, $expiration = 3600){
	$transient = 'facebook_like_count_' . $page;
	$url = 'http://graph.facebook.com/'. urlencode( $page );

	$value = get_transient( $transient);
	if( $force|| !is_numeric( $value) || '0' == $value){
		$content = wp_remote_retrieve_body( wp_remote_request( $url));
		
		if( is_wp_error( $content))
			return $content->get_error_message();
		
		$content = json_decode( $content);
		$value = intval( $content->likes);
		set_transient( $transient, $value, $expiration );
	}
	return $value;
}
add_filter( 'wp_get_attachment_link', 'sant_prettyadd');
 
function sant_prettyadd ($content) {
	$content = preg_replace("/<a/","<a data-rel=\"prettyPhoto[pp_gal2]\"",$content,1);
	return $content;
}

/******************************************/
/*Tag cloud Sizes /*/

function widget_custom_tag_cloud($args) {
 
    // Control number of tags to be displayed - 0 no tags
    $args['number'] = 10;
 
    // Tag font unit px, pt, em
    $args['unit'] = 'px';
 
    // Maximum tag text size
    $args['largest'] = 14;
 
    // Minimum tag text size
    $args['smallest'] = 14;
 
    
 
    // Outputs our edited widget
    return $args;
}
add_filter( 'widget_tag_cloud_args', 'widget_custom_tag_cloud' );
function wp64123_sanitize_save_meta($nonce_field){

    /* Get the posted data and sanitize it for use as an HTML class. */
    $new_meta_value = ( isset( $_POST[$nonce_field] ) ? sanitize_html_class( $_POST[$nonce_field] ) : '' );

    /* Get the meta key. */
    $meta_key = $nonce_field;

    /* Get the meta value of the custom field key. */
    $meta_value = get_post_meta( $post_id, $meta_key, true );

        /* If a new meta value was added and there was no previous value, add it. */
    if ( $new_meta_value && '' == $meta_value )
        add_post_meta( $post_id, $meta_key, $new_meta_value, true );
        /* If the new meta value does not match the old value, update it. */
    elseif ( $new_meta_value && $new_meta_value != $meta_value )
        update_post_meta( $post_id, $meta_key, $new_meta_value );
        /* If there is no new meta value but an old value exists, delete it. */
    elseif ( '' == $new_meta_value && $meta_value )
        delete_post_meta( $post_id, $meta_key, $meta_value );      
}


?>
