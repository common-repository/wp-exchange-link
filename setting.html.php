<div class="wrap">
	<?php screen_icon('edit'); 
   
    wp_exchange_link_data_verification();

    if ( empty($_POST[$nonce_key]) || ! wp_verify_nonce( $_POST[$nonce_key], basename(__FILE__) ) ){
         wp_exchange_link_initialize_options();
    }


    ?>
	<h2>WP Exchange Link</h2>
	<p>WordPress Auto <a href="https://codex.wordpress.org/Introduction_to_Blogging#Pingbacks" target="_blank">Pingback</a> Link Exchange plugin</p>
    
    <h2><a href="http://wp-exchange.link" target="_blank">wp-exchange.link</a></h2>
    
	<form action="" method="post">
		<table class="form-table">
 
 			<tr>
				<th><label for="wp_exchange_link_vars[email]">E-mail account of<br>wp-exchange.link</label></th>
				<td><input id="wp_exchange_link_vars[email]" type="text"
					name="wp_exchange_link_vars[email]" size="60" 
					value="<?php echo isset($wp_exchange_link_vars['email']) 
						? $wp_exchange_link_vars['email'] : '' ?>" /></td>
			</tr>


            
			<tr>
				<th><label for="wp_exchange_link_vars[siteurl]">Site URL</label></th>
				<td><input id="wp_exchange_link_vars[siteurl]" type="text"
					name="wp_exchange_link_vars[siteurl]" size="60" 
					value="<?php echo isset($wp_exchange_link_vars['siteurl']) 
						//? $wp_exchange_link_vars['siteurl'] : get_site_url()
						? $wp_exchange_link_vars['siteurl'] : '' ?>" /></td>
      		</tr>


             
			<tr>
				<th><label for="wp_exchange_link_vars[locale]">Site Language</label></th>
				<td>
                    
                        

                     <?php 
                       
                        
                        $array = array(
                            array( "العربية", "ar" ),
                            array( "العربية المغربية", "ary" ),
                            array( "Azərbaycan dili", "az" ),
                            array( "گؤنئی آذربایجان", "azb" ),
                            array( "Български", "bg_BG" ),
                            array( "বাংলা", "bn_BD" ),
                            array( "Bosanski", "bs_BA" ),
                            array( "Català", "ca" ),
                            array( "Cebuano", "ceb" ),
                            array( "Čeština‎", "cs_CZ" ),
                            array( "Cymraeg", "cy" ),
                            array( "Dansk", "da_DK" ),
                            array( "Deutsch (Schweiz)", "de_CH" ),
                            array( "Deutsch (Sie)", "de_DE_formal" ),
                            array( "Deutsch", "de_DE" ),
                            array( "Ελληνικά", "el" ),
                            array( "English (United States)", "en_US" ),
                            array( "English (Australia)", "en_AU" ),
                            array( "English (South Africa)", "en_ZA" ),
                            array( "English (New Zealand)", "en_NZ" ),
                            array( "English (Canada)", "en_CA" ),
                            array( "English (UK)", "en_GB" ),
                            array( "Esperanto", "eo" ),
                            array( "Español de Argentina", "es_AR" ),
                            array( "Español de Guatemala", "es_GT" ),
                            array( "Español de Chile", "es_CL" ),
                            array( "Español de Venezuela", "es_VE" ),
                            array( "Español de Colombia", "es_CO" ),
                            array( "Español de México", "es_MX" ),
                            array( "Español de Perú", "es_PE" ),
                            array( "Español", "es_ES" ),
                            array( "Eesti", "et" ),
                            array( "Euskara", "eu" ),
                            array( "فارسی", "fa_IR" ),
                            array( "Suomi", "fi" ),
                            array( "Français de Belgique", "fr_BE" ),
                            array( "Français", "fr_FR" ),
                            array( "Français du Canada", "fr_CA" ),
                            array( "Gàidhlig", "gd" ),
                            array( "Galego", "gl_ES" ),
                            array( "هزاره گی", "haz" ),
                            array( "עִבְרִית", "he_IL" ),
                            array( "हिन्दी", "hi_IN" ),
                            array( "Hrvatski", "hr" ),
                            array( "Magyar", "hu_HU" ),
                            array( "Հայերեն", "hy" ),
                            array( "Bahasa Indonesia", "id_ID" ),
                            array( "Íslenska", "is_IS" ),
                            array( "Italiano", "it_IT" ),
                            array( "日本語", "ja" ),
                            array( "ქართული", "ka_GE" ),
                            array( "한국어", "ko_KR" ),
                            array( "Lietuvių kalba", "lt_LT" ),
                            array( "Bahasa Melayu", "ms_MY" ),
                            array( "ဗမာစာ", "my_MM" ),
                            array( "Norsk bokmål", "nb_NO" ),
                            array( "Nederlands (Formeel)", "nl_NL_formal" ),
                            array( "Nederlands", "nl_NL" ),
                            array( "Norsk nynorsk", "nn_NO" ),
                            array( "Occitan", "oci" ),
                            array( "Polski", "pl_PL" ),
                            array( "پښتو", "ps" ),
                            array( "Português do Brasil", "pt_BR" ),
                            array( "Português", "pt_PT" ),
                            array( "Română", "ro_RO" ),
                            array( "Русский", "ru_RU" ),
                            array( "Slovenčina", "sk_SK" ),
                            array( "Slovenščina", "sl_SI" ),
                            array( "Shqip", "sq" ),
                            array( "Српски језик", "sr_RS" ),
                            array( "Svenska", "sv_SE" ),
                            array( "ไทย", "th" ),
                            array( "Tagalog", "tl" ),
                            array( "Türkçe", "tr_TR" ),
                            array( "Uyƣurqə", "ug_CN" ),
                            array( "Українська", "uk" ),
                            array( "Tiếng Việt", "vi" ),
                            array( "繁體中文", "zh_TW" ),
                            array( "简体中文", "zh_CN" )
                        );
                        $sampleSelectBox = "<select name=\"wp_exchange_link_vars[locale]\">\n";
                        for ( $indexA = 0; $indexA < count( $array ); $indexA++ ) {
                            $sampleSelectBox .= "\t<option value=\"{$array[$indexA][1]}\"";
                            if ( $array[$indexA][1] == $wp_exchange_link_vars['locale'] ) {
                                $sampleSelectBox .= " selected=\"selected\"";
                            }
                            $sampleSelectBox .= ">";
                            $sampleSelectBox .= "{$array[$indexA][0]}";
                            $sampleSelectBox .= "</option>\n";
                        }
                        $sampleSelectBox .= "</select>\n";
                        echo "{$sampleSelectBox}";

                    ?>
                    
           
                        </td>
			</tr>

			<tr>
				<th><label for="wp_exchange_link_vars[category]">Site Category</label></th>
				<td>
                    <?php 
                    
                            $array = array(
                            array( "Art", "Art" ),
                            array( "Auto", "Auto" ),
                            array( "Beauty", "Beauty" ),
                            array( "Business", "Business" ),
                            array( "Career", "Career" ),
                            array( "Celebrity Gossip", "Celebrity Gossip" ),
                            array( "Design", "Design" ),
                            array( "DIY", "DIY" ),
                            array( "Economics", "Economics" ),
                            array( "Education", "Education" ),
                            array( "Entertainment", "Entertainment" ),
                            array( "Finance", "Finance" ),
                            array( "Fitness", "Fitness" ),
                            array( "Food", "Food" ),
                            array( "Gaming", "Gaming" ),
                            array( "Green", "Green" ),
                            array( "Health", "Health" ),
                            array( "History", "History" ),
                            array( "Law", "Law" ),
                            array( "Lifestyle", "Lifestyle" ),
                            array( "Marketing", "Marketing" ),
                            array( "Medical", "Medical" ),
                            array( "Money", "Money" ),
                            array( "Movie", "Movie" ),
                            array( "Music", "Music" ),
                            array( "Nature", "Nature" ),
                            array( "Parenting", "Parenting" ),
                            array( "Pet", "Pet" ),
                            array( "Photography", "Photography" ),
                            array( "Political", "Political" ),
                            array( "Real Estate", "Real Estate" ),
                            array( "Science", "Science" ),
                            array( "SEO", "SEO" ),
                            array( "Shopping", "Shopping" ),
                            array( "Social Media", "Social Media" ),
                            array( "Sports", "Sports" ),
                            array( "Technology", "Technology" ),
                            array( "Travel", "Travel" ),
                            array( "University", "University" ),
                            array( "Wedding", "Wedding" ),
                            array( "Wine", "Wine" ),
                            array( "Others", "Others" ),

                         );
                        $sampleSelectBox = "<select name=\"wp_exchange_link_vars[category]\">\n";
                        for ( $indexA = 0; $indexA < count( $array ); $indexA++ ) {
                            $sampleSelectBox .= "\t<option value=\"{$array[$indexA][1]}\"";
                            if ( $array[$indexA][1] == $wp_exchange_link_vars['category'] ) {
                                $sampleSelectBox .= " selected=\"selected\"";
                            }
                            $sampleSelectBox .= ">";
                            $sampleSelectBox .= "{$array[$indexA][0]}";
                            $sampleSelectBox .= "</option>\n";
                        }
                        $sampleSelectBox .= "</select>\n";
                        echo "{$sampleSelectBox}";

                    ?>
 
                        
               </td>
			</tr>



 			<tr>
				<th><label for="wp_exchange_link_vars[recommended]">The word for<br>Recommended Links</label></th>
				<td><input id="wp_exchange_link_vars[recommended]" type="text"
					name="wp_exchange_link_vars[recommended]" size="60" 
					value="<?php echo isset($wp_exchange_link_vars['recommended']) 
						? $wp_exchange_link_vars['recommended'] : 'Recommended links ' ?>" /></td>
			</tr>

 			<tr>
				<th><label for="wp_exchange_link_vars[refarral]">Refarral link</label></th>
				<td><input id="wp_exchange_link_vars[refarral]" type="text"
					name="wp_exchange_link_vars[refarral]" size="60" 
					value="<?php echo isset($wp_exchange_link_vars['refarral']) 
						? $wp_exchange_link_vars['refarral'] : 'http://wp-exchange.link/register/ref_id=' ?>" /></td>
			</tr>

 			<tr>
				<th><label for="wp_exchange_link_vars[terms]"></label></th>
				<td><input id="wp_exchange_link_vars[terms]" name="wp_exchange_link_vars[terms]" type="checkbox" value='1', <?php 
                
                    
                    if ($wp_exchange_link_vars['terms'] == '1'){
                        echo 'checked';
                    }

                ?>/> I agree to <a href="http://wp-exchange.link/terms" target="_blank">the terms and conditions</a>.
                </td>
			</tr>

		</table>
		<p><input type="submit" class="button-primary" value="Submit" /></p>
        <?php wp_nonce_field( basename(__FILE__), $nonce_key ); ?>
	</form>
</div>