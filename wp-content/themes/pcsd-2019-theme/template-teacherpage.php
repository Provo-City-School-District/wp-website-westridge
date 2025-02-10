<?php
/* Template Name: Teacher Page */
get_header(); ?>
<main id="contentArea">
	<?php custom_breadcrumbs(); ?>
	<section id="mainContent" class="single-page">
		<?php

		do_shortcode('[modified-date]');

		if (have_posts()) :
			while (have_posts()) : the_post(); ?>

				<h1><?php the_title(); ?></h1>
				<?php
				if (has_post_thumbnail()) {
					echo get_the_post_thumbnail($post_id, 'full');
				}
				?>

				<?php the_content(); ?>

		<?php endwhile;
		else :
			echo '<p>No Content Found</p>';
		endif;
		?>
		<div class="clear"></div>
	</section>
</main>
<aside id="mainSidebar" class="teacherSidebar">

	<aside class="syllabus">
		<h2>Canvas</h2>
		<ul>
			<li class="int"><a href="https://canvas.provo.edu">Canvas Login</a></li>
			<li class="int"><a href="https://provo.edu/wp-content/uploads/2020/08/Canvas-Parent-Guide.pdf">Canvas Parent Guide</a></li>
			<li class="int"><a href="https://provo.edu/wp-content/uploads/2020/08/Canvas-Gui?a-para-los-padres.pdf">Canvas – Guía para los padres</a></li>
		</ul>
		<h2>My Web Pages</h2>
		<?php
		global $post;
		$parent_id   = $post->post_parent;
		$post_parent_slug = get_post_field('post_name', $parent_id);
		if ($post_parent_slug == 'teachers-directory') {
			echo do_shortcode('[wpb_childpages]');
		} else {
			echo do_shortcode('[wpb_parentpages]');
		}
		?>
	</aside>
</aside>
<?php
get_footer();
?>