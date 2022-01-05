<?php

$Username = $_POST['Username'];
$email  = $_POST['email'];
$password = $_POST['password'];
$specialization = $_POST['specialization'];




if (!empty($Username) || !empty($email) || !empty($password) || !empty($specialization) )
{

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "test";



// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}
else{
  $SELECT = "SELECT email From doctor Where email = ? Limit 1";
  $INSERT = "INSERT Into doctor (Username , email ,password, specialization )values(?,?,?,?)";

//Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

     //checking username
      if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ssss", $Username,$email,$password,$specialization);
      $stmt->execute();
      header('location:signindoc.html');
     } else {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>