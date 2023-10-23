<?php
/**
 * Make Function Pluggable
 *
 * Child Theme can have a function with the same name
 * That function can override this function
 * If the function does not exist use this function
 * Otherwise do nothing the function already exists
 */
if ( ! function_exists( 'darksky_after_setup_theme' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function darksky_after_setup_theme() {

          // Let WordPress manage the document title.
          add_theme_support( 'title-tag' );

          // Allow admin users add Featured Images
          add_theme_support( 'post-thumbnails' );

          // Define sizes for Featured Images
          add_image_size( 'card-small', 480, 270, true );
          add_image_size( 'card-tall', 600, 800, true );
          add_image_size( 'card-large', 1200, 800, true );

          // Output HTML5 style HTML
          add_theme_support( 'html5', array(
               'caption',
               'comment-form',
               'comment-list',
               'gallery',
               'search-form',)
          );


          // Register Navigation Menus.
          register_nav_menus(
               array(
                'nav-main-header-top' => 'Main Nav, Top of Header',
                'nav-footer' => 'Footer Nav, Lower Footer'
               )
          );

          // Register Enqueue CSS Files
          function darksky_enqueue_styles() {

            // wp_enqueue_style( Handle     , Path to File                           , Dependencies ['handle'] , Version Number                , CSS Media Type )
              wp_enqueue_style('darksky-style', get_template_directory_uri() . '/style.css', [] , wp_get_theme()->get('Version'), 'all');

          }
          add_action('wp_enqueue_scripts', 'darksky_enqueue_styles');


          // Pagination function.
          function darksky_paginate() {
             global $paged, $wp_query;
             $abignum = 999999999; //we need an unlikely integer
             $args = array(
                  'base' => str_replace( $abignum, '%#%', esc_url( get_pagenum_link( $abignum ) ) ),
                  'format' => '?paged=%#%',
                  'current' => max( 1, get_query_var( 'paged' ) ),
                  'total' => $wp_query->max_num_pages,
                  'show_all' => False,
                  'end_size' => 2,
                  'mid_size' => 2,
                  'prev_next' => True,
                  'prev_text' => __( '&lt;' ),
                  'next_text' => __( '&gt;' ),
                  'type' => 'list'
             );
             echo paginate_links( $args );
          }


          // Define sizes for Custom Header Image
          // Allow Admin users to set Custom Header Image.
          $custom_header_args = array(
              'width'         => 60,
              'height'        => 60,
              'default-image' => get_template_directory_uri() . '/images/darkskylogo.svg',
              'uploads'       => true,
          );
          add_theme_support( 'custom-header', $custom_header_args );

          // Allow Admin users to set Custom Background Color/Image.
          add_theme_support( 'custom-background' );
    }
endif;
add_action( 'after_setup_theme', 'darksky_after_setup_theme' );

/**
 * Register widget areas and custom widgets.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function darksky_widgets_init() {

    /**
    * Registering "sidebars"
    */

    $darksky_404_sidebar = array(
         'name' => 'Error',
         'id' => 'error',
         'description' => 'Widgets placed here will go on the 404 error page ',
         'before_widget' => '<div class="widget">',
         'after_widget' => '</div>',
         'before_title' => '<h3>',
         'after_title' => '</h3>',
    );
    register_sidebar( $darksky_404_sidebar );
}
add_action( 'widgets_init', 'darksky_widgets_init' );
add_post_type_support( 'page', 'excerpt' );


/* Set up color palette in editor */
function darksky_setup_theme_supported_features() {
    add_theme_support( 'editor-color-palette', array(
        array(
            'name'  => esc_attr__( 'light blue', 'themeLangDomain' ),
            'slug'  => 'light-blue',
            'color' => '#4ea4bd',
        ),
        array(
            'name'  => esc_attr__( 'very light blue', 'themeLangDomain' ),
            'slug'  => 'very-light-blue',
            'color' => '#eaf3f5',
        ),
        array(
            'name'  => esc_attr__( 'dark gray', 'themeLangDomain' ),
            'slug'  => 'dark-gray',
            'color' => 'rgba(0, 0, 0, 0.69)',
        ),
        array(
            'name'  => esc_attr__( 'white', 'themeLangDomain' ),
            'slug'  => 'white',
            'color' => '#fff',
        ),
        array(
            'name'  => esc_attr__( 'black', 'themeLangDomain' ),
            'slug'  => 'black',
            'color' => '#000',
        ),
    ) );
}

add_action( 'after_setup_theme', 'darksky_setup_theme_supported_features' );



// add a link to the WP Toolbar
function custom_toolbar_link($wp_admin_bar) {
    $args = array(
        'id' => 'docs',
        'title' => 'Docs', 
        'href' => '/docs',
    );
    $wp_admin_bar->add_node($args);
}
add_action('admin_bar_menu', 'custom_toolbar_link', 999);

// Removes or edits the 'Protected:' part from posts titles
add_filter( 'protected_title_format', 'remove_protected_text' );
function remove_protected_text() {
return __('%s');
}


// Add custom post type "nearby"
function create_posttype_nearby() {
    register_post_type( 'nearby',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Nearby' ),
                'singular_name' => __( 'Nearby' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'nearby'),
            'show_in_rest' => true,
            'description' => "Here you will add all of the nearby attractions and upcoming events in Door County.",
            'menu_position' => 4,
            'menu_icon' => 'dashicons-location-alt',
            'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields', 'thumbnail', ),
            'capability_type'     => 'post',
            'taxonomies' => array('post_tag'),
        )
    );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype_nearby' );

