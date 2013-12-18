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
    
    $sql = "SELECT tun_id FROM Leasing WHERE tnt_id=$tnt_id";
    $q = $db->query($sql);
    if($q->num_rows > 0) {
        while($row = $q->fetch_array(MYSQLI_ASSOC)) {
            $tun_id = $row['tun_id'];
        }
        $sql = "INSERT INTO MaintenanceTicket (tnt_id, tun_id, mticket_status, mticket_title, mticket_description, mticket_open_date) VALUES (?, ?, ?, ?, ?, ?)";
        try {
            $stmt = $db->prepare($sql);
            $stmt->bind_param('iissss', $tnt_id, $tun_id, 'open', $db->real_escape_string($ticket->title), $db->real_escape_string($ticket->description), date("Y-m-d H:i:s"));
            $stmt->execute();
            $contact->id = $stmt->insert_id;
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
    $sql = "SELECT * FROM MaintenanceTicket WHERE mticket_status='open' AND tnt_id=$id";
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