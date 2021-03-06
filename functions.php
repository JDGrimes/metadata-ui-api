<?php
/**
 * Ensure that an $args array has an 'object_type' property of class WP_Object_Type
 *
 * Defaults to "post:{$post->post_type}"
 *
 * @param array $args
 *
 * @return array
 */
function wp_ensure_object_type( $args ) {

	$args = wp_parse_args( $args );

	if ( empty( $args[ 'object_type' ] ) ) {
		global $post;

		$args[ 'object_type' ] = isset( $post->post_type ) ? $post->post_type : false;
	}

	if ( !$args[ 'object_type' ] instanceof WP_Object_Type ) {
		$args[ 'object_type' ] = new WP_Object_Type( $args[ 'object_type' ] );
	}

	return $args;

}

/**
 * Get an array of class name lineage
 *
 * Returns an array of class names with most distant ancenstor first, current class last (if inclusive), or parent.
 *
 * @example array( 'WP_Base', 'WP_Field_Base', 'WP_Text_Field' )
 *
 * @todo Consider if there is a better name than 'lineage'?  Open to suggestion on GitHub issues...
 *
 * @param string $class_name
 * @param bool $inclusive
 *
 * @return array
 */
function wp_get_class_lineage( $class_name, $inclusive = true ) {

	if ( !( $lineage = wp_cache_get( $cache_key = "class_lineage[{$class_name}]" ) ) ) {
		$lineage = $inclusive ? array( $class_name ) : array();

		if ( $class_name = get_parent_class( $class_name ) ) {
			$lineage = array_merge( wp_get_class_lineage( $class_name, true ), $lineage );
		}

		wp_cache_set( $cache_key, $lineage );
	}

	return $lineage;

}