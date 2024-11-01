<?php 
class Wz_Filters {
	
	function Wz_Filters() {
		$this->__construct();
	}

	function __construct(){
		add_filter('body_class', array(&$this, '_body_class'));
		add_filter('post_class', array(&$this, '_post_class'));
		add_action('the_content', array(&$this, '_after_content'), 50);
		//add_action('init', array(&$this, '_short_wp_themes'));
	}

	function _body_class($classes) {


 		$post_type1 = Wz_Post_type::$post_type1;

		if( is_single() && is_singular( $post_type1 ) )
			$classes[] = 'impress-not-supported';
		return $classes;
	}

	function _post_class($classes){
		$classes[] = 'first-step';
		return $classes;
	}

 	function _after_content($content) {

 		$post_type1 = Wz_Post_type::$post_type1;
 		
 		if( is_singular( $post_type1 ) && in_the_loop() ) { 

			echo self::_get_stepshow(); 			

 		}

 		return $content;

	}

	private static function _get_stepshow( $args = array() ) { 

		$defaults = array(
			'return_html' => false,
		);

		$args = wp_parse_args( $args, $defaults );


		$markup  = '<div id="impress-wrap" class="impressive"><div class="fallback-message"><p>Your browser <b>doesn\'t support the features required</b> by this presentation, so you are presented with a simplified version of this presentation.</p><p>For the best experience please use the latest <b>Chrome</b>, <b>Safari</b> or <b>Firefox</b> browser.</p></div>';
		$markup .= '<div id="impress">';
		$markup .= self::_get_steps( $args ); //the right way
		$markup .= '</div>';
		$markup .= '<div class="hint"><p>Use arrow keys to navigate</p></div></div>';

		return $markup;

	}

	public static function _get_steps( $args = array() ){

		$defaults = array();

		$args = wp_parse_args( $args, $defaults );

		return self::_get_steps_cached($args);

	}

	private static function _get_steps_cached( $args = array() ) {

		$defaults = array();

		$args = wp_parse_args( $args, $defaults );

		global $post;

		$wprez = get_post_meta($post->ID , 'wz', true);

		if(empty($wprez))
			return;

		$steps = $wprez['steps'];

		if( is_array($steps) ) {

			$stepsToCache = '';

			$stepsToCache .= self::_get_each_step( $steps );

		} else {

			$stepsToCache = self::_get_single_step( $steps, '1' );

		}

		return $stepsToCache;

	}

	private static function _get_each_step($steps, $args = array() ) {

		if(!is_array($steps))
			return false;
		else {
			$stepContent = '';

			foreach ($steps as $step => $stepNo) {
				$stepContent .= self::_get_single_step( $step, $stepNo );
			}

			return $stepContent;
		}

	}

	private static function _get_single_step( $stepNo, $step,  $args = array() ) {


		$count = $stepNo;

		$id = (empty($step['stepid'])) ? 'step' . $count : esc_attr( $step['stepid'] );

		//$title = (empty($step['steptitle'])) ? '' : '<h1>' . $step['steptitle'] . '</h1>'; //internal use only ??
		$content = (empty($step['stepcontent'])) ? '' : wpautop( $step['stepcontent'] ) ;

		$stepType = (empty($step['type'])) ? 'step' : esc_attr( $step['type'] );
		
		$stepXpos = (empty($step['xpos'])) ?  $count * 100 : esc_attr( $step['xpos'] );
		$stepYpos = (empty($step['ypos'])) ?  '': esc_attr( $step['ypos'] );
		$stepZpos = (empty($step['zpos'])) ?  '' : esc_attr( $step['zpos'] );

		$stepScale = (empty($step['scale'])) ?  '1' : esc_attr( $step['scale'] );
		
		$stepRotation = (empty($step['rotate'])) ? '0' : esc_attr( $step['rotate'] );

		$stepRotateY = (empty($step['yrotate'])) ? '0' : esc_attr( $step['yrotate'] );
		$stepRotateX = (empty($step['xrotate'])) ? '0' : esc_attr( $step['xrotate'] );


		return sprintf ('<div id="%s" class="%s" data-x="%s" data-y="%s" data-z="%s" data-scale="%s" data-rotate="%s" data-rotate-x="%s" data-rotate-y="%s">%s%s</div>', 
			$id, $stepType, $stepXpos, $stepYpos, $stepZpos, $stepScale, $stepRotation, $stepRotateX, $stepRotateY, $title, $content);
	}

}