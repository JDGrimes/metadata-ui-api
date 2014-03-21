<?php
/**
 * @param string $object_type
 * @param string|null $object
 * @param array $args
 *
 * @return mixed
 */
function register_form( $object_type, $object = null, $args = array() ) {

	return WP_Form::register_form( $object_type, $object, $args );

}

/**
 * @param string $object_type
 * @param string|null $object
 * @param string|null $field
 * @param array $args
 *
 * @return bool
 */
function register_form_field( $object_type, $object = null, $field = null, $args = array() ) {

	return WP_Form_Field::register_form_field( $object_type, $object, $field, $args );

}

/**
 * @param string $object_type
 * @param string|null $object
 * @param string|null $field
 * @param array $args
 *
 * @return bool
 */
function register_shared_form_field( $field = null, $args = array() ) {

	return WP_Form_Field::register_shared_form_field( $field, $args );

}

/**
 * @param string $object_type
 * @param string|null $object
 * @param string|null $field
 *
 * @return bool
 */
function add_form_field( $object_type, $object = null, $field = null ) {

	return WP_Form_Field::add_form_field( $object_type, $object, $field );

}

/**
 * @param string|null $object
 * @param array $args
 *
 * @return WP_Form
 */
function register_post_form( $object, $args = array() ) {

	return register_form( 'post', $object, $args );

}

/**
 * @param string|null $object
 * @param string|null $field
 * @param array $args
 *
 * @return bool
 */
function register_post_form_field( $object, $field = null, $args = array() ) {

	return register_form_field( 'post', $object, $field, $args );

}

/**
 * @param string|null $object
 * @param string|null $field
 *
 * @return bool
 */
function add_post_form_field( $object, $field = null ) {

	return add_form_field( 'post', $object, $field );

}