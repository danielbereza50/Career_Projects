<?php


function generate_random_code($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $random_code = '';
    for ($i = 0; $i < $length; $i++) {
        $random_code .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $random_code;
}

function include_config_file() {
    // Define the absolute path to the config.php file
    $configAbsolutePath = '/home/wp_tqh7mk/config.php';

    // Check if the config.php file exists
    if (file_exists($configAbsolutePath)) {
        // Include the config.php file
        include_once $configAbsolutePath;

        // Return the value of $secretKey
        return $secretKey ?? null;
    } else {
        return null; // Return null if the file does not exist
    }
}

function encrypt_password($password, $secretKey) {
    $algorithm = 'AES-256-CBC';
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($algorithm));
    $encrypted = openssl_encrypt($password, $algorithm, $secretKey, 0, $iv);
    return base64_encode($iv . $encrypted);
}

function decrypt_password($encryptedPassword, $secretKey) {
    $algorithm = 'AES-256-CBC';
    $encryptedData = base64_decode($encryptedPassword);
    $ivLength = openssl_cipher_iv_length($algorithm);
    $iv = substr($encryptedData, 0, $ivLength);
    $encrypted = substr($encryptedData, $ivLength);
    return openssl_decrypt($encrypted, $algorithm, $secretKey, 0, $iv);
}






