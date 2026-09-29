<?php
/**
 * Helper functions used by the templates.
 *
 * @package BM_Starter
 */

defined( 'ABSPATH' ) || exit;

/**
 * Default values for every Customizer setting.
 *
 * Keeping them in one place means templates and the Customizer never disagree.
 *
 * @return array<string, mixed>
 */
function bm_starter_defaults() {
	return array(
		'primary_color'     => '#2563eb',
		'hero_image'        => 0,
		'hero_heading'      => __( 'Build something people love', 'bm-starter' ),
		'hero_text'         => __( 'We design and develop fast, accessible websites that help your business grow.', 'bm-starter' ),
		'hero_button_label' => __( 'Get in touch', 'bm-starter' ),
		'hero_button_url'   => '#contact',
		'services_heading'  => __( 'What we do', 'bm-starter' ),
		'service_1_icon'    => 'dashicons-admin-appearance',
		'service_1_title'   => __( 'Web Design', 'bm-starter' ),
		'service_1_text'    => __( 'Clean, modern layouts that look great on every screen size.', 'bm-starter' ),
		'service_2_icon'    => 'dashicons-editor-code',
		'service_2_title'   => __( 'Development', 'bm-starter' ),
		'service_2_text'    => __( 'Custom themes and plugins built to WordPress coding standards.', 'bm-starter' ),
		'service_3_icon'    => 'dashicons-performance',
		'service_3_title'   => __( 'Optimization', 'bm-starter' ),
		'service_3_text'    => __( 'Speed, SEO and accessibility improvements that pay off.', 'bm-starter' ),
		'contact_heading'   => __( 'Contact us', 'bm-starter' ),
		'contact_text'      => __( 'Have a project in mind? Send us a message and we will reply within one business day.', 'bm-starter' ),
		'contact_email'     => '',
		'footer_text'       => '',
	);
}

/**
 * Reads a theme mod, falling back to the theme default.
 *
 * @param string $key Setting key without the prefix.
 * @return mixed
 */
function bm_starter_mod( $key ) {
	$defaults = bm_starter_defaults();
	$default  = isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';

	return get_theme_mod( 'bm_starter_' . $key, $default );
}

/**
 * Menu fallback used before a menu is assigned to the Primary location.
 *
 * @return void
 */
function bm_starter_menu_fallback() {
	$items = array(
		home_url( '/' )          => __( 'Home', 'bm-starter' ),
		home_url( '/#services' ) => __( 'Services', 'bm-starter' ),
		home_url( '/#contact' )  => __( 'Contact', 'bm-starter' ),
	);

	echo '<ul id="primary-menu" class="menu">';
	foreach ( $items as $url => $label ) {
		printf( '<li class="menu-item"><a href="%1$s">%2$s</a></li>', esc_url( $url ), esc_html( $label ) );
	}
	echo '</ul>';
}

/**
 * Icons offered for the services section (Dashicons class => label).
 *
 * @return array<string, string>
 */
function bm_starter_service_icons() {
	return array(
		'dashicons-admin-appearance' => __( 'Brush', 'bm-starter' ),
		'dashicons-editor-code'      => __( 'Code', 'bm-starter' ),
		'dashicons-performance'      => __( 'Speed', 'bm-starter' ),
		'dashicons-admin-tools'      => __( 'Tools', 'bm-starter' ),
		'dashicons-chart-line'       => __( 'Chart', 'bm-starter' ),
		'dashicons-shield'           => __( 'Shield', 'bm-starter' ),
		'dashicons-lightbulb'        => __( 'Lightbulb', 'bm-starter' ),
		'dashicons-groups'           => __( 'Team', 'bm-starter' ),
		'dashicons-smartphone'       => __( 'Mobile', 'bm-starter' ),
		'dashicons-cart'             => __( 'Cart', 'bm-starter' ),
	);
}

/**
 * Returns the footer copyright line.
 *
 * @return string
 */
function bm_starter_footer_text() {
	$text = bm_starter_mod( 'footer_text' );

	if ( '' === trim( (string) $text ) ) {
		/* translators: 1: year, 2: site name. */
		$text = sprintf( __( '© %1$s %2$s. All rights reserved.', 'bm-starter' ), wp_date( 'Y' ), get_bloginfo( 'name' ) );
	}

	return esc_html( $text );
}

/**
 * Stops in-page anchor links (e.g. /#services) from being marked as the current item.
 *
 * WordPress ignores the URL fragment when matching menu items, so every
 * "/#section" link would otherwise be highlighted on the homepage.
 *
 * @param string[] $classes Menu item CSS classes.
 * @param WP_Post  $item    Menu item.
 * @return string[]
 */
function bm_starter_anchor_menu_classes( $classes, $item ) {
	if ( 'custom' === $item->type && false !== strpos( (string) $item->url, '#' ) ) {
		$classes = array_diff( $classes, array( 'current-menu-item', 'current_page_item', 'current-menu-ancestor', 'current-menu-parent' ) );
	}

	return $classes;
}
add_filter( 'nav_menu_css_class', 'bm_starter_anchor_menu_classes', 10, 2 );