<?php
/*
 * Add my new menu to the Admin Control Panel
 */


// Hook the 'admin_menu' action hook, run the function named 'mfp_Add_My_Admin_Link()'
add_action( 'admin_menu', 'mfp_Add_My_Admin_Link' );

// Add a new top level menu link to the ACP
function mfp_Add_My_Admin_link()
{
    add_menu_page(
        'My First Page',
        'My First Plugin',
        'manage_options',
        'my-first-plugin/includes/mfp-first-acp-page.php'

    );
}