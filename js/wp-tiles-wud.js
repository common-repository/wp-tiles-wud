/**
 * === WP Tiles WUD ===
 * Contributors: wistudatbe
 * Plugin Name: WP Tiles WUD
 * Description: Use simply the category or tag SLUG and add responsive, customizable and dynamic tiles to any WordPress posts and pages.
 * Author: Danny WUD
 * Go back to the button position, down the tiles.
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
	
	/* SUBMIT wp-tiles-wud-page */
	$(document).on('submit', '#wud_form', function()
	{			
		var pmore = document.getElementById("wud_more_tiles").value;
		var ptags = document.getElementById("wud_tags").value;
		var pcats = document.getElementById("wud_cats").value;
		var ids = document.getElementById("wud_ids").value;
		var tnr = document.getElementById("wud_tiles_nr").value;
		var ptotal = $("#wud_max_tiles").val();
		count++;
		if(count==1)
		{
			ptotal = parseInt(pmore);
			document.getElementById("wud_max_tiles").value = ptotal;		 
		}
		else{
			ptotal = parseInt(ptotal) + parseInt(pmore);
			document.getElementById("wud_max_tiles").value = ptotal;	
		}	
		var dataString = 'wud_max_tiles='+ ptotal +'& wud_tags='+ ptags +'& wud_cats='+ pcats +'& wud_ids='+ ids+'& wud_tiles_nr='+ tnr;
		
		/* Load in div wud_result data with structure from wp-tiles-wud-xtra*/
		$.ajax({
		type : 'POST',
		url  : WudIncDir,
		data : dataString,
		cache: false,
		success :  function(data){$("#wud_result").html(data);}
		});	
		return false;
	});
	/* GO TO once wp-tiles-wud-page */
	if (document.getElementById("wud_button")) {
		var pos = localStorage.getItem("pos");
		$('html, body').animate({scrollTop : pos},0);
		localStorage.removeItem(pos);
    }	
});
})(jQuery);
//]]> 
