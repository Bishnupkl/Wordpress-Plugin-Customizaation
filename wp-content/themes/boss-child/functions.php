<?php
/**
 * @package Boss Child Theme
 * The parent theme functions are located at /boss/buddyboss-inc/theme-functions.php
 * Add your own functions in this file.
 */

/**
 * Sets up theme defaults
 *
 * @since Boss Child Theme 1.0.0
 */
function boss_child_theme_setup()
{
  /**
   * Makes child theme available for translation.
   * Translations can be added into the /languages/ directory.
   * Read more at: http://www.buddyboss.com/tutorials/language-translations/
   */

  // Translate text from the PARENT theme.
  load_theme_textdomain( 'boss', get_stylesheet_directory() . '/languages' );

  // Translate text from the CHILD theme only.
  // Change 'boss' instances in all child theme files to 'boss_child_theme'.
  // load_theme_textdomain( 'boss_child_theme', get_stylesheet_directory() . '/languages' );

}
add_action( 'after_setup_theme', 'boss_child_theme_setup' );

/**
 * Enqueues scripts and styles for child theme front-end.
 *
 * @since Boss Child Theme  1.0.0
 */
function boss_child_theme_scripts_styles()
{
  /**
   * Scripts and Styles loaded by the parent theme can be unloaded if needed
   * using wp_deregister_script or wp_deregister_style.
   *
   * See the WordPress Codex for more information about those functions:
   * http://codex.wordpress.org/Function_Reference/wp_deregister_script
   * http://codex.wordpress.org/Function_Reference/wp_deregister_style
   **/

  /*
   * Styles
   */
  wp_enqueue_style( 'boss-child-custom', get_stylesheet_directory_uri().'/css/custom.css' );
}
add_action( 'wp_enqueue_scripts', 'boss_child_theme_scripts_styles', 9999 );


/****************************** CUSTOM FUNCTIONS ******************************/

// Add your own custom functions here
remove_action( 'login_head', 'buddyboss_custom_login_logo' );
function admin_bar(){

  if(is_user_logged_in()){
    add_filter( 'show_admin_bar', '__return_true' , 1000 );
  }
}
add_action('init', 'admin_bar' );


add_filter( 'bp_learndash_user_courses_atts', 'learndash_course_orderby_date', 10, 1 );
function learndash_course_orderby_date( $atts ) {
$atts['orderby']    = 'date';
$atts['order']      = 'ASC';
return $atts;
}
function custom_remove_all_quantity_fields( $return, $product ) {return true;}
add_filter( 'woocommerce_is_sold_individually','custom_remove_all_quantity_fields', 10, 2 );

/****************************** Product User Roles ******************************/

add_action( 'woocommerce_order_status_completed', 'wpglorify_change_role_on_purchase' );

function wpglorify_change_role_on_purchase( $order_id ) {

// get order object and items
	$order = new WC_Order( $order_id );
	$items = $order->get_items();

	$product_id = 6355; // that's a specific product ID

	foreach ( $items as $item ) {

		if( $product_id == $item['product_id'] && $order->user_id ) {
			$user = new WP_User( $order->user_id );

			// Remove old role
            $user->remove_role( 'customer' ); 

            // Add new role
            $user->add_role( 'subscriber' );
		}
	}
	$order = new WC_Order( $order_id );
	$items = $order->get_items();

	$product_id = 14592; // that's a specific product ID

	foreach ( $items as $item ) {

		if( $product_id == $item['product_id'] && $order->user_id ) {
			$user = new WP_User( $order->user_id );

			// Remove old role
            $user->remove_role( 'customer' ); 

            // Add new role
            $user->add_role( 'contributor' );
		}
	}
}

/**
 * Auto Complete all WooCommerce orders.
 */
add_action( 'woocommerce_thankyou', 'custom_woocommerce_auto_complete_order' );
function custom_woocommerce_auto_complete_order( $order_id ) { 
    if ( ! $order_id ) {
        return;
    }

    $order = wc_get_order( $order_id );
    $order->update_status( 'completed' );
}

//Manage lms quiz shortcode to allow easy quiz id by yagya
add_action( 'init', 'manage_lms_quiz_shortcodes' );
function manage_lms_quiz_shortcodes(){
  remove_shortcode( 'quizinfo', 'learndash_quizinfo' );
  add_shortcode( 'quizinfo', 'learndash_customize_quizinfo' );
}

/**
 * Shortcode that displays the requested quiz information
 * 
 * @since 2.1.0
 * 
 * @param  array $attr shortcode attributes
 * @return string      shortcode output
 */
