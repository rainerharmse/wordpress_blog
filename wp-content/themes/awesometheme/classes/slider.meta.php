<?php

class slider_meta {
    private $screen;

    public function __construct(){
        $this->screen = 'home_slider';

        add_action('add_meta_boxes', array($this, 'register_slider_meta'));
        add_action('save_post', array($this, 'save_slider_meta'), 10, 2);
    }

    /**
     * register_slider_meta
     */
    public function register_slider_meta(){
        add_meta_box('slider-video-url', __('Video URL', 'peaceparks'), array($this, 'render_slider_video_url'), $this->screen,'normal');
        add_meta_box('slider-button', __('Button Settings', 'peaceparks'), array($this, 'render_slider_button_settings'), $this->screen,'normal');
        add_meta_box('slider-background-animate', __('Animate Slide Image', 'peaceparks'), array($this, 'render_slider_background_animate'), $this->screen,'side');
        add_meta_box('slider-content-alignment', __('Content Alignment', 'peaceparks'), array($this, 'render_slider_content_alignment'), $this->screen,'side');
    }

    public function render_slider_video_url($post){
        wp_nonce_field( 'slider_video_url_action', 'slider_video_url_nonce' );

        $video_url = get_post_meta($post->ID, 'video-url', true);

        ?>
        <input type="text" name="video-url" id="pp-slider-video-url" class="widefat" value="<?php echo esc_url($video_url); ?>">
        <?php
    }

    public function render_slider_button_settings($post){
        wp_nonce_field( 'slider_button_settings_action', 'slider_button_settings_nonce' );

        $button_text = get_post_meta($post->ID, 'button-text', true);
        $button_url = get_post_meta($post->ID, 'button-url', true);

        ?>
        <div class="pp-admin-field">
            <p><label for="pp-slider-button-text"><?php _e('Button Text', 'peaceparks'); ?></label></p>
            <input type="text" name="button-text" id="pp-slider-button-text" class="widefat" value="<?php echo esc_attr($button_text); ?>">
        </div>
        <div class="pp-admin-field">
            <p><label for="pp-slider-button-url"><?php _e('Button URL', 'peaceparks'); ?></label></p>
            <input type="text" name="button-url" id="pp-slider-button-url" class="widefat" value="<?php echo esc_url($button_url); ?>">
        </div>
        <div class="clear"></div>
        <?php
    }

    public function render_slider_content_alignment($post){
        wp_nonce_field( 'slider_content_alignment_action', 'slider_content_alignment_nonce' );

        $alignment = get_post_meta($post->ID, 'content-alignment', true);

        ?>
        <div class="pp-alignment-radio left-aligned">
            <input type="radio" name="content-alignment" id="pp-slider-content-align-left" <?php checked($alignment, "left"); ?> value="left">
            <label for="pp-slider-content-align-left"><span><?php _e('Left', 'peaceparks'); ?></span></label>
        </div>
        <div class="pp-alignment-radio center-aligned">
           <input type="radio" name="content-alignment" id="pp-slider-content-align-center" <?php checked($alignment, "center"); ?> value="center">
            <label for="pp-slider-content-align-center"><span><?php _e('Center', 'peaceparks'); ?></span></label>
        </div>
        <div class="pp-alignment-radio right-aligned">
            <input type="radio" name="content-alignment" id="pp-slider-content-align-right" <?php checked($alignment, "right"); ?> value="right">
            <label for="pp-slider-content-align-right"><span><?php _e('Right', 'peaceparks'); ?></span></label>
        </div>
        <div class="clear"></div>
        <?php
    }

    public function render_slider_background_animate($post){
        wp_nonce_field( 'slider_background_animate_action', 'slider_background_animate_nonce' );

        $checked = get_post_meta($post->ID, 'animate-background', true);

        ?>
        <input type="checkbox" name="animate-background" id="animate-background" <?php echo checked($checked, 1); ?> value="1">
        <p><label for="animate-background"><?php _e('Add animation to the slide image', 'peaceparks'); ?></label></p>
        <?php
    }

    public function save_slider_meta($post_id){
        // Check if nonces are set.
        if( !$this->pp_verify_nonce($_POST['slider_video_url_nonce'], 'slider_video_url_action') ){
            return;
        }
        if( !$this->pp_verify_nonce($_POST['slider_button_settings_nonce'], 'slider_button_settings_action') ){
            return;
        }
        if( !$this->pp_verify_nonce($_POST['slider_content_alignment_nonce'], 'slider_content_alignment_action') ){
            return;
        }
        if( !$this->pp_verify_nonce($_POST['slider_background_animate_nonce'], 'slider_background_animate_action') ){
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

        if(isset($_POST['video-url'])){
            update_post_meta($post_id, 'video-url', esc_url($_POST['video-url']));
        }
        if(isset($_POST['button-text'])){
            update_post_meta($post_id, 'button-text', esc_attr($_POST['button-text']));
        }
        if(isset($_POST['button-url'])){
            update_post_meta($post_id, 'button-url', esc_url($_POST['button-url']));
        }
        if(isset($_POST['content-alignment'])){
            update_post_meta($post_id, 'content-alignment', esc_attr($_POST['content-alignment']));
        }
        if(isset($_POST['animate-background'])){
            update_post_meta($post_id, 'animate-background', esc_attr($_POST['animate-background']));
        } else {
            update_post_meta($post_id, 'animate-background', 0);
        }
    }

    private function pp_verify_nonce($nonce_name, $nonce_action){
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
}