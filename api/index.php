<?php
/**
 * Step 1: Require the Slim Framework
 *
 * If you are not using Composer, you need to require the
 * Slim Framework and register its PSR-0 autoloader.
 *
 * If you are using Composer, you can skip this step.
 */
require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();

/**
 * Step 2: Instantiate a Slim application
 *
 * This example instantiates a Slim application using
 * its default settings. However, you will usually configure
 * your Slim application now by passing an associative array
 * of setting names and values into the application constructor.
 */
$app = new \Slim\Slim();

/**
 * PACKAGE ROUTES
 *
 * 1. /packages/:id
 * 2. /packages/history/:id
 */

// GET: /packages -> Get Packages for particular tenant
$app->get('/packages/:id', function ($id) {
    $sql = "SELECT * FROM PackageDelivered WHERE pack_pickedup='no' AND tnt_id=$id";
    try {
        $db = getConnection();
        $q = $db->query($sql);
        if($q->num_rows > 0) {
            while($row = $q->fetch_array(MYSQLI_ASSOC)) {
                $rows[] = $row;
            }
            // Format Response
            $data['status'] = 'success';
            $data['pending_package_pickups'] = $q->num_rows;
            $data['data'] = $rows;

        } else {
            // Format Response
            $data['status'] = 'success';
            $data['pending_package_pickups'] = $q->num_rows;
            $data['data'] = NULL;
        }
        // Free result and close connection
        $q->free();
        $db->close();

        echo json_encode($data);
    } catch (PDOException $e) {
        echo '{"error"}' . $e->getMessage();
    }
}); // ***END  GET: /packages/:id -> Get all pending packages for particular tenant

// GET: /packages/history -> Get package pickup history limit 5
$app->get('/packages/history/:id', function ($id) {
    $sql = "SELECT * FROM PackageDelivered WHERE pack_pickedup='yes' AND tnt_id=$id ORDER BY pack_date_pickedup LIMIT 5";
    try {
        $db = getConnection();
        $q = $db->query($sql);
        if($q->num_rows > 0) {
            while($row = $q->fetch_array(MYSQLI_ASSOC)) {
                    $rows[] = $row;
            }
            // Format Response
            $data['status'] = 'success';
            $data['package_history'] = $q->num_rows;
            $data['data'] = $rows;
        } else {
            $data['status'] = 'success';
            $data['package_history'] = $q->num_rows;
            $data['data'] = NULL;
        }
        // Free result and close connection
        $q->free();
        $db->close();

        echo json_encode($data);
    } catch (PDOException $e) {
        echo '{"error"}' . $e->getMessage();
    }
}); // ***END  GET: /packages/history/:id -> Get package history limit 5

/**
 * MAINTENANCE ROUTES
 *
 * 1. /maintenance -> POST
 * 2. /maintenance/:id -> GET
 * 3. /maintenance/history/:id
 */

