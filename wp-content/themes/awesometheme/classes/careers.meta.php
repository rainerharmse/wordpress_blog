<?php

class careers_meta {
    private $screen;

    public function __construct(){
        $this->screen = 'careers';

        add_action('add_meta_boxes', array($this, 'register_career_meta'));
        add_action('save_post', array($this, 'save_career_meta'), 10, 2);
    }

    /**
     * register_slider_meta
     */
    public function register_career_meta(){
        add_meta_box('career_file_meta', __('Opportunity Attachment', 'peaceparks'), array($this, 'render_career_file_meta'), $this->screen,'normal');
    }

    public function render_career_file_meta($post){
        wp_nonce_field( 'opportunity_file_action', 'opportunity_file_nonce' );

        $fileID = get_post_meta($post->ID, 'opportunity-file', true);
        $file = get_post($fileID);

        ?>
        <a href="" class="button button-primary button-large custom-file-upload-button <?php if($fileID){ echo 'hidden'; } ?>"><?php _e('Set Opportunity File', 'peaceparks'); ?></a>
        <a href="" class="button button-primary button-large custom-file-remove-button <?php if(!$fileID){ echo 'hidden'; } ?>"><?php _e('Remove Opportunity File', 'peaceparks'); ?></a>
        <span class="custom-file-url"><?php if(!$fileID){ _e('No File Chosen', 'peaceparks'); } else { echo $file->guid; } ?></span>
        <input type="hidden" name="opportunity-file" id="opportunity-file" class="custom-file-id" value="<?php echo esc_attr($fileID); ?>">
        <?php
    }

    public function save_career_meta($post_id){
        // Check if nonces are set.
        if( !$this->pp_verify_nonce($_POST['opportunity_file_nonce'], 'opportunity_file_action') ){
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

        if(isset($_POST['opportunity-file'])){
            update_post_meta($post_id, 'opportunity-file', esc_attr($_POST['opportunity-file']));
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