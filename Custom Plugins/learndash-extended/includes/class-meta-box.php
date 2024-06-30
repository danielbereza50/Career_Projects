<?php

function add_custom_meta_box() {
    add_meta_box(
        'custom_meta_box',
        'Featured Course?',
        'render_custom_meta_box',
        'sfwd-courses',
        'normal',
        'default'
    );
}
add_action( 'add_meta_boxes', 'add_custom_meta_box' );
function render_custom_meta_box() {
    global $post;
    $custom_meta = get_post_meta( $post->ID, 'featured_course', true );
    ?>
    <input type="radio" name="featured_course" value="yes" <?php checked( $custom_meta, 'yes' ); ?>>Yes
    <input type="radio" name="featured_course" value="no" <?php checked( $custom_meta, 'no' ); ?>>No


    <?php
}
function save_custom_meta( $post_id ) {
    if ( isset( $_POST['featured_course'] ) ) {
        update_post_meta( $post_id, 'featured_course', sanitize_text_field( $_POST['featured_course'] ) );
		
		
    }
}
add_action( 'save_post', 'save_custom_meta' );