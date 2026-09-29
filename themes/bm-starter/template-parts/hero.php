<?php
/**
 * Hero section: full-width image, heading, text and call-to-action button.
 *
 * @package BM_Starter
 */

defined( 'ABSPATH' ) || exit;

$bm_image_id = absint( bm_starter_mod( 'hero_image' ) );
$bm_heading  = bm_starter_mod( 'hero_heading' );
$bm_text     = bm_starter_mod( 'hero_text' );
$bm_label    = bm_starter_mod( 'hero_button_label' );
$bm_url      = bm_starter_mod( 'hero_button_url' );
?>
<section class="hero<?php echo $bm_image_id ? ' hero--has-image' : ''; ?>" aria-labelledby="hero-heading">
	<?php
	if ( $bm_image_id ) {
		// The hero image is the Largest Contentful Paint element: load it eagerly with high priority.
		echo wp_get_attachment_image(
			$bm_image_id,
			'full',
			false,
			array(
				'class'         => 'hero__image',
				'alt'           => '',
				'loading'       => 'eager',
				'fetchpriority' => 'high',
				'decoding'      => 'async',
				'sizes'         => '100vw',
			)
		);
	}
	?>
	<div class="container hero__content">
		<?php if ( $bm_heading ) : ?>
			<h1 id="hero-heading" class="hero__heading"><?php echo esc_html( $bm_heading ); ?></h1>
		<?php endif; ?>

		<?php if ( $bm_text ) : ?>
			<p class="hero__text"><?php echo esc_html( $bm_text ); ?></p>
		<?php endif; ?>

		<?php if ( $bm_label && $bm_url ) : ?>
			<a class="button button--large" href="<?php echo esc_url( $bm_url ); ?>"><?php echo esc_html( $bm_label ); ?></a>
		<?php endif; ?>
	</div>
</section>