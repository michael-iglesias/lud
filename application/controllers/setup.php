<?php

class Setup extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        redirect('setup/step1');
    }
    
    public function step1() {
        $this->load->view('tenement_tier/pages/setup/step1_view');
    } // ***END step1() Method
    
    public function process_step1() {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation', 'security');
        
        $this->form_validation->set_error_delimiters('<div class="w-form-fail" style="display: block;">', '</div>');
        
        $this->form_validation->set_rules('property-name', 'Property Name', 'required|max_length[44]|xss_clean');
        $this->form_validation->set_rules('property-phone', 'Property Phone #', 'required|max_length[15]|xss_clean');
        $this->form_validation->set_rules('property-email', 'Property Email Address', 'trim|required|valid_email');
        $this->form_validation->set_rules('property-website', 'Property Website', 'required|max_length[65]|xss_clean|prep_url');
        $this->form_validation->set_rules('property-address', 'Property Address', 'required|max_length[45]|xss_clean');
        $this->form_validation->set_rules('property-city', 'Property City', 'required|max_length[45]|xss_clean');
        $this->form_validation->set_rules('property-state', 'Property State', 'required|max_length[45]|xss_clean');
        $this->form_validation->set_rules('property-zip', 'Property ZIP Code', 'required|max_length[11]|xss_clean|alpha_dash');
        $this->form_validation->set_rules('admin-email', 'Administrator Email', 'required|max_length[45]|valid_email');
        $this->form_validation->set_rules('admin-password', 'Administrator Password', 'required|max_length[45]|xss_clean');
        $this->form_validation->set_rules('admin-phone', 'Administrator Phone #', 'required|max_length[15]|xss_clean');

        if($this->form_validation->run() == FALSE) {
            // Form errors have been found. Display homepage with errors
            $this->load->view('tenement_tier/pages/setup/step1_view');
        } else {
            $this->load->model('setup_model');
            
            $property_name = $this->input->post('property-name');
            $property_phone = $this->input->post('property-phone');
            $property_email = $this->input->post('property-email');
            $property_website = $this->input->post('property-website');
            $property_address = $this->input->post('property-address');
            $property_city = $this->input->post('property-city');
            $property_state = $this->input->post('property-state');
            $property_zip = $this->input->post('property-zip');
            
            $admin_email = $this->input->post('admin-email');
            $admin_password = $this->input->post('admin-password');
            $admin_phone = $this->input->post('admin-phone');
            
            $result = $this->setup_model->createTenement($property_name, $property_phone, $property_email, $property_website, $property_address, $property_city, $property_state, $property_zip, $admin_email, $admin_password, $admin_phone);

            redirect('setup/step2');
        }
    } // ***END process_step1() Method
    
    public function step2() {
        if($this->session->userdata('step1_status') != 'completed') {
            redirect('setup/step1');
        }
        
        $this->load->view('tenement_tier/pages/setup/step2_view');
    } // ***END step2() Method
    
    public function process_step2() {
        if($this->session->userdata('step1_status') != 'completed') {
            redirect('setup/step1');
        }
        
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation', 'security');
        
        $this->form_validation->set_error_delimiters('<div class="w-form-fail" style="display: block;">', '</div>');
        
        $this->form_validation->set_rules('maintenance', 'Maintenance Requests', 'required|max_length[3]|xss_clean|alpha');
        $this->form_validation->set_rules('package', 'Package Loggin', 'required|max_length[3]|xss_clean|alpha');
        $this->form_validation->set_rules('notification', 'Notification Center', 'required|max_length[3]|xss_clean|alpha');
        $this->form_validation->set_rules('reservations', 'reservations', 'required|max_length[3]|xss_clean|alpha');
        $this->form_validation->set_rules('roommate-matching', 'Roommate Matching', 'required|max_length[3]|xss_clean|alpha');
        $this->form_validation->set_rules('newsfeed', 'Community News Feed', 'required|max_length[3]|xss_clean|alpha');
        $this->form_validation->set_rules('guest-passes', 'Guest Passes', 'required|max_length[3]|xss_clean|alpha');
        $this->form_validation->set_rules('social-shopping', 'Social Shopping', 'required|max_length[3]|xss_clean|alpha');
        $this->form_validation->set_rules('carpool', 'Campus Carpool', 'required|max_length[3]|xss_clean|alpha');
        $this->form_validation->set_rules('marketplace', 'Property Buy/Sell Marketplace', 'required|max_length[3]|xss_clean|alpha');
        
        if($this->form_validation->run() == FALSE) {
            // Form errors have been found. Display homepage with errors
            $this->load->view('tenement_tier/pages/setup/step2_view');
        } else {
            $this->load->model('setup_model');
            $tmt_id = $this->session->userdata('tmt_id');
            
            $maintenance = $this->input->post('maintenance');
            $package = $this->input->post('package');
            $notifications = $this->input->post('notification');
            $reservations = $this->input->post('reservations');
            $roommate_matching = $this->input->post('roommate-matching');
            $newsfeed = $this->input->post('newsfeed');
            $guest_passes = $this->input->post('guest-passes');
            $social_shopping = $this->input->post('social-shopping');
            $carpool = $this->input->post('carpool');
            $marketplace = $this->input->post('marketplace');
            
            $this->setup_model->setTenementFeatures($tmt_id, $maintenance, $package, $notifications, $reservations, $roommate_matching, $newsfeed, $guest_passes, $social_shopping, $carpool, $marketplace);
            $this->session->set_userdata('step2_status', 'completed');
            
            redirect('setup/step3');
        }
    } // ***END process_step2() Method
    
    
    public function step3() {
        if($this->session->userdata('step2_status') != 'completed') {
            //redirect('setup/step1');
        }
        $this->load->view('tenement_tier/pages/setup/step3_view');
    } // ***END step3() Method
    
    
    public function process_step3() {
        if($this->session->userdata('step2_status') != 'completed') {
            //redirect('setup/step1');
        }
        
        
        
        
    
    } // ***END process_step3() Method
    
}