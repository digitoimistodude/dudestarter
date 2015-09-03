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
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'THEMENAME' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
			
</article>

<div class="post-meta">
	<p class="cat"><i class="fa fa-folder"></i> <?php echo get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'olut' ) ); ?></p>
	<?php the_tags('<i class="fa fa-tags"></i> <ul class="tags"><li>','</li><li>','</li></ul>'); ?>
</div>

<?php edit_post_link( __( 'Edit', 'THEMENAME' ), '<p class="edit">', '</p>' ); ?>
</div><!--/.container-->