<?php
$review_mb = new WPAlchemy_MetaBox(array
(
    'id' => '_custom_meta_review',
    'title' => 'Add reviews',
	'mode' => WPALCHEMY_MODE_EXTRACT,
    'template' => get_stylesheet_directory() . '/includes/metaboxes/review-meta.php',
    
));


/* eof */