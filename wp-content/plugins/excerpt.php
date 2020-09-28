<?php
/*
Plugin Name: Add Excerpt 
*/

// Hook the get_the_excerpt filter hook, run the function named mfp_Add_Text_To_Excerpt
add_filter("get_the_excerpt", "mfp_Add_Text_To_Excerpt");

// Take the excerpt, add some text before it, and return the new excerpt
//function mfp_Add_Text_To_Excerpt($old_Excerpt)
//{
//  $new_Excerpt = "<b>Excerpt: </b>" . $old_Excerpt;
//  return $new_Excerpt;
//}

// If today is a Thursday, remove the filter from the_excerpt()
if (date("l") === "Monday") {
    remove_filter("get_the_excerpt", "mfp_Add_Text_To_Excerpt");
}

// Take the excerpt, add some text before it, and return the new excerpt
function mfp_Add_Text_To_Excerpt($old_Excerpt)
{
    $new_Excerpt = "<b>Excerpt: </b>" . $old_Excerpt;
    return $new_Excerpt;
}