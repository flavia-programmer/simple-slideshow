<div class="description-simple-slideshow-image">
	<?php
	if ( empty ( $simple_slideshow_image_src ) ) {?>
		<input type="file" id="simple-slideshow-image" name="simple-slideshow-image" />

		<?php echo '<p>Without Image.</p>';
	} else { ?>
		<p class="view-images">View Image</p>
		<a href="<?php echo $simple_slideshow_image_src; ?>" target="_blank" title="<?php echo $simple_slideshow_image_src; ?>">
			<img class="thumbnail-simple-slideshow" src="<?php echo $simple_slideshow_image_src; ?>" alt="<?php echo $simple_slideshow_image_src; ?>"/>
		</a>
		<p class="delete-images">Delete Image</p>
	<?php }
	?>
</div>