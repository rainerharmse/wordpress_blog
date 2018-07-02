<?php

/*
==========================================
 Class includes
==========================================
*/
include_once(get_template_directory_uri(). '/classes/rainer_custom_functions.php');

function use_rainer_class($name){
    $rainer = new rainer_custom_functions($name);
    $rainer.say_hello();

}

/*
	==========================================
	 Include scripts
	==========================================
*/
function rainerharmse_script_enqueue() {
    //css
//    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.4', 'all');
    wp_enqueue_style('particlescss', get_template_directory_uri() . '/css/particles.css', array(), '1.0.0', 'all');
    wp_enqueue_style('mainstyle', get_template_directory_uri() . '/css/style.css', array(), '1.0.0', 'all');
    wp_enqueue_style('fontawesome', get_template_directory_uri() . '/css/fa-svg-with-js.css', array(), '1.0.0', 'all');
    //js

    wp_enqueue_script('jquery');
//    wp_enqueue_script('bootstrapjs', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '3.3.4', true);
    wp_enqueue_script('particlesminjs', get_template_directory_uri() . '/js/particles.min.js', array(), '3.3.4', true);
    wp_enqueue_script('particlesjs', get_template_directory_uri() . '/js/my-particles.js', array(), '3.3.4', true);
    wp_enqueue_script('fontawesomejs', get_template_directory_uri() . '/js/fontawesome-all.min.js', array(), '1.0.0', true);
    wp_enqueue_script('tagcanvasjs', get_template_directory_uri() . '/js/jquery.tagcanvas.min.js', array(), '1.0.0', true);
    wp_enqueue_script('mainjs', get_template_directory_uri() . '/js/main.js', array(), '1.0.0', true);

}

add_action( 'wp_enqueue_scripts', 'rainerharmse_script_enqueue');

// Update CSS within in Admin
function admin_style() {
    wp_enqueue_style('admin-styles', get_template_directory_uri().'/css/admin.css');
}

add_action('admin_enqueue_scripts', 'admin_style');



/*
	==========================================
	 Activate menus
	==========================================
*/
function rainerharmse_theme_setup() {

    add_theme_support('menus');

    register_nav_menu('primary', 'Primary Header Navigation');
//    register_nav_menu('secondary', 'Footer Navigation');

}

add_action('init', 'rainerharmse_theme_setup');

/*
	==========================================
	 Theme support function
	==========================================
*/
add_theme_support('custom-background');
add_theme_support('custom-header');
add_theme_support('post-thumbnails');
add_theme_support('post-formats',array('aside','image','video'));


