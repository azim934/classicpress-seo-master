<?php
/**
 * The PostArchive Class
 *
 * @since      0.1.8
 * @package    Classic_SEO
 * @subpackage Classic_SEO\Paper
 */

namespace Classic_SEO\Paper;

use Classic_SEO\Helper;

defined( 'ABSPATH' ) || exit;

/**
 * Archive class.
 */
class Archive implements IPaper {

	/**
	 * Builds the title for a post type archive
	 *
	 * @return string The title to use on a post type archive.
	 */
	public function title() {
		$post_type = $this->get_queried_post_type();

		return Paper::get_from_options( "cpseo_pt_{$post_type}_archive_title", [], '%pt_plural% Archive %page% %sep% %sitename%' );
	}

	/**
	 * Builds the description for a post type archive
	 *
	 * @return string The description to use on a post type archive.
	 */
	public function description() {
		$post_type = $this->get_queried_post_type();

		return Paper::get_from_options( "cpseo_pt_{$post_type}_archive_description", [], '%pt_plural% Archive %page% %sep% %sitename%' );
	}

	/**
	 * Retrieves the robots for a post type archive.
	 *
	 * @return string The robots to use on a post type archive.
	 */
	public function robots() {
		$robots    = [];
		$post_type = $this->get_queried_post_type();

		if ( Helper::get_settings( "titles.cpseo_pt_{$post_type}_custom_robots" ) ) {
			$robots = Paper::robots_combine( Helper::get_settings( "titles.cpseo_pt_{$post_type}_robots" ) );
		}

		return $robots;
	}
	
	/**
	 * Retrieves the advanced robots for a post type archive.
	 *
	 * @return array The advanced robots to use on a post type archive.
	 */
	public function advanced_robots() {
		$robots    = [];
		$post_type = $this->get_queried_post_type();

		if ( Helper::get_settings( "titles.cpseo_pt_{$post_type}_custom_robots" ) ) {
			$robots = Paper::advanced_robots_combine( Helper::get_settings( "titles.cpseo_pt_{$post_type}_advanced_robots" ) );
		}

		return $robots;
	}

	/**
	 * Retrieves the canonical URL.
	 *
	 * @return array
	 */
	public function canonical() {
		return [ 'canonical' => get_post_type_archive_link( $this->get_queried_post_type() ) ];
	}

	/**
	 * Retrieves meta keywords.
	 *
	 * @return string
	 */
	public function keywords() {
		return '';
	}

	/**
	 * Retrieves the queried post type
	 *
	 * @return string The queried post type.
	 */
	private function get_queried_post_type() {
		$post_type = get_query_var( 'post_type' );
		if ( is_array( $post_type ) ) {
			$post_type = reset( $post_type );
		}

		return $post_type;
	}
}