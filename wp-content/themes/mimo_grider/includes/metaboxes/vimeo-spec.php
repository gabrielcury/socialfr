<?php
$vimeo_mb = new WPAlchemy_MetaBox(array
(
    'id' => '_vimeo_meta',
    'title' => 'Add Vimeo Videos ID',
	'mode' => WPALCHEMY_MODE_EXTRACT,
    'template' => get_stylesheet_directory() . '/includes/metaboxes/vimeo-meta.php',
    
));


/* eof */