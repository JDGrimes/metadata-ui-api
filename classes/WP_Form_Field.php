<?php
/**
 * Class WP_Form_Field
 */
class WP_Form_Field {

	/**
	 * Array of fields registered
	 *
 	 * @todo context/form name coverage for $fields
	 *
	 * @var array
	 */
	static $fields = array();

	/**
	 * Object type (post/user/comment/settings)
	 *
	 * @var string
	 */
	private $object_type;

	/**
	 * @var string
	 */
	private $object;

	/**
	 * @var string
	 */
	private $field;

	/**
	 *
	 */
	public function __construct( $object_type, $object = null, $field = null, $args = array() ) {

		if ( !isset( self::$fields[ $object_type ] ) ) {
			self::$fields[ $object_type ] = array();
		}

		if ( !isset( self::$fields[ $object_type ][ $object ] ) ) {
			self::$fields[ $object_type ][ $object ] = array();
		}

		self::$fields[ $object_type ][ $object ][ $field ] = $args;

		$this->object_type = $object_type;
		$this->object = $object;
		$this->field = $field;

		$this->init();

	}

	/**
	 *
	 */
	private function init() {

		$args = self::$fields[ $this->object_type ][ $this->object ][ $this->field ];

		// @todo handle $args

	}

	/**
	 * @param string $object_type
	 * @param string|null $object
	 * @param string|null $field
	 *
	 * @return WP_Form|WP_Error
	 */
	public static function get_form_field( $object_type, $object = null, $field = null ) {

		if ( !isset( self::$fields[ $object_type ][ $field ] ) || !isset( self::$fields[ $object_type ][ $object ] ) || !isset( self::$fields[ $object_type ][ $object ][ $field ] ) ) {
			return new WP_Error( '', __( 'Form field not found' ) );
		}

		return new WP_Form_Field( $object_type, $object, $field, self::$fields[ $object_type ][ $object ][ $field ] );

	}

	/**
	 * @param string|null $object_type Set to null for a shared field
	 * @param string|null $object
	 * @param string|null $field
	 * @param array $args
	 *
	 * @return bool|WP_Error
	 */
	public static function register_form_field( $object_type, $object = null, $field = null, $args = array() ) {

		if ( null === $object_type ) {
			if ( !is_array( self::$fields[ $object_type ] ) ) {
				self::$fields[ $object_type ] = array();
			}

			self::$fields[ $object_type ][ $field ] = $args;
		}
		else {
			if ( !is_array( self::$fields[ $object_type ] ) ) {
				self::$fields[ $object_type ] = array();
			}

			if ( !is_array( self::$fields[ $object_type ][ $object ] ) ) {
				self::$fields[ $object_type ][ $object ] = array();
			}

			self::$fields[ $object_type ][ $object ][ $field ] = $args;
		}

	}

	/**
	 * @param string|null $field
	 * @param array $args
	 *
	 * @return bool
	 *
	 * @todo finish shared form fields
	 */
	public static function register_shared_form_field( $field = null, $args = array() ) {

		if ( isset( self::$fields[ null ] ) && isset( self::$fields[ null ][ $field ] ) ) {
			return new WP_Error( '', __( 'Form field already exists' ) );
		}

		if ( !is_array( self::$fields[ null ] ) ) {
			self::$fields[ null ] = array();
		}

		self::$fields[ null ][ $field ] = $args;

	}

	/**
	 * @param string $object_type
	 * @param string|null $object
	 * @param string|null $field
	 * @param array $args
	 *
	 * @return bool|WP_Error
	 */
	public static function add_form_field( $object_type, $object = null, $field = null ) {

		if ( !isset( self::$fields[ null ] ) || !isset( self::$fields[ null ][ $field ] ) ) {
			return new WP_Error( '', __( 'Form field not found' ) );
		}

		$args = self::$fields[ null ][ $field ];

		if ( !is_array( self::$fields[ $object_type ] ) ) {
			self::$fields[ $object_type ] = array();
		}

		if ( !is_array( self::$fields[ $object_type ][ $object ] ) ) {
			self::$fields[ $object_type ][ $object ] = array();
		}

		self::$fields[ $object_type ][ $object ][ $field ] = $args;

	}

}