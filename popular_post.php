<?php 
    /*
    Plugin Name: Rajendra's popular post  
    Description: Plugin for displaying popular post on the basis of views.
    Author: Rajendra Rijal
    Version: 1.0
    Author URI: http://www.rajendrarijal.com.np
    License: GPLv2 or later
    */



 /* 
 	* Popular Post Counter
 */
if(is_admin()){
	

}
	
function my_popular_post_views( $postID){
	$total_key = 'views';
	// Get current views field
		$total = get_post_meta( $postID, $total_key, true);
	//If current 'views' field is empty, set it to zero.
		if( $total == ''){
			delete_post_meta($postID, $total_key);
			add_post_meta($postID, $total_key, '0');
		} else{
			// If current 'views' field has a value, add 1 to that value.
			$total ++;
			update_post_meta($postID, $total_key, $total);
		}

	
}



  /*  
	* Dynamically inject counter into single post
  */
function my_count_popular_posts( $post_id ){
//Check that is a single post and the user is a visiter
if( !is_single()) 		return;
if( !is_user_logged_in()) {

	//Get the post ID
	if( empty ( $post_id ) ) {
		global $post;
		$post_id = $post->ID;
	}
	//Run the popularity counter on post.
	my_popular_post_views($post_id);

						}
}
add_action( 'wp_head' , 'my_count_popular_posts' );


