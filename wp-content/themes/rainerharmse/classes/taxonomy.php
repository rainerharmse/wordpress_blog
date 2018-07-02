<?php

class peace_parks_taxonomy {
    private $post_types;
    private $name;
    private $singular;
    private $plural;
    private $public;
    private $publicly_queryable;
    private $hierarchical;
    private $show_ui;
    private $show_in_menu;
    private $show_in_nav_menus;
    private $show_tagcloud;
    private $show_in_quick_edit;
    private $show_admin_column;

    public function __construct($options){
        $this->post_types = $options['post_types'];
        $this->name = $options['taxonomy'];
        $this->singular = $options['singular'];
        $this->plural = $options['plural'];
        $this->public = (isset($options['public'])) ? $options['public'] : true;
        $this->publicly_queryable = (isset($options['publicly_queryable'])) ? $options['publicly_queryable'] : $this->public;
        $this->hierarchical = (isset($options['hierarchical'])) ? $options['hierarchical'] : false;
        $this->show_ui = (isset($options['show_ui'])) ? $options['show_ui'] : $this->public;
        $this->show_in_menu = (isset($options['show_in_menu'])) ? $options['show_in_menu'] : $this->show_ui;
        $this->show_in_nav_menus = (isset($options['show_in_nav_menus'])) ? $options['show_in_nav_menus'] : $this->public;
        $this->show_tagcloud = (isset($options['show_tagcloud'])) ? $options['show_tagcloud'] : $this->show_ui;
        $this->show_in_quick_edit = (isset($options['show_in_quick_edit'])) ? $options['show_in_quick_edit'] : $this->show_ui;
        $this->show_admin_column = (isset($options['show_admin_column'])) ? $options['show_admin_column'] : true;

        if(!taxonomy_exists($this->name)){
            add_action('init', array(&$this, 'create_taxonomy'));
        }
    }

    public function create_taxonomy(){
        $labels = array(
            'name'                        => __( $this->plural, 'peaceparks' ),
            'singular_name'               => __( $this->singular, 'peaceparks' ),
            'search_items'                => __( 'Search '. $this->plural, 'peaceparks' ),
            'popular_items'               => __( 'Popular '. $this->plural, 'peaceparks' ),
            'all_items'                   => __( 'All '. $this->plural, 'peaceparks' ),
            'parent_item'                 => __( 'Parent '. $this->singular, 'peaceparks' ),
            'parent_item_colon'           => __( 'Parent '. $this->singular .':', 'peaceparks' ),
            'edit_item'                   => __( 'Edit '. $this->singular, 'peaceparks' ),
            'view_item'                   => __( 'View '. $this->singular, 'peaceparks' ),
            'update_item'                 => __( 'Update '. $this->singular, 'peaceparks' ),
            'add_new_item'                => __( 'Add New '. $this->singular, 'peaceparks' ),
            'new_item_name'               => __( 'New '. $this->singular .' Name', 'peaceparks' ),
            'separate_items_with_commas'  => __( 'Separate '. strtolower($this->plural) .' with commas', 'peaceparks' ),
            'add_or_remove_items'         => __( 'Add or remove '. strtolower($this->plural), 'peaceparks' ),
            'choose_from_most_used'       => __( 'Choose from the most used '. strtolower($this->plural), 'peaceparks' ),
            'not_found'                   => __( 'No '. strtolower($this->plural) .' found', 'peaceparks' ),
            'no_terms'                    => __( 'No '. strtolower($this->plural), 'peaceparks' ),
            'most_used'                   => __( 'Most Used '. $this->plural, 'peaceparks' ),
            'back_to_items'               => __( 'Back to '. strtolower($this->singular), 'peaceparks' )
        );
        $args = array(
            'labels'              => $labels,
            'public'              => $this->public,
            'publicly_queryable'  => $this->publicly_queryable,
            'hierarchical'        => $this->hierarchical,
            'show_ui'             => $this->show_ui,
            'show_in_menu'        => $this->show_in_menu,
            'show_in_nav_menus'   => $this->show_in_nav_menus,
            'show_tagcloud'       => $this->show_tagcloud,
            'show_in_quick_edit'  => $this->show_in_quick_edit,
            'show_admin_column'   => $this->show_admin_column,
            'rewrite'             => array( 'slug' => $this->name )
        );

        register_taxonomy( $this->name, $this->post_types, $args );
    }
}