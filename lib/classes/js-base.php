<?php 

class Wz_Js_Base {
	
	function Wz_Js_Base() {
		$this->__construct();
	}

	function __construct(){
		add_action('init', array(&$this, '_register_js'));
		add_action('wp_print_scripts', array(&$this, '_enqueue_js'), 10);
		add_action('wp_footer', array(&$this, '_call_js'), 10);//call our JS function dead last so that we can be sure to hide everything...
	}

	function _register_js() {
		if ( is_admin() )
			return;

		global $wz_liburl, $wz_version;

		wp_register_script('impress-js', $wz_liburl . 'js/impress.js', array('jquery'), $wz_version, true);

	}

 	function _enqueue_js() { 
		if ( is_admin() )
			return;

 		$post_type1 = WZ_Post_Type::$post_type1;

	 	if( is_singular( $post_type1 ) )
	 		
	 		wp_enqueue_script('impress-js');

	}

	function _call_js(){ 
		if ( is_admin() )
			return;

		$post_type1 = WZ_Post_Type::$post_type1;

		if(  !is_singular( $post_type1 ) || is_admin() )
			return false;
			?>
			<script type="text/javascript">
				//<[CDATA[
				if ("ontouchstart" in document.documentElement) { 
				    document.querySelector(".hint").innerHTML = "<p>Tap on the left or right to navigate</p>";
				}
				//]]>>
			</script>
			
			<script type="text/javascript">
				//<[CDATA[
				jQuery(document).ready(function($){
					$('body.admin-bar').css('margin-top' , '-28px');
					$('body').css('padding', '5%');
					$('#impress').show().parentsUntil('body').andSelf().siblings().hide();
					$('#impress-wrap').parentsUntil('body').addClass('impress-parent');
					impress().init();
				});

				//]]>>
			</script>





	<?php }

}