<?php
/**
 * Post/page content used by the fallback loop in index.php.
 *
 * @package BM_Starter
 */

defined( 'ABSPATH' ) || exit;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>
	<header class="entry__header">
		<?php
		if ( is_singular() ) {
			the_title( '<h1 class="entry__title">', '</h1>' );
		} else {
			the_title( sprintf( '<h2 class="entry__title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
		}
		?>
		<?php if ( 'post' === get_post_type() ) : ?>
			<p class="entry__meta">
				<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
			</p>
		<?php endif; ?>
	</header>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="entry__thumbnail"><?php the_post_thumbnail( 'large' ); ?></div>
	<?php endif; ?>

	<div class="entry__content">
		<?php
		if ( is_singular() ) {
			the_content();
			wp_link_pages();
		} else {
			the_excerpt();
		}
		?>
	</div>
</article>