// Add custom post type "nearby"
function create_posttype_review() {
    register_post_type( 'reviews',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Reviews' ),
                'singular_name' => __( 'Review' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'reviews'),
            'show_in_rest' => true,
            'description' => "Here you will add all of the reviews you want to show on your home page.",
            'menu_position' => 5,
            'menu_icon' => 'dashicons-star-filled',
            'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields', 'thumbnail', ),
            'capability_type'     => 'post',
            'taxonomies' => array(),
        )
    );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype_review' );


function location_taxonomy() {
    // Add new taxonomy, make it hierarchical like categories
//first do the translations part for GUI
  
  $labels = array(
    'name' => _x( 'Location', 'taxonomy general name' ),
    'singular_name' => _x( 'Location', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Locations' ),
    'all_items' => __( 'All Locations' ),
    'parent_item' => __( 'Parent Location' ),
    'parent_item_colon' => __( 'Parent Location:' ),
    'edit_item' => __( 'Edit Location' ), 
    'update_item' => __( 'Update Location' ),
    'add_new_item' => __( 'Add New Location' ),
    'new_item_name' => __( 'New Location Name' ),
    'menu_name' => __( 'Locations' ),
  );    
  
// Now register the taxonomy
  register_taxonomy('location',array('nearby'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_in_rest' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'location' ),
  ));
}

// Hooking up our function to theme setup
add_action( 'init', 'location_taxonomy', 0);


function attraction_type_taxonomy() {
    // Add new taxonomy, make it hierarchical like categories
//first do the translations part for GUI
  
  $labels = array(
    'name' => _x( 'Attraction Type', 'taxonomy general name' ),
    'singular_name' => _x( 'Attraction Type', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search attraction types' ),
    'all_items' => __( 'All attraction type' ),
    'parent_item' => __( 'Parent Location' ),
    'parent_item_colon' => __( 'Parent Location:' ),
    'edit_item' => __( 'Edit Attraction Type' ), 
    'update_item' => __( 'Update Attraction Type' ),
    'add_new_item' => __( 'Add New Attraction Type' ),
    'new_item_name' => __( 'New Attraction Type' ),
    'menu_name' => __( 'Attraction Type' ),
  );    
  
// Now register the taxonomy
  register_taxonomy('attraction-type',array('nearby'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_in_rest' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'attraction-type' ),
  ));
}

// Hooking up our function to theme setup
add_action( 'init', 'attraction_type_taxonomy', 0);

add_action( 'pre_get_posts', function ( $q )
{
    if (  !is_admin() // Only target front end queries
          && $q->is_main_query() // Only target the main query
          && $q->is_tag()        // Only target tag archives
    ) {
        $q->set( 'post_type', ['post', 'nearby'] ); // Change 'custom_post_type' to YOUR Custom Post Type
    }
});

//add_filter( 'the_password_form', 'custom_password_form' );
/*function custom_password_form() {
	global $page;
	$label = 'pwbox-'.( empty( $page->ID ) ? rand() : $page->ID );
	$o = '<form class="password-form" action="' . get_option('siteurl') . '/wp-pass.php" method="post"> 
    ' . __( "This page provides information for guests who have booked a stay at Dark Sky Lakehouse. For my safety and the safety of all guests, this page is password protected. Please enter the password that was provided to you after booking. If you did not receive a password, my contact information is available at the bottom of the website." ) . ' 
    <label class="password-label" for="' . $label . '">' . __( "PASSWORD:" ) . ' </label><input name="post_password" class="password-input" id="' . $label . '" type="password"/><input type="submit" name="Submit" class="password-submit" value="' . esc_attr__( "Submit" ) . '" /> 
    </form>
    ';
	return $o;
}*/

// Infinite Scroll
/*function darksky_infinite_scroll_render() {
    get_template_part( 'template-parts/content-excerpt' );
}

function darksky_infinite_scroll_init() {
    add_theme_support( 'infinite-scroll', array(
        'container' => 'content',
        'render'    => 'darksky_infinite_scroll_render',
        'footer'    => false,
        'type'      => 'click',
    ) );
}
add_action( 'after_setup_theme', 'darksky_infinite_scroll_init' );*/
?>