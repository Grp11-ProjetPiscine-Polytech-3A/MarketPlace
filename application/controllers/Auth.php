<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('User_model');
    }

    /**
     * Show Login page
     */
    public function index() {
        $this->load->view('login');
    }

    /**
     * User Login process
     * If the user gives the right username and password, the connexion is done, else, an error is printed
     */
    public function user_login() {

        // Retrieve the data from POST
        $data = array(
            'loginUser' => $this->input->post('loginUser'),
            'passUser' => $this->input->post('passUser')
        );

        // Check in the database if it's the right data
        $result = $this->User_model->login($data);

        // If the user is correctly authentified
        if ($result == TRUE) {
            
            // Saves the data of the user in session
            $username = $this->input->post('loginUser');
            $result = $this->User_model->select_from_username($username);
            if ($result != false) {
                $session_data = array(
                    'username' => $result[0]->loginUser,
                );

                // Add user data in session
                $this->session->set_userdata('logged_in', $session_data);

                // Load the logged_in view
                $this->load->view('logged_in', $session_data);
            }
            
        // If username or password is wrong, load the error
        } else {
            $data = array(
                'error_message' => 'Invalid Username or Password'
            );
            $this->load->view('login', $data);
        }
    }

    /**
     * Log out the user
     */
    public function logout() {

        // Removing session data
        $sess_array = array(
            'username' => ''
        );
        
        // Unset the session
        $this->session->unset_userdata('logged_in', $sess_array);
        
        // Displays the message
        $data['message_display'] = 'Successfully Logged out ! ';
        
        // Load the view
        $this->load->view('login', $data);
    }

}

?>
