<?php
function acme_comment( $comment, $args, $depth ) {
 
	$GLOBALS['comment'] = $comment;
	extract( $args, EXTR_SKIP );
	?>

	<div <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID(); ?>">
		<div class="comment-body" id="div-comment-<?php comment_ID(); ?>">
 
			<div class="comment-author vcard">
					<div class="avatar">
						<?php echo get_avatar( $comment, $args['avatar_size'] ); ?>
					</div><!-- .avatar -->
			</div><!-- .comment-author -->
 
			<div class="comment-text">
				
				<?php if ( '0' === $comment->comment_approved ) { ?>
					<div class="comment-moderation-notice">
						<em class="comment-awaiting-moderation">
							<?php esc_html_e( 'Your comment is awaiting moderation.' ); ?>
						</em><!-- .comment-awaiting-moderation -->
					</div><!-- .comment-moderation-notice -->
				<?php } // end if ?>

				<div class="the-comment">
				<?php comment_text(); ?>
				</div>

						<p class="comment-meta">
							<?php printf(  'Wrote by <span class="author fn" rel="author">%s</span>', get_comment_author_link() ); ?> <time datetime="<?php comment_date('c'); ?>"><a class="comment-time" href="#comment-<?php comment_ID() ?>" title="Kommentti lähetetty <?php echo (get_comment_date('j\. F\t\a Y')); ?> kello <?php comment_time('G:i') ?>"><?php if (function_exists('time_since')) { ?><?php echo time_since(abs(strtotime($comment->comment_date_gmt . " GMT")), time()) . " sitten"; ?><?php } else { ?><?php echo (get_comment_date('j\. F\t\a Y')); ?> kello <?php comment_time('G:i') ?><?php } ?></a></time>
						</p><!-- .comment-meta -->

				<?php edit_comment_link( __( 'Edit comment' ), '<p class="comment-edit-link-wrapper">', '</p>' ); ?>
			</div><!-- .comment-text -->
 
			<div class="reply">
				<?php
					comment_reply_link(
						array_merge(
							$args,
							array(
								'add_below'    => 'comment',
								'depth'        => $depth,
								'max_depth'    => $args['max_depth']
							)
						)
					);
				?>
			</div><!-- .reply -->
 
 </div>
	<?php
} // end acme_comment