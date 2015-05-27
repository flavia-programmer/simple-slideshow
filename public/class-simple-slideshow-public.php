<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       www.flaviaamaral.com.br
 * @since      1.0.0
 *
 * @package    Simple_Slideshow
 * @subpackage Simple_Slideshow/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Simple_Slideshow
 * @subpackage Simple_Slideshow/public
 * @author     Flávia Amaral <flavia.programadora@gmail.com>
 */
class Simple_Slideshow_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $simple_slideshow, $version ) {

		$this->simple_slideshow = $simple_slideshow;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->simple_slideshow, plugin_dir_url( __FILE__ ) . 'css/simple-slideshow-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_script( $this->simple_slideshow, plugin_dir_url( __FILE__ ) . 'js/simple-slideshow-public.js', array( 'jquery' ), $this->version, false );

	}

	public function add_simple_slideshow_post_type() {
		register_post_type( 'simple-slideshow',
			array(
				'labels'      => array(
					'name'               => __( 'Simple Slideshow', $this->simple_slideshow ),
					'singular_name'      => __( 'Simple Slideshow', $this->simple_slideshow ),
					'menu_name'          => __( 'Simple Slideshow', $this->simple_slideshow ),
					'name_admin_bar'     => __( 'Simple Slideshow', $this->simple_slideshow ),
					'add_new'            => __( 'Add New', $this->simple_slideshow ),
					'add_new_item'       => __( 'Add Simple Slideshow', $this->simple_slideshow ),
					'edit_item'          => __( 'Edit Simple Slideshow', $this->simple_slideshow ),
					'new_item'           => __( 'New Simple Slideshow', $this->simple_slideshow ),
					'view_item'          => __( 'View Simple Slideshow', $this->simple_slideshow ),
					'search_item'        => __( 'Search Simple Slideshow', $this->simple_slideshow ),
					'not_found'          => __( 'Not Found ', $this->simple_slideshow ),
					'not_found_in_trash' => __( 'Not found in Trash', $this->simple_slideshow ),
					'all_items'          => __( 'All Simple Slideshow', $this->simple_slideshow ),
				),
				'public'      => true,
				'has_archive' => true,
				'supports'    => array( 'title'),
				'rewrite'     => array( 'slug' => 'simple-slideshow' ),
				'menu_icon'   => 'dashicons-images-alt2',
			)
		);
	}

}
