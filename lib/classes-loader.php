<?php


//setup our post type
require_once ( $wz_libdir . 'classes/post-type.php' );
new WZ_Post_Type();

//set up our taxonomy
require_once ( $wz_libdir . 'classes/taxonomy.php' );
new WZ_Taxonomy();

require_once ( $wz_libdir . 'classes/flush-rewrite.php' );
new WZ_Flush_Rewrite();

//if nobody else is using WPAlchemy then include it
if(!class_exists('WPAlchemy_MetaBox'))
	require_once ( $wz_libdir . 'externals/MetaBox.php' );

if(!class_exists('WPAlchemy_MediaAccess'))
	require_once( $wz_libdir . 'externals/MediaAccess.php' );

	$wpalchemy_media_access = new WPAlchemy_MediaAccess();

			$post_type1 = Wz_Post_Type::$post_type1;

		$wz_metaboxes1 = new WPAlchemy_MetaBox(array(
		    		'id' => 'wz',
		    		'title' => 'Steps',
		    		'template' => $wz_libdir . 'classes/metabox.php', 
					'types' => array( $post_type1 ),
					'context' => 'advanced',
					'priority' => 'high',
					'lock' => WPALCHEMY_LOCK_TOP,
					// 'view' => WPALCHEMY_VIEW_START_CLOSED
		));


//setup our filters
require_once ( $wz_libdir . 'classes/filters.php' );
new WZ_Filters();

//setup our js
require_once ( $wz_libdir . 'classes/js-base.php' );
new WZ_Js_Base();

//set up our css
require_once ( $wz_libdir . 'classes/css-base.php' );
new WZ_Css_Base();

require_once ( $wz_libdir . 'classes/admin-extras.php' );
if ( is_admin() )
	new WZ_Admin_Extras();






