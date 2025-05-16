<?php

namespace AchttienVijftien\Plugin\WPExtras;

/**
 * Class Initialize.
 */
class Initialize {
	/**
	 * Initializes package.
	 *
	 * @return void
	 */
	public static function initialize(): void {
		global $wp_extras_functions_autoloaded;
		if ( $wp_extras_functions_autoloaded ) {
			return;
		}

		require trailingslashit( dirname( __FILE__, 2 ) ) . 'includes/functions.php';
	}
}
