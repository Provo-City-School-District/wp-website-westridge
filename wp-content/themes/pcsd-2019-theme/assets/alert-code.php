<section id="alerts">
	<?php
		$my_query = new WP_Query( array('showposts' => $posts_to_show, 'category_name'  => 'alert'));
	   			while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
	   				<article class="post">
				   		<header class="postmeta">
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<ul>
									<li><img src="//globalassets.provo.edu/image/icons/calendar-ltblue.svg" alt="" /><?php the_time(' F jS, Y') ?></li>
								</ul>
						</header>
				   		<?php //echo the_content(); ?>
				   	</article>
				<?php endwhile;
		wp_reset_query();
	?>
	<button id="closeAlert"><img src="<?php echo get_template_directory_uri(); ?>/assets/icons/round-delete-button-white.svg" alt="Close Alerts" /></button>
</section>