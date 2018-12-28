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

if (!function_exists('get_absolute_path')) {

    function get_absolute_path($path) {
        return FCPATH . $path;
    }

}

if (!function_exists('url_files_in_folder')) {

    /**
     * Return an array of urls of the files in a folder given in parameter
     * @param String $folder    The path to the folder (relative to the root of the website)
     */
    function url_files_in_folder($folder) {
        $path = FCPATH . $folder;
        $files_url = array();

        if (is_dir($path)) {
            $files = scandir($path);
            for ($i = 2; $i < count($files); $i++) {
                $files_url[] = base_url($folder . "/" . $files[$i]);
            }
        }
        if (count($files_url) == 0) {
            $files_url[] = base_url("/assets/images/no-image.png");
        }
        return $files_url;
    }

}

if (!function_exists('url_images_in_folder')) {

    /**
     * Return an array of urls of the images in a folder given in parameter
     * @param mixed $folder    The path to the folder (relative to the root of the website) OR an array of paths to the folders
     * 
     */
    function url_images_in_folder($folder, $reccursive = false) {
        if (!is_array($folder)) {
            $folder = [$folder];
        }
        $files_url = array();

        foreach ($folder as $f) {
            $path = FCPATH . $f;

            if (is_dir($path)) {
                $files = scandir($path);
                for ($i = 2; $i < count($files); $i++) {
                    if (!is_dir($path . '/' . $files[$i])) {
                        $files_url[] = base_url($f . "/" . $files[$i]);
                    } else if ($reccursive) {
                        $files_url = array_merge($files_url, url_images_in_folder($f . "/" . $files[$i], true));
                    }
                }
            }
        }
        if (count($files_url) == 0) {
            $files_url[] = base_url("/assets/images/no-image.png");
        }
        return $files_url;
    }

}


if (!function_exists('mb_ucfirst')) {

    function mb_ucfirst($str, $encoding = "UTF-8", $lower_str_end = false) {
        $first_letter = mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding);
        $str_end = "";
        if ($lower_str_end) {
            $str_end = mb_strtolower(mb_substr($str, 1, mb_strlen($str, $encoding), $encoding), $encoding);
        } else {
            $str_end = mb_substr($str, 1, mb_strlen($str, $encoding), $encoding);
        }
        $str = $first_letter . $str_end;
        return $str;
    }

}


if (!function_exists('upload_files_from_form')) {

    /**
     * Upload files sent from a form
     * @param type $config
     * @return false if there is an error, true if the upload as happened correctly
     */
    function upload_files_from_form($config = array()) {
        $errors = false;
        if ($_FILES) {
            if (empty($config)) {
                // Configurer les fichiers acceptés
                $config['upload_path'] = FCPATH . 'assets/images/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = 10000;
            }

            $CI = & get_instance();

            $CI->load->library('upload', $config);
            $CI->upload->initialize($config);

            foreach ($_FILES as $key => $value) {
                if (!empty($value['name'])) {
                    if (is_array($value['name'])) {
                        for ($i = 0; $i < count($value['name']); $i++) {
                            $t = array(
                                'name' => $value['name'][$i],
                                'type' => $value['type'][$i],
                                'tmp_name' => $value['tmp_name'][$i],
                                'error' => $value['error'][$i],
                                'size' => $value['size'][$i],
                            );
                            $_FILES [$key . $i] = $t;
                        }
                        unset($_FILES[$key]);
                    }
                }
            }

            foreach ($_FILES as $key => $value) {
                if (!empty($value['name'])) {
                    if (!$CI->upload->do_upload($key)) {
                        $errors = TRUE;
                    } else {
                        // Build a file array from all uploaded files
                        $files[] = $CI->upload->data();
                    }
                }
            }
        }
        // There was errors, we have to delete the uploaded files
        if ($errors) {
            foreach ($files as $key => $file) {
                @unlink($file['full_path']);
            }
            return false;
        } else {
            return true;
        }
    }

}