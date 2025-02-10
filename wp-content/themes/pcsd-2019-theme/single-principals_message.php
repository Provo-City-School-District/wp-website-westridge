<?php get_header(); ?>
<main id="contentArea">
	<?php custom_breadcrumbs(); ?>
	<section id="mainContent" class="single-post">
		<?php
		//$galleryArray = get_post_gallery_ids($post->ID);
		if (have_posts()) :
			while (have_posts()) : the_post(); ?>
				<header class="postmeta">
					<h1><?php the_title(); ?></h1>
					<ul>
						<li><img src="//globalassets.provo.edu/image/icons/calendar-ltblue.svg" alt="calendar icon" /><?php the_time(' F jS, Y') ?></li>
						<!-- <li><img src="//globalassets.provo.edu/image/icons/person-ltblue.svg" alt="" /><?php the_author_posts_link() ?> /</li>
											<li><img src="//globalassets.provo.edu/image/icons/hamburger-ltblue.svg" alt="" />Principal's Message</li> -->
					</ul>
				</header>
				<?php
				if (has_post_thumbnail()) {
				?>
					<img class="featured-image" src="<?php echo the_post_thumbnail_url(); ?>" alt="Admin photo" />
				<?php
				} else {
				?>
					<img class="featured-image" src="<?php echo get_stylesheet_directory_uri() . '/assets/images/building-image.jpg'; ?>" alt="Building photo" />
				<?php
				}
				?>
				<?php the_content(); ?>

		<?php endwhile;
		else :
			echo '<p>No Content Found</p>';
		endif;
		wp_reset_query();
		echo do_shortcode('[social_warfare]');
		?>
		<div class="bottom"></div>

	</section>
	<section class="postgrid">
		<?php
		$currentID = get_the_ID();
		//Removes news category from get_the_category
		$categoryID = get_the_category($post->ID);
		foreach ($categoryID as $category) {
			if ($category->term_id == 192) {
				continue;
			}
			$postcategories = '"' . $category->name . '"' . ',';
		}
		$posts_to_show = get_option('single_post_count_data');
		if ($posts_to_show <= 3) {
			$posts_to_show = 3;
		}
		//use $postcategories for category_name if you want to display category related posts only. Use actual category name if you want to only use that category
		$my_query = new WP_Query(array('showposts' => $posts_to_show, 'post_type'  => 'principals_message', 'post__not_in' => array($currentID)));
		while ($my_query->have_posts()) : $my_query->the_post(); ?>
			<article class="post">
				<?php
				if (has_post_thumbnail()) { ?>
					<a href="<?php the_permalink(); ?>">
						<div class="featured-image" style="background-image: url(<?php the_post_thumbnail_url('medium'); ?>)"></div>
					<?php } else { ?>
						<a href="<?php the_permalink(); ?>">
							<div class="featured-image" style="background-image: url(<?php echo get_stylesheet_directory_uri() . '/assets/images/building-image.jpg'; ?>)"></div>
						<?php } ?>
						<header class="postmeta">
							<!--
										switched this line to the line below to eliminate the forced entry of "Principal's Message - "
									<h2><?php if ($post->post_type == "principals_message") {
											echo "Principal's Message - " . get_the_title();
										} else {
											the_title();
										} ?></h2>
									-->
							<h2><?php the_title(); ?></h2>
							<ul>
								<li><img src="//globalassets.provo.edu/image/icons/calendar-ltblue.svg" alt="decorative image" /><?php the_time(' F jS, Y') ?></li>
							</ul>
						</header>
						<?php echo get_excerpt(); ?>
			</article>
		<?php endwhile; ?>
	</section>
</main>
<?php
$sidebar = get_field('sidebar');
get_sidebar($sidebar);
get_footer();
?>