<?php
/**
 * DLTB Theme Functions
 */

// Theme setup
function dltb_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption' ) );
    add_theme_support( 'custom-logo' );
    add_theme_support( 'responsive-embeds' );

    // Register navigation menu
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'dltb' ),
    ) );
}
add_action( 'after_setup_theme', 'dltb_setup' );

// Enqueue scripts and styles
function dltb_scripts() {
    // Enqueue main stylesheet
    wp_enqueue_style( 'dltb-style', get_stylesheet_uri(), array(), '1.0' );

    // Google Fonts
    wp_enqueue_style( 'dltb-fonts', 'https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400;1,700&family=Outfit:wght@300;400;500;600&display=swap', array(), null );

    // Font Awesome
    wp_enqueue_style( 'dltb-fa', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css', array(), '6.0.0' );

    //wp_enqueue_script('jquery');

    // Custom JS
    wp_enqueue_script( 'dltb-theme-js', get_template_directory_uri() . '/js/theme.js', array('jquery'), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'dltb_scripts' );

// Allow SVG upload (optional)
function dltb_mime_types( $mimes ) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter( 'upload_mimes', 'dltb_mime_types' );

// Custom walker to add dropdown markup
class DLTB_Walker_Nav_Menu extends Walker_Nav_Menu {
    function start_lvl( &$output, $depth = 0, $args = null ) {
        $indent = str_repeat( "\t", $depth );
        $output .= "\n$indent<ul class=\"dropdown\">\n";
    }

    function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        if ( $args->walker->has_children ) {
            $classes[] = 'has-dropdown';
        }

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        $output .= $indent . '<li' . $class_names .'>';

        $atts = array();
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
        $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
        $atts['href']   = ! empty( $item->url )        ? $item->url        : '';

        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $title = apply_filters( 'the_title', $item->title, $item->ID );
        $title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . $title . $args->link_after;
        if ( $args->walker->has_children ) {
            $item_output .= ' <span class="chevron">▼</span>';
        }
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}