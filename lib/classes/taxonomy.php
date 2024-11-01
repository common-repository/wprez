<?php 

class Wz_Taxonomy {
	
	function WZ_Taxonomy() {
		$this->__construct();
	}

	function __construct(){
		add_action('init', array(&$this, '_register_taxonomy'));
	}

	function _register_taxonomy() {

		$post_type1 = Wz_Post_Type::$post_type1;


		
		register_taxonomy( 'tag', 
	    	array( $post_type1 ), //the post type(s) to register to, by default just one
	    	array( 'hierarchical' => false,                  
	    		'labels' => self::_helper_taxonomy_labels('tag', 'tagz'),
	    		'show_ui' => true,
	    		'query_var' => true,
	    		'rewrite' => array(
	    			'slug' => 'artist',
	    			'with_front' => false
	    		)
	    	)
	    );

	}

	static function _helper_taxonomy_labels( $singular, $plural = false, $args = array() ) {

		if (false === $plural)			$plural = $singular . 's'; 
		else  							$plural = $singular;
		
		$defaults = array(
			'name'			  		=>_x( $plural,'taxonomy generic name' ),
			'singular_name'		  	=>_x( $singular,'taxonomy singular name' ), 
			'search_items'		  	=>__( "Search $plural" ),
			'all_items'		  		=>_x( 'All',$plural ),
			'add_new_item'		  	=>__( "Add New $singular" ),
			'parent_item'			=>__( "Parent $singular" ),
			'parent_item_colon' 	=>__( 'Parent $singular:' ), /* parent taxonomy title */
			'edit_item'		  		=>__( "Edit $singular" ),
			'update_item'		  	=>__( "New $singular" ),
			'new_item_name'		  	=>__( "New $singular Name" ),

		); 
		return wp_parse_args( $args, $defaults );

	}

}