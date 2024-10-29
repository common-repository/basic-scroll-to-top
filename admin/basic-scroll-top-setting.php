<?php
class Basic_scrolltop_admin {

    public function __construct() {
        add_action( 'admin_enqueue_scripts', array( $this, 'basicscrolltop_admin_script' ));
        add_action( 'admin_footer', array( $this, 'media_selector_print_scripts' ));
        // Hook into the admin menu
        add_action('admin_menu',  array( $this, 'basic_scrolltop_admin_menu'));
        // Add Settings and Fields
        add_action( 'admin_init', array( $this, 'basic_scrolltop_setup_sections' ) );
        add_action( 'admin_init', array( $this, 'basic_scrolltop_setup_fields' ) );
    }

    //Load admin Script
    public function basicscrolltop_admin_script($hook) {
        if($hook == 'settings_page_basicscrolltop'){
        // Add the color picker css file       
        wp_enqueue_style( 'wp-color-picker' ); 
        wp_enqueue_media(); 
        // Include our custom jQuery file with WordPress Color Picker dependency
        wp_enqueue_script( 'basicscrolltop-custom-admin', BASIC_SCROLLTOP_URL . 'admin/js/custom.js', array( 'wp-color-picker' ), BASIC_SCROLLTOP_VERSION,
         true ); 
        wp_register_style( 'basicscrolltop-admin', BASIC_SCROLLTOP_URL . 'admin/css/basicscrolltop-admin.css', array(), BASIC_SCROLLTOP_VERSION );
        wp_enqueue_style( 'basicscrolltop-admin' );
     }
    }

    //ref: https://codex.wordpress.org/Function_Reference/add_options_page
    public function basic_scrolltop_admin_menu() {
      add_options_page('Scroll to Top', 
                        'Scroll to Top', 
                        'manage_options', 
                        'basicscrolltop', 
                        array($this,'basic_scrolltop_settings_page_content') 
                        );
    }
    //Show the content on the setting page
    public function basic_scrolltop_settings_page_content() {?>
        <div class="wrap">
            <h2><?php esc_html_e( __('Scroll to Top Settings', 'basic-scroll-top')); ?></h2><?php
            if ( sanitize_text_field(isset( $_GET['settings-updated'] )) && sanitize_text_field(isset($_GET['settings-updated'] )))
            {
                  $this->basic_scrolltop_admin_notice();
            }  ?>
            <form method="POST" action="options.php">
                <?php

                    settings_fields( 'basic_scrolltop_admin_fields' );
                    do_settings_sections( 'basic_scrolltop_admin_fields' );
                    submit_button();
                ?>
            </form>
        </div> <?php
    }
    
