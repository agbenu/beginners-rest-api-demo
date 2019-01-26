<?php

$conn = mysqli_connect("localhost", "xxxx", "xxxx", "test");

Header("Content-Tye: application/json; charset=UTF-8");
if (mysqli_connect_errno()) {
	echo json_encode(array("data"=>"Connection failed"));    
    exit();
}

$id = $_GET['id'];
if ($result = mysqli_query($conn, "select * from people where id = $id ")) 
{
    $row_cnt = mysqli_num_rows($result);

	If($row_cnt>0){
		
		$json_array = array();

		while( $assoc = mysqli_fetch_array($result) )
		{
			array_push($json_array, 
				array(
					 "id"=>$assoc['id'], 
					 "gender"=>$assoc['gender'], 
					 "dob"=>$assoc['dob'], 
					 "first_name"=>$assoc['first_name'], 					 					 					 
					 "last_name"=>$assoc['last_name'] 					 					 					 					 
					) 
			);
		}

		echo json_encode($json_array);			

	}else{
		echo json_encode(array("data"=>"Nothing found"));
	}

    mysqli_free_result($result);
}

mysqli_close($conn);
?>