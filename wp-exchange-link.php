<?php
/*
Plugin Name: WP Exchange Link
Plugin URI: http://www.wp-exchange.link/
Description: Automatic Pingback Link exchange System for WordPress sites.
Author: wp-exchange.link
Version: 1.0.0
Author URI: http://www.wp-exchange.link/
*/

require 'verification.php';
 
define('WP_EXCHANGE_LINK','WP_EXCHANGE_LINK');

add_action('admin_menu', 'wp_exchange_link_admin_menu');
add_action('publish_post', 'wp_exchange_link_post_published');
 
add_filter('content_save_pre', 'wp_exchange_link_content_filter');


function wp_exchange_link_content_filter($content) {
 
    $wp_exchange_link_vars = get_option(WP_EXCHANGE_LINK);  
    wp_exchange_link_data_verification();
    
    if ($content != ""){
        if ( current_user_can( 'edit_others_posts' ) ) {
            if (strstr($content, 'wp-exchange.link')){
                
            } else {
                if ($wp_exchange_link_vars['terms'] == '1'){
                    $content .= wp_exchange_link_get_pinback_links();
                }
            }
        }
        
    } 
    return $content;
}


    
function wp_exchange_link_get_pinback_links(){
	
    $wp_exchange_link_vars = get_option(WP_EXCHANGE_LINK);  
    wp_exchange_link_data_verification();
        
    $result = wp_exchange_link_getJson();
    
    
    $array_count = count($result);
    $recommended_links = $wp_exchange_link_vars['recommended'];
    $by_wp_exchange_link = 'by wp-exchange.link';
    $link_to_wp_exchange_link = $wp_exchange_link_vars['refarral'];
    
    $top_words = '';
    
    //$top_words .= get_the_title();
    
    $top_words .= '<BR><BR><BR><strong>'.$recommended_links;
    $top_words .= ' <a href="'.$link_to_wp_exchange_link.'">'.$by_wp_exchange_link.'</a></strong><br>';
    
    $added_text = $top_words;
    
    for ($count = 0; $count < $array_count; $count++){
        $link_text = '';
        $link_url = $result[$count]['link'];
        $link_url = str_replace(array("\r\n", "\r", "\n"), '', $link_url);
        $link_text .= "<strong>&#x25B6; <a href='".$link_url."'";
        
        if ($result[$count]['nofollow'] == 1){
            $link_text .= " rel='nofollow'";
        }
        
        $link_text .= ">".$result[$count]['title']."</a></strong><br>";
        
        $added_text .= $link_text;
        
        
    }

    return $added_text;

}


function wp_exchange_link_getJson(){
 
    $wp_exchange_link_vars = get_option(WP_EXCHANGE_LINK);  
    wp_exchange_link_data_verification();

    $apiurl = 'http://app.wp-exchange.link/api-get.php';

    $data = array(
		'email' => $wp_exchange_link_vars['email'],
		'siteurl' => $wp_exchange_link_vars['siteurl'],
		'locale' => $wp_exchange_link_vars['locale'],
		'category' => $wp_exchange_link_vars['category']
    );

    $result = wp_exchange_link_http_get($apiurl, $data);

    $result = ltrim($result['content'], '"');
    $result = rtrim($result, '"');
    $result = json_decode($result, TRUE);
    
    return $result;
}    


// GET
function wp_exchange_link_http_get ($url, $data)
{
 
    $url .= "?email=".$data['email']; 
    $url .= "&siteurl=".$data['siteurl']; 
    $url .= "&locale=".$data['locale']; 
    $url .= "&category=".$data['category']; 
    
  return array (
        'content'=>  file_get_contents (
            $url,
            false
            ),
      'headers'=> $http_response_header
  );
}
 

 
function wp_exchange_link_post_published($post_id){
    //https://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/wpdb_Class
    global $wpdb;
    $sql = "UPDATE wp_posts SET ping_status = 'open' WHERE post_status = 'publish' AND post_type = 'post' ORDER BY `ID` DESC LIMIT 10;";
    $results = $wpdb->get_results($sql);
    
    wp_exchange_link_update_postinfo($post_id);
} 


function wp_exchange_link_update_postinfo($post_id){

    $wp_exchange_link_vars = get_option(WP_EXCHANGE_LINK);  
    wp_exchange_link_data_verification();

    $apiurl = 'http://app.wp-exchange.link/api-get.php';
    $post_title = urlencode(get_post($post_id)->post_title);
	$post_url = get_permalink( $post_id );
    
    $data = array(
		'siteurl' => $wp_exchange_link_vars['siteurl'],
        'latesturl' => $post_url,
        'latesttitle' => $post_title
    );

    $url = $apiurl;
    $url .= "?siteurl=".$data['siteurl']; 
    $url .= "&latesturl=".$data['latesturl']; 
    $url .= "&latesttitle=".$data['latesttitle']; 
 

    return array (
        'content'=>  file_get_contents (
            $url,
            false
            ),
        'headers'=> $http_response_header
    );
}


 
function wp_exchange_link_admin_menu() {
	add_menu_page(
		'WP Exchange Link',
		'WP Exchange Link Setting',
		'administrator',
		'wp_exchange_link_admin_menu',
		'wp_exchange_link_edit_setting'
	);
}
 
function wp_exchange_link_edit_setting() {

	$wp_exchange_link_vars = get_option(WP_EXCHANGE_LINK);
    wp_exchange_link_data_verification();
	include 'setting.html.php';
}

?>