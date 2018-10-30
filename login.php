<!DOCTYPE html>
<html>
<head>
	<title>Login Screen</title>
	<link rel="stylesheet" 
	href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>
<body>
<center>
<h2>Login Screen</h2>
<fieldset>
 	<h6>Login Details</h6>
 	<form action="" method="POST">
 		<input type="text" name="username" placeholder="Enter Username"><br/><br/>
 		<input type="password" name="password" placeholder="Enter Password"><br/><br/>
 		<input type="submit" value="Login" class="btn btn-primary">

 	</form>
 	<a href="">Don't have an account</a><br>
 	<a href="">Forgot Password</a><br>
</fieldset>
</center>
</body>
</html>

<?php 
if (empty($_POST)) {
    exit();//quit if user has not posted anything
}
//authenticate user
$object = new UserLogin($_POST['username'],$_POST['password']);
$object->login();
class UserLogin{
	function __construct($username, $password){
        $this->username = $username;
        $this->password = $password;
	}//end function
    //use above variables constructed to authenticate users
	function login(){
     $conn = mysqli_connect("localhost","root","","clinic_db");
     $response = mysqli_query($conn, "SELECT * FROM table_users 
     	WHERE username = '$this->username' 
     	AND password = '$this->password' AND status = 'active'");
     //test response
     if (mysqli_num_rows($response)== 0) {
     	echo "Login Failed! Check Credentials";
     }

     elseif (mysqli_num_rows($response)== 1) {
     	echo "Login Success.Welcome";
        //create session
        session_start();
        $_SESSION['username'] = $this->username;//store username
        $_SESSION['time'] = date("y/m/d h:m:s");//store date/time
        //session are stored and available to all other php files
     	header("location: addpatient.php");
     }
     else{
     	echo "Something went wrong. Contact Admin";
     }
	}//end function
}//end class 




 ?>