<?php
// Remove Google Fonts.
function remove_open_sans() {
    wp_deregister_style( 'open-sans' );    
    wp_register_style( 'open-sans', false );    
    wp_enqueue_style('open-sans','');    
}    
add_action( 'init', 'remove_open_sans' );
// options theme.
include(TEMPLATEPATH . '/inc/options-s.php');
include(TEMPLATEPATH . '/functions.jane.php');
?>
