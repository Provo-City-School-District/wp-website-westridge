<?php get_header(); ?>
<main id="contentArea">
	<?php custom_breadcrumbs(); ?>
	<section id="mainContent" class="single-post">
		<?php
		if (have_posts()) :
			while (have_posts()) : the_post(); ?>
				<img src="<?php the_field('announcement_image'); ?>" alt="decorative image" />
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
		<?php endwhile;
		else :
			echo '<p>No Content Found</p>';

		endif;
		wp_reset_query();

		echo do_shortcode('[social_warfare]');
		?>
		<div class="bottom"></div>

	</section>
</main>
<?php
$sidebar = get_field('sidebar');
get_sidebar($sidebar);
get_footer();
?>