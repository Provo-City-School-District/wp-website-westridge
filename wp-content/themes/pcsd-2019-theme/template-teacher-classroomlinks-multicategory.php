<?php get_header(); 
	
	/*
	Template Name: Teacher - Multi Cateogry Links - Full Width
*/
	
?>
		<main id="contentArea" class="classroom-links">
			<?php custom_breadcrumbs(); ?>
			<section id="mainContent" class="single-page">
				<?php do_shortcode( '[modified-date]' ) ?>
					
					<?php
					if(have_posts()) :
						while (have_posts()) : the_post();?>

						   			<h1><?php the_title(); ?></h1>
						   			<div class="page-Content">
						   			<?php 
							   			if ( has_post_thumbnail() ) {
								   			echo get_the_post_thumbnail( $post_id, 'full' );
								   			}
							   			 ?>
					   				<?php the_content(); ?>
						   			</div>
					   	<?php endwhile;
						   	wp_reset_postdata();
					endif;
					
				?>
					<h2><?php the_field('cateogory_heading'); ?></h2>
						<div class="flexlinks">
						<?php
							$display_categories = get_field( 'display_category' );	 
							$classlinksargs = array('post_type'  => 'classroomlinks', 'orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => -1, 'tax_query' => array(array('taxonomy' => 'calendar_category','field' => 'term_id', 'terms' => $display_categories)));
							$links_query = new WP_Query( $classlinksargs );
				   			if ( $links_query->have_posts() ) :
				   			//the loop
				   			while ( $links_query->have_posts() ) : $links_query->the_post(); ?>
				   				<article class="post">
							   		
							   		<?php 
								   		if(get_field('link_image')) { ?>
								   			<img src="<?php the_field('link_image'); ?>" alt="<?php the_title(); ?> logo" />
								   <?php } 
									if(get_field('use_local_pdf')) {
										?>
										<ul>
											<li><a href="<?php the_field('use_local_pdf'); ?>"><?php the_title(); ?></a></li>
						   				</ul>
										<?php
									} else { ?>
										<ul>
									   		<li><a href="<?php the_field('link_url'); ?>"><?php the_title(); ?> Website</a></li>
								   		</ul> 
								   		<?php
									}
								?>
							   		<p><?php the_field('additional_info'); ?></p>
							   	</article>
							<?php endwhile;
							wp_reset_postdata();
							else :
							
							endif;
						?>
						</div>
					<h2><?php the_field('cateogory_heading_2'); ?></h2>
						<div class="flexlinks">
						<?php
							$display_categories = get_field( 'display_category_2' );	 
							$classlinksargs = array('post_type'  => 'classroomlinks', 'orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => -1, 'tax_query' => array(array('taxonomy' => 'calendar_category','field' => 'term_id', 'terms' => $display_categories)));
							$links_query = new WP_Query( $classlinksargs );
				   			if ( $links_query->have_posts() ) :
				   			//the loop
				   			while ( $links_query->have_posts() ) : $links_query->the_post(); ?>
				   				<article class="post">
							   		
							   		<?php 
								   		if(get_field('link_image')) { ?>
								   			<img src="<?php the_field('link_image'); ?>" alt="<?php the_title(); ?> logo" />
								   <?php } 
									if(get_field('use_local_pdf')) {
										?>
										<ul>
											<li><a href="<?php the_field('use_local_pdf'); ?>"><?php the_title(); ?></a></li>
						   				</ul>
										<?php
									} else { ?>
										<ul>
									   		<li><a href="<?php the_field('link_url'); ?>"><?php the_title(); ?> Website</a></li>
								   		</ul> 
								   		<?php
									}
								?>
							   		<p><?php the_field('additional_info'); ?></p>
							   	</article>
							<?php endwhile;
							wp_reset_postdata();
							else :
							
							endif;
						?>
						</div>
					<h2><?php the_field('cateogory_heading_3'); ?></h2>
						<div class="flexlinks">
						<?php
							$display_categories = get_field( 'display_category_3' );	 
							$classlinksargs = array('post_type'  => 'classroomlinks', 'orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => -1, 'tax_query' => array(array('taxonomy' => 'calendar_category','field' => 'term_id', 'terms' => $display_categories)));
							$links_query = new WP_Query( $classlinksargs );
				   			if ( $links_query->have_posts() ) :
				   			//the loop
				   			while ( $links_query->have_posts() ) : $links_query->the_post(); ?>
				   				<article class="post">
							   		
							   		<?php 
								   		if(get_field('link_image')) { ?>
								   			<img src="<?php the_field('link_image'); ?>" alt="<?php the_title(); ?> logo" />
								   <?php } 
									if(get_field('use_local_pdf')) {
										?>
										<ul>
											<li><a href="<?php the_field('use_local_pdf'); ?>"><?php the_title(); ?></a></li>
						   				</ul>
										<?php
									} else { ?>
										<ul>
									   		<li><a href="<?php the_field('link_url'); ?>"><?php the_title(); ?> Website</a></li>
								   		</ul> 
								   		<?php
									}
								?>
							   		<p><?php the_field('additional_info'); ?></p>
							   	</article>
							<?php endwhile;
							wp_reset_postdata();
							else :
							
							endif;
						?>
						</div>
					<h2><?php the_field('cateogory_heading_4'); ?></h2>
						<div class="flexlinks">
						<?php
							$display_categories = get_field( 'display_category_4' );	 
							$classlinksargs = array('post_type'  => 'classroomlinks', 'orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => -1, 'tax_query' => array(array('taxonomy' => 'calendar_category','field' => 'term_id', 'terms' => $display_categories)));
							$links_query = new WP_Query( $classlinksargs );
				   			if ( $links_query->have_posts() ) :
				   			//the loop
				   			while ( $links_query->have_posts() ) : $links_query->the_post(); ?>
				   				<article class="post">
							   		
							   		<?php 
								   		if(get_field('link_image')) { ?>
								   			<img src="<?php the_field('link_image'); ?>" alt="<?php the_title(); ?> logo" />
								   <?php } 
									if(get_field('use_local_pdf')) {
										?>
										<ul>
											<li><a href="<?php the_field('use_local_pdf'); ?>"><?php the_title(); ?></a></li>
						   				</ul>
										<?php
									} else { ?>
										<ul>
									   		<li><a href="<?php the_field('link_url'); ?>"><?php the_title(); ?> Website</a></li>
								   		</ul> 
								   		<?php
									}
								?>
							   		<p><?php the_field('additional_info'); ?></p>
							   	</article>
							<?php endwhile;
							wp_reset_postdata();
							else :
							
							endif;
						?>
						</div>
					<h2><?php the_field('cateogory_heading_5'); ?></h2>
						<div class="flexlinks">
						<?php
							$display_categories = get_field( 'display_category_5' );	 
							$classlinksargs = array('post_type'  => 'classroomlinks', 'orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => -1, 'tax_query' => array(array('taxonomy' => 'calendar_category','field' => 'term_id', 'terms' => $display_categories)));
							$links_query = new WP_Query( $classlinksargs );
				   			if ( $links_query->have_posts() ) :
				   			//the loop
				   			while ( $links_query->have_posts() ) : $links_query->the_post(); ?>
				   				<article class="post">
							   		
							   		<?php 
								   		if(get_field('link_image')) { ?>
								   			<img src="<?php the_field('link_image'); ?>" alt="<?php the_title(); ?> logo" />
								   <?php } 
									if(get_field('use_local_pdf')) {
										?>
										<ul>
											<li><a href="<?php the_field('use_local_pdf'); ?>"><?php the_title(); ?></a></li>
						   				</ul>
										<?php
									} else { ?>
										<ul>
									   		<li><a href="<?php the_field('link_url'); ?>"><?php the_title(); ?> Website</a></li>
								   		</ul> 
								   		<?php
									}
								?>
							   		<p><?php the_field('additional_info'); ?></p>
							   	</article>
							<?php endwhile;
							wp_reset_postdata();
							else :
							
							endif;
						?>
						</div>
					<h2><?php the_field('cateogory_heading_6'); ?></h2>
						<div class="flexlinks">
						<?php
							$display_categories = get_field( 'display_category_6' );	 
							$classlinksargs = array('post_type'  => 'classroomlinks', 'orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => -1, 'tax_query' => array(array('taxonomy' => 'calendar_category','field' => 'term_id', 'terms' => $display_categories)));
							$links_query = new WP_Query( $classlinksargs );
				   			if ( $links_query->have_posts() ) :
				   			//the loop
				   			while ( $links_query->have_posts() ) : $links_query->the_post(); ?>
				   				<article class="post">
							   		
							   		<?php 
								   		if(get_field('link_image')) { ?>
								   			<img src="<?php the_field('link_image'); ?>" alt="<?php the_title(); ?> logo" />
								   <?php } 
									if(get_field('use_local_pdf')) {
										?>
										<ul>
											<li><a href="<?php the_field('use_local_pdf'); ?>"><?php the_title(); ?></a></li>
						   				</ul>
										<?php
									} else { ?>
										<ul>
									   		<li><a href="<?php the_field('link_url'); ?>"><?php the_title(); ?> Website</a></li>
								   		</ul> 
								   		<?php
									}
								?>
							   		<p><?php the_field('additional_info'); ?></p>
							   	</article>
							<?php endwhile;
							wp_reset_postdata();
							else :
							
							endif;
						?>
						</div>
					<h2><?php the_field('cateogory_heading_7'); ?></h2>
						<div class="flexlinks">
						<?php
							$display_categories = get_field( 'display_category_7' );	 
							$classlinksargs = array('post_type'  => 'classroomlinks', 'orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => -1, 'tax_query' => array(array('taxonomy' => 'calendar_category','field' => 'term_id', 'terms' => $display_categories)));
							$links_query = new WP_Query( $classlinksargs );
				   			if ( $links_query->have_posts() ) :
				   			//the loop
				   			while ( $links_query->have_posts() ) : $links_query->the_post(); ?>
				   				<article class="post">
							   		
							   		<?php 
								   		if(get_field('link_image')) { ?>
								   			<img src="<?php the_field('link_image'); ?>" alt="<?php the_title(); ?> logo" />
								   <?php } 
									if(get_field('use_local_pdf')) {
										?>
										<ul>
											<li><a href="<?php the_field('use_local_pdf'); ?>"><?php the_title(); ?></a></li>
						   				</ul>
										<?php
									} else { ?>
										<ul>
									   		<li><a href="<?php the_field('link_url'); ?>"><?php the_title(); ?> Website</a></li>
								   		</ul> 
								   		<?php
									}
								?>
							   		<p><?php the_field('additional_info'); ?></p>
							   	</article>
							<?php endwhile;
							wp_reset_postdata();
							else :
							
							endif;
						?>
						</div>
					<h2><?php the_field('cateogory_heading_8'); ?></h2>
						<div class="flexlinks">
						<?php
							$display_categories = get_field( 'display_category_8' );	 
							$classlinksargs = array('post_type'  => 'classroomlinks', 'orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => -1, 'tax_query' => array(array('taxonomy' => 'calendar_category','field' => 'term_id', 'terms' => $display_categories)));
							$links_query = new WP_Query( $classlinksargs );
				   			if ( $links_query->have_posts() ) :
				   			//the loop
				   			while ( $links_query->have_posts() ) : $links_query->the_post(); ?>
				   				<article class="post">
							   		
							   		<?php 
								   		if(get_field('link_image')) { ?>
								   			<img src="<?php the_field('link_image'); ?>" alt="<?php the_title(); ?> logo" />
								   <?php } 
									if(get_field('use_local_pdf')) {
										?>
										<ul>
											<li><a href="<?php the_field('use_local_pdf'); ?>"><?php the_title(); ?></a></li>
						   				</ul>
										<?php
									} else { ?>
										<ul>
									   		<li><a href="<?php the_field('link_url'); ?>"><?php the_title(); ?> Website</a></li>
								   		</ul> 
								   		<?php
									}
								?>
							   		<p><?php the_field('additional_info'); ?></p>
							   	</article>
							<?php endwhile;
							wp_reset_postdata();
							else :
							
							endif;
						?>
						</div>
					<h2><?php the_field('cateogory_heading_9'); ?></h2>
						<div class="flexlinks">
						<?php
							$display_categories = get_field( 'display_category_9' );	 
							$classlinksargs = array('post_type'  => 'classroomlinks', 'orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => -1, 'tax_query' => array(array('taxonomy' => 'calendar_category','field' => 'term_id', 'terms' => $display_categories)));
							$links_query = new WP_Query( $classlinksargs );
				   			if ( $links_query->have_posts() ) :
				   			//the loop
				   			while ( $links_query->have_posts() ) : $links_query->the_post(); ?>
				   				<article class="post">
							   		
							   		<?php 
								   		if(get_field('link_image')) { ?>
								   			<img src="<?php the_field('link_image'); ?>" alt="<?php the_title(); ?> logo" />
								   <?php } 
									if(get_field('use_local_pdf')) {
										?>
										<ul>
											<li><a href="<?php the_field('use_local_pdf'); ?>"><?php the_title(); ?></a></li>
						   				</ul>
										<?php
									} else { ?>
										<ul>
									   		<li><a href="<?php the_field('link_url'); ?>"><?php the_title(); ?> Website</a></li>
								   		</ul> 
								   		<?php
									}
								?>
							   		<p><?php the_field('additional_info'); ?></p>
							   	</article>
							<?php endwhile;
							wp_reset_postdata();
							else :
							
							endif;
						?>
						</div>
					<h2><?php the_field('cateogory_heading_10'); ?></h2>
						<div class="flexlinks">
						<?php
							$display_categories = get_field( 'display_category_10' );	 
							$classlinksargs = array('post_type'  => 'classroomlinks', 'orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => -1, 'tax_query' => array(array('taxonomy' => 'calendar_category','field' => 'term_id', 'terms' => $display_categories)));
							$links_query = new WP_Query( $classlinksargs );
				   			if ( $links_query->have_posts() ) :
				   			//the loop
				   			while ( $links_query->have_posts() ) : $links_query->the_post(); ?>
				   				<article class="post">
							   		
							   		<?php 
								   		if(get_field('link_image')) { ?>
								   			<img src="<?php the_field('link_image'); ?>" alt="<?php the_title(); ?> logo" />
								   <?php } 
									if(get_field('use_local_pdf')) {
										?>
										<ul>
											<li><a href="<?php the_field('use_local_pdf'); ?>"><?php the_title(); ?></a></li>
						   				</ul>
										<?php
									} else { ?>
										<ul>
									   		<li><a href="<?php the_field('link_url'); ?>"><?php the_title(); ?> Website</a></li>
								   		</ul> 
								   		<?php
									}
								?>
							   		<p><?php the_field('additional_info'); ?></p>
							   	</article>
							<?php endwhile;
							wp_reset_postdata();
							else :
							
							endif;
						?>
						</div>
			</section>
		</main>
		<?php
			get_footer();
		?>