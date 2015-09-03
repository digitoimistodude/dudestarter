<?php
/**
 * @package THEMENAME
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		<time class="entry-time" datetime="<?php get_the_time('c'); ?>" pubdate="pubdate"><?php echo ucfirst(get_the_time('l')) ?>na, <?php the_time('j. F') ?>ta <?php the_time('Y') ?></time>
	</header>
	<div class="entry-content">
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'THEMENAME' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
		?>
		
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'THEMENAME' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
			
	<?php edit_post_link( esc_html__( 'Edit', 'THEMENAME' ), '<p class="edit">', '</p>' ); ?>
</article>