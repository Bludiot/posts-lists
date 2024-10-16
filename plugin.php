<?php
/**
 * Posts Lists
 *
 * Plugin core class, do not namespace.
 *
 * Improved posts plugin for Bludit CMS.
 *
 * @package    Posts Lists
 * @subpackage Core
 * @since      1.0.0
 */

// Stop if accessed directly.
if ( ! defined( 'BLUDIT' ) ) {
	die( 'You are not allowed direct access to this file.' );
}

// Access namespaced functions.
use function PostLists\{
	sidebar_list
};

class Posts_Lists extends Plugin {

	/**
	 * Constructor method
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {

		// Run parent constructor.
		parent :: __construct();

		// Include functionality.
		if ( $this->installed() ) {
			$this->get_files();
		}
	}

	/**
	 * Prepare plugin for installation
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function prepare() {
		$this->get_files();
	}

	/**
	 * Include functionality
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function get_files() {

		// Plugin path.
		$path = PATH_PLUGINS . 'posts-lists' . DS;

		// Get plugin functions.
		foreach ( glob( $path . 'includes/*.php' ) as $filename ) {
			require_once $filename;
		}
	}

	/**
	 * Initiate plugin
	 *
	 * @since  1.0.0
	 * @access public
	 * @global object $L Language class.
	 * @return void
	 */
	public function init() {

		// Access global variables.
		global $L;

		$this->dbFields = [
			'in_sidebar'   => true,
			'label'        => $L->get( 'Posts' ),
			'label_wrap'   => 'h2',
			'list_items'   => 7,
			'show_dates'   => 'show',
			'date_display' => 'headings',
			'date_code'    => 'F Y'
		];

		if ( ! $this->installed() ) {
			$Tmp = new dbJSON( $this->filenameDb );
			$this->db = $Tmp->db;
			$this->prepare();
		}
	}

	/**
	 * Admin settings form
	 *
	 * @since  1.0.0
	 * @access public
	 * @global object $L Language class.
	 * @global object $plugin Plugin class.
	 * @global object $site Site class.
	 * @return string Returns the markup of the form.
	 */
	public function form() {

		// Access global variables.
		global $L, $plugin, $site;

		$html  = '';
		ob_start();
		include( $this->phpPath() . '/views/page-form.php' );
		$html .= ob_get_clean();

		return $html;
	}

	/**
	 * Admin info pages
	 *
	 * @since  1.0.0
	 * @access public
	 * @global object $L Language class.
	 * @global object $site Site class.
	 * @return string Returns the markup of the page.
	 */
	public function adminView() {

		// Access global variables.
		global $L, $site;

		$html  = '';
		ob_start();
		include( $this->phpPath() . '/views/page-guide.php' );
		$html .= ob_get_clean();

		return $html;
	}

	/**
	 * Head section
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Returns the head content.
	 */
	public function siteHead() {

		// Plugin path.
		$path = PATH_PLUGINS . 'posts-lists' . DS;

		// Look for stylesheet.
		$css   = $path . 'assets/css/frontend.min.css';
		$js    = $path . 'assets/js/frontend.min.js';
		$html = null;

		if ( file_exists( $css ) ) {
			$html .= "\n";
			$html .= sprintf(
				'<style>%s</style>',
				file_get_contents( $css )
			);
			$html .= "\n";
		}
		if ( file_exists( $js ) ) {
			$html .= "\n";
			$html .= sprintf(
				'<script>%s</script>',
				file_get_contents( $js )
			);
			$html .= "\n";
		}
		return $html;
	}

	/**
	 * Sidebar list
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Returns the form markup.
	 */
	public function siteSidebar() {

		if ( $this->in_sidebar() ) {
			return sidebar_list();
		}
		return false;
	}

	/**
	 * Option return functions
	 *
	 * @since  1.0.0
	 * @access public
	 */

	// @return boolean
	public function in_sidebar() {
		return $this->getValue( 'in_sidebar' );
	}

	// @return string
	public function label() {
		return $this->getValue( 'label' );
	}

	// @return string
	public function label_wrap() {
		return $this->getValue( 'label_wrap' );
	}

	// @return integer
	public function list_items() {
		return $this->getValue( 'list_items' );
	}

	// @return string
	public function show_dates() {
		return $this->getValue( 'show_dates' );
	}

	// @return string
		public function date_display() {
		return $this->getValue( 'date_display' );
	}

	// @return string
	public function date_code() {
		return $this->getValue( 'date_code' );
	}
}
