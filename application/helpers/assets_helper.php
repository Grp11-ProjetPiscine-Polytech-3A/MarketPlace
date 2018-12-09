<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


if (!function_exists('css_url')) {

    function css_url($nom) {
        return base_url() . 'assets/css/' . $nom . '.css';
    }

}


if (!function_exists('js_url')) {

    function js_url($nom) {
        return base_url() . 'assets/javacript/' . $nom . '.js';
    }

}


if (!function_exists('img_url')) {

    function img_url($nom) {
        return base_url() . 'assets/images/' . $nom;
    }

}

if (!function_exists('fonts_url')) {

    function fonts_url($nom) {
        return base_url() . 'assets/fonts/' . $nom;
    }

}


if (!function_exists('img')) {

    function img($nom, $alt = '') {
        return '<img src="' . img_url($nom) . '" alt="' . $alt . '" />';
    }

}

if (!function_exists('url_files_in_folder')) {

    /**
     * Return an array of urls of the files in a folder given in parameter
     * @param String $folder    The path to the folder (relative to the root of the website)
     */
    function url_files_in_folder($folder) {
        $files = scandir(FCPATH . $folder);
        $files_url = array();
        for ($i = 2; $i < count($files); $i++) {
            $files_url[] = base_url($folder . "/" . $files[$i]);
        }
        return $files_url;
    }

}