<!DOCTYPE html>
<html lang="en">
<head>



    <style>
    .One {
        position: relative;

    }

    .One:after {

        content: "Make PDF";
        color: #ffffff;
        position: absolute;
        left: 180px;
        top: 15px;
        pointer-events: none;
    }
    [name="query"] {
        color: transparent;
    }
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
input{
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

echo "<h1>Welcome  ".$_SESSION['user']."</h1>";

$uniname = $_SESSION['user'];

$sql = "SELECT * FROM UNIVERSITY_INFO where NAME like '$uniname%'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);

echo "<table>";

echo "<tr><th>Name :</th><td><b>".$row[0]."</b></td></tr>";
echo "<tr><th>Address :</th><td><b>".$row[1]."</b></td></tr>";
echo "<tr><th>Capacity :</th><td><b>".$row[2]."</b></td></tr>";
echo "</table>";

echo "\n\n";

echo "<h2>INFORMATION OF THE STUDENTS GIVEN BELOW</h2>\n\n";

$sql = "SELECT * FROM STUDENT_INFO where INS_NAME like '$uniname%' ORDER BY REGISTRATION DESC";
$result = mysqli_query($con, $sql);

$i = mysqli_num_rows($result);

if($i == 0){
	echo "No student info in the rowbase\n";
}else{
	echo "<table >";
	echo "<tr><th>Name</th><th>NID</th><th>Birth Date</th><th>Registration</th><th>Hospital</th><th>1st dose</th><th>2nd dose</th><th>Vaccine name</th><th>Edit</th></tr>";
	while($row = mysqli_fetch_array($result)){

		if(is_null($row[4]))$row[4] = "NOT DONE";
?>
		<tr>
			<td><b><?php echo $row[1]; ?></b></td>
      <td><b><?php echo $row[0]; ?></b></td>
			<td><b><?php echo $row[2]; ?></b></td>
			<td><b><?php echo $row[4]; ?></b></td>
			<td><b><?php echo $row[5]; ?></b></td>
			<td><b><?php echo $row[6]; ?></b></td>
			<td><b><?php echo $row[7]; ?></b></td>
			<td><b><?php echo $row[8]; ?></b></td>

			<td><b><a href="edit.php?id=<?php echo $row[0];?>">Edit</a></b></td>
		</tr>
<?php
	}

	echo "</table>";
}

?>

<form enctype="multipart/form-data" method="POST">

    <H1>To insert Student Info</H1>

        <label >Select File</label>

            <input type="file" name="file" >

        <label >Import row</label>

            <button type="submit" id="submit" name="Import">Import</button>


</form>

<?php include 'import_backend.php'; ?>

<h3>Download Student Information</h3>

<form action="pdf.php" method="POST">
<div class="One">
    <input style="margin:5px" type="submit" name="query" value="SELECT * FROM STUDENT_INFO where INS_NAME like '<?php echo $uniname ?>%' "/>
</div>
  </form>
  <br>
  <form action="Home.php" method="POST">
      <input style="margin: 7px;width:430px" type="submit" name="Log Out" value="Log Out">
  </form>


<?php
if(isset($_POST['Log Out'])){
    session_destroy();
    header("refresh:1;url=Home.php");
}
?>
