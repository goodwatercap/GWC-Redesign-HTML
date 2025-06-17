<?php
/**
 * Goodwater functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Goodwater
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.1.12' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function goodwater_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Goodwater, use a find and replace
		* to change 'goodwater' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'goodwater', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'header-main-menu'  => esc_html__( 'Header Main Menu', 'goodwater' ),
			'career' 			=> esc_html__( 'Career', 'goodwater' ),
			'resources'  		=> esc_html__( 'Resources', 'goodwater' ),
            'thesis'  		    => esc_html__( 'Thesis', 'goodwater' ),
			'legal'  			=> esc_html__( 'Footer Legal', 'goodwater' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'goodwater_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'goodwater_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function goodwater_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'goodwater_content_width', 640 );
}
add_action( 'after_setup_theme', 'goodwater_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function goodwater_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'goodwater' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'goodwater' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'goodwater_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function goodwater_scripts() {
	// Main Style
	wp_enqueue_style( 'goodwater-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'goodwater-style', 'rtl', 'replace' );
	// Plugin Style
	wp_enqueue_style( 'page-ahead-plugin-style', get_template_directory_uri() . '/css/plugin.css', array(), _S_VERSION );
	// Main Style
	wp_enqueue_style( 'page-ahead-main-style', get_template_directory_uri() . '/css/main.css', array(), _S_VERSION );
	// Spacing Style
    wp_enqueue_style( 'page-ahead-additional-style', get_template_directory_uri() . '/css/additional.css', array(), _S_VERSION );
    // Thesis Style
    wp_enqueue_style( 'page-ahead-thesis-style', get_template_directory_uri() . '/css/thesis.css', array(), _S_VERSION );
	// Main Script
	wp_enqueue_script( 'page-ahead-main-js', get_template_directory_uri() . '/js/script.js', array(), _S_VERSION, true );
	// WP Script
	wp_enqueue_script( 'page-ahead-wp-script-js', get_template_directory_uri() . '/js/wp-script.js', array(), _S_VERSION, true );
    // Tabbis Script
    wp_enqueue_script( 'page-ahead-tabbis-js', get_template_directory_uri() . '/js/tabbis.es6.min.js', array(), _S_VERSION, true );
    // Fancy box Script
    wp_enqueue_script( 'page-ahead-fancybox-js', get_template_directory_uri() . '/js/thesis/jquery.fancybox.pack.js', array(), _S_VERSION, true );
    //Thesis Script
    wp_enqueue_script( 'page-ahead-thesis-js', get_template_directory_uri() . '/js/thesis/thesis.js', array(), _S_VERSION, true );

    wp_localize_script( 'page-ahead-wp-script-js', 'ajax_object',array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'wp_enqueue_scripts', 'goodwater_scripts' );

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/theme-functions/jetpack.php';
}

/**
 * function includes
 */
$function_includes = array(
	'theme-functions/custom-header.php', // custom header
	'theme-functions/customizer.php',//customizer additions
    'theme-functions/icon-functions.php',//template functions
	'theme-functions/template-functions.php',//template functions
	'theme-functions/template-tags.php', // template tags
	'theme-functions/companies.php',//Custom function companies
	'custom-functions/image.php',//image functions
	'custom-functions/admin/dashboard/acf-theme-options.php',//admin theme option page
	'custom-functions/admin/dashboard/custom-logo.php',//custom logo functions
	'custom-functions/menu.php',//Active class menu function
	'custom-functions/general.php',//General functions
	'custom-functions/ajax-call/portfolio.php',//Load portfolio in ajax
	'custom-functions/ajax-call/more-portfolio-ajax.php',//load more portfolio ajax
	'custom-functions/ajax-call/portfolio-filter.php',//load more portfolio ajax
	'custom-post-type/companies.php',//Custom Post Type Company
	'custom-post-type/entrepreneurs.php',//Custom Post Type Entrepreneurs
	'custom-post-type/careers.php',//Custom Post Type Careers
	'custom-taxonomies/category.php',//Custom taxonomy category
	'custom-taxonomies/location.php',//Custom taxonomy location
	'custom-taxonomies/growth-stage.php',//Custom taxonomy growth stage
	'custom-taxonomies/career.php',//Custom taxonomy Career
	'shortcodes/shortcodes.php',//shortcodes
);

foreach ( $function_includes as $file ) {
	$filepath = locate_template( '/inc/' . $file );
	if ( ! $filepath ) {
		trigger_error( sprintf( 'Error locating /inc%s for inclusion', $file ), E_USER_ERROR );
	}
	require_once $filepath;
}

