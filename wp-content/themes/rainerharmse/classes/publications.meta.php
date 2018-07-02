<?php

class publications_meta {
    private $screen;

    public function __construct(){
        $this->screen = 'publications';

        add_action('add_meta_boxes', array($this, 'register_publication_meta'));
        add_action('save_post', array($this, 'save_publication_meta'), 10, 2);
    }

    /**
     * register_slider_meta
     */
    public function register_publication_meta(){
        add_meta_box('publication_file_meta', __('Publication Attachment', 'peaceparks'), array($this, 'render_publications_upload_meta'), $this->screen,'normal');
    }

    public function render_publications_upload_meta($post){
        wp_nonce_field( 'publications_upload_action', 'publications_upload_nonce' );

        $fileID = get_post_meta($post->ID, 'publication-file', true);
        $file = get_post($fileID);

        ?>
        <a href="" class="button button-primary button-large custom-file-upload-button <?php if($fileID){ echo 'hidden'; } ?>"><?php _e('Set Publication File', 'peaceparks'); ?></a>
        <a href="" class="button button-primary button-large custom-file-remove-button <?php if(!$fileID){ echo 'hidden'; } ?>"><?php _e('Remove Publication File', 'peaceparks'); ?></a>
        <span class="custom-file-url"><?php if(!$fileID){ echo __('No File Chosen', 'peaceparks'); } else { echo $file->guid; } ?></span>
        <input type="hidden" name="publication-file" id="publication-file" class="custom-file-id" value="<?php echo esc_attr($fileID); ?>">
        <?php
    }

    public function save_publication_meta($post_id){
        // Check if nonces are set.
        if( !$this->pp_verify_nonce($_POST['publications_upload_nonce'], 'publications_upload_action') ){
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

        if(isset($_POST['publication-file'])){
            update_post_meta($post_id, 'publication-file', esc_attr($_POST['publication-file']));
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