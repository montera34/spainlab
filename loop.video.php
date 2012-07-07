<?php
// loop.video.php retrieves an array with each video embed codes.
// It works with Vimeo and Youtube videos
// to make it works just include a custom field named vimeo or youtube
// with the video ID as value.
// to set the width of the videos up, just define the var $max_w
// just above include "loop.video.php"; line
$video_code = array();

if ( post_custom('youtube') ) {
	// if youtube videos
	$video_ids = get_post_meta(get_the_ID(), "youtube");
	foreach ( $video_ids as $video_id ) {
		// thumb de alta calidad
		//$video_thumb_hq = "http://img.youtube.com/vi/" .$video_id. "/hqdefault.jpg";
		// thumb de calidad baja
		//$video_thumb = "http://img.youtube.com/vi/" .$video_id. "/default.jpg";
		$video_w = $max_w;
		$video_h = $max_w * 0.8235;
		array_push($video_code, "<iframe src='http://www.youtube.com/embed/$video_id' frameborder='0' width='$video_w' height='$video_h' allowfullscreen></iframe>");
	}
}

if( post_custom('vimeo') ) {
	// if vimeo videos
	$video_ids = get_post_meta(get_the_ID(), "vimeo");
//	print_r($video_id);
	foreach ( $video_ids as $video_id ) {
		$video_info = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$video_id.php"));
		//$video_thumb = $video_info[0]['thumbnail_medium'];

		$video_w = $video_info[0]['width'];
		$video_h = $video_info[0]['height'];
		if ( $video_w > $max_w ) {
			$video_w = $max_w;
			$video_h = 300;
		}

		array_push($video_code, "<iframe src='http://player.vimeo.com/video/$video_id?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff' width='$video_w' height='$video_h' frameborder='0' webkitAllowFullScreen allowFullScreen></iframe>");
	}

} // end if vimeo or youtube
?>
