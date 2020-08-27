<?php
	$conn = mysqli_connect("localhost","root","","animals");

	$search = $_POST["search"];
	// $search = isset($_POST["search"]) ? $_POST["search"] : "null"

 $sql = "SELECT * FROM animals , address
where animals.addressID = address.addressID
and name LIKE '$search%'";
//or zipcode Like '$search%'";'

/*
$sql = "SELECT * FROM animals, address
where animals.addressID = address.addressID
and animals.name LIKE '$search%'
or animals.description LIKE '%$search%'
or hobbies LIKE '$search%'
or city LIKE '$search%'
or street LIKE '$search%'
or zipcode LIKE '$search%'";*/

	$result = mysqli_query($conn, $sql);

	if($result->num_rows == 0){
		echo "No result";
	}elseif($result->num_rows == 1){

		$row = $result->fetch_assoc();
		// echo $row["name"];
		echo '
		<div class="col mb-3 ">
		<div class="card px-1 py-1 bg-light" style="width:30%; height:100%;">
			<h5 class="card-title text-secondary">'. $row["status"] .' </h5>
			<img src="img/'. $row["image"] . '" class="card-img-top vh-40" style="width:50vh; height:15vw;">
			<div class="card-body">
				<h3 class="card-text text-success font-weight-bold">' . $row["name"] . ' <span></span></h3>
				<h6 class="card-text"> <?= $string ?> </h6>
				<h6 class="card-text"><span class="font-weight-bold">hobbies: </span>' . $row["hobbies"] . '
				</h6>
				<h6 class="card-text"><span class="font-weight-bold">age: </span> '. $row["age"] .'
				</h6>
				<h6 class="card-text"><span class="font-weight-bold">age: </span> '. $row["description"] .'
				</h6>
				<h7 class="card-text"><span class="font-weight-bold">location:</span> '. $row['street'] . ", " . $row['zipcode'] . " " . $row['city'] .'</h7>

			</div>
			<div class="card-footer text-center">
			<a href="adopt.php?book_id='. $row['animalID'].'" class="btn btn-outline-success mx-auto">Meet ' . $row["name"] .' </a>
		</div>
		</div>
	</div> <hr> ';


	}else {
		echo '<div class="container row row-cols-sm-1 row-cols-md-2 row-cols-lg-3 mx-auto">';
		$rows = $result->fetch_all(MYSQLI_ASSOC);
		foreach ($rows as $row) {
			// echo $row["name"] . "<br>";
			echo '
		<div class="col mb-3 ">
		<div class="card px-1 py-1 bg-light">
			<h5 class="card-title text-secondary">'. $row["status"] .' </h5>
			<img src="img/'. $row["image"] . '" class="card-img-top vh-40" style="width:50vh; height:15vw;">
			<div class="card-body">
				<h3 class="card-text text-success font-weight-bold">' . $row["name"] . ' <span></span></h3>
				<h6 class="card-text"> <?= $string ?> </h6>
				<h6 class="card-text"><span class="font-weight-bold">hobbies: </span>' . $row["hobbies"] . '
				</h6>
				<h6 class="card-text"><span class="font-weight-bold">age: </span> '. $row["age"] .'
				</h6>
				<h6 class="card-text"><span class="font-weight-bold">description: </span> '. $row["description"] .'
				</h6>
				<h7 class="card-text"><span class="font-weight-bold">location:</span> '. $row['street'] . ", " . $row['zipcode'] . " " . $row['city'] .'</h7>

			</div>
		</div>
	</div>';
		}
		echo '</div><hr>';
	}
