<?php

namespace AchttienVijftien\Plugin\WPExtras;

/**
 * Class Filter.
 */
class Filter {

	/**
	 * Removes filter with hook name and instantiated class.
	 *
	 * @param string $hook_name   Hook name.
	 * @param string $class_name  Full instantiated (namespaced) class name.
	 * @param string $method_name Method name.
	 * @param int    $priority    Priority.
	 *
	 * @return bool
	 */
	public static function remove_with_instantiated_class(
		string $hook_name,
		string $class_name,
		string $method_name,
		int $priority = 10
	): bool {
		global $wp_filter;

		if ( empty( $wp_filter[ $hook_name ][ $priority ] ) ) {
			return false;
		}

		if ( ! is_array( $wp_filter[ $hook_name ][ $priority ] ) ) {
			return false;
		}

		$unset = false;
		foreach ( $wp_filter[ $hook_name ][ $priority ] as $unique_id => $filter_array ) {
			if ( ! isset( $filter_array['function'] ) || ! is_array( $filter_array['function'] ) ) {
				continue;
			}

			if ( ! isset( $filter_array['function'][0] ) || ! isset( $filter_array['function'][1] ) ) {
				continue;
			}

			if (
				! is_object( $filter_array['function'][0] ) ||
				! $filter_array['function'][0] instanceof $class_name
			) {
				continue;
			}

			if ( $method_name !== $filter_array['function'][1] ) {
				continue;
			}

			unset( $wp_filter[ $hook_name ]->callbacks[ $priority ][ $unique_id ] );
			$unset = true;
		}

		return $unset;
	}
}
