<!DOCTYPE html>
<html lang="en">
<head>



    <style>

    body {
  width: 100vw;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  font-family: sans-serif;
  font-size: 16px;
  background-color: #F0F8FF;
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
table, th, td {
  padding: 5px;
}
    </style>
</head>
<?php
	session_start();
	$con = mysqli_connect('localhost','root','','COVID');

	echo "<h1>Welcome ".$_SESSION['user']."</h1>" ;
	$name = $_SESSION['user'];

	$sql = "select * from HOSPITAL_INFO where NAME like '$name'";
	$result = mysqli_query($con, $sql);

	$row = mysqli_fetch_array($result);

	echo "<table>";
	echo "<tr><th>Name</th><td>".$row[0]."</td></tr>";
	echo "<tr><th>Address</th><td>".$row[1]."</td></tr>";
	echo "<tr><th>Capacity</th><td>".$row[2]."</td></tr>";
	echo "<tr><th>Vaccine</th><td>".$row[3]."</td></tr>";
	echo "</table>";


	echo "<h2>INFORMATION GIVEN BELOW</h2>\n\n";

	$sql = "SELECT * FROM STUDENT_INFO where HOS_NAME like '$name%'";
	$result = mysqli_query($con, $sql);

	$i = mysqli_num_rows($result);

	if($i == 0){
		echo "No info in the database\n";
	}else{
		echo "<table>";
		echo "<tr><th>Name</th><th>NID</th><th>Birth Date</th><th>1st dose</th><th>2nd dose</th><th>Vaccine name</th><th>Edit</th></tr>";
		while($row = mysqli_fetch_array($result)){

			if(is_null($row[4]))$row[4] = "NOT DONE";
	?>
			<tr>
				<td><?php echo $row[1]; ?></td>
				<td><?php echo $row[0]; ?></td>
				<td><?php echo $row[2]; ?></td>
				<td><?php echo $row[6]; ?></td>
				<td><?php echo $row[7]; ?></td>
				<td><?php echo $row[8]; ?></td>
				<td><a href="hedit.php?id=<?php echo $row[0];?>">Edit</a></td>
			</tr>
	<?php
		}

		echo "</table>";
	} ?>
<form method="POST">

	<label>Update Hospital capacity : </label>
   <input type = "text" name = "cap" value = ""/>
	 <br>
   <input style="margin:5px ;font-size:15px" type="submit" name="update" value="Update">
   <br>
   </form>
   <form action="Home.php" method="POST">
       <input style="margin: 7px;width:360px;font-size:15px" type="submit" name="Log Out" value="Log Out">
   </form>

<?php


if(isset($_POST['update']))
{
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
