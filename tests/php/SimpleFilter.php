<?php

namespace AchttienVijftien\Plugin\WPExtras\Test;

/**
 * Class SimpleFilter.
 */
class SimpleFilter {
	/**
	 * SimpleFilter constructor.
	 *
	 * @param string $append
	 */
	public function __construct( private string $append = ' bar' ) {
	}

	/**
	 * Appends text with given string.
	 *
	 * @param string $text Text to append.
	 *
	 * @return string
	 */
	public function append( string $text ): string {
		return $text . $this->append;
	}
}
