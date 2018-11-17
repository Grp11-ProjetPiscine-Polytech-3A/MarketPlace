<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


if (!function_exists('encrypt_string')) {

// Sources www.stackoverflow.com

    /**
     * Encrypt a string
     * @param String $pure_string     The string to encrypt
     * @param String $encryption_key  The encryption key
     * @return String   The encrypted string
     */
    function encrypt_string($pure_string, $encryption_key) {
        $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, $encryption_key, utf8_encode($pure_string), MCRYPT_MODE_ECB, $iv);
        return $encrypted_string;
    }

}

if (!function_exists('decrypt_string')) {

// Sources www.stackoverflow.com

    /**
     * Decrypt a string
     * @param String $encrypted_string  The encrypted string
     * @param String $encryption_key    The encryption key
     * @return String   The decrypted String
     */
    function decrypt_string($encrypted_string, $encryption_key) {
        $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, $encryption_key, $encrypted_string, MCRYPT_MODE_ECB, $iv);
        return $decrypted_string;
    }

}

if (!function_exists('encrypt_password')) {

    /**
     * Encrypt a password
     * @param String $password    The password
     * @param String $login       The login of the user
     * @return String     The encrypted password
     */
    function encrypt_password($password, $login) {
        $key = "rLY5eo2Cf5";    // Change this key when installing, you can find one at https://randomkeygen.com
        $salt = encrypt_string($login, $key);
        $pw_before_hash = $salt . $password;
        return sha1($pw_before_hash);
    }

}