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
