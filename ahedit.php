<!DOCTYPE html>
<html lang="en">
<head>

    <style>

    body {
  width: 100vw;
	height: 90vh;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  font-family: sans-serif;
  font-size: 16px;
  background-color: #F0F8FF;
}
input{
  width: 100%;
  padding: 10px , 20px;
  font-size: 1 rem;
  margin: 15px 0;
  box-sizing: border-box;
  border: 3px solid salmon;
  border-radius: 5px;
}
input[type="submit"]{
	width: 100%;
	padding: 20 px 20 px;
	border: none;
	background-color: red;
	color: white;
	padding: 10px;
	cursor: pointer;
	border-radius: 50px;
}
    </style>
</head>
<form method="POST">

	<label>Update Hospital capacity : </label>
   <input type = "text" name = "cap" value = ""/>
   <input type="submit" name="update" value="Update">
 </form>
 <form action="Home.php" method="POST">
     <input style="margin: 7px;width:430px" type="submit" name="Log Out" value="Log Out">
 </form>
<?php
$con = mysqli_connect('localhost','root','','COVID');

$name = $_GET['id'];


if(isset($_POST['update'])){
	$cap = $_POST['cap'];
    $sql = "update HOSPITAL_INFO set CAPACITY = '$cap' where NAME like '$name'";
    $result = mysqli_query($con,$sql);
    echo "update done\n";
}

if(isset($_POST['Log Out'])){
    session_destroy();
    header("refresh:1;url=Home.php");
}
?>
