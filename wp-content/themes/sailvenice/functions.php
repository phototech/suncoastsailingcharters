<?php 

	if ( ! isset( $content_width ) )
	$content_width = 740;
	
	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );
	
	// Reister the Menus
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'sailvenice' ),
		'secondary' => __( 'Secondary Navigation', 'sailvenice' ),
	) );
