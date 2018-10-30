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
	<title>Add Doctor</title>
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





 <h1>Add Doctor</h1>
 <fieldset>
 	<legend>Doctor's Details</legend>
 	<form action="" method="POST">
 		<input type="text" name="doctor_id" placeholder="Enter Doctor ID No"><br/><br/>
 		<input type="text" name="surname" placeholder="Enter Surname"><br/><br/>
 		<input type="text" name="other_names" placeholder="Enter Other Names"><br/><br/>
 		<input type="text" name="dept" placeholder="Enter Department"><br/><br/>
 		<input type="text" name="profession" placeholder="Enter Profession"><br/><br/>
 		<label>Enter Gender</label>
 		<input type="radio" name="gender" value="male">Male
 		<input type="radio" name="gender" value="female">Female<br/><br/>
 		<input type="number" name="experience" placeholder="Enter Experience"><br/><br/>
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

$object = new Patient($_POST['doctor_id'],
	$_POST['surname'],
	$_POST['other_names'],
	$_POST['dept'],
	$_POST['profession'],
	$_POST['gender'],
	$_POST['experience']
	);

$object->save();//trigger save function
class Patient{
	function __construct($doctor_id,$surname,$other_names,$dept,$profession,$gender,$experience){
		$this->doctor_id=$doctor_id;
		$this->surname=$surname;
		$this->other_names=$other_names;
		$this->dept=$dept;
		$this->profession=$profession;
		$this->gender=$gender;
		$this->experience=$experience;
		
		
	}//end function construct

	function save(){
		//connect to your database
		$conn = mysqli_connect("localhost","root","","clinic_db");
		$response=mysqli_query($conn, "INSERT INTO `table_doctors`(`doctor_id`, `surname`, `other_names`, `dept`, `profession`,`gender`, `experience`) 
			VALUES ('$this->doctor_id','$this->surname','$this->other_names','$this->dept','$this->profession','$this->gender','$this->experience')");
	if ($response==true) {
		echo "Record Saved Succesfully";
	}

    else{
    	echo "Record Failed.Check Your Details";
    }

	}//end function save
}//end class












 ?>