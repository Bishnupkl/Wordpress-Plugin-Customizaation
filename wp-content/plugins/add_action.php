
<?php
 
// Hook the 'wp_footer' action, run the function named 'mfp_Add_Text()'
add_action("wp_footer", "mfp_Add_Text");
 
// Hook the 'wp_head' action, run the function named 'mfp_Remove_Text()'
add_action("wp_head", "mfp_Remove_Text");
 
// Define the function named 'mfp_Add_Text('), which just echoes simple text
function mfp_Add_Text()
{
  echo "<p style='color: #000;'>After the footer is loaded, my text is added!</p>";
}
 
// Define the function named 'mfp_Remove_Text()' to remove our previous function from the 'wp_footer' action
function mfp_Remove_Text()
{
  if (date("l") === "Tuesday") {
    // Target the 'wp_footer' action, remove the 'mfp_Add_Text' function from it
    remove_action("wp_footer", "mfp_Add_Text");
  }
}