    public function basic_scrolltop_admin_notice() { ?>
        <div class="notice notice-success is-dismissible">
            <p><?php echo esc_html( __('Your settings have been updated!', 'basic-scroll-top')); ?></p>
        </div><?php
    }
    public function basic_scrolltop_setup_sections() {
        add_settings_section( 'our_first_section', '', array( $this, 'basic_scrolltop_section_callback' ), 'basic_scrolltop_admin_fields' );
       
    }
    public function basic_scrolltop_section_callback( $arguments ) {
        switch( $arguments['id'] ){
            case 'our_first_section':
                echo esc_html( __('', 'basic-scroll-top'));;
                break;
        }
    }
    public function basic_scrolltop_setup_fields() {
        $fields = array(
            array(
                'uid' => 'scroll_enable',
                'label' => __('Enable', 'basic-scroll-top'),
                'section' => 'our_first_section',
                'type' => 'checkbox',
                'options' => array(
                    'yes' => __('Enable Scroll to Top?', 'basic-scroll-top'),
                ),
                'default' => array(__('', 'basic-scroll-top')),
                'helper' => '',
                'supplimental' => '',
            ),
            array(
                'uid' => 'scroll_position',
                'label' => __('Position', 'basic-scroll-top'),
                'section' => 'our_first_section',
                'type' => 'radio',
                'options' => array(
                    'right' => __('Right', 'basic-scroll-top'),
                    'left' => __('Left', 'basic-scroll-top'),
                ),
                'default' => array(__('Right', 'basic-scroll-top')),
                'helper' => '',
                'supplimental' => '',
            ),
            array(
                'uid' => 'scroll_type',
                'label' => __('Type', 'basic-scroll-top'),
                'section' => 'our_first_section',
                'type' => 'radio',
                'options' => array(
                    'text' => __('Text', 'basic-scroll-top'),
                    'img' => __('Image', 'basic-scroll-top'),
                ),
                'default' => array(__('Text', 'basic-scroll-top')),
                'helper' => '',
                'supplimental' => '',
            ),
            array(
                'uid' => 'scroll_size',
                'label' => __('Size', 'basic-scroll-top'),
                'section' => 'our_first_section',
                'type' => 'number',
                'placeholder' => __('50','basic-scroll-top'),
                'helper' => '',
                'default' => '',
                'supplimental' => 'Height and Width of the scroll.',
            ),
            array(
                'uid' => 'scroll_offset',
                'label' => __('Scroll Offset', 'basic-scroll-top'),
                'section' => 'our_first_section',
                'type' => 'number',
                'placeholder' => __('200','basic-scroll-top'),
                'helper' => '',
                'default' => '',
                'supplimental' => '',
            ),
            array(
                'uid' => 'scroll_bottom_margin',
                'label' => __('Bottom Margin', 'basic-scroll-top'),
                'section' => 'our_first_section',
                'type' => 'number',
                'placeholder' => __('10','basic-scroll-top'),
                'helper' => '',
                'default' => '',
                'supplimental' => '',
            ),
            array(
                'uid' => 'scroll_right_margin',
                'label' => __('Left/Right Margin', 'basic-scroll-top'),
                'section' => 'our_first_section',
                'type' => 'number',
                'placeholder' => __('10','basic-scroll-top'),
                'helper' => '',
                'default' => '',
                'supplimental' => '',
            ),
            array(
                'uid' => 'scroll_button_bgcolor',
                'label' => __('Background Color', 'basic-scroll-top'),
                'section' => 'our_first_section',
                'type' => 'color',
                'default' => '#000000',
                'helper' => '',
                'supplimental' => '',
            ),
            array(
                'uid' => 'scroll_button_color',
                'label' => __('Color', 'basic-scroll-top'),
                'section' => 'our_first_section',
                'type' => 'color',
                'default' => '#ffffff',
                'helper' => '',
                'supplimental' => '',
            ),
            array(
                'uid' => 'scroll_duration',
                'label' => __('Scroll Duration', 'basic-scroll-top'),
                'section' => 'our_first_section',
                'type' => 'number',
                'placeholder' => __('500','basic-scroll-top'),
                'helper' => '',
                'default' => '',
                'supplimental' => '',
            ),
            array(
                'uid' => 'scroll_text',
                'label' => __('Text', 'basic-scroll-top'),
                'section' => 'our_first_section',
                'type' => 'text',
                'placeholder' => __('Top','basic-scroll-top'),
                'helper' => '',
                'default' => '',
                'supplimental' => '',
            ),
            array(
                'uid' => 'scroll_image',
                'label' => 'Scroll Image',
                'section' => 'our_first_section',
                'type' => 'media',
                'default' => '',
                'helper' => '',
                'supplimental' => '',
            )
            
        );
        foreach( $fields as $field ){
            add_settings_field( $field['uid'], $field['label'], array( $this, 'basic_scrolltop_field_callback' ), 'basic_scrolltop_admin_fields', $field['section'], $field );
            register_setting( 'basic_scrolltop_admin_fields', $field['uid'] );
        }
    }
    public function basic_scrolltop_field_callback( $arguments ) {
        $value = get_option( $arguments['uid'] );
        if( ! $value ) {
            $value = $arguments['default'];
        }
        switch( $arguments['type'] ){
            case 'text':
            case 'password':
            case 'number':
                printf( '<input name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" />', sanitize_text_field($arguments['uid']), $arguments['type'], $arguments['placeholder'], sanitize_text_field($value) );
                break;
            case 'textarea':
                printf( '<textarea name="%1$s" id="%1$s" placeholder="%2$s" rows="5" cols="50">%3$s</textarea>', sanitize_text_field($arguments['uid']), $arguments['placeholder'], sanitize_text_field($value) );
                break;
            case 'select':
            case 'multiselect':
                if( ! empty ( $arguments['options'] ) && is_array( $arguments['options'] ) ){
                    $attributes = '';
                    $options_markup = '';
                    foreach( $arguments['options'] as $key => $label ){
                        $options_markup .= sprintf( '<option value="%s" %s>%s</option>', $key, selected( $value[ array_search( $key, $value, true ) ], $key, false ), $label );
                    }
                    if( $arguments['type'] === 'multiselect' ){
                        $attributes = ' multiple="multiple" ';
                    }
                    printf( '<select name="%1$s[]" id="%1$s" %2$s>%3$s</select>', sanitize_title($arguments['uid']), $attributes, $options_markup );
                }
                break;
            case 'radio':
            case 'checkbox':
                if( ! empty ( $arguments['options'] ) && is_array( $arguments['options'] ) ){
                    $options_markup = '';
                    $iterator = 0;
                    foreach( $arguments['options'] as $key => $label ){
                        $iterator++;
                        $options_markup .= sprintf( '<label for="%1$s_%6$s"><input id="%1$s_%6$s" name="%1$s[]" type="%2$s" value="%3$s" %4$s /> %5$s</label><br/>', $arguments['uid'], $arguments['type'], $key, checked( $value[ array_search( $key, $value, true ) ], $key, false ), $label, $iterator );
                    }
                    printf( '<fieldset>%s</fieldset>', $options_markup );
                }
                break;
            case 'color':
                printf( '<input name="%1$s" id="%1$s" type="text" value="%3$s" class="color-field" />', $arguments['uid'], $arguments['type'], sanitize_hex_color($value) );
                break;    
            case 'media':
                    $imgshow = '';
                    if($value)
                    { $imgshow = ' bl-img-show'; }
                    $options_markup = '';
                   
                    $options_markup .= "<div class='image-preview-wrapper".$imgshow."'>";
                    $options_markup .= "<img class='bl-image-preview' src='". $value."'>";
                   
                        $options_markup .= '<span class="bliss-img-icon"><span class="remove_image_button dashicons dashicons-no-alt"></span><span onclick="bliss_media_popup(this)" class="dashicons dashicons-edit"></span></span>';
                  
                    $options_markup .= '<input class="bl_image_button button" onclick="bliss_media_popup(this)" type="button" value="Upload image" />';
                    $options_markup .= "<input type='hidden' name='".$arguments['uid']."' class='bl_image_attachment_id' value='".$value."'>";
                    $options_markup .= "</div>";
                printf( '<fieldset class="bliss-media-section">%s</fieldset>', $options_markup );
                break;     
        }
        if( $helper = $arguments['helper'] ){
            printf( '<span class="helper"> %s</span>', $helper );
        }
        if( $supplimental = $arguments['supplimental'] ){
            printf( '<p class="description">%s</p>', $supplimental );
        }
       
    }

