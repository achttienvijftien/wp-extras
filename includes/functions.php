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
