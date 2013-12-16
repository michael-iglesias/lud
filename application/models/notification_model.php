<?php

class Notification_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getPendingNotifications() {
        $sql = 'SELECT * FROM NotificationCron WHERE ncron_status="pending"';
        
        $q = $this->db->query($sql);
        return $q->result_array();
    } // ***END getAllNotifications() Method
    
    
    public function getTenantNotificationInfo($tnt_id) {
        $sql = 'SELECT * FROM Tenant LEFT JOIN NotificationSetting ON Tenant.tnt_id = NotificationSetting.tnt_id WHERE Tenant.tnt_id=?';
        $q = $this->db->query($sql, $tnt_id);
        
        return $q->result_array();
    }
    
    public function getTenantList() {
        $sql = 'SELECT * FROM Tenant LEFT JOIN NotificationSetting ON Tenant.tnt_id = NotificationSetting.tnt_id';
        $q = $this->db->query($sql);
        
        return $q->result_array();
    } // ***END getTenantList() Method
    
    public function getUnitTenants($tun_id) {
        $sql = 'SELECT Tenant.tnt_id, Tenant.tnt_fname, Tenant.tnt_lname, Tenant.tnt_phone, Tenant.tnt_email, Leasing.lease_id, Leasing.tun_id, Leasing.urm_id, UnitRoom.urm_id, UnitRoom.urm_room_number, TowerUnit.tun_number, TenementTower.tow_name, TenementTower.tow_id, NotificationSetting.general_email, NotificationSetting.general_sms, NotificationSetting.package_email, NotificationSetting.package_sms FROM NotificationSetting RIGHT JOIN Tenant ON NotificationSetting.tnt_id = Tenant.tnt_id LEFT JOIN Leasing ON Tenant.tnt_id = Leasing.tnt_id Left JOIN UnitRoom ON Leasing.urm_id = UnitRoom.urm_id LEFT JOIN TowerUnit ON UnitRoom.tun_id = TowerUnit.tun_id LEFT JOIN TenementTower ON TowerUnit.tow_id = TenementTower.tow_id WHERE TowerUnit.tun_id=?';
        $q = $this->db->query($sql, $tun_id);
        
        return $q->result_array();
    } // ***END getUnitTenants() Method
    
    public function getBuildingTenants($tow_id) {
        $sql = 'SELECT Tenant.tnt_id, Tenant.tnt_fname, Tenant.tnt_lname, Tenant.tnt_phone, Tenant.tnt_email, Leasing.lease_id, Leasing.tun_id, Leasing.urm_id, UnitRoom.urm_id, UnitRoom.urm_room_number, TowerUnit.tun_number, TenementTower.tow_name, TenementTower.tow_id, NotificationSetting.general_email, NotificationSetting.general_sms, NotificationSetting.package_email, NotificationSetting.package_sms FROM NotificationSetting RIGHT JOIN Tenant ON NotificationSetting.tnt_id = Tenant.tnt_id LEFT JOIN Leasing ON Tenant.tnt_id = Leasing.tnt_id Left JOIN UnitRoom ON Leasing.urm_id = UnitRoom.urm_id LEFT JOIN TowerUnit ON UnitRoom.tun_id = TowerUnit.tun_id LEFT JOIN TenementTower ON TowerUnit.tow_id = TenementTower.tow_id WHERE TenementTower.tow_id=?';
        $q = $this->db->query($sql, $tow_id);
        
        return $q->result_array();
    } // ***END getBuildingTenants() Method
    
    public function updateNotificationDelivered($ncron_id) {
        $sql = "UPDATE NotificationCron SET ncron_status='delivered' WHERE ncron_id=?";
        $this->db->query($sql, $ncron_id);
    } // ***END updateNotificationDelivered($notification_row['ncron_id']) Method
    
    
}