    public function media_selector_print_scripts() {
        $my_saved_attachment_post_id = get_option( 'media_selector_attachment_id', 0 );
        ?><script type='text/javascript'>
            function bliss_media_popup(event) {
                // Uploading files
                var file_frame;
                var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
                var set_to_post_id = <?php esc_html_e($my_saved_attachment_post_id,'basic-scroll-top'); ?>; // Set this
                    //event.preventDefault();
                    // If the media frame already exists, reopen it.
                    if ( file_frame ) {
                        // Set the post ID to what we want
                        file_frame.uploader.uploader.param( 'post_id', set_to_post_id );
                        // Open frame
                        file_frame.open();
                        return;
                    } else {
                        // Set the wp.media post id so the uploader grabs the ID we want when initialised
                        wp.media.model.settings.post.id = set_to_post_id;
                    }
                    // Create the media frame.
                    file_frame = wp.media.frames.file_frame = wp.media({
                        title: 'Select a image to upload',
                        button: {
                            text: 'Use this image',
                        },
                        multiple: false // Set to true to allow multiple files to be selected
                    });
                    // When an image is selected, run a callback.
                    file_frame.on( 'select', function() {
                        // We set multiple to false so only get one image from the uploader
                        attachment = file_frame.state().get('selection').first().toJSON();
                        // Do something with attachment.id and/or attachment.url here
                        jQuery(event).parents('.image-preview-wrapper').find( '.bl-image-preview' ).attr( 'src', attachment.url );
                        jQuery(event).parents('.image-preview-wrapper').addClass('bl-img-show');
                       jQuery(event).parents('.image-preview-wrapper').find( '.bl_image_attachment_id' ).val( attachment.url );
                        // Restore the main post ID
                        wp.media.model.settings.post.id = wp_media_post_id;
                    });
                        // Finally, open the modal
                        file_frame.open();
                
                // Restore the main ID when the add media button is pressed
                jQuery( 'a.add_media' ).on( 'click', function() {
                    wp.media.model.settings.post.id = wp_media_post_id;
                });
            }
           
        </script><?php
    }
}
new Basic_scrolltop_admin();
?>