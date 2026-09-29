<?php
/**
 * Main template.
 *
 * On the front page it renders the homepage layout (hero + services);
 * everywhere else it falls back to a standard posts loop.
 *
 * @package BM_Starter
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="main" class="site-main">
	<?php if ( is_front_page() ) : ?>

		<?php get_template_part( 'template-parts/hero' ); ?>
		<?php get_template_part( 'template-parts/services' ); ?>

	<?php else : ?>

		<div class="container content-area">
			<?php if ( have_posts() ) : ?>

				<?php if ( is_home() || is_archive() || is_search() ) : ?>
					<header class="page-header">
						<h1 class="page-title">
							<?php
							if ( is_search() ) {
								/* translators: %s: search query. */
								printf( esc_html__( 'Search results for: %s', 'bm-starter' ), '<span>' . esc_html( get_search_query() ) . '</span>' );
							} elseif ( is_archive() ) {
								the_archive_title();
							} else {
								single_post_title();
							}
							?>
						</h1>
					</header>
				<?php endif; ?>

				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content' );

					if ( is_singular() && ( comments_open() || get_comments_number() ) ) {
						comments_template();
					}
				endwhile;

				the_posts_pagination();
				?>

			<?php else : ?>

				<section class="no-results">
					<h1 class="page-title"><?php esc_html_e( 'Nothing found', 'bm-starter' ); ?></h1>
					<p><?php esc_html_e( 'Sorry, nothing matched your request. Try searching instead.', 'bm-starter' ); ?></p>
					<?php get_search_form(); ?>
				</section>

			<?php endif; ?>
		</div>

	<?php endif; ?>
</main>

<?php
get_footer();