<?php
// loop.attachment can generate three different arrays that contain
// the <img /> code for each image attached to a given post
//	$img_mini with the <img /> codes for thumb version of images
//	$img_medium with the <img /> codes for medium size version of images
//	$img_mini with the <img /> code for large size version of images
// loop.attachment.php needs some vars to work:
//	parent post ID which the images are attached
//	$img_post_parent = get_the_ID();
//	ammount of images per post to retrieve (-1 for all)
//	$img_amount = -1;
//	if mini_size is set, the thumb will be retrieve
//	$mini_size = array(74,74);
//	if medium_size is set, the medium size will be retrieve
//	$medium_size = "medium";
//	if set, custom_width defines the maximum image width for medium version
//	$custom_width = "500";
//	if large_size is set, the large size will be retrieve
//	$large_size = "large";
// the vars must be included just before the include "loop.attachment.php" code

		// defining the array containers for all the image sizes
		$img_mini = array();
		$img_medium = array();
		$img_large = array();
		// query parameters
		$args = array(
			'post_type' => 'attachment',
			'numberposts' => $img_amount,
			'post_status' => null,
			'post_parent' => $img_post_parent,
			'orderby' => 'menu_order',
			'order' => 'ASC'
		);
		$attachments = get_posts($args);
		if ( $attachments ) {
			// if there is anyone
			foreach ( $attachments as $attachment ) {
				// loop for each image
				$img_type = $attachment->post_mime_type;
				if ( $img_type == 'image/png' || $img_type == 'image/jpeg' || $img_type == 'image/gif' ) {
					// testing if the attachment is an image
					if ( $mini_size != '' ) {
						// code to retrieve thumb version
						$img_mini_vars = wp_get_attachment_image_src($attachment->ID, $mini_size );
						array_push($img_mini, "<img src='{$img_mini_vars[0]}' width='{$img_mini_vars[1]}' height='{$img_mini_vars[2]}' />");
					} else { unset($img_mini); }

					if ( $medium_size != '' ) {
						// code to retrieve medium version
						$img_medium_vars = wp_get_attachment_image_src($attachment->ID, $medium_size );
						if ( isset($custom_width) ) {
							$img_width = $custom_width;
							$img_height = $img_medium_vars[2] * ($custom_width/$img_medium_vars[1]);
							$img_height = round($img_height);
						}
						else {
							$img_width = $img_medium_vars[1];
							$img_height = $img_medium_vars[2];
						}
						array_push($img_medium, "<img src='{$img_medium_vars[0]}' width='{$img_width}' height='{$img_height}' />");
					} else { unset($img_medium); }

					if ( $large_size != '' ) {
						// code to retrieve large version
						$img_large_vars = wp_get_attachment_image_src($attachment->ID, $large_size );
						array_push($img_large, "<img src='{$img_large_vars[0]}' width='{$img_large_vars[1]}' height='{$img_large_vars[2]}' />");
					} else { unset($img_large); }

				}
			}
		} else {
			// if there is no attachment
			unset($img_mini); unset($img_medium); unset($img_large);
		}// end if there is attachments
?>

<?php
// output generation

// this code is for attachment output
// you can include here, or anywhere inside the loop
if ( isset($video_code) ) {
	// if any video attached to the post
	$video_out = "";
	foreach ( $video_code as $video ) {
		$video_out .= "<div class='zoom-item'>" .$video. "</div>";
	}
	foreach ( $video_thumbs as $vthumb ) {
		$video_thumbs_out .= "<div class='single-thumb single-thumb-video'>" .$vthumb. "</div>";
	}
} // end if video attached

if ( isset($img_medium) && isset($img_mini) ) {
	$attach_out = "
		<section id='single-gallery'>
			<div id='visor'>
	";
	foreach ( $img_medium as $img ) {
		$attach_out .= "
			<div class='zoom-item'>
				" .$img. "
			</div>
		";
	}
	$attach_out .= $video_out. "
			</div><!-- end #visor -->
			<div id='selector'>
	";
	foreach ( $img_mini as $img ) {
		$attach_out .= "
			<div class='single-thumb'>
				" .$img. "
			</div>
		";
	}
	$attach_out .= $video_thumbs_out. "
			</div><!-- end #selector -->
		</section><!-- end #single-gallery -->
	";

} elseif ( isset($img_medium) && !isset($img_mini) ) {
	$attach_out = "<section class='single-img'>";
	foreach ( $img_medium as $img ) {
		$attach_out .= "
			<div class='zoom-item'>
				" .$img. "
			</div>
		";
	}
	$attach_out .= $video_out. "</section>";

} elseif ( !isset($img_medium) && !isset($img_mini) && isset($video_code) ) {
	// if no images, but videos
	$attach_out = "
		<section id='single-gallery'>
			<div id='visor'>
	";
	$attach_out .= $video_out. "
			</div><!-- end #visor -->
			<div id='selector'>"
				.$video_thumbs_out.
			"</div><!-- end #selector -->
		</section>
	";

} else {
	// if no image
	// here is the place if you want to define any var or any alternative text:
	// $attach_out = "This content doesn't have any image yet, but you can upload some.";
}

?>
