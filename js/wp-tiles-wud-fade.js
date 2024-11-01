/**
 * === WP Tiles WUD ===
 * Contributors: wistudatbe
 * Plugin Name: WP Tiles WUD
 * Description: Use simply the category or tag SLUG and add responsive, customizable and dynamic tiles to any WordPress posts and pages.
 * Author: Danny WUD
 * Fade out/in the tiles.
 * Release 1.0.2 -> added function($) and (jQuery) to works with the Wordpress jQuery version.
 */
//<![CDATA[
(function($) { 
$(document).ready(function(e)
{
	var WudIncDir = wud_php.wud_url;
	var count = 0 ;
	
	/* CLICK wp-tiles-wud-base */
	$("#wud_base").click(function(e){	 
		var pos = $(window).scrollTop();
		/* Remember pos untill loading wud_button */
		localStorage.setItem("pos", pos);
	});	

	/* GO TO once wp-tiles-wud-page */
	if (document.getElementById("wud_button")) {
		$("#wud_fade").hide();
		$('#wud_fade').fadeIn(1400);
		var pos = localStorage.getItem("pos");
		$('html, body').animate({scrollTop : pos},0);
		localStorage.removeItem(pos);
    }

	/* GO TO once wp-tiles-wud-page */
	if (document.getElementById("wud_fade_home")) {	
		$("#wud_fade_home").hide();
		$('#wud_fade_home').fadeIn(1400);
    }
	
});
})(jQuery);
//]]> 
