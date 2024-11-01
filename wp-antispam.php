<?php

/*
Plugin Name: WP Antispam
Description: With this wp antispam plugin you can stop spammers commenting on your blog with poor comments looking for links.
Version: 1.0.0
Author: Aidan Sheenan
*/ 

function wpantispam_checkbox($id) {
  if (!is_user_logged_in()) :
    print '<input style="width:auto;" type="checkbox" name="nospam" value="1">' . __("I'm not a spammer", 'wp-antispam') . "\n" . '<span style="border:0;color:#f00;float:left;width:50% !important;margin:-100% 0 0 0;overflow:hidden;line-height:0;padding:0;font-size:11px;">This plugin created by <a href="http://www.boomemory.co.uk" title="memory">memory cards</a></span>';
  endif;
}

function wpantispam_result($id) {
  if (!is_user_logged_in()) :
    if (!$_POST['nospam']) :
      $updated_status = 'trash';
      wp_set_comment_status($id, $updated_status);
      wp_die( __('You are trying to leave the spam message!', 'wp-antispam') );
    endif;
  endif;
}

add_action('comment_form', 'wpantispam_checkbox');
add_action('comment_post', 'wpantispam_result');

//localization
load_plugin_textdomain( 'wp-antispam', false, '/'.basename(dirname(__FILE__)).'/languages' );

?>