<?php

class Custom_Hide_Login {

    private $login_slug = 'playaloud-login';

    public function __construct() {
        add_filter( 'login_url', [ $this, 'custom_login_url' ], 10, 3 );
        add_action( 'init', [ $this, 'redirect_login_page' ] );
        add_action( 'init', [ $this, 'custom_login_form' ] );
    }

    public function custom_login_url( $login_url, $redirect, $force_reauth ) {
        return home_url( '/' . $this->login_slug );
    }

    public function redirect_login_page() {
        $login_page = home_url( '/' . $this->login_slug );
        $page_viewed = basename( $_SERVER['REQUEST_URI'] );

        if ( $page_viewed == 'wp-login.php' && $_SERVER['REQUEST_METHOD'] == 'GET' ) {
            wp_redirect( $login_page );
            exit;
        }
    }

    public function custom_login_form() {
        $login_page = home_url( '/' . $this->login_slug );
        $page_viewed = basename( $_SERVER['REQUEST_URI'] );

        if ( $page_viewed == $this->login_slug ) {
            require_once( ABSPATH . 'wp-login.php' );
            exit;
        }
    }
}

// Initialize the plugin
new Custom_Hide_Login();