<?php

$db = new mysqli("localhost", "root", "root", "LH");
if ($db->connect_errno) {
    echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
}
        //$tnt_id = $this->dbc->real_escape_string($tnt_id);
        
        $query = "SELECT * FROM PackageDelivered WHERE pack_pickedup='no' AND tnt_id=1";

        if ($result = $db->query($query)) {
            while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $rows[] = $row;
            }
            $data['status'] = 'success';
            $data['response']['pending_package_pickups'] = $result->num_rows;
            $data['response'] = $rows;
        }        
        var_dump(json_encode($data));

