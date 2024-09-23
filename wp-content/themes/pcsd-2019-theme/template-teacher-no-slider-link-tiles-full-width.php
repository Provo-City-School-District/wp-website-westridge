<?php
/*
	Template Name: Teacher - No Slider With Link Tiles - Full Width
*/

	get_header();
?>
		<main id="contentArea" class="classroom-links">
			<?php custom_breadcrumbs(); ?>
			<section id="mainContent" class="tile-page">
				<article class="currentContent no-slider">	
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
			<section class="tiles">
	   			
		   			<aside class="tile">
		   				<div class="featured-image">
		   						<img src="<?php the_field('square_1_photo'); ?>" alt="" />
		   				</div>
			   			<?php the_field('square_1'); ?>
			   			<div class="flexlinks">
						<?php
							$display_categories = get_field( 'link_tile_category_1' );	 
							$classlinksargs = array('post_type'  => 'classroomlinks', 'orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => -1, 'tax_query' => array(array('taxonomy' => 'calendar_category','field' => 'term_id', 'terms' => $display_categories)));
							$links_query = new WP_Query( $classlinksargs );
				   			if ( $links_query->have_posts() ) :
				   			//the loop
				   			while ( $links_query->have_posts() ) : $links_query->the_post(); ?>
				   				<article class="post">
							   		
							   		<img src="<?php the_field('link_image'); ?>" alt="<?php the_title(); ?> logo" />
							   		<ul>
								   		<li><a href="<?php the_field('link_url'); ?>"><?php the_title(); ?> Website</a></li>
							   		</ul>
							   		<p><?php the_field('additional_info'); ?></p>
							   	</article>
							<?php endwhile;
							wp_reset_postdata();
							else :
							
							endif;
						?>
						</div>
		   			</aside>
	   			
		   			<aside class="tile">
		   				<div class="featured-image">
		   						<img src="<?php the_field('square_2_photo'); ?>" alt="" />
		   				</div>
			   				<?php the_field('square_2'); ?>
			   			<div class="flexlinks">
						<?php
							$display_categories = get_field( 'link_tile_category_2' );	
							$classlinksargs = array('post_type'  => 'classroomlinks', 'orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => -1, 'tax_query' => array(array('taxonomy' => 'calendar_category','field' => 'term_id', 'terms' => $display_categories)));
							$links_query = new WP_Query( $classlinksargs );
				   			if ( $links_query->have_posts() ) :
				   			//the loop
				   			while ( $links_query->have_posts() ) : $links_query->the_post(); ?>
				   				<article class="post">
							   		
							   		<img src="<?php the_field('link_image'); ?>" alt="<?php the_title(); ?> logo" />
							   		<ul>
								   		<li><a href="<?php the_field('link_url'); ?>"><?php the_title(); ?> Website</a></li>
							   		</ul>
							   		<p><?php the_field('additional_info'); ?></p>
							   	</article>
							<?php endwhile;
							wp_reset_postdata();
							else :
							esc_html_e( 'Sorry, no posts matched your criteria.' );
							endif;
						?>
						</div>
		   			</aside>
	   			
	   			
		   			<aside class="tile">
		   				<div class="featured-image">
		   						<img src="<?php the_field('square_3_photo'); ?>" alt="" />
		   				</div>
			   				<?php the_field('square_3'); ?>
			   			<div class="flexlinks">
						<?php
							$display_categories = get_field( 'link_tile_category_3' );	 
							$classlinksargs = array('post_type'  => 'classroomlinks', 'orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => -1, 'tax_query' => array(array('taxonomy' => 'calendar_category','field' => 'term_id', 'terms' => $display_categories)));
							$links_query = new WP_Query( $classlinksargs );
				   			if ( $links_query->have_posts() ) :
				   			//the loop
				   			while ( $links_query->have_posts() ) : $links_query->the_post(); ?>
				   				<article class="post">
							   		
							   		<img src="<?php the_field('link_image'); ?>" alt="<?php the_title(); ?> logo" />
							   		<ul>
								   		<li><a href="<?php the_field('link_url'); ?>"><?php the_title(); ?> Website</a></li>
							   		</ul>
							   		<p><?php the_field('additional_info'); ?></p>
							   	</article>
							<?php endwhile;
							wp_reset_postdata();
							else :
							esc_html_e( 'Sorry, no posts matched your criteria.' );
							endif;
						?>
						</div>
		   			</aside>
	   			
	   			<?php if(get_field('square_4')) { ?>
		   			<aside class="tile">
		   				<div class="featured-image">
		   						<img src="<?php the_field('square_4_photo'); ?>" alt="" />
		   				</div>
			   				<?php the_field('square_4'); ?>
			   		<div class="flexlinks">
						<?php
							$display_categories = get_field( 'link_tile_category_4' );	 
							$classlinksargs = array('post_type'  => 'classroomlinks', 'orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => -1, 'tax_query' => array(array('taxonomy' => 'calendar_category','field' => 'term_id', 'terms' => $display_categories)));
							$links_query = new WP_Query( $classlinksargs );
				   			if ( $links_query->have_posts() ) :
				   			//the loop
				   			while ( $links_query->have_posts() ) : $links_query->the_post(); ?>
				   				<article class="post">
							   		
							   		<img src="<?php the_field('link_image'); ?>" alt="<?php the_title(); ?> logo" />
							   		<ul>
								   		<li><a href="<?php the_field('link_url'); ?>"><?php the_title(); ?> Website</a></li>
							   		</ul>
							   		<p><?php the_field('additional_info'); ?></p>
							   	</article>
							<?php endwhile;
							wp_reset_postdata();
							else :
							esc_html_e( 'Sorry, no posts matched your criteria.' );
							endif;
						?>
						</div>
		   			</aside>
	   			<?php }	?>
	   			<?php if(get_field('square_5')) { ?>
		   			<aside class="tile">
		   				<div class="featured-image">
		   						<img src="<?php the_field('square_5_photo'); ?>" alt="" />
		   				</div>
			   				<?php the_field('square_5'); ?>
			   			<div class="flexlinks">
						<?php
							$display_categories = get_field( 'link_tile_category_5' );	 
							$classlinksargs = array('post_type'  => 'classroomlinks', 'orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => -1, 'tax_query' => array(array('taxonomy' => 'calendar_category','field' => 'term_id', 'terms' => $display_categories)));
							$links_query = new WP_Query( $classlinksargs );
				   			if ( $links_query->have_posts() ) :
				   			//the loop
				   			while ( $links_query->have_posts() ) : $links_query->the_post(); ?>
				   				<article class="post">
							   		
							   		<img src="<?php the_field('link_image'); ?>" alt="<?php the_title(); ?> logo" />
							   		<ul>
								   		<li><a href="<?php the_field('link_url'); ?>"><?php the_title(); ?> Website</a></li>
							   		</ul>
							   		<p><?php the_field('additional_info'); ?></p>
							   	</article>
							<?php endwhile;
							wp_reset_postdata();
							else :
							esc_html_e( 'Sorry, no posts matched your criteria.' );
							endif;
						?>
						</div>
		   			</aside>
	   			<?php }	?>
	   			<?php if(get_field('square_6')) { ?>
		   			<aside class="tile">
		   				<div class="featured-image">
		   						<img src="<?php the_field('square_6_photo'); ?>" alt="" />
		   				</div>
			   				<?php the_field('square_6'); ?>
			   			<div class="flexlinks">
						<?php
							$display_categories = get_field( 'link_tile_category_6' );	 
							$classlinksargs = array('post_type'  => 'classroomlinks', 'orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => -1, 'tax_query' => array(array('taxonomy' => 'calendar_category','field' => 'term_id', 'terms' => $display_categories)));
							$links_query = new WP_Query( $classlinksargs );
				   			if ( $links_query->have_posts() ) :
				   			//the loop
				   			while ( $links_query->have_posts() ) : $links_query->the_post(); ?>
				   				<article class="post">
							   		
							   		<img src="<?php the_field('link_image'); ?>" alt="<?php the_title(); ?> logo" />
							   		<ul>
								   		<li><a href="<?php the_field('link_url'); ?>"><?php the_title(); ?> Website</a></li>
							   		</ul>
							   		<p><?php the_field('additional_info'); ?></p>
							   	</article>
							<?php endwhile;
							wp_reset_postdata();
							else :
							esc_html_e( 'Sorry, no posts matched your criteria.' );
							endif;
						?>
						</div>
		   			</aside>
	   			<?php }	?>
	   		</section><!-- tiles end -->	
   		</section><!-- End .tile-page -->
		</main>
		<?php
			get_footer();
		?>