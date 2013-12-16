<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tenant extends CI_Controller {
    
    protected $session_data;
    
    public function __construct() {
        parent::__construct();
        $this->load->model('tenant_model');
        $this->session_data = $this->session->all_userdata();
    }
    public function index() {
        redirect('tenant/dashboard');
    }
    
    public function dashboard() {
        $this->_authorize_user();
        $data['page_title'] = 'Dashboard - Let Us Dorm';
        $data['page_header_icon'] = 'awe-dashboard';
        $data['page_header_title'] = ucfirst($this->session_data['tnt_fname']) . '\'s Dashboard';
        $data['session_data'] = $this->session_data;
        
        $this->load->view('tenant_tier/common/header_view', $data);
        $this->load->view('tenant_tier/pages/dashboard_view', $data);
        $this->load->view('tenant_tier/common/footer_view');
    } // ***END dashboard() Method
    
    
    
    public function messages() {
        $this->_authorize_user();
        $data['page_title'] = 'Messages - Let Us Dorm';
        $data['page_header_icon'] = 'awe-comments';
        $data['page_header_title'] = 'Inbox';
        $data['session_data'] = $this->session_data;
        $data['private_messages'] = $this->tenant_model->getPrivateMessages($this->session->userdata('tnt_id'));
        
        $this->load->view('tenant_tier/common/messages_header_view', $data);
        $this->load->view('tenant_tier/pages/messages_view', $data);
        $this->load->view('tenant_tier/common/footer_view');
    } // ***END messages() Method
    
    public function view_message() {
        $this->_authorize_user();
        $pm_id = $this->uri->segment(3);
        $data['page_title'] = 'View Message - Let Us Dorm';
        $data['page_header_icon'] = 'awe-comments';
        $data['page_header_title'] = 'Messages';
        $data['session_data'] = $this->session_data;
        $data['message'] = $this->tenant_model->getPrivateMessageInfo($pm_id, $this->session->userdata('tnt_id'));
        
        $this->load->view('tenant_tier/common/header_view', $data);
        $this->load->view('tenant_tier/pages/view_message_view', $data);
        $this->load->view('tenant_tier/common/footer_view');
    } // ***END view_message() Method
    
    /**************************************************************************
     * My Unit Methods
     * - my_unit()
     * - load_tenant_list()
     * - account_edit()
     * - update_account_info()
     * - upload_tenant_avatar()
     * ***********************************************************************/
    
    public function my_unit() {
        $this->_authorize_user();
        $tnt_id = $this->session->userdata('tnt_id');
        $tun_id = $this->session->userdata('tun_id');
        
        $data['page_title'] = 'Dashboard - Let Us Dorm';
        $data['page_header_icon'] = 'awe-key';
        $data['session_data'] = $this->session_data;
        if($tun_id != FALSE) {
        $data['tenant_info'] = $this->tenant_model->getTenantInfo($tnt_id);
        $data['tenants'] = $this->tenant_model->getUnitTenants($tun_id);
        $data['group_messages'] = $this->tenant_model->getGroupMessages($tun_id);
        $data['unit_items_list'] = $this->tenant_model->getUnitItemsList($tun_id);
        $data['item_typeahead'] = $this->tenant_model->getItemsForTypeahead();
        
        // Determine if user has been assigned a unit
        if($data['tenant_info'][0]['lease_id'] == NULL) {
            $data['page_header_title'] = 'Unit Assignment Pending';
        } else {
            $data['page_header_title'] = 'Building: ' . $data['tenant_info'][0]['tow_name'] . ' Unit: '  . $data['tenant_info'][0]['tun_number'] . ' Unit Bedroom: ' . $data['tenant_info'][0]['urm_room_number'];
        }
        } else {
            $data['tenant_info'][0]['lease_id'] = FALSE;
            $data['page_header_title'] = 'You Have Not Been Assigned A Unit';
        }
        $this->load->view('tenant_tier/common/header_view', $data);
        $this->load->view('tenant_tier/pages/my_unit_view', $data);
        $this->load->view('tenant_tier/common/footer_view');
        
    } // ***END my_unit() Method
    
    public function add_item_list() {
        $item_title = $this->input->post("itemTitle");
        $item_image = $this->input->post("itemImage");
        
        $result = $this->tenant_model->addItemToList($item_title, $item_image);
        if($result) {
            echo 1;
        }
        
    } // ***END add_item_list() Method
    
    public function add_item_tenant_list() {
        $urua_id = $this->input->post('uruaID');
        $result = $this->tenant_model->addItemToTenantList($urua_id);
        if($result) {
            echo 1;
        }
    } // ***END add_item_tenant_list() Method
    
    public function load_tenant_item_list() {
        $view_list_tnt_id = $this->input->post('tntID');
        
        $data['session_data'] = $this->session_data;
        $data['tenant_items_list'] = $this->tenant_model->getTenantItemList($view_list_tnt_id);
        $data['view_list_tnt_id'] = $view_list_tnt_id;
        
        $this->load->view('tenant_tier/pages/load_tenant_list_view', $data);
    } // ***END load_tenant_list() Method
    
    /**************************************************************************
     * Profile & Account Settings Methods
     * - complete_profile()
     * - process_complete_profile() Method
     * - account_edit()
     * - update_account_info()
     * - upload_tenant_avatar()
     * ***********************************************************************/
    
    public function complete_profile() {
        $this->_authorize_user();
        $data['page_title'] = 'Complete Profile - Let Us Dorm';
        $data['page_header_icon'] = 'awe-edit';
        $data['page_header_title'] = 'Complete Your Profile!';
        $data['session_data'] = $this->session_data;
        
        $this->load->view('tenant_tier/common/header_view', $data);
        $this->load->view('tenant_tier/pages/complete_profile_view', $data);
        $this->load->view('tenant_tier/common/footer_view');
    } // ***END dashboard() Method
    
    public function process_complete_profile() {
        $tnt_id = $this->session->userdata('tnt_id');
        $profMajor = $this->input->post('profMajor'); $profAcademicFocus = $this->input->post('profAcademicFocus');
        $profNeatness = $this->input->post('profNeatness'); $profVisitors = $this->input->post('profVisitors');
        $profActive = $this->input->post('profActive'); $profTv = $this->input->post('profTv');
        $profSmoker = $this->input->post('profSmoker'); $profLiveWithSmoker = $this->input->post('profLiveWithSmoker');
        $profPet = $this->input->post('profPet'); $profLiveWithPet = $this->input->post('profLiveWithPet');
        $profFrat = $this->input->post('profFrat');
        
        $packEmail = $this->input->post('packEmail'); $packSMS = $this->input->post('packSMS');
        $packPIN = $this->input->post('packPIN');
        
        
        $result = $this->tenant_model->insertTenantPersonalityProfile($tnt_id, $packEmail, $packSMS, $packPIN, $profMajor, $profAcademicFocus, $profNeatness, $profActive, $profVisitors, $profTv, $profSmoker, $profLiveWithSmoker, $profPet, $profLiveWithPet, $profFrat);
        if($result) {
            echo 1;
        }
    } // ***END process_complete_profile() Method
    
    public function load_personality_profile() {
        $this->load->view('tenant_tier/pages/personality_profile_view');
    } // ***END load_personality_profile() Method
    
    public function process_personality_profile() {
        /*
<input type="hidden" id="studyVal" />
<input type="hidden" id="neatVal" />
<input type="hidden" id="smokeVal" />
<input type="hidden" id="partyVal" />
<input type="hidden" id="chefVal" />
<input type="hidden" id="gymVal" />
<input type="hidden" id="sportsVal" />
<input type="hidden" id="moviesVal" />
<input type="hidden" id="petsVal" />
<input type="hidden" id="tvVal" />
<input type="hidden" id="greekVal" />
<input type="hidden" id="atiVal" /> */
        if( $this->input->post('study') == 'yes') {$study = TRUE;} else {$study = FALSE;}
        if( $this->input->post('neat') == 'yes') {$neat = TRUE;} else {$neat = FALSE;}
        if( $this->input->post('smoke') == 'yes') {$smoke = TRUE;} else {$smoke = FALSE;}
        if( $this->input->post('party') == 'yes') {$party = TRUE;} else {$party = FALSE;}
        if( $this->input->post('chef') == 'yes') {$chef = TRUE;} else {$chef = FALSE;}
        if( $this->input->post('gym') == 'yes') {$gym = TRUE;} else {$gym = FALSE;}
        if( $this->input->post('sports') == 'yes') {$sports = TRUE;} else {$sports = FALSE;}
        if( $this->input->post('movies') == 'yes') {$movies = TRUE;} else {$movies = FALSE;}
        if( $this->input->post('pets') == 'yes') {$pets = TRUE;} else {$pets = FALSE;}
        if( $this->input->post('tv') == 'yes') {$tv = TRUE;} else {$tv = FALSE;}
        if( $this->input->post('greek') == 'yes') {$greek = TRUE;} else {$greek = FALSE;}
        if( $this->input->post('ati') == 'yes') {$ati = TRUE;} else {$ati = FALSE;}
        
        $this->tenant_model->updatePersonalityProfile($study, $neat, $smoke, $party, $chef, $gym, $sports, $movies, $pets, $tv, $greek, $ati);
           
    } // ***END process_personality_profile() Method
    
    public function account_edit() {
        $this->_authorize_user();
        $tnt_id = $this->session->userdata('tnt_id');
        $data['page_title'] = 'Account Edit- Let Us Dorm';
        $data['page_header_icon'] = 'awe-edit';
        $data['page_header_title'] = 'Edit Your Account';
        $data['tenant_info'] = $this->tenant_model->getTenantInfo($tnt_id);
        //$data['personality_profile'] = $this->tenant_model->getTenantPersonalityProfile();
        $data['session_data'] = $this->session_data;
        
        
        $this->load->view('tenant_tier/common/header_view', $data);
        $this->load->view('tenant_tier/pages/account_edit_view', $data);
        $this->load->view('tenant_tier/common/footer_view');
    } // ***END account_edit();
    
    public function update_account_info() {
        $tnt_id = $this->session->userdata('tnt_id');
        $tnt_fname = $this->input->post('tnt-fname');
        $tnt_lname = $this->input->post('tnt-lname');
        $tnt_email = $this->input->post('tnt-email');
        $tnt_phone = $this->input->post('tnt-phone');
        
        $this->tenant_model->updateTenant($tnt_id, $tnt_fname, $tnt_lname, $tnt_email, $tnt_phone);
        
        redirect('tenant/account_edit', 'refresh');
    } // ***END update_account_info() Method
    
    public function upload_tenant_avatar() {
        $this->_authorize_user();
        
        $tnt_id = $this->session->userdata('tnt_id');
        // If user has uploaded a new personal photo, insert that photo into db and upload to users directory
        if(isset($_FILES['userfile'])) {
                $config['upload_path'] = './uploadedmedia/tenant/avatars/tenant' . $tnt_id . '/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '20000';
                $config['max_width'] = '5000';
                $config['max_height'] = '5000';


                $this->load->library('upload', $config);
                // Upload file
                if($this->upload->do_upload('userfile')) {
                        $upload_data = $this->upload->data();
                        $full_filename = $upload_data['file_name'];
                        // Insert uploaded photo into images database image_file FIELD
                        $this->tenant_model->associateAvatarToTenant($tnt_id, $full_filename);
                }

        } // ***END isset($_FILES) {if}
        $this->session->set_userdata('tnt_avatar', $full_filename);
        redirect('tenant/account_edit/', 'refresh');
    } // ***END upload_tenant_avatar() Method
    
    public function login() {
        $data['page_title'] = 'Tenant Login - Let Us Dorm';
        $data['invalid_credentials'] = FALSE;
        $this->load->view('tenant_tier/pages/login_view', $data);
    } // ***END login() Method
    
    public function process_login() {
        $this->load->library('form_validation', 'security');
        $this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');

        $this->form_validation->set_rules('login-email', 'Email Address', 'trim|required|valid_email');
        $this->form_validation->set_rules('login-pass', 'Password', 'required|max_length[30]|min_length[6]|xss_clean');

        if($this->form_validation->run() == FALSE) {
            // Form errors have been found. Display homepage with errors
            $data['page_title'] = 'Tenant Login - Let Us Dorm';
            $data['login_errors'] = TRUE;
            $this->load->view('tenant_tier/pages/login_view', $data);
        } else {
            $lemail = $this->input->post('login-email');
            $lpass = $this->input->post('login-pass');
            // Set Session Data and redirect
            $result = $this->tenant_model->processLogin($lemail, $lpass);
            // If result != False set session data and redirect to user dashboard page
            if($result != FALSE) {
                // Authorize user via Ten Hands Video conferencing
                $this->ten_hands_signin($result['tnt_email']);
                // Initialize session data
                $this->session->set_userdata($result);
                $this->session->set_userdata('authorized_user', 'yes');
                
                if($result['tnt_profile_complete'] == 'no') {
                    redirect('tenant/complete_profile', 'refresh');
                } else {
                    redirect('tenant/dashboard', 'refresh');
                }
            } else {
                // Load login form with 'Invalid Credentials' Alert
                $data = array();
                $data['page_title'] = 'Tenant Login - Let Us Dorm';
                $data['invalid_credentials'] = TRUE;
                
                $this->load->view('tenant_tier/pages/login_view', $data);
            }
        }
    } // ***END process_login() Method
    
    public function logout() {
        $this->session->sess_destroy();
        redirect('tenant/login', 'refresh');
    } // ***END logout() Method
    
    /**************************************************************************
     * ************************************************************************
     * 
     * MISC Methods
     * 
     * ************************************************************************
     * ************************************************************************
     */
    public function tdemo() {
        $data['session_data'] = $this->session_data;
        var_dump($this->session_data); die();
        $this->load->view('tenant_tier/pages/tenhands_1_view', $data);
    }
    
    private function ten_hands_signin($e) {
                // Sign in User for Ten Hands Video Conferencing
               /* $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL,"https://tenhands.net/api/v1/user/signIn");
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, "apiKey=9bc7c783-de00-4337-82d2-f220da75cc31&email=" . $e);
                // Execute and close cURL Request
                $resp = curl_exec ($curl);
                curl_close ($curl);
                // If user is successfully logged in decode json object
                $resp = json_decode($resp);
                $this->session->set_userdata('ten_hands', $resp); */
    } // ***END ten_hands_signin() Method
    
    private function _authorize_user() {
        //var_dump($this->session->all_userdata());
        $tmt_id = $this->session->userdata('tmt_id'); $tnt_id = $this->session->userdata('tnt_id');
        $authorized_user = $this->session->userdata('authorized_user');
        if(empty($tmt_id) || empty($tnt_id) || empty($authorized_user)) {
            redirect('tenant/login', 'refresh');
        } else {
            ;
        }
    } // ***END _authorize_user() Method
    
}