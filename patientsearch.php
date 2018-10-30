<?php 
session_start();
if (isset($_SESSION['username'])) {
	$username = $_SESSION['username'];
	echo "Welcome: $username <br>";
	echo "<a href='logout.php'>Log Out</a>";
}
//if session not set
elseif (!isset($_SESSION['username'])) {
	header("location:login.php");
	die();//kill
}
else{
	header("location:login.php");
	exit();
}


 ?>





<!DOCTYPE html>
<html>
<head>
	<title>Search</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>
<body>
<center>
	<h1>Clinic Management</h1>
	<p>Better Health Care</p>
	<a href="addpatient.php">Add Patient</a>
    <a href="doctor.php">Add Doctor</a>
    <a href="">Search Patients</a>
    <a href="">Search Doctor</a>
    <a href="">Patient CheckUp</a>
</center>

<h1>Search Patients</h1>
<fieldset>
 	<legend>Search Patient</legend>
 	<form action="" method="POST">
 		<input type="text" name="surname" placeholder="Enter Surname"><br/><br/>
 		
 		<input type="submit" value="Search Patient">

 	</form>
</fieldset>



</body>
</html>


<?php 
if (empty($_POST)) {
	exit();//quit if button is not clicked
}

$object = new PatientSearch($_POST['surname']);
$object->search();


class PatientSearch{

function __construct($surname){
$this->surname = $surname;

 }//end constructor


function search(){
$conn = mysqli_connect("localhost","root","","clinic_db");
$response = mysqli_query($conn, "SELECT * FROM `table_patients` WHERE surname = '$this->surname'");
//count your response
if (mysqli_num_rows($response)== 0) {
	echo "No Patient Found.Try Again";
	exit();
}
else{
	//get all columns for the first row found
	echo "<table border=1 width=100% class='table table-hover'>";
	while($col = mysqli_fetch_array($response))
	{
	echo "<tr>";
	echo " <td>$col[0] </td>";
	echo "<td>$col[1] </td>";
	echo"<td>$col[2] </td>";
	echo "<td>$col[3] </td>";
	echo "<td>$col[4] </td>";
	echo "<td>$col[5]</td> ";
	echo "<td>$col[6]</td>";
	echo "<td>$col[7]</td> ";
	echo "<td>$col[8]</td> ";
	echo "<td> <a href='delete.php?patient_id=$col[5]' class='btn btn-danger'>DELETE</a></td>";
	echo "<td> <a href='' class='btn btn-info'>ALLOCATE</a></td>";
	echo "</tr>";
}//end while
echo "</table>";
}//end else

}//end function search

}//end class









?>