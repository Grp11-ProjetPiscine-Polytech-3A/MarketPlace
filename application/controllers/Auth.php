<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    /*
      |===============================================================================
      | Constructeur
      |===============================================================================
     */

    public function __construct() {
        parent::__construct();

        $this->load->helper('form');
        $this->load->helper('encrypt');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('User_model');
        $this->load->library('Layout');
    }

    /**
     * Show Login page if the user is not connected, or print a welcome message if he is
     */
    public function index() {
        if (isset($this->session->logged_in['username'])) {
            $data = array(
                'username' => $this->session->logged_in['username'],
            );

            $this->layout->view('Auth/logged_in', $data);
        } else {
            $this->layout->view('Auth/login');
        }
    }

    /*
      |===============================================================================
      | Méthodes pour la connexion d'un utilisateur
      |   . user_login
      |   . logout
      |===============================================================================
     */

    /**
     * User Login process
     * If the user gives the right username and password, the connexion is done, else, an error is printed
     */
    public function user_login() {

        // Retrieve the data from POST
        $loginUser = $this->input->post('loginUser');
        $passUser = $this->input->post('passUser');

        // Check in the database if it's the right data
        $result = $this->User_model->login($loginUser, $passUser);

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
                $this->layout->view('Auth/logged_in', $session_data);
            }

            // If username or password is wrong, load the error
        } else {
            $data = array(
                'error_message' => 'Invalid Username or Password'
            );
            $this->layout->view('Auth/login', $data);
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
        $this->layout->view('Auth/login', $data);
    }
    
    /**
     * User signup page
     */
    public function signup() {
        
    }

}

?>
