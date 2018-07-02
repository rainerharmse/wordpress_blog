<?php

class posttype {
    private $name;
    private $singular;
    private $plural;
    private $menu_name;
    private $public;
    private $hierarchical;
    private $exclude_from_search;
    private $publicly_queryable;
    private $show_ui;
    private $show_in_menu;
    private $show_in_nav_menus;
    private $show_in_admin_bar;
    private $menu_position;
    private $menu_icon;
    private $capability_type;
    private $has_archive;
    private $can_export;
    private $delete_with_user;
    private $supports;

    public function __construct($options){
        $this->name = $options['post_type'];
        $this->singular = $options['singular_name'];
        $this->plural = $options['plural_name'];
        $this->menu_name = (isset($options['menu_name'])) ? $options['menu_name'] : $options['plural_name'];
        $this->public = (isset($options['public'])) ? $options['public'] : true;
        $this->hierarchical = (isset($options['hierarchical'])) ? $options['hierarchical'] : false;
        $this->exclude_from_search = (isset($options['exclude_from_search'])) ? $options['exclude_from_search'] : !$this->public;
        $this->publicly_queryable = (isset($options['publicly_queryable'])) ? $options['publicly_queryable'] : $this->public;
        $this->show_ui = (isset($options['show_ui'])) ? $options['show_ui'] : $this->public;
        $this->show_in_menu = (isset($options['show_in_menu'])) ? $options['show_in_menu'] : $this->show_ui;
        $this->show_in_nav_menus = (isset($options['show_in_nav_menus'])) ? $options['show_in_nav_menus'] : $this->public;
        $this->show_in_admin_bar = (isset($options['show_in_admin_bar'])) ? $options['show_in_admin_bar'] : $this->show_in_menu;
        $this->menu_position = (isset($options['menu_position'])) ? $options['menu_position'] : null;
        $this->menu_icon = (isset($options['menu_icon'])) ? $options['menu_icon'] : 'dashicons-admin-post';
        $this->capability_type = (isset($options['capability_type'])) ? $options['capability_type'] : 'post';
        $this->has_archive = (isset($options['has_archive'])) ? $options['has_archive'] : false;
        $this->can_export = (isset($options['can_export'])) ? $options['can_export'] : true;
        $this->delete_with_user = (isset($options['delete_with_user'])) ? $options['delete_with_user'] : null;
        $this->supports = (isset($options['supports'])) ? $options['supports'] : array('title', 'editor', 'thumbnail');

        if(!post_type_exists($this->name)){
            add_action('init', array(&$this, 'create_post_type'));
        }
    }

    public function create_post_type(){
        $labels = array(
            'name'                  => $this->plural,
            'singular_name'         => $this->singular,
            'menu_name'             => $this->menu_name,
            'name_admin_bar'        => $this->singular,
            'add_new'               => 'Add New',
            'add_new_item'          => 'Add New '. $this->singular,
            'new_item'              => 'New '. $this->singular,
            'edit_item'             => 'Edit '. $this->singular,
            'view_item'             => 'View '. $this->singular,
            'all_items'             => 'All '. $this->plural,
            'search_items'          => 'Search '. $this->plural,
            'parent_item_colon'     => 'Parent '. $this->plural .':',
            'not_found'             => 'No '. $this->plural .' found.',
            'not_found_in_trash'    => 'No '. $this->plural .' found in Trash.',
            'featured_image'        => $this->singular .' Image',
            'set_featured_image'    => 'Set '. $this->singular .' image',
            'remove_featured_image' => 'Remove '. $this->singular .' image',
            'use_featured_image'    => 'Use as '. $this->singular .' image',
            'archives'              => $this->singular .' archives',
            'insert_into_item'      => 'Insert into '. $this->singular,
            'uploaded_to_this_item' => 'Uploaded to this '. $this->singular,
            'filter_items_list'     => 'Filter '. $this->plural .' list',
            'items_list_navigation' => $this->plural .' list navigation',
            'items_list'            => $this->plural .' list',
        );
        $args = array(
            'labels'              => $labels,
            'public'              => $this->public,
            'hierarchical'        => $this->hierarchical,
            'exclude_from_search' => $this->exclude_from_search,
            'publicly_queryable'  => $this->publicly_queryable,
            'show_ui'             => $this->show_ui,
            'show_in_menu'        => $this->show_in_menu,
            'show_in_nav_menus'   => $this->show_in_nav_menus,
            'show_in_admin_bar'   => $this->show_in_admin_bar,
            'menu_position'       => $this->menu_position,
            'menu_icon'           => $this->menu_icon,
            'capability_type'     => $this->capability_type,
            'query_var'           => true,
            'rewrite'             => array( 'slug' => $this->name ),
            'has_archive'         => $this->has_archive,
            'can_export'          => $this->can_export,
            'delete_with_user'    => $this->delete_with_user,
            'supports'            => $this->supports
        );

        register_post_type( $this->name, $args );
    }
}