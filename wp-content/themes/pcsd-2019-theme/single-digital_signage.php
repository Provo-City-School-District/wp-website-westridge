<?php
	if(get_field('google_media')) {
		?>
			<iframe src="<?php the_field('google_media'); ?>" frameborder="0" width="1440" height="839" allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true"></iframe>		
		<?php	
	} elseif (get_field('video')){
		?>
		<video src="<?php the_field('video'); ?>" autoplay loop></video>
		<?php		
	} else {
		?>
		<img src="<?php the_field('image'); ?>" alt="" />
		<?php
	}
?>
