<?php
session_start();

// Create connection
$con = mysqli_connect('localhost','root');


mysqli_select_db($con, 'test');


$Username = $_POST['Username'];
$email  = $_POST['email'];
$password = $_POST['password'];

$s = "Select * from patient where Username='$Username' && password='$password' ";

 $result=mysqli_query($con, $s);

 $num=mysqli_num_rows($result);

//checking username
      if ($num == 1)
       { 
         $_SESSION['username']=$Username;
          header('location:homepatient.php');
      }
      else{
          header('location:signinpat.html');
      }
  
?>