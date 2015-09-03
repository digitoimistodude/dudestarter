<?php
 
function acme_pings( $comment, $args, $depth ) {
 
	$GLOBALS['comment'] = $comment;
	extract( $args, EXTR_SKIP );
	?>

	<div <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID(); ?>">
		<div class="ping-body" id="div-ping-<?php comment_ID(); ?>">
 
			<div class="ping-author vcard">
				<div class="ping-meta-wrapper">
					<span class="ping-meta">
						<?php
						printf(  '<cite class="fn">%s</cite>', get_comment_author_link() );
						printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time() );
						?>
					</span><!-- .ping-meta -->
				</div><!-- .ping-meta-wrapper -->
			</div><!-- .ping-author -->
 
			<div class="ping-text">
				<?php comment_text(); ?>
			</div><!-- .ping-text -->
 
		</div><!-- .ping-body -->

	<?php
} // end acme_pings