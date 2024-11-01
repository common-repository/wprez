<?php



class Wz_Post_Type {
	
	function Wz_Post_Type() {
		$this->__construct();
	}

	public static $post_type1 = 'wprez'; 

	function __construct(){
		add_action('init', array(&$this, '_register_post_type'));
	}

	/*
	make our post type a variable that we can use elsewhere in case we want to change it later for whatever reason
	*/
	

	function _register_post_type() {

		//wp_die(var_dump($post_type1));

		register_post_type( self::$post_type1  ,array( 
	        'labels'    => self::_helper_post_type_labels(self::$post_type1, self::$post_type1 . 'es' ),
	        'description' => __( 'WPrez' ), /* Custom Type Description */
	        'public' => true,
	        'publicly_queryable' => true,
	        'exclude_from_search' => true,
	        'show_ui' => true,
	        'query_var' => true,
	        'menu_position' => 4, 
	        //'menu_icon' => $wz_libdir . 'images/impressjsforwp.png',
	        'rewrite' => array('slug' => 'presentation', 'with_front' => false ),
	        'capability_type' => 'post',
	        'hierarchical' => false,
	        'has_archive' => true,
	        /* the next one is important, it tells what's enabled in the post editor */
	        'supports' => array( 'title', 'author', 'thumbnail', 'revisions', 'editor'))
	    );
	}

	static function _helper_post_type_labels( $singular, $plural = false, $args = array() ) {

		if (false === $plural)			$plural = $singular . 's'; 
		else  							$plural = $singular;
		
		$defaults = array(
			'name'			  		=>_x( $plural,'post type generic name' ),
			'singular_name'		  	=>_x( $singular,'post type singular name' ), 
			'add_new'		  		=>_x( 'Add New',$singular ),
			'add_new_item'		  	=>__( "Add New $singular" ),
			'edit_item'		  		=>__( "Edit $singular" ),
			'new_item'		  		=>__( "New $singular" ),
			'view_item'		  		=>__( "View $singular" ), 
			'search_items'		  	=>__( "Search $plural" ),
			'not_found'		  		=>__( "No $plural Found" ),
			'not_found_in_trash'	=>__( "No $plural Found in Trash" ),
			'parent_item_colon' 	=>'',
		); 
		return wp_parse_args( $args, $defaults );

	}
}