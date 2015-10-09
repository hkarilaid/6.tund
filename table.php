<?php
	
	require_once("functions.php");
	
	//kas kasutaja tahab kustutada
	//vaatan kas aadressi real on ?delete=????
	if(isset($_GET["delete"])){
		
		
		deleteCar($_GET["delete"]);
	}
	
	
	
	
	$car_list = getCarData();
	
?>
<table border=1 >
<tr>
	<th>ID</th>
	<th>Auto nr märk</th>
	<th>Värv</th>
	<th>Kasutaja</th>
</tr>

	<?php
	
		for($i = 0; $i < count($car_list); $i++){
			echo "<tr>";
			
			echo "<td>".$car_list[$i]->id."</td>";
			echo "<td>".$car_list[$i]->number_plate."</td>";
			echo "<td>".$car_list[$i]->color_from_db."</td>";
			echo "<td>".$car_list[$i]->user_id."</td>";
			echo "<td><a href='?delete=".$car_list[$i]->id."'>X</a></td>";
			
			echo "<tr>";
			
		}