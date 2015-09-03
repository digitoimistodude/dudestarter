<?php
/**
 * Yksittäinen blogipostaus.
 *
 * @package THEMENAME
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<div class="container">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'template-parts/content', 'single' ); ?>
					
				<?php endwhile; // end of the loop. ?>

					<div class="comments-wrap">
						<div class="container">
							<?php the_post_navigation(); ?>

							<?php
								// If comments are open or we have at least one comment, load up the comment template
								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;
							?>
							
						</div>
					</div>
					
			</div><!--/.container-->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>