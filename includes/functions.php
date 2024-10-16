<?php
/**
 * Functions
 *
 * @package    Posts Lists
 * @subpackage Core
 * @category   Functions
 * @since      1.0.0
 */

namespace PostLists;

// Stop if accessed directly.
if ( ! defined( 'BLUDIT' ) ) {
	die( 'You are not allowed direct access to this file.' );
}

/**
 * Posts list
 *
 * @since  1.0.0
 * @param  mixed $args Arguments to be passed.
 * @param  array $defaults Default arguments.
 * @global object $pages The Pages class.
 * @return string Returns the list markup.
 */
function posts_list( $args = null, $defaults = [] ) {

	// Access global variables.
	global $pages;

	// Default arguments.
	$defaults = [
		'wrap'         => false,
		'wrap_class'   => 'list-wrap posts-list-wrap',
		'list_class'   => 'posts-list standard-posts-list',
		'label'        => false,
		'label_el'     => 'h2',
		'list_items'   => 7,
		'show_dates'   => 'show', // `show` or `hide`
		'date_display' => 'headings', // `headings` or `select`
		'date_code'    => 'F Y' // PHP date code
	];

	// Maybe override defaults.
	if ( is_array( $args ) && $args ) {
		if ( isset( $args['direction'] ) && 'horz' == $args['direction'] && ! isset( $args['list_class'] ) ) {
			$defaults['list_class'] = 'posts-list inline-posts-list';
		}
		$args = array_merge( $defaults, $args );
	} else {
		$args = $defaults;
	}

	// Label wrapping elements.
	$get_open  = str_replace( ',', '><', $args['label_el'] );
	$get_close = str_replace( ',', '></', $args['label_el'] );

	$label_el_open  = "<{$get_open}>";
	$label_el_close = "</{$get_close}>";

	// List of published pages.
	$pub_count = -1;
	if ( 'headings' == $args['date_display'] ) {
		$pub_count = $args['list_items'];
	}
	$published = $pages->getList( 1, $pub_count, true, false, true, false, false );

	// Variable used to assure dates are not repeated.
	$prev_date = null;

	// List markup.
	$html = '';
	if ( $args['wrap'] ) {
		$html = sprintf(
			'<div class="%s">',
			$args['wrap_class']
		);
	}
	if ( $args['label'] ) {
		$html .= sprintf(
			'%1$s%2$s%3$s',
			$label_el_open,
			$args['label'],
			$label_el_close
		);
	}

	/**
	 * Select list
	 *
	 * Lists displayed by date selected in
	 * a dropdown select box. Requires the
	 * `show_dates` option be `show`.
	 */
	if ( 'show' == $args['show_dates'] && 'select' == $args['date_display'] ) :

		$html .= '<select id="posts-list-select">';

		$group = 0;
		$count = [];
		$dlist = [];
		foreach ( $published as $key ) :

			// Get publish date.
			$page = new \Page( $key );
			$date = $page->date( $args['date_code'] );

			if ( $date !== $prev_date ) {
				$group ++;
				$count[] = $group;
				$dlist[] = $date;
				if ( $group > $args['list_items'] ) {
					continue;
				}
				$html .= sprintf(
					'<option value="date-list-%s">%s</option>',
					$group,
					$date
				);
			}
			$prev_date = $date;
		endforeach;
		$html .= '</select>';

		foreach ( $dlist as $id => $li ) {
			$id++;
			$html .= sprintf(
				'<div class="posts-lists-date-block" id="date-list-%s" style="display: %s;"><ul class="%s">',
				$id,
				( $id == 1 ? 'block' : 'none' ),
				$args['list_class']
			);

			foreach ( $published as $date => $key ) :

				$page = new \Page( $key );
				$date = $page->date( $args['date_code'] );

				if ( $date !== $li ) {
					continue;
				}
				$html .= sprintf(
					'<li class="posts-list-entry"><a href="%s">%s</a></li>',
					$page->permalink(),
					$page->title()
				);
			endforeach;

			$html .= '</ul></div>';
		}

	/**
	 * Simple list
	 *
	 * List with or without headings,
	 * not displayed by dropdown select.
	 */
	else :
		$html .= sprintf(
			'<ul class="%s">',
			$args['list_class']
		);

		foreach ( $published as $key ) {

			$page = new \Page( $key );
			$date = $page->date( $args['date_code'] );

			if ( 'show' == $args['show_dates'] ) {
				if ( $date !== $prev_date ) {
					$html .= sprintf(
						'<li class="posts-list-heading">%s</li>',
						$date
					);
				}
			}

			$html .= sprintf(
				'<li class="posts-list-entry"><a href="%s">%s</a></li>',
				$page->permalink(),
				$page->title()
			);
			$prev_date = $date;
		}
		$html .= '</ul>';
	endif; // Dates display.

	if ( $args['wrap'] ) {
		$html .= '</div>';
	}
	return $html;
}

/**
 * Sidebar list
 *
 * @since  1.0.0
 * @return string Returns the list markup.
 */
function sidebar_list() {

	// Get the plugin object.
	$plugin = new \Posts_Lists;

	// Override default function arguments.
	$args = [
		'wrap'       => true,
		'wrap_class' => 'list-wrap posts-list-wrap-wrap plugin plugin-posts-list'
	];
	$args['label_el'] = $plugin->label_wrap();

	if ( ! empty( $plugin->label() ) ) {
		$args['label'] = $plugin->label();
	}
	$args['list_items']   = $plugin->list_items();
	$args['show_dates']   = $plugin->show_dates();
	$args['date_display'] = $plugin->date_display();
	$args['date_code']    = $plugin->date_code();

	// Return a modified posts list.
	return posts_list( $args );
}
