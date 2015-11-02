<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package THEMENAME
 */

get_header(); ?>

	<?php $artikkelikuva = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>

	<div class="slide slide-page" style="background-image:url('<?php if ( has_post_thumbnail() ) : ?><?php echo $artikkelikuva; ?><?php else : ?><?php echo get_template_directory_uri(); ?>/images/slide-default.jpg<?php endif; ?>');">
		<div class="shade"></div>
	
		<div class="container">
			<header class="entry-header">
				<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
			</header>
		</div>
		
	</div>
	
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<div class="container">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'template-parts/content', 'page' ); ?>
					
				<?php endwhile; // end of the loop. ?>

			</div><!--/.container-->

		</main><!-- #main -->
	</div><!-- #primary -->
	
<?php get_footer(); ?>