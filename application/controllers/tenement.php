<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tenement extends CI_Controller {
    
    protected $session_data;


    public function __construct() {
        parent::__construct();
        $this->load->model('tenement_model');
        $this->session_data = $this->session->all_userdata();
    }
    
    public function index() {
        $this->_authorize_user();
        redirect('tenement/dashboard', 'refresh');
    } // ***END index();
    
    public function dashboard() {
        $this->_authorize_user();
        $data['page_title'] = 'Dashboard - Let Us Dorm';
        $data['page_header_icon'] = 'awe-dashboard';
        $data['page_header_title'] = ucfirst($this->session_data['temp_position']) . ' Dashboard';
        $data['session_data'] = $this->session_data;
        
        $this->load->view('tenement_tier/common/header_view', $data);
        $this->load->view('tenement_tier/pages/dashboard_view', $data);
        $this->load->view('tenement_tier/common/footer_view');
    } // ***END dashboard() Method
    
    /**************************************************************************
     * ************************************************************************
     * Property Methods
     * - property()
     * - manage_building()
     * - add_building()
     * - load_unit_tenants()
     * ************************************************************************
     * ************************************************************************
     */
    public function property() {
        $this->_authorize_user();
        $data['page_title'] = 'Manage Property - Let Us Dorm';
        $data['page_header_icon'] = 'awe-table';
        $data['page_header_title'] = 'Manage Property';
        $data['session_data'] = $this->session_data;
        
        $data['tenement_towers'] = $this->tenement_model->getTenementTowers($this->session_data['tmt_id']);
        
        $this->load->view('tenement_tier/common/header_view', $data);
        $this->load->view('tenement_tier/pages/manage_property_view', $data);
        $this->load->view('tenement_tier/common/footer_view');
    } // ***END property() Method
    
    public function manage_building() {
        $this->_authorize_user();
        $tow_id = $this->uri->segment(3);
        
        $data['tower_info'] = $this->tenement_model->getTowerInfo($tow_id);
        $data['tower_units'] = $this->tenement_model->getTowerUnits($tow_id);
        
        $data['page_title'] = 'Manage Property - Let Us Dorm';
        $data['page_header_icon'] = 'awe-table';
        $data['page_header_title'] = 'Bulding: ' . $data['tower_info'][0]['tow_name'];
        $data['session_data'] = $this->session_data;
        
        $this->load->view('tenement_tier/common/header_view', $data);
        $this->load->view('tenement_tier/pages/manage_building_view', $data);
        $this->load->view('tenement_tier/common/footer_view');
    } // ***END manage_building() Method
    
    public function manage_building_modal() {
        $this->_authorize_user();
        $tow_id = $this->input->post('towID');
        $tnt_id = $this->input->post('tntID');
        
        $data['tower_info'] = $this->tenement_model->getTowerInfo($tow_id);
        $data['tower_units'] = $this->tenement_model->getTowerUnits($tow_id);
        $data['page_title'] = 'Manage Property - Let Us Dorm';
        $data['page_header_icon'] = 'awe-table';
        $data['page_header_title'] = 'Bulding: ' . $data['tower_info'][0]['tow_name'];
        $data['session_data'] = $this->session_data;
        $data['tnt_id'] = $tnt_id;
        
        $this->load->view('tenement_tier/pages/manage_building_modal_view', $data);
    }
    
    public function add_building() {
        $this->_authorize_user();
        $building_name = $this->input->post('buildingName');
        $building_floor_count = $this->input->post('buildingFloorCount');
        $building_units_per_floor = $this->input->post('buildingUnitsPerFloor');
        $building_default_bed_count = $this->input->post('buildingDefaultBedCount');
        $page = $this->input->post('page');
        
        $result = $this->tenement_model->addTenementTower($building_name, $building_floor_count, $building_units_per_floor, $building_default_bed_count);
        
        if($page != 'setup') {
            if($result) {
                echo $result;
            }
        } else {
            $tow_id = $result;

            $data['tower_info'] = $this->tenement_model->getTowerInfo($tow_id);
            $data['tower_units'] = $this->tenement_model->getTowerUnits($tow_id);

            $data['page_title'] = 'Manage Property - Let Us Dorm';
            $data['page_header_icon'] = 'awe-table';
            $data['page_header_title'] = 'Bulding: ' . $data['tower_info'][0]['tow_name'];
            $data['session_data'] = $this->session_data;
            
            $this->load->view('tenement_tier/pages/setup/step3/manage_building_view', $data);
        }
    } // ***END add_building() Method
    
    public function load_unit_tenants() {
        $this->_authorize_user();
        $tun_id = $this->input->post('tunID');
        if(is_numeric($tun_id)) { $result = $this->tenement_model->getUnitTenants($tun_id); }
        if($result) {
            $data['tenants'] = $result;
            $this->load->view('tenement_tier/pages/display_unit_tenants', $data);
        }
    } // ***END load_unit_tenants() Method
    
    public function load_possible_roommates() {
        $this->_authorize_user();
        $tun_id = $this->input->post('tunID');
        if(is_numeric($tun_id)) { $result = $this->tenement_model->getCompatibleRoommates($tun_id); }
        if($result) {
            $data['tenants'] = $result;
            $data['tun_id'] = $tun_id;
            $this->load->view('tenement_tier/pages/display_possible_roommates_view', $data);
        }
    } // ***END load_possible_roommates() Method
    
    
    /**************************************************************************
     * ************************************************************************
     * Manage Unit Methods
     * - manage_unit()
     * - manage_building()
     * - add_building()
     * - load_unit_tenants()
     * ************************************************************************
     * ************************************************************************
     */
    public function manage_unit() {
        $this->_authorize_user();
        $tun_id = $this->uri->segment(3);
        
        $data['unit_info'] = $this->tenement_model->getUnitInfo($tun_id);
        $data['maintenance_requests'] = $this->tenement_model->getUnitMaintenanceRequests($tun_id);
        $data['guest_passes'] = $this->tenement_model->getUnitGuestPasses($tun_id);
        $data['unit_tenants'] = $this->tenement_model->getUnitTenants($tun_id);
        $data['packages'] = $this->tenement_model->getUnitPackages($tun_id);
        
        $data['page_title'] = 'Manage Property - Let Us Dorm';
        $data['page_header_icon'] = 'awe-key';
        $data['page_header_title'] = 'Unit: ' . $data['unit_info']['unit_info'][0]['tun_number'];
        $data['session_data'] = $this->session_data;
        
        $this->load->view('tenement_tier/common/header_view', $data);
        $this->load->view('tenement_tier/pages/manage_unit_view', $data);
        $this->load->view('tenement_tier/common/footer_view');
    } // ***END manage_unit() Method
    
    public function insert_unit_analytics() {
        $tun_id = $this->input->post('tunID');
        $data['tun_id'] = $tun_id;
        
        $this->load->view('tenement_tier/pages/analytics/unit_analytics_view', $data);
    } // ***END insert_unit_analytics() Method


    /**************************************************************************
     * ************************************************************************
     * Tenant Methods
     * - property()
     * - manage_building()
     * - add_building()
     * - load_unit_tenants()
     * ************************************************************************
     * ************************************************************************
     */    
    public function tenants() {
        $this->_authorize_user();
        $data['page_title'] = 'Manage Tenants - Let Us Dorm';
        $data['page_header_icon'] = 'awe-group';
        $data['page_header_title'] = 'Tenants';
        $data['session_data'] = $this->session_data;
        
        $data['tenant_list'] = $this->tenement_model->getTenants($this->session_data['tmt_id']);
        
        $this->load->view('tenement_tier/common/header_view', $data);
        $this->load->view('tenement_tier/pages/manage_tenants_view', $data);
        $this->load->view('tenement_tier/common/footer_view');
    } // ***END tenants() Method
    
    public function add_tenant() {
        $tnt_fname = $this->input->post('tntFName');
        $tnt_lname = $this->input->post('tntLName');
        $tnt_phone = $this->input->post('tntPhone');
        $tnt_email = $this->input->post('tntEmail');
        
        $full_name = ucfirst($tnt_fname) . ' ' . ucfirst($tnt_lname);
        $result = $this->tenement_model->addTenant($tnt_fname, $tnt_lname, $tnt_email, $tnt_phone);
        if($result) {
            // Create user directory in Avatar directory 
            $avatar_directory_path = 'uploadedmedia/tenant/avatars/tenant' . $result;
            mkdir($avatar_directory_path, 0777);
            
            echo 1;
        }
    } // ***END add_tenant() Method
    
    public function delete_tenant() {
        $tnt_id = $this->input->post('tenantID');
        $result = $this->tenement_model->deleteTenant($tnt_id);
        if($result) {
            echo 1;
        }
    } // ***END delete_tenant() Method
    
    public function view_tenant() {
        $this->_authorize_user();
        $tnt_id = $this->uri->segment(3);
        $data['tenant_info'] = $this->tenement_model->getTenantInfo($tnt_id);
        
        $data['page_title'] = 'Tenant: ' . ucfirst($data['tenant_info'][0]['tnt_fname']) . ' ' . ucfirst($data['tenant_info'][0]['tnt_lname']);
        $data['page_header_icon'] = 'awe-user';
        $data['page_header_title'] = 'Tenant: ' . ucfirst($data['tenant_info'][0]['tnt_fname']) . ' ' . ucfirst($data['tenant_info'][0]['tnt_lname']);
        $data['session_data'] = $this->session_data;
        $data['tenement_towers'] = $this->tenement_model->getTenementTowers($this->session_data['tmt_id']);
        
        
        
        $this->load->view('tenement_tier/common/header_view', $data);
        $this->load->view('tenement_tier/pages/edit_tenant_view', $data);
        $this->load->view('tenement_tier/common/footer_view');
    } // ***END edit_employee() Method
    
    public function assign_tenant_to_unit() {
        $tnt_id = $this->input->post('tntID');
        $tun_id = $this->input->post('tunID');
        
        $result = $this->tenement_model->assignTenantToUnit($tnt_id, $tun_id);
        if($result) { echo 1; }
    } // ***END assign_tenant_to_unit() Method
    
    public function update_tenant() {
        $tnt_id = $this->input->post('tnt_id');
        $tnt_fname = $this->input->post('tnt-fname');
        $tnt_lname = $this->input->post('tnt-lname');
        $tnt_email = $this->input->post('tnt-email');
        $tnt_phone = $this->input->post('tnt-phone');
        
        $this->tenement_model->updateTenant($tnt_id, $tnt_fname, $tnt_lname, $tnt_email, $tnt_phone);
        
        redirect('tenement/tenants', 'refresh');
    } // ***END update_tenant() Method
    
    public function upload_tenant_avatar() {
        $this->_authorize_user();
        
        $temp_id = $this->input->post('tnt_id');
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
                        $this->tenement_model->associateAvatarToTenementEmployee($tnt_id, $full_filename);
                }

        } // ***END isset($_FILES) {if}
        redirect('tenement/edit_employee/' . $temp_id, 'refresh');
    } // ***END upload_tenant_avatar() Method
    
    /**************************************************************************
     * ************************************************************************
     * Employee Methods
     * - employees()
     * - add_employee()
     * - delete_employee()
     * - edit_employee()
     * - update_employee()
     * - upload_employee_avatar()
     * ************************************************************************
     * ************************************************************************
     */
    public function employees() {
        $this->_authorize_user();
        $data['page_title'] = 'Manage Employees - Let Us Dorm';
        $data['page_header_icon'] = 'awe-group';
        $data['page_header_title'] = 'Employees';
        $data['session_data'] = $this->session_data;
        
        $data['employee_list'] = $this->tenement_model->getEmployees();
        
        
        $this->load->view('tenement_tier/common/header_view', $data);
        $this->load->view('tenement_tier/pages/manage_employees_view', $data);
        $this->load->view('tenement_tier/common/footer_view');
    } // ***END employees() Method
    
    public function add_employee() {
        $temp_fname = $this->input->post('tempFName');
        $temp_lname = $this->input->post('tempLName');
        $temp_phone = $this->input->post('tempPhone');
        $temp_email = $this->input->post('tempEmail');
        $temp_position = $this->input->post('tempPosition');
        
        $result = $this->tenement_model->addEmployee($temp_fname, $temp_lname, $temp_email, $temp_phone, $temp_position);
        if($result) {
            // Create user directory in Avatar directory 
            $avatar_directory_path = 'uploadedmedia/employee/avatars/temp' . $result;
            mkdir($avatar_directory_path, 0777);
            echo 1;
        }
    } // ***END add_employee() Method
    
    public function delete_employee() {
        $temp_id = $this->input->post('employeeID');
        $result = $this->tenement_model->deleteEmployee($temp_id);
        if($result) {
            echo 1;
        }
    } // ***END delete_employee() Method
    
    public function edit_employee() {
        $this->_authorize_user();
        $data['page_title'] = 'Edit Employee - Let Us Dorm';
        $data['page_header_icon'] = 'awe-edit';
        $data['page_header_title'] = 'Edit Employees';
        $data['session_data'] = $this->session_data;
        
        $data['employee_info'] = $this->tenement_model->getEmployeeInfo($this->uri->segment(3), $this->session->userdata('tmt_id'));
        
        $this->load->view('tenement_tier/common/header_view', $data);
        $this->load->view('tenement_tier/pages/edit_employee_view', $data);
        $this->load->view('tenement_tier/common/footer_view');
    } // ***END edit_employee() Method
    
    public function update_employee() {
        $temp_id = $this->input->post('temp_id');
        $temp_fname = $this->input->post('temp-fname');
        $temp_lname = $this->input->post('temp-lname');
        $temp_email = $this->input->post('temp-email');
        $temp_phone = $this->input->post('temp-phone');
        $temp_position = $this->input->post('temp-position');
        
        $this->tenement_model->updateEmployee($temp_id, $temp_fname, $temp_lname, $temp_email, $temp_phone, $temp_position);
        
        redirect('tenement/employees', 'refresh');
    } // ***END update_employee() Method
    
    public function upload_employee_avatar() {
        $this->_authorize_user();
        
        $temp_id = $this->input->post('temp_id');
        // If user has uploaded a new personal photo, insert that photo into db and upload to users directory
        if(isset($_FILES['userfile'])) {
                $config['upload_path'] = './uploadedmedia/employee/avatars/temp' . $temp_id . '/';
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
                        $this->tenement_model->associateAvatarToTenementEmployee($temp_id, $full_filename);
                }

        } // ***END isset($_FILES) {if}
        redirect('tenement/edit_employee/' . $temp_id, 'refresh');
    } // ***END upload_avatar() Method
    
    public function package_logging() {
        $this->_authorize_user();
        $data['page_title'] = 'Package Center';
        $data['page_header_icon'] = 'awe-envelope';
        $data['page_header_title'] = 'Package Center';
        $data['session_data'] = $this->session_data;
        
        $this->load->view('tenement_tier/common/page_header_view', $data);
        $this->load->view('tenement_tier/pages/package_logging_view', $data);
        $this->load->view('tenement_tier/common/footer_view');   
    } // ***END package_logging() Method
    
    public function log_package() {
        $this->_authorize_user();
        
        $data = array(
            'service' => $this->input->post('deliveryService'),
            'item' => $this->input->post('deliveryItem'),
            'tnt_id' => $this->input->post('recipient'),
            'tracking_number' => $this->input->post('trackingNumber'),
            'notes' => $this->input->post('deliveryNotes'),
            'verification' => $this->input->post('deliveryVerification')
            
        );
        $result = $this->tenement_model->logPackage($data);
        if($result) {
            $send_notification = NULL;
            
            if($result[0]['package_email'] == 'yes') {
                $notification['ncron_method'] = 'email';
            } else if($result[0]['package_sms'] == 'yes') {
                $notification['ncron_method'] = 'sms';
            }
            if($result[0]['package_sms'] == 'yes' && $result[0]['package_email'] == 'yes') {
                $notification['ncron_method'] = 'both';
            }
            $notification['ncron_notification_type'] = 'package_delivery';
            $notification['ncron_target'] = 'resident';
            $notification['audience_id'] = $result[0]['tnt_id'];
            $notification['ncron_subject'] = 'Package Notification: You Have Received A Package';
            $notification['ncron_body'] = $data['service'] . ' - ' . $data['item'] . '<br />' . 'Received: ' . date("Y-m-d H:i:s"); 
            
            $notification_insert = $this->tenement_model->createNotification($notification);
            if($notification_insert) {
                echo 1;
            }
        } // ***END {if} $result
    } // ***END log_package() Method
    
    public function package_pickup() {
        $this->_authorize_user();
        $data['page_title'] = 'Package Center';
        $data['page_header_icon'] = 'awe-envelope';
        $data['page_header_title'] = 'Package Center';
        $data['session_data'] = $this->session_data;
        $data['pending_pickups'] = $this->tenement_model->getPendingPackages();
        
        $this->load->view('tenement_tier/common/page_header_view', $data);
        $this->load->view('tenement_tier/pages/package_pickup_view', $data);
        $this->load->view('tenement_tier/common/footer_view');   
    } // ***END package_pickup() Method
    
    public function package_delivered() {
        $this->_authorize_user();
        $pack_id = (int) $this->input->post('packageID');
        if( is_numeric($pack_id) ) {
            $result = $this->tenement_model->markPackageDelivered( $this->input->post('packageID') );
            if($result) {
                echo 1;
            }
        }
        
    } // ***END package_delivered() Method

    public function packagelog_autocomplete() {
        $this->_authorize_user();
        $query = $this->tenement_model->getTenantListForPackages($this->input->post('queryString'));

        foreach($query->result() as $row):
            echo "<tr id='$row->tnt_id' onclick='updateInput($row->tnt_id);'>";
                echo "<td>" . $row->tun_number . "</td>";
                echo "<td>" . $row->tnt_fname . ' ' . $row->tnt_lname . "</td>";
                echo "<td style='text-align: center;'><span class='btn btn-wuxia btn-small btn-primary'>Select</span></td>";
            echo "</tr>";
        endforeach;    
    } 
    
    /*****************************************
     * Notification Center
     * 1) notification_center()
     * 2) process_login()
     * ***************************************
     */
    public function notification_center() {
        $this->_authorize_user();
        $data['page_title'] = 'Notification Center';
        $data['page_header_icon'] = 'awe-bullhorn';
        $data['page_header_title'] = 'Notification Center';
        $data['session_data'] = $this->session_data;
        
        $this->load->view('tenement_tier/common/page_header_view', $data);
        $this->load->view('tenement_tier/pages/notification_center_view', $data);
        $this->load->view('tenement_tier/common/footer_view');
    } // ***END notification_center() Method
    
    public function notification_load_target_audience() {
        $target_audience = $this->input->post('targetAudience');
        
        switch ($target_audience) {
            case 1:
                // Send to single resident
                $this->load->view('tenement_tier/pages/notification_target_audience/single_resident_view');
                break;
            case 2:
                // Send to Unit
                $data['audience'] = 'unit';
                $data['tenement_towers'] = $this->tenement_model->getTenementTowers($this->session_data['tmt_id']);
                $this->load->view('tenement_tier/pages/notification_target_audience/building_view', $data);
                
                break;
            case 3:
                // Send to Building
                $data['audience'] = 'tower';
                $data['tenement_towers'] = $this->tenement_model->getTenementTowers($this->session_data['tmt_id']);
                $this->load->view('tenement_tier/pages/notification_target_audience/building_view', $data);
                
                break;
            case 4:
                // Send to Entire Community
                $this->load->view('tenement_tier/pages/notification_target_audience/community_view');
                break;
            case "home":
                $this->load->view('tenement_tier/pages/notification_target_audience/target_audience_selection_view');
                break;
            default:
                
                break;
        } // ***END of {switch} $target_audience
    } // ***END notification_load_target_audience() Method
    
    public function notification_load_unit_selection() {
        $tow_id = $this->input->post('towID');
        $data['tower_info'] = $this->tenement_model->getTowerInfo($tow_id);
        $data['tower_units'] = $this->tenement_model->getTowerUnits($tow_id);
        
        $this->load->view('tenement_tier/pages/notification_target_audience/unit_selection_view', $data);
    } // ***END notification_load_unit_selection() Method
    
    public function send_notification() {
        $ncron_target = $this->input->post('targetAudience');
        $ncron_audience_id = $this->input->post('audienceID');
        $title = $this->input->post('title');
        $message = $this->input->post('message');
        $ncron_method = $this->input->post('deliveryMethod');
        if($ncron_target == 'tnt') {
            $ncron_target = 'resident';
        } else if($ncron_target == 'tun') {
            $ncron_target = 'unit';
        } else if($ncron_target == 'tow') {
            $ncron_target = 'building';
        } else if($ncron_target == 'all') {
            $ncron_target = 'community';
        } else {
            $ncron_target = FALSE;
        }
        
        switch ($ncron_method) {
            case "email":
                break;
            case "sms":
                break;
            case "both":
                break;
            default:
                $ncron_method = FALSE;
                break;
        }
        if($ncron_target && $ncron_method && (is_numeric($ncron_audience_id) || $ncron_audience_id == NULL)) {
            $notification['ncron_method'] = $ncron_method;
            $notification['ncron_notification_type'] = 'general';
            $notification['ncron_target'] = $ncron_target;
            $notification['audience_id'] = $ncron_audience_id;
            $notification['ncron_subject'] = $title;
            $notification['ncron_body'] = $message; 

            $notification_insert = $this->tenement_model->createNotification($notification);
            echo 1;
        } else {
            echo 2;
        }
    } // ***END send_notification() Method

    
    /*****************************************
     * ROOMMATE MATCHING METHOD
     * 1) roommate_matching()
     * 2) 
     * ***************************************
     */
    public function roommate_matching() {
        $this->_authorize_user();
        $data['page_title'] = 'Roommate Matching';
        $data['page_header_icon'] = 'awe-group';
        $data['page_header_title'] = 'Roommate Matching';
        $data['session_data'] = $this->session_data;
        
        $this->load->view('tenement_tier/common/header_view', $data);
        $this->load->view('tenement_tier/pages/roommate_matching_view', $data);
        $this->load->view('tenement_tier/common/footer_view');
    } // ***END roommate matching() Method
    
    
    /*****************************************
     * Analytical Methods
     * 1) analytics()
     * 2) load_narrowed_analytics()
     * ***************************************
     */
    public function analytics() {
        $this->_authorize_user();
        $type = $this->uri->segment(3);
        if($type == 'impressions') {
            $title = 'Impressions';
        } else if($type == 'maintenance') {
            $title = 'Analytics - Maintenance Requests';
        } else if($type == 'guestpasses') {
            $title = 'Analytics - Issued Guest Passes';
        }
        $data['page_title'] = 'Analytics - Let Us Dorm';
        $data['page_header_icon'] = 'awe-bar-chart';
        $data['page_header_title'] = $title;
        $data['session_data'] = $this->session_data;
        
        
        $this->load->view('tenement_tier/common/header_view', $data);
        if($type == 'impressions') {
            $this->load->view('tenement_tier/pages/analytics/impressions_selection_view', $data);
            //$this->load->view('tenement_tier/pages/analytics/impressions_view', $data);
        } else if($type == 'maintenance') {
            $this->load->view('tenement_tier/pages/analytics/maintenance_view', $data);
        } else if($type == 'guestpasses') {
            $this->load->view('tenement_tier/pages/analytics/guestpasses_view', $data);
        }
        $this->load->view('tenement_tier/common/footer_view');
    } // ***END analytics() Method
    
    public function load_narrowed_analytics() {
        $this->_authorize_user();
        $type = $this->input->post('type');
        $timeframe = $this->input->post('timeFrame');
        $scope = $this->input->post('scope');
        $id = $this->input->post('id');
        
        if($timeframe == 'today' || $timeframe == 'last_7_days' || $timeframe == 'last_30_days' || $timeframe == 'last_90_days' || $timeframe == 'this_100_years') {} else { $timeframe = 'today'; }
        
        //$scope = 'summary'; $type = 'impressions';
        if($scope == 'summary' && $type == 'impressions') {
            $tower_data = array();
            $top5TowersByImpressions = NULL;
            $top5UnitsByImpressions = NULL;
            // KEEN API CALLS
            // Find Total Amount of Impressions 
            $totalImpressions = $this->executeKeenCall('https://api.keen.io/3.0/projects/52b3bce536bf5a240d000000/queries/count?api_key=3e3e7eda803caf9bc67d3f37bd770b94b9171cf1ddff40851bd89714dcc01c385377b2825df60a2856e1ed616b302eb0dd5ea534d70b5f36b80cac0f0f2759682e660bc470aa58a55e47c884cb0948692547a4eed83ea322c747c38a6eea054f7e5a4e89f84d21235a4efb73c92fbd78&event_collection=impressions&timeframe=' . $timeframe . '&timezone=-18000');
            // Get List of Buildings with Impressions & Top 5 Tenants With Impressions
            $unitsWithImpressions = $this->executeKeenCall('https://api.keen.io/3.0/projects/52b3bce536bf5a240d000000/queries/count?api_key=3e3e7eda803caf9bc67d3f37bd770b94b9171cf1ddff40851bd89714dcc01c385377b2825df60a2856e1ed616b302eb0dd5ea534d70b5f36b80cac0f0f2759682e660bc470aa58a55e47c884cb0948692547a4eed83ea322c747c38a6eea054f7e5a4e89f84d21235a4efb73c92fbd78&event_collection=impressions&timeframe=' . $timeframe . '&timezone=-18000&target_property=keen.id&group_by=tunID');
            $buildingsWithImpressions = $this->executeKeenCall('https://api.keen.io/3.0/projects/52b3bce536bf5a240d000000/queries/count?api_key=3e3e7eda803caf9bc67d3f37bd770b94b9171cf1ddff40851bd89714dcc01c385377b2825df60a2856e1ed616b302eb0dd5ea534d70b5f36b80cac0f0f2759682e660bc470aa58a55e47c884cb0948692547a4eed83ea322c747c38a6eea054f7e5a4e89f84d21235a4efb73c92fbd78&event_collection=impressions&timeframe=' . $timeframe . '&timezone=-18000&target_property=keen.id&group_by=towID');
            
            
            
            // Iterate Through Buildings And Sort By # of impressions DESC
            if(!empty($buildingsWithImpressions)) {
                foreach($buildingsWithImpressions as $row) {
                    $top5TowersByImpressions[] = array(
                        'towID' => $row->towID,
                        'impressions' => $row->result
                    );
                }
                $this->keenSort($top5TowersByImpressions, 'impressions');
                // Iterate Through top 5 Towers
                $i = 0;
                foreach($top5TowersByImpressions as $row) {
                    if($i < 5) {
                        
                        $top5TowersByImpressionsFiltered[$i]['info'] = $this->tenement_model->getTowerInfo($row['towID']);
                        $top5TowersByImpressionsFiltered[$i]['impressions'] = $row['impressions'];
                    }
                    $i += 1;
                }
            } // ***END if($buildingWithImpressions) {}          
            
            // Iterate Through Users And Sort By # of Impressions DESC
            if(!empty($unitsWithImpressions)) {
                foreach($unitsWithImpressions as $row) {
                    $top5UnitsByImpressions[] = array(
                        'tunID' => $row->tunID,
                        'impressions' => $row->result
                    );
                }
                $this->keenSort($top5UnitsByImpressions, 'impressions');
                // Iterate through top 5 tenants
                $i = 0;
                foreach($top5UnitsByImpressions as $row) {
                    if($i < 5) {
                        $top5UnitsByImpressionsFiltered[$i]['info'] = $this->tenement_model->getUnitInfo($row['tunID']);
                        $top5UnitsByImpressionsFiltered[$i]['impressions'] = $row['impressions'];
                    }
                    $i += 1;
                }
            } // ***END if($top5TenantsWithImpressions) {}
            
            $data['analytics_type'] = $type;
            $data['timeframe'] = $timeframe;
            $data['total_impressions'] = $totalImpressions;
            $data['tenement_towers'] = $this->tenement_model->getTenementTowers($this->session_data['tmt_id']);
            $data['top5UnitsByImpressions'] = $top5UnitsByImpressionsFiltered;
            $data['top5TowersByImpressions'] = $top5TowersByImpressionsFiltered;

            /************************************************************/
            // Iterate Through Towers And Count Total Impressions Per Specified time period
            $i = 0;
            foreach($data['tenement_towers'] as $tower) {
                $tower_data[$i]['tow_name'] = $tower['tow_name'];
                $tower_data[$i]['tow_id'] = $tower['tow_id'];
                $tower_data[$i]['impressions'] = $this->executeKeenCall('https://api.keen.io/3.0/projects/52b3bce536bf5a240d000000/queries/count?api_key=3e3e7eda803caf9bc67d3f37bd770b94b9171cf1ddff40851bd89714dcc01c385377b2825df60a2856e1ed616b302eb0dd5ea534d70b5f36b80cac0f0f2759682e660bc470aa58a55e47c884cb0948692547a4eed83ea322c747c38a6eea054f7e5a4e89f84d21235a4efb73c92fbd78&event_collection=impressions&filters=%5B%7B%22property_name%22%3A%22towID%22%2C%22operator%22%3A%22eq%22%2C%22property_value%22%3A%22' . $tower['tow_id'] . '%22%7D%5D&timeframe=' . $timeframe . '&timezone=-18000');
                $i += 1;
            }
            $data['tower_data'] = $tower_data;
            /************************************************************/
            $this->load->view('tenement_tier/pages/analytics/impressions/summary_analytics_view', $data);
        } else if($scope == 'building' && $type == 'impressions') {
            $tower_data = array();
            // KEEN API Calls
            $totalImpressions = $this->executeKeenCall('https://api.keen.io/3.0/projects/52b3bce536bf5a240d000000/queries/count?api_key=3e3e7eda803caf9bc67d3f37bd770b94b9171cf1ddff40851bd89714dcc01c385377b2825df60a2856e1ed616b302eb0dd5ea534d70b5f36b80cac0f0f2759682e660bc470aa58a55e47c884cb0948692547a4eed83ea322c747c38a6eea054f7e5a4e89f84d21235a4efb73c92fbd78&event_collection=impressions&timeframe=' . $timeframe . '&timezone=-18000');

            $data['analytics_type'] = $type;
            $data['timeframe'] = $timeframe;
            $data['total_impressions'] = $totalImpressions;
            $data['tenement_towers'] = $this->tenement_model->getTenementTowers($this->session_data['tmt_id']);

            $i = 0;
            foreach($data['tenement_towers'] as $tower) {
                $tower_data[$i]['tow_name'] = $tower['tow_name'];
                $tower_data[$i]['tow_id'] = $tower['tow_id'];
                $tower_data[$i]['impressions'] = $this->executeKeenCall('https://api.keen.io/3.0/projects/52b3bce536bf5a240d000000/queries/count?api_key=3e3e7eda803caf9bc67d3f37bd770b94b9171cf1ddff40851bd89714dcc01c385377b2825df60a2856e1ed616b302eb0dd5ea534d70b5f36b80cac0f0f2759682e660bc470aa58a55e47c884cb0948692547a4eed83ea322c747c38a6eea054f7e5a4e89f84d21235a4efb73c92fbd78&event_collection=impressions&filters=%5B%7B%22property_name%22%3A%22towID%22%2C%22operator%22%3A%22eq%22%2C%22property_value%22%3A%22' . $tower['tow_id'] . '%22%7D%5D&timeframe=' . $timeframe . '&timezone=-18000');
                $i += 1;
            }
            $data['tower_data'] = $tower_data;
            $this->load->view('tenement_tier/pages/analytics/narrowed/impressions/building_impressions_view', $data);
        } else if($scope == 'unit' && $type == 'impressions') {
            $tower_unit_analytics = array();
            $data['analytics_type'] = $type;
            $data['timeframe'] = $timeframe;
            $data['total_impressions'] = $this->executeKeenCall('https://api.keen.io/3.0/projects/52b3bce536bf5a240d000000/queries/count?api_key=3e3e7eda803caf9bc67d3f37bd770b94b9171cf1ddff40851bd89714dcc01c385377b2825df60a2856e1ed616b302eb0dd5ea534d70b5f36b80cac0f0f2759682e660bc470aa58a55e47c884cb0948692547a4eed83ea322c747c38a6eea054f7e5a4e89f84d21235a4efb73c92fbd78&event_collection=impressions&timeframe=' . $timeframe . '&timezone=-18000');
            $data['building_total_impressions'] = $this->executeKeenCall('https://api.keen.io/3.0/projects/52b3bce536bf5a240d000000/queries/count?api_key=3e3e7eda803caf9bc67d3f37bd770b94b9171cf1ddff40851bd89714dcc01c385377b2825df60a2856e1ed616b302eb0dd5ea534d70b5f36b80cac0f0f2759682e660bc470aa58a55e47c884cb0948692547a4eed83ea322c747c38a6eea054f7e5a4e89f84d21235a4efb73c92fbd78&event_collection=impressions&filters=%5B%7B%22property_name%22%3A%22towID%22%2C%22operator%22%3A%22eq%22%2C%22property_value%22%3A%22' . $id . '%22%7D%5D&timeframe=' . $timeframe . '&timezone=-18000&target_property=towID');
            $data['tower_info'] = $this->tenement_model->getTowerInfo($id);
            $data['tower_units'] = $this->tenement_model->getTowerUnits($id);
            
            $i = 0;
            foreach($data['tower_units'] as $tu) {
                $i = $tu['tun_id'];
                $tower_unit_analytics[$i]['tun_id'] = $tu['tun_id'];
                $tower_unit_analytics[$i]['tun_number'] = $tu['tun_number'];
                $tower_unit_analytics[$i]['tun_floor'] = $tu['tun_floor'];
                $tower_unit_analytics[$i]['unit_total_impressions'] = $this->executeKeenCall('https://api.keen.io/3.0/projects/52b3bce536bf5a240d000000/queries/count?api_key=3e3e7eda803caf9bc67d3f37bd770b94b9171cf1ddff40851bd89714dcc01c385377b2825df60a2856e1ed616b302eb0dd5ea534d70b5f36b80cac0f0f2759682e660bc470aa58a55e47c884cb0948692547a4eed83ea322c747c38a6eea054f7e5a4e89f84d21235a4efb73c92fbd78&event_collection=impressions&filters=%5B%7B%22property_name%22%3A%22towID%22%2C%22operator%22%3A%22eq%22%2C%22property_value%22%3A%22' . $id . '%22%7D%2C%7B%22property_name%22%3A%22tunID%22%2C%22operator%22%3A%22eq%22%2C%22property_value%22%3A%22' . $tu['tun_id'] . '%22%7D%5D&timeframe=' . $timeframe . '&timezone=-18000&target_property=tunID');
                $tower_unit_analytics[$i]['unit_total_unique_tenant_visitors'] = $this->executeKeenCall('https://api.keen.io/3.0/projects/52b3bce536bf5a240d000000/queries/count_unique?api_key=3e3e7eda803caf9bc67d3f37bd770b94b9171cf1ddff40851bd89714dcc01c385377b2825df60a2856e1ed616b302eb0dd5ea534d70b5f36b80cac0f0f2759682e660bc470aa58a55e47c884cb0948692547a4eed83ea322c747c38a6eea054f7e5a4e89f84d21235a4efb73c92fbd78&event_collection=impressions&filters=%5B%7B%22property_name%22%3A%22towID%22%2C%22operator%22%3A%22eq%22%2C%22property_value%22%3A%22' . $id . '%22%7D%2C%7B%22property_name%22%3A%22tunID%22%2C%22operator%22%3A%22eq%22%2C%22property_value%22%3A%22' . $tu['tun_id'] . '%22%7D%5D&timeframe=' . $timeframe . '&timezone=-18000&target_property=tntID');
                
                $i += 1;
            }
            $data['tower_unit_analytics'] = $tower_unit_analytics;
            
            
            $this->load->view('tenement_tier/pages/analytics/narrowed/impressions/unit_impressions_view', $data);
        } else if($scope == 'unit_tenants' && $type == 'impressions') {
            $unit_tenants_analytics = array();
            $data['analytics_type'] = $type;
            $data['timeframe'] = $timeframe;
            $data['total_impressions'] = $this->executeKeenCall('https://api.keen.io/3.0/projects/52b3bce536bf5a240d000000/queries/count?api_key=3e3e7eda803caf9bc67d3f37bd770b94b9171cf1ddff40851bd89714dcc01c385377b2825df60a2856e1ed616b302eb0dd5ea534d70b5f36b80cac0f0f2759682e660bc470aa58a55e47c884cb0948692547a4eed83ea322c747c38a6eea054f7e5a4e89f84d21235a4efb73c92fbd78&event_collection=impressions&timeframe=' . $timeframe . '&timezone=-18000');
            $data['unit_total_impressions'] = $this->executeKeenCall('https://api.keen.io/3.0/projects/52b3bce536bf5a240d000000/queries/count?api_key=3e3e7eda803caf9bc67d3f37bd770b94b9171cf1ddff40851bd89714dcc01c385377b2825df60a2856e1ed616b302eb0dd5ea534d70b5f36b80cac0f0f2759682e660bc470aa58a55e47c884cb0948692547a4eed83ea322c747c38a6eea054f7e5a4e89f84d21235a4efb73c92fbd78&event_collection=impressions&filters=%5B%7B%22property_name%22%3A%22towID%22%2C%22operator%22%3A%22eq%22%2C%22property_value%22%3A%22' . $id . '%22%7D%5D&timeframe=' . $timeframe . '&timezone=-18000&target_property=tunID');
        }

    } // ***END load_narrowed_analytics() Method
    
    /*****************************************
     * Login Method
     * 1) login()
     * 2) process_login()
     * ***************************************
     */
    
    public function login() {
        $data['page_title'] = 'Tenement Login - Let Us Dorm';
        $data['invalid_credentials'] = FALSE;
        $this->load->view('tenement_tier/pages/login_view', $data);
    } // ***END login() Method
    
    public function process_login() {
        $this->load->library('form_validation', 'security');
        $this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');

        $this->form_validation->set_rules('login-email', 'Email Address', 'trim|required|valid_email');
        $this->form_validation->set_rules('login-pass', 'Password', 'required|max_length[30]|min_length[6]|xss_clean');

        if($this->form_validation->run() == FALSE) {
            // Form errors have been found. Display homepage with errors
            $data['page_title'] = 'Tenement Login - Let Us Dorm';
            $data['login_errors'] = TRUE;
            $this->load->view('tenement_tier/pages/login_view', $data);
        } else {
            $lemail = $this->input->post('login-email');
            $lpass = $this->input->post('login-pass');
            // Set Session Data and redirect
            $result = $this->tenement_model->processLogin($lemail, $lpass);
            // If result != False set session data and redirect to user dashboard page
            if($result != FALSE) {
                // Set session data and pass a value of 1=success back to ajax call
                $this->session->set_userdata($result);
                $this->session->set_userdata('authorized_user', 'yes');
                redirect('tenement/dashboard', 'refresh');
            } else {
                // Load login form with 'Invalid Credentials' Alert
                $data = array();
                $data['page_title'] = 'Tenement Login - Let Us Dorm';
                $data['invalid_credentials'] = TRUE;
                
                $this->load->view('tenement_tier/pages/login_view', $data);
            }
        }
    } // ***END process_login() Method
    
    public function logout() {
        $this->session->sess_destroy();
        redirect('tenement/login', 'refresh');
    } // ***END logout() Method
    
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
    
    function otok() {
        $r = $this->tenement_model->_openTokGenerateSession();
        var_dump($r);
        
    }
    
    public function executeKeenCall($url) {
        $api_url = $url;
        $ch = curl_init(); curl_setopt( $ch, CURLOPT_URL, $api_url ); 
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array ('Accept: application/json', 'Content-Length: 0') );                                   
        curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'GET'); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, '30');
        
        $response = curl_exec( $ch );   
        $result = json_decode($response); 

        return $result->result;
    } // ***END executeKeenCall()

    public function keenSort(&$array, $key) {
        $sorter=array();
        $ret=array();
        reset($array);
        foreach ($array as $ii => $va) {
            $sorter[$ii]=$va[$key];
        }
        arsort($sorter);
        foreach ($sorter as $ii => $va) {
            $ret[$ii]=$array[$ii];
        }
        $array=$ret;
    }
    
    
}

