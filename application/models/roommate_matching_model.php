<?php

class Roommate_matching_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function loadFilteredTenantList($query_params) {
        $data = array();
        $sql = 'SELECT Tenant.tnt_id, Tenant.tnt_fname, Tenant.tnt_lname, Tenant.tnt_phone, Tenant.tnt_email, Tenant.tnt_avatar, Leasing.lease_id, Leasing.tun_id, Leasing.urm_id, UnitRoom.urm_id, UnitRoom.urm_room_number, TowerUnit.tun_number, TenementTower.tow_name, PersonalityProfile.prof_neat, PersonalityProfile.prof_study, PersonalityProfile.prof_smoke, PersonalityProfile.prof_party, PersonalityProfile.prof_chef, PersonalityProfile.prof_gym, PersonalityProfile.prof_sports, PersonalityProfile.prof_movies, PersonalityProfile.prof_tv, PersonalityProfile.prof_greek FROM PersonalityProfile RIGHT JOIN Tenant ON PersonalityProfile.tnt_id = Tenant.tnt_id LEFT JOIN Leasing ON Tenant.tnt_id = Leasing.tnt_id Left JOIN UnitRoom ON Leasing.urm_id = UnitRoom.urm_id LEFT JOIN TowerUnit ON UnitRoom.tun_id = TowerUnit.tun_id LEFT JOIN TenementTower ON TowerUnit.tow_id = TenementTower.tow_id';
        if(!empty($query_params)) {
            $sql .= ' WHERE';
            
            $i = 1;
            foreach($query_params as $row) {
                foreach($row as $k => $v) {
                    if($i == 1) {
                        $sql .= " $k=TRUE";
                    } else {
                        $sql .= " AND $k=TRUE";
                    }
                    $i += 1;
                }
            }
        }
        $q = $this->db->query($sql);
        if($q->num_rows() > 0) {
        foreach($q->result_array() as $row) {
            $data[] = $row;
        }
            return $data;
        } else {
            return FALSE;
        }
    } // ***END loadFilteredTenantList($query_params)
    
    
    
    
}