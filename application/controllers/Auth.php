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
        $this->load->model('Client_model');
        $this->load->model('User_model');
        $this->load->model('User_admin_model');
        $this->load->model('Commercant_model');
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
                $idUser = $this->User_model->select_from_username($username)[0]->idUser;
                // Check if user have a clientId
                $idClientBdd = $this->Client_model->get_client_id($idUser);
                if (isset($idClientBdd->idClient)) {
                    $idClient = $idClientBdd->idClient;
                } else {
                    $idClient = null;
                }


                // Add the idCommercant if it exists
                $data_commercant = $this->Commercant_model->get_commercant_iduser($idUser);


                if ($result != false) {
                    $session_data = array(
                        'username' => $loginUser,
                        'idUser' => $idUser,
                        'idClient' => $idClient,
                    );

                    if ($data_commercant) {
                        $session_data['idCommercant'] = $data_commercant[0]->idCommercant;
                    }

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
        $this->form_validation->set_rules('email', '"Adresse Email"', 'trim|required|min_length[5]|encode_php_tags|required|valid_email');
        $this->form_validation->set_rules('type', '"Vous etes (Client / Commerçant)"', 'trim|required|encode_php_tags');
        $this->form_validation->set_rules('nom', '"Nom"', 'trim|required|encode_php_tags');
        $this->form_validation->set_rules('prenom', '"Prénom"', 'trim|required|encode_php_tags');
        $this->form_validation->set_rules('naiss_date', '"Date de naissance"', 'trim|required|encode_php_tags');
        $this->form_validation->set_rules('tel', '"Téléphone"', 'trim|encode_php_tags');
        $this->form_validation->set_rules('numAdr', '"Numéro d\'adresse"', 'trim|encode_php_tags');
        $this->form_validation->set_rules('rue', '"Rue"', 'trim|encode_php_tags');
        $this->form_validation->set_rules('cplAdr', '"Complément d\'adresse"', 'trim|encode_php_tags');
        $this->form_validation->set_rules('cp', '"Code Postal"', 'trim|encode_php_tags');
        $this->form_validation->set_rules('ville', '"Ville"', 'trim|encode_php_tags');

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

                if ($result) {
                    $idUser = $this->User_model->select_from_username($loginUser)[0]->idUser;
                    // Create the client profile
                    $data_client = array(
                        "idUser" => $idUser,
                        "mailClient" => $this->input->post("email"),
                        "nomClient" => $this->input->post("nom"),
                        "prenomClient" => $this->input->post("prenom"),
                        "dateNaissanceClient" => $this->input->post("naiss_date"),
                        "telClient" => $this->input->post("tel"),
                        "numAdresseClient" => $this->input->post("numAdr"),
                        "rueClient" => $this->input->post("rue"),
                        "complementAdresseCommerce" => $this->input->post("cplAdr"),
                        "codePostalClient" => $this->input->post("cp"),
                        "villeClient" => $this->input->post("ville"),
                    );


                    $result = $this->Client_model->create($data_client);

                    if ($result) {
                        // Creation du commercant
                        if ($this->input->post('type') == 1) {
                            $data_commercant = array(
                                "idUser" => $idUser,
                                "nomCommercant" => $this->input->post("nom"),
                                "prenomCommercant" => $this->input->post("prenom"),
                                "dateNaissanceCommercant" => $this->input->post("naiss_date"),
                                "telCommercant" => $this->input->post("tel"),
                            );
                            $result = $this->Commercant_model->create($data_commercant);
                            if ($result) {
                                $idCommercant = $this->Commercant_model->get_commercant_iduser($idUser)[0]->idCommercant;
                            }
                        }
                    }
                }

                // If the user is correctly created
                if ($result) {

                    $username = $loginUser;

                    // Check if user have a clientId
                    $idClientBdd = $this->Client_model->get_client_id($idUser);
                    if (isset($idClientBdd->idClient)) {
                        $idClient = $idClientBdd->idClient;
                    } else {
                        $idClient = null;
                    }

                    $session_data = array(
                        'username' => $loginUser,
                        'idUser' => $idUser,
                        'idClient' => $idClient,
                    );
                    if (isset($idCommercant)) {
                        $session_data['idCommercant'] = $idCommercant;
                    }

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
