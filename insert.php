<?php

$conn = mysqli_connect("localhost", "xxxx", "xxxx", "test");

Header("Content-Tye: application/json; charset=UTF-8");
if (mysqli_connect_errno()) {
	echo json_encode(array("data"=>"Connection failed"));    
    exit();
}


$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$gender = $_POST['gender'];
$dob = $_POST['dob'];

if ( ( !empty($first_name) && !empty($last_name) && !empty($gender) && !empty($dob) )  ){


	$query = "insert into people ( first_name , last_name , dob , gender ) values ( '$first_name', '$last_name', '$dob', '$gender' ) ";
	$stmt = mysqli_prepare($conn, $query);
	mysqli_stmt_execute($stmt);

	$result = mysqli_query($conn, "select * from people order by id desc limit 1");
	
	$json_array = array();

	$assoc = mysqli_fetch_array($result);

	array_push($json_array, 
		array(
			 "id"=>$assoc['id'], 
			 "gender"=>$assoc['gender'], 
			 "dob"=>$assoc['dob'], 
			 "first_name"=>$assoc['first_name'], 					 					 					 
			 "last_name"=>$assoc['last_name'] 					 					 					 					 
			) 
	);

	echo json_encode($json_array);			

}else{
	echo json_encode(array("data"=>"Some parameters are missing"));
}

mysqli_close($conn);
?>