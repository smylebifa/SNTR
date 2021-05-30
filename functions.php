<?php
function ameya_css() {
	$parent_style = 'conceptly-parent-style';
	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'ameya-style', get_stylesheet_uri(), array( $parent_style ));
	
	wp_enqueue_style('ameya-color-default',get_stylesheet_directory_uri() .'/assets/css/colors/default.css');
	wp_dequeue_style('conceptly-color-default');
	
	wp_enqueue_style('ameya-responsive',get_stylesheet_directory_uri().'/assets/css/responsive.css');
	wp_dequeue_style('conceptly-responsive');
	wp_dequeue_style('conceptly-fonts');

}
add_action( 'wp_enqueue_scripts', 'ameya_css',999);
   	

function ameya_setup()	{	

	add_theme_support( 'custom-header', apply_filters( 'ameya_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => 'ffffff',
		'width'                  => 2000,
		'height'                 => 200,
		'flex-height'            => true,
		'wp-head-callback'       => 'conceptly_header_style',
	) ) );
	
	add_editor_style( array( 'assets/css/editor-style.css', ameya_google_font() ) );
}
add_action( 'after_setup_theme', 'ameya_setup' );
	
/**
 * Register Google fonts for StartBiz.
 */
function ameya_google_font() {
	
   $get_fonts_url = '';
		
    $font_families = array();
 
	$font_families = array('Open Sans:300,400,600,700,800', 'Raleway:400,700');
 
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 
        $get_fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );

    return $get_fonts_url;
}

function ameya_scripts_styles() {
    wp_enqueue_style( 'ameya-fonts', ameya_google_font(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'ameya_scripts_styles' );

function ameya_remove_parent_setting( $wp_customize ) {
	$wp_customize->remove_control('hide_show_breadcrumb');
}
add_action( 'customize_register', 'ameya_remove_parent_setting',99 );

require( get_stylesheet_directory() . '/template-parts/sections/section-blog.php');

/**
 * Called all the Customize file.
 */
require( get_stylesheet_directory() . '/inc/customize/ameya-premium.php');


/**
 * Import Options From Parent Theme
 *
 */
function ameya_parent_theme_options() {
	$conceptly_mods = get_option( 'theme_mods_conceptly' );
	if ( ! empty( $conceptly_mods ) ) {
		foreach ( $conceptly_mods as $conceptly_mod_k => $conceptly_mod_v ) {
			set_theme_mod( $conceptly_mod_k, $conceptly_mod_v );
		}
	}
}
add_action( 'after_switch_theme', 'ameya_parent_theme_options' );


// Отображаем определенное меню для зарегистрированных и не зарегистрированнных пользователей...
function my_wp_nav_menu_args( $args = '' ) {
 
if( is_user_logged_in() ) {
$args['menu'] = 'Menu for registered users';
} else {
$args['menu'] = 'Menu';
}
return $args;
}
add_filter( 'wp_nav_menu_args', 'my_wp_nav_menu_args' );


function logout_page() {  
    $login_page  = home_url( '/' );  
    wp_redirect( $login_page );  
    exit;  
}  
add_action('wp_logout','logout_page');