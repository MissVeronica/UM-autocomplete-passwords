<?php

add_filter( 'um_confirm_user_password_form_edit_field', 'custom_autocomplete_user_password_form', 999, 2 );
add_filter( 'um_single_user_password_form_edit_field',  'custom_autocomplete_user_password_form', 999, 2 );
add_filter( 'um_user_password_form_edit_field',         'custom_autocomplete_user_password_form', 999, 2 );
add_action( 'um_after_account_privacy',                 'custom_autocomplete_after_account_privacy', 999, 1 );

function custom_autocomplete_user_password_form( $output, $set_mode ) {

    switch( $set_mode ) {
        case 'account':     $output = str_replace( 'id="single_user_password"',  'id="single_user_password" autocomplete="current-password"', $output );
                            $output = str_replace( 'id="current_user_password"', 'id="currennt_user_password" autocomplete="current-password"', $output );
                            $output = str_replace( 'id="user_password"',         'id="user_password" autocomplete="new-password"', $output );
                            $output = str_replace( 'id="confirm_user_password"', 'id="confirm_user_password" autocomplete="new-password"', $output );
                            break;

        case 'register':    $suffix = esc_attr( UM()->form()->form_suffix );
                            $output = str_replace( 'id="user_password' . $suffix,         'autocomplete="new-password" id="user_password' . $suffix, $output );
                            $output = str_replace( 'id="confirm_user_password' . $suffix, 'autocomplete="new-password" id="confirm_user_password' . $suffix, $output );
                            break;

        case 'login':       $suffix = esc_attr( UM()->form()->form_suffix );
                            $output = str_replace( 'id="user_password' . $suffix,         'autocomplete="off" id="user_password' . $suffix, $output );
                            break;
    }

    return $output;
}

function custom_autocomplete_after_account_privacy( $args ) {

    $output = ob_get_clean();

    $output = str_replace( 'id="um-export-data"', 'id="um-export-data" autocomplete="current-password"', $output );
    $output = str_replace( 'id="um-erase-data"',  'id="um-erase-data" autocomplete="current-password"', $output );

    ob_start();
    echo $output;
}
