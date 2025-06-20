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
	define( '_S_VERSION', '1.1.16' );
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

    // allow query var for masterclass pages
    global $wp;
    $wp->add_query_var('article');
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

    if (is_page_template('page-templates/masterclass.php')) {
        // Files copied from concierge
        wp_enqueue_style( 'page-ahead-tailwind-style', get_template_directory_uri() . '/css/masterclass/9d62842dded4f098.css', array(), _S_VERSION );
    }
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
        return array();
    }

    $body = json_decode($response['body'], true);

    // http expected example response body is
    // {"sys":{"type":"Array"},"total":1,"skip":0,"limit":1000,"items":[{"fields":{"slug":"scaling-spend-and-optimizing-roi-through-an-ai-driven-creative-team","releaseDateTime":"2025-05-08T00:00","title":"Scaling Spend and Optimizing ROI Through an AI-Driven Creative Team","previewDescription":"Learn from Scentbird's incredible success how to increase monthly creatives, optimize CAC and utilize AI to cut costs and speed up production.","featuredImage":{"sys":{"type":"Link","linkType":"Asset","id":"Le1Nk1L9nLJ2acxRSKkF6"}},"authorNames":"Mariya Nurislamova","authorDesignations":"CEO & Co-Founder, Scentbird","categories":[{"sys":{"type":"Link","linkType":"Entry","id":"39WDciQfmRsHahIkfO0R3Z"}},{"sys":{"type":"Link","linkType":"Entry","id":"Marketing"}},{"sys":{"type":"Link","linkType":"Entry","id":"Growth"}}]}}],"includes":{"Entry":[{"metadata":{"tags":[],"concepts":[]},"sys":{"space":{"sys":{"type":"Link","linkType":"Space","id":"9od8q1jf23e1"}},"id":"39WDciQfmRsHahIkfO0R3Z","type":"Entry","createdAt":"2024-03-20T20:26:43.859Z","updatedAt":"2024-03-20T20:26:43.859Z","environment":{"sys":{"id":"master","type":"Link","linkType":"Environment"}},"publishedVersion":2,"revision":1,"contentType":{"sys":{"type":"Link","linkType":"ContentType","id":"masterclassCategory"}},"locale":"en-US"},"fields":{"name":"AI"}},{"metadata":{"tags":[],"concepts":[]},"sys":{"space":{"sys":{"type":"Link","linkType":"Space","id":"9od8q1jf23e1"}},"id":"Growth","type":"Entry","createdAt":"2024-03-07T17:11:46.898Z","updatedAt":"2024-03-20T20:36:47.076Z","environment":{"sys":{"id":"master","type":"Link","linkType":"Environment"}},"publishedVersion":29,"revision":27,"contentType":{"sys":{"type":"Link","linkType":"ContentType","id":"masterclassCategory"}},"locale":"en-US"},"fields":{"name":"Growth","subcategories":[{"sys":{"type":"Link","linkType":"Entry","id":"5IfCfJJuruGVCnbtLvgn0J"}},{"sys":{"type":"Link","linkType":"Entry","id":"2Q6aTqezw63GkQDd8HiHd8"}},{"sys":{"type":"Link","linkType":"Entry","id":"VpVhjDHndfBbLkG5eA5Uo"}},{"sys":{"type":"Link","linkType":"Entry","id":"66xfHWjePrlrnpAPraBXGJ"}},{"sys":{"type":"Link","linkType":"Entry","id":"6hoARPbd2g4G3MCbfrJ0qh"}},{"sys":{"type":"Link","linkType":"Entry","id":"60051cSPRRsQ1CsolGTgzw"}},{"sys":{"type":"Link","linkType":"Entry","id":"7CTlkg07CH8q6xUAMpx3zx"}}]}},{"metadata":{"tags":[],"concepts":[]},"sys":{"space":{"sys":{"type":"Link","linkType":"Space","id":"9od8q1jf23e1"}},"id":"Marketing","type":"Entry","createdAt":"2024-03-07T17:01:25.676Z","updatedAt":"2024-03-20T20:37:28.619Z","environment":{"sys":{"id":"master","type":"Link","linkType":"Environment"}},"publishedVersion":25,"revision":23,"contentType":{"sys":{"type":"Link","linkType":"ContentType","id":"masterclassCategory"}},"locale":"en-US"},"fields":{"name":"Marketing","subcategories":[{"sys":{"type":"Link","linkType":"Entry","id":"129lkgfsXX0DBS27FxJqHu"}},{"sys":{"type":"Link","linkType":"Entry","id":"46ZmrSg1GbKEaDGYnG68cM"}}]}}],"Asset":[{"metadata":{"tags":[],"concepts":[]},"sys":{"space":{"sys":{"type":"Link","linkType":"Space","id":"9od8q1jf23e1"}},"id":"Le1Nk1L9nLJ2acxRSKkF6","type":"Asset","createdAt":"2025-05-08T04:08:11.174Z","updatedAt":"2025-05-08T04:08:11.174Z","environment":{"sys":{"id":"master","type":"Link","linkType":"Environment"}},"publishedVersion":6,"revision":1,"locale":"en-US"},"fields":{"title":"Mariya Nurislamova","description":"","file":{"url":"//images.ctfassets.net/9od8q1jf23e1/Le1Nk1L9nLJ2acxRSKkF6/3046b37c0dacce7867f46b7834f1ea2b/Mariya.jpg","details":{"size":28866,"image":{"width":522,"height":294}},"fileName":"Mariya.jpg","contentType":"image/jpeg"}}}]}}

    return _resolve_contently_links($body);
}

