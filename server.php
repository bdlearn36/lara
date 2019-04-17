<?php 
	session_start();
	$db = new mysqli('localhost', 'root', '', 'crud');

	// initialize variables
	$name = "";
	$address = "";
	$id = 0;
	$update = false;
//save user data query.....................................................
	if (isset($_POST['save'])) {
		$name = $_POST['name'];
		$address = $_POST['address'];
		$save = $db->query("INSERT INTO info (name, address) VALUES ('$name', '$address')"); 
		$_SESSION['message'] = "Address saved sucessfully!"; 
		header('location: index.php');
	}
// read /show all user data...................................................
	$results = $db->query("SELECT * FROM info");

//Edit user data.............................................................
	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = $db->query("SELECT * FROM info WHERE id=$id");
		$data = $record->fetch_array();	
	}
	
//update user data.................................................................
if (isset($_POST['update'])) {
	$id = $_POST['id'];
	$name = $_POST['name'];
	$address = $_POST['address'];
	$update = $db->query("UPDATE info SET name='$name', address='$address' WHERE id=$id");
	$_SESSION['message'] = "Address updated sucessfully!"; 
	header('location: index.php');
	}

//delete user data........................................................................
	if(isset($_GET['del'])){
	$id = $_GET['del'];
	$data = $db->query("DELETE  FROM info WHERE id=$id");
	$_SESSION['message'] = "Address Delete sucessfully!"; 
	header('location: index.php');	
	}


?>