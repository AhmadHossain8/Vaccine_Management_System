<!DOCTYPE html>
<html lang="en">
<head>

    <title>Home page</title>
    <?php session_start();?>
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
  height: 90vh;
  display: flex;
  flex-direction: column;
  justify-content:space-around;
  align-items: center;
  font-family: sans-serif;
  font-size: 16px;
  background-color: #F0F8FF;
}
input{
  width: 100%;
  padding: 10 px 10 px;
  border: none;
  background-color: red;
  color: white;
  padding: 10px;
  cursor: pointer;
  border-radius: 50px;
}


    </style>
</head>
</head>
<body>

<h1> Welcome <?php echo $_SESSION['user']; ?></h1>

<?php

    $con = mysqli_connect('localhost','root','','COVID');

    $na = $_SESSION['user'];


    $sql = "SELECT * FROM STUDENT_INFO where NAME like '$na' ";
    $result = mysqli_query($con, $sql);

    $row = mysqli_fetch_array($result);
    echo "<table text-align: center>";

    echo "<tr><th > NAME :</th><td><b>".$row[0]."</b></td></tr>";
    echo "<tr><th> NID :</th><td><b>".$row[1]."</b></td></tr>";
    echo "<tr><th> BIRTH_DATE :</th><td><b>".$row[2]."</b></td></tr>";
    echo "<tr><th> INSTITUTE NAME :</th><td><b>".$row[3]."</b></td></tr>";
    echo "<tr><th> REGISTRATION :</th><td><b>".$row[4]."</b></td></tr>";
    echo "<tr><th> HOSPITAL NAME :</th><td><b>".$row[5]."</b></td></tr>";
    echo "<tr><th> 1ST DOSE :</th><td><b>".$row[6]."</b></td></tr>";
    echo "<tr><th> 2ND DOSE :</th><td><b>".$row[7]."</b></td></tr>";
    echo "<tr><th> VACCINE :</th><td><b>".$row[8]."</b></td></tr>";
    echo "</table>";

    if(isset($_POST['Log Out'])){
    session_destroy();
    header("refresh:1;url=Home.php");
    }

?>



<form  action="pdf1.php" method="POST" >
<div class="One">
    <input style="margin: 7px; width:430px" type="submit" name="query" value="SELECT * FROM STUDENT_INFO where NAME like '<?php echo $na ?>' ";/>
</div>
</form>

<br>
<form action="Home.php" method="POST">
    <input style="margin: 7px;width:430px; " type="submit" name="Log Out" action="Home.php" value="Log Out">
</form>

</body>
</html>
