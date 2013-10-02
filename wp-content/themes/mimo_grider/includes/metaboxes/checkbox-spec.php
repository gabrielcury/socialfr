<?php

$custom_checkbox_mb = new WPAlchemy_MetaBox(array
(
	'id' => '_custom_checkbox_meta',
	'title' => 'Colored Style',
	'context'	=> 'side',
	'template' => get_stylesheet_directory() . '/includes/metaboxes/checkbox-meta.php',
));

/* eof */