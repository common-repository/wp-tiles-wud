 <?php
 /*
 * === WP Tiles WUD ===
 * Contributors: wistudatbe
 * Author: Danny WUD
 */
//This file needs to load 'wp-load.php' again, there it's called from a Java script
	$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
	require_once( filter_var($parse_uri[0] . 'wp-load.php', FILTER_SANITIZE_STRING) );
	
//Let's start again from here!
	defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
	
	if($_POST)
	{
		$wud_max_tiles = trim(filter_var($_POST['wud_max_tiles'], FILTER_SANITIZE_STRING));
		$tags = trim(filter_var($_POST['wud_tags'], FILTER_SANITIZE_STRING));
		$cats = trim(filter_var($_POST['wud_cats'], FILTER_SANITIZE_STRING));
		$ids = unserialize(filter_var($_POST['wud_ids'], FILTER_SANITIZE_STRING));
		$wud_tile_nr = trim(filter_var($_POST['wud_tiles_nr'], FILTER_SANITIZE_STRING));
		echo wp_tiles_wud__more_post();
		echo '</div>';
	}


// Get the 'see more' image
	function wp_tiles_wud__more_post(){
		global $result, $args, $wud_max_tiles, $tags, $cats, $ids, $wud_tile_nr ;

		
		//Get the category or tag by name
		$wud_cat_or_term_name ='';
		if (!empty( $cats )){$wud_cat_or_term_name = get_the_category_by_ID($cats );}
		elseif (!empty( $tags )){$wud_cat_or_term_name = get_term_by('term_id', $tags, 'post_tag')->name;}
		
		if (!empty( $cats )){$args = array( 'posts_per_page' => $wud_max_tiles , 'category' => $cats, 'post__not_in'=>$ids, 'orderby'=> $GLOBALS['wfuncs']['wud_set_order_tiles'], 'order'=> $GLOBALS['wfuncs']['wud_set_dir_tiles'] );}
		if (!empty( $tags )){$args = array( 'posts_per_page' => $wud_max_tiles , 'tag_id' => $tags, 'post__not_in'=>$ids, 'orderby'=> $GLOBALS['wfuncs']['wud_set_order_tiles'], 'order'=> $GLOBALS['wfuncs']['wud_set_dir_tiles'] );}
		
			$myposts = get_posts( $args );
			if(isset($myposts)){	
			foreach ( $myposts as $post ) : setup_postdata( $post );
				if ($wud_tile_nr>20){$wud_tile_nr=1;}
				$wud_link = get_post_permalink($post->ID);
				$wud_title = $post->post_title;
							
				// WP excerpt
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
	
				$wud_feat_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'large'); 
				$wud_feat_image=$wud_feat_image[0];
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
							
							// If no images, place empty one
							if (empty($wud_feat_image)){$wud_feat_image= $GLOBALS['wfuncs']['wud_def_img'];}
							}
					}
					
					$result .= "<!-- WP Tiles WUD Version ".$GLOBALS['wfuncs']['wud_version']."-->";
					$result .= "<div class='wud-url'><a href='".$wud_link."' title='' alt=''>";				
		//-> Wrapper-start
					// Parameter border
					if($GLOBALS['wfuncs']['wud_show_cat_border']=='1'){
					$result .= "<div class='wp-tiles-wud-wrapper-box' id='wp-tiles-wud-wrapper-".$wud_tile_nr."' >";  
					}
					else{
					$result .= "<div class='wp-tiles-wud-wrapper' id='wp-tiles-wud-wrapper-".$wud_tile_nr."' >";		
					}

		//-> Image-start & end
						$result .= "<div class='wp-tiles-wud-image' style='background-image:url(".$wud_feat_image.")'></div>";	

				$h4font=1;
				$h4height=1.1;
				
				//Parameter hide page/post title
				if($GLOBALS['wfuncs']['wud_my_css']<>"wp-tiles-wud-circle"){
				//Show the post title on the tile
				if($GLOBALS['wfuncs']['wud_hide_tile_header']==0 || !$GLOBALS['wfuncs']['wud_hide_tile_header'] || $GLOBALS['wfuncs']['wud_hide_tile_header']==''){
						if(
						$GLOBALS['wfuncs']['wud_h2_pos']==0){$result .= "<div class='wud-h2' style='font-size:".$GLOBALS['wfuncs']['wud_h2_font_size']."vw; '>".$wud_title."</div>";
						}
						else{
							$result .= "<div id='wud-h2' class='wud-h2' style='font-size:".$GLOBALS['wfuncs']['wud_h2_font_size']."vw; '>".$wud_title."</div>";
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
					    $result .= "<div class='wud-h2' style='font-size:".$GLOBALS['wfuncs']['wud_h2_font_size']."vw; '>".$wud_title."</div>";
				}				
		
		//-> The excerpt text

				// Show excerpt text
				if($GLOBALS['wfuncs']['wud_show_excerpt']=='1'){
					$result .= "<div class='wud-".$GLOBALS['wfuncs']['wud_formatted_text']."-excerpt'>".$wud_excerpt."</div>";	
				}
				// Show excerpt text and title
				elseif ($GLOBALS['wfuncs']['wud_show_excerpt']=='2' ){
					$result .= "<div class='wud-".$GLOBALS['wfuncs']['wud_formatted_text']."-excerpt'><b>".$wud_title."</b><br>".$wud_excerpt."</div>";					
				}
				// Show excerpt text and title
				elseif ($GLOBALS['wfuncs']['wud_show_excerpt']=='3' ){
					$result .= "<div class='wud-".$GLOBALS['wfuncs']['wud_formatted_text']."-excerpt-2'><b>".$wud_title."</b><br>".$wud_excerpt."</div>";						
				}
				
		//-> Wrapper-end
					$result .= "</div>"; 
				$result .= "</a></div>";	
				$wud_tile_nr++; 
			endforeach; 
			wp_reset_postdata();
			}
		return $result;
	}	
	
?>