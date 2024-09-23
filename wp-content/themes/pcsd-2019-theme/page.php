<?php get_header(); ?>
<main id="contentArea">
	<?php custom_breadcrumbs(); ?>
	<section id="mainContent">
		<article class="fwContent">
			<?php
			do_shortcode('[modified-date]');
			if (have_posts()) :
				while (have_posts()) : the_post(); ?>

					<h1><?php the_title(); ?></h1>
					<?php the_content(); ?>

			<?php endwhile;
			else :
				echo '<p>No Content Found</p>';
			endif;
			?>
		</article>
		<div class="clear"></div>
	</section>
</main>
<?php
do_shortcode('[sidebar-control]');

get_footer();
?>