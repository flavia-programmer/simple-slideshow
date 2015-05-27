<input type="file" id="simple-slideshow-image" name="simple-slideshow-image" />
<p class="description">
	<?php
	if ( empty ( $simple_slideshow_image_src ) ) {
		echo 'Without Image.';
	} else { ?>
		<a href="<?php echo $simple_slideshow_image_src; ?>" target="_blank">View Image</a>
	<?php }
	?>
</p>