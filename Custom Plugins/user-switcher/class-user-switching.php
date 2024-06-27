<?php

add_action('admin_menu', 'us_add_admin_menu');

function us_add_admin_menu() {
    add_users_page(
        'User Switcher',    // Page title
        'User Switcher',    // Menu title
        'manage_options',   // Capability
        'user-switcher',    // Menu slug
        'us_user_switcher_page' // Callback function
    );
}

function us_user_switcher_page() {
    if (!current_user_can('manage_options')) {
        return;
    }

    if (isset($_GET['switch_to_user']) && isset($_GET['switch_to_user_nonce']) && wp_verify_nonce($_GET['switch_to_user_nonce'], 'switch_to_user_action')) {
        us_switch_to_user($_GET['switch_to_user']);
    } else if (isset($_GET['switch_to_user'])) {
        echo '<div class="error"><p>Security check failed. Please try again.</p></div>';
    }

    ?>
    <div class="wrap">
        <h1>User Switcher</h1>
        <form method="get" action="">
            <input type="hidden" name="page" value="user-switcher" />
            <label for="user">Select User:</label>
            <select name="switch_to_user" id="user">
                <?php
                $users = get_users();
                foreach ($users as $user) {
                    echo '<option value="' . esc_attr($user->ID) . '">' . esc_html($user->display_name) . '</option>';
                }
                ?>
            </select>
            <?php wp_nonce_field('switch_to_user_action', 'switch_to_user_nonce'); ?>
            <input type="submit" value="Switch" class="button button-primary" />
        </form>
    </div>
    <?php
}

function us_switch_to_user($user_id) {
    $current_user = wp_get_current_user();
    if (!user_can($current_user, 'manage_options')) {
        return;
    }

    $user = get_user_by('ID', $user_id);
    if ($user) {
        update_option('original_user_id', $current_user->ID); // Save original user ID
        wp_set_current_user($user->ID, $user->user_login);
        wp_set_auth_cookie($user->ID);
        do_action('wp_login', $user->user_login, $user);
        wp_redirect(home_url()); // Redirect to the frontend
        exit;
    }
}

function us_is_admin() {
    return current_user_can('manage_options');
}

add_action('init', 'us_check_user_switch');

function us_check_user_switch() {
    if (isset($_GET['switch_back']) && check_admin_referer('switch_back')) {
        $original_user_id = get_option('original_user_id');
        if ($original_user_id) {
            wp_set_current_user($original_user_id);
            wp_set_auth_cookie($original_user_id);
            delete_option('original_user_id');
            wp_redirect(home_url()); // Redirect to the frontend
            exit;
        }
    }
}

add_action('wp_footer', 'us_add_switch_back_link');

function us_add_switch_back_link() {
    $original_user_id = get_option('original_user_id');
    if ($original_user_id && is_user_logged_in()) {
        $switch_back_url = wp_nonce_url(add_query_arg('switch_back', 'true'), 'switch_back');
        echo '<style>
                #switch-back-link {
                    position: fixed;
                    bottom: 10px;
                    left: 10px;
                    background: #0073aa;
                    color: white;
                    padding: 10px 20px;
                    border-radius: 3px;
                    z-index: 1000;
                }
              </style>';
        echo '<a id="switch-back-link" href="' . esc_url($switch_back_url) . '">Switch Back</a>';
    }
}

add_action('wp_login', 'us_save_original_user_id');

function us_save_original_user_id() {
    if (!get_option('original_user_id')) {
        update_option('original_user_id', get_current_user_id());
    }
}




