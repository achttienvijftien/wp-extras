<?php

use AchttienVijftien\Plugin\WPExtras\Filter;

if ( ! function_exists( 'remove_filter_with_instantiated_class' ) ) {
	/**
	 * @see Filter::remove_with_instantiated_class()
	 */
	function remove_filter_with_instantiated_class(
		string $hook_name,
		string $class_name,
		string $method_name,
		int $priority = 10
	): bool {
		return Filter::remove_with_instantiated_class(
			$hook_name,
			$class_name,
			$method_name,
			$priority
		);
	}
}

if ( ! function_exists( 'wp_debug_ignore_deprecations' ) ) {
	/**
	 * Alters error_reporting to ignore deprecations if WP_DEBUG is set. Should be called from
	 * mu-plugin scope.
	 *
	 * @return void
	 * @phpcs:disable WordPress.PHP.DevelopmentFunctions.prevent_path_disclosure_error_reporting
	 * @phpcs:disable WordPress.PHP.DiscouragedPHPFunctions.runtime_configuration_error_reporting
	 */
	function wp_debug_ignore_deprecations(): void {
		if ( WP_DEBUG ) {
			error_reporting( error_reporting() & ~E_DEPRECATED );
		}
	}
}

if ( ! function_exists( 'suppress_doing_it_wrong_functions' ) ) {
	/**
	 * Suppresses the doing it wrong messages.
	 *
	 * @param array $extra_doing_it_wrong_functions The functions for which the doing it wrong messages are suppressed.
	 *
	 * @return void
	 */
	function suppress_doing_it_wrong_functions( array $extra_doing_it_wrong_functions = [] ): void {
		$doing_it_wrong_functions_to_suppress = [
			'_load_textdomain_just_in_time',
			'register_meta',
		];

		if ( ! empty( $extra_doing_it_wrong_functions ) ) {
			$doing_it_wrong_functions_to_suppress = array_merge(
				$doing_it_wrong_functions_to_suppress,
				$extra_doing_it_wrong_functions
			);
		}

		add_filter(
			'doing_it_wrong_trigger_error',
			function ( mixed $trigger, string $function_name ) use ( $doing_it_wrong_functions_to_suppress ) {
				if ( in_array( $function_name, $doing_it_wrong_functions_to_suppress, true ) ) {
					return false;
				}

				return $trigger;
			},
			10,
			2
		);
	}
}
