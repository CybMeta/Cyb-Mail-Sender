<?php
/*
Plugin Name:  Cyb Mail Sender
Plugin URI:   http://cybmeta.com
Description:  Set mail "From" from site General Settings and set "Sender" to fix DKIM mail signature
Version:      0.1
Author:       Juan Padial (@CybMeta)
Author URI:   http://cybmeta.com
*/

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// Set mail From header to admin email
add_filter( 'wp_mail_from', 'cyb_change_mail_from' );
function cyb_change_mail_from() {
    return get_bloginfo( 'admin_email' );
}

// Set mail From name header to site name
add_filter( 'wp_mail_from_name', 'cyb_change_mail_from_name');
function cyb_change_mail_from_name() {
    return get_bloginfo( 'name' );
}

// WordPress needs to Set "Sender" or DKIM/DMARC will not work
// See https://core.trac.wordpress.org/ticket/22837
add_action( 'phpmailer_init', 'cyb_modify_mail_headers_for_dkim' );
function cyb_modify_mail_headers_for_dkim( $phpmailer ) {
   if ( empty( $phpmailer->Sender ) ) {
        $phpmailer->Sender = $phpmailer->From;
    }
}