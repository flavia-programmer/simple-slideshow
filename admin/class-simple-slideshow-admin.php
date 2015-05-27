<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       www.flaviaamaral.com.br
 * @since      1.0.0
 *
 * @package    Simple_Slideshow
 * @subpackage Simple_Slideshow/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Simple_Slideshow
 * @subpackage Simple_Slideshow/admin
 * @author     Flávia Amaral <flavia.programadora@gmail.com>
 */
class Simple_Slideshow_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $simple_slideshow;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $simple_slideshow, $version ) {

		$this->simple_slideshow = $simple_slideshow;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Simple_Slideshow_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Simple_Slideshow_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->simple_slideshow, plugin_dir_url( __FILE__ ) . 'css/simple-slideshow-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Simple_Slideshow_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Simple_Slideshow_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->simple_slideshow, plugin_dir_url( __FILE__ ) . 'js/simple-slideshow-admin.js', array( 'jquery' ), $this->version, false );

	}



	public function add_simple_slideshow_meta_boxes() {

		add_meta_box( 'simple_slideshow_meta_box',
			__( 'Imagem', $this->simple_slideshow ),
			array( $this, 'render_simple_slideshow_meta_box' ),
			'simple-slideshow',
			'normal',
			'high'
		);
	}

	public function render_simple_slideshow_meta_box( $post ) {

		$this->render_nonce_field( 'simple-slideshow-meta-box' );

		$simple_slideshow_image_src = get_post_meta( $post->ID, 'simple-slideshow-image', true );

		require 'partials/simple-slideshow-meta-box.php';
	}

	public function save_simpleslideshow_meta( $post_id ) {
		$this->save_simple_slideshow_meta_box( $post_id );
	}

	# HELPERS

	/**
	 * A helper function for creating and rendering a nonce field.
	 *
	 * @param   $nonce_label  string  An internal (shorter) nonce name
	 */
	private function render_nonce_field( $nonce_label ) {
		$nonce_field_name = $this->simple_slideshow . '_' . $nonce_label . '_nonce';
		$nonce_name       = $this->simple_slideshow . '_' . $nonce_label;

		wp_nonce_field( $nonce_name, $nonce_field_name );
	}

	/**
	 * A helper function for checking the product meta box nonce.
	 *
	 * @param   $nonce_label string  An internal (shorter) nonce name
	 *
	 * @return  mixed   False if nonce is not OK. 1 or 2 if nonce is OK (@see wp_verify_nonce)
	 */
	private function is_nonce_ok( $nonce_label ) {
		$nonce_field_name = $this->simple_slideshow . '_' . $nonce_label . '_nonce';
		$nonce_name       = $this->simple_slideshow . '_' . $nonce_label;

		if ( ! isset( $_POST[ $nonce_field_name ] ) ) {
			return false;
		}

		$nonce = $_POST[ $nonce_field_name ];

		return wp_verify_nonce( $nonce, $nonce_name );
	}


	private function save_simple_slideshow_meta_box( $post_id ) {
		if ( ! $this->is_nonce_ok( 'simple-slideshow-meta-box' ) ) {
			return $post_id;
		}

		// Ignore auto saves
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		// Check the user's permissions
		if ( ! current_user_can( 'edit_posts', $post_id ) ) {
			return $post_id;
		}

		if ( ! empty( $_FILES ) && isset( $_FILES[ 'simple-slideshow-image' ] ) && ! empty( $_FILES[ 'simple-slideshow-image' ][ 'name' ] ) ) {
			$image_data = file_get_contents( $_FILES[ 'simple-slideshow-image' ][ 'tmp_name' ] );
			$image_file = wp_upload_bits( $_FILES[ 'simple-slideshow-image' ][ 'name' ], null, $image_data );
			if ( false == $image_file[ 'error' ] ) {
				update_post_meta( $post_id, 'simple-slideshow-image', $image_file[ 'url' ] );
			}
		}
	}

	public function allow_image_upload() {
		echo 'enctype="multipart/form-data"';
	}

}
