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
 * Step 3: Define the Slim application routes
 *
 * Here we define several Slim application routes that respond
 * to appropriate HTTP request methods. In this example, the second
 * argument for `Slim::get`, `Slim::post`, `Slim::put`, and `Slim::delete`
 * is an anonymous function.
 */

// GET: /packages -> Get Packages for particular tenant
$app->get('/packages/:id', function ($id) {
	$sql = "SELECT * FROM PackageDelivered WHERE pack_pickedup='no' AND tnt_id=$id";
	try {
		$db = getConnection();
		$q = $db->query($sql);
		while($row = $q->fetch_array(MYSQLI_ASSOC)) {
			$rows[] = $row;
		}
                // Format Response
                $data['status'] = 'success';
                $data['pending_package_pickups'] = $q->num_rows;
                $data['response'] = $rows;
                // Free result and close connection
		$q->free();
		$db->close();
                
		echo json_encode($data);
	} catch (PDOException $e) {
		echo '{"error"}' . $e->getMessage();
	}
}); // ***END  GET: /packages/:id -> Get all pending packages for particular tenant

// GET: /packages/history -> Get package pickup histor limit 5
$app->get('/packages/history/:id', function ($id) {
	$sql = "SELECT * FROM PackageDelivered WHERE pack_pickedup='yes' AND tnt_id=$id ORDER BY pack_date_pickedup LIMIT 5";
	try {
		$db = getConnection();
		$q = $db->query($sql);
		while($row = $q->fetch_array(MYSQLI_ASSOC)) {
			$rows[] = $row;
		}
                // Format Response
                $data['status'] = 'success';
                $data['package_history'] = $q->num_rows;
                $data['response'] = $rows;
                // Free result and close connection
		$q->free();
		$db->close();
                
		echo json_encode($data);
	} catch (PDOException $e) {
		echo '{"error"}' . $e->getMessage();
	}
}); // ***END  GET: /contacts -> Get all contacts

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