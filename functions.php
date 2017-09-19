<?php
function fotoartevideo_script_enqueue() {
	wp_enqueue_style('customstyle', get_template_directory_uri() . '/css/fotoartevideo.css', array(), '1.0', 'all');
	wp_enqueue_style('customstyle', 'http://fonts.googleapis.com/css?family=Josefin+Sans:300,400', array(), '', 'all');
	wp_enqueue_script('custom-script', get_template_directory_uri() . '/js/fotoartevideo.js', array(), '1.0', true);
}
add_action('wp_enqueue_scripts', 'fotoartevideo_script_enqueue');
function fotoartevideo_theme_setup(){
	add_theme_support('menus');
	register_nav_menu('primary','main menu');
	register_nav_menu('social','social menu');
}
add_action('init', 'fotoartevideo_theme_setup');
add_theme_support( 'title-tag' );	/*=== document title ===*/
add_theme_support('custom-header');
add_theme_support('custom-background');
add_theme_support('post-thumbnails');	/*=== post thumbnails in post and pages ===*/
set_post_thumbnail_size( 825, 510, true );

add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption') );
add_theme_support( 'post-formats', array('image', 'video', 'gallery' ) );
add_theme_support( 'automatic-feed-links' );	/*=== add default posts and comments rss feed links to head ===*/
add_theme_support( 'editor_style');
load_theme_textdomain( 'fotoartevideo', get_template_directory() . '/languages' ); /*=== translations ===*/

/*=== sidebar ===*/
function fotoartevideo_widget_setup() {
	register_sidebar(
		array(
			'name' => 'Sidebar',
			'id' => 'sidebar-1',
			'class' => 'custom',
			'description' => 'Standard Sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '',
			'after_title'   => '',
		)
	);	
}
add_action('widgets_init','fotoartevideo_widget_setup');

/*=== favicon ===*/
function favicon_link() {
    echo '<link rel="shortcut icon" type="image/x-icon" href="', get_stylesheet_directory_uri() . '/ico/favicon.ico" />'. "\n";
}
add_action( 'wp_head', 'favicon_link' );

/*=== home title ===*/
add_filter( 'wp_title', 'baw_hack_wp_title_for_home' );
function baw_hack_wp_title_for_home( $title )
{
  if( empty( $title ) && ( is_home() || is_front_page() ) ) {
    return __( '' ) . ' | ' . get_bloginfo( 'description' );
  }
  return $title;
}

/*=== content width ===*/
if ( ! isset( $content_width ) ) {
	$content_width = 1000;
}

/*=== google fonts ===*/
function wpb_add_google_fonts() {
wp_enqueue_style( 'wpb-google-fonts', 'http://fonts.googleapis.com/css?family=Josefin+Sans:300,400', false ); 
}
add_action( 'wp_enqueue_scripts', 'wpb_add_google_fonts' );

/*=== comments reply ===*/
if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

function fotoartevideo_enqueue_comments_reply() {
if( get_option( 'thread_comments' ) ) {
wp_enqueue_script( 'comment-reply' );
}
}
add_action( 'comment_form_before', 'fotoartevideo_enqueue_comments_reply' );

/*=== editor styles ===*/
function fotoartevideo_add_editor_styles() {
    add_editor_style( 'custom-editor-style.css' );
}
add_action( 'admin_init', 'fotoartevideo_add_editor_styles' );


