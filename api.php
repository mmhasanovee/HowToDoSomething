<?php

/// http://localhost:80/HowToDoS/api.php?id=2

/*View all user informations*/
if($_SERVER['REQUEST_METHOD']=="GET"){
	///setting necessary CORS headers
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

	if(isset($_GET['id'])){
		///receiving the parameter value
		$id=$_GET['id'];

		///connecting to database
		try{
			$conn=new PDO("mysql:host=localhost:3306;dbname=forumdb",'root','');
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$sqlquery="SELECT * FROM users";
			if($id != "all") $sqlquery.=" where id=$id";

			$pdostmt=$conn->query($sqlquery);
			if($pdostmt->rowCount()>0){
				$table=$pdostmt->fetchAll();

				http_response_code(200);
				echo json_encode($table);
			}
			else{
				///no data found for the given id value
				http_response_code(400);

				echo json_encode(array("message"=>"Invalid id"));
			}

		}
		catch(PDOException $ex){
			///database or query error
			http_response_code(503);

			echo json_encode(array("message"=>"Service Unavailable"));
		}
	}
	else{
		///no id value is set error
		http_response_code(404);

		echo json_encode(array("message"=>"id parameter not found"));
	}
}

///setting header informations for preflighted requests like: POST, PUT, DELETE etc.
if($_SERVER['REQUEST_METHOD']=="OPTIONS"){
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");
	header("Access-Control-Allow-Headers: Content-Type");
	header("Access-Control-Allow-Max-Age: 86400");
}




/*Delete a user information*/

if($_SERVER['REQUEST_METHOD']=="DELETE"){
	///setting the necessary headers
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

	///checking the id field
	if(isset($_GET['id'])){
		///receiving the parameter value
		$id=$_GET['id'];

		///connecting to database
		try{
			$conn=new PDO("mysql:host=localhost:3306;dbname=forumdb",'root','');
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$deletequery="DELETE FROM users WHERE id=$id ";

			$no_rows=$conn->exec($deletequery);

			http_response_code(200);

			echo json_encode(array("message"=>"$no_rows user has been banned!"));

		}
		catch(PDOException $ex){
			///database or query error
			http_response_code(503);

			echo json_encode(array("message"=>"Service Unavailable"));
		}
	}
	else{
		///no id value is set error
		http_response_code(404);

		echo json_encode(array("message"=>"invalid user id"));
	}
}


?>
