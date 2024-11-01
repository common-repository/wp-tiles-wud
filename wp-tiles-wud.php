<?php
/*
=== WP Tiles WUD ===
Contributors: wistudat.be
Plugin Name: WP Tiles WUD
Donate Reason: Stand together to help those in need!
Donate link: https://www.icrc.org/eng/donations/
Description: WP Tiles WUD adds responsive, customizable and dynamic tiles to WordPress posts and pages.
Author: Danny WUD
Author URI: http://wistudat.be
Plugin URI: http://wistudat.be
Tags: grid, tiles, widget, widgets, tile, youtube, vimeo, video, gallery, responsive, slug, shortcode, slugs, grids, filter, display, list, page, pages, posts, post, query, custom post type
Requires at least: 3.6
Tested up to: 4.6
Stable tag: 1.6.2		
Version: 1.6.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: wp-tiles-wud
Domain Path: /languages
*/
	defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
//==============================================================================//
$version='1.6.2';
// Store the latest version.
if (get_option('wud_version')!=$version) {update_option('wud_version', $version);}
//==============================================================================//
	
	define( 'WUD_TILES_DIR', plugin_dir_path( __FILE__ ) );
	define( 'WUD_TILES_URL', plugin_dir_url( __FILE__ ) );
	
// wp-tiles-wud Actions
	//Site
	add_shortcode( 'wud', 'wp_tiles_wud_comm' );
	add_action( 'wp_enqueue_scripts', 'wp_tiles_wud_styles' );
	add_action('plugins_loaded', 'wud_languages');
	add_action( 'plugins_loaded', 'wp_tiles_wud_admin' );
	add_action( 'plugins_loaded', 'wp_tiles_wud_base' );
	add_action( 'init', 'wud_funcs' );
	add_action( 'init', 'wp_tiles_wud_new_var' );
	add_action( 'template_redirect', 'wud_go_to_my_url');
	register_activation_hook( __FILE__, 'wp_tiles_wud_activate' );
	//Admin
	add_action('admin_enqueue_scripts', 'wud_style_more');
	add_action('admin_menu', 'wp_tiles_wud_options_notice_submenu_page');
	add_filter( 'plugin_action_links', 'wud_action_links', 10, 5 );

	
// wp-tiles-wud style
	function wp_tiles_wud_styles() {	
	//Add short code to widgets
	if($GLOBALS['wfuncs']['wud_widgets']=='1'){
	add_filter( 'widget_text', 'shortcode_unautop');
	add_filter( 'widget_text', 'do_shortcode');
	}	
// Register default Style	
	 wp_register_style( 'wp_tiles_wud_style', plugins_url('css/'.$GLOBALS['wfuncs']['wud_my_css'].'.css', __FILE__ ), false, '1.0.2' );
	 wp_enqueue_style( 'wp_tiles_wud_style' );	
	 wp_register_style( 'wp_tiles_wud_style_hover', plugins_url('css/wp-tiles-wud-base-hover.css', __FILE__ ), false, '1.0.2' );
	 if($GLOBALS['wfuncs']['wud_img_hover']=='1'){wp_enqueue_style( 'wp_tiles_wud_style_hover' );}
	 wp_register_style( 'wp_tiles_wud_style_grey', plugins_url('css/wp-tiles-wud-base-grey.css', __FILE__ ), false, '1.0.2' );
	 if($GLOBALS['wfuncs']['wud_img_grey']=='1'){wp_enqueue_style( 'wp_tiles_wud_style_grey' );}
	 wp_register_style( 'wp_tiles_wud_style_title', plugins_url('css/wp-tiles-wud-base-title.css', __FILE__ ), false, '1.0.2' );
	 if($GLOBALS['wfuncs']['wud_title_big']=='1'){wp_enqueue_style( 'wp_tiles_wud_style_title' );}	 
// Javascript + extra page (read more page).
	  wp_enqueue_script('jquery');
	  wp_register_script('w_tiles_wud_script', plugins_url( 'js/wp-tiles-wud.js', __FILE__ ), array('jquery'), '1.0.0', true );
	  wp_enqueue_script('w_tiles_wud_script');
	// Fade out/in option	  
	if (get_option('wud_fade_in')=='1'){
	  wp_register_script('w_tiles_wud_fade', plugins_url( 'js/wp-tiles-wud-fade.js', __FILE__ ), array('jquery'), '1.0.0', true );
	  wp_enqueue_script('w_tiles_wud_fade');
	} 	 
	//Extra tiles button result
	  wp_localize_script('w_tiles_wud_script', 'wud_php', array('wud_url' => plugins_url( 'pages/wp-tiles-wud-xtra.php', __FILE__ ),));
	}
// wp-tiles-wud languages
	function wud_languages() {
			load_plugin_textdomain( 'wp-tiles-wud', false, dirname(plugin_basename( __FILE__ ) ) . '/languages' );
	}

// wp-tiles-wud options page (settings menu option)
	function wp_tiles_wud_options_notice_submenu_page() {
		add_options_page( 'WP Tiles WUD', 'WP Tiles WUD', 'manage_options', 'wp-tiles-wud', 'wp_tiles_wud_options_notice' );
	}

