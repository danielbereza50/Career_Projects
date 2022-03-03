<?php
/*
    Plugin Name: Python Embed 
    Plugin URI:  //
    Description: BareBones template for standard plugin
    Version:     100.0.0
    Author:      Daniel Bereza 
    Author URI:  //
    License:     GPL2
    License URI: Licence URl
*/

// Imports
//include (__DIR__.'/includes/another-class.php');

// cd then change the permissions on that python file
// chmod 777 filename.py or 775

add_shortcode( 'python', 'embed_python' );

function embed_python( $attributes )
{
 $data = shortcode_atts(
        [
            'file' => ''
        ],
        $attributes
    );

    $handle = popen( __DIR__ . '/' . $data['file'] . ' 2>&1', 'r' );
    $read = '';

    while ( ! feof( $handle ) )
    {
        $read .= fread( $handle, 2096 );
    }

    pclose( $handle );

    return $read;

}


// [python] or [python file="main.py"]






