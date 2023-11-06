<?php
/**
 * Class FilterTest
 *
 * @package AchttienVijftien\Plugin\WPExtras\Test
 */

namespace AchttienVijftien\Plugin\WPExtras\Test;

use WP_UnitTestCase;

/**
 * FilterTest unit tests.
 */
class FilterTest extends WP_UnitTestCase {

	/**
	 * Test unit test.
	 */
	public function test_remove_filter_instantiated_class() {
		add_filter( 'test_simple_filter_append', [ new SimpleFilter(), 'append' ] );

		$appended_text = apply_filters( 'test_simple_filter_append', 'foo' );
		$this->assertEquals( 'foo bar', $appended_text );

		remove_filter_with_instantiated_class(
			'test_simple_filter_append',
			SimpleFilter::class,
			'append'
		);

		$not_appended_text = apply_filters( 'test_simple_filter_append', 'foo' );
		$this->assertEquals( 'foo', $not_appended_text );
	}

	public function test_remove_filter_instantiated_class_priority() {
		add_filter( 'test_simple_filter_append', [ new SimpleFilter(), 'append' ], 20 );

		remove_filter_with_instantiated_class(
			'test_simple_filter_append',
			SimpleFilter::class,
			'append',
			10
		);

		$appended_text = apply_filters( 'test_simple_filter_append', 'foo' );
		$this->assertEquals( 'foo bar', $appended_text );

		remove_filter_with_instantiated_class(
			'test_simple_filter_append',
			SimpleFilter::class,
			'append',
			20
		);

		$not_appended_text = apply_filters( 'test_simple_filter_append', 'foo' );
		$this->assertEquals( 'foo', $not_appended_text );
	}
}
