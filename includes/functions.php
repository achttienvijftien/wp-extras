<?php

use AchttienVijftien\Plugin\WPExtras\Filter;

global $wp_extras_functions_autoloaded;
$wp_extras_functions_autoloaded = true;

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

if ( ! function_exists( 'suppress_doing_it_wrong' ) ) {
	/**
	 * Suppresses the doing it wrong messages.
	 *
	 * @param array $extra_doing_it_wrong_functions The functions for which the doing it wrong messages are suppressed.
	 *
	 * @return void
	 */
	function suppress_doing_it_wrong( array $extra_doing_it_wrong_functions = [] ): void {
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

if ( ! function_exists( 'get_plugin_state' ) ) {
	/**
	 * Gets plugin state.
	 *
	 * @param string $plugin Path to the plugin file relative to the plugins directory.
	 *
	 * @return string Either "active" or "inactive".
	 */
	function get_plugin_state( string $plugin ): string {
		if ( in_array( $plugin, (array) get_option( 'active_plugins', [] ), true ) ) {
			return 'active';
		}

		if ( ! is_multisite() ) {
			return 'inactive';
		}

		$plugins = get_site_option( 'active_sitewide_plugins' );
		if ( isset( $plugins[ $plugin ] ) ) {
			return 'active';
		}

		return 'inactive';
	}
}
