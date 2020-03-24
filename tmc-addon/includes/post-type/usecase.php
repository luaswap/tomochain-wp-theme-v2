<?php
if(!class_exists('TMC_Use_Case')){
    /**
     * 
     */
    class TMC_Use_Case{
        
        function __construct(){
            add_action('init', array($this,'tmc_usecase'));
        }
        function tmc_usecase(){

            $labels = array(
                'menu_name'          => esc_html__( 'Use Cases', 'tmc' ),
                'singular_name'      => esc_html__( 'Use Cases', 'tmc' ),
                'name'               => esc_html__( 'Use Case', 'tmc' ),
                'add_new'            => esc_html__( 'Add New', 'tmc' ) ,
                'add_new_item'       => esc_html__( 'Add New Use Case', 'tmc' ) ,
                'edit_item'          => esc_html__( 'Edit Use Case', 'tmc' ) ,
                'new_item'           => esc_html__( 'Add New Use Case', 'tmc' ) ,
                'view_item'          => esc_html__( 'View Use Case', 'tmc' ) ,
                'search_items'       => esc_html__( 'Search Use Case', 'tmc' ) ,
                'not_found'          => esc_html__( 'No Use Case items found', 'tmc' ) ,
                'not_found_in_trash' => esc_html__( 'No Use Case items found in trash', 'tmc' ) ,
                'parent_item_colon'  => ''
            );

            $args = array(
                'labels'                => $labels,
                'description'           => esc_html__( 'Display Use Case', 'tmc' ),
                'hierarchical'          => true,
                'public'                => true,
                'menu_icon'             => 'dashicons-screenoptions',
                'menu_position'         => 5,
                'show_in_admin_bar'     => true,
                'show_in_nav_menus'     => true,
                'can_export'            => true,
                'has_archive'           => true,
                'exclude_from_search'   => false,
                'publicly_queryable'    => true,           
                'capability_type'       => 'post',
                'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
            );
            register_post_type( 'use-case', $args );

            // Register a taxonomy for Project Categories.
            $category_labels = array(
                'name'                          => esc_html__( 'Categories', 'tmc' ) ,
                'singular_name'                 => esc_html__( 'Category', 'tmc' ) ,
                'menu_name'                     => esc_html__( 'Categories', 'tmc' ) ,
                'all_items'                     => esc_html__( 'All Categories', 'tmc' ) ,
                'edit_item'                     => esc_html__( 'Edit Category', 'tmc' ) ,
                'view_item'                     => esc_html__( 'View Category', 'tmc' ) ,
                'update_item'                   => esc_html__( 'Update Category', 'tmc' ) ,
                'add_new_item'                  => esc_html__( 'Add New Category', 'tmc' ) ,
                'new_item_name'                 => esc_html__( 'New Category Name', 'tmc' ) ,
                'parent_item'                   => esc_html__( 'Parent Category', 'tmc' ) ,
                'parent_item_colon'             => esc_html__( 'Parent Category:', 'tmc' ) ,
                'search_items'                  => esc_html__( 'Search Categories', 'tmc' ) ,
                'popular_items'                 => esc_html__( 'Popular Categories', 'tmc' ) ,
                'separate_items_with_commas'    => esc_html__( 'Separate Categories with commas', 'tmc' ) ,
                'add_or_remove_items'           => esc_html__( 'Add or remove Categories', 'tmc' ) ,
                'choose_from_most_used'         => esc_html__( 'Choose from the most used Categories', 'tmc' ) ,
                'not_found'                     => esc_html__( 'No Categories found', 'tmc' ) ,
            );

            $category_args = array(
                'labels'            => $category_labels,
                'public'            => true,
                'show_ui'           => true,
                'show_in_nav_menus' => false,
                'show_tagcloud'     => false,
                'show_admin_column' => false,
                'hierarchical'      => true,
                'query_var'         => true,
            );

            register_taxonomy('use-case-cat', array(
                'use-case'
            ) , $category_args);

        }
    }
    new TMC_Use_Case();
}