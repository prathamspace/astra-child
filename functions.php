<?php
/**
 * Astra Child Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Astra Child
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define('CHILD_THEME_ASTRA_CHILD_VERSION', '1.0.0');

/**
 * Enqueue styles
 */
function child_enqueue_styles()
{

	wp_enqueue_style('astra-child-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all');

}

add_action('wp_enqueue_scripts', 'child_enqueue_styles', 15);


add_filter('tutor_student_registration_required_fields', 'required_youtube_link_callback');
if (!function_exists('required_youtube_link_callback')) {
    function required_youtube_link_callback($atts)
    {
        $atts['youtube_link'] = 'YouTube Link field is required';
        return $atts;
    }
}

add_action('user_register', 'add_youtube_link_after_user_register');
add_action('profile_update', 'add_youtube_link_after_user_register');
if (!function_exists('add_youtube_link_after_user_register')) {
    function add_youtube_link_after_user_register($user_id)
    {
        if (!empty($_POST['youtube_link'])) {
            $youtube_link = esc_url($_POST['youtube_link']);
            update_user_meta($user_id, 'youtube_link', $youtube_link);
        }
    }
}