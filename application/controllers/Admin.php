 <?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    /*
      |===============================================================================
      | Constructeur
      |===============================================================================
     */

    public function __construct() {
        parent::__construct();

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('Layout');
        $this->load->model('Commerce_model');
        $this->load->model('User_admin_model');
    }

    public function index() {
        if ($this->User_admin_model->isAdmin()){
            $data = array (
                // EMPTY
            );
            $this->layout->view('Admin/menu_admin', $data);
        } else {
            $data = array(
                'error_message' => 'Not allowed here',
            );
            $this->layout->view('template/error_display', $data);
        }
    }

    public function ajout_commerce(){
        // Vérification que l'utilisateur est bien admin
        if ($this->User_admin_model->isAdmin()){
            $data = array (
                // EMPTY
            );
            $this->layout->view('Admin/Commerces/ajout_commerce', $data);
        } else {
            $data = array(
                'error_message' => 'Not allowed here',
            );
            $this->layout->view('template/error_display', $data);
        }
    }
}