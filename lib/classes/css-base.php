<?php 
class Wz_CSS_Base {

	function Wz_CSS_Base() {
		$this->__construct();
	}

	function __construct(){
		add_action('init', array(&$this, '_register_css'));
		add_action('wp_print_styles', array(&$this, '_enqueue_css'));
		add_action('wp_footer', array(&$this, '_override_css'));
	}

	function _register_css() {
		
		global $wz_liburl, $wz_version;

		wp_register_style('impress-css', $wz_liburl . 'css/impress.css', array(), $wz_version);


	}

 	function _enqueue_css() {

		global $post_type1;

	 	if( is_singular( Wz_Post_Type::$post_type1 ) )
	 		wp_enqueue_style('impress-css');
	}

	function _override_css() {
		
		$wz_info = get_option('wzinfo');

		if ( !is_singular( Wz_Post_type::$post_type1 ) || isset($wz_info['override_css']))
			return;

		?><style>
		/*reset parent elements*/
		.impress-parent{
			background:none!important;
			border:none!important;
			box-shadow:none!important;
		}
		</style>
		<?php
	}

}