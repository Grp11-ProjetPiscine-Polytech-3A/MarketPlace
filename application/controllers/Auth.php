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

    public function index() {
        $this->login();
    }

    /*
      |===============================================================================
      | Méthodes pour la connexion d'un utilisateur
      |   . login
      |   . login_process
      |   . signup
      |   . signup_process
      |   . logout
      |===============================================================================
     */

    /**
     * Show Login page if the user is not connected, or print a welcome message if he is
     */
    public function login() {
        if (isset($this->session->logged_in['username'])) {
            $data = array(
                'username' => $this->session->logged_in['username'],
            );

            $this->layout->view('Auth/logged_in', $data);
        } else {
            $this->layout->view('Auth/login');
        }
    }

    /**
     * User Login process
     * If the user gives the right username and password, the connexion is done, else, an error is printed
     */
    public function login_process() {

        $this->form_validation->set_rules('loginUser', '"Login"', 'trim|required|encode_php_tags');
        $this->form_validation->set_rules('passUser', '"Password"', 'trim|required|encode_php_tags|required');

        if (!$this->form_validation->run()) {
            $data = array(
                'error_message' => $this->form_validation->error_string()
            );
            $this->layout->views('template/error_display', $data);
            $this->layout->view('Auth/login', $data);
        } else {

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
                $this->layout->views('template/error_display', $data);
                $this->layout->view('Auth/login');
            }
        }
    }

    /**
     * User signup page
     */
    public function signup() {
        if (isset($this->session->logged_in['username'])) {
            $this->index();
        } else {
            $this->layout->view('Auth/signup');
        }
    }

    /**
     * User signup process
     */
    public function signup_process() {
        
        // Check the rules for the form
        $this->form_validation->set_rules('loginUser', '"Login"', 'trim|required|min_length[4]|encode_php_tags|required');
        $this->form_validation->set_rules('passUser', '"Password"', 'trim|required|min_length[5]|encode_php_tags|required');
        $this->form_validation->set_rules('confirm_password', '"Confirm Password"', 'trim|required|min_length[5]|encode_php_tags|required');

        // If the form wasn't filled properly
        if (!$this->form_validation->run()) {
            $data = array(
                'error_message' => $this->form_validation->error_string()
            );
            $this->layout->views('template/error_display', $data);
            $this->layout->view('Auth/signup');
        } else {
            // Retrieve the data from POST
            $loginUser = $this->input->post('loginUser');
            $passUser = $this->input->post('passUser');
            $confirmPassword = $this->input->post('confirm_password');

            // If the password is not the same as the confirm_password
            if ($confirmPassword != $passUser) {
                $data = array(
                    'error_message' => "Les champs password et Confirm Password doivent être identiques",
                );
                $this->layout->views('template/error_display', $data);
                $this->layout->view('Auth/signup');
                
            // If the login is already used
            } else if ($this->User_model->count('UPPER(loginUser)', mb_strtoupper($loginUser)) > 0) {
                $data = array(
                    'error_message' => "Ce nom d'utilisateur est déjà utilisé",
                );
                $this->layout->views('template/error_display', $data);
                $this->layout->view('Auth/signup');
                
            // Creates the User
            } else {
                // Creates the user in database
                $result = $this->User_model->signup($loginUser, $passUser);

                // If the user is correctly created
                if ($result == TRUE) {
                    $session_data = array(
                        'username' => $loginUser,
                    );

                    // Add user data in session
                    $this->session->set_userdata('logged_in', $session_data);

                    $data = array(
                        'message_display' => 'Votre compte a bien été créé',
                    );
                    
                    // Load the logged_in view
                    $this->layout->views('template/message_display', $data);
                    $this->layout->view('Auth/logged_in', $session_data);
                    
                // If there is an error in the create
                } else {
                    $data = array(
                        'error_message' => 'Une erreur est survenue, veuillez réessayer',
                    );
                    $this->layout->views('template/error_display', $data);
                    $this->layout->view('Auth/login');
                }
            }
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
        $this->layout->views('template/message_display', $data);
        $this->layout->view('Auth/login');
    }

}

?>