function learndash_customize_quizinfo( $attr ) {
  global $learndash_shortcode_used;
  $learndash_shortcode_used = true;
  
  $shortcode_atts = shortcode_atts(
    array(
      'show'    => '', //[score], [count], [pass], [rank], [timestamp], [pro_quizid], [points], [total_points], [percentage], [timespent]
      'user_id' => '',
      'quiz'    => '',
      'quizid'    => '',
      'quizID'    => '',
      'time'    => '',
      'format'  => 'F j, Y, g:i a',
    ), 
    $attr 
  );

  extract( $shortcode_atts );

  $time    = ( empty( $time ) && isset( $_REQUEST['time'] ) ) ? $_REQUEST['time'] : $time;
  $show    = ( empty( $show ) && isset( $_REQUEST['show'] ) ) ? $_REQUEST['show'] : $show;  
  $quiz    = ( empty( $quiz ) && isset( $_REQUEST['quiz'] ) ) ? $_REQUEST['quiz'] : $quiz;
  if( empty($quiz) && !empty($quizid) ){
    $quiz = $quizid;
  }
  if( empty($quiz) && !empty($quizID) ){
    $quiz = $quizID;
  }
  $user_id = ( empty( $user_id ) && isset( $_REQUEST['user_id'] ) ) ? $_REQUEST['user_id'] : $user_id;
  $course_id = ( empty( $course_id ) && isset( $_REQUEST['course_id'] ) ) ? $_REQUEST['course_id'] : null;

  if ( empty( $user_id ) ) {
    $user_id = get_current_user_id();
    
    /**
     * Added logic to allow admin and group_leader to view certificate from other users. 
     * @since 2.3
     */
    $post_type = '';
    if ( get_query_var( 'post_type' ) ) {
      $post_type = get_query_var( 'post_type' );
    }

    if ( $post_type == 'sfwd-certificates' ) {
      if ( ( ( learndash_is_admin_user() ) || ( learndash_is_group_leader_user() ) ) && ( ( isset( $_GET['user'] ) ) && (!empty( $_GET['user'] ) ) ) ) {
        $user_id = intval( $_GET['user'] );
      }
    }
  }
  if ( empty( $quiz) || empty( $user_id ) || empty( $show) ) {
    return '';
  }



  $quizinfo = get_user_meta( $user_id, '_sfwd-quizzes', true );

  $selected_quizinfo = '';
  $selected_quizinfo2 = '';
  
  foreach ( $quizinfo as $quiz_i ) {

    if ( isset( $quiz_i['time'] ) && $quiz_i['time'] == $time && $quiz_i['quiz'] == $quiz ) {
      $selected_quizinfo = $quiz_i;
      break;
    }

    if ( $quiz_i['quiz'] == $quiz ) {
      $selected_quizinfo2 = $quiz_i;
    }
  }

  $selected_quizinfo = empty( $selected_quizinfo ) ? $selected_quizinfo2 : $selected_quizinfo;

  switch ( $show ) {
    case 'timestamp':
      date_default_timezone_set( get_option( 'timezone_string' ) );
      $selected_quizinfo['timestamp'] = date_i18n( $format, $selected_quizinfo['time'] );
      break;

    case 'percentage':    
      if ( empty( $selected_quizinfo['percentage'] ) ) {
        $selected_quizinfo['percentage'] = empty( $selected_quizinfo['count'] ) ? 0 : $selected_quizinfo['score'] * 100 / $selected_quizinfo['count'];
      }

      break;

    case 'pass':
      $selected_quizinfo['pass'] = ! empty( $selected_quizinfo['pass'] ) ? esc_html__( 'Yes', 'learndash' ) : esc_html__( 'No', 'learndash' );
      break;

    case 'quiz_title':
      $quiz_post = get_post( $quiz );

      if ( ! empty( $quiz_post->post_title) ) {
        $selected_quizinfo['quiz_title'] = $quiz_post->post_title;
      }

      break;

    case 'course_title':
      if ( ( isset( $selected_quizinfo['course'] ) ) && ( !empty( $selected_quizinfo['course'] ) ) ) {
        $course_id = intval( $selected_quizinfo['course'] );
      } else {
        $course_id = learndash_get_setting( $quiz, 'course' );
      }
      if ( !empty( $course_id ) ) {
        $course = get_post( $course_id );
        if ( ( is_a( $course, 'WP_Post' ) ) && ( ! empty( $course->post_title) ) ) {
          $selected_quizinfo['course_title'] = $course->post_title;
        }
      }

      break;

    case 'timespent':
      $selected_quizinfo['timespent'] = isset( $selected_quizinfo['timespent'] ) ? learndash_seconds_to_time( $selected_quizinfo['timespent'] ) : '';
      break;

  }
  
  if ( isset( $selected_quizinfo[ $show ] ) ) {
    return apply_filters( 'learndash_quizinfo', $selected_quizinfo[ $show ], $shortcode_atts );
  } else {
    return apply_filters( 'learndash_quizinfo', '', $shortcode_atts );
  }
}

