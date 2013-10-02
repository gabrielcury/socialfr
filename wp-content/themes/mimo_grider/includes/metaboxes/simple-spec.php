<?php
$custom_mb = new WPAlchemy_MetaBox(array
(
    'id' => '_custom_meta',
    'title' => 'Add images to slider',
	'mode' => WPALCHEMY_MODE_EXTRACT,
    'template' => get_stylesheet_directory() . '/includes/metaboxes/simple-meta.php',
    
));


/* eof */