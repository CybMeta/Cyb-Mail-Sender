<?php
/*
Plugin Name:  Cyb Mail Sender
Plugin URI:   http://cybmeta.com
Description:  Set "Sender" header to wp_amail to work with SPF and DKIM signatures
Version:      0.1
Author:       Juan Padial (@CybMeta)
Author URI:   http://cybmeta.com
*/

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// WordPress needs to Set "Sender" or DKIM/DMARC will not work
// See https://core.trac.wordpress.org/ticket/22837
add_action( 'phpmailer_init', 'cyb_set_mail_sender' );
function cyb_set_mail_sender( $phpmailer ) {
   if ( empty( $phpmailer->Sender ) ) {
        $phpmailer->Sender = $phpmailer->From;
        $phpmailer->AddReplyTo( $phpmailer->From );
    }
}

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
