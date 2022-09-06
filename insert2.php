<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$conn = mysqli_connect("localhost:3308", "root", "", "tp");
 
// Check connection
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
session_start(); 
// Escape user inputs for security
$uname = mysqli_real_escape_string($conn, $_REQUEST['username']);
$password = mysqli_real_escape_string($conn, $_REQUEST['password']);

if (isset( $_REQUEST['username'])&& isset( $_REQUEST['password']) ){

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$uname = validate($_REQUEST['username']);
	$pass = validate($_REQUEST['password']);

	if (empty($uname)) {
		header("Location: login.html?error=User Name is required");
	    exit();
	}else if(empty($pass)){
        header("Location: login.html?error=Password is required");
	    exit();
	}else{

        
		$sql = "SELECT * FROM signup WHERE username='$uname' AND password='$pass'";

		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
            if ($row['username'] === $uname && $row['password'] === $pass) {
            	$_SESSION['username'] = $row['username'];
            	$_SESSION['email'] = $row['email'];
            	$_SESSION['id'] = $row['id'];
            	header("Location: index.html");
		        exit();
            }else{
				echo "<script language=\"JavaScript\">\n";
echo "alert('Username or Password was incorrect!');\n";
echo "window.location='login.html'";
echo "</script>";
				
			}
		}else{
			echo "<script language=\"JavaScript\">\n";
echo "alert('Username or Password was incorrect!');\n";
echo "window.location='login.html'";
echo "</script>";
		}
		
	}
	
	
}else{
	header("Location: login.html");
	exit();
}