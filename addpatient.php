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
	<title>Add Patient</title>
</head>
<body>
<center>
	<h1>Clinic Management</h1>
	<p>Better Health Care</p>
	<a href="addpatient.php">Add Patient</a>
    <a href="doctor.php">Add Doctor</a>
    <a href="patientsearch.php">Search Patients</a>
    <a href="">Search Doctor</a>
    <a href="">Patient CheckUp</a>
</center>





 <h1>Add Patient</h1>
 <fieldset>
 	<legend>Patient's Details</legend>
 	<form action="" method="POST">
 		<input type="text" name="surname" placeholder="Enter Surname"><br/><br/>
 		<input type="text" name="first_name" placeholder="Enter First_name"><br/><br/>
 		<input type="text" name="last_name" placeholder="Enter last_name"><br/><br/>
 		<input type="tel" name="phone" placeholder="Enter phone"><br/><br/>
 		<input type="text" name="residence" placeholder="Enter residence"><br/><br/>
 		<input type="text" name="patient_id" placeholder="Enter patient_id"><br/><br/>
 		<label>Enter Gender</label>
 		<input type="radio" name="gender" value="male">Male
 		<input type="radio" name="gender" value="female">Female<br/><br/>
 		<input type="email" name="email" placeholder="Enter email"><br/><br/>
 		<input type="submit" value="Save">

 	</form>
 </fieldset>
</body>
</html>

<?php
//this is the logic:provide the constructor with form values 
if (empty($_POST)) {
	exit();//quit executing php code until,Form Button is clicked
}

$object = new Patient($_POST['surname'],
	$_POST['first_name'],
	$_POST['last_name'],
	$_POST['phone'],
	$_POST['residence'],
	$_POST['patient_id'],
	$_POST['gender'],
	$_POST['email']);

$object->save();//trigger save function
class Patient{
	function __construct($surname,$first_name,$last_name,$phone,$residence,$patient_id,$gender,$email){
		$this->surname=$surname;
		$this->first_name=$first_name;
		$this->last_name=$last_name;
		$this->phone=$phone;
		$this->residence=$residence;
		$this->patient_id=$patient_id;
		$this->gender=$gender;
		$this->email=$email;
		
	}//end function construct

	function save(){
		//connect to your database
		$conn = mysqli_connect("localhost","root","","clinic_db");
		$response=mysqli_query($conn, "INSERT INTO `table_patients`(`surname`, `first_name`, `last_name`, `phone`, `residence`,`patient_id`, `gender`, `email`) 
			VALUES ('$this->surname','$this->first_name','$this->last_name','$this->phone','$this->residence','$this->patient_id','$this->gender','$this->email')");
	if ($response==true) {
		echo "Record Saved Succesfully";
	}

    else{
    	echo "Record Failed.Check Your Details";
    }

	}//end function save
}//end class












 ?>