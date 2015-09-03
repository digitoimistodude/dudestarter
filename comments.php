<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package THEMENAME
 */

/*
 * Custom comments and pingbacks.
 * A Strategy To Separate Comments and Pingbacks in WordPress
 * 
 * See also templates comments.php, callback-comments.php and callback-pingbacks.php.
 * If you use Disqus Comment System or Jetpack for comments they will naturally replace WordPress comment templates.
 *
 * @link https://tommcfarlin.com/separate-comments-and-pingbacks/
 */
require('callback-comments.php');
require('callback-pingbacks.php');

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">
 
  <?php 
    /* Don't forget to check if comments are open 
     * or if there are comments to display.
     */
  ?>

  <?php if ( acme_post_has( 'pings', $post->ID ) ) : ?>

 	<h3><?php esc_html_e( 'Pingbacks', 'THEMENAME' ); ?></h3> 	
  <?php endif; ?>
 
		<div class="ping-list">
		<?php
			wp_list_comments(
				array(
					'type'       => 'pings',
					'callback'   => 'acme_pings',
					'avatar_size'=> 64,
					'style'		 => 'div'
				)
			);
		?>
		</div><!-- .ping-list -->

  <h3><?php comments_number('Ei kommentteja. Kommentoi ensimmäisenä?', 'Vasta yksi kommentti. Vastaa kommenttiin?', '% kommenttia. Lisää omasi joukkoon?' );?></h3>

		<div class="comment-list">
		<?php
			wp_list_comments(
				array(
					'type'       => 'comment',
					'callback'   => 'acme_comment',
					'avatar_size'=> 64,
					'style'		 => 'div'
				)
			);
		?>
		</div><!-- .comment-list -->
	
	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'THEMENAME' ); ?></p>
	<?php endif; ?>

	<?php 

$args = array(
);

	comment_form($args); ?>

</div><!-- #comments -->