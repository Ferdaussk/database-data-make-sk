<?php
/**
 * 
* Plugin Name: AB Database Test SK
* Description: Database Test SK plugin is a product single page that enables customers to have a quick look at a product without visiting the product page.
* Plugin URI: https://ferdaussk.lotussk.com/shop/
* Version: 1.0
* Author: FERDAUS SK
* Author URI: https://ferdaussk.lotussk.com/
* Text Domain: database-data-make-sk
*/

function ferdaus01sk_admin_menu_test() {
  if (current_user_can('manage_options')) {
    add_menu_page(
      'Database SK',
      'Database SK',
      'manage_options',
      'sk-plugin-main-menu',
      'sk_plugin_settings_page',
      'dashicons-plugins-checked',
      20
    );
  }
  add_action('admin_init', 'sk_admin_controls');
}
add_action('admin_menu', 'ferdaus01sk_admin_menu_test');

function sk_plugin_settings_page(){
  // Add here a cpt/acf
  echo 'Add here a cpt/acf';
  echo '</br>';
  echo site_url('/registration/');

  // Create a link to the registration form page
  echo '<h3><a href="' . site_url('/registration/') . '" target="_blank">Register</a></h3>';
  echo '<h3><a href="' . site_url('/social/') . '" target="_blank">Template</a></h3>';
}

// Load registration form start
function custom_template_include($template) {
  if (is_page('registration')) {
    $plugin_template = plugin_dir_path(__FILE__) . 'registration-template.php';
    $plugin_template = plugin_dir_path(__FILE__) . 'facebook_test/index.php';
    if (file_exists($plugin_template)) {
      return $plugin_template;
    }
  }
  return $template;
}
add_filter('template_include', 'custom_template_include');

// Load registration form end

function sk_admin_controls(){
  // Add here some controls
}

// Register Custom Post Type
function ferdaus01sk_custom_post_type() {
  $labels = array(
    'name'                  => _x( 'Post Types', 'Post Type General Name', 'ferdaus-single-product' ),
    'singular_name'         => _x( 'Post Type', 'Post Type Singular Name', 'ferdaus-single-product' ),
    'menu_name'             => __( 'Post Types', 'ferdaus-single-product' ),
    'name_admin_bar'        => __( 'Post Type', 'ferdaus-single-product' ),
    'archives'              => __( 'Item Archives', 'ferdaus-single-product' ),
    'attributes'            => __( 'Item Attributes', 'ferdaus-single-product' ),
    'parent_item_colon'     => __( 'Parent Item:', 'ferdaus-single-product' ),
    'all_items'             => __( 'All Items', 'ferdaus-single-product' ),
    'add_new_item'          => __( 'Add New Item', 'ferdaus-single-product' ),
    'add_new'               => __( 'Add New', 'ferdaus-single-product' ),
    'new_item'              => __( 'New Item', 'ferdaus-single-product' ),
    'edit_item'             => __( 'Edit Item', 'ferdaus-single-product' ),
    'update_item'           => __( 'Update Item', 'ferdaus-single-product' ),
    'view_item'             => __( 'View Item', 'ferdaus-single-product' ),
    'view_items'            => __( 'View Items', 'ferdaus-single-product' ),
    'search_items'          => __( 'Search Item', 'ferdaus-single-product' ),
    'not_found'             => __( 'Not found', 'ferdaus-single-product' ),
    'not_found_in_trash'    => __( 'Not found in Trash', 'ferdaus-single-product' ),
    'featured_image'        => __( 'Featured Image', 'ferdaus-single-product' ),
    'set_featured_image'    => __( 'Set featured image', 'ferdaus-single-product' ),
    'remove_featured_image' => __( 'Remove featured image', 'ferdaus-single-product' ),
    'use_featured_image'    => __( 'Use as featured image', 'ferdaus-single-product' ),
    'insert_into_item'      => __( 'Insert into item', 'ferdaus-single-product' ),
    'uploaded_to_this_item' => __( 'Uploaded to this item', 'ferdaus-single-product' ),
    'items_list'            => __( 'Items list', 'ferdaus-single-product' ),
    'items_list_navigation' => __( 'Items list navigation', 'ferdaus-single-product' ),
    'filter_items_list'     => __( 'Filter items list', 'ferdaus-single-product' ),
  );

  $args = array(
    'label'                 => __( 'Post Type', 'ferdaus-single-product' ),
    'description'           => __( 'Post Type Description', 'ferdaus-single-product' ),
    'labels'                => $labels,
    'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
    'taxonomies'            => array( 'category', 'post_tag' ),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 5,
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => true,
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    'capability_type'       => 'post', // Using 'post' instead of 'page'
  );

  register_post_type( 'ferdaussk_product', $args ); // Change 'post_type' to a unique name 'ferdaussk_product'
}
add_action( 'init', 'ferdaus01sk_custom_post_type', 0 );

register_activation_hook(__FILE__, 'your_plugin_create_table');
function your_plugin_create_table() {
  global $wpdb;
  $charset_collate = $wpdb->get_charset_collate();
  $table_name = $wpdb->prefix . 'ferdaussk_plugin_test';
  $sql = "CREATE TABLE $table_name (
    id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    birthdate DATE NOT NULL,
    gender ENUM('male', 'female') NOT NULL
  ) $charset_collate;";
  // For posts
  $posts_table_name = $wpdb->prefix . 'sk_posts';
  $sql = "CREATE TABLE $posts_table_name (
    id INT AUTO_INCREMENT PRIMARY KEY,
    post_content TEXT NOT NULL,
    post_image VARCHAR(255)
  ) $charset_collate;";
  // Users
  $users_table_name = $wpdb->prefix . 'sk_users';
  $sql = "CREATE TABLE $users_table_name (
    id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    birthdate DATE NOT NULL,
    gender ENUM('male', 'female') NOT NULL,
    profile_image LONGBLOB
  ) $charset_collate;";
  require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
  dbDelta($sql);
}

register_uninstall_hook(__FILE__, 'your_plugin_delete_table');
function your_plugin_delete_table() {
  global $wpdb;
  $table_name = $wpdb->prefix . 'ferdaussk_plugin_test';
  $posts_table_name = $wpdb->prefix . 'posts';
  $users_table_name = $wpdb->prefix . 'users';
  $wpdb->query("DROP TABLE IF EXISTS $table_name");
}

function ferdaussk_test_import_in_bd(){
  wp_enqueue_style('productsarchive-db-style', plugins_url('/style.css',__FILE__), null, '1.0', 'all');
  wp_enqueue_script('productsarchive-db-script', plugins_url('/scripts.js',__FILE__), array('jquery'), '1.0', true);
}
add_action('elementor/editor/before_enqueue_scripts', 'ferdaussk_test_import_in_bd');

function db_test_import_in_bd(){
  wp_enqueue_style('productsarchive-db-style', plugins_url('/facebook_test/style.css',__FILE__), null, '1.0', 'all');
}
add_action('wp_enqueue_scripts', 'db_test_import_in_bd');




/**
// From social db
CREATE TABLE posts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  post_content TEXT NOT NULL,
  post_image VARCHAR(255)
);
CREATE TABLE users (
  id INT PRIMARY KEY AUTO_INCREMENT,
  first_name VARCHAR(50) NOT NULL,
  last_name VARCHAR(50) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  birthdate DATE NOT NULL,
  gender ENUM('male', 'female') NOT NULL,
  profile_image LONGBLOB
);
 */