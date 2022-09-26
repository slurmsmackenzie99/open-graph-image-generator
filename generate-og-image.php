<?php

//OG Image generation

require_once( dirname(dirname(dirname(__DIR__))).'/wp-load.php' );

if ( isset( $_GET ) && isset( $_GET['p'] ) ) {
    $post_id = intval( esc_html( $_GET['p'] ) );
    echo generate_og_image( $post_id );
} else {
    wp_die( 'You can not access to the Open Graph Image without the post ID. Read the instructions properly and try again!' );
}
