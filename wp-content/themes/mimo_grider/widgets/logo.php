<?php
/**
 * @version   4.0.4 March 22, 2013
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2013 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

defined( 'GANTRY_VERSION' ) or die();
gantry_import('core.gantrygizmo');
gantry_import( 'core.gantrywidget' );
add_action('widgets_init', array("GantryWidgetLogo","init"));
add_action('admin_head-widgets.php', array('GantryWidgetLogo','addHeaders'),-1000);

class GantryWidgetLogo extends GantryWidget {
	var $short_name = 'logo';
	var $wp_name = 'gantry_logo';
	var $long_name = 'Mimo Logo';
	var $description = 'Mimo Logo Widget';
	var $css_classname = 'widget_gantry_logo';
	var $width = 200;
	var $height = 400;

	function init() {
		register_widget( 'GantryWidgetLogo' );
	}

	function render_widget_open( $args, $instance ) {
	}
	
	function render_widget_close( $args, $instance ) {
	}
	
	function pre_render( $args, $instance ) {
	}
	
	function post_render( $args, $instance ) {
	}

	function render( $args, $instance ) {
		global $gantry;
		$logo = str_replace("&quot;", '"', str_replace("'", '"', $gantry->get('logo')));
        $data = json_decode($logo);
		
		ob_start();
		?>
		<div id="<?php echo $this->id; ?>" class="logo-block">
			<a href="<?php echo home_url(); ?>" id="rt-logo"><img src="<?php echo $data->path; ?>" alt="logo"/></a>
		</div>
		<?php
		echo ob_get_clean();
	}
	function addHeaders(){
        global $gantry;
        $gantry->addScript(get_template_directory_uri() .'/js/admin/mimologo.js');
		
    }
}
