<?php
/**
 * @version   4.0.4 March 22, 2013
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2013 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

global $gantry;
?>

<form role="search" method="get" id="searchform" class="form-inline" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="text" class="field" name="s" id="s" placeholder="<?php _e('type your search','grider'); ?>" value="<?php echo wp_kses( get_search_query(), null ); ?>" />
	
</form>