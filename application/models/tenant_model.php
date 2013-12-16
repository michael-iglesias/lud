<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tenant_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    
    /*************************************************************************
     * Update User(Tenant) account methods
     * - getTenantInfo()
     * - updateTenant()
     * - associateAvatarToTenant()
     *************************************************************************/
    public function getTenantInfo($tnt_id) {
        $data = array();
        $sql = "SELECT Tenant.tnt_id, Tenant.tnt_fname, Tenant.tnt_lname, Tenant.tnt_phone, Tenant.tnt_email, Tenant.tnt_avatar, Leasing.lease_id, Leasing.tun_id, Leasing.urm_id, UnitRoom.urm_id, UnitRoom.urm_room_number, TowerUnit.tun_number, TenementTower.tow_name FROM Tenant LEFT JOIN Leasing ON Tenant.tnt_id = Leasing.tnt_id Left JOIN UnitRoom ON Leasing.urm_id = UnitRoom.urm_id LEFT JOIN TowerUnit ON UnitRoom.tun_id = TowerUnit.tun_id LEFT JOIN TenementTower ON TowerUnit.tow_id = TenementTower.tow_id WHERE Tenant.tnt_id=?";
        $q = $this->db->query($sql, $tnt_id);
        
        return $q->result_array();
    }
    
    public function updateTenant($tnt_id, $tnt_fname, $tnt_lname, $tnt_email, $tnt_phone) {
        $sql = 'UPDATE Tenant SET tnt_fname=?, tnt_lname=?, tnt_email=?, tnt_phone=? WHERE tnt_id=?';
        $q = $this->db->query($sql, array($tnt_fname, $tnt_lname, $tnt_email, $tnt_phone, $tnt_id));
    } // ***END updateTenant() Method
    
    public function updatePersonalityProfile($study, $neat, $smoke, $party, $chef, $gym, $sports, $movies, $pets, $tv, $greek, $ati) {
        $sql = 'UPDATE PersonalityProfile SET prof_study=?, prof_neat=?, prof_smoke=?, prof_party=?, prof_chef=?, prof_gym=?, prof_sports=?, prof_movies=?, prof_pets=?, prof_tv=?, prof_greek=?, prof_ati=? WHERE tnt_id=?';
        $this->db->query($sql, array($study, $neat, $smoke, $party, $chef, $gym, $sports, $movies, $pets, $tv, $greek, $ati, $this->session->userdata('tnt_id')));
    } // ***END updatePersonalityProfile() Method
    
    public function associateAvatarToTenant($tnt_id, $full_filename) {
        $sql = 'UPDATE Tenant SET tnt_avatar=? WHERE tnt_id=?';
        $q = $this->db->query($sql, array($full_filename, $tnt_id));
        
        return TRUE;
    }
    
    /**************************************************************************
     * My Unit Methods
     * - getUnitTenants()
     * - getGroupMessages()
     * - account_edit()
     * - update_account_info()
     * - upload_tenant_avatar()
     * ***********************************************************************/
    
    public function getUnitTenants($tun_id) {
        $data = array();
        if($tun_id == FALSE) {
            return NULL;
        } else {
            $sql = "SELECT Tenant.tnt_id, Tenant.tnt_fname, Tenant.tnt_lname, Tenant.tnt_avatar, Leasing.lease_id, Leasing.urm_id, UnitRoom.urm_id, UnitRoom.urm_room_number, UnitRoom.urm_master FROM Tenant JOIN Leasing ON Tenant.tnt_id = Leasing.tnt_id JOIN UnitRoom ON Leasing.urm_id = UnitRoom.urm_id WHERE Leasing.tun_id=?";
            $q = $this->db->query($sql, $tun_id);
            foreach($q->result_array() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    } // ***END getUnitTenants() Method
    
    public function getUnitItemsList($tun_id) {
        $data = array();
        $sql = 'SELECT *, AppliancesNeededForUnitRoom.urua_id FROM AppliancesNeededForUnitRoom LEFT JOIN UnitAppliancesTemplate ON AppliancesNeededForUnitRoom.uappt_id = UnitAppliancesTemplate.uappt_id Left JOIN TenantResponsibleForItem ON TenantResponsibleForItem.urua_id = AppliancesNeededForUnitRoom.urua_id LEFT JOIN Tenant ON TenantResponsibleForItem.tnt_id = Tenant.tnt_id WHERE AppliancesNeededForUnitRoom.tun_id=?';
        $q = $this->db->query($sql, $tun_id);
        foreach($q->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    } // ***END Method
    
    public function addItemToList($item_title, $item_image) {
        $tun_id = $this->session->userdata('tun_id');
        // Check to see if item is already a pre-defined item
        $sql = 'SELECT * FROM UnitAppliancesTemplate WHERE uappt_title=?';
        $t = $this->db->query($sql, array($item_title));
        
        if($t->num_rows() > 0) {
            
            $uappt_id = $t->result_array();
            $uappt_id = $uappt_id[0]['uappt_id'];
            // Item is already pre-defined, at this point just add to AppliancesNeededForUnitRoom
            $sql2 = 'INSERT INTO AppliancesNeededForUnitRoom (uappt_id, tun_id) VALUES (?, ?)';
            $qq = $this->db->query($sql2, array($uappt_id, $tun_id));
            
        } else {
            $sql3 = 'INSERT INTO AppliancesNeededForUnitRoom  (tun_id, urua_title, urua_image) VALUES (?, ?, ?)';
            $qqq = $this->db->query($sql, array($tun_id, $item_title, $item_image));
        }
        return true;
    } // ***END addItemToList($item_title, $item_image) Method
    
    public function addItemToTenantList($urua_id) {
        $tnt_id = $this->session->userdata('tnt_id');
        $sql = 'INSERT INTO TenantResponsibleForItem (urua_id, tnt_id) VALUES(?, ?)';
        $q = $this->db->query($sql, array($urua_id, $tnt_id));
        
        return $this->db->insert_id();
    } // ***END addItemToTenantList() Method
    
    public function getTenantItemList($tnt_id) {
        $data = array();
        $sql = 'SELECT * FROM Tenant JOIN TenantResponsibleForItem ON Tenant.tnt_id = TenantResponsibleForItem.tnt_id LEFT JOIN AppliancesNeededForUnitRoom ON TenantResponsibleForItem.urua_id = AppliancesNeededForUnitRoom.urua_id LEFT JOIN UnitAppliancesTemplate ON AppliancesNeededForUnitRoom.uappt_id = UnitAppliancesTemplate.uappt_id WHERE Tenant.tnt_id=?';
        $q = $this->db->query($sql, $tnt_id);
        foreach($q->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    } // ***END getTenantItemList() Method
    
    public function getItemsForTypeahead() {
        $data = array();
        $sql = 'SELECT uappt_title FROM UnitAppliancesTemplate';
        $q = $this->db->query($sql);
        foreach($q->result_array() as $row) {
            $data[] = $row['uappt_title'];
        }
        
        return $data;
    } // ***END Method getItemsForTypeahead()
    
    /*****************************************
     * Messaging and Alert Methods
     * - getPrivateMessages()
     * - getGroupMessages()
     * - 
     * ***************************************
     */
    
    public function getPrivateMessages($recipient_tnt_id) {
        $data = array();
        $sql = 'SELECT PrivateMessage.pm_id, PrivateMessage.pm_author_tnt_id, PrivateMessage.pm_recipient_tnt_id, PrivateMessage.pm_message, PrivateMessage.pm_date, PrivateMessage.pm_read, Tenant.tnt_fname, Tenant.tnt_lname, Tenant.tnt_avatar FROM PrivateMessage JOIN Tenant ON PrivateMessage.pm_author_tnt_id = Tenant.tnt_id WHERE PrivateMessage.pm_recipient_tnt_id=? ORDER BY PrivateMessage.pm_date DESC';
        $q = $this->db->query($sql, $recipient_tnt_id);
        if($q->num_rows() > 0) {
            foreach($q->result_array() as $row) {
                $data[] = $row;
            }
            return $data;
        } else {
            return NULL;
        }
    } // ***END getPrivateMessages() Method
    
    public function getPrivateMessageInfo($pm_id, $recipient_tnt_id) {
        $data = array();
        $sql = 'SELECT PrivateMessage.pm_id, PrivateMessage.pm_author_tnt_id, PrivateMessage.pm_recipient_tnt_id, PrivateMessage.pm_message, PrivateMessage.pm_date, PrivateMessage.pm_read, Tenant.tnt_fname, Tenant.tnt_lname, Tenant.tnt_avatar FROM PrivateMessage JOIN Tenant ON PrivateMessage.pm_author_tnt_id = Tenant.tnt_id WHERE PrivateMessage.pm_recipient_tnt_id=? AND PrivateMessage.pm_id=? ORDER BY PrivateMessage.pm_date DESC';
        $q = $this->db->query($sql, array($recipient_tnt_id, $pm_id));
        if($q->num_rows() > 0) {
            foreach($q->result_array() as $row) {
                $data[] = $row;
            }
            return $data;
        } else {
            return NULL;
        }
    } // ***END getPrivateMessageInfo() Method
    
    
    public function getGroupMessages($tun_id) {
        $sql = 'SELECT *, Tenant.tnt_fname, Tenant.tnt_lname FROM GroupMessage JOIN Tenant ON GroupMessage.author_tnt_id = Tenant.tnt_id WHERE GroupMessage.tun_id=?';
        $q = $this->db->query($sql, $tun_id);
    } // ***END getGroupMessages($tun_id) Method
    
    public function insertTenantPersonalityProfile($tnt_id, $packEmail, $packSMS, $packPIN, $profMajor, $profAcademicFocus, $profNeatness, $profActive, $profVisitors, $profTv, $profSmoker, $profLiveWithSmoker, $profPet, $profLiveWithPet, $profFrat) {
        $sql = 'INSERT INTO PersonalityProfile (tnt_id, prof_major, prof_academic_focus, prof_neatness, prof_active, prof_visitors, prof_tv, prof_smoker, prof_live_with_smoker, prof_pet, prof_live_with_pet, prof_frat) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $q = $this->db->query($sql, array($tnt_id, $profMajor, $profAcademicFocus, $profNeatness, $profActive, $profVisitors, $profTv, $profSmoker, $profLiveWithSmoker, $profPet, $profLiveWithPet, $profFrat));
        
        // Insert Pakage settings
        $sql1 = 'INSERT INTO TenantPackageSetting (tnt_id, packset_email, packset_sms, packset_pin) VALUES(?, ?, ?, ?)';
        $qq = $this->db->query($sql1, array($tnt_id, $packEmail, $packSMS, $this->_hash_password($packPIN)));
        
        // Update Tenat tnt_profile_complete='yes'
        $sql2 = 'UPDATE Tenant SET tnt_profile_complete=? WHERE tnt_id=?';
        $qqq = $this->db->query($sql2, array('yes', $tnt_id));
        
        return TRUE;
    } // ***END insertTenantPersonalityProfile() Method
    
    
    
    /*****************************************
     * MISC Methods
     * - processLogin()
     * - _hash_password()
     * ***************************************
     */
    public function processLogin($email, $pass) {
        $pass = $this->_hash_password($pass);
        $sql = 'SELECT Tenant.tnt_id, Tenant.tmt_id, Tenant.tnt_fname, Tenant.tnt_lname, Tenant.tnt_email, Tenant.tnt_avatar, Tenant.tnt_profile_complete, Leasing.tun_id, Leasing.urm_id, TowerUnit.tun_opentok_session FROM Tenant LEFT JOIN Leasing ON Tenant.tnt_id = Leasing.tnt_id LEFT JOIN TowerUnit ON Leasing.tun_id = TowerUnit.tun_id WHERE Tenant.tnt_email=? AND Tenant.tnt_password=?';
        $q = $this->db->query($sql, array($email, $pass));
        if($q->num_rows() == 1) {
            foreach($q->result_array() as $row) {
                $data = array(
                        'tnt_id' => $row['tnt_id'],
                        'tmt_id' => $row['tmt_id'],
                        'tnt_fname' => $row['tnt_fname'],
                        'tnt_lname' => $row['tnt_lname'],
                        'tnt_email' => $row['tnt_email'],
                        'tnt_avatar' => $row['tnt_avatar'], 
                        'tnt_profile_complete' => $row['tnt_profile_complete'],
                        'tun_id' => $row['tun_id'],
                        'tun_opentok_session' => $row['tun_opentok_session'],
                        'urm_id' => $row['urm_id']
                );
            }
            // Generate user token if Tenant is associated with a Unit
            if($data['tun_id'] != NULL) {
                $data['opentok_token'] = $this->_openTokGenerateToken($data['tun_opentok_session']);
            }
            return $data;
        } else {
            return FALSE;
        }
    } // ***END processLogin() Method

    private function _openTokGenerateToken($session) {
        require_once APPPATH . 'libraries/OTok/OpenTokSDK.php'; 
        require_once APPPATH . 'libraries/OTok/OpenTokArchive.php';
        require_once APPPATH . 'libraries/OTok/OpenTokSession.php';
        
        $apiObj = new OpenTokSDK();
        $token = $apiObj->generateToken($session);
        // Giving the token a moderator role, expire time 5 days from now, and connectionData to pass to other users in the session
        $token = $apiObj->generateToken($session, RoleConstants::MODERATOR, time() + (5*24*60*60), "" );
        return $token;
    }
    
    /**
    * @param String Password to be hashed
    * @return String Hashed Password string
    */
    private function _hash_password($pass) {
        $pass = hash('sha256', $pass);
        return $pass;
    } //***END _hash_admin_password() Method
    
}