<?php
	
	require_once("../configglobal.php");
	$database = "if15_karilaid";
	
	//Loome uue funktsiooni, et kysida ab-st andmeid
	function getCarData(){
		
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("SELECT id, user_id, number_plate, color FROM car_plates");
		$stmt->bind_result($id, $user_id, $number_plate, $color_from_db);
		$stmt->execute();
		
		//tyhi massiiv kus hoiame objekte
		$array = array();
		
		while($stmt->fetch()){
			
			$car = new StdClass();
			$car->id = $id;
			$car->number_plate = $number_plate;
			$car->color_from_db = $color_from_db;
			$car->user_id = $user_id;
			array_push($array, $car);
			
		}
		
		
		
		//$row = 0;
		//tee tsyklit nii mitu korda,kui saad ab-st yhe rea andmeid
		/*while($stmt->fetch()){
			echo $row.",".$number_plate."<br>";
			$row = $row + 1;
			
		}*/
		$stmt->close();
		$mysqli->close();
		
		return $array;
	}
	function deleteCar($id_to_be_deleted){
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("UPDATE car_plates SET deleted=NOW() WHERE id=?");
		$stmt->bind_param("i", $id_to_be_deleted);
		
		if($stmt->execute()){
			
			header("Location: table.php");
		}
		
		$stmt->close();
		$mysqli->close();
	}
?>