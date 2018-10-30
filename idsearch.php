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
	<title>Search Id</title>
	<link rel="stylesheet" 
	href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>
<body>
<center>
<h1>Search By ID</h1>
<a href="">Back Home</a>
</center>

<fieldset>
	<legend>Search Doctor</legend>
	<form action="" method="POST">
		<input type="text" name="doctor_id" placeholder="Enter ID No">
		<input type="submit"  value="Search">

	</form>
</fieldset>
</body>
</html>

<?php 
if (empty($_POST)) {
	exit();
}

$object = new DoctorSearch($_POST['doctor_id']);
$object->search();
class DoctorSearch{

function __construct($doctor_id){
	$this->doctor_id = $doctor_id;
}


function search(){
	$conn = mysqli_connect("localhost","root","","clinic_db");
	$response = mysqli_query($conn, "SELECT * FROM `table_doctors` WHERE doctor_id = '$this->doctor_id'");


if (mysqli_num_rows($response)== 0) {
	echo "No Doctor Found.Try Again";
	exit();
}
else{
	echo "<table border=1 width=100% class='table table-hover'>";
	$col = mysqli_fetch_array($response);
	echo "<tr>";
    echo"<td>$col[0] </td>";
	echo "<td>$col[1]</td>";
	echo"<td>$col[2] </td>";
	echo "<td>$col[3]</td>";
	echo "<td>$col[4]</td> ";
	echo "<td>$col[5]</td>";
	echo "<td>$col[6]</td>";
	echo "<td>$col[7] </td>";
	echo "</tr>";
	echo "</table>";

}//end else

}//end function


}//end class




 ?>