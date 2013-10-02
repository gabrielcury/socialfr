<?php
 /**
 
 * Horizontal Bar Widget by framecero
 
 **/ 
 
defined('GANTRY_VERSION') or die();

gantry_import('core.gantrywidget'); 

add_action('widgets_init', array("GantryWidgetMimoHorizontalbar","init"));
add_action('admin_head-widgets.php', array('GantryWidgetMimoHorizontalbar','addHeaders'),-1000);


class GantryWidgetMimoHorizontalbar extends GantryWidget {
    var $short_name = 'mimohorizontalbar';
    var $wp_name = 'gantry_mimohorizontalbar';
    var $long_name = 'Mimo Custom Horizontal Bar';
    var $description = 'Insert line separator';
    var $css_classname = 'widget_gantry_mimohorizontalbar';
    var $width = 200;
    var $height = 400;
    
    

    function init() {
        register_widget("GantryWidgetMimoHorizontalbar");
    }
    
   

    function render($args, $instance){
        global $gantry;
	    
	    ob_start();
	    
	    $type = $instance['type'];
		$hrname = $instance['hrname'];
		
		
		
		
		
		

 		?>
		
		
        	<?php if ($type == 'normal'){ ?>
				<div class="hrnormal"><?php if($hrname != '') :
    		?><div class="hrname"><?php echo $hrname;?></div><?php ;
    	endif; ?></div>	
			<?php  };?>
		
			<?php if ($type == 'colormedium'){ ?>
	<div class="hrcolormedium"><?php if($hrname != '') :
    		?><div class="hrname"><?php echo $hrname;?></div><?php ;
    	endif; ?></div>	
			<?php  };?>
                    
                    <?php if ($type == 'colorbig'){ ?>
		<div class="hrcolorbig"><?php if($hrname != '') :
    		?><div class="hrname"><?php echo $hrname;?></div><?php ;
    	endif; ?></div>	
			<?php  };?>
            
            			<?php if ($type == 'colorbigger'){ ?>
		<div class="hrcolorbigger"><?php if($hrname != '') :
    		?><div class="hrname"><?php echo $hrname;?></div><?php ;
    	endif; ?></div>	
			<?php  };?>
            
            			<?php if ($type == 'dashed'){  ?>
		<div class="hrdashed"><?php if($hrname != '') :
    		?><div class="hrname"><?php echo $hrname;?></div><?php ;
    	endif; ?></div>	
			<?php  };?>
                    <?php if ($type == 'dotted'){  ?>
			<div class="hrdotted"><?php if($hrname != '') :
    		?><div class="hrname"><?php echo $hrname;?></div><?php ;
    	endif; ?></div>	
			<?php  };?>
     
     
     
     
     
     
     
     
     

			
		
		
<div class="clear"></div>	
		<?php
		echo ob_get_clean();
	}

function addHeaders(){
        global $gantry;
        $gantry->addScript(get_template_directory_uri() .'/js/admin/mimohorizontalbar.js');
		
    }	    
	
} 