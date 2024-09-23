<?php get_header(); ?>
<main id="contentArea">
	<?php custom_breadcrumbs(); ?>
	<section id="mainContent">
		<article class="fwContent">
			<?php
			// $galleryArray = get_post_gallery_ids($post->ID);
			if (have_posts()) :
				while (have_posts()) : the_post(); ?>
					<header class="postmeta">
						<h1><?php the_title(); ?></h1>
						<ul>
							<li><img src="//globalassets.provo.edu/image/icons/calendar-ltblue.svg" alt="" /><?php the_time(' F jS, Y') ?> /</li>
							<li><img src="//globalassets.provo.edu/image/icons/person-ltblue.svg" alt="" /><?php the_author_posts_link() ?> /</li>
							<li><img src="//globalassets.provo.edu/image/icons/hamburger-ltblue.svg" alt="" /><?php the_category(', ') ?></li>
						</ul>
					</header>
					<?php
					/*
											   if(get_post_gallery_ids($post->ID)) { ?>
												   <div class="featured-gallery">
													   <div class="featured-for">
													   <?php foreach ($galleryArray as $id) { ?>
														   <img src="<?php echo wp_get_attachment_url( $id ); ?>" alt="" />
													   <?php } ?>
													   </div>
													   <div class="featured-nav">
													   <?php foreach ($galleryArray as $id) { ?>
														   <img src="<?php echo wp_get_attachment_url( $id ); ?>" alt="" />
													   <?php } ?>
													   </div>
												   </div>
											   <?php } elseif (has_post_thumbnail()) { ?>
												<div class="featured-image-full" style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>);"></div>
													   <?php } else { ?>
														   <img class="featured-image" src="<?php echo get_stylesheet_directory_uri().'/assets/images/building-image.jpg'; ?>" alt="" />
												   <?php } 
											*/
					?>

					<?php
					the_content();
					?>

			<?php endwhile;
			else :
				echo '<p>No Content Found</p>';
			endif;
			?>
			<?php

			echo do_shortcode('[social_warfare]');
			?>
		</article>
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
		$my_query = new WP_Query(array('showposts' => $posts_to_show, 'category_name'  => 'News', 'post__not_in' => array($currentID)));
		while ($my_query->have_posts()) : $my_query->the_post(); ?>
			<article class="post">
				<header class="postmeta">
					<div class="featured-image">
						<a href="<?php the_permalink(); ?>">
							<?php
							if (get_field('featured_image', $post_id)) {
							?>
								<img src="<?php echo get_field('featured_image'); ?>" alt="" class="" /></a>
					<?php
							} elseif (has_post_thumbnail()) {
								the_post_thumbnail();
							} else { ?>
						<img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/building-image.jpg'; ?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="" width="217" height="175">
					<?php } ?>
					</a>
					</div>
					<h2><?php if ($post->post_type == "principals_message") {
							echo "Principal's Message - " . get_the_title();
						} else {
							the_title();
						} ?></h2>
					</a>
					<ul>
						<li><img src="//globalassets.provo.edu/image/icons/calendar-ltblue.svg" alt="" /><?php the_time(' F jS, Y') ?></li>
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