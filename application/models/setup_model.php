<?php

class Setup_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function createTenement($property_name, $property_phone, $property_email, $property_website, $property_address, $property_city, $property_state, $property_zip, $admin_email, $admin_password, $admin_phone) {
        $sql = 'INSERT INTO Tenement (tmt_name, tmt_phone, tmt_email, tmt_url, tmt_street, tmt_city, tmt_state, tmt_zip) VALUES(?, ?, ?, ?, ?, ?, ?, ?)';
        $q = $this->db->query($sql, array($property_name, $property_phone, $property_email, $property_website, $property_address, $property_city, $property_state, $property_zip));
        $tmt_id = $this->db->insert_id();
        
        $temp_id = $this->createTenementAdmin($tmt_id, $admin_email, $admin_password, $admin_phone);
        $this->createTenementFeatures($tmt_id);
        
        $session_data = array(
                'temp_id' => $temp_id,
                'tmt_id' => $tmt_id,
                'temp_fname' => 'Admin',
                'temp_lname' => '',
                'temp_position' => 'administrator',
                'temp_avatar' => NULL,
                'step1_status' => 'completed'
        );        
        $this->session->set_userdata($session_data);

        return TRUE;
    } // ***END createTenement() Method
    
    public function createTenementAdmin($tmt_id, $admin_email, $admin_password, $admin_phone) {
        $admin_password = $this->_hash_password($admin_password);
        $sql = 'INSERT INTO TenementEmployee (tmt_id, temp_fname, temp_email, temp_phone, temp_position, temp_password) VALUES (?, ?, ?, ?, ?, ?)';
        $q = $this->db->query($sql, array($tmt_id, 'Admin', $admin_email, $admin_phone, 'administrator', $admin_password));
        
        return $this->db->insert_id();
    } // ***END createTenementAdmin() Method
    
    public function createTenementFeatures($tmt_id) {
        $sql = 'INSERT INTO TenementFeatures (tmt_id, feature_maintenance, feature_package, feature_notification, feature_reservations, feature_roommate, feature_newsfeed, feature_guestpasses, feature_socialshopping, feature_carpool, feature_marketplace) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $this->db->query($sql, array($tmt_id, 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no'));
    } // ***END createTenementFeatures($tmt_id) Method
    
    
    public function setTenementFeatures($tmt_id, $maintenance, $package, $notifications, $reservations, $roommate_matching, $newsfeed, $guest_passes, $social_shopping, $carpool, $marketplace) {
        $sql = 'UPDATE TenementFeatures SET feature_maintenance=?, feature_package=?, feature_notification=?, feature_reservations=?, feature_roommate=?, feature_newsfeed=?, feature_guestpasses=?, feature_socialshopping=?, feature_carpool=?, feature_marketplace=? WHERE tmt_id=?';
        $this->db->query($sql, array($maintenance, $package, $notifications, $reservations, $roommate_matching, $newsfeed, $guest_passes, $social_shopping, $carpool, $marketplace, $tmt_id));
    } // ***END setTenementFeatures() Method
    
    
    
    
    
    
    private function _hash_password($pass) {
        $pass = hash('sha256', $pass);
        return $pass;
    } //***END _hash_admin_password() Method
    
}