<?php
/*
 * The Prepared Statements Method
 * Best Practice
 */
$username="root";
$password="root";
$table="QandA";
$product = $_POST['Product'];
//$product ="Sitecore";
$topic = $_POST['Topic'];

//no product selected
if ($product=="None") {
	try {
    $conn = new PDO('mysql:host=localhost;dbname=rfp', $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
     
    $stmt = $conn->query("SELECT question, answer FROM QandA WHERE topic = '$topic' ");
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data);


	} catch(PDOException $e) {
	    echo 'ERROR: ' . $e->getMessage();
	}
}
//product and topic selected
else{
	try {
	    $conn = new PDO('mysql:host=localhost;dbname=rfp', $username, $password);
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
	     
	    $stmt = $conn->query("SELECT question, answer FROM QandA WHERE product = '$product' AND topic = '$topic' ");
	    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	    echo json_encode($data);


	} 	catch(PDOException $e) {
	    echo 'ERROR: ' . $e->getMessage();
	}
}
?>