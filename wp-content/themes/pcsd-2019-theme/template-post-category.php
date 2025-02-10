<?php get_header();
/*
	Template Name: Post Category View
*/
?>
<main id="contentArea">
    <section id="mainContent" class="newsBlog">
        <section class="currentContent">
            <h1><?= the_title(); ?></h1>
            <?php
            // variables
            $cats_to_display = get_field('view_category');
            $how_many_posts = get_field('how_many_posts_to_display');
            // Define date range
            $start_date = get_field('start_date'); // Assuming these fields are set in the backend
            $end_date = get_field('end_date'); // Assuming these fields are set in the backend
            // display page content
            the_content();
            ?>
        </section>
        <section class="postgrid">
            <?php
            // WP_Query arguments
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

            $query_args = array(
                'posts_per_page' => $how_many_posts,
                'cat' => $cats_to_display,
                'post_type' => 'post',
                'paged' => $paged,
            );

            if ($start_date && $end_date) {
                $query_args['date_query'] = array(
                    array(
                        'after' => $start_date,
                        'before' => $end_date,
                        'inclusive' => true,
                    ),
                );
            }

            $the_query = new WP_Query($query_args);
            // The Loop
            if ($the_query->have_posts()) :
                while ($the_query->have_posts()) : $the_query->the_post(); ?>
                    <article class="post">
                        <a href="<?php the_permalink(); ?>">
                            <div class="featured-image">
                                <a href="<?php the_permalink(); ?>">
                                    <?php
                                    if (get_field('featured_image', $post_id)) {
                                    ?>
                                        <img src="<?php echo get_field('featured_image'); ?>" alt="decorative image" class="" /></a>
                            <?php
                                    } elseif (has_post_thumbnail()) {
                                        the_post_thumbnail();
                                    } else { ?>
                                <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/building-image.jpg'; ?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="" width="217" height="175">
                            <?php } ?>
                        </a>
                        </div>
                        </a>
                        <header class="postmeta">
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <ul>
                                <li><img src="//globalassets.provo.edu/image/icons/calendar-ltblue.svg" alt="calendar icon" /><?php the_time(' F jS, Y') ?></li>
                            </ul>
                        </header>

                        <?php
                        echo get_excerpt();
                        ?>
                    </article>
                <?php endwhile; ?>
                <nav class="archiveNav">
                    <?php echo paginate_links(array('total' => $the_query->max_num_pages)); ?>
                </nav>
            <?php else :
                echo '<p>No Content Found</p>';
            endif;
            ?>
        </section>
    </section>
</main>
<?php
$sidebar = get_field('sidebar');
get_sidebar($sidebar);
get_footer();
?>