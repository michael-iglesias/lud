<?php

class Roommate_matching extends CI_Controller {
    
    var $session_data;
    
    public function __construct() {
        parent::__construct();
        $this->session_data = $this->session->all_userdata();
        $this->load->model('roommate_matching_model');
    }
    
    public function index() {
        $this->_authorize_user();
        $this->load->model('tenement_model');
        
        $data['page_title'] = 'Roommate Matching';
        $data['page_header_icon'] = 'awe-group';
        $data['page_header_title'] = 'Roommate Matching';
        $data['session_data'] = $this->session_data;
        $data['tenement_towers'] = $this->tenement_model->getTenementTowers($this->session_data['tmt_id']);
        
        $this->load->view('tenement_tier/common/header_view', $data);
        $this->load->view('tenement_tier/pages/roommate_matching/roommate_matching_view', $data);
        $this->load->view('tenement_tier/common/footer_view');
    } // ***END index() Method
    
    public function load_narrowed_roommate_profile_results() {
        $this->_authorize_user();
        $query_conditionals = array();
        $neat = $this->input->post('neat'); $study = $this->input->post('study'); $smoke = $this->input->post('smoke'); $party = $this->input->post('party'); $chef = $this->input->post('chef'); $gym = $this->input->post('gym'); $sports = $this->input->post('sports'); $movies = $this->input->post('movies'); $tv = $this->input->post('tv'); $greek = $this->input->post('greek'); $pets = $this->input->post('pets');
        if($neat == 'yes') {$query_conditionals[] = array('prof_neat' => TRUE);}
        if($study == 'yes') {$query_conditionals[] = array('prof_study' => TRUE);}
        if($smoke == 'yes') {$query_conditionals[] = array('prof_smoke' => TRUE);}
        if($party == 'yes') {$query_conditionals[] = array('prof_party' => TRUE);}
        if($chef == 'yes') {$query_conditionals[] = array('prof_chef' => TRUE);}
        if($gym == 'yes') {$query_conditionals[] = array('prof_gym' => TRUE);}
        if($sports == 'yes') {$query_conditionals[] = array('prof_sports' => TRUE);}
        if($movies == 'yes') {$query_conditionals[] = array('prof_movies' => TRUE);}
        if($tv == 'yes') {$query_conditionals[] = array('prof_tv' => TRUE);}
        if($greek == 'yes') {$query_conditionals[] = array('prof_greek' => TRUE);}
        if($pets == 'yes') {$query_conditionals[] = array('prof_pets' => TRUE);}
        
        $data['tenant_list'] = $this->roommate_matching_model->loadFilteredTenantList($query_conditionals);

        $this->load->view('tenement_tier/pages/roommate_matching/filtered_selection_view', $data);
    }
    
    
    /**************************************************************************
     * ************************************************************************
     * 
     * MISC Methods
     * 
     * ************************************************************************
     * ************************************************************************
     */
    private function _authorize_user() {
        $tmt_id = $this->session->userdata('tmt_id'); $temp_id = $this->session->userdata('temp_id');
        $authorized_user = $this->session->userdata('authorized_user');
        
        if(empty($tmt_id) || empty($temp_id) || empty($authorized_user)) {
            redirect('tenement/login', 'refresh');
        } else {
            ;
        }
    } // ***END _authorize_user() Method
    
}
