<?php get_header(); ?>
<main id="contentArea">
	<section id="mainContent" class="postgrid newsBlog frontpage">
		<h1>Timpview News</h1>
		<?php
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$the_query = new WP_Query(array('posts_per_page' => 18, 'category_name'  => 'news', 'post_type'  => 'post', 'paged'  => $paged));
		if ($the_query->have_posts()) :
			while ($the_query->have_posts()) : $the_query->the_post(); ?>
				<article class="post">
					<a href="<?php the_permalink(); ?>">
						<div class="featured-image">
							<a href="<?php the_permalink(); ?>">
								<?php
								if (get_field('featured_image', $post_id)) {
								?>
									<img src="<?php echo get_field('featured_image'); ?>" alt="decorative image" class="" /></a>
						<?php
								} elseif (has_post_thumbnail()) {
									the_post_thumbnail();
								} else { ?>
							<img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/building-image.jpg'; ?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="decorative image" width="217" height="175">
						<?php } ?>
					</a>
					</div>
					</a>
					<header class="postmeta">
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<ul>
							<li><img src="//globalassets.provo.edu/image/icons/calendar-ltblue.svg" alt="calendar icon" /><?php the_time(' F jS, Y') ?></li>
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
		?>
	</section>
</main>
<?php
$sidebar = get_field('sidebar');
get_sidebar($sidebar);
get_footer();
?>