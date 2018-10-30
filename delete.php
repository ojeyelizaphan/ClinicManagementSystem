<?php 
if (empty($_GET)) {
	header("location:patient.search.php");//redirect user
}
//receive the patient_id
$patient_id = $_GET	['patient_id'];
//use it in deletion query
$conn = mysqli_connect("localhost","root","","clinic_db");
$response = mysqli_query($conn, "DELETE FROM table_patients WHERE patient_id = '$patient_id'");
if ($response==true) {
	echo"$patient_id has been removed";
	echo "<a href='patientsearch.php'>Back</a>";
}

else{
	echo "$patient_id has not been removed";
	echo "<a href='patientsearch.php'>Back</a>";
}




 ?>