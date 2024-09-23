<?php get_header(); ?>
<main id="contentArea">
	<?php
	if (in_category('alert')) {
		include get_template_directory() . '/assets/alert-code.php';
	}
	?>
	<section id="announcments">
		<h1>Westridge Announcements</h1>
		<div class="slick-wrapper">
			<?php
			$args = array('post_type' => 'announcement', 'posts_per_page' => 5, 'orderby'  => array('date' => 'DESC'));
			// Variable to call WP_Query.
			$the_query = new WP_Query($args);
			if ($the_query->have_posts()) :
				while ($the_query->have_posts()) : $the_query->the_post(); ?>
					<article class="slide" style="background-image: url('<?php the_field('announcement_image'); ?>')">
						<div class="slide-text">
							<h2><?php the_title(); ?></h2>
							<p><?php
								the_field('announcement_text');
								$slideLink = get_field('announcement_link');
								$slideLinkLabel = get_field('announcement_link_label');
								if ($slideLink) { ?>
									<a href="<?php echo $slideLink ?>"><?php echo $slideLinkLabel ?></a>
								<?php }
								?>
							</p>
						</div>
					</article>
			<?php endwhile;
			else :
				echo '<p>No Content Found</p>';

			endif;
			wp_reset_query();
			?>
		</div>
	</section>
	<section id="mainContent" class="postgrid newsBlog">
		<h1>Westridge News</h1>
		<?php
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		// includes post type "principals_message" posts into the regular feed
		// $the_query = new WP_Query( array( 'posts_per_page' => 9 ,'post_status' => 'publish', 'post_type'  => array('post', 'principals_message'), 'paged'  => $paged) );
		// does not includes post type "principals_message" posts into the regular feed
		$the_query = new WP_Query(array('posts_per_page' => 9, 'post_status' => 'publish', 'post_type'  => 'post', 'paged'  => $paged));
		if ($the_query->have_posts()) :
			while ($the_query->have_posts()) : $the_query->the_post(); ?>
				<article class="post">
					<header class="postmeta">
						<a href="<?php the_permalink(); ?>">
							<div class="featured-image">

								<?php
								if (get_field('featured_image', $post_id)) {
								?>
									<img src="<?php echo get_field('featured_image'); ?>" alt="" class="" />
								<?php
								} elseif (has_post_thumbnail()) {
									the_post_thumbnail();
								} else { ?>
									<img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/building-image.jpg'; ?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="" width="217" height="175">
								<?php } ?>

							</div>
							<h2><?php the_title(); ?></h2>
						</a>
						<ul>
							<li><img src="//globalassets.provo.edu/image/icons/calendar-ltblue.svg" alt="" /><?php the_time(' F jS, Y') ?></li>
						</ul>
					</header>
					<?php
					echo get_excerpt();
					?>
				</article>
			<?php endwhile; ?>
			<nav class="archiveNav">
				<?php echo paginate_links(array('total' => $the_query->max_num_pages)); ?>
			</nav>
		<?php else :
			echo '<p>No Content Found</p>';
		endif;
		wp_reset_query();
		?>
	</section>
</main>
<?php
get_sidebar();
get_footer();
?>