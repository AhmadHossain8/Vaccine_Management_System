<!DOCTYPE html>
<html lang="en">
<head>

    <title>Home page</title>

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

echo "<h1>Welcome Admin</h1>";


echo "<h2>INFORMATION OF THE STUDENTS GIVEN BELOW</h2>\n\n";

$sql = "SELECT * FROM STUDENT_INFO";
$result = mysqli_query($con, $sql);

$i = mysqli_num_rows($result);

if($i == 0){
    echo "No student info in the Database\n";
}else{
    echo "<table>";
    echo "<tr><th>Name</th><th>NID</th><th>Birth Date</th><th>Registration</th><th>Hospital</th><th>1st dose</th><th>2nd dose</th><th>Vaccine name</th><th>Edit</th></tr>";
    while($row = mysqli_fetch_array($result)){

        if(is_null($row[4]))$row[4] = "NOT DONE";
?>
        <tr>
            <td><?php echo $row[1]; ?></td>
            <td><?php echo $row[0]; ?></td>
            <td><?php echo $row[2]; ?></td>
            <td><?php echo $row[4]; ?></td>
            <td><?php echo $row[5]; ?></td>
            <td><?php echo $row[6]; ?></td>
            <td><?php echo $row[7]; ?></td>
            <td><?php echo $row[8]; ?></td>
            <td><a href="aedit.php?id=<?php echo $row[0];?>">Edit</a></td>
        </tr>
<?php
    }

    echo "</table>";
}


echo "<h2>INFORMATION OF THE HOSPITAL GIVEN BELOW</h2>\n\n";

$sql = "SELECT * FROM HOSPITAL_INFO";
$result = mysqli_query($con, $sql);

$i = mysqli_num_rows($result);

if($i == 0){
    echo "No Hospital info in the Database\n";
}else{
    echo "<table >";
    echo "<tr><th>Name</th><th>Address</th><th>Capacity</th><th>Vaccine</th><th>Edit</th></tr>";
    while($row = mysqli_fetch_array($result)){
?>
        <tr>
            <td><?php echo $row[0]; ?></td>
            <td><?php echo $row[1]; ?></td>
            <td><?php echo $row[2]; ?></td>
            <td><?php echo $row[3]; ?></td>
            <td><a href="ahedit.php?id=<?php echo $row[0];?>">Edit</a></td>
        </tr>
<?php
    }

    echo "</table>";
}

echo "<h2>INFORMATION OF THE UNIVERSITY GIVEN BELOW</h2>\n\n";

$sql = "SELECT * FROM UNIVERSITY_INFO";
$result = mysqli_query($con, $sql);

$i = mysqli_num_rows($result);

if($i == 0){
    echo "No University info in the Database\n";
}else{
    echo "<table>";
    echo "<tr><th>Name</th><th>Address</th><th>Number of Student</th></tr>";
    while($row = mysqli_fetch_array($result)){
?>

        <tr>
            <td><?php echo $row[0]; ?></td>
            <td><?php echo $row[1]; ?></td>
            <td><?php echo $row[2]; ?></td>
        </tr>
<?php
    }

    echo "</table>";
}

?>

<form action="Home.php" method="POST">
    <input style="margin: 7px;width:360px;font-size:15px" type="submit" name="Log Out" value="Log Out">
</form>

<?php
if(isset($_POST['Log Out'])){
    session_destroy();
    header("refresh:1;url=Home.php");
}
?>
