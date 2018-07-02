<?php
/*
	==========================================
	 Include scripts
	==========================================
*/
function awesome_script_enqueue() {
	//css
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.4', 'all');
	wp_enqueue_style('customstyle', get_template_directory_uri() . '/css/awesome.css', array(), '1.0.0', 'all');
	//js
	wp_enqueue_script('jquery');
	wp_enqueue_script('bootstrapjs', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '3.3.4', true);
	wp_enqueue_script('customjs', get_template_directory_uri() . '/js/awesome.js', array(), '1.0.0', true);
	
}

add_action( 'wp_enqueue_scripts', 'awesome_script_enqueue');

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
function awesome_theme_setup() {
	
	add_theme_support('menus');
	
	register_nav_menu('primary', 'Primary Header Navigation');
	register_nav_menu('secondary', 'Footer Navigation');
	
}

add_action('init', 'awesome_theme_setup');

/*
	==========================================
	 Theme support function
	==========================================
*/
add_theme_support('custom-background');
add_theme_support('custom-header');
add_theme_support('post-thumbnails');
add_theme_support('post-formats',array('aside','image','video'));

/*
	==========================================
	 Sidebar function
	==========================================
*/

function awesome_widget_setup(){

    register_sidebar(
        array(
            'name' => 'Sidebar',
            'id' => 'sidebar-1',
            'class' => 'custom',
            'description' => 'Standard Sidebar',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h1 class="widget-title">',
            'after_title'   => '</h1>',

        )
    );

    register_sidebar(
        array(
            'name' => 'contact',
            'id' => 'sidebar-2',
            'class' => 'custom-2',
            'description' => 'Contact Sidebar',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h1 class="widget-title">',
            'after_title'   => '</h1>',

        )
    );
}

add_action('widgets_init', 'awesome_widget_setup');


/*
	==========================================
	 Adding book custom post type
	==========================================
*/


