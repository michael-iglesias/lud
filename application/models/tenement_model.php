<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tenement_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getTenementTowers($tmt_id) {
        $sql = 'SELECT * FROM TenementTower WHERE tmt_id=?';
        $q = $this->db->query($sql, $tmt_id);
        if($q->num_rows() > 0) {
            foreach($q->result_array() as $row) {
                $row['units_with_vacancies'] = $this->getTenementTowerUnitVacancies($row['tow_id']);
                $data[] = $row;
            }
            return $data;
        } else {
            return FALSE;
        }
    } // ***END getTenementTowers($tmt_id) Method
    
    public function getTowerInfo($tow_id) {
        $sql = 'SELECT * FROM TenementTower WHERE tow_id=?';
        $q = $this->db->query($sql, $tow_id);
        
        return $q->result_array();
    } // ***END getTowerInfo() Method
    
    public function getTowerUnits($tow_id) {
        $data = array();
        $sql = 'SELECT TowerUnit.tun_id, TowerUnit.tun_number, TowerUnit.tun_capacity, TowerUnit.tun_room_count, TowerUnit.tun_floor, (SELECT COUNT(*) FROM Leasing WHERE tun_id=TowerUnit.tun_id) AS `Occupancies`, (SELECT COUNT(*) FROM MaintenanceTicket WHERE tun_id=TowerUnit.tun_id AND (mticket_status=\'open\' OR mticket_status=\'processing\')) AS `Maintenance_Tickets`, (SELECT COUNT(*) FROM PackageDelivered WHERE tun_id=TowerUnit.tun_id AND (pack_pickedup=\'no\')) AS `Pending_Packages` FROM TowerUnit WHERE tow_id=?;';
        $q = $this->db->query($sql, $tow_id);
        foreach($q->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    } // ***END getTowerUnits() Method
    
    /************************************************************************
     * Unit Methods
     * 1) getUnitInfo()
     * 2) getUnitMaintenanceRequests()
     * 3) getUnitGuestPasses()
     * 4) getTenementTowerUnitVacancies()
     * 5) getUnitTenants()
     ************************************************************************/
    public function getUnitInfo($tun_id) {
        $sql = 'SELECT * FROM TowerUnit JOIN TenementTower ON TowerUnit.tow_id = TenementTower.tow_id WHERE TowerUnit.tun_id=?';
        $q = $this->db->query($sql, $tun_id);
        foreach($q->result_array() as $row) {
            $data[] = $row;
        }
        $both['unit_info'] = $data;
        
        $sql = 'SELECT TowerUnit.tun_id, TowerUnit.tun_number, TowerUnit.tun_capacity, TowerUnit.tun_room_count, TowerUnit.tun_floor, (SELECT COUNT(*) FROM GuestPass WHERE tun_id=TowerUnit.tun_id) AS `Guest_Passes`, (SELECT COUNT(*) FROM Leasing WHERE tun_id=TowerUnit.tun_id) AS `Occupancies`, (SELECT COUNT(*) FROM MaintenanceTicket WHERE tun_id=TowerUnit.tun_id AND (mticket_status=\'open\' OR mticket_status=\'processing\')) AS `Maintenance_Tickets`, (SELECT COUNT(*) FROM PackageDelivered WHERE tun_id=TowerUnit.tun_id AND (pack_pickedup=\'no\')) AS `Pending_Packages` FROM TowerUnit WHERE tun_id=?;';
        $qq = $this->db->query($sql, $tun_id);
        foreach($qq->result_array() as $row) {
            $data2[] = $row;
        }
        $both['unit_details'] = $data2;
        
        return $both;
    } // ***END getUnitInfo($tun_id) Method
    
    public function getUnitMaintenanceRequests($tun_id) {
        $sql = 'SELECT * FROM MaintenanceTicket WHERE tun_id=? AND (mticket_status="open" OR mticket_status="processing")';
        $q = $this->db->query($sql, $tun_id);
        if($q->num_rows() > 0) {
            foreach($q->result_array() as $row) {
                $data[] = $row;
            }
        } else {
            $data = NULL;
        }
        return $data;
    } // ***END getUnitMaintenanceRequests()
    
    public function getUnitGuestPasses($tun_id) {
        $sql = 'SELECT * FROM GuestPass WHERE tun_id=? AND pass_redeemed="no"';
        $q = $this->db->query($sql, $tun_id);
        if($q->num_rows() > 0) {
            foreach($q->result_array() as $row) {
                $data[] = $row;
            }
        } else {
            $data = NULL;
        }
        return $data;
    } // ***END getUnitMaintenanceRequests()
    
    public function getUnitPackages($tun_id) {
        $sql = 'SELECT * FROM PackageDelivered WHERE tun_id=? AND pack_pickedup="no"';
        $q = $this->db->query($sql, $tun_id);
        if($q->num_rows() > 0) {
            foreach($q->result_array() as $row) {
                $data[] = $row;
            }
        } else {
            $data = NULL;
        }
        return $data;
    }
    
    public function getTenementTowerUnitVacancies($tow_id) {
        $sql = 'SELECT tun_id, (TowerUnit.tun_capacity - (SELECT COUNT(*) FROM Leasing WHERE Leasing.tun_id=TowerUnit.tun_id)) AS Units_With_Vacancies FROM TowerUnit WHERE TowerUnit.tow_id=? HAVING Units_With_Vacancies != 0';
        $q = $this->db->query($sql, $tow_id);
        return $q->num_rows();
    } // ***END getTenementTowerUnitVacancies() Method
    
    public function getUnitTenants($tun_id) {
        $data = array();
        $sql = "SELECT Tenant.tnt_id, Tenant.tnt_fname, Tenant.tnt_lname, Tenant.tnt_avatar, Leasing.lease_id, Leasing.urm_id, UnitRoom.urm_id, UnitRoom.urm_room_number, UnitRoom.urm_master FROM Tenant JOIN Leasing ON Tenant.tnt_id = Leasing.tnt_id JOIN UnitRoom ON Leasing.urm_id = UnitRoom.urm_id WHERE Leasing.tun_id=?";
        $q = $this->db->query($sql, $tun_id);
        if($q->num_rows() > 0) {
            foreach($q->result_array() as $row) {
                $data[] = $row;
            }
        } else {
            $data = NULL;
        }
        return $data;
    } // ***END getUnitTenants() Method
    
    public function getCompatibleRoommates($tun_id) {
        $tenants = $this->getUnitTenants($tun_id);
        //return $tenants; exit();
        if($tenants != NULL) {
            foreach($tenants as $t) {
                $sql ='SELECT u2.tnt_id, (SELECT tnt_fname FROM Tenant WHERE tnt_id = u2.tnt_id) AS  `First Name` , (SELECT tnt_lname FROM Tenant WHERE tnt_id = u2.tnt_id) AS  `Last Name` FROM PersonalityProfile u1, PersonalityProfile u2 WHERE u1.tnt_id =? AND u2.tnt_id !=? AND ((SELECT COUNT(*) FROM Leasing WHERE tun_id=? AND tnt_id=u2.tnt_id) <= 0) AND ((u1.prof_study <> u2.prof_study) + ( u1.prof_neat <> u2.prof_neat ) + ( u1.prof_smoke <> u2.prof_smoke ) + ( u1.prof_party <> u2.prof_party ) + ( u1.prof_chef <> u2.prof_chef ) + ( u1.prof_gym <> u2.prof_gym ) + ( u1.prof_sports <> u2.prof_sports ) + ( u1.prof_movies <> u2.prof_movies ) + ( u1.prof_pets <> u2.prof_pets ) + ( u1.prof_tv <> u2.prof_tv ) + ( u1.prof_greek <> u2.prof_greek ) <= 3) AND (u1.prof_smoke = u2.prof_smoke)';
                $q = $this->db->query($sql, array($t['tnt_id'], $t['tnt_id'], $tun_id) );
                if($q->num_rows() > 0) {
                    foreach($q->result_array() as $row) {
                        $data[] = $row;
                    }
                } else {
                    $data = NULL;
                }
            }
            $data = array_map('unserialize', array_unique(array_map('serialize', $data)));
        } else {
            $data = 'no_tenants';
        }
        return $data;
    }
    /**************************************************************************
     * Manage Tenant Methods
     * - getTenants()
     * - deleteTenant()
     * - updateTenant()
     * - addTenant()
     * ***********************************************************************/
    
    public function getTenants($tmt_id) {
        $data = array();
        $sql = "SELECT Tenant.tnt_id, Tenant.tnt_fname, Tenant.tnt_lname, Tenant.tnt_phone, Leasing.lease_id, Leasing.tun_id, Leasing.urm_id, UnitRoom.urm_id, UnitRoom.urm_room_number, TowerUnit.tun_number, TenementTower.tow_name FROM Tenant LEFT JOIN Leasing ON Tenant.tnt_id = Leasing.tnt_id Left JOIN UnitRoom ON Leasing.urm_id = UnitRoom.urm_id LEFT JOIN TowerUnit ON UnitRoom.tun_id = TowerUnit.tun_id LEFT JOIN TenementTower ON TowerUnit.tow_id = TenementTower.tow_id WHERE Tenant.tmt_id=?";
        $q = $this->db->query($sql, $tmt_id);
        
        return $q->result_array();
    } // ***END getTenants() Method
    
    public function getTenantInfo($tnt_id) {
        $data = array();
        $sql = "SELECT Tenant.tnt_id, Tenant.tnt_fname, Tenant.tnt_lname, Tenant.tnt_phone, Tenant.tnt_email, Tenant.tnt_avatar, Leasing.lease_id, Leasing.tun_id, Leasing.urm_id, UnitRoom.urm_id, UnitRoom.urm_room_number, TowerUnit.tun_number, TenementTower.tow_name, NotificationSetting.package_email, NotificationSetting.package_sms FROM NotificationSetting RIGHT JOIN Tenant ON NotificationSetting.tnt_id = Tenant.tnt_id LEFT JOIN Leasing ON Tenant.tnt_id = Leasing.tnt_id Left JOIN UnitRoom ON Leasing.urm_id = UnitRoom.urm_id LEFT JOIN TowerUnit ON UnitRoom.tun_id = TowerUnit.tun_id LEFT JOIN TenementTower ON TowerUnit.tow_id = TenementTower.tow_id WHERE Tenant.tnt_id=?";
        $q = $this->db->query($sql, $tnt_id);
        
        return $q->result_array();
    } // ***END getTenantInfo() Method
    
    public function addTenant($tnt_fname, $tnt_lname, $tnt_email, $tnt_phone) {
        $tnt_password = $this->_hash_password('a');
        $tmt_id = $this->session->userdata('tmt_id');
        $sql = 'INSERT INTO Tenant (tmt_id, tnt_fname, tnt_lname, tnt_email, tnt_phone, tnt_password) VALUES (?, ?, ?, ?, ?, ?)';
        $q = $this->db->query($sql, array($tmt_id, $tnt_fname, $tnt_lname, $tnt_email, $tnt_phone, $tnt_password));
        
        $tnt_id = $this->db->insert_id();
        // Insert user into NotificationSetting with Defaults
        $sql = 'INSERT INTO NotificationSetting (tnt_id) VALUES (?)';
        $this->db->query($sql, $tnt_id);
        
        return $tnt_id;
    } // ***END addTenant($tnt_fname, $tnt_lname, $tnt_email, $tnt_phone, $tnt_position) Method
    
    public function updateTenant($tnt_id, $tnt_fname, $tnt_lname, $tnt_email, $tnt_phone) {
        $sql = 'UPDATE Tenant SET tnt_fname=?, tnt_lname=?, tnt_email=?, tnt_phone=? WHERE tnt_id=?';
        $q = $this->db->query($sql, array($tnt_fname, $tnt_lname, $tnt_email, $tnt_phone, $tnt_id));
    } // ***END updateTenant() Method
    
    public function assignTenantToUnit($tnt_id, $tun_id) {
        $sql = 'SELECT UnitRoom.urm_id FROM UnitRoom Left JOIN Leasing ON UnitRoom.urm_id = Leasing.urm_id WHERE Leasing.urm_id IS NULL AND UnitRoom.tun_id=? ORDER BY RAND() LIMIT 1';
        $q = $this->db->query($sql, $tun_id);
        $r = $q->result_array();
        
        $sql2 = 'UPDATE Leasing SET tun_id=?, urm_id=? WHERE tnt_id=?';
        $qq = $this->db->query($sql, array($tun_id, $r[0]['urm_id'], $tnt_id));

        $sql2 = 'INSERT INTO Leasing (tun_id, tnt_id, urm_id) VALUES (?, ?, ?)';
        $qq = $this->db->query($sql2, array($tun_id, $tnt_id, $r[0]['urm_id']));
    } // ***END assignTenantToUnit($tnt_id, $tun_id) Method
    
    public function deleteTenant($tnt_id) {
        $sql = 'DELETE FROM Tenant WHERE tnt_id=?';
        $q = $this->db->query($sql, $tnt_id);
        if($this->db->affected_rows() == 1) {
            return TRUE;
        }
    } // ***END deleteEmployee($temp_id) Method
    
    /**************************************************************************
     * Employee Methods
     * - getEmployees()
     * - getEmployeeInfo()
     * - associateAvatarToTenementEmployee()
     * - updateEmployee()
     * - addEmployee()
     * - deleteEmployee()
     * ***********************************************************************/
    public function getEmployees() {
        $data = NULL;
        $tmt_id = $this->session->userdata('tmt_id');
        $sql = 'SELECT temp_id, temp_fname, temp_lname, temp_phone, temp_position FROM TenementEmployee WHERE tmt_id=?';
        $q = $this->db->query($sql, $tmt_id);
        foreach($q->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    } // ***END getEmployees() Method
    
    public function getEmployeeInfo($temp_id, $tmt_id) {
        $sql = 'SELECT temp_id, temp_fname, temp_lname, temp_email, temp_phone, temp_position, temp_avatar FROM TenementEmployee WHERE temp_id=? AND tmt_id=?';
        $q = $this->db->query($sql, array($temp_id, $tmt_id));
        
        return $q->result_array();
    } // ***END getEmployeeInfo() Method
    
    public function associateAvatarToTenementEmployee($temp_id, $full_filename) {
        $sql = 'UPDATE TenementEmployee SET temp_avatar=? WHERE temp_id=?';
        $q = $this->db->query($sql, array($full_filename, $temp_id));
        
        return TRUE;
    }
    
    public function updateEmployee($temp_id, $temp_fname, $temp_lname, $temp_email, $temp_phone, $temp_position) {
        $sql = 'UPDATE TenementEmployee SET temp_fname=?, temp_lname=?, temp_email=?, temp_phone=?, temp_position=? WHERE temp_id=?';
        $q = $this->db->query($sql, array($temp_fname, $temp_lname, $temp_email, $temp_phone, $temp_position, $temp_id));
    } // ***END updateEmployee() Method
    
    public function addEmployee($temp_fname, $temp_lname, $temp_email, $temp_phone, $temp_position) {
        $temp_password = $this->_hash_password('a');
        $tmt_id = $this->session->userdata('tmt_id');
        $sql = 'INSERT INTO TenementEmployee (tmt_id, temp_fname, temp_lname, temp_email, temp_phone, temp_position, temp_password) VALUES (?, ?, ?, ?, ?, ?, ?)';
        $q = $this->db->query($sql, array($tmt_id, $temp_fname, $temp_lname, $temp_email, $temp_phone, $temp_position, $temp_password));
        
        return $this->db->insert_id();
    } // ***END addEmployee($temp_fname, $temp_lname, $temp_email, $temp_phone, $temp_position) Method
    
    public function deleteEmployee($temp_id) {
        $sql = 'DELETE FROM TenementEmployee WHERE temp_id=?';
        $q = $this->db->query($sql, $temp_id);
        if($this->db->affected_rows() == 1) {
            return TRUE;
        }
    } // ***END deleteEmployee($temp_id) Method
    
    public function addTenementTower($building_name, $building_floor_count, $building_units_per_floor, $building_default_bed_count) {
        $tmt_id = $this->session->userdata('tmt_id');
        $sql = 'INSERT INTO TenementTower (tmt_id, tow_name, tow_floor_count, tow_units_per_floor) VALUES (?, ?, ?, ?)';
        $q = $this->db->query($sql, array($tmt_id, $building_name, $building_floor_count, $building_units_per_floor));
        if($tow_id = $this->db->insert_id()) {
            $this->_addTowerUnits($tmt_id, $tow_id, $building_name, $building_floor_count, $building_units_per_floor, $building_default_bed_count);
            return $tow_id;
        }
    } // ***END addTenementTower() Method
    
    private function _addTowerUnits($tmt_id, $tow_id, $building_name, $building_floor_count, $building_units_per_floor, $building_default_bed_count) {
        // Check to see if Building Name is Numeric
        if(is_numeric($building_name)) {
            // Building Name is Numeric
            // For loop to iterate through building Floors
            for($i = 1; $i <= $building_floor_count; $i++) {
                // For loop to iterate through Units Per Floor
                for($u = 1; $u <= $building_units_per_floor; $u++) {
                    // Set Unit # & default properties
                    $tun_number = "$building_name" . "$i" . "$u";
                    $tun_capacity = 4; $tun_floor = $i;
                    $otokSession = $this->_openTokGenerateSession();
                    // Generate and Execute Insert Query
                    $sql = 'INSERT INTO TowerUnit (tow_id, tun_number, tun_capacity, tun_room_count, tun_floor, tun_opentok_session) VALUES (?, ?, ?, ?, ?, ?)';
                    $q = $this->db->query($sql, array($tow_id, $tun_number, $building_default_bed_count, $building_default_bed_count, $tun_floor, $otokSession));
                    // Store Recently Created Tower Unit ID
                    $current_unit_id = $this->db->insert_id();
                    // Create Default # of individual rooms inside the recently created Unit
                    for($r = 1; $r <= $building_default_bed_count; $r++) {
                        $sql = 'INSERT INTO UnitRoom (tun_id, urm_room_number, urm_master) VALUES (?, ?, ?)';
                        $q = $this->db->query($sql, array($current_unit_id, $r, 'no'));
                    }
                    
                } // ***END {for} Units Per Floor
            } // ***END {for} Building Floors
            
        } else {
            // Building Name is a STRING
            
        }
    } // ***END _addTowerUnits()
    
    public function processLogin($email, $pass) {
        $pass = $this->_hash_password($pass);
        $sql = 'SELECT * FROM TenementEmployee WHERE temp_email=? AND temp_password=?';
        $q = $this->db->query($sql, array($email, $pass));
        if($q->num_rows() == 1) {
            foreach($q->result_array() as $row) {
                $data = array(
                        'temp_id' => $row['temp_id'],
                        'tmt_id' => $row['tmt_id'],
                        'temp_fname' => $row['temp_fname'],
                        'temp_lname' => $row['temp_lname'],
                        'temp_position' => $row['temp_position'],
                        'temp_avatar' => $row['temp_avatar']
                );
            }
            return $data;
        } else {
            return FALSE;
        }
    } // ***END processLogin() Method
    
    /**************************************************************************
     * Package Logging Methods
     * - getTenantListForPackages()
     * - logPackage($data)
     * - markPackageDelivered()
     * - getPendingPackages()
     * ***********************************************************************/
    public function getTenantListForPackages($search) {
        $sql = "SELECT Tenant.tnt_id, Tenant.tnt_fname, Tenant.tnt_lname, Tenant.tnt_phone, Tenant.tnt_email, Tenant.tnt_avatar, Leasing.lease_id, Leasing.tun_id, Leasing.urm_id, UnitRoom.urm_id, UnitRoom.urm_room_number, TowerUnit.tun_number, TenementTower.tow_name FROM Tenant LEFT JOIN Leasing ON Tenant.tnt_id = Leasing.tnt_id Left JOIN UnitRoom ON Leasing.urm_id = UnitRoom.urm_id LEFT JOIN TowerUnit ON UnitRoom.tun_id = TowerUnit.tun_id LEFT JOIN TenementTower ON TowerUnit.tow_id = TenementTower.tow_id WHERE Tenant.tnt_fname LIKE '%$search%' OR Tenant.tnt_lname LIKE '%$search%' OR TowerUnit.tun_number LIKE '%$search%'";
        
        return $this->db->query($sql);
    } // ***END getTenantListForPackages() Method
    
    public function logPackage($data) {
        $result = $this->getTenantInfo($data['tnt_id']);
        
        $sql = 'INSERT INTO PackageDelivered (tnt_id, tun_id, pack_date_delivered, pack_delivery_service, pack_item, pack_tracking_number, pack_notes, pack_special_verification) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
        $this->db->query($sql, array($result[0]['tnt_id'], $result[0]['tun_id'], date("Y-m-d H:i:s"), $data['service'], $data['item'], $data['tracking_number'], $data['notes'], $data['verification']));
        
        return $result;
    } // ***END logPackage($data) Method
    
    public function markPackageDelivered($pack_id) {
        $sql = "UPDATE PackageDelivered SET pack_pickedup='yes', pack_date_pickedup=? WHERE pack_id=?";
        $this->db->query( $sql, array( date("Y-m-d H:i:s"), $pack_id ) );
        if($this->db->affected_rows() == 1) {
            return TRUE;
        }
    } // ***END markPackageDelivered() Method
    
    public function getPendingPackages() {
        $sql = "SELECT PackageDelivered.pack_id, PackageDelivered.pack_date_delivered, PackageDelivered.pack_pickedup, PackageDelivered.pack_delivery_service, PackageDelivered.pack_item, PackageDelivered.pack_tracking_number, PackageDelivered.pack_notes, PackageDelivered.pack_special_verification, Tenant.tnt_id, Tenant.tnt_fname, Tenant.tnt_lname, Leasing.lease_id, Leasing.tun_id, Leasing.urm_id, UnitRoom.urm_id, UnitRoom.urm_room_number, TowerUnit.tun_number, TenementTower.tow_name FROM PackageDelivered LEFT JOIN Tenant ON PackageDelivered.tnt_id = Tenant.tnt_id LEFT JOIN Leasing ON Tenant.tnt_id = Leasing.tnt_id Left JOIN UnitRoom ON Leasing.urm_id = UnitRoom.urm_id LEFT JOIN TowerUnit ON UnitRoom.tun_id = TowerUnit.tun_id LEFT JOIN TenementTower ON TowerUnit.tow_id = TenementTower.tow_id WHERE PackageDelivered.pack_pickedup='no'";
        $q = $this->db->query($sql);
        
        return $q->result_array();
    } // ***END getPendingPackages() Method
    
    
    /**************************************************************************
     * Notification Center
     * - createNotification()
     * - logPackage($data)
     * ***********************************************************************/
    public function createNotification($data) {
        
        if($data['ncron_target'] == 'resident') {
            $sql = 'INSERT INTO NotificationCron (ncron_notification_type, ncron_method, ncron_target, tnt_id, ncron_subject, ncron_body) VALUES (?, ?, ?, ?, ?, ?)';
        } elseif($data['ncron_target'] == 'unit') {
            $sql = 'INSERT INTO NotificationCron (ncron_notification_type, ncron_method, ncron_target, tun_id, ncron_subject, ncron_body) VALUES (?, ?, ?, ?, ?, ?)';
        } elseif($data['ncron_target'] == 'building') {
            $sql = 'INSERT INTO NotificationCron (ncron_notification_type, ncron_method, ncron_target, tow_id, ncron_subject, ncron_body) VALUES (?, ?, ?, ?, ?, ?)';
        } elseif($data['ncron_target'] == 'community') {
            $sql = 'INSERT INTO NotificationCron (ncron_notification_type, ncron_method, ncron_target, tnt_id, ncron_subject, ncron_body) VALUES (?, ?, ?, ?, ?, ?)';
            $data['audience_id'] = NULL;
        }
        $this->db->query($sql, array($data['ncron_notification_type'], $data['ncron_method'], $data['ncron_target'], $data['audience_id'], $data['ncron_subject'], $data['ncron_body']));
        return $this->db->insert_id();
    } // ***END createNotification() Method
    
    /*****************************************
     * MISC Methods
     * ***************************************
     */
    /**
    * @param String Password to be hashed
    * @return String Hashed Password string
    */
    private function _hash_password($pass) {
        $pass = hash('sha256', $pass);
        return $pass;
    } //***END _hash_admin_password() Method
    
    function _openTokGenerateSession() {
        require_once APPPATH . 'libraries/OTok/OpenTokSDK.php'; 
        require_once APPPATH . 'libraries/OTok/OpenTokArchive.php';
        require_once APPPATH . 'libraries/OTok/OpenTokSession.php';
        
        $apiObj = new OpenTokSDK();
        $session = $apiObj->createSession( $_SERVER["REMOTE_ADDR"] );
        
        return $session->sessionId;
    } // ***END openTok() Method
    
    
}