add_action( 'wp_footer', 'disable_after_post_render' );
//add_action( 'gform_loaded', 'disable_after_post_render', 10, 0 );
function disable_after_post_render() {
    ?>
    <script type="text/javascript">
		jQuery(document).on('gform_post_render', function(){
		   jQuery('#learndash_mark_complete_button').addClass('gdisabled');  
		});

		if (jQuery( "a" ).hasClass( "resume_form_link" )) {
		    var url = (jQuery('.resume_form_link').attr('href'));
			//var r = confirm("Want to continue to the saved form now?");
			//if (r == true) {
			  //window.location = url; 
			//}
		}
    </script>
    <?php
}

add_filter( 'gform_save_and_continue_resume_url', function( $resume_url, $form, $token, $email ) {
    
    return $resume_url;
}, 10, 4 );

// change the link of menu by gravity saved token link for quiz in the course menu by yagya
add_filter('wp_nav_menu_items','search_box_function', 10, 2);
function search_box_function( $nav, $args ) {
    if( $args->theme_location == 'left-panel-menu'  ){
        preg_match('~<li id="menu-item-14187"[^>]*>(.*?)</li>~si', $nav, $nav_item);
        if( $nav_item[1] != ""){
            preg_match('/href=["\']?([^"\'>]+)["\']?/', $nav_item[1], $match);
            if( $match[1] !="" ){
              $curr_url = $match[1];
              global $wpdb;
              $curr_user_id = get_current_user_id();
              $user_datas = $wpdb->get_row("SELECT uuid,submission FROM {$wpdb->prefix}gf_draft_submissions WHERE form_id = 2 AND source_url LIKE '%topic/log-sheet/%' AND submission LIKE '%".$curr_user_id."%' ORDER BY date_created DESC LIMIT 1");
             if( !empty($user_datas->submission) ){
               $user_data_arr = json_decode($user_datas->submission);
               $submitted_user = $user_data_arr->partial_entry->created_by;
               if(get_current_user_id()==$submitted_user){
                  $token_url = site_url('/topic/log-sheet/?gf_token='.$user_datas->uuid);
                  $nav = str_replace($curr_url, $token_url, $nav);
               }
             }
            }
        }

    }

    return $nav;
}

add_action( 'admin_menu', 'extra_post_info_menu' ); 

function extra_post_info_menu(){
    $page_title = 'Locked Out User';   $menu_title = 'Locked Out User';   $capability = 'manage_options';   $menu_slug  = 'locaked-out-user';   $function   = 'locked_out_user_page';   $icon_url   = 'dashicons-admin-users';   $position   = 110;    
    add_menu_page( $page_title,$menu_title,$capability,$menu_slug,$function,$icon_url,$position ); 
  } 

  function locked_out_user_page(){
      global $status, $page, $wpdb, $table_prefix;
      //Set parent defaults
      // echo "here i am ";die();
    $data = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}usermeta WHERE meta_key LIKE '%quiz_result%'");

          $me=$wpdb->get_results( "SELECT * FROM {$wpdb->prefix}usermeta JOIN {$wpdb->prefix}users ON {$wpdb->prefix}usermeta.user_id = {$table_prefix}users.ID AND meta_key LIKE '%quiz_result%'");
    
  $user_id=$_GET['user_id'];
  $user_meta=$_GET['meta_key'];
  if($user_id && $user_meta ){
    $u=update_user_meta($user_id,$user_meta,'true');
// var_dump($u);die();
  }


$a="";
$a.="<div class='wrap'>
      <table  class='wp-list-table widefat fixed striped nicelinks'>
      <thead>
      <tr>
      <th>User ID </th>
      <th>User Name </th>
      <th>User Meta ID </th>
      <th>Quiz Result </th>
      <th>Action</th>
      </tr>
      </thead>
      <tbody>
      ";

    foreach ($me as $key => $d) {
      // var_dump($d);
      if($d->meta_value=="false"){
      $a.="<tr>";
      $a.="<td>".$d->user_id."</td>";
      $a.="<td>".$d->display_name."</td>";
      $a.="<td>".$d->umeta_id."</td>";
      $a.="<td>Fail</td>";
      $a.="<td>
            <form method='get'>
            <input type='hidden' name='user_id' value=".$d->user_id.">
            <input type='hidden' name='page' value='locaked-out-user'>
            <input type='hidden' name='meta_key' value=".$d->meta_key.">
            <input type='submit' class='button' value='Locked In'>
            </form>
      </td>";
     $a.= "</tr>";
   }
    }
 $a.="</tbody>
      </table>";

      echo $a;
    
      
    }
  
  

  function update_quiz_usermeta(){

    $user_id=$_GET['user_id'];
    var_dump($user_id);die();

  }