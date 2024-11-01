<?php
 /*
 * === WP Tiles WUD ===
 * Contributors: wistudatbe
 * Author: Danny WUD
 */
	defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
// ************** OPTIONS PAGE ********************
	function wp_tiles_wud_options_notice() {	
		echo '<div class="wud-admin-table">';
		echo '<h2 class="wud-admin-h2">'.__("WP Tiles wud Options", "wp-tiles-wud").' - '.__("More than just tiles on a page", "wp-tiles-wud").'!</h2>';
		echo '<img src="' . plugins_url( '../images/logo-wp-tiles-wud.png', __FILE__ ) . '">';
		echo '<a id="rate-it" href="https://wordpress.org/support/topic/change-from-wp-tiles-wud-to-grid-wud?replies=1&post-8668658" target="_blank" title="Click here for more info about the Update to Grid-WUD" ><img src="' . plugins_url( '../images/wud-support.png', __FILE__ ) . '"></a>';
		echo '<p></p>';
		
		//SAVE THE VALUES TO WP_OPTIONS
	if ( isset($_POST['wud_opt_hidden']) && $_POST['wud_opt_hidden'] == 'Y' ) {
			
		// CSS choice $wud_my_css = get_option('wud_my_css');
		$wud_my_css = $_POST['wud_my_css'];
		update_option('wud_my_css', $wud_my_css);
		
		//Button back 		
		if ( isset($_POST['wud_but_bc_color']) && !$_POST['wud_but_bc_color']=='') {$wud_but_bcolor = filter_var($_POST['wud_but_bc_color'], FILTER_SANITIZE_STRING);} else{$wud_but_bcolor ="#F73535";}
		update_option('wud_but_bc_color', $wud_but_bcolor);
		
		//Button text
		if ( isset($_POST['wud_but_fc_color']) && !$_POST['wud_but_fc_color']=='') {$wud_but_fcolor = filter_var($_POST['wud_but_fc_color'], FILTER_SANITIZE_STRING);} else{$wud_but_fcolor ="#FFFFFF";}
		update_option('wud_but_fc_color', $wud_but_fcolor);	
		
		//Titles Font Size
		$wud_but_font_size = filter_var($_POST['wud_but_font_size'], FILTER_SANITIZE_STRING);
		if($wud_but_font_size==''){$wud_but_font_size='16';}
		update_option('wud_but_font_size', ($wud_but_font_size/10));
					
		//Category back 
		if ( isset($_POST['wud_cat_bc_color']) && !$_POST['wud_cat_bc_color']=='') {$wud_cat_bcolor = filter_var($_POST['wud_cat_bc_color'], FILTER_SANITIZE_STRING);} else{$wud_cat_bcolor ="#F73535";}
		update_option('wud_cat_bc_color', $wud_cat_bcolor);
		
		//Category text
		if ( isset($_POST['wud_cat_fc_color']) && !$_POST['wud_cat_fc_color']=='') {$wud_cat_fcolor = filter_var($_POST['wud_cat_fc_color'], FILTER_SANITIZE_STRING);} else{$wud_cat_fcolor ="#FFFFFF";}
		update_option('wud_cat_fc_color', $wud_cat_fcolor);		

		//Titles Font Size
		$wud_h1_font_size = filter_var($_POST['wud_h1_font_size'], FILTER_SANITIZE_STRING);
		if($wud_h1_font_size==''){$wud_h1_font_size='21';}
		update_option('wud_h1_font_size', ($wud_h1_font_size/10));

		//Hide Category or Tag Title		
		if ( isset($_POST['wud_cat_tag_header'])) {$wud_hide_cat_tag_header = filter_var($_POST['wud_cat_tag_header'], FILTER_SANITIZE_STRING);} else{$wud_hide_cat_tag_header =0;}
		update_option('wud_cat_tag_header', $wud_hide_cat_tag_header);	
		
		//Hide Post or Page Title
		if ( isset($_POST['wud_hide_tile_header'])) {$wud_hide_tile_header = filter_var($_POST['wud_hide_tile_header'], FILTER_SANITIZE_STRING);} else{$wud_hide_tile_header =0;}
		update_option('wud_hide_tile_header', $wud_hide_tile_header);
		
		//Hide Category Title
		if ( isset($_POST['wud_hide_tile_cat'])) {$wud_hide_tile_cat = filter_var($_POST['wud_hide_tile_cat'], FILTER_SANITIZE_STRING);} else{$wud_hide_tile_cat =0;}
		update_option('wud_hide_tile_cat', $wud_hide_tile_cat);
		
		//Order tiles
		if ( isset($_POST['wud_order_tiles'])) {$wud_set_order_tiles = filter_var($_POST['wud_order_tiles'], FILTER_SANITIZE_STRING);} else{$wud_set_order_tiles =0;}
		update_option('wud_order_tiles', $wud_set_order_tiles);
		
		//Sort order tiles
		$wud_set_dir_tiles = filter_var($_POST['wud_dir_tiles'], FILTER_SANITIZE_STRING);
		update_option('wud_dir_tiles', $wud_set_dir_tiles);
		
		//Border
		if ( isset($_POST['wud_img_border'])) {$wud_show_cat_border = filter_var($_POST['wud_img_border'], FILTER_SANITIZE_STRING);} else{$wud_show_cat_border =0;}
		update_option('wud_img_border', $wud_show_cat_border);	
		
		//Featured image as default
		if ( isset($_POST['wud_featured_img'])) {$wud_set_featured_img = filter_var($_POST['wud_featured_img'], FILTER_SANITIZE_STRING);} else{$wud_set_featured_img =0;}
		update_option('wud_featured_img', $wud_set_featured_img);	
		
		//Zoom image on hover
		if ( isset($_POST['wud_img_hover'])) {$wud_img_hover = filter_var($_POST['wud_img_hover'], FILTER_SANITIZE_STRING);} else{$wud_img_hover =0;}
		update_option('wud_img_hover', $wud_img_hover);	
		
		//Grey image
		if ( isset($_POST['wud_img_grey'])) {$wud_img_grey = filter_var($_POST['wud_img_grey'], FILTER_SANITIZE_STRING);} else{$wud_img_grey =0;}
		update_option('wud_img_grey', $wud_img_grey);	
		
		//Title big
		if ( isset($_POST['wud_title_big'])) {$wud_title_big = filter_var($_POST['wud_title_big'], FILTER_SANITIZE_STRING);} else{$wud_title_big =0;}
		update_option('wud_title_big', $wud_title_big);
		
		//Tiles instead archive pages
		if ( isset($_POST['wud_no_archives'])) {$wud_no_archives = filter_var($_POST['wud_no_archives'], FILTER_SANITIZE_STRING);} else{$wud_no_archives =0;}
		update_option('wud_no_archives', $wud_no_archives);	
		
		//Max tiles to show
		$wud_set_max_tiles = filter_var($_POST['wud_max_tiles'], FILTER_SANITIZE_STRING);
		update_option('wud_max_tiles', $wud_set_max_tiles);
			
		//More tiles to show
		$wud_set_more_tiles = filter_var($_POST['wud_more_tiles'], FILTER_SANITIZE_STRING);
		update_option('wud_more_tiles', $wud_set_more_tiles);
			
		//Skip x posts
		$wud_skip_post = filter_var($_POST['wud_skip_post'], FILTER_SANITIZE_STRING);
		if($wud_skip_post==''){$wud_skip_post='0';}
		update_option('wud_skip_post', $wud_skip_post);
		
		//Featured image as default
		$wud_show_excerpt = filter_var($_POST['wud_show_excerpt'], FILTER_SANITIZE_STRING);
		update_option('wud_show_excerpt', $wud_show_excerpt);

		// Choice text or button = ARCHIVE;
		$wud_show_arch_button = filter_var($_POST['wud_show_arch_button'], FILTER_SANITIZE_STRING);
		update_option('wud_show_arch_button', sanitize_text_field($wud_show_arch_button));

		// Choice text or button = TILES;
		$wud_show_tile_button = filter_var($_POST['wud_show_tile_button'], FILTER_SANITIZE_STRING);
		update_option('wud_show_tile_button', sanitize_text_field($wud_show_tile_button));
	
		//Show read more: archives or tiles
		$wud_show_arch_tile = filter_var($_POST['wud_show_arch_tile'], FILTER_SANITIZE_STRING);
		update_option('wud_show_arch_tile', $wud_show_arch_tile);
	
		//Title tile position
		if ( isset($_POST['wud_h2_pos'])) {$wud_h2_pos = filter_var($_POST['wud_h2_pos'], FILTER_SANITIZE_STRING);} else{$wud_h2_pos =0;}
		update_option('wud_h2_pos', $wud_h2_pos);
		
		//Titles tile Font Size
		$wud_h2_font_size = filter_var($_POST['wud_h2_font_size'], FILTER_SANITIZE_STRING);
		if($wud_h2_font_size==''){$wud_h2_font_size='11';} 
		update_option('wud_h2_font_size', ($wud_h2_font_size/10));

		//Maximum words excerpt
		$wud_excerpt_words = filter_var($_POST['wud_excerpt_words'], FILTER_SANITIZE_STRING);
		if($wud_excerpt_words==''){$wud_excerpt_words=25;}
		update_option('wud_excerpt_words', sanitize_text_field($wud_excerpt_words));
		
		//Fade in tiles
		if ( isset($_POST['wud_fade_in'])) {$wud_fade_in = filter_var($_POST['wud_fade_in'], FILTER_SANITIZE_STRING);} else{$wud_fade_in =0;}
		update_option('wud_fade_in', $wud_fade_in);	

		//Widgets
		if ( isset($_POST['wud_widgets'])) {$wud_widgets = filter_var($_POST['wud_widgets'], FILTER_SANITIZE_STRING);} else{$wud_widgets =0;}
		update_option('wud_widgets', $wud_widgets);
		
		//Custom Post Type 01
		$wud_cpt01 = filter_var($_POST['wud_cpt01'], FILTER_SANITIZE_STRING);
		if(empty($wud_cpt01)){$wud_cpt01="Custom Post Type 1";}
		update_option('wud_cpt01', sanitize_text_field($wud_cpt01));
		
		//Custom Post Type 02
		$wud_cpt02 = filter_var($_POST['wud_cpt02'], FILTER_SANITIZE_STRING);
		if(empty($wud_cpt02)){$wud_cpt02="Custom Post Type 2";}
		update_option('wud_cpt02', sanitize_text_field($wud_cpt02));
		
		//Custom Post Type 02
		$wud_def_img = filter_var($_POST['wud_def_img'], FILTER_SANITIZE_STRING);
		if(empty($wud_def_img)){$wud_def_img=WUD_TILES_URL.'/images/empty-wud.png';}
		update_option('wud_def_img', sanitize_text_field($wud_def_img));
		
		//Secure excerpt
		if ( isset($_POST['wud_formatted_text'])) {$wud_formatted_text = filter_var($_POST['wud_formatted_text'], FILTER_SANITIZE_STRING);} else{$wud_formatted_text =0;}
		update_option('wud_formatted_text', $wud_formatted_text);	
		
		if( empty($error) ){
		echo '<div class="updated"><p><strong>'.__("Settings saved", "wp-tiles-wud").'</strong></p></div>';
		}else{
		echo "<div class='error'><p><strong>";
			foreach ( $error as $key=>$val ) {
				_e($val, 'wud'); 
				echo "<br/>";
			}
		echo "</strong></p></div>";
		    }
	} 
	else {
		
		//If read the first time when opening this page, declare variables
		$wud_my_css = $GLOBALS['wfuncs']['wud_my_css'];
		$wud_cat_bcolor = $GLOBALS['wfuncs']['wud_cat_bcolor'];
		$wud_cat_fcolor = $GLOBALS['wfuncs']['wud_cat_fcolor'];
		$wud_h1_font_size = ($GLOBALS['wfuncs']['wud_h1_font_size']*10);
		$wud_show_cat_border = $GLOBALS['wfuncs']['wud_show_cat_border'];
		$wud_set_featured_img = $GLOBALS['wfuncs']['wud_set_featured_img'];
		$wud_set_max_tiles = $GLOBALS['wfuncs']['wud_set_max_tiles'];
		$wud_set_more_tiles = $GLOBALS['wfuncs']['wud_set_more_tiles'];
		$wud_hide_cat_tag_header = $GLOBALS['wfuncs']['wud_hide_cat_tag_header'];
		$wud_hide_tile_header = $GLOBALS['wfuncs']['wud_hide_tile_header'];	
		$wud_hide_tile_cat = $GLOBALS['wfuncs']['wud_hide_tile_cat'];	
		$wud_show_excerpt = $GLOBALS['wfuncs']['wud_show_excerpt'];
		$wud_show_arch_button = $GLOBALS['wfuncs']['wud_show_arch_button'];
		$wud_show_tile_button = $GLOBALS['wfuncs']['wud_show_tile_button'];
		$wud_show_arch_tile = $GLOBALS['wfuncs']['wud_show_arch_tile'];
		$wud_set_order_tiles = $GLOBALS['wfuncs']['wud_set_order_tiles'];
		$wud_set_dir_tiles = $GLOBALS['wfuncs']['wud_set_dir_tiles'];
		$wud_but_bcolor = $GLOBALS['wfuncs']['wud_but_bcolor'];
		$wud_but_fcolor = $GLOBALS['wfuncs']['wud_but_fcolor'];
		$wud_but_font_size = ($GLOBALS['wfuncs']['wud_but_font_size']*10);
		$wud_h2_pos = $GLOBALS['wfuncs']['wud_h2_pos'];
		$wud_h2_font_size = ($GLOBALS['wfuncs']['wud_h2_font_size']*10);
		$wud_excerpt_words = $GLOBALS['wfuncs']['wud_excerpt_words'];
		$wud_no_archives = $GLOBALS['wfuncs']['wud_no_archives'];
		$wud_skip_post = $GLOBALS['wfuncs']['wud_skip_post'];
		$wud_fade_in = $GLOBALS['wfuncs']['wud_fade_in'];
		$wud_widgets = $GLOBALS['wfuncs']['wud_widgets'];
		$wud_cpt01 = $GLOBALS['wfuncs']['wud_cpt01'];
		$wud_cpt02 = $GLOBALS['wfuncs']['wud_cpt02'];
		$wud_def_img = $GLOBALS['wfuncs']['wud_def_img'];
		$wud_img_hover = $GLOBALS['wfuncs']['wud_img_hover'];
		$wud_img_grey = $GLOBALS['wfuncs']['wud_img_grey'];
		$wud_title_big = $GLOBALS['wfuncs']['wud_title_big'];
		$wud_formatted_text = $GLOBALS['wfuncs']['wud_formatted_text'];
	}

//LEFT ADMIN 
// echo'<div id="wud-tip"><b class="trigger" style="float:right; background:#3A6779; color: white;">&nbsp;?&nbsp;</b><div class="tooltip">'.__("tips, help, support and others2", "wp-tiles-wud").'</div></div>';

		//Form start
	    echo "<form name='wud_form' method='post' action=".admin_url('options-general.php')."?page=wp-tiles-wud>";
		echo "<div class='wud-wrap'>";
		
		echo "<input type='hidden' name='wud_opt_hidden' value='Y'>";
		
		echo '<b class="wud-admin-title">'.__("Category or Tag Title", "wp-tiles-wud").'</b>';
		echo '<i class="cs-wp-color" >'.__("Background", "wp-tiles-wud").': </i><input type="hidden" class="cs-wp-color-picker" name="wud_cat_bc_color" value="'. $wud_cat_bcolor. '" data-rgba="false"><br><br>';
		echo '<i class="cs-wp-color" >'.__("Text", "wp-tiles-wud").': </i><input type="hidden" class="cs-wp-color-picker" name="wud_cat_fc_color" value="'. $wud_cat_fcolor. '" data-rgba="false"><br><br>';

		echo '<dl><dt><label for="wud_box1">'.__("Font size", "wp-tiles-wud").'</label>&nbsp;&nbsp;</dt>
		<dd><input size="2" id="wud_box1" type="text" style="font-weight:bolder;" value="'.$wud_h1_font_size.'" readonly/></dd>
		<dt><label for="wud_sizer1"></label></dt>
		<dd><input class="wud-right" id="wud_sizer1" type="range" min="12" max="34" step="1" value="'.$wud_h1_font_size.'" name="wud_h1_font_size" onchange="wud_box1.value = wud_sizer1.value" oninput="wud_box1.value = wud_sizer1.value" /></dd></dl><br>';
	
		echo '<i>'.__("Hide", "wp-tiles-wud").': </i><input class="wud-right" name="wud_cat_tag_header" type="checkbox" value="1" '. checked( $wud_hide_cat_tag_header, "1", false ) .'/><br><hr>';

		echo'<div id="wud-tip"><b class="trigger" style="float:right; background:#3A6779; color: white;">&nbsp;?&nbsp;</b><div class="tooltip">'.__("If not selected the tile Title is displayed on top.", "wp-tiles-wud").'</div></div>';
		echo '<b class="wud-admin-title">'.__("Tile Title", "wp-tiles-wud").'</b><br>';
		echo '<i>'.__("Bottom", "wp-tiles-wud").': </i><input class="wud-right" name="wud_h2_pos" type="checkbox" value="1" '. checked( $wud_h2_pos, "1", false ) .'/><br>';
		
		echo '<dl><dt><label for="wud_box2">'.__("Font size", "wp-tiles-wud").'</label>&nbsp;&nbsp;</dt>
		<dd><input size="2" id="wud_box2" type="text" style="font-weight:bolder;" value="'.$wud_h2_font_size.'" readonly/></dd>
		<dt><label for="wud_sizer2"></label></dt>
		<dd><input class="wud-right" id="wud_sizer2" type="range" min="5" max="20" step="1" value="'.$wud_h2_font_size.'" name="wud_h2_font_size" onchange="wud_box2.value = wud_sizer2.value" oninput="wud_box2.value = wud_sizer2.value" /></dd></dl><br>';

		echo'<div id="wud-tip"><b class="trigger" style="float:right; background:#3A6779; color: white;">&nbsp;?&nbsp;</b><div class="tooltip">'.__("If not selected the tile Title is displayed on one line and ends with ...", "wp-tiles-wud").'</div></div>';
		echo '<b class="wud-admin-title">'.__("Lenght", "wp-tiles-wud").'</b><br>';
		echo '<i>'.__("Show the complete title", "wp-tiles-wud").': </i><input class="wud-right" name="wud_title_big" type="checkbox" value="1" '. checked( $wud_title_big, "1", false ) .'/><br><br>';

		echo '<i>'.__("Hide", "wp-tiles-wud").': </i><input class="wud-right" name="wud_hide_tile_header" type="checkbox" value="1" '. checked( $wud_hide_tile_header, "1", false ) .'/><br><hr>';

		echo'<div id="wud-tip"><b class="trigger" style="float:right; background:#3A6779; color: white;">&nbsp;?&nbsp;</b><div class="tooltip">'.__("If selected the Category/Tag is visible in the lower right tile corner.", "wp-tiles-wud").'</div></div>';
		echo '<b class="wud-admin-title">'.__("Show Category/Tag on the Tile", "wp-tiles-wud").'</b><br>';
		echo '<i>'.__("Show", "wp-tiles-wud").': </i><input class="wud-right" name="wud_hide_tile_cat" type="checkbox" value="1" '. checked( $wud_hide_tile_cat, "1", false ) .'/><br><br>';
		
		echo '<b class="wud-admin-title">'.__("Tile shadow", "wp-tiles-wud").'</b>';
		echo '<i>'.__("Active", "wp-tiles-wud").': </i><input class="wud-right" name="wud_img_border" type="checkbox" value="1" '. checked( $wud_show_cat_border, "1", false ) .'/><br><br>';
		
		echo '<b class="wud-admin-title">'.__("Featured image", "wp-tiles-wud").'</b>';
		echo '<i>'.__("Set as primary to display", "wp-tiles-wud").': </i><input class="wud-right" name="wud_featured_img" type="checkbox" value="1" '. checked( $wud_set_featured_img, "1", false ) .'/><br><hr>';
			
		echo '<b class="wud-admin-title">'.__("Image on hover", "wp-tiles-wud").'</b>';
		echo '<i>'.__("Zoom the tile image on hover", "wp-tiles-wud").': </i><input class="wud-right" name="wud_img_hover" type="checkbox" value="1" '. checked( $wud_img_hover, "1", false ) .'/><br><br>';
			
		echo '<b class="wud-admin-title">'.__("Grey images", "wp-tiles-wud").'</b>';
		echo '<i>'.__("Show the tiles in grey and on hover in colors", "wp-tiles-wud").': </i><input class="wud-right" name="wud_img_grey" type="checkbox" value="1" '. checked( $wud_img_grey, "1", false ) .'/><br><hr>';
		
		echo'<div id="wud-tip"><b class="trigger" style="float:right; background:#3A6779; color: white;">&nbsp;?&nbsp;</b><div class="tooltip">'.__("If no image was found, use this pre-defined image.<br>You can select any image from the media library, or use the default one.", "wp-tiles-wud").'</div></div>';
		echo '<b class="wud-admin-title">'.__("Default Tile image", "wp-tiles-wud").'</b><br>';
		echo '<img src="'.$wud_def_img.'" id="image-src" width="150px" height="150px" style="box-shadow: 4px 5px 5px #888888;"/><br>';
		echo '<input id="image-url" type="hidden" name="wud_def_img" value="'.$wud_def_img.'" /><br>';
		echo '<input id="upload-button" type="button" class="button" value="'.__("Upload Image", "wp-tiles-wud").'" />  <input id="clear-button" type="button"  class="button" value="'.__("Use the Default Image", "wp-tiles-wud").'" onclick="javascript: ClearText();" ><br><hr>';
		
		//Warning if they want to change this value!
		echo'<div id="wud-tip"><b class="trigger" style="float:right; background:#3A6779; color: white;">&nbsp;?&nbsp;</b><div class="tooltip">'.__("If selected, <b>all</b> Wordpress category's and Tags pages will be displayed as tiles!<br>Remove the selection to de-activate it.", "wp-tiles-wud").'</div></div>';
		echo '<b class="wud-admin-title" style="color: red;">'.__("Activate Tile Pages", "wp-tiles-wud").'</b><br>';
		echo '<i>'.__("Active", "wp-tiles-wud").': </i><input class="trigger" name="wud_no_archives" type="checkbox" value="1" '. checked( $wud_no_archives, "1", false ) .'/><hr>';

		echo'<div id="wud-tip"><b class="trigger" style="float:right; background:#3A6779; color: white;">&nbsp;?&nbsp;</b><div class="tooltip">'.__("Changes the Custom Post Type Title 1 into this text. <br>Usage: short code: cp=\"1\"", "wp-tiles-wud").'</div></div>';
		echo '<b class="wud-admin-title">'.__("Custom Post Type Title", "wp-tiles-wud").' 1</b><br>';		
		echo '<i>'.__("Text", "wp-tiles-wud").' : </i><input type="text" class="wud-right" name="wud_cpt01" value="'.$wud_cpt01.'" /><br><br><br>';
		
		echo'<div id="wud-tip"><b class="trigger" style="float:right; background:#3A6779; color: white;">&nbsp;?&nbsp;</b><div class="tooltip">'.__("Changes the Custom Post Type Title 2 into this text. <br>Usage: short code: cp=\"2\"", "wp-tiles-wud").'</div></div>';
		echo '<b class="wud-admin-title">'.__("Custom Post Type Title", "wp-tiles-wud").' 2</b><br>';
		echo '<i>'.__("Text", "wp-tiles-wud").' : </i><input type="text" class="wud-right" name="wud_cpt02" value="'.$wud_cpt02.'" /><br><br>';
		
		echo '</div>';
//RIGHT ADMIN		
		echo "<div class='wud-wrap-2'>";

		echo '<b class="wud-admin-title">'.__("Buttons", "wp-tiles-wud").'</b>';
		echo '<i class="cs-wp-color" >'.__("Background", "wp-tiles-wud").': </i><input type="hidden" class="cs-wp-color-picker" name="wud_but_bc_color" value="'. $wud_but_bcolor. '" data-rgba="false"><br><br>';
		echo '<i class="cs-wp-color" >'.__("Text", "wp-tiles-wud").': </i><input type="hidden" class="cs-wp-color-picker" name="wud_but_fc_color" value="'. $wud_but_fcolor. '" data-rgba="false"><br><br>';

		echo '<dl><dt><label for="wud_box3">'.__("Font size", "wp-tiles-wud").'</label>&nbsp;&nbsp;</dt>
		<dd><input size="2" id="wud_box3" type="text" style="font-weight:bolder;" value="'.$wud_but_font_size.'" readonly/></dd>
		<dt><label for="wud_sizer3"></label></dt>
		<dd><input class="wud-right" id="wud_sizer3" type="range" min="10" max="30" step="1" value="'.$wud_but_font_size.'" name="wud_but_font_size" onchange="wud_box3.value = wud_sizer3.value" oninput="wud_box3.value = wud_sizer3.value" /></dd></dl><br>';
				
		echo'<div id="wud-tip"><b class="trigger" style="float:right; background:#3A6779; color: white;">&nbsp;?&nbsp;</b><div class="tooltip">'.__("Text for the read more button on archive, category, tags pages (See: <b>Activate Tile Pages</b>).<br>If empty we show a [+] sign, otherwise the text you entered here. ", "wp-tiles-wud").'</div></div>';
		echo '<b class="wud-admin-title">'.__("Archive: read more button or text", "wp-tiles-wud").'</b><br>';
		echo '<i>'.__("Empty = button", "wp-tiles-wud").' </i><b>[+]</b>  : <input type="text" class="wud-right" name="wud_show_arch_button" value="'.$wud_show_arch_button.'" /><br><br><br>';

		echo'<div id="wud-tip"><b class="trigger" style="float:right; background:#3A6779; color: white;">&nbsp;?&nbsp;</b><div class="tooltip">'.__("Text for the read more button on pages containing our short code.<br>If empty we show a [+] sign, otherwise the text you entered here. ", "wp-tiles-wud").'</div></div>';
		echo '<b class="wud-admin-title">'.__("Tiles: read more button or text", "wp-tiles-wud").'</b><br>';
		echo '<i>'.__("Empty = button", "wp-tiles-wud").' </i><b>[+]</b> : <input type="text" class="wud-right" name="wud_show_tile_button" value="'.$wud_show_tile_button.'" /><br><br><hr>';
		
		echo '<select name="wud_my_css" class="wud-right" >';
		echo     '<option value="wp-tiles-wud"'; if ( $wud_my_css == "wp-tiles-wud" ){echo 'selected="selected"';} echo '>WUD Standard</option>';
		echo     '<option value="wp-tiles-wud-square"'; if ( $wud_my_css == "wp-tiles-wud-square" ){echo 'selected="selected"';} echo '>WUD Square</option>';
		echo     '<option value="wp-tiles-wud-blocks"'; if ( $wud_my_css == "wp-tiles-wud-blocks" ){echo 'selected="selected"';} echo '>WUD Blocks</option>';
		echo     '<option value="wp-tiles-wud-circle"'; if ( $wud_my_css == "wp-tiles-wud-circle" ){echo 'selected="selected"';} echo '>WUD Circle</option>';
		echo     '<option value="wp-tiles-wud-photos"'; if ( $wud_my_css == "wp-tiles-wud-photos" ){echo 'selected="selected"';} echo '>WUD Photo\'s</option>';
		echo     '<option value="wp-tiles-wud-horizon"'; if ( $wud_my_css == "wp-tiles-wud-horizon" ){echo 'selected="selected"';} echo '>WUD Horizon</option>';
		echo     '<option value="wp-tiles-wud-mixed"'; if ( $wud_my_css == "wp-tiles-wud-mixed" ){echo 'selected="selected"';} echo '>WUD Mixed</option>';
		echo '</select>';		
		echo '<b class="wud-admin-title">'.__("Lay-out Tiles", "wp-tiles-wud").'</b>';
		echo '<i>'.__("Choose lay-out", "wp-tiles-wud").': </i>';		
		echo '<br><br>';


		echo'<div id="wud-tip"><b class="trigger" style="float:right; background:#3A6779; color: white;">&nbsp;?&nbsp;</b><div class="tooltip">'.__("Enter the number of tiles to be displayed , for each entered short code.", "wp-tiles-wud").'</div></div>';
		echo '<b class="wud-admin-title">'.__("Number of tiles to show", "wp-tiles-wud").'</b>
		<dl><dt><label for="wud_box4">'.__("Maximum", "wp-tiles-wud").'</label>&nbsp;&nbsp;</dt>
		<dd><input size="2" id="wud_box4" type="text" style="font-weight:bolder;" value="'.$wud_set_max_tiles.'" readonly/></dd>
		<dt><label for="wud_sizer4"></label></dt>
		<dd><input class="wud-right" id="wud_sizer4" type="range" min="4" max="20" step="1" value="'.$wud_set_max_tiles.'" name="wud_max_tiles" onchange="wud_box4.value = wud_sizer4.value" oninput="wud_box4.value = wud_sizer4.value" /></dd></dl><br>';


		echo'<div id="wud-tip"><b class="trigger" style="float:right; background:#3A6779; color: white;">&nbsp;?&nbsp;</b><div class="tooltip">'.__("Enter the number of extra tiles to be displayed , after clicking on the read more button.", "wp-tiles-wud").'</div></div>';
		echo '<b class="wud-admin-title">'.__("Show more tiles button", "wp-tiles-wud").'</b>
		<label for="wud_box5">'.__("Number of extra tiles to show", "wp-tiles-wud").'</label>&nbsp;&nbsp;<br>
		<dl><dd><input size="2" id="wud_box5" type="text" style="font-weight:bolder;" value="'.$wud_set_more_tiles.'" readonly/></dd>
		<dt><label for="wud_sizer5"></label></dt>
		<dd><input class="wud-right" id="wud_sizer5" type="range" min="2" max="10" step="2" value="'.$wud_set_more_tiles.'" name="wud_more_tiles" onchange="wud_box5.value = wud_sizer5.value" oninput="wud_box5.value = wud_sizer5.value" /></dd></dl><hr>';

			
		echo'<div id="wud-tip"><b class="trigger" style="float:right; background:#3A6779; color: white;">&nbsp;?&nbsp;</b><div class="tooltip">'.__("If <b>Activate Tile Pages</b> is not activated, show the read more result as archive pages (standard) or as tiles.", "wp-tiles-wud").'</div></div>';
		echo '<b class="wud-admin-title">'.__("Target: read more button", "wp-tiles-wud").'</b><br>';
		echo '<select name="wud_show_arch_tile" class="wud-right" >';
		echo     '<option value="0"'; if ( $wud_show_arch_tile == "0" ){echo 'selected="selected"';} echo '>'.__("Archive", "wp-tiles-wud").'</option>';
		echo     '<option value="1"'; if ( $wud_show_arch_tile == "1" ){echo 'selected="selected"';} echo '>'.__("Tiles", "wp-tiles-wud").'</option>';
		echo '</select>';		
		echo '<i>'.__("Archive or tiles", "wp-tiles-wud").': </i>';	
		echo '<br><br><br>';

		echo '<select name="wud_order_tiles" class="wud-right" >';
		echo     '<option value="date"'; if ( $wud_set_order_tiles == "date" ){echo 'selected="selected"';} echo '>'.__("Date", "wp-tiles-wud").'</option>';
		echo     '<option value="name"'; if ( $wud_set_order_tiles == "name" ){echo 'selected="selected"';} echo '>'.__("Name", "wp-tiles-wud").'</option>';
		echo     '<option value="ID"'; if ( $wud_set_order_tiles == "ID" ){echo 'selected="selected"';} echo '>'.__("Post ID", "wp-tiles-wud").'</option>';
		echo '</select>';		
		echo '<b class="wud-admin-title">'.__("Order by", "wp-tiles-wud").'</b>';
		echo '<i>'.__("Order tiles by", "wp-tiles-wud").': </i>';		
		echo '<br><br><br>';
		
		echo '<select name="wud_dir_tiles" class="wud-right" >';
		echo     '<option value="ASC"'; if ( $wud_set_dir_tiles == "ASC" ){echo 'selected="selected"';} echo '>'.__("Ascending", "wp-tiles-wud").'</option>';
		echo     '<option value="DESC"'; if ( $wud_set_dir_tiles == "DESC" ){echo 'selected="selected"';} echo '>'.__("Descending", "wp-tiles-wud").'</option>';;
		echo '</select>';		
		echo '<b class="wud-admin-title">'.__("Order direction", "wp-tiles-wud").'</b>';
		echo '<i>'.__("Sort order tiles", "wp-tiles-wud").': </i>';		
		echo '<br><br><hr>';

		echo '<select name="wud_show_excerpt" class="wud-right" >';
		echo     '<option value="0"'; if ( $wud_show_excerpt == "0" ){echo 'selected="selected"';} echo '>'.__("Show not", "wp-tiles-wud").'</option>';
		echo     '<option value="1"'; if ( $wud_show_excerpt == "1" ){echo 'selected="selected"';} echo '>'.__("Without title", "wp-tiles-wud").'</option>';
		echo     '<option value="2"'; if ( $wud_show_excerpt == "2" ){echo 'selected="selected"';} echo '>'.__("With title", "wp-tiles-wud").'</option>';
		echo     '<option value="3"'; if ( $wud_show_excerpt == "3" ){echo 'selected="selected"';} echo '>'.__("Show always", "wp-tiles-wud").'</option>';
		echo '</select>';		
		echo '<b class="wud-admin-title">'.__("The excerpt", "wp-tiles-wud").'</b>';
		echo '<i>'.__("Show/Hide ...", "wp-tiles-wud").': </i>';	
		echo '<br><br>';

		echo '<i>'.__("Maximum words", "wp-tiles-wud").' (10 -> 50) : </i><input type="number" min="10" step="1" max="50" size="8" class="wud-right" name="wud_excerpt_words" value="'.$wud_excerpt_words.'" /><br><br>';

		echo'<div id="wud-tip"><b class="trigger" style="float:right; background:#3A6779; color: white;">&nbsp;?&nbsp;</b><div class="tooltip">'.__("If selected, it will add HTML formatting to the excerpts. (default is off)", "wp-tiles-wud").'</div></div>';		
		echo '<b class="wud-admin-title">'.__("Formatted Text", "wp-tiles-wud").'</b><br>';
		echo '<i>'.__("Active", "wp-tiles-wud").': </i><input class="wud-right" name="wud_formatted_text" type="checkbox" value="1" '. checked( $wud_formatted_text, "1", false ) .'/><br><hr>';
			
		echo'<div id="wud-tip"><b class="trigger" style="float:right; background:#3A6779; color: white;">&nbsp;?&nbsp;</b><div class="tooltip">'.__("Depending the order of tiles, skip X posts/pages.<br>Sample: order by: date, direction: descending = skip X newest posts/pages. ", "wp-tiles-wud").'</div></div>';
		echo '<b class="wud-admin-title">'.__("Skip x posts", "wp-tiles-wud").'</b><br>
		<label for="wud_box6">'.__("Quantity post to skip", "wp-tiles-wud").'</label>&nbsp;&nbsp;<br>
		<dl><dd><input size="2" id="wud_box6" type="text" style="font-weight:bolder;" value="'.$wud_skip_post.'" readonly/></dd>
		<dt><label for="wud_sizer6"></label></dt>
		<dd><input class="wud-right" id="wud_sizer6" type="range" min="0" max="20" step="1" value="'.$wud_skip_post.'" name="wud_skip_post" onchange="wud_box6.value = wud_sizer6.value" oninput="wud_box6.value = wud_sizer6.value" /></dd></dl><hr>';


		echo'<div id="wud-tip"><b class="trigger" style="float:right; background:#3A6779; color: white;">&nbsp;?&nbsp;</b><div class="tooltip">'.__("Fade in the picture of the tile by a mouse on hover action.", "wp-tiles-wud").'</div></div>';
		echo '<b class="wud-admin-title">'.__("Fade in tiles", "wp-tiles-wud").'</b><br>';
		echo '<i>'.__("Active", "wp-tiles-wud").': </i><input class="wud-right" name="wud_fade_in" type="checkbox" value="1" '. checked( $wud_fade_in, "1", false ) .'/><hr>';

		echo'<div id="wud-tip"><b class="trigger" style="float:right; background:#3A6779; color: white;">&nbsp;?&nbsp;</b><div class="tooltip">'.__("Activate shortcodes in widgets (Wordpress default is off).", "wp-tiles-wud").'</div></div>';
		echo '<b class="wud-admin-title">'.__("Widgets shortcode", "wp-tiles-wud").'</b><br>';
		echo '<i>'.__("Active", "wp-tiles-wud").': </i><input class="wud-right" name="wud_widgets" type="checkbox" value="1" '. checked( $wud_widgets, "1", false ) .'/><br>';
		
		echo '</div><div class="clear"></div>';
		echo '<div><br>';	
		echo '<input type="submit" name="Submit" class="button-primary" id="wud-adm-subm" value="'.__("Save Changes", "wp-tiles-wud").'" />';
		//Form send
		echo "</form>";
		echo '<a href="http://wistudat.be" class="button-primary" id="wud-adm-wud" target="_blank">'.__("Visit our website", "wp-tiles-wud").'</a>  <a href="https://wordpress.org/support/plugin/wp-tiles-wud" class="button-primary" id="wud-adm-wud" target="_blank">'.__("Get FREE Support", "wp-tiles-wud").'</a>';
		echo '</div></div>';		
}
?>