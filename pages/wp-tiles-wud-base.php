<?php
 /*
 * === WP Tiles WUD ===
 * Contributors: wistudatbe
 * Author: Danny WUD
 */
function wp_tiles_wud_comm( $atts ) {	
	// Attributes
	extract( shortcode_atts(array('slug' => '','tiles' => '','button' => '','cp' => '','widget' => ''), $atts ));
	//Remember the CSS ...

	$result = NULL; 
		
// Read the Array data (Category or Tag)
	if(isset($atts["slug"]) && $atts["slug"]!='' ){
		//Make var empty
		$wud_quantity=0; 
		$wud_skip_post=$GLOBALS['wfuncs']['wud_skip_post'];
		$wud_button=0; 
		$wud_widget=0; 
		$wud_post_type=0;

		//Show in widget (yes/no)
		if(isset($atts["widget"]) && $atts["widget"]!='' ){
			if(is_numeric($atts["widget"]) && $atts["widget"] > 0 && $atts["widget"] == round($atts["widget"], 0)){
				$wud_widget = $atts["widget"];
				if($wud_widget > 1){$wud_widget = 1;}
			}
			//Else use the global default value
			else{
				$wud_widget = 0;
			}
		}
		else{
			$wud_quantity = $GLOBALS['wfuncs']['wud_set_max_tiles'];
		}

		
		//Show the button (yes/no)
		if(isset($atts["button"]) && $atts["button"]!='' ){
			if(is_numeric($atts["button"]) && $atts["button"] > 0 && $atts["button"] == round($atts["button"], 0)){
				$wud_button = $atts["button"];
				if($wud_button > 1){$wud_button = 1;}
			}
			//Else use the global default value
			else{
				$wud_button = 0;
			}
		}
		else{
			$wud_quantity = $GLOBALS['wfuncs']['wud_set_max_tiles'];
		}		
		//Tiles quantity given by shortcode
		if(isset($atts["tiles"]) && $atts["tiles"]!='' ){
			if(is_numeric($atts["tiles"]) && $atts["tiles"] > 0 && $atts["tiles"] == round($atts["tiles"], 0)){
				$wud_quantity = $atts["tiles"];
				if($wud_quantity > 50){$wud_quantity = 50;}
			}
			//Else use the global default value
			else{
				$wud_quantity = $GLOBALS['wfuncs']['wud_set_max_tiles'];
			}
		}
		else{
			$wud_quantity = $GLOBALS['wfuncs']['wud_set_max_tiles'];
		}
	  $posts = null;

		//Custom Post
		if (isset($atts["cp"]) && ($atts["cp"]=="1" || $atts["cp"]=="2")){
		$term = post_type_exists($atts["slug"]);
		if ($term !== 0 && $term !== null) {
			$wud_post_type=1;
			$args = array(
				'posts_per_page'   => -1,
				'offset'   => $wud_skip_post,
				'showposts'       => $wud_quantity,
				'post_type'		   => $atts["slug"],
				'orderby'          => $GLOBALS['wfuncs']['wud_set_order_tiles'],
				'order'            => $GLOBALS['wfuncs']['wud_set_dir_tiles']
			);
			$posts = get_posts( $args );
			} 
		}
		
		//Category
		$term = term_exists($atts["slug"], 'category');
		if ($term !== 0 && $term !== null) {
			$args = array(
				'posts_per_page'   => -1,
				'offset'   => $wud_skip_post,
				'showposts'       => $wud_quantity,
				'post_type'		   => 'post',
				'tax_query'		   => array(array('taxonomy' => 'category', 'field' => 'slug', 'terms' => array($atts["slug"]))),
				'orderby'          => $GLOBALS['wfuncs']['wud_set_order_tiles'],
				'order'            => $GLOBALS['wfuncs']['wud_set_dir_tiles']
			);
			$posts = get_posts( $args );
			} 
			

		//Tag
			$term = term_exists($atts["slug"], 'post_tag');
			if ($term !== 0 && $term !== null) {	
				$args = array(
				'posts_per_page'   => -1,
				'offset'   => $wud_skip_post,
				'showposts'       => $wud_quantity,
				'post_type'		   => 'post',
				'tax_query'		   => array(array('taxonomy' => 'post_tag', 'field' => 'slug', 'terms' => array($atts["slug"]))),
				'orderby'          => $GLOBALS['wfuncs']['wud_set_order_tiles'],
				'order'            => $GLOBALS['wfuncs']['wud_set_dir_tiles']
			);
			$posts = get_posts( $args );
			}

		
//-> Show the tiles !

		//if(isset($posts) && 'page' == get_option( 'show_on_front' )){
		if(isset($posts)){
		
		// Remember current slug (cat_or_tag)
		$slugs = $atts["slug"]; 
		$CatIdObj = get_category_by_slug($slugs);  
		$TagIdObj = get_term_by('slug', $slugs, 'post_tag');
	    // Category or Tag Name
			$wud_cat_or_term_name = NULL; // Make the variable empty	
			if (!empty($CatIdObj)){$wud_cat_or_term_name = $CatIdObj->name;}
			if (!empty($TagIdObj)){$wud_cat_or_term_name = $TagIdObj->name;}
			if (empty($wud_cat_or_term_name)){
				if ($atts["cp"]=="1"){$wud_cat_or_term_name=$GLOBALS['wfuncs']['wud_cpt01'];}	
				elseif ($atts["cp"]=="2"){$wud_cat_or_term_name=$GLOBALS['wfuncs']['wud_cpt02'];}
				else {$wud_cat_or_term_name="No title was found ...";}
			}
		// Category or Tag URL
				if (!empty($CatIdObj)){$cat_id = $CatIdObj->cat_ID; $wud_cat_or_term_url = get_category_link( $cat_id);}
				if (!empty($TagIdObj)){$tag_id = $TagIdObj->term_id; $wud_cat_or_term_url = get_term_link( $tag_id);}
				if (empty($wud_cat_or_term_url)){$wud_cat_or_term_url='#';}
		//-> Container-start
			$result .= "<!-- WP Tiles WUD Version ".$GLOBALS['wfuncs']['wud_version']."-->";
			$result .= "<div id='wud_fade_home' class='no-js' ><div class='wp-tiles-wud-container'>"; 
			//Parameter hide category/tag title + back and font color
			$lineheight=$GLOBALS['wfuncs']['wud_h1_font_size']+1;
			if ($wud_widget==0){
			if($GLOBALS['wfuncs']['wud_hide_cat_tag_header']==0 || !$GLOBALS['wfuncs']['wud_hide_cat_tag_header'] || $GLOBALS['wfuncs']['wud_hide_cat_tag_header']==''){$result .= "<div class='wud-h1' style='line-height:".$lineheight."vw; font-size:".$GLOBALS['wfuncs']['wud_h1_font_size']."vw; background-color:".$GLOBALS['wfuncs']['wud_cat_bcolor']."; color:".$GLOBALS['wfuncs']['wud_cat_fcolor'].";'>".$wud_cat_or_term_name."</div>";}
			}
			else{
			$result .= "<div class='wud-h1' style='font-size:1.1vw; background-color:".$GLOBALS['wfuncs']['wud_cat_bcolor']."; color:".$GLOBALS['wfuncs']['wud_cat_fcolor'].";'>".$wud_cat_or_term_name."</div>";	
			}
			$wud_tile_nr = 1; //1-> one tile, 2-> four tiles, 3-> five tiles (total 20 tiles)
			
			  foreach ($posts as $post) {
				  
				$wud_feat_image=NULL; // Make the variable empty
				// CSS variable (size, a.o.)
				if ($wud_tile_nr>20){$wud_tile_nr=1;}
				$post_title = str_replace("'", " ", $post->post_title);
				
				// WP excerpt
				if($GLOBALS['wfuncs']['wud_show_excerpt']=='1' || $GLOBALS['wfuncs']['wud_show_excerpt']=='2' || $GLOBALS['wfuncs']['wud_show_excerpt']=='3'){
					
					if ($GLOBALS['wfuncs']['wud_formatted_text']=="1"){
						//If the real WP excerpt exist (fil in with your own content)
						if(!empty($post->post_excerpt)){$wud_excerpt = wp_trim_words ( $post->post_excerpt ) ;}
						//Else we make our own excerpt from the content
						else{$wud_excerpt = word_trim ( $post->post_content ) ;}
					}
					else{
						//If the real WP excerpt exist (fil in with your own content)
						if(!empty($post->post_excerpt)){$wud_excerpt = strip_shortcodes ( wp_trim_words ( $post->post_excerpt ) );}
						//Else we make our own excerpt from the content
						else{$wud_excerpt = strip_shortcodes ( wp_trim_words ( $post->post_content, $GLOBALS['wfuncs']['wud_excerpt_words'] ) );}	
					}
						//Remove http and https URLS from the excerpt
						$pattern = '~http(s)?://[^\s]*~i';
						$wud_excerpt= preg_replace($pattern, '', $wud_excerpt);
				}

				// Parameter set featured image as primary
				if($GLOBALS['wfuncs']['wud_set_featured_img']=='1'){$wud_feat_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'large');}
				$wud_feat_image=$wud_feat_image[0];
				// If no featured image, try first post image
				if (empty($wud_feat_image)){
					$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches); 
					$wud_feat_img = $matches [1];
						// If images found in post, take the first one
						if (!empty($wud_feat_img)){$wud_feat_image = $wud_feat_img[0];} 
						// If no images, place empty one
						else{					
							//If there are GALLERY images
							$gallery = get_post_gallery( $post, false );
							$gids = explode( ",", $gallery['ids'] );
									 
							foreach( $gids as $gid ) {
								//if found, just pick the first one only
								if($gid){
								$wud_feat_image   = wp_get_attachment_url( $gid );
								break;
								}
							}
							
							//Try to get the Youtube picture
							if (empty($wud_feat_image)){
							$output=preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $post->post_content, $matches);
								if($output){
									$wud_feat_image= "http://img.youtube.com/vi/".$matches [1]."/0.jpg";
									}	
							}
							
							//Try to get the Vimeo picture
							if (empty($wud_feat_image)){
								$output=preg_match('/(https?:\/\/)?(www\.)?(player\.)?vimeo\.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*/', $post->post_content, $id);
									if($output){
									$xml_data=simplexml_load_file('https://vimeo.com/api/oembed.xml?url=https://vimeo.com/'.$id[5]);								
									$wud_feat_image = $xml_data->thumbnail_url;									
									}
							}												
						
							//Still empty ... no picture is found
							if (empty($wud_feat_image)){$wud_feat_image= $GLOBALS['wfuncs']['wud_def_img'];}							
							
						}
				}

				
				$result .= "<a href='".get_post_permalink($post->ID)."' title='' alt='' >";

		//-> Wrapper-start
					// Parameter border
					if($GLOBALS['wfuncs']['wud_show_cat_border']=='1'){
						if ($wud_widget==0){
							$result .= "<div class='wp-tiles-wud-wrapper-box' id='wp-tiles-wud-wrapper-".$wud_tile_nr."' >"; 
						}
						else {
							$result .= "<div class='wp-tiles-wud-wrapper-box' id='wp-tiles-wud-wrapper-".$wud_tile_nr."' style='width: 100% !important;	height: 0; padding-bottom: 100% !important;	margin: 0.5%;'  >"; 	
						}
					}
					else{
						if ($wud_widget==0){
							$result .= "<div class='wp-tiles-wud-wrapper' id='wp-tiles-wud-wrapper-".$wud_tile_nr."' >"; 
						}
						else {
							$result .= "<div class='wp-tiles-wud-wrapper' id='wp-tiles-wud-wrapper-".$wud_tile_nr."' style='width: 100% !important;	height: 0; padding-bottom: 100% !important;	margin: 0.5%;' >";	
						}
					}						

		//-> Image-start & end
						$result .= "<div class='wp-tiles-wud-image' style='background-image:url(".$wud_feat_image.")'></div>";	
						
				//Parameter hide page/post title
				$h2height=$GLOBALS['wfuncs']['wud_h2_font_size']+1;
				$h4font=1;
				$h4height=1.1;
				if($GLOBALS['wfuncs']['wud_my_css']<>"wp-tiles-wud-circle"){
					
					//Show the post title on the tile
					if($GLOBALS['wfuncs']['wud_hide_tile_header']==0 || !$GLOBALS['wfuncs']['wud_hide_tile_header'] || $GLOBALS['wfuncs']['wud_hide_tile_header']==''){
							if($GLOBALS['wfuncs']['wud_h2_pos']==0){
								$result .= "<div class='wud-h2' style='font-size:".$GLOBALS['wfuncs']['wud_h2_font_size']."vw; height:".$h2height."vw;'>".$post->post_title."</div>";
								}
							else{
								$result .= "<div id='wud-h2' class='wud-h2' style='font-size:".$GLOBALS['wfuncs']['wud_h2_font_size']."vw; height:".$h2height."vw; '>".$post->post_title."</div>";
								}
					}
					//Show the category on the tile
					if($GLOBALS['wfuncs']['wud_hide_tile_cat']==0 || !$GLOBALS['wfuncs']['wud_hide_tile_cat'] || $GLOBALS['wfuncs']['wud_hide_tile_cat']==''){}
					else{ //show is value 1
							if($GLOBALS['wfuncs']['wud_h2_pos']==0){
								$result .= "<div id='wud-h4-bottom' class='wud-h4' style='font-size:".$h4font."vw; height:".$h4height."vw;'>".$wud_cat_or_term_name."</div>";
								}
							else{
								$result .= "<div id='wud-h4-top' class='wud-h4' style='font-size:".$h4font."vw; height:".$h4height."vw;'>".$wud_cat_or_term_name."</div>";
								}
					}
					
				}
				// Force page/post title by wud-circle CSS
				if($GLOBALS['wfuncs']['wud_my_css']=="wp-tiles-wud-circle"){
					    $result .= "<div class='wud-h2' style='font-size:".$GLOBALS['wfuncs']['wud_h2_font_size']."vw; height:".$h2height."vw; '>".$post->post_title."</div>";
				}				
		
		//-> The excerpt text
				// Show excerpt text
				if($GLOBALS['wfuncs']['wud_show_excerpt']=='1'){
					$result .= "<div class='wud-".$GLOBALS['wfuncs']['wud_formatted_text']."-excerpt'>".$wud_excerpt."</div>";	
				}
				// Show excerpt text and title
				elseif ($GLOBALS['wfuncs']['wud_show_excerpt']=='2' ){
					$result .= "<div class='wud-".$GLOBALS['wfuncs']['wud_formatted_text']."-excerpt'><b>".$post->post_title."</b><br>".$wud_excerpt."</div>";					
				}
				// Show excerpt text and title
				elseif ($GLOBALS['wfuncs']['wud_show_excerpt']=='3' ){
					$result .= "<div class='wud-".$GLOBALS['wfuncs']['wud_formatted_text']."-excerpt-2'><b>".$post->post_title."</b><br>".$wud_excerpt."</div>";						
				}
					
		//-> Wrapper-end
					$result .= "</div>"; 
				$result .= "</a>";		
					$wud_tile_nr++; 		
			  }
			  wp_reset_postdata();
		 //-> Container-end
			$result .= "<div class='clear'></div>"; 
		//-> Read more-start & end
			$result .= "</div>";

			// Is $GET used ?				
			if(strpos($_SERVER['REQUEST_URI'].esc_url( get_category_link(1)),'?') !== false){$koppel="&";} else{$koppel="?";}
			// Read more + see more tiles
			$readmore = ($wud_quantity + $GLOBALS['wfuncs']['wud_set_more_tiles']);
			
			$buttonheight=$GLOBALS['wfuncs']['wud_but_font_size']+1;
			//--> Archives (0)
			if($GLOBALS['wfuncs']['wud_show_arch_tile']==0){
				//Without archive text
				if($GLOBALS['wfuncs']['wud_show_arch_button']==''){
				if ($wud_button == 0 && $wud_post_type!=1 && $wud_widget==0){
				$result .= "<div class='wud-bottom'><a href='".$wud_cat_or_term_url.$koppel."q=".$readmore."'><div class='wud-h3' style='font-size:".$GLOBALS['wfuncs']['wud_but_font_size']."vw; line-height:".$buttonheight."vw; background-color:".$GLOBALS['wfuncs']['wud_but_bcolor']."; color:".$GLOBALS['wfuncs']['wud_but_fcolor'].";'  role='button'> + </div></a>";	
				}
				else{
				$result .= "<div class='wud-bottom' style='margin:0; padding:0;'><div class='wud-h3' style='margin:0; padding:0;'></div>";		
				}
				}
				//With archive text
				else{
				if ($wud_button == 0 && $wud_post_type!=1 && $wud_widget==0){
				$result .= "<br><div class='wud-bottom'><a href='".$wud_cat_or_term_url.$koppel."q=".$readmore."'><div id='wud_base' class='wud-h3-txt' style='font-size:".$GLOBALS['wfuncs']['wud_but_font_size']."vw;  line-height:".$buttonheight."vw; background-color:".$GLOBALS['wfuncs']['wud_but_bcolor']."; color:".$GLOBALS['wfuncs']['wud_but_fcolor'].";' role='button'> ".$GLOBALS['wfuncs']['wud_show_arch_button']." </div></a>";			
				}
				else{
				$result .= "<div class='wud-bottom' style='margin:0; padding:0;'><div class='wud-h3-txt' style='margin:0; padding:0;'></div>";		
				}				
				}
			}	
			//--> Tiles (1)
			else{		
				//Without tile text
				if($GLOBALS['wfuncs']['wud_show_tile_button']==''){
				if ($wud_button == 0 && $wud_post_type!=1 && $wud_widget==0){
					if ( isset( $cat_id) && !empty( $cat_id) ){$result .= "<br><div class='wud-bottom'><a href='".esc_url( get_category_link( $cat_id ) ).$koppel."q=".$readmore."'><div id='wud_base' class='wud-h3' style='font-size:".$GLOBALS['wfuncs']['wud_but_font_size']."vw;  line-height:".$buttonheight."vw; background-color:".$GLOBALS['wfuncs']['wud_but_bcolor']."; color:".$GLOBALS['wfuncs']['wud_but_fcolor'].";'> + </div></a>";}			
					if ( isset( $tag_id) && !empty( $tag_id) ){$result .= "<br><div class='wud-bottom'><a href='".esc_url( get_term_link( $tag_id ) ).$koppel."q=".$readmore."'><div id='wud_base' class='wud-h3' style='font-size:".$GLOBALS['wfuncs']['wud_but_font_size']."vw;  line-height:".$buttonheight."vw; background-color:".$GLOBALS['wfuncs']['wud_but_bcolor']."; color:".$GLOBALS['wfuncs']['wud_but_fcolor'].";'> + </div></a>";}	
				}
				else{
					if ( isset( $cat_id) && !empty( $cat_id) ){$result .= "<br><div class='wud-bottom' style='margin:0; padding:0;'><div id='wud_base' class='wud-h3' style='margin:0; padding:0;'></div></a>";}			
					if ( isset( $tag_id) && !empty( $tag_id) ){$result .= "<br><div class='wud-bottom' style='margin:0; padding:0;'><div id='wud_base' class='wud-h3' style='margin:0; padding:0;'></div></a>";}					
				}
				}
				//With tile text
				else{
				if ($wud_button == 0 && $wud_post_type!=1 && $wud_widget==0){
				if ( isset( $cat_id) && !empty( $cat_id) ){$result .= "<br><div class='wud-bottom'><a href='".esc_url( get_category_link( $cat_id ) ).$koppel."q=".$readmore."'><div id='wud_base' class='wud-h3-txt' style='font-size:".$GLOBALS['wfuncs']['wud_but_font_size']."vw;  line-height:".$buttonheight."vw; background-color:".$GLOBALS['wfuncs']['wud_but_bcolor']."; color:".$GLOBALS['wfuncs']['wud_but_fcolor'].";'> ".$GLOBALS['wfuncs']['wud_show_tile_button']." </div></a>";}			
				if ( isset( $tag_id) && !empty( $tag_id) ){$result .= "<br><div class='wud-bottom'><a href='".esc_url( get_term_link( $tag_id ) ).$koppel."q=".$readmore."'><div id='wud_base' class='wud-h3-txt' style='font-size:".$GLOBALS['wfuncs']['wud_but_font_size']."vw;  line-height:".$buttonheight."vw; background-color:".$GLOBALS['wfuncs']['wud_but_bcolor']."; color:".$GLOBALS['wfuncs']['wud_but_fcolor'].";'> ".$GLOBALS['wfuncs']['wud_show_tile_button']." </div></a>";}					
				}
				else{
					if ( isset( $cat_id) && !empty( $cat_id) ){$result .= "<br><div class='wud-bottom' style='margin:0; padding:0;'><div id='wud_base' class='wud-h3' style='margin:0; padding:0;'></div></a>";}			
					if ( isset( $tag_id) && !empty( $tag_id) ){$result .= "<br><div class='wud-bottom' style='margin:0; padding:0;'><div id='wud_base' class='wud-h3' style='margin:0; padding:0;'></div></a>";}					
				}
				}
			}
			
			if ($wud_post_type==1){$result .= "<div class='wud-bottom'><div id='wud_base' class='wud-h3'></div>";}
			
			$result .= "</div></div>";
		}
		else{
			$result = '<font color="red">Something went wrong, no post to display ...</font>';
		}
		
	}
		
	return $result;
}
 ?>