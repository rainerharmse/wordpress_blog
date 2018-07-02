<?php

class peace_parks_options {
    public function __construct(){
        add_action('admin_menu', array($this, 'social_settings_options'));
    }

    public function social_settings_options(){
        if(!get_option('social-settings')){
            add_option('social-settings');
        }
        add_settings_section('social-settings', __('Social Media Settings', 'peaceparks'), array($this, 'render_social_settings'),'social-settings-page');
        add_settings_field('facebook', __('Facebook', 'peaceparks'),array($this, 'facebook_field'),'social-settings-page','social-settings');
        add_settings_field('twitter', __('Twitter', 'peaceparks'),array($this, 'twitter_field'),'social-settings-page','social-settings');
        add_settings_field('instagram', __('Instagram', 'peaceparks'),array($this, 'instagram_field'),'social-settings-page','social-settings');
        add_settings_field('youtube', __('YouTube', 'peaceparks'),array($this, 'youtube_field'),'social-settings-page','social-settings');
        register_setting('social-settings', 'social-settings');
    }

    public function render_social_settings(){
        echo '<p>'. __('Provide the URL to the social networks you\'d like to display.', 'peaceparks') .'</p>';
    }

    public function facebook_field(){
        $social = get_option('social-settings');
        echo '<input name="social-settings[facebook]" id="facebook" class="regular-text" value="'. $social['facebook'] .'">';
    }

    public function twitter_field(){
        $social = get_option('social-settings');
        echo '<input name="social-settings[twitter]" id="twitter" class="regular-text" value="'. $social['twitter'] .'">';
    }

    public function instagram_field(){
        $social = get_option('social-settings');
        echo '<input name="social-settings[instagram]" id="instagram" class="regular-text" value="'. $social['instagram'] .'">';
    }

    public function youtube_field(){
        $social = get_option('social-settings');
        echo '<input name="social-settings[youtube]" id="youtube" class="regular-text" value="'. $social['youtube'] .'">';
    }
}