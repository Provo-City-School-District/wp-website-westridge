<?php get_header(); ?>
		<main id="contentArea">
			<?php custom_breadcrumbs(); ?>
			<section id="mainContent" class="searchResults">
				<h1><?php printf( __( 'Search Results for: %s'), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h1>
				<?php
					//if (function_exists('relevanssi_didyoumean')) { relevanssi_didyoumean(get_search_query(), "<p>Did you mean: ", "</p>", 5);}
					if(have_posts()) :
						while (have_posts()) : the_post();?>
						   		<article class="post">
					   			
					   				<header class="postmeta">
										<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
									</header>

					   				<?php
						   				echo get_excerpt();
						   			?>
						   		</article>
						   	<?php endwhile;
							   		else :
									echo '<p>No Content Found</p>';
						endif;
					?>
			</section>
		</main>
		<?php
			$sidebar = get_field('sidebar');
	   		get_sidebar( $sidebar );
			get_footer();
		?>