$app->post('/maintenance', function() {
    $request = \Slim\Slim::getInstance()->request();
    $body = $request->getBody();
    $ticket = json_decode($body);
    
    $db = getConnection();
    $tnt_id = $db->real_escape_string($ticket->tnt_id);
    $title = $db->real_escape_string($ticket->title);
    $description = $db->real_escape_string($ticket->description);
    $today = date("Y-m-d H:i:s");
    $status = 'open';
    
    $sql = "SELECT tun_id FROM Leasing WHERE tnt_id=$tnt_id";
    $q = $db->query($sql);
    if($q->num_rows > 0) {
        while($row = $q->fetch_array(MYSQLI_ASSOC)) {
            $tun_id = $row['tun_id'];
        }
        $sql = "INSERT INTO MaintenanceTicket (tnt_id, tun_id, mticket_status, mticket_title, mticket_description, mticket_open_date) VALUES (?, ?, ?, ?, ?, ?)";
        try {
            $stmt = $db->prepare($sql);
            $stmt->bind_param('iissss', $tnt_id, $tun_id, $status, $title, $description, $today);
            $stmt->execute();
            $db->close();
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
        // Format Response
        $data['status'] = 'success';
    } else {
        // Format Response
        $data['status'] = 'failure';
    }
    
    echo json_encode($data);
});

// GET - /maintenance/:id
$app->get('/maintenance/:id', function($id) {
    $sql = "SELECT * FROM MaintenanceTicket WHERE (mticket_status='open' OR mticket_status='processing') AND tnt_id=$id";
    try {
        $db = getConnection();
        $q = $db->query($sql);
        if($q->num_rows > 0) {
            while($row = $q->fetch_array(MYSQLI_ASSOC)) {
                $rows[] = $row;
            }
            // Format Response
            $data['status'] = 'success';
            $data['maintenance_requests'] = $q->num_rows;
            $data['data'] = $rows;

        } else {
            // Format Response
            $data['status'] = 'success';
            $data['maintenance_requests'] = $q->num_rows;
            $data['data'] = NULL;
        }
        // Free result and close connection
        $q->free();
        $db->close();

        echo json_encode($data);
    } catch (PDOException $e) {
        echo '{"error"}' . $e->getMessage();
    }
});

// GET - /maintenance/history/:id
$app->get('/maintenance/history/:id', function($id) {
    $sql = "SELECT * FROM MaintenanceTicket WHERE mticket_status='closed' AND tnt_id=$id ORDER BY mticket_closed_date DESC LIMIT 7";
    try {
        $db = getConnection();
        $q = $db->query($sql);
        if($q->num_rows > 0) {
            while($row = $q->fetch_array(MYSQLI_ASSOC)) {
                $rows[] = $row;
            }
            // Format Response
            $data['status'] = 'success';
            $data['maintenance_requests'] = $q->num_rows;
            $data['data'] = $rows;

        } else {
            // Format Response
            $data['status'] = 'success';
            $data['maintenance_requests'] = $q->num_rows;
            $data['data'] = NULL;
        }
        // Free result and close connection
        $q->free();
        $db->close();

        echo json_encode($data);
    } catch (PDOException $e) {
        echo '{"error"}' . $e->getMessage();
    }
}); // ***END GET /maintenance/history/:id

/**
 * Neighbor Notifications ROUTES
 * 1. POST -> /guest_passes
 * 2. GET -> /guest_passes/:id
 * 3. GET -> /guest_passes/:tntid/:passid
 * 4. DELETE -> /guest_passes/:tntid/:passid
 */
// POST: guest_passes - Create Guest Pass
$app->post('/guest_passes', function() {
    $request = \Slim\Slim::getInstance()->request();
    $body = $request->getBody();
    $notification = json_decode($body);
    
    $db = getConnection();
    $tnt_id = $db->real_escape_string($notification->tnt_id);
    $type = $db->real_escape_string($notification->type);
    if($type == 'guestpass') {
        $fname = $db->real_escape_string($notification->fname);
        $lname = $db->real_escape_string($notification->lname);
    } else {
        $fname = NULL;
        $lname = NULL;
    }
    $today = date("Y-m-d H:i:s");
    
    $sql = "SELECT tun_id FROM Leasing WHERE tnt_id=$tnt_id";
    $q = $db->query($sql);
    if($q->num_rows > 0) {
        while($row = $q->fetch_array(MYSQLI_ASSOC)) {
            $tun_id = $row['tun_id'];
        }
        $sql = "INSERT INTO GuestPass (tnt_id, tun_id, pass_type, pass_fname, pass_lname, pass_date) VALUES (?, ?, ?, ?, ?, ?)";
        try {
            $stmt = $db->prepare($sql);
            $stmt->bind_param('iissss', $tnt_id, $tun_id, $type, $fname, $lname, $today);
            $stmt->execute();
            $db->close();
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
        // Format Response
        $data['status'] = 'success';
    } else {
        // Format Response
        $data['status'] = 'failure';
    }
    
    echo json_encode($data);
}); // ***END POST - neighbor_notification

// GET - neighbor_notification - Get Neigbor Notifications for tenants unit
$app->get('/guest_passes/:id', function($id) {
    $db = getConnection();
    $tnt_id = $db->real_escape_string($id);
    
    $sql = "SELECT tun_id FROM Leasing WHERE tnt_id=$tnt_id";
    $q = $db->query($sql);
    if($q->num_rows > 0) {
        while($row = $q->fetch_array(MYSQLI_ASSOC)) {
            $tun_id = $row['tun_id'];
        }
    
        $sql = "SELECT * FROM GuestPass WHERE tun_id=$tun_id";
        try {
            $i = 0; $rows = NULL;
            $db = getConnection();
            $q = $db->query($sql);
            if($q->num_rows > 0) {
                while($row = $q->fetch_array(MYSQLI_ASSOC)) {
                    $current_date = date("m-d-Y");
                    $date = date( "m-d-Y", strtotime($row['pass_date']) );
                    if($current_date == $date) {
                        $label = '';
                        if($row['pass_type'] == 'guestpass') {
                            $label = 'Guest: ' . ucfirst($row['pass_fname']) . ' - ' . $date;
                        } else if($row['pass_type'] == 'food') {
                            $label = 'Food Delivery: ' . $date;
                        }
                        $rows[$i] = $row;
                        $rows[$i]['label_title'] = $label;
                        $i += 1;
                    }                    
                }
                // Format Response
                $data['status'] = 'success';
                $data['guest_passes'] = $i;
                $data['data'] = $rows;

            } else {
                // Format Response
                $data['status'] = 'success';
                $data['guest_passes'] = $q->num_rows;
                $data['data'] = NULL;
            }
            // Free result and close connection
            $q->free();
            $db->close();
        } catch (PDOException $e) {
            echo '{"error"}' . $e->getMessage();
        }
    } else {
        // Format Response
        $data['status'] = 'failure';
    }
    echo json_encode($data);
});

// GET - guest_passes/info/:id - Get Guest Pass Info based on given pass_id
$app->get('/guest_passes/info/:tntid/:passid', function($tnt_id, $pass_id) {
    $db = getConnection();
    $tnt_id = $db->real_escape_string($tnt_id);
    $pass_id = $db->real_escape_string($pass_id);
    
    $sql = "SELECT tun_id FROM Leasing WHERE tnt_id=$tnt_id";
    $q = $db->query($sql);
    if($q->num_rows > 0) {
        while($row = $q->fetch_array(MYSQLI_ASSOC)) {
            $tun_id = $row['tun_id'];
        }
    
        $sql = "SELECT Tenant.tnt_fname, Tenant.tnt_lname, GuestPass.pass_id, GuestPass.pass_type, GuestPass.pass_fname, GuestPass.pass_lname, GuestPass.pass_date FROM GuestPass JOIN Tenant ON GuestPass.tnt_id = Tenant.tnt_id WHERE tun_id=$tun_id AND pass_id=$pass_id";
        try {
            $i = 0; $rows = NULL;
            $db = getConnection();
            $q = $db->query($sql);
            if($q->num_rows == 1) {
                while($row = $q->fetch_array(MYSQLI_ASSOC)) {
                    $current_date = date("m-d-Y");
                    $date = date( "m-d-Y", strtotime($row['pass_date']) );
                    if($current_date == $date) {
                        $label = '';
                        if($row['pass_type'] == 'guestpass') {
                            $label = 'Guest: ' . ucfirst($row['pass_fname']) . ' - ' . $date;
                        } else if($row['pass_type'] == 'food') {
                            $label = 'Food Delivery: ' . $date;
                        }
                        $rows[$i] = $row;     
                        $rows[$i]['pass_date'] = $date;
                        $rows[$i]['created_by'] = ucfirst($row['tnt_fname']) . ' ' . ucfirst( substr($row['tnt_lname'], 0, 1) );
                        $rows[$i]['label_title'] = $label;
                    }                    
                }
                // Format Response
                $data['status'] = 'success';
                $data['guest_passes'] = 1;
                $data['data'] = $rows;

            } else {
                // Format Response
                $data['status'] = 'success';
                $data['guest_passes'] = 0;
                $data['data'] = NULL;
            }
            // Free result and close connection
            $q->free();
            $db->close();
        } catch (PDOException $e) {
            echo '{"error"}' . $e->getMessage();
        }
    } else {
        // Format Response
        $data['status'] = 'failure';
    }
    echo json_encode($data);
});

// DELETE: /guest_passes/:tntid/:passid -> DELETE a Concact
$app->delete('/guest_passes/:tntid/:passid', function($tnt_id, $pass_id) {
    $db = getConnection();
    $tnt_id = $db->real_escape_string($tnt_id);
    $pass_id = $db->real_escape_string($pass_id);
    
    $sql = "SELECT tun_id FROM Leasing WHERE tnt_id=$tnt_id";
    $q = $db->query($sql);
    if($q->num_rows > 0) {
        while($row = $q->fetch_array(MYSQLI_ASSOC)) {
            $tun_id = $row['tun_id'];
        }
        $sql = 'DELETE FROM GuestPass WHERE pass_id=? AND tun_id=?';
        try {
            $stmt = $db->prepare($sql);
            $stmt->bind_param('ii', $pass_id, $tun_id);
            $stmt->execute();
            $db->close();
            $data['status'] = 'success';

        } catch(Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    } else {
        $data['status'] = 'failure';
    }
    echo json_encode($data);
});



/**
 * My Profile ROUTES
 * 1. UPDATE -> /my_profile/:id
 * 2. GET -> /my_profile/:id
 * 3. GET -> /my_profile/notification_settings/:id
 */
// UPDATE: /my_profile/:id - Update Profile Info
$app->put('/my_profile', function() {
    $request = \Slim\Slim::getInstance()->request();
    $body = $request->getBody();
    $profile = json_decode($body);
    
    $db = getConnection();
    $tnt_id = $db->real_escape_string($profile->tnt_id);
    $phone = $db->real_escape_string($profile->phone_number);
    $email = $db->real_escape_string($profile->email_address);
    
    $sql = 'UPDATE Tenant SET tnt_email=?, tnt_phone=? WHERE tnt_id=?';
    try {
        $stmt = $db->prepare($sql);
        $stmt->bind_param('ssi', $email, $phone, $tnt_id);
        $stmt->execute();
        $db->close();
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
    $data['status'] = 'success';
    
    echo json_encode($data);
});


// GET: /my_profile/:id - Get Profile Info
$app->get('/my_profile/:id', function($id) {
    $db = getConnection();
    $tnt_id = $db->real_escape_string($id);
    
    $sql = "SELECT Tenant.tnt_id, Tenant.tnt_fname, Tenant.tnt_lname, Tenant.tnt_phone, Tenant.tnt_email, Tenant.tnt_avatar, Leasing.lease_id, Leasing.tun_id, Leasing.urm_id, UnitRoom.urm_id, UnitRoom.urm_room_number, TowerUnit.tun_number, TenementTower.tow_name FROM Tenant LEFT JOIN Leasing ON Tenant.tnt_id = Leasing.tnt_id Left JOIN UnitRoom ON Leasing.urm_id = UnitRoom.urm_id LEFT JOIN TowerUnit ON UnitRoom.tun_id = TowerUnit.tun_id LEFT JOIN TenementTower ON TowerUnit.tow_id = TenementTower.tow_id WHERE Tenant.tnt_id=$tnt_id";
    $q = $db->query($sql);
    if($q->num_rows == 1) {
        while($row = $q->fetch_array(MYSQLI_ASSOC)) {
            $rows[] = $row;
        }
        $data['status'] = 'success';
        $data['profile'] = $q->num_rows;
        $data['data'] = $rows;
    } else {
        $data['status'] = 'failure';
        $data['profile'] = $q->num_rows;
        $data['data'] = NULL;
    }
    echo json_encode($data);
});

$app->get('/my_profile/notification_settings/:id', function($id) {
    $db = getConnection();
    $tnt_id = $db->real_escape_string($id);
    
    $sql = "SELECT Tenant.tnt_id, NotificationSetting.package_email, NotificationSetting.package_sms, NotificationSetting.general_email, NotificationSetting.general_sms, NotificationSetting.maint_email, NotificationSetting.maint_sms FROM Tenant LEFT JOIN NotificationSetting ON Tenant.tnt_id = NotificationSetting.tnt_id WHERE Tenant.tnt_id=$tnt_id";
    $q = $db->query($sql);
    if($q->num_rows == 1) {
        while($row = $q->fetch_array(MYSQLI_ASSOC)) {
            $rows[] = $row;
        }
        $data['status'] = 'success';
        $data['profile'] = $q->num_rows;
        $data['data'] = $rows;
    } else {
        $data['status'] = 'failure';
        $data['profile'] = $q->num_rows;
        $data['data'] = NULL;
    }
    echo json_encode($data);
}); // ***END GET - /my_profile/notification_settings/:id

// PUT: /my_profile/:id - Update Profile Info
$app->put('/my_profile/notification_settings', function() {
    $request = \Slim\Slim::getInstance()->request();
    $body = $request->getBody();
    $profile = json_decode($body);
    
    $db = getConnection();
    $tnt_id = $db->real_escape_string($profile->tnt_id);
    $package_email = $db->real_escape_string($profile->package_email);
    $package_sms = $db->real_escape_string($profile->package_sms);
    $general_email = $db->real_escape_string($profile->general_email);
    $general_sms = $db->real_escape_string($profile->general_sms);
    $maint_email = $db->real_escape_string($profile->maint_email);
    $maint_sms = $db->real_escape_string($profile->maint_sms);
    
    $sql = 'UPDATE NotificationSetting SET package_email=?, package_sms=?, general_email=?, general_sms=?, maint_email=?, maint_sms=? WHERE tnt_id=?';
    try {
        $stmt = $db->prepare($sql);
        $stmt->bind_param('ssssssi', $package_email, $package_sms, $general_email, $general_sms, $maint_email, $maint_sms, $tnt_id);
        $stmt->execute();
        $db->close();
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
    $data['status'] = 'success';
    
    echo json_encode($data);
}); // ***END PUT - /my_profile/notification_settings


// PUT - /personality_questionnaire - Process Personality Questionnaire
$app->put('/personality_questionnaire', function() {
    $request = \Slim\Slim::getInstance()->request();
    $body = $request->getBody();
    $profile = json_decode($body);
    $db = getConnection();
    
    $tnt_id = $db->real_escape_string($profile->tnt_id);
    $study = $db->real_escape_string($profile->study);
    $neat = $db->real_escape_string($profile->neat);
    $smoke = $db->real_escape_string($profile->smoke);
    $party = $db->real_escape_string($profile->party);
    $chef = $db->real_escape_string($profile->chef);
    $gym = $db->real_escape_string($profile->gym);
    $sports = $db->real_escape_string($profile->sports);
    $movies = $db->real_escape_string($profile->movies);
    $pets = $db->real_escape_string($profile->pets);
    $tv = $db->real_escape_string($profile->tv);
    $greek = $db->real_escape_string($profile->greek);
    
    if($study == 'yes') { $study = TRUE; } else { $study = FALSE; }
    if($neat == 'yes') { $neat = TRUE; } else { $neat = FALSE; }
    if($smoke == 'yes') { $smoke = TRUE; } else { $smoke = FALSE; }
    if($party == 'yes') { $party = TRUE; } else { $party = FALSE; }
    if($chef == 'yes') { $chef = TRUE; } else { $chef = FALSE; }
    if($gym == 'yes') { $gym = TRUE; } else { $gym = FALSE; }
    if($sports == 'yes') { $sports = TRUE; } else { $sports = FALSE; }
    if($movies == 'yes') { $movies = TRUE; } else { $movies = FALSE; }
    if($pets == 'yes') { $pets = TRUE; } else { $pets = FALSE; }
    if($tv == 'yes') { $tv = TRUE; } else { $tv = FALSE; }
    if($greek == 'yes') { $greek = TRUE; } else { $greek = FALSE; }
    
    $sql = 'UPDATE PersonalityProfile SET prof_study=?, prof_neat=?, prof_smoke=?, prof_party=?, prof_chef=?, prof_gym=?, prof_sports=?, prof_movies=?, prof_pets=?, prof_tv=?, prof_greek=? WHERE tnt_id=?';
    try {
        $stmt = $db->prepare($sql);
        $stmt->bind_param('dddddddddddi', $study, $neat, $smoke, $party, $chef, $gym, $sports, $movies, $pets, $tv, $greek, $tnt_id);
        $stmt->execute();
        $db->close();
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
    $data['status'] = 'success';
    
    echo json_encode($data);
});


/**
 * Shopping Cart ROUTES
 * 1. /cart/add -> Add Product To Cart
 */
// POST: /cart/add
$app->post('/cart/add', function() {
    $request = \Slim\Slim::getInstance()->request();
    $body = $request->getBody();
    $prod = json_decode($body);
    $db = getConnection();
    
    $tnt_id = $db->real_escape_string($prod->tntID);
    $tun_id = $db->real_escape_string($prod->tunID);
    $prod_id = $db->real_escape_string($prod->prodID);
    $prod_name = $db->real_escape_string($prod->name);
    $prod_sku = $db->real_escape_string($prod->sku);
    $prod_price = $db->real_escape_string($prod->price);
    $prod_cart = $db->real_escape_string($prod->cart); 
    $prod_pro = 'no'; 
    /*$tnt_id = 1;
    $tun_id = 1;
    $prod_id = 620;
    $prod_name = 'asdflkj';
    $prod_sku = 'MB55';
    $prod_cart = 'personal';
    $prod_price = 123.5000; */
    
    
    
    if($prod_cart == 'personal') {
        $tun_id = NULL;
    } else {
        $sql = "SELECT tun_id FROM Leasing WHERE tnt_id=$tnt_id";
        $q = $db->query($sql);
        if($q->num_rows > 0) {
            while($row = $q->fetch_array(MYSQLI_ASSOC)) {
                $tun_id = $row['tun_id'];
            }
        } else {
            $tun_id = NULL;
        }
    }
    $sql = "INSERT INTO ShoppingCart (tnt_id, tun_id, prod_id, prod_name, prod_sku, prod_price, prod_cart, order_processed) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $db->prepare($sql);
    $stmt->bind_param('iiissdss', $tnt_id, $tun_id, $prod_id, $prod_name, $prod_sku, $prod_price, $prod_cart, $prod_pro);
    $stmt->execute();
    $db->close();
    // Format Response
    $data['status'] = 'success';

    echo json_encode($data);
});

// POST ->' /cart
$app->post('/cart', function() {
    $request = \Slim\Slim::getInstance()->request();
    $body = $request->getBody();
    $cart = json_decode($body);
    $db = getConnection();
    
      $id = (int) $db->real_escape_string($cart->id);
      $type = $db->real_escape_string($cart->type);

    if($type == 'personal') {
        $sql = "SELECT * FROM ShoppingCart WHERE tnt_id=$id AND prod_cart='personal' AND order_processed='no'";
    } else {
        $sql = "SELECT * FROM ShoppingCart WHERE tun_id=$id AND prod_cart='group' AND order_processed='no'";
    }
    
    $q = $db->query($sql);
    if($q->num_rows > 0) {
        while($row = $q->fetch_array(MYSQLI_ASSOC)) {
                $rows[] = $row;
        }
        
        foreach($rows as $r) {
            $itm = array(
                'scart_id' => $r['scart_id'],
                'tnt_id' => $r['tnt_id'],
                'tun_id' => $r['tun_id'],
                'prod_id' => $r['prod_id'],
                'prod_name' => $r['prod_name'],
                'prod_price' => money_format('%i', $r['prod_price']),
                'prod_sku' => $r['prod_sku'],
                'prod_cart' => $r['prod_cart'],
                'order_processed' => $r['order_processed']
            );
            $processed_rows[] = $itm;
        }
        // Format Response
        $data['status'] = 'success';
        $data['cart_items'] = $q->num_rows;
        $data['data'] = $processed_rows;
    } else {
        $data['status'] = 'success';
        $data['cart_items'] = $q->num_rows;
        $data['data'] = NULL;
    }
    // Free result and close connection
    $q->free();
    $db->close();

    echo json_encode($data);
    
}); // ***END /cart

/**
 * UNIT MESSAGING ROUTES
 * 1. POST -> /roommate_chat
 * 2. GET -> /roommate_chat/:tntID/:tunID
 */

// POST -> /roommate_chat -> Create roommate message
$app->post('/roommate_chat', function() {
    $request = \Slim\Slim::getInstance()->request();
    $body = $request->getBody();
    $message = json_decode($body);
    
    try {
        $db = getConnection();
        
        $tnt_id = $db->real_escape_string($message->tntID);
        $tun_id = $db->real_escape_string($message->tunID);
        $text = $db->real_escape_string($message->messageBody);
        $time_sent = date("Y-m-d H:i:s");
        
        $sql = "INSERT INTO UnitMessage (umess_text, tnt_id, tun_id, umess_date_sent) VALUES (?, ?, ?, ?)";

        $stmt = $db->prepare($sql);
        $stmt->bind_param('siis', $text, $tnt_id, $tun_id, $time_sent);
        $stmt->execute();
        $db->close();
        // Format Response
        $data['status'] = 'success';

        echo json_encode($data);
    } catch (PDOException $e) {
        echo '{"error"}' . $e->getMessage();
    }
});

// GET -> /roommate_chat/:tntID/:tunID -> Get messages for particular unit
$app->get('/roommate_chat/:tntID/:tunID', function($tnt_id, $tun_id) {
    $db = getConnection();
    $tnt_id = $db->real_escape_string($tnt_id);
    $tun_id = $db->real_escape_string($tun_id);
    
    $sql = "SELECT Tenant.tnt_fname, Tenant.tnt_lname, UnitMessage.umess_text, UnitMessage.tnt_id, UnitMessage.tun_id, UnitMessage.umess_date_sent FROM UnitMessage INNER JOIN Tenant ON UnitMessage.tnt_id = Tenant.tnt_id WHERE UnitMessage.tun_id=$tun_id ORDER BY UnitMessage.umess_date_sent DESC LIMIT 15";
    $q = $db->query($sql);
    if($q->num_rows > 0) {
        while($row = $q->fetch_array(MYSQLI_ASSOC)) {
            $rows[] = $row;
        }
        $data['status'] = 'success';
        $data['messages'] = $q->num_rows;
        $data['data'] = $rows;
    } else {
        $data['status'] = 'failure';
        $data['messages'] = $q->num_rows;
        $data['data'] = NULL;
    }
    echo json_encode($data);
    
});


/**
 * Login ROUTES
 * 1. POST -> /login
 */
// POST: /login -> Login User
$app->post('/login', function() {
    $request = \Slim\Slim::getInstance()->request();
    $body = $request->getBody();
    $login = json_decode($body);
    
    try {
        $db = getConnection();
        
        $email = $db->real_escape_string($login->login_email);
        $pass = $db->real_escape_string($login->login_password);
        $pass = hash('sha256', $pass);
        
        $sql = "SELECT Tenant.tnt_id, Tenant.tmt_id, Tenant.tnt_fname, Tenant.tnt_lname, Tenant.tnt_email, Tenant.tnt_avatar, Tenant.tnt_profile_complete, Leasing.tun_id, Leasing.urm_id, TowerUnit.tun_opentok_session FROM Tenant LEFT JOIN Leasing ON Tenant.tnt_id = Leasing.tnt_id LEFT JOIN TowerUnit ON Leasing.tun_id = TowerUnit.tun_id WHERE Tenant.tnt_email='$email' AND Tenant.tnt_password='$pass'";
        $q = $db->query($sql);
        if($q->num_rows > 0) {
            while($row = $q->fetch_array(MYSQLI_ASSOC)) {
                    $rows[] = $row;
            }
            // Format Response
            $data['status'] = 'success';
            $data['login_match'] = $q->num_rows;
            $data['data'] = $rows;
        } else {
            $data['status'] = 'success';
            $data['login_match'] = $q->num_rows;
            $data['data'] = NULL;
        }
        // Free result and close connection
        $q->free();
        $db->close();

        echo json_encode($data);
    } catch (PDOException $e) {
        echo '{"error"}' . $e->getMessage();
    }
    
}); // ***END POST: /login -> Login User


// POST: /contacts -> Create new contact
$app->post('/contacts', function() {
    $request = \Slim\Slim::getInstance()->request();
    $body = $request->getBody();
    $contact = json_decode($body);

    $sql = 'INSERT INTO contacts (fname, lname, email) VALUES (?, ?, ?)';
    try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bind_param('sss', $contact->fname, $contact->lname, $contact->email);
            $stmt->execute();
            $contact->id = $stmt->insert_id;

            $db->close();
            echo json_encode($contact);
    } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
    }
}); // ***END POST /contacts -> Create new Contact

// DELETE: /contacts/:id -> DELETE a Concact
$app->delete('/contacts/:id', function($id) {
	$sql = 'DELETE FROM contacts WHERE id=?';
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);
		$stmt->bind_param('i', $id);
		$stmt->execute();
		$db->close();
		
	} catch(Exception $e) {
		echo 'Error: ' . $e->getMessage();
	}
	
});

function getConnection() {
	$dbc = new mysqli("localhost", "root", "root", "LH");

	return $dbc;
} // ***END getConnection() Method

$app->run();
?>