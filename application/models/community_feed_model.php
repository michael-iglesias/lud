<?php

class Community_feed_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function addEntry($tmt_id, $temp_id, $entry_date, $sTime, $eTime, $entryTitle, $entryDescription) {
        $sql = 'INSERT INTO TenementNews (tmt_id, temp_id, tmtnews_date, tmtnews_stime, tmtnews_etime, tmtnews_title, tmtnews_details) VALUES(?, ?, ?, ?, ?, ?, ?)';
        $q = $this->db->query($sql, array($tmt_id, $temp_id, $entry_date, $sTime, $eTime, $entryTitle, $entryDescription));
        
        if($this->db->insert_id() ) {
            return TRUE;
        }
    } // ***END addEntry() Method
    
    public function getEntry($tmtnews_id, $tmt_id) {
        $sql = 'SELECT * FROM TenementNews WHERE tmtnews_id=? AND tmt_id=?';
        $q = $this->db->query($sql, array($tmtnews_id, $tmt_id));
        
        if($q->num_rows() == 1) {
            foreach($q->result_array() as $row) {
                $data[0] = $row;
            }
            if($data[0]['tmtnews_stime'] != NULL) {
                list($hour, $minute) = split('[:/.-]', $row['tmtnews_stime']);
                $hour = (int) $hour;
                if($hour > 12) {
                    $hour -= 12;
                    $ampm = 'pm';
                } else {
                    $ampm = 'am';
                }
                $data[0]['stime_hour'] = $hour;
                $data[0]['stime_minute'] = (int) $minute;
                $data[0]['stime_ampm'] = $ampm;
            }
            if($data[0]['tmtnews_etime'] != NULL) {
                list($hour, $minute) = split('[:/.-]', $row['tmtnews_etime']);
                if($hour > 12) {
                    $hour -= 12;
                    $ampm = 'pm';
                } else {
                    $ampm = 'am';
                }
                $data[0]['etime_hour'] = (int) $hour;
                $data[0]['etime_minute'] = (int) $minute;
                $data[0]['etime_ampm'] = $ampm;
            }            
        } else {
            $data = FALSE;
        }
        return $data;
    } // ***END getEntry($tmtnews_id, $tmt_id) Method

    public function getEntries($tmt_id) {
        $sql = 'SELECT * FROM TenementNews WHERE tmt_id=? ORDER BY tmtnews_id DESC';
        
        $q = $this->db->query($sql, $tmt_id);
        
        if($q->num_rows() > 0) {
            foreach($q->result_array() as $row) {
                $data[] = $row;
            }
        } else {
            $data = NULL;
        }
        return $data;
    } // ***END getEntries() Method
    
    
    public function getEntries2($tmt_id) {
        $sql = 'SELECT * FROM TenementNews WHERE tmt_id=? AND ( tmtnews_date <= (NOW() + INTERVAL 10 DAY) ) ORDER BY tmtnews_id DESC LIMIT 2';
        
        $q = $this->db->query($sql, $tmt_id);
        
        if($q->num_rows() > 0) {
            foreach($q->result_array() as $row) {
                $data[] = $row;
            }
        } else {
            $data = NULL;
        }
        return $data;
    } // ***END getEntries() Method
    
    public function deleteEntry($tmtnews_id, $tmt_id) {
        $this->db->where('tmtnews_id', $tmtnews_id);
        $this->db->where('tmt_id', $tmt_id);
        $this->db->delete('TenementNews');
    } // ***END deleteEntry($tmtnews_id, $tmt_id) Method
    
    public function updateEntry($tmt_id, $tmtnews_id, $entry_date, $sTime, $eTime, $entryTitle, $entryDescription) {
        $sql = 'UPDATE TenementNews SET tmtnews_date=?, tmtnews_stime=?, tmtnews_etime=?, tmtnews_title=?, tmtnews_details=? WHERE tmt_id=? AND tmtnews_id=?';
        $q = $this->db->query($sql, array($entry_date, $sTime, $eTime, $entryTitle, $entryDescription, $tmt_id, $tmtnews_id));
    } // ***END updateEntry() Method
}