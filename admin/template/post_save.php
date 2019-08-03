<?php 
require( '../../../../../wp-load.php' );

$post_id = $_POST['post_id'];
$post_title = $_POST['post_title'];
$post_content = $_POST['post_content'];


//var_dump($get_post_data);
global $wpdb;
    global $gldb;
    global $post;

$result = $wpdb->update(
    $wpdb->prefix .'posts', 
    array( 
        'post_title' => $post_title,
        'post_content' => $post_content
    ), 
    array(
        "id" => $post_id
    ) 
);
			?>