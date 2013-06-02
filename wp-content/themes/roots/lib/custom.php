<?php
/**
 * Custom functions
 */
function custom_query_shortcode($atts) {

   // EXAMPLE USAGE:
   // [loop the_query="showposts=100&post_type=page&post_parent=453"]

   // Defaults
   extract(shortcode_atts(array(
      "the_query" => ''
   ), $atts));

   // de-funkify query
   $the_query = preg_replace('~&#x0*([0-9a-f]+);~ei', 'chr(hexdec("\\1"))', $the_query);
   $the_query = preg_replace('~&#0*([0-9]+);~e', 'chr(\\1)', $the_query);

   // query is made
   query_posts($the_query);

   // Reset and setup variables
   $output = '';
   $temp_title = '';
   $temp_link = '';
   $temp_image = '';
   $temp_tag = '';

   // the loop
   if (have_posts()) : while (have_posts()) : the_post();

      $temp_title = get_the_title($post->ID);
      $temp_link = get_permalink($post->ID);
      $temp_excerpt = get_the_content($post->ID);
      $temp_image = get_the_post_thumbnail($post->ID, 'large');
      $temp_tag = get_the_tag_list('<ul><li>','</li><li>','</li></ul>');

      // output all findings - CUSTOMIZE TO YOUR LIKING
      $output .= "
      <li>
      <h4><a href='$temp_link' title='$temp_title'>$temp_title</a></h4>
      </li>";

   endwhile; else:

      $output .= "nothing found.";

   endif;

   wp_reset_query();
   return $output;

}

add_shortcode("loop", "custom_query_shortcode");
