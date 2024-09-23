<?php
/*
	Template Name: News Slider With Tiles
*/

	get_header();
?>
		<main id="contentArea">
			<?php custom_breadcrumbs(); ?>
			<section id="mainContent" class="tile-page">
				<article class="currentContent">	
					<?php
						if(have_posts()) :
						while (have_posts()) : the_post();?>

						   			<h1><?php the_title(); ?></h1>
					   				<?php the_content(); ?>

					   	<?php endwhile;
							else :
								echo '<p>No Content Found</p>';
					endif;
					wp_reset_query();
				?>
				</article><!-- End .currentContent -->
				<article class="slider">
	   			<div class="departmentNews">
				  <?php
					  	$slidercat = get_field('slider_category');
					  	$slidercat2 = get_field('slider_category_copy');
					  	if(get_field('slider_category_copy')) {
						  	$slidercat = get_field('slider_category'). ',' . get_field('slider_category_copy');
					  	}
					  	
				  		$args = array( 'posts_per_page' => 3 , 'category_name' => $slidercat);
						// Variable to call WP_Query.
						$the_query = new WP_Query( $args );
						if($the_query->have_posts()) :
							while ($the_query->have_posts()) : $the_query->the_post();?>
							<a href="<?php the_permalink(); ?>">
								<div class="slide" style="background-image: url('<?php the_post_thumbnail_url(); ?>')">
								  	<span>
								  		<h2><?php the_title(); ?></h2>
								  		<p><?php echo get_excerpt(); ?></p>
								  	</span>
							  	</div>
							</a>

							<?php endwhile;
						else :
							echo '<p>No Content Found</p>';

						endif;
					wp_reset_query();
					?>
				</div><!-- End .departmentNews -->
   			</article><!-- End .slider -->
			<section class="tiles">
	   			<?php if(get_field('square_1')) { ?>
		   			<aside class="tile">
		   				<div class="featured-image">
		   						<img src="<?php the_field('square_1_photo'); ?>" alt="" />
		   				</div>
			   				<?php the_field('square_1'); ?>
		   			</aside>
	   			<?php }	?>
	   			<?php if(get_field('square_2')) { ?>
		   			<aside class="tile">
		   				<div class="featured-image">
		   						<img src="<?php the_field('square_2_photo'); ?>" alt="" />
		   				</div>
			   				<?php the_field('square_2'); ?>
		   			</aside>
	   			<?php }	?>
	   			<?php if(get_field('square_3')) { ?>
		   			<aside class="tile">
		   				<div class="featured-image">
		   						<img src="<?php the_field('square_3_photo'); ?>" alt="" />
		   				</div>
			   				<?php the_field('square_3'); ?>
		   			</aside>
	   			<?php }	?>
	   			<?php if(get_field('square_4')) { ?>
		   			<aside class="tile">
		   				<div class="featured-image">
		   						<img src="<?php the_field('square_4_photo'); ?>" alt="" />
		   				</div>
			   				<?php the_field('square_4'); ?>
		   			</aside>
	   			<?php }	?>
	   			<?php if(get_field('square_5')) { ?>
		   			<aside class="tile">
		   				<div class="featured-image">
		   						<img src="<?php the_field('square_5_photo'); ?>" alt="" />
		   				</div>
			   				<?php the_field('square_5'); ?>
		   			</aside>
	   			<?php }	?>
	   			<?php if(get_field('square_6')) { ?>
		   			<aside class="tile">
		   				<div class="featured-image">
		   						<img src="<?php the_field('square_6_photo'); ?>" alt="" />
		   				</div>
			   				<?php the_field('square_6'); ?>
		   			</aside>
	   			<?php }	?>
	   		</section><!-- tiles end -->	
   		</section><!-- End .tile-page -->
		</main>
		<?php
	   		global $post;
	   		if(in_array( 117, get_post_ancestors($post))) {
		   		get_sidebar( 'about' );
	   		} //elseif(in_array( 117, get_post_ancestors($post))) {
		   		//get_sidebar( 'counseling' );
	   		//} elseif(in_array( 43352, get_post_ancestors($post))) {
		   		//get_sidebar( 'extracurricular' );
	   		//} 
	   		elseif(in_array( 122, get_post_ancestors($post))) {
		   		get_sidebar( 'policies-forms' );
	   		} elseif(in_array( 70, get_post_ancestors($post))) {
		   		get_sidebar( 'faculty-staff' );
	   		} else {
		   		get_sidebar( $sidebar );
	   		}

			get_footer();
		?>