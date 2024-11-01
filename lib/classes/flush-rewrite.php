<?php 
class Wz_Flush_Rewrite {
	
	function Wz_Flush_Rewrite() {
		$this->__construct();
	}

	function __construct(){
		add_action('init', array(&$this, '_check_rewrite'));
	}

	function _check_rewrite() {
		
		global $wz_version;

		$wz_info = get_option('wzinfo');

		if ( $wz_version > $wz_info['version'] || false == $wz_info['rewrites_flushed']  ) {
			
			$wz_info = array(
				'version' => (int) $wz_version,
				'rewrites_flushed' => (bool) 1
			);


			update_option('wzinfo', $wz_info);

			self::_flush_rewrite();
		

		}

	}

	static public function _flush_rewrite() {



		global $wp_rewrite;
		$wp_rewrite->flush_rules();

	}


}