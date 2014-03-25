<?php

class Community_feed extends CI_Controller {
    
    var $session_data;
    
    public function __construct() {
        parent::__construct();
        $this->session_data = $this->session->all_userdata();
        $this->load->model('community_feed_model');
    }
    
    public function index() {
        $this->_authorize_user();
        $data['page_title'] = 'Community News Feed - Let Us Dorm';
        $data['page_header_title'] = 'Add News Feed Entry';
        $data['page_header_icon'] = 'awe-globe';
        $data['session_data'] = $this->session_data;
        
        $this->load->view('tenement_tier/common/page_header_view', $data);
        $this->load->view('tenement_tier/pages/community_newsfeed/add_community_newsfeed_item_view', $data);
        $this->load->view('tenement_tier/common/footer_view');
    } // ***END index() Method
    
    public function add_newsfeed_item() {
        $tmt_id = $this->session->userdata('tmt_id');
        $temp_id = $this->session->userdata('temp_id');
        $validated = TRUE;
        
        $entry_date = $this->input->post('entryDate');
        if(strlen($entry_date) != 10) { 
            $entry_date = '';
        } else {
            $date_array = explode("/",$entry_date); // split the array
            $var_day = $date_array[0]; //day seqment
            $var_month = $date_array[1]; //month segment
            $var_year = $date_array[2]; //year segment
            $entry_date = date("Y-m-d H:i:s", strtotime($entry_date));
        }
        
        $sTimeSelected = $this->input->post('sTimeSelected');
        if($sTimeSelected == 'yes') {
            $sTime = $this->input->post('sTime');
            if(strlen($sTime) != 5) {
                $validated = FALSE;
            }
        } else {
            $sTime = NULL;
        }
        
        $eTimeSelected = $this->input->post('eTimeSelected');
        if($eTimeSelected == 'yes') {
            $eTime = $this->input->post('eTime');
            if(strlen($eTime) != 5) {
                $validated = FALSE;
            }
        } else {
            $eTime = NULL;
        }
        
        $entryTitle = $this->input->post('entryTitle');
        $entryDescription = $this->input->post('entryDescription');
        
        if($validated) {
            $result = $this->community_feed_model->addEntry($tmt_id, $temp_id, $entry_date, $sTime, $eTime, $entryTitle, $entryDescription);
            if($result) {
                echo 1;
            } else {
                echo 'error';
            }
        } else {
            echo 'error';
        }
    } // ***END add_newsfeed_item() Method
    
    public function entries() {
        $this->_authorize_user();
        $data['page_title'] = 'Community News Feed - Let Us Dorm';
        $data['page_header_title'] = 'News Feed';
        $data['page_header_icon'] = 'awe-globe';
        $data['session_data'] = $this->session_data;
        $data['community_feed'] = $this->community_feed_model->getEntries($this->session->userdata('tmt_id'));
        
        $this->load->view('tenement_tier/common/page_header_view', $data);
        $this->load->view('tenement_tier/pages/community_newsfeed/list_community_newsfeed_item_view', $data);
        $this->load->view('tenement_tier/common/footer_view');
    } // ***END items() Method
    
    public function entry() {
        $this->_authorize_user();
        $data['page_title'] = 'Community News Feed - Let Us Dorm';
        $data['page_header_title'] = 'News Feed';
        $data['page_header_icon'] = 'awe-globe';
        $data['session_data'] = $this->session_data;
        $data['entry'] = $this->community_feed_model->getEntry($this->uri->segment(3), $this->session->userdata('tmt_id'));
        
        $this->load->view('tenement_tier/common/page_header_view', $data);
        $this->load->view('tenement_tier/pages/community_newsfeed/community_newsfeed_entry_info_view', $data);
        $this->load->view('tenement_tier/common/footer_view');        
        
    } // ***END entry_info() Method
    
    public function delete_entry() {
        $this->_authorize_user();
        $tmtnews_id = $this->uri->segment(3);
        $tmt_id = $this->session->userdata('tmt_id');
        $this->community_feed_model->deleteEntry($tmtnews_id, $tmt_id);
        
        redirect('community_feed/entries');
    }
    
    public function update_newsfeed_item() {
        $tmt_id = $this->session->userdata('tmt_id');
        $tmtnews_id = $this->input->post('tmtnewsid');
        $validated = TRUE;
        
        $entry_date = $this->input->post('entryDate');
        if(strlen($entry_date) != 10) { $entry_date = NULL; }

        $date_array = explode("/",$entry_date); // split the array
        $var_day = $date_array[0]; //day seqment
        $var_month = $date_array[1]; //month segment
        $var_year = $date_array[2]; //year segment
        $entry_date = date("Y-m-d H:i:s", strtotime($entry_date));
        
        
        $sTimeSelected = $this->input->post('sTimeSelected');
        if($sTimeSelected == 'yes') {
            $sTime = $this->input->post('sTime');
            if(strlen($sTime) != 5) {
                $validated = FALSE;
            }
        } else {
            $sTime = NULL;
        }
        
        $eTimeSelected = $this->input->post('eTimeSelected');
        if($eTimeSelected == 'yes') {
            $eTime = $this->input->post('eTime');
            if(strlen($eTime) != 5) {
                $validated = FALSE;
            }
        } else {
            $eTime = NULL;
        }
        
        $entryTitle = $this->input->post('entryTitle');
        $entryDescription = $this->input->post('entryDescription');
        
        if($validated) {
            $this->community_feed_model->updateEntry($tmt_id, $tmtnews_id, $entry_date, $sTime, $eTime, $entryTitle, $entryDescription);
            echo 1;
        } else {
            echo 'error';
        }
    } // ***END add_newsfeed_item() Method
    
    
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