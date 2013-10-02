<?php
$youtube_mb = new WPAlchemy_MetaBox(array
(
    'id' => '_youtube_meta',
    'title' => 'Add youtube Videos ID',
	'mode' => WPALCHEMY_MODE_EXTRACT,
    'template' => get_stylesheet_directory() . '/includes/metaboxes/youtube-meta.php',
    
));


/* eof */