<?php
if ( post_custom('youtube') ) {
	// if youtube video
	$video_id = get_post_meta($post->ID, "Youtube", $single = true);
	//$video_id = 'M0T3P9_t6Oo';
	$video_thumb = "http://img.youtube.com/vi/$video_id/hqdefault.jpg";

}
if( post_custom('vimeo') ) {
	// if vimeo video
	$video_id = get_post_meta($post->ID, "Vimeo", $single = true);
	//$video_id = get_post_meta($post_id, "Vimeo", $single = true);
	//$video_id = '31013938';
	$video_info = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$video_id.php"));
	$video_thumb = $video_info[0]['thumbnail_medium'];

	$video_w = $video_info[0]['width'];
	$video_h = $video_info[0]['height'];
	if ( $video_w > 500 ) {
		$video_w = 500;
		$video_h = 300;
	}

	$video_code = "<iframe src='http://player.vimeo.com/video/$video_id?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff' width='$video_w' height='$video_h' frameborder='0' webkitAllowFullScreen allowFullScreen></iframe>";
} // end if vimeo or youtube

// output
echo $video_code;
?>
