<?php
	
	/*
	Template Name: Gallery Page
	*/
	
	 get_header(); ?>
		<main id="contentArea">
			<?php custom_breadcrumbs(); ?>
			<section id="mainContent" class="single-page gallery-page">
					<?php
						$galleryArray = get_post_gallery_ids($post->ID);
						if(have_posts()) :
						while (have_posts()) : the_post();?>

						   			<h1><?php the_title(); ?></h1>
					   				<?php 
												the_content();
									?>
					   				<?php 
						   				if(get_post_gallery_ids($post->ID)) { ?>
								   			<div class="page-gallery">
									   			
									   			<div class="page-gallery-nav">
									   			<?php foreach ($galleryArray as $id) { ?>
									   				<div class="page-gallery-selection" style="background-image: url(<?php echo wp_get_attachment_url( $id ); ?>)"></div>
									   			<?php } ?>
									   			</div>
									   			<div class="page-gallery-for">
									   			<?php foreach ($galleryArray as $id) { ?>
									   				<img src="<?php echo wp_get_attachment_url( $id ); ?>" alt="" />
									   			<?php } ?>
									   			</div>
									   			
								   			</div>
								   		<?php } else { ?>
											<div class="featured-image-full">
												<?php the_post_thumbnail(); ?>
							   				</div>
							   					<?php }	?>
					   	<?php endwhile;
							else :
								echo '<p>No Content Found</p>';
					endif;
				?>
			
			</section>
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