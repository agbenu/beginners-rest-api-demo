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
$id = $_POST['id'];

if ($result = mysqli_query($conn, "select * from people where id = $id ")) 
{
    $row_cnt = mysqli_num_rows($result);

	If($row_cnt== 1 ){
		
		if ( ( !empty($first_name) && !empty($last_name) && !empty($gender) )  ){


			$query = "update people set first_name= '$first_name', last_name='$last_name', gender= '$gender' where id = $id ";
			$stmt = mysqli_prepare($conn, $query);
			mysqli_stmt_execute($stmt);

			$result = mysqli_query($conn, "select * from people where id = $id limit 1");
			
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


	}else{
		echo json_encode(array("data"=>"Nothing found"));
	}

    mysqli_free_result($result);
}

mysqli_close($conn);
?>