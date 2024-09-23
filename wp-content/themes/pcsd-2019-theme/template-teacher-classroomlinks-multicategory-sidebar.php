<?php get_header(); 
/*
	Template Name: Teacher - Multi Cateogry Links - Sidebar
*/
	
?>
		<main id="contentArea">
			<?php custom_breadcrumbs(); ?>
			<section id="mainContent" class="single-page classroom-links">
					<?php
						do_shortcode( '[modified-date]' );	
						
						if(have_posts()) :
						while (have_posts()) : the_post();?>

						   			<h1><?php the_title(); ?></h1>
						   			<?php 
							   			if ( has_post_thumbnail() ) {
								   			echo get_the_post_thumbnail( $post_id, 'full' );
								   			}
							   			 ?>
					   				<?php the_content(); ?>
					   				

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
				<div class="clear"></div>
			</section>
		</main>
		<aside id="mainSidebar" class="teacherSidebar">				
				
				<?php
						if(is_page( 'study-at-home' )) {
							get_sidebar( $sidebar ); 
						} else {
					?>
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
							$post_parent_slug = get_post_field( 'post_name', $parent_id );
							if($post_parent_slug == 'teachers-directory') {
								echo do_shortcode('[wpb_childpages]');	
							} else {
								echo do_shortcode('[wpb_parentpages]');
							}
						}	
					?>	
			</aside>	
				
			
		</aside>
		<?php
			get_footer();
		?>