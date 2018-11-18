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
        $textToEncrypt = $pure_string;
        $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
        $secretHash = $encryption_key;

        $encrypted_string = openssl_encrypt($textToEncrypt, $encryptionMethod, $secretHash, 0, "56897ngq56897ngq");
        return $encrypted_string;
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