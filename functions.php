<?php

require get_template_directory().'/inc/cleanup.php';
require get_template_directory().'/inc/function-admin.php';
require get_template_directory().'/inc/enqueue.php';
require get_template_directory().'/inc/theme-support.php';
require get_template_directory().'/inc/custom-post-type.php';
require get_template_directory().'/inc/walker.php';


//SVG files
function add_file_types_to_uploads($file_types){
    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $file_types = array_merge($file_types, $new_filetypes );
    return $file_types;
    }
    add_action('upload_mimes', 'add_file_types_to_uploads');