// wp-tiles-wud options page (menu options by plugins)
	function wud_action_links( $actions, $wud_set ) 
	{
		static $plugin;
		if (!isset($plugin))
			$plugin = plugin_basename(__FILE__);
		if ($plugin == $wud_set) {
				$settings_page = array('settings' => '<a href="options-general.php?page=wp-tiles-wud">' . __('Settings', 'General') . '</a>');
				$support_link = array('support' => '<a href="https://wordpress.org/support/plugin/wp-tiles-wud" target="_blank">Support</a>');				
					$actions = array_merge($support_link, $actions);
					$actions = array_merge($settings_page, $actions);
			}			
			return $actions;
	}

	function wud_style_more($hook) {
	if   ( $hook == "settings_page_wp-tiles-wud" ) {
		wp_enqueue_style( 'wp-color-picker' ); 
		wp_enqueue_style( 'cs-wp-color-picker', plugins_url( 'css/cs-wp-color-picker.css', __FILE__ ), array( 'wp-color-picker' ), '1.0.0', 'all' );
		wp_enqueue_style( 'wp_tiles_wud_style' );
		wp_enqueue_style( 'wp_tiles_wud_style', plugins_url('css/admin.css', __FILE__ ), false, '1.0.2' );
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script( 'cs-wp-color-picker', plugins_url( 'js/cs-wp-color-picker.js', __FILE__ ), array( 'wp-color-picker' ), '1.0.0', true );	
		wp_enqueue_media();
		wp_register_script( 'media-lib-uploader-js', plugins_url( 'js/admin_script.js' , __FILE__ ), array('jquery') );
		wp_enqueue_script( 'media-lib-uploader-js' );
     }
	}

	  	
//Load extra tile page  
	function wp_tiles_wud_admin() {require_once( WUD_TILES_DIR . '/pages/wp-tiles-wud-admin.php' );}
	
//Load base tile page
	function wp_tiles_wud_base() {require_once( WUD_TILES_DIR . '/pages/wp-tiles-wud-base.php' );}

	
//From 1.5.8 on we register here new variables
	function wp_tiles_wud_new_var() {		
		if (get_option('wud_formatted_text')=='') {update_option('wud_formatted_text', 0);}
		if (get_option('wud_widgets')=='') {update_option('wud_widgets', 0);}
	}

	
//Declare once all WP Tiles WUD settings 	
	function wud_funcs(){
		//Set it global
		global $wfuncs;
		//Remember the settings (output=$GLOBALS['wfuncs']['wud_my_css'];)
		$wfuncs = array(
			'wud_my_css' => get_option('wud_my_css'),
			'wud_cat_bcolor' => get_option('wud_cat_bc_color'),
			'wud_cat_fcolor' => get_option('wud_cat_fc_color'),
			'wud_h1_font_size' => get_option('wud_h1_font_size'),
			'wud_show_cat_border' => get_option('wud_img_border'),
			'wud_set_featured_img' => get_option('wud_featured_img'),
			'wud_set_max_tiles' => get_option('wud_max_tiles'),
			'wud_set_more_tiles' => get_option('wud_more_tiles'),
			'wud_hide_cat_tag_header' => get_option('wud_cat_tag_header'),
			'wud_hide_tile_header' => get_option('wud_hide_tile_header'),
			'wud_hide_tile_cat' => get_option('wud_hide_tile_cat'),
			'wud_show_excerpt' => get_option('wud_show_excerpt'),
			'wud_show_arch_button' => get_option('wud_show_arch_button'),
			'wud_show_tile_button' => get_option('wud_show_tile_button'),
			'wud_show_arch_tile' => get_option('wud_show_arch_tile'),
			'wud_set_order_tiles' => get_option('wud_order_tiles'),
			'wud_set_dir_tiles' => get_option('wud_dir_tiles'),
			'wud_but_bcolor' => get_option('wud_but_bc_color'),
			'wud_but_fcolor' => get_option('wud_but_fc_color'),
			'wud_but_font_size' => get_option('wud_but_font_size'),
			'wud_h2_pos' => get_option('wud_h2_pos'),
			'wud_h2_font_size' => get_option('wud_h2_font_size'),
			'wud_excerpt_words' => get_option('wud_excerpt_words'),
			'wud_no_archives' => get_option('wud_no_archives'),
			'wud_fade_in' => get_option('wud_fade_in'),
			'wud_skip_post' => get_option('wud_skip_post'),
			'wud_version' => get_option('wud_version'),
			'wud_cpt01' => get_option('wud_cpt01'),
			'wud_cpt02' => get_option('wud_cpt02'),
			'wud_def_img' => get_option('wud_def_img'),
			'wud_img_hover' => get_option('wud_img_hover'),
			'wud_img_grey' => get_option('wud_img_grey'),
			'wud_title_big' => get_option('wud_title_big'),
			'wud_formatted_text' => get_option('wud_formatted_text'),
			'wud_widgets' => get_option('wud_widgets')
			);
			return $wfuncs;
		}

