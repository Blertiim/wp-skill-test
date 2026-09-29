<?php
/**
 * The footer: copyright line and wp_footer().
 *
 * @package BM_Starter
 */

defined( 'ABSPATH' ) || exit;
?>
<footer class="site-footer">
	<div class="site-info">
		<div class="container">
			<p class="site-info__text"><?php echo bm_starter_footer_text(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in the function. ?></p>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>