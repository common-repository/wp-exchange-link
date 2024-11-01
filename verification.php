<?php
function wp_exchange_link_data_verification(){
    if ( current_user_can( 'edit_others_posts' ) ) {
    //http://www.w3schools.com/php/php_form_url_email.asp
    //http://codex.wordpress.org/Validating_Sanitizing_and_Escaping_User_Data
    
    
        $emailData = $urlData = $localeData = $categoryData = $recommendedData = $refarralData = $termsData = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            $wp_exchange_link_vars = get_option(WP_EXCHANGE_LINK);  

            //email 
            if (empty($wp_exchange_link_vars['email'])) {
                $wp_exchange_link_vars['email'] = "";
            } else {
                $emailData = sanitize_email($wp_exchange_link_vars['email']);
                $wp_exchange_link_vars['email'] = $emailData;
            }

            //url 
            if (empty($wp_exchange_link_vars['siteurl'])) {
                $urlData = "";
                $wp_exchange_link_vars['siteurl'] = "";
            } else {
                $urlData = esc_url($wp_exchange_link_vars['siteurl']);
                $wp_exchange_link_vars['siteurl'] = $urlData;
            }

            //locale 
            if (empty($wp_exchange_link_vars['locale'])) {
                $wp_exchange_link_vars['locale'] = "en_US";
            } else {
                $localeData = sanitize_text_field($wp_exchange_link_vars['locale']);
                $wp_exchange_link_vars['locale'] = $localeData;
            }        
            
            //category 
            if (empty($wp_exchange_link_vars['category'])) {
                $wp_exchange_link_vars['category'] = "Art";
            } else {
                $categoryData = sanitize_text_field($wp_exchange_link_vars['category']);
                $wp_exchange_link_vars['category'] = $categoryData;
            }        

            //recommended  
            if (empty($wp_exchange_link_vars['recommended'])) {
                $wp_exchange_link_vars['recommended'] = "Recommended links ";
            } else {
                $recommendedData = sanitize_text_field($wp_exchange_link_vars['recommended']);
                $wp_exchange_link_vars['recommended'] = $recommendedData;
            }        

            //refarral 
            if (empty($wp_exchange_link_vars['refarral'])) {
                $wp_exchange_link_vars['refarral'] = "";
            } else {
                $refarralData = esc_url($wp_exchange_link_vars['siteurl']);
                $wp_exchange_link_vars['refarral'] = $refarralData;
            }

            //terms
            if (empty($wp_exchange_link_vars['terms'])) {
                $wp_exchange_link_vars['terms'] = "";
            } else {
                $termsData = wp_exchange_link_test_input(sanitize_text_field($wp_exchange_link_vars['terms']));
                if (!preg_match("/^[0-1]*$/",$termsData)) {
                    $termsData = "";
                }
                $wp_exchange_link_vars['terms'] = $termsData;
            }                


        }
    }  
}

function wp_exchange_link_verifyUrl($url){
      if (empty($url)) {
            $urlData = '';
        } else {
            $urlData = esc_url($url);
        }    
        return $urlData;
}

function wp_exchange_link_verifyTitle($title){
      if (empty($title)) {
            $titleData = '';
        } else {
            $titleData = sanitize_title_for_query($title);
        }    
        return $titleData;    
}

function wp_exchange_link_verifyNofollow($nofollow){
    if (empty($nofollow)) {
                $nofollowData = 1;
            } else {
                $nofollowData = wp_exchange_link_test_input($nofollow);
                // check if name only contains letters and whitespace
                if (!preg_match("/^[0-1]*$/",$nofollowData)) {
                    $nofollowData = 1;
                }
            
    }           
    return $nofollowData;   
}

function wp_exchange_link_test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function wp_exchange_link_test_input2($data) {
  //$data = trim($data);
  $data = stripslashes($data);
  //$data = htmlspecialchars($data);
  return $data;
}

function wp_exchange_link_initialize_options(){
    $wp_exchange_link_vars['email'] = "";
    $wp_exchange_link_vars['siteurl'] = "";
    $wp_exchange_link_vars['locale'] = "en_US";
    $wp_exchange_link_vars['category'] = "Art";
    $wp_exchange_link_vars['recommended'] = "Recommended links ";
    $wp_exchange_link_vars['refarral'] = "";
    $wp_exchange_link_vars['terms'] = "";    
}
?>