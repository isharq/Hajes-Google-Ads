<?php
/*
Plugin Name: Hajes Google Ads
Plugin URI: http://kamps.org
Description: Replaces the MORE tag in a Wordpress post with a Google advert at that point.
Author: Haje Jan Kamps
Version: 0.1.1
Author URI: http://www.kamps.org
*/

/*
	This code wraps a DIV tag around the advertising code, so you can style the container 
	('moreadsense') in your Wordpress Style Sheet. Personally, I only do the following:
	
	div.moreadsense {
		text-align: center;
	}
	
	But feel free to knock yourself out. You don't have to add anything. 
*/


// If you don't want one or the other of these, add two slashes at the beginning of the line
// to turn it off. Simples. 

add_filter('the_content', 'add_google_ad_at_more');
add_filter('the_content', 'add_google_ad_at_end');


// Edit the Google advert below. 
$advert_html = '


	<!-- Hajes Adsense Inserter Code -->
	<div class="moreadsense">
	<script type="text/javascript"><!--
	google_ad_client = "ca-pub-0188057227511508";
	/* PC 2013 Banner */
	google_ad_slot = "3135601498";
	google_ad_width = 468;
	google_ad_height = 60;
	//-->
	</script>
	<script type="text/javascript"
	src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
	</script>
	</div>
	
	
	';

 
// This function replace your more tag with your adsense codes.
function add_google_ad_at_more($postcontent) {
	if( is_single() )
		{
		global $advert_html;
		$pos1 = strpos($postcontent, '<span id="more-');
		$pos2 = strpos($postcontent, '</span>', $pos1) + 7; // +7 to get rid of the SPAN as well. 
		$postcontentstart = substr($postcontent, 0, $pos2);
		$postcontentend = substr($postcontent, $pos2);
		$text = $postcontentstart .  $advert_html . $postcontentend;
		}
return $text;
}

// This function replace your more tag with your adsense codes.
function add_google_ad_at_end($postcontent) {
	if( is_single() )	
		{
		global $advert_html;
		$text = $postcontent .  $advert_html;
		}
return $text;
}

?>