function retrieve_contentful_details($slug) {
    $http = new WP_Http();
    $url = 'https://cdn.contentful.com/spaces/'. CONTENTFUL_SPACE_ID .
        '/environments/' . CONTENTFUL_ENVIRONMENT .
        '/entries?access_token=' . CONTENTFUL_API_KEY .
        '&metadata.tags.sys.id[all]=goodwatercap' .  //restrict by tag = goodwater
        '&content_type=masterclass' .
        '&fields.slug=' . $slug .
        '&select=fields.releaseDateTime,fields.title,fields.mainDescription,fields.categories,fields.authorImage,' .
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

    // example of expected response body is
    // {"sys":{"type":"Array"},"total":1,"skip":0,"limit":100,"items":[{"fields":{"releaseDateTime":"2025-05-08T00:00","title":"Scaling Spend and Optimizing ROI Through an AI-Driven Creative Team","mainDescription":"Learn from Scentbird's incredible success how to increase monthly creatives, optimize CAC and utilize AI to cut costs and speed up production.","authorImage":{"sys":{"type":"Link","linkType":"Asset","id":"Le1Nk1L9nLJ2acxRSKkF6"}},"authorNames":"Mariya Nurislamova","authorDesignations":"CEO & Co-Founder, Scentbird","authorExternalUrl":"https://www.linkedin.com/in/mariyanurislamova/","numberOfSessionsAndTotalTime":"14 - 24:24","sessions":[{"sys":{"type":"Link","linkType":"Entry","id":"6FmPvfztJIoNFMM9OuwFYa"}},{"sys":{"type":"Link","linkType":"Entry","id":"5v40sKAs6N67WaBYtnNaym"}},{"sys":{"type":"Link","linkType":"Entry","id":"68AIuJwt1mU5aJLqxlsw8k"}},{"sys":{"type":"Link","linkType":"Entry","id":"3I0EQMI4JlbhZ97amHt6G5"}},{"sys":{"type":"Link","linkType":"Entry","id":"3T9W4rCyB1ySAhDANG0vzH"}},{"sys":{"type":"Link","linkType":"Entry","id":"6agwvmOnNSG2nTi3c15PtD"}}]}}],"includes":{"Entry":[{"metadata":{"tags":[],"concepts":[]},"sys":{"space":{"sys":{"type":"Link","linkType":"Space","id":"9od8q1jf23e1"}},"id":"3I0EQMI4JlbhZ97amHt6G5","type":"Entry","createdAt":"2025-05-08T03:21:22.098Z","updatedAt":"2025-05-08T03:21:22.098Z","environment":{"sys":{"id":"master","type":"Link","linkType":"Environment"}},"publishedVersion":5,"revision":1,"contentType":{"sys":{"type":"Link","linkType":"ContentType","id":"masterclassSession"}},"locale":"en-US"},"fields":{"title":"AI in Action","thumbnail":{"sys":{"type":"Link","linkType":"Asset","id":"7fGigoMYg8JVhbYEQjlEnK"}},"url":"https://player.vimeo.com/video/1082397322","timeSpan":"2:50","triggerCsatOverlay":false}},{"metadata":{"tags":[],"concepts":[]},"sys":{"space":{"sys":{"type":"Link","linkType":"Space","id":"9od8q1jf23e1"}},"id":"3T9W4rCyB1ySAhDANG0vzH","type":"Entry","createdAt":"2025-05-08T03:23:04.122Z","updatedAt":"2025-05-08T03:23:04.122Z","environment":{"sys":{"id":"master","type":"Link","linkType":"Environment"}},"publishedVersion":5,"revision":1,"contentType":{"sys":{"type":"Link","linkType":"ContentType","id":"masterclassSession"}},"locale":"en-US"},"fields":{"title":"Metrics","thumbnail":{"sys":{"type":"Link","linkType":"Asset","id":"4kLYC5kEaBVzc1vKAmiA60"}},"url":"https://player.vimeo.com/video/1082397486","timeSpan":"1:29","triggerCsatOverlay":false}},{"metadata":{"tags":[],"concepts":[]},"sys":{"space":{"sys":{"type":"Link","linkType":"Space","id":"9od8q1jf23e1"}},"id":"5v40sKAs6N67WaBYtnNaym","type":"Entry","createdAt":"2025-05-08T03:17:14.484Z","updatedAt":"2025-05-08T03:17:14.484Z","environment":{"sys":{"id":"master","type":"Link","linkType":"Environment"}},"publishedVersion":6,"revision":1,"contentType":{"sys":{"type":"Link","linkType":"ContentType","id":"masterclassSession"}},"locale":"en-US"},"fields":{"title":"The Strategy","thumbnail":{"sys":{"type":"Link","linkType":"Asset","id":"7mz9gsepNj3uvchWifUJLB"}},"url":"https://player.vimeo.com/video/1082396990","timeSpan":"2:51","triggerCsatOverlay":false}},{"metadata":{"tags":[],"concepts":[]},"sys":{"space":{"sys":{"type":"Link","linkType":"Space","id":"9od8q1jf23e1"}},"id":"68AIuJwt1mU5aJLqxlsw8k","type":"Entry","createdAt":"2025-05-08T03:19:02.514Z","updatedAt":"2025-05-08T03:19:02.514Z","environment":{"sys":{"id":"master","type":"Link","linkType":"Environment"}},"publishedVersion":5,"revision":1,"contentType":{"sys":{"type":"Link","linkType":"ContentType","id":"masterclassSession"}},"locale":"en-US"},"fields":{"title":"Getting Ads to Market at High Speed","thumbnail":{"sys":{"type":"Link","linkType":"Asset","id":"4EcKhTOtzHxWaqeK40JcpH"}},"url":"https://player.vimeo.com/video/1082397157","timeSpan":"2:53","triggerCsatOverlay":false}},{"metadata":{"tags":[],"concepts":[]},"sys":{"space":{"sys":{"type":"Link","linkType":"Space","id":"9od8q1jf23e1"}},"id":"6FmPvfztJIoNFMM9OuwFYa","type":"Entry","createdAt":"2025-05-08T03:15:14.152Z","updatedAt":"2025-05-08T03:15:14.152Z","environment":{"sys":{"id":"master","type":"Link","linkType":"Environment"}},"publishedVersion":6,"revision":1,"contentType":{"sys":{"type":"Link","linkType":"ContentType","id":"masterclassSession"}},"locale":"en-US"},"fields":{"title":"Optimizing CAC","thumbnail":{"sys":{"type":"Link","linkType":"Asset","id":"DXS2noNUUr5xuHwzIqxTL"}},"url":"https://player.vimeo.com/video/1082396875","timeSpan":"2:09","triggerCsatOverlay":false}},{"metadata":{"tags":[],"concepts":[]},"sys":{"space":{"sys":{"type":"Link","linkType":"Space","id":"9od8q1jf23e1"}},"id":"6agwvmOnNSG2nTi3c15PtD","type":"Entry","createdAt":"2025-05-08T03:24:28.025Z","updatedAt":"2025-05-08T03:24:28.025Z","environment":{"sys":{"id":"master","type":"Link","linkType":"Environment"}},"publishedVersion":5,"revision":1,"contentType":{"sys":{"type":"Link","linkType":"ContentType","id":"masterclassSession"}},"locale":"en-US"},"fields":{"title":"Key Takeaways","thumbnail":{"sys":{"type":"Link","linkType":"Asset","id":"74QGL3x6Ukz1iLKXqbrTNm"}},"url":"https://player.vimeo.com/video/1082397564","timeSpan":"0:54","triggerCsatOverlay":false}}],"Asset":[{"metadata":{"tags":[],"concepts":[]},"sys":{"space":{"sys":{"type":"Link","linkType":"Space","id":"9od8q1jf23e1"}},"id":"4EcKhTOtzHxWaqeK40JcpH","type":"Asset","createdAt":"2025-05-08T03:18:57.980Z","updatedAt":"2025-05-08T03:18:57.980Z","environment":{"sys":{"id":"master","type":"Link","linkType":"Environment"}},"publishedVersion":7,"revision":1,"locale":"en-US"},"fields":{"title":"CH3 Mariya","description":"","file":{"url":"//images.ctfassets.net/9od8q1jf23e1/4EcKhTOtzHxWaqeK40JcpH/cfd92eb00685b147f4b6a4ea5f2ca2bf/Screenshot_2025-05-07_at_8.18.25_PM.png","details":{"size":443241,"image":{"width":960,"height":540}},"fileName":"Screenshot 2025-05-07 at 8.18.25 PM.png","contentType":"image/png"}}},{"metadata":{"tags":[],"concepts":[]},"sys":{"space":{"sys":{"type":"Link","linkType":"Space","id":"9od8q1jf23e1"}},"id":"4kLYC5kEaBVzc1vKAmiA60","type":"Asset","createdAt":"2025-05-08T03:22:59.105Z","updatedAt":"2025-05-08T03:22:59.105Z","environment":{"sys":{"id":"master","type":"Link","linkType":"Environment"}},"publishedVersion":5,"revision":1,"locale":"en-US"},"fields":{"title":"CH5 Mariya","description":"","file":{"url":"//images.ctfassets.net/9od8q1jf23e1/4kLYC5kEaBVzc1vKAmiA60/16dbfa827ff19887e5db8f3603926250/Screenshot_2025-05-07_at_8.22.33_PM.png","details":{"size":381196,"image":{"width":960,"height":540}},"fileName":"Screenshot 2025-05-07 at 8.22.33 PM.png","contentType":"image/png"}}},{"metadata":{"tags":[],"concepts":[]},"sys":{"space":{"sys":{"type":"Link","linkType":"Space","id":"9od8q1jf23e1"}},"id":"74QGL3x6Ukz1iLKXqbrTNm","type":"Asset","createdAt":"2025-05-08T03:24:24.488Z","updatedAt":"2025-05-08T03:24:24.488Z","environment":{"sys":{"id":"master","type":"Link","linkType":"Environment"}},"publishedVersion":5,"revision":1,"locale":"en-US"},"fields":{"title":"CH6 Mariya","description":"","file":{"url":"//images.ctfassets.net/9od8q1jf23e1/74QGL3x6Ukz1iLKXqbrTNm/314fb8324d5b499002f463d655c948b4/Screenshot_2025-05-07_at_8.24.01_PM.png","details":{"size":484255,"image":{"width":960,"height":540}},"fileName":"Screenshot 2025-05-07 at 8.24.01 PM.png","contentType":"image/png"}}},{"metadata":{"tags":[],"concepts":[]},"sys":{"space":{"sys":{"type":"Link","linkType":"Space","id":"9od8q1jf23e1"}},"id":"7fGigoMYg8JVhbYEQjlEnK","type":"Asset","createdAt":"2025-05-08T03:21:18.342Z","updatedAt":"2025-05-08T03:21:18.342Z","environment":{"sys":{"id":"master","type":"Link","linkType":"Environment"}},"publishedVersion":6,"revision":1,"locale":"en-US"},"fields":{"title":"CH4 Mariya","description":"","file":{"url":"//images.ctfassets.net/9od8q1jf23e1/7fGigoMYg8JVhbYEQjlEnK/3198dcd9ccb271bd1ee2d021b7870325/Screenshot_2025-05-07_at_8.20.40_PM.png","details":{"size":488006,"image":{"width":960,"height":540}},"fileName":"Screenshot 2025-05-07 at 8.20.40 PM.png","contentType":"image/png"}}},{"metadata":{"tags":[],"concepts":[]},"sys":{"space":{"sys":{"type":"Link","linkType":"Space","id":"9od8q1jf23e1"}},"id":"7mz9gsepNj3uvchWifUJLB","type":"Asset","createdAt":"2025-05-08T03:17:08.836Z","updatedAt":"2025-05-08T03:17:08.836Z","environment":{"sys":{"id":"master","type":"Link","linkType":"Environment"}},"publishedVersion":5,"revision":1,"locale":"en-US"},"fields":{"title":"CH2 Mariya","description":"","file":{"url":"//images.ctfassets.net/9od8q1jf23e1/7mz9gsepNj3uvchWifUJLB/efff07eee420b2ca44fd17246cf993ba/Screenshot_2025-05-07_at_8.16.44_PM.png","details":{"size":459966,"image":{"width":960,"height":540}},"fileName":"Screenshot 2025-05-07 at 8.16.44 PM.png","contentType":"image/png"}}},{"metadata":{"tags":[],"concepts":[]},"sys":{"space":{"sys":{"type":"Link","linkType":"Space","id":"9od8q1jf23e1"}},"id":"DXS2noNUUr5xuHwzIqxTL","type":"Asset","createdAt":"2025-05-08T03:13:48.315Z","updatedAt":"2025-05-08T03:13:48.315Z","environment":{"sys":{"id":"master","type":"Link","linkType":"Environment"}},"publishedVersion":6,"revision":1,"locale":"en-US"},"fields":{"title":"CH1 Mariya","description":"","file":{"url":"//images.ctfassets.net/9od8q1jf23e1/DXS2noNUUr5xuHwzIqxTL/bf744010960d09fcb67af678843e1768/Screenshot_2025-05-07_at_8.13.17_PM.png","details":{"size":290990,"image":{"width":960,"height":540}},"fileName":"Screenshot 2025-05-07 at 8.13.17 PM.png","contentType":"image/png"}}},{"metadata":{"tags":[],"concepts":[]},"sys":{"space":{"sys":{"type":"Link","linkType":"Space","id":"9od8q1jf23e1"}},"id":"Le1Nk1L9nLJ2acxRSKkF6","type":"Asset","createdAt":"2025-05-08T04:08:11.174Z","updatedAt":"2025-05-08T04:08:11.174Z","environment":{"sys":{"id":"master","type":"Link","linkType":"Environment"}},"publishedVersion":6,"revision":1,"locale":"en-US"},"fields":{"title":"Mariya Nurislamova","description":"","file":{"url":"//images.ctfassets.net/9od8q1jf23e1/Le1Nk1L9nLJ2acxRSKkF6/3046b37c0dacce7867f46b7834f1ea2b/Mariya.jpg","details":{"size":28866,"image":{"width":522,"height":294}},"fileName":"Mariya.jpg","contentType":"image/jpeg"}}}]}}

    if ($body['total'] != 1) {
        return array();
    }

    return _resolve_contently_links($body)[0];
}

function _resolve_contently_links($body): array
{
    // http expected example response body is
    // example 1 listing: {"sys":{"type":"Array"},"total":1,"skip":0,"limit":1000,"items":[{"fields":{"slug":"scaling-spend-and-optimizing-roi-through-an-ai-driven-creative-team","releaseDateTime":"2025-05-08T00:00","title":"Scaling Spend and Optimizing ROI Through an AI-Driven Creative Team","previewDescription":"Learn from Scentbird's incredible success how to increase monthly creatives, optimize CAC and utilize AI to cut costs and speed up production.","featuredImage":{"sys":{"type":"Link","linkType":"Asset","id":"Le1Nk1L9nLJ2acxRSKkF6"}},"authorNames":"Mariya Nurislamova","authorDesignations":"CEO & Co-Founder, Scentbird","categories":[{"sys":{"type":"Link","linkType":"Entry","id":"39WDciQfmRsHahIkfO0R3Z"}},{"sys":{"type":"Link","linkType":"Entry","id":"Marketing"}},{"sys":{"type":"Link","linkType":"Entry","id":"Growth"}}]}}],"includes":{"Entry":[{"metadata":{"tags":[],"concepts":[]},"sys":{"space":{"sys":{"type":"Link","linkType":"Space","id":"9od8q1jf23e1"}},"id":"39WDciQfmRsHahIkfO0R3Z","type":"Entry","createdAt":"2024-03-20T20:26:43.859Z","updatedAt":"2024-03-20T20:26:43.859Z","environment":{"sys":{"id":"master","type":"Link","linkType":"Environment"}},"publishedVersion":2,"revision":1,"contentType":{"sys":{"type":"Link","linkType":"ContentType","id":"masterclassCategory"}},"locale":"en-US"},"fields":{"name":"AI"}},{"metadata":{"tags":[],"concepts":[]},"sys":{"space":{"sys":{"type":"Link","linkType":"Space","id":"9od8q1jf23e1"}},"id":"Growth","type":"Entry","createdAt":"2024-03-07T17:11:46.898Z","updatedAt":"2024-03-20T20:36:47.076Z","environment":{"sys":{"id":"master","type":"Link","linkType":"Environment"}},"publishedVersion":29,"revision":27,"contentType":{"sys":{"type":"Link","linkType":"ContentType","id":"masterclassCategory"}},"locale":"en-US"},"fields":{"name":"Growth","subcategories":[{"sys":{"type":"Link","linkType":"Entry","id":"5IfCfJJuruGVCnbtLvgn0J"}},{"sys":{"type":"Link","linkType":"Entry","id":"2Q6aTqezw63GkQDd8HiHd8"}},{"sys":{"type":"Link","linkType":"Entry","id":"VpVhjDHndfBbLkG5eA5Uo"}},{"sys":{"type":"Link","linkType":"Entry","id":"66xfHWjePrlrnpAPraBXGJ"}},{"sys":{"type":"Link","linkType":"Entry","id":"6hoARPbd2g4G3MCbfrJ0qh"}},{"sys":{"type":"Link","linkType":"Entry","id":"60051cSPRRsQ1CsolGTgzw"}},{"sys":{"type":"Link","linkType":"Entry","id":"7CTlkg07CH8q6xUAMpx3zx"}}]}},{"metadata":{"tags":[],"concepts":[]},"sys":{"space":{"sys":{"type":"Link","linkType":"Space","id":"9od8q1jf23e1"}},"id":"Marketing","type":"Entry","createdAt":"2024-03-07T17:01:25.676Z","updatedAt":"2024-03-20T20:37:28.619Z","environment":{"sys":{"id":"master","type":"Link","linkType":"Environment"}},"publishedVersion":25,"revision":23,"contentType":{"sys":{"type":"Link","linkType":"ContentType","id":"masterclassCategory"}},"locale":"en-US"},"fields":{"name":"Marketing","subcategories":[{"sys":{"type":"Link","linkType":"Entry","id":"129lkgfsXX0DBS27FxJqHu"}},{"sys":{"type":"Link","linkType":"Entry","id":"46ZmrSg1GbKEaDGYnG68cM"}}]}}],"Asset":[{"metadata":{"tags":[],"concepts":[]},"sys":{"space":{"sys":{"type":"Link","linkType":"Space","id":"9od8q1jf23e1"}},"id":"Le1Nk1L9nLJ2acxRSKkF6","type":"Asset","createdAt":"2025-05-08T04:08:11.174Z","updatedAt":"2025-05-08T04:08:11.174Z","environment":{"sys":{"id":"master","type":"Link","linkType":"Environment"}},"publishedVersion":6,"revision":1,"locale":"en-US"},"fields":{"title":"Mariya Nurislamova","description":"","file":{"url":"//images.ctfassets.net/9od8q1jf23e1/Le1Nk1L9nLJ2acxRSKkF6/3046b37c0dacce7867f46b7834f1ea2b/Mariya.jpg","details":{"size":28866,"image":{"width":522,"height":294}},"fileName":"Mariya.jpg","contentType":"image/jpeg"}}}]}}
    // example 2 detail: {"sys":{"type":"Array"},"total":1,"skip":0,"limit":100,"items":[{"fields":{"releaseDateTime":"2025-05-08T00:00","title":"Scaling Spend and Optimizing ROI Through an AI-Driven Creative Team","mainDescription":"Learn from Scentbird's incredible success how to increase monthly creatives, optimize CAC and utilize AI to cut costs and speed up production.","authorImage":{"sys":{"type":"Link","linkType":"Asset","id":"Le1Nk1L9nLJ2acxRSKkF6"}},"authorNames":"Mariya Nurislamova","authorDesignations":"CEO & Co-Founder, Scentbird","authorExternalUrl":"https://www.linkedin.com/in/mariyanurislamova/","numberOfSessionsAndTotalTime":"14 - 24:24","sessions":[{"sys":{"type":"Link","linkType":"Entry","id":"6FmPvfztJIoNFMM9OuwFYa"}},{"sys":{"type":"Link","linkType":"Entry","id":"5v40sKAs6N67WaBYtnNaym"}},{"sys":{"type":"Link","linkType":"Entry","id":"68AIuJwt1mU5aJLqxlsw8k"}},{"sys":{"type":"Link","linkType":"Entry","id":"3I0EQMI4JlbhZ97amHt6G5"}},{"sys":{"type":"Link","linkType":"Entry","id":"3T9W4rCyB1ySAhDANG0vzH"}},{"sys":{"type":"Link","linkType":"Entry","id":"6agwvmOnNSG2nTi3c15PtD"}}]}}],"includes":{"Entry":[{"metadata":{"tags":[],"concepts":[]},"sys":{"space":{"sys":{"type":"Link","linkType":"Space","id":"9od8q1jf23e1"}},"id":"3I0EQMI4JlbhZ97amHt6G5","type":"Entry","createdAt":"2025-05-08T03:21:22.098Z","updatedAt":"2025-05-08T03:21:22.098Z","environment":{"sys":{"id":"master","type":"Link","linkType":"Environment"}},"publishedVersion":5,"revision":1,"contentType":{"sys":{"type":"Link","linkType":"ContentType","id":"masterclassSession"}},"locale":"en-US"},"fields":{"title":"AI in Action","thumbnail":{"sys":{"type":"Link","linkType":"Asset","id":"7fGigoMYg8JVhbYEQjlEnK"}},"url":"https://player.vimeo.com/video/1082397322","timeSpan":"2:50","triggerCsatOverlay":false}},{"metadata":{"tags":[],"concepts":[]},"sys":{"space":{"sys":{"type":"Link","linkType":"Space","id":"9od8q1jf23e1"}},"id":"3T9W4rCyB1ySAhDANG0vzH","type":"Entry","createdAt":"2025-05-08T03:23:04.122Z","updatedAt":"2025-05-08T03:23:04.122Z","environment":{"sys":{"id":"master","type":"Link","linkType":"Environment"}},"publishedVersion":5,"revision":1,"contentType":{"sys":{"type":"Link","linkType":"ContentType","id":"masterclassSession"}},"locale":"en-US"},"fields":{"title":"Metrics","thumbnail":{"sys":{"type":"Link","linkType":"Asset","id":"4kLYC5kEaBVzc1vKAmiA60"}},"url":"https://player.vimeo.com/video/1082397486","timeSpan":"1:29","triggerCsatOverlay":false}},{"metadata":{"tags":[],"concepts":[]},"sys":{"space":{"sys":{"type":"Link","linkType":"Space","id":"9od8q1jf23e1"}},"id":"5v40sKAs6N67WaBYtnNaym","type":"Entry","createdAt":"2025-05-08T03:17:14.484Z","updatedAt":"2025-05-08T03:17:14.484Z","environment":{"sys":{"id":"master","type":"Link","linkType":"Environment"}},"publishedVersion":6,"revision":1,"contentType":{"sys":{"type":"Link","linkType":"ContentType","id":"masterclassSession"}},"locale":"en-US"},"fields":{"title":"The Strategy","thumbnail":{"sys":{"type":"Link","linkType":"Asset","id":"7mz9gsepNj3uvchWifUJLB"}},"url":"https://player.vimeo.com/video/1082396990","timeSpan":"2:51","triggerCsatOverlay":false}},{"metadata":{"tags":[],"concepts":[]},"sys":{"space":{"sys":{"type":"Link","linkType":"Space","id":"9od8q1jf23e1"}},"id":"68AIuJwt1mU5aJLqxlsw8k","type":"Entry","createdAt":"2025-05-08T03:19:02.514Z","updatedAt":"2025-05-08T03:19:02.514Z","environment":{"sys":{"id":"master","type":"Link","linkType":"Environment"}},"publishedVersion":5,"revision":1,"contentType":{"sys":{"type":"Link","linkType":"ContentType","id":"masterclassSession"}},"locale":"en-US"},"fields":{"title":"Getting Ads to Market at High Speed","thumbnail":{"sys":{"type":"Link","linkType":"Asset","id":"4EcKhTOtzHxWaqeK40JcpH"}},"url":"https://player.vimeo.com/video/1082397157","timeSpan":"2:53","triggerCsatOverlay":false}},{"metadata":{"tags":[],"concepts":[]},"sys":{"space":{"sys":{"type":"Link","linkType":"Space","id":"9od8q1jf23e1"}},"id":"6FmPvfztJIoNFMM9OuwFYa","type":"Entry","createdAt":"2025-05-08T03:15:14.152Z","updatedAt":"2025-05-08T03:15:14.152Z","environment":{"sys":{"id":"master","type":"Link","linkType":"Environment"}},"publishedVersion":6,"revision":1,"contentType":{"sys":{"type":"Link","linkType":"ContentType","id":"masterclassSession"}},"locale":"en-US"},"fields":{"title":"Optimizing CAC","thumbnail":{"sys":{"type":"Link","linkType":"Asset","id":"DXS2noNUUr5xuHwzIqxTL"}},"url":"https://player.vimeo.com/video/1082396875","timeSpan":"2:09","triggerCsatOverlay":false}},{"metadata":{"tags":[],"concepts":[]},"sys":{"space":{"sys":{"type":"Link","linkType":"Space","id":"9od8q1jf23e1"}},"id":"6agwvmOnNSG2nTi3c15PtD","type":"Entry","createdAt":"2025-05-08T03:24:28.025Z","updatedAt":"2025-05-08T03:24:28.025Z","environment":{"sys":{"id":"master","type":"Link","linkType":"Environment"}},"publishedVersion":5,"revision":1,"contentType":{"sys":{"type":"Link","linkType":"ContentType","id":"masterclassSession"}},"locale":"en-US"},"fields":{"title":"Key Takeaways","thumbnail":{"sys":{"type":"Link","linkType":"Asset","id":"74QGL3x6Ukz1iLKXqbrTNm"}},"url":"https://player.vimeo.com/video/1082397564","timeSpan":"0:54","triggerCsatOverlay":false}}],"Asset":[{"metadata":{"tags":[],"concepts":[]},"sys":{"space":{"sys":{"type":"Link","linkType":"Space","id":"9od8q1jf23e1"}},"id":"4EcKhTOtzHxWaqeK40JcpH","type":"Asset","createdAt":"2025-05-08T03:18:57.980Z","updatedAt":"2025-05-08T03:18:57.980Z","environment":{"sys":{"id":"master","type":"Link","linkType":"Environment"}},"publishedVersion":7,"revision":1,"locale":"en-US"},"fields":{"title":"CH3 Mariya","description":"","file":{"url":"//images.ctfassets.net/9od8q1jf23e1/4EcKhTOtzHxWaqeK40JcpH/cfd92eb00685b147f4b6a4ea5f2ca2bf/Screenshot_2025-05-07_at_8.18.25_PM.png","details":{"size":443241,"image":{"width":960,"height":540}},"fileName":"Screenshot 2025-05-07 at 8.18.25 PM.png","contentType":"image/png"}}},{"metadata":{"tags":[],"concepts":[]},"sys":{"space":{"sys":{"type":"Link","linkType":"Space","id":"9od8q1jf23e1"}},"id":"4kLYC5kEaBVzc1vKAmiA60","type":"Asset","createdAt":"2025-05-08T03:22:59.105Z","updatedAt":"2025-05-08T03:22:59.105Z","environment":{"sys":{"id":"master","type":"Link","linkType":"Environment"}},"publishedVersion":5,"revision":1,"locale":"en-US"},"fields":{"title":"CH5 Mariya","description":"","file":{"url":"//images.ctfassets.net/9od8q1jf23e1/4kLYC5kEaBVzc1vKAmiA60/16dbfa827ff19887e5db8f3603926250/Screenshot_2025-05-07_at_8.22.33_PM.png","details":{"size":381196,"image":{"width":960,"height":540}},"fileName":"Screenshot 2025-05-07 at 8.22.33 PM.png","contentType":"image/png"}}},{"metadata":{"tags":[],"concepts":[]},"sys":{"space":{"sys":{"type":"Link","linkType":"Space","id":"9od8q1jf23e1"}},"id":"74QGL3x6Ukz1iLKXqbrTNm","type":"Asset","createdAt":"2025-05-08T03:24:24.488Z","updatedAt":"2025-05-08T03:24:24.488Z","environment":{"sys":{"id":"master","type":"Link","linkType":"Environment"}},"publishedVersion":5,"revision":1,"locale":"en-US"},"fields":{"title":"CH6 Mariya","description":"","file":{"url":"//images.ctfassets.net/9od8q1jf23e1/74QGL3x6Ukz1iLKXqbrTNm/314fb8324d5b499002f463d655c948b4/Screenshot_2025-05-07_at_8.24.01_PM.png","details":{"size":484255,"image":{"width":960,"height":540}},"fileName":"Screenshot 2025-05-07 at 8.24.01 PM.png","contentType":"image/png"}}},{"metadata":{"tags":[],"concepts":[]},"sys":{"space":{"sys":{"type":"Link","linkType":"Space","id":"9od8q1jf23e1"}},"id":"7fGigoMYg8JVhbYEQjlEnK","type":"Asset","createdAt":"2025-05-08T03:21:18.342Z","updatedAt":"2025-05-08T03:21:18.342Z","environment":{"sys":{"id":"master","type":"Link","linkType":"Environment"}},"publishedVersion":6,"revision":1,"locale":"en-US"},"fields":{"title":"CH4 Mariya","description":"","file":{"url":"//images.ctfassets.net/9od8q1jf23e1/7fGigoMYg8JVhbYEQjlEnK/3198dcd9ccb271bd1ee2d021b7870325/Screenshot_2025-05-07_at_8.20.40_PM.png","details":{"size":488006,"image":{"width":960,"height":540}},"fileName":"Screenshot 2025-05-07 at 8.20.40 PM.png","contentType":"image/png"}}},{"metadata":{"tags":[],"concepts":[]},"sys":{"space":{"sys":{"type":"Link","linkType":"Space","id":"9od8q1jf23e1"}},"id":"7mz9gsepNj3uvchWifUJLB","type":"Asset","createdAt":"2025-05-08T03:17:08.836Z","updatedAt":"2025-05-08T03:17:08.836Z","environment":{"sys":{"id":"master","type":"Link","linkType":"Environment"}},"publishedVersion":5,"revision":1,"locale":"en-US"},"fields":{"title":"CH2 Mariya","description":"","file":{"url":"//images.ctfassets.net/9od8q1jf23e1/7mz9gsepNj3uvchWifUJLB/efff07eee420b2ca44fd17246cf993ba/Screenshot_2025-05-07_at_8.16.44_PM.png","details":{"size":459966,"image":{"width":960,"height":540}},"fileName":"Screenshot 2025-05-07 at 8.16.44 PM.png","contentType":"image/png"}}},{"metadata":{"tags":[],"concepts":[]},"sys":{"space":{"sys":{"type":"Link","linkType":"Space","id":"9od8q1jf23e1"}},"id":"DXS2noNUUr5xuHwzIqxTL","type":"Asset","createdAt":"2025-05-08T03:13:48.315Z","updatedAt":"2025-05-08T03:13:48.315Z","environment":{"sys":{"id":"master","type":"Link","linkType":"Environment"}},"publishedVersion":6,"revision":1,"locale":"en-US"},"fields":{"title":"CH1 Mariya","description":"","file":{"url":"//images.ctfassets.net/9od8q1jf23e1/DXS2noNUUr5xuHwzIqxTL/bf744010960d09fcb67af678843e1768/Screenshot_2025-05-07_at_8.13.17_PM.png","details":{"size":290990,"image":{"width":960,"height":540}},"fileName":"Screenshot 2025-05-07 at 8.13.17 PM.png","contentType":"image/png"}}},{"metadata":{"tags":[],"concepts":[]},"sys":{"space":{"sys":{"type":"Link","linkType":"Space","id":"9od8q1jf23e1"}},"id":"Le1Nk1L9nLJ2acxRSKkF6","type":"Asset","createdAt":"2025-05-08T04:08:11.174Z","updatedAt":"2025-05-08T04:08:11.174Z","environment":{"sys":{"id":"master","type":"Link","linkType":"Environment"}},"publishedVersion":6,"revision":1,"locale":"en-US"},"fields":{"title":"Mariya Nurislamova","description":"","file":{"url":"//images.ctfassets.net/9od8q1jf23e1/Le1Nk1L9nLJ2acxRSKkF6/3046b37c0dacce7867f46b7834f1ea2b/Mariya.jpg","details":{"size":28866,"image":{"width":522,"height":294}},"fileName":"Mariya.jpg","contentType":"image/jpeg"}}}]}}

    // get image links
    $asset_id_to_links = array();
    foreach ($body['includes']['Asset'] as $asset) {
        $id = $asset['sys']['id'];
        $value = $asset['fields']['file']['url'];
        $asset_id_to_links[$id] = $value;
    }

    // get category names and sessions
    $category_id_to_names = array();
    $session_id_to_entry = array();
    foreach ($body['includes']['Entry'] as $entry) {
        if ($entry['sys']['contentType']['sys']['id'] == 'masterclassCategory') {
            $id = $entry['sys']['id'];
            $value = $entry['fields']['name'];
            $category_id_to_names[$id] = $value;
        }
        if ($entry['sys']['contentType']['sys']['id'] == 'masterclassSession') {
            $id = $entry['sys']['id'];
            $session_id_to_entry[$id] = array(
                'title' => $entry['fields']['title'],
                'thumbnail' => $asset_id_to_links[$entry['fields']['thumbnail']['sys']['id']],
                'url' => $entry['fields']['url'],
                'timeSpan' => $entry['fields']['timeSpan']
            );
        }
    }

    //transform items
    $results = array();
    foreach ($body['items'] as $item) {
        if (array_key_exists('featuredImage', $item['fields'])) {
            $featured_image_id = $item['fields']['featuredImage']['sys']['id'];
            $url = $asset_id_to_links[$featured_image_id];
            $item['fields']['featuredImage'] = $url;
        }

        if (array_key_exists('categories', $item['fields'])) {
            $category_names = array();
            foreach ($item['fields']['categories'] as $category) {
                $category_id = $category['sys']['id'];
                $category_names[] = $category_id_to_names[$category_id];
            }
            $item['fields']['categories'] = $category_names;
        }

        if (array_key_exists('sessions', $item['fields'])) {
            $sessions = array();
            foreach ($item['fields']['sessions'] as $session) {
                $session_id = $session['sys']['id'];
                $sessions[] = $session_id_to_entry[$session_id];
            }
            $item['fields']['sessions'] = $sessions;
        }

        if (array_key_exists('authorImage', $item['fields'])) {
            $image_id = $item['fields']['authorImage']['sys']['id'];
            $url = $asset_id_to_links[$image_id];
            $item['fields']['authorImage'] = $url;
        }

        $results[] = $item['fields'];
    }

    // expected result example is
    // example 1 listing: [{"slug":"scaling-spend-and-optimizing-roi-through-an-ai-driven-creative-team","releaseDateTime":"2025-05-08T00:00","title":"Scaling Spend and Optimizing ROI Through an AI-Driven Creative Team","previewDescription":"Learn from Scentbird's incredible success how to increase monthly creatives, optimize CAC and utilize AI to cut costs and speed up production.","featuredImage":"\/\/images.ctfassets.net\/9od8q1jf23e1\/Le1Nk1L9nLJ2acxRSKkF6\/3046b37c0dacce7867f46b7834f1ea2b\/Mariya.jpg","authorNames":"Mariya Nurislamova","authorDesignations":"CEO & Co-Founder, Scentbird","categories":["AI","Marketing","Growth"]}]
    // example 2 detail: [{"releaseDateTime":"2025-05-08T00:00","title":"Scaling Spend and Optimizing ROI Through an AI-Driven Creative Team","mainDescription":"Learn from Scentbird's incredible success how to increase monthly creatives, optimize CAC and utilize AI to cut costs and speed up production.","authorImage":"\/\/images.ctfassets.net\/9od8q1jf23e1\/Le1Nk1L9nLJ2acxRSKkF6\/3046b37c0dacce7867f46b7834f1ea2b\/Mariya.jpg","authorNames":"Mariya Nurislamova","authorDesignations":"CEO & Co-Founder, Scentbird","authorExternalUrl":"https:\/\/www.linkedin.com\/in\/mariyanurislamova\/","numberOfSessionsAndTotalTime":"14 - 24:24","sessions":[{"title":"Optimizing CAC","thumbnail":"\/\/images.ctfassets.net\/9od8q1jf23e1\/DXS2noNUUr5xuHwzIqxTL\/bf744010960d09fcb67af678843e1768\/Screenshot_2025-05-07_at_8.13.17_PM.png","url":"https:\/\/player.vimeo.com\/video\/1082396875","timeSpan":"2:09"},{"title":"The Strategy","thumbnail":"\/\/images.ctfassets.net\/9od8q1jf23e1\/7mz9gsepNj3uvchWifUJLB\/efff07eee420b2ca44fd17246cf993ba\/Screenshot_2025-05-07_at_8.16.44_PM.png","url":"https:\/\/player.vimeo.com\/video\/1082396990","timeSpan":"2:51"},{"title":"Getting Ads to Market at High Speed","thumbnail":"\/\/images.ctfassets.net\/9od8q1jf23e1\/4EcKhTOtzHxWaqeK40JcpH\/cfd92eb00685b147f4b6a4ea5f2ca2bf\/Screenshot_2025-05-07_at_8.18.25_PM.png","url":"https:\/\/player.vimeo.com\/video\/1082397157","timeSpan":"2:53"},{"title":"AI in Action","thumbnail":"\/\/images.ctfassets.net\/9od8q1jf23e1\/7fGigoMYg8JVhbYEQjlEnK\/3198dcd9ccb271bd1ee2d021b7870325\/Screenshot_2025-05-07_at_8.20.40_PM.png","url":"https:\/\/player.vimeo.com\/video\/1082397322","timeSpan":"2:50"},{"title":"Metrics","thumbnail":"\/\/images.ctfassets.net\/9od8q1jf23e1\/4kLYC5kEaBVzc1vKAmiA60\/16dbfa827ff19887e5db8f3603926250\/Screenshot_2025-05-07_at_8.22.33_PM.png","url":"https:\/\/player.vimeo.com\/video\/1082397486","timeSpan":"1:29"},{"title":"Key Takeaways","thumbnail":"\/\/images.ctfassets.net\/9od8q1jf23e1\/74QGL3x6Ukz1iLKXqbrTNm\/314fb8324d5b499002f463d655c948b4\/Screenshot_2025-05-07_at_8.24.01_PM.png","url":"https:\/\/player.vimeo.com\/video\/1082397564","timeSpan":"0:54"}]}]
    return $results;
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