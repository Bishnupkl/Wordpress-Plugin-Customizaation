<?php

if( class_exists( 'WP_Customize_Control' ) ) {

    class Magazine_Newspaper_Custom_Text extends WP_Customize_Control {
        public $type = 'customtext';
        public function render_content() {
        ?>
        <label>            
            <h3><i><?php echo esc_html( $this->label ); ?></i></h3>
        </label>
        <?php
        }
    }
}