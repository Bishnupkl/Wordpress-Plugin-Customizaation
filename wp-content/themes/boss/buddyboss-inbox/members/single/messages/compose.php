<form action="<?php bp_messages_form_action('compose' ); ?>" method="post" id="send_message_form" class="standard-form" role="main" enctype="multipart/form-data">

	<?php do_action( 'bp_before_messages_compose_content' ); ?>

	<label for="send-to-input"><?php _e("Send To (Username or Friend's Name)", 'boss' ); ?></label>
	<ul class="first acfb-holder">
		<li>
            <?php
            if( isset($_GET['draft_id']) && !empty($_GET['draft_id']) && is_numeric($_GET['draft_id']) ){
                $draft_detail = bbm_draft_row_by_draft_id($_GET['draft_id']);
                $recipient_ids = bbm_drafts_check_recipients($draft_detail->recipients);
                echo '<input type="hidden" name="compose_draft_id" id="compose_draft_id" value="'.$_GET['draft_id'].'" />';
            }
            if( isset($draft_detail->recipients) && !empty($draft_detail->recipients) ):
            bbm_drafts_get_recipient_tabs($draft_detail->recipients);
            else:
			bp_message_get_recipient_tabs();
            endif;
            ?>
			<input type="text" name="send-to-input" class="send-to-input" id="send-to-input" value="<?php if( isset( $recipient_ids ) && empty( $recipient_ids ) ) echo $draft_detail->recipients;?>" />
		</li>
	</ul>

	<?php if ( bp_current_user_can( 'bp_moderate' ) ) : ?>
	<label class="send-notice-label" for="send-notice">
		<span>
			<input type="checkbox" id="send-notice" name="send-notice" value="1" />
		</span>
		<span class="text"><?php _e( "This is a notice to all users.", "boss" ); ?></span>
	</label>
	<?php endif; ?>

	<label for="subject"><?php _e( 'Subject', 'boss' ); ?></label>
	<input type="text" name="subject" id="subject" value="<?php echo ( isset($draft_detail->draft_subject) && !empty($draft_detail->draft_subject) ) ? $draft_detail->draft_subject : bp_get_messages_subject_value(); ?>" />

	<label for="content"><?php _e( 'Message', 'boss' ); ?></label>

    <?php
    $content = ( isset($draft_detail->draft_content) && !empty($draft_detail->draft_content) ) ? $draft_detail->draft_content : bp_get_messages_content_value();
    $editor_feature = buddyboss_messages()->option('editor_feature');
    if(!$editor_feature){
        echo '<textarea name="content" id="message_content" rows="15" cols="40">'.$content.'</textarea>';
    }else{

        $editor_id = 'message_content';
        $settings = array(
            'media_buttons' => false,
            'textarea_name' => 'content',
            'textarea_rows' => 15
        );
        wp_editor( $content, $editor_id, $settings );
    }
    ?>

    <input type="hidden" name="send_to_usernames" id="send-to-usernames" value="<?php echo ( isset($draft_detail->recipients) && !empty($draft_detail->recipients) ) ? $draft_detail->recipients : bp_get_message_get_recipient_usernames(); ?>" class="<?php echo ( isset($draft_detail->recipients) && !empty($draft_detail->recipients) ) ? $draft_detail->recipients : bp_get_message_get_recipient_usernames(); ?>" />
    <input type="hidden" name="draft_uniqid" id="draft_uniqid" value="<?php echo uniqid();?>" />

	<?php do_action( 'bp_after_messages_compose_content' ); ?>

	<div class="submit">
		<input type="submit" value="<?php esc_attr_e( "Send Message", 'boss' ); ?>" name="send" id="send" />
	</div>

	<?php wp_nonce_field( 'messages_send_message' ); ?>
</form>

<script type="text/javascript">
	document.getElementById("send-to-input").focus();
</script>

