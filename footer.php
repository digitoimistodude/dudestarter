<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package THEMENAME
 */
?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		
		<div class="site-info left">
			<p><?php esc_html_e( 'THEMENAME - A WordPress starter theme based on Underscores.', 'THEMENAME' ); ?></p>
		</div><!-- .site-info -->
		
		<div class="site-info right">
		</div>

	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</div><!-- #content -->

</body>
</html>