<?php
/**
 * Class WP_Form
 */
class WP_Form {

	/**
	 * Array of forms registered
	 *
 	 * @todo context/form name coverage for $forms
	 *
	 * @var array
	 */
	private static $forms = array();

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
	 * @param string $object_type
	 * @param string|null $object
	 * @param array $args
	 */
	public function __construct( $object_type, $object = null, $args = array() ) {

		if ( !isset( self::$forms[ $object_type ] ) ) {
			self::$forms[ $object_type ] = array();
		}

		self::$forms[ $object_type ][ $object ] = $args;

		$this->object_type = $object_type;
		$this->object = $object;

		$this->init();

	}

	/**
	 *
	 */
	private function init() {

		$args = self::$forms[ $this->object_type ][ $this->object ];

		// @todo handle $args

	}

	/**
	 * @param string $object_type
	 * @param string|null $object
	 *
	 * @return WP_Form|WP_Error
	 */
	public static function get_form( $object_type, $object = null ) {

		if ( !isset( self::$forms[ $object_type ] ) || !isset( self::$forms[ $object_type ][ $object ] ) ) {
			return new WP_Error( '', __( 'Form not found' ) );
		}

		return new WP_Form( $object_type, $object, self::$forms[ $object_type ][ $object ] );

	}

	/**
	 * @param string $object_type
	 * @param string|null $object
	 *
	 * @return WP_Form|WP_Error
	 */
	public static function get_forms( $object_type, $object = null ) {

		if ( !isset( self::$forms[ $object_type ] ) || !isset( self::$forms[ $object_type ][ $object ] ) ) {
			return new WP_Error( '', __( 'Form not found' ) );
		}

		//return new WP_Form( $object_type, $object, self::$forms[ $object_type ][ $object ] );

		// @todo handle getting forms by object type, object, context

	}

	/**
	 * @param string $object_type
	 * @param string|null $object
	 * @param array $args
	 */
	public static function register_form( $object_type, $object = null, $args = array() ) {

		if ( !isset( self::$forms[ $object_type ] ) ) {
			self::$forms[ $object_type ] = array();
		}

		self::$forms[ $object_type ][ $object ] = $args;

		return true;

	}

	/**
	 * @param string $field
	 * @param array $args
	 *
	 * @return bool|WP_Error
	 */
	public function register_form_field( $field, $args = array() ) {

		return WP_Form_Field::register_form_field( $this->object_type, $this->object, $field, $args );

	}

	/**
	 * @param string $field
	 *
	 * @return bool|WP_Error
	 */
	public function add_form_field( $field ) {

		return WP_Form_Field::add_form_field( $this->object_type, $this->object, $field );

	}

}