<?php
/**
 * 
 * Etusivun template.
 * Template Name: Front page
 *
 * @package THEMENAME
 */

get_header(); ?>

<div class="slide slide-front" style="background-image:url(<?php if ( has_post_thumbnail($id)) : ?><?php echo wp_get_attachment_url( get_post_thumbnail_id($id) ); ?><?php else: ?><?php echo get_template_directory_uri(); ?>/images/slide-default-3.jpg<?php endif; ?>);">
<div class="shade"></div>

	<div class="container">

		<!-- This is for demoing only, please remove these when starting a project -->
		<h2>Excepteur sint occaecat cupidatat non proident.</h2>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Temporibus amet mollitia delectus ut, quis laboriosam totam, dolores, magni dicta consectetur incidunt officia pariatur officiis facilis nam, nobis veniam vitae odio.</p>

		<p><a href="#" class="button button-border button-white" data-text="Ghost button">Ghost button</a></p>

	</div>

</div>

	<div id="primary" class="content-area front-page-content">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<div class="container">
			
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<?php the_content(); ?>
					<?php edit_post_link( __( 'Edit', 'THEMENAME' ), '<p class="edit">', '</p>' ); ?>
				
				</article><!-- #post-## -->
			
			</div><!--/.container-->

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->
	
<?php get_footer(); ?>