//Word trim if excerpt paramater wud_formatted_text = 1		
	function word_trim($string){
			$string =  preg_replace('/\[.*\]/', '', strip_tags($string, '<p><a><ol><ul><li><br><b><em><i><label><span><hr>'));
			$words = explode(' ', $string); 
				  if (count($words) >  $GLOBALS['wfuncs']['wud_excerpt_words'] ){
					array_splice($words,  $GLOBALS['wfuncs']['wud_excerpt_words'] );
					$string = implode(' ', $words);
				  }
	  return $string;
	}
	
//Include /wp-tiles-wud-content.php instead using the Wordpress default: /tag/ or /category/
	function wud_go_to_my_url(){
		global $catid, $tagid;
		//Redirect only if parameter 'wud_no_archives' is set to 1
		if(($GLOBALS['wfuncs']['wud_no_archives']==1 ) || ($GLOBALS['wfuncs']['wud_show_arch_tile']==1 && isset( $_GET['q'] ) && !empty( $_GET['q'] ))){

				if( is_category() && (is_archive() || !is_front_page() || !is_home() || !is_single() || !is_singular() )){
					$catid = get_query_var('cat');
					$tagid = '';
					include (WUD_TILES_DIR . 'pages/wp-tiles-wud-content.php');
					exit();				
				}

				if( is_tag()  && (is_archive() || !is_front_page() || !is_home() || !is_single() || !is_singular() )){
					$tags = single_tag_title("", false);
					$tagid = get_term_by('slug', $tags, 'post_tag');
					$tagid = $tagid->term_id;
					$catid = '';
					include (WUD_TILES_DIR . 'pages/wp-tiles-wud-content.php');
					exit();
				}	 
		}
	}		
	
//Standard values only inserted on activation.
	function wp_tiles_wud_activate() {		
		if (get_option('wud_my_css')=='') {update_option('wud_my_css', 'wp-tiles-wud');}
		if (get_option('wud_cat_bc_color')=='') {update_option('wud_cat_bc_color', '#585858');}
		if (get_option('wud_cat_fc_color')=='') {update_option('wud_cat_fc_color', '#FFFFFF');}
		if (get_option('wud_h1_font_size')=='') {update_option('wud_h1_font_size', '2.1');}
		if (get_option('wud_img_border')=='') {update_option('wud_img_border', 0);}
		if (get_option('wud_featured_img')=='') {update_option('wud_featured_img', 1);}
		if (get_option('wud_max_tiles')=='') {update_option('wud_max_tiles', 5);}
		if (get_option('wud_more_tiles')=='') {update_option('wud_more_tiles', 2);}
		if (get_option('wud_cat_tag_header')=='') {update_option('wud_cat_tag_header', 0);}
		if (get_option('wud_hide_tile_header')=='') {update_option('wud_hide_tile_header', 0);}
		if (get_option('wud_hide_tile_cat')=='') {update_option('wud_hide_tile_cat', 0);}
		if (get_option('wud_show_excerpt')=='') {update_option('wud_show_excerpt', 1);}
		if (get_option('wud_show_arch_button')=='') {update_option('wud_show_arch_button', '');}
		if (get_option('wud_show_tile_button')=='') {update_option('wud_show_tile_button', '');}
		if (get_option('wud_show_arch_tile')=='') {update_option('wud_show_arch_tile', 0);}
		if (get_option('wud_order_tiles')=='') {update_option('wud_order_tiles', 'date');}
		if (get_option('wud_dir_tiles')=='') {update_option('wud_dir_tiles', 'DESC');}
		if (get_option('wud_but_bc_color')=='') {update_option('wud_but_bc_color', '#585858');}
		if (get_option('wud_but_fc_color')=='') {update_option('wud_but_fc_color', '#FFFFFF');}
		if (get_option('wud_but_font_size')=='') {update_option('wud_but_font_size', '1.6');}
		if (get_option('wud_h2_pos')=='') {update_option('wud_h2_pos', 0);}
		if (get_option('wud_h2_font_size')=='') {update_option('wud_h2_font_size', '1.1');}
		if (get_option('wud_excerpt_words')=='') {update_option('wud_excerpt_words', 25);}
		if (get_option('wud_no_archives')=='') {update_option('wud_no_archives', 0);}
		if (get_option('wud_skip_post')=='') {update_option('wud_skip_post', 0);}
		if (get_option('wud_fade_in')=='') {update_option('wud_fade_in', 1);}
		if (get_option('wud_cpt01')=='') {update_option('wud_cpt01', 'Custom Post Type 01');}
		if (get_option('wud_cpt02')=='') {update_option('wud_cpt02', 'Custom Post Type 02');}
		if (get_option('wud_def_img')=='') {update_option('wud_def_img', plugins_url('images/empty-wud.png', __FILE__ ));}
		if (get_option('wud_img_hover')=='') {update_option('wud_img_hover', 1);}
		if (get_option('wud_img_grey')=='') {update_option('wud_img_grey', 0);}
		if (get_option('wud_title_big')=='') {update_option('wud_title_big', 0);}
		if (get_option('wud_formatted_text')=='') {update_option('wud_formatted_text', 0);}
		if (get_option('wud_widgets')=='') {update_option('wud_widgets', 0);}
	}
	
?>