function insights_posts_query() {
    global $wp_query;
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $wp_query = new WP_Query(array(
        'category_name' => 'insights',
        'paged' => $paged,
        'posts_per_page' => 100,
        'meta_key' => 'featured_order',
        'orderby' => ['meta_value' => 'ASC', 'date' => 'DESC']
    ));
}

function retrieve_contentful_listings($page /* 0 based */, $pageSize) {

    $http = new WP_Http();
    $url = 'https://cdn.contentful.com/spaces/'. CONTENTFUL_SPACE_ID .
        '/environments/' . CONTENTFUL_ENVIRONMENT .
        '/entries?access_token=' . CONTENTFUL_API_KEY .
        '&metadata.tags.sys.id[all]=goodwatercap' .  //restrict by tag = goodwater
        '&content_type=masterclass' . // needed for ordering
        '&order=-fields.releaseDateTime' . // order by releaseDate, most recent is first
        '&select=fields.slug,fields.releaseDateTime,fields.title,fields.previewDescription,fields.featuredImage,fields.authorNames,fields.authorDesignations,fields.categories' .
        '&skip='. ($page * $pageSize) .
        '&limit=' . $pageSize;

    $args = array(
        'timeout' => 30, // Timeout after 30 seconds
        'headers' => array(
            'Content-Type' => 'application/json',
        ),
    );

    $response = $http->get($url, $args);

    if (is_wp_error($response) || $response['response']['code'] != 200) {
        return $response['response']['code'];
    }

    $body = json_decode($response['body'], true);

    return $body['items'];

    // use slug as a link to new page with template

    // need to join includes field ids for category (name) and featured image (link).


}

function retrieve_contentful_details($slug) {
    $http = new WP_Http();
    $url = 'https://cdn.contentful.com/spaces/'. CONTENTFUL_SPACE_ID .
        '/environments/' . CONTENTFUL_ENVIRONMENT .
        '/entries?access_token=' . CONTENTFUL_API_KEY .
        '&metadata.tags.sys.id[all]=goodwatercap' .  //restrict by tag = goodwater
        '&content_type=masterclass' .
        '&fields.slug=' . $slug .
        '&select=fields.releaseDateTime,fields.title,fields.mainDescription,fields.authorImage,' .
        'fields.authorNames,fields.authorDesignations,fields.authorExternalUrl,fields.numberOfSessionsAndTotalTime,fields.sessions';


        $args = array(
        'timeout' => 30, // Timeout after 30 seconds
        'headers' => array(
            'Content-Type' => 'application/json',
        ),
    );

    $response = $http->get($url, $args);

    if (is_wp_error($response) || $response['response']['code'] != 200) {
        return array();
    }

    $body = json_decode($response['body'], true);


    return $body['items'];
}

/* Fix to get goodwatercap.com/thesis/page/2 to not return a 404 error */
function remove_page_from_query_string($query_string)
{
    if (array_key_exists('name',$query_string) && $query_string['name'] == 'page' && isset($query_string['page'])) {
        unset($query_string['name']);
        $query_string['paged'] = $query_string['page'];
    }
    return $query_string;
}
add_filter('request', 'remove_page_from_query_string');

/* Fix to use url goodwatercap.com/thesis instead of goodwatercap.com/category/thesis */
function remove_category($string, $type) {
    if ($type != 'single' && $type == 'category' && (strpos($string, 'category') !== false)) {
        $url_without_category = str_replace("/category/", "/", $string);
        return trailingslashit($url_without_category);
    }
    return $string;
}
add_filter('user_trailingslashit', 'remove_category', 100, 2);


function insert_og_image_head() {
    $file = 'home.jpg';

    if (is_page_template('page-templates/about.php')) {
        $file = 'about.jpg';
    } else if (is_page_template('page-templates/capital.php')) {
        $file = 'capital.jpg';
    } else if (is_page_template('page-templates/collective.php')) {
        $file = 'collective.jpg';
    } else if (is_page_template('page-templates/genesis.php')) {
        $file = 'genesis.jpg';
    } else if (is_page_template('page-templates/portfolio.php')) {
        $file = 'portfolio.jpg';
    } else if (is_page_template('page-templates/company.php')) {
        $file = strtolower(get_the_title()).'.jpg'; //ie stash, toss....
    }

    $thumbnail_src =  get_template_directory_uri() . '/images/open-graph/' . $file;
    echo '<meta property="og:image" content="' . $thumbnail_src . '"/>';

}
add_action( 'wp_head', 'insert_og_image_head', 5 );