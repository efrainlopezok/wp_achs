<?php
/**
 * Genesis Framework.
 *
 * WARNING: This file is part of the core Genesis Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @package Genesis\Sidebars
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://my.studiopress.com/themes/genesis/
 */

add_action( 'genesis_sidebar', 'genesis_do_sidebar' );
/**
 * Echo primary sidebar default content.
 *
 * Only shows if sidebar is empty, and current user has the ability to edit theme options (manage widgets).
 *
 * @since 1.2.0
 */
function genesis_do_sidebar() {

	if ( ! dynamic_sidebar( 'sidebar' ) && current_user_can( 'edit_theme_options' ) ) {
		genesis_default_widget_area_content( __( 'Primary Sidebar Widget Area', 'genesis' ) );
	}

}

add_action( 'genesis_sidebar_alt', 'genesis_do_sidebar_alt' );
/**
 * Echo alternate sidebar default content.
 *
 * Only shows if sidebar is empty, and current user has the ability to edit theme options (manage widgets).
 *
 * @since 1.2.0
 */
function genesis_do_sidebar_alt() {

	if ( ! dynamic_sidebar( 'sidebar-alt' ) && current_user_can( 'edit_theme_options' ) ) {
		genesis_default_widget_area_content( __( 'Secondary Sidebar Widget Area', 'genesis' ) );
	}

}

/**
 * Template for default widget area content.
 *
 * @since 2.0.0
 *
 * @param string $name Name of the widget area e.g. `__( 'Secondary Sidebar Widget Area', 'yourtextdomain' )`.
 */
function genesis_default_widget_area_content( $name ) {

	genesis_markup(
		array(
			'open'    => '<section class="widget widget_text">',
			'context' => 'default-widget-content-wrap',
		)
	);

	echo '<div class="widget-wrap">';

		$genesis_heading = ( genesis_a11y( 'headings' ) ? 'h3' : 'h4' );

		echo sprintf( '<%1$s class="widgettitle">%2$s</%1$s>', esc_attr( $genesis_heading ), esc_html( $name ) );
		echo '<div class="textwidget"><p>';
			printf(
				/* translators: 1: Widget name, 2: URL to widgets admin page. */
				esc_html__( 'This is the %1$s. You can add content to this area by visiting your %2$s and adding new widgets to this area.', 'genesis' ),
				esc_html( $name ),
				sprintf(
					'<a href="%1$s">%2$s</a>',
					esc_url( admin_url( 'widgets.php' ) ),
					esc_html__( 'Widgets Panel', 'genesis' )
				)
			);

		echo '</p></div>';

	echo '</div>';

	genesis_markup(
		array(
			'close'   => '</section>',
			'context' => 'default-widget-content-wrap',
		)
	);

}