<?php

class peace_parks_menus {
    public function __construct(){
        add_action('admin_menu', array($this, 'init_menu_pages'));
    }

    public function init_menu_pages(){
        add_menu_page('Theme Settings', __('Theme Settings', 'peaceparks'),'manage_options','theme-settings',array($this, 'render_theme_api_settings'));
        add_submenu_page('theme-settings', __('Social Settings', 'peaceparks'), __('Social', 'peaceparks'),'manage_options','social-settings',array($this, 'render_social_settings'));
        add_submenu_page('theme-settings', __('Donors and Partners', 'peaceparks'), __('Donors and Partners', 'peaceparks'),'manage_options','donors-partners-settings',array($this, 'render_donor_partner_settings'));
    }

    public function render_social_settings(){
        ?>
        <div class="wrap">
            <h2><?php _e('Theme Settings', 'peaceparks'); ?></h2>
            <form method="post" action="options.php">
                <?php settings_fields('social-settings'); ?>
                <?php do_settings_sections('social-settings-page'); ?>
                <?php submit_button(); ?>
            </form>
        </div>
        <?php
    }

    public function render_theme_api_settings(){
        ?>
        <div class="wrap">
            <h2><?php _e('Theme Settings', 'peaceparks'); ?></h2>
            <!--<form method="post" action="options.php">
                <?php /*settings_fields('social-settings'); */?>
                <?php /*do_settings_sections('social-settings-page'); */?>
                <?php /*submit_button(); */?>
            </form>-->
        </div>
        <?php
    }

    public function render_donor_partner_settings(){
        ?>
        <div class="wrap">
            <h2><?php _e('Theme Settings', 'peaceparks'); ?></h2>
            <!--<form method="post" action="options.php">
                <?php /*settings_fields('social-settings'); */?>
                <?php /*do_settings_sections('social-settings-page'); */?>
                <?php /*submit_button(); */?>
            </form>-->
        </div>
        <?php
    }
}