add_action( 'init', 'codex_book_init' );
/**
 * Register a book post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function codex_book_init() {
    $labels = array(
        'name'               => _x( 'Books', 'post type general name', 'your-plugin-textdomain' ),
        'singular_name'      => _x( 'Book', 'post type singular name', 'your-plugin-textdomain' ),
        'menu_name'          => _x( 'Books', 'admin menu', 'your-plugin-textdomain' ),
        'name_admin_bar'     => _x( 'Book', 'add new on admin bar', 'your-plugin-textdomain' ),
        'add_new'            => _x( 'Add New', 'book', 'your-plugin-textdomain' ),
        'add_new_item'       => __( 'Add New Book', 'your-plugin-textdomain' ),
        'new_item'           => __( 'New Book', 'your-plugin-textdomain' ),
        'edit_item'          => __( 'Edit Book', 'your-plugin-textdomain' ),
        'view_item'          => __( 'View Book', 'your-plugin-textdomain' ),
        'all_items'          => __( 'All Books', 'your-plugin-textdomain' ),
        'search_items'       => __( 'Search Books', 'your-plugin-textdomain' ),
        'parent_item_colon'  => __( 'Parent Books:', 'your-plugin-textdomain' ),
        'not_found'          => __( 'No books found.', 'your-plugin-textdomain' ),
        'not_found_in_trash' => __( 'No books found in Trash.', 'your-plugin-textdomain' )
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __( 'Description.', 'your-plugin-textdomain' ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'book' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 20,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
    );

    register_post_type( 'book', $args );
}

function awesome_custom_post_type (){

    $labels = array(
        'name' => 'Portfolio',
        'singular_name' => 'Portfolio',
        'add_new' => 'Add Item',
        'all_items' => 'All Items',
        'add_new_item' => 'Add Item',
        'edit_item' => 'Edit Item',
        'new_item' => 'New Item',
        'view_item' => 'View Item',
        'search_item' => 'Search Portfolio',
        'not_found' => 'No items found',
        'not_found_in_trash' => 'No items found in trash',
        'parent_item_colon' => 'Parent Item'
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'publicly_queryable' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail',
            'revisions',
        ),
        //'taxonomies' => array('category', 'post_tag'),
        'menu_position' => 5,
        'exclude_from_search' => false
    );
    register_post_type('portfolio',$args);
}
add_action('init','awesome_custom_post_type');


function awesome_custom_taxonomies(){

    //add new taxonomy hierarchical
    $labels = array(
        'name' => 'Fields',
        'singular_name' => 'Field',
        'search_items' => 'Search Fields',
        'parent_item'  => 'Parent Field',
        'parent_item_colon' => 'Parent Field',
        'edit_item' => 'Edit Item',
        'update_item' => 'Update Field',
        'add_new_item' => 'Add New Field',
        'new_item_name' => 'New Field Name',
        'menu_name'     => 'Field',
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'show_ui'   => true,
        'show_admin_column'=> true,
        'query_var' => true,
        'rewrite' => array('slug' => 'field'),
    );

    register_taxonomy('field', array('portfolio'), $args );


    //add taxonomy NOT hierarchical

    register_taxonomy('software', 'portfolio', array(
        'label' => 'Software',
        'rewrite' => array( 'slug' => 'software' ),
        'hierarchical' => false,
    ) );
}


add_action('init', 'awesome_custom_taxonomies');

//Register Movies Post Type

require_once('classes/posttype.php');

$movies = new posttype(array(
    'post_type' => 'movie',
    'singular_name'=> 'Movie',
    'plural_name'=> 'Movies',
    'menu_name'=> 'Movies',
));

function movies_taxonomy(){

    $labels = array(
        'name' => 'Genre',
        'singular_name' => 'Genre',
        'search_items' => 'Search Genres',
        'parent_item'  => 'Parent Genre',
        'parent_item_colon' => 'Parent Genre',
        'edit_item' => 'Edit Item',
        'update_item' => 'Update Field',
        'add_new_item' => 'Add New Genre',
        'new_item_name' => 'New Genre Name',
        'menu_name'     => 'Genre',
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'show_ui'   => true,
        'show_admin_column'=> true,
        'query_var' => true,
        'rewrite' => array('slug' => 'genre'),
    );


    register_taxonomy('genre', 'movie', array(
        'label' => 'Genre',
        'rewrite' => array( 'slug' => 'genre' ),
        'hierarchical' => true,
        'show_in_ui'   => true,
    ) );

}

add_action('init', 'movies_taxonomy');

// Register Location Post Type

include_once('classes/posttype.php');

$locations = new posttype(array(
    'post_type' => 'location',
    'singular_name'=> 'Location',
    'plural_name'=> 'Locations',
    'menu_name'=> 'Locations',
));


function location_taxonomy(){

    $labels = array(
        'name' => 'Fields',
        'singular_name' => 'Field',
        'search_items' => 'Search Fields',
        'parent_item'  => 'Parent Field',
        'parent_item_colon' => 'Parent Field',
        'edit_item' => 'Edit Item',
        'update_item' => 'Update Field',
        'add_new_item' => 'Add New Field',
        'new_item_name' => 'New Field Name',
        'menu_name'     => 'Field',
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'show_ui'   => true,
        'show_admin_column'=> true,
        'query_var' => true,
        'rewrite' => array('slug' => 'field'),
    );


    register_taxonomy('continent', 'location', array(
        'label' => 'Continent',
        'rewrite' => array( 'slug' => 'continent' ),
        'hierarchical' => true,
        'show_in_ui'   => true,
    ) );

}

add_action('init', 'location_taxonomy');


/*
	==========================================
	 Adding Custom Meta-boxes
	==========================================
*/
//This function initializes the meta box.
function add_movie_meta_box(){
    add_meta_box (
        'movie-rating-meta',
        'Rate this Movie',
        'movie_rating',
        'movie',
        'side'
    );
}

function movie_rating($post_id){
    wp_nonce_field( 'movie_rating_action', 'movie_rating_nonce');
    $movie_rating =  get_post_meta($post_id->ID,'movie_rating', true );

    ?>

      <p>
            <input class='movie-rating-input' type='radio' name='movie_rating'  value='good' <?php checked( $movie_rating, 'good' ); ?>>Good<br>
            <input class='movie-rating-input' type='radio' name='movie_rating'  value='average' <?php checked( $movie_rating, 'average' ); ?>>Average<br>
            <input class='movie-rating-input' type='radio' name='movie_rating'  value='bad' <?php checked( $movie_rating, 'bad' ); ?>>Bad

        </p>

    <?php
}

//Function to save the movie data
function save_movie_meta_box_data($post_id){


    // Check if nonces are set.
    if( ! awesome_verify_nonce($_POST['movie_rating_nonce'], 'movie_rating_action') ){
        return;
    }
    // Check if user has permissions to save data.
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    // Check if not an autosave.
    if ( wp_is_post_autosave( $post_id ) ) {
        return;
    }
    // Check if not a revision.
    if ( wp_is_post_revision( $post_id ) ) {
        return;
    }

    if(isset($_POST['movie_rating'])){
        update_post_meta($post_id, 'movie_rating', esc_attr($_POST['movie_rating']));
    }
}

add_action('save_post', 'save_movie_meta_box_data');

add_action('admin_init', 'add_movie_meta_box');


//This function initializes the meta box.
function custom_editor_meta_box() {
    add_meta_box (
        'custom-editor',
        __('Custom Editor', 'custom-editor') ,
        'custom_editor',
        'location'
    );

}

//Displaying the meta box
function custom_editor($post) {
    wp_nonce_field( 'custom_editor_action', 'custom_editor_nonce');
    echo "<h3>Add Your Content Here</h3>";
    $content = get_post_meta($post->ID, 'custom_editor', true);

    //This function adds the WYSIWYG Editor
    wp_editor (
        $content ,
        'custom_editor',
        array ( "media_buttons" => true )
    );
}

//This function saves the data you put in the meta box
function custom_editor_save_postdata($post_id) {

    // Check if nonces are set.
    if( ! awesome_verify_nonce($_POST['custom_editor_nonce'], 'custom_editor_action') ){
        return;
    }
    // Check if user has permissions to save data.
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    // Check if not an autosave.
    if ( wp_is_post_autosave( $post_id ) ) {
        return;
    }
    // Check if not a revision.
    if ( wp_is_post_revision( $post_id ) ) {
        return;
    }

    if(isset($_POST['custom_editor'])){
        update_post_meta($post_id, 'custom_editor', esc_attr($_POST['custom_editor']));
    }

}

add_action('save_post', 'custom_editor_save_postdata');


add_action('admin_init', 'custom_editor_meta_box');


function location_url_meta_box(){
    add_meta_box(
      'location_url',
      'Location URL',
      'custom_location_url',
      'location',
      side
    );
}

function custom_location_url($post){
    wp_nonce_field( basename( __FILE__ ), 'location_url_nonce' );

    $location_url_stored = get_post_meta($post->ID,'location_url', true );

    ?>

    <p>
        <label for="location-url"><?php _e( 'Enter location URL below'); ?></label>
        <input type="text" name="location_url" id="location_url_input" value="<?php if ( isset ( $location_url_stored ) ) echo $location_url_stored ; ?>" />
    </p>

    <?php

}

function location_url_save_postdata($post_id) {

    if( isset( $_POST['location_url_nonce'] ) && isset( $_POST['location_url'] ) ) {

        //Not save if the user hasn't submitted changes
        if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }

        // Verifying whether input is coming from the proper form
        if ( ! wp_verify_nonce ( $_POST['location_url_nonce'], basename( __FILE__ ) ) ) {
            return;
        }

        // Making sure the user has permission
        if( 'post' == $_POST['location_url'] ) {
            if( ! current_user_can( 'edit_post', $post_id ) ) {
                return;
            }
        }
    }

    if (! empty($_POST['location_url'])) {

        $data = $_POST['location_url'];

        update_post_meta($post_id, 'location_url', $data);

    }
}

add_action('save_post', 'location_url_save_postdata');



add_action('admin_init', 'location_url_meta_box');







//Util functions

function awesome_verify_nonce($nonce_name, $nonce_action){
    // Check if nonce is set.
    if ( ! isset( $nonce_name ) ) {
        return false;
    }
    // Check if nonce is valid.
    if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) ) {
        return false;
    }
    return true;
}
















