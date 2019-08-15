<?php 
require( '../../../../../wp-load.php' );

$post_id = $_POST['post_id'];
$post_title = $_POST['post_title'];
$post_content = stripslashes($_POST['post_content']);


//var_dump($get_post_data);
global $wpdb;
global $gldb;
global $post;

$duplicate_check = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}posts WHERE id = {$post_id}");

/*
if($duplicate_check->post_title == $post_title){
    return;
}

if($duplicate_check->post_content == $post_content){
    return;
}
*/

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