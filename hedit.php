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
<?php
session_start();

$con = mysqli_connect('localhost','root','','COVID');
$hname = $_SESSION['user'];
$nid = $_GET['id'];


if(isset($_POST['update']))
{
    $a = $_POST['1std'];
    $b = $_POST['2ndd'];

    $sql = "select FILLED from DATE where 1ST_DOSE like '$a' AND 2ND_DOSE like '$b' AND NAME like '$hname'";
    $result = mysqli_query($con, $sql);
    $ccap = mysqli_fetch_array($result);

    $sql = "select CAPACITY from HOSPITAL_INFO where NAME like '$hname'";
    $result = mysqli_query($con,$sql);
    $caphos = mysqli_fetch_array($result);

    if(is_null($ccap)){
        $ccap[0] = 0;
    }

    if($ccap[0] == $caphos[0]){
        echo "This date is full\n";
        header("refresh:1;url= hedit.php");
    }else{

        if($ccap[0] == 0){
            $ccap[0] = 1;
            $sql = "insert into DATE values('$a','$b','$hname','$ccap[0]')";
            $result = mysqli_query($con,$sql);

            $sql = "select 1ST_D,2ND_D from STUDENT_INFO where NID like '$nid'";
            $result = mysqli_query($con,$sql);
            $da = mysqli_fetch_array($result);

            $sql = "select FILLED from DATE where 1ST_DOSE like '$da[0]' AND 2ND_DOSE like '$da[1]' AND NAME like '$hname'";
            $result = mysqli_query($con,$sql);
            $cur_cap = mysqli_fetch_array($result);

            $cur_cap[0] -= 1;


           $sql = "update DATE set FILLED = '$cur_cap[0]' where 1ST_DOSE like '$da[0]' AND 2ND_DOSE like '$da[1]' AND NAME like '$hname' ";
            $result = mysqli_query($con,$sql);

           $sql = "update STUDENT_INFO set 1ST_D = '$a', 2ND_D = '$b' where NID like '$nid'";
           $result = mysqli_query($con,$sql);
        }else{
           $ccap[0]++;
            $sql = "update DATE set FILLED = '$ccap[0]' where 1ST_DOSE like '$a' AND 2ND_DOSE like '$b' AND NAME like '$hname'";
            $result = mysqli_query($con,$sql);

            $sql = "select 1ST_D,2ND_D from STUDENT_INFO where NID like '$nid'";
            $result = mysqli_query($con,$sql);
            $da = mysqli_fetch_array($result);

            $sql = "select FILLED from DATE where 1ST_DOSE like '$da[0]' AND 2ND_DOSE like '$da[1]' AND NAME like '$hname'";
            $result = mysqli_query($con,$sql);
            $cur_cap = mysqli_fetch_array($result);

            $cur_cap[0] -= 1;


           $sql = "update DATE set FILLED = '$cur_cap[0]' where 1ST_DOSE like '$da[0]' AND 2ND_DOSE like '$da[1]' AND NAME like '$hname' ";
            $result = mysqli_query($con,$sql);

           $sql = "update STUDENT_INFO set 1ST_D = '$a', 2ND_D = '$b' where NID like '$nid'";
           $result = mysqli_query($con,$sql);
        }
    }
}

if(isset($_POST['Log Out'])){
    header("refresh:1;url=Home.php");
}


?>

 <h3>Update Data</h3>

 <form method="POST">
   <label>1st dose date:</label>
   <input type="text" name="1std" value="YEAR-MONTH-DAY">
   <br>
   <label>2nd dose date:</label>
   <input type="text" name="2ndd" value="YEAR-MONTH-DAY">
   <br>
   <input type="submit" name="update" value="Update">
   <br>
 </form>
<form action="Home.php" method="POST">
     <input style="margin: 7px;width:430px" type="submit" name="Log Out" value="Log Out">
 </form>