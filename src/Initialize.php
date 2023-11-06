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
		require trailingslashit( dirname( __FILE__, 2 ) ) . 'includes/functions.php';
	}
}
