<?php

require_once 'app/mix.php';

function githubjobs_load_style( $filename ){
    wp_enqueue_style( "{$filename}-style", get_theme_file_uri( mix( "/dist/css/{$filename}.css" ) ), array( 'style' ) );
}

function githubjobs_load_script( $filename ){
    wp_enqueue_script( "{$filename}-script", get_theme_file_uri(  "/dist/js/{$filename}.js" ), array( 'jquery' ), '1.0', true );
}

function githubjobs_get_image( $filename ){
    return get_theme_file_uri( '/dist/img/' . $filename );
}

function debug($var){
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
}

function githubjobs_setup() {
	add_theme_support( 'title-tag' );
	register_nav_menus(
		array(
			'menu'   => 'Menu Principal',
			'footer' => 'Rodapé Principal'
		)
	);
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5' );
}

add_action( 'after_setup_theme', 'githubjobs_setup' );


/**
 * Enqueue scripts and styles.
 */
function githubjobs_scripts() {
	try{
		// githubjobs_ stylesheet.
		wp_enqueue_style( 'main-style', get_theme_file_uri( mix( '/dist/css/main.css' ) ) );

		// githubjobs_ javascripts.
		wp_enqueue_script( 'main-script', get_theme_file_uri(  mix( '/dist/js/main.js' ) ), array( 'jquery' ), '1.0', true );
	} catch(Exception $e) {
		echo $e->getMessage();
	}
}
add_action( 'wp_enqueue_scripts', 'githubjobs_scripts' );

function custom_post_type() {
	register_post_type('jobs',
        array(
            'labels'      => array(
                'name'          => __( 'Jobs', 'textdomain' ),
                'singular_name' => __( 'Jobs', 'textdomain' ),
            ),
            'public'      => true,
            'has_archive' => true,
            'rewrite'     => array( 'slug' => 'jobs' ),
            'supports' => array( 'title', 'editor', 'thumbnail',)
        )
	);
}
add_action('init', 'custom_post_type');

register_taxonomy( 'cities', array('jobs'), array(
    'hierarchical' => true, 
    'label' => 'Cities', 
    'singular_label' => 'City',
    'rewrite' => array( 'slug' => 'cities', 'with_front'=> false )
    )
);

register_taxonomy_for_object_type( 'cities', 'jobs' );

register_taxonomy( 'times', array('jobs'), array(
    'hierarchical' => true, 
    'label' => 'Time', 
    'singular_label' => 'Time',
    'rewrite' => array( 'slug' => 'times', 'with_front'=> false )
    )
);

register_taxonomy_for_object_type( 'times', 'jobs' );

/* Function which displays your post date in time ago format */
function meks_time_ago() {
	return human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ).' '.__( 'ago' );
}
