<?php

 /**
 
 * Accordion Widget by framecero
 
 **/ 
 
defined('GANTRY_VERSION') or die();

gantry_import('core.gantrywidget');

add_action('widgets_init', array("GantryWidgetMimoAccordion","init"));
add_action('admin_head-widgets.php', array('GantryWidgetMimoAccordion','addHeaders'),-1000);



class GantryWidgetMimoAccordion extends GantryWidget {
    var $short_name = 'mimomenu';
    var $wp_name = 'gantry_mimoaccordion';
    var $long_name = 'Mimo Custom Menu';
    var $description = 'Mimo Custom Accordion Menu';
    var $css_classname = 'widget_gantry_mimoaccordion';
    var $width = 200;
    var $height = 400;
    
    

    function init() {
        register_widget("GantryWidgetMimoAccordion");
    }
    
    function render_title($args, $instance) {
    	global $gantry;
    	if($instance['title'] != '') :
    		echo $instance['title'];
    	endif;
    }

    function render($args, $instance){
        global $gantry;
	    
	    ob_start();
		$menu_class = $instance['menu_class'];
	    $title 	 = $instance['title'];
	    $nav_menu = $instance['nav_menu'];
		$autoClose = $instance['autoClose'];
		$menuClose = $instance['menuClose'];
		$saveState = $instance['saveState'];
		$autoExpand = $instance['autoExpand'];
		$disableLink = $instance['disableLink'];
		$classDisable = $instance['classDisable'];
		$showCount = $instance['showCount'];
		$event = $instance['event'];
		
		$speed = $instance['speed'];
		$hoverDelay = $instance['hoverDelay'];
	    
		if($menu_class != '') :
			$menu_class = ' class="'.$menu_class.'"';
		else :
			$menu_class = '';
		endif;
		
		
		
		
 ?>
        
		<div class="dcjq-accordion<?php echo $this->id ?> theaccordion">
		
			<?php
				wp_nav_menu( 
					array( 
						'fallback_cb' => '', 
						'menu' => $nav_menu, 
						'container' => false,
						'menu_class' => $menu_class
						) 
					);
			?>
		
		</div>
        <script type="text/javascript">
				jQuery(document).ready(function($) {
					jQuery('.dcjq-accordion<?php echo $this->id ?>').dcAccordion({
						eventType: '<?php echo $event; ?>',
						hoverDelay: '<?php echo $hoverDelay; ?>',
						menuClose: <?php echo $menuClose; ?>,
						autoClose: <?php echo $autoClose; ?>,
						saveState: <?php echo $saveState; ?>,
						autoExpand: <?php echo $autoExpand; ?>,
						classExpand: 'current-menu-item',
						classDisable: '<?php echo $classDisable; ?>',
						showCount: <?php echo $showCount; ?>,
						disableLink: <?php echo $disableLink; ?>,
						
						speed: '<?php echo $speed; ?>'
					});
				});
			</script>
		<?php
		echo ob_get_clean();
	}
function addHeaders(){
        global $gantry;
          $gantry->addScript(get_template_directory_uri() .'/js/admin/mimoaccordion.js');
		  
		
    }	    
	    
	
} 