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
  padding: 20px , 20px;
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

$nid = $_GET['id'];


if(isset($_POST['update1']))
{
    $d = $_POST['bd'];

    $sql = "update STUDENT_INFO set BIRTH_DATE = '$d' where NID like '$nid'";
    $result = mysqli_query($con, $sql);
    echo "Success\n";

}

if(isset($_POST['update2']))
{
    $name = $_POST['name'];
    $sql = "select NAME from STUDENT_INFO where NID like '$nid'";
    $result = mysqli_query($con, $sql);
    $name1 = mysqli_fetch_array($result);

    $sql = "update STUDENT_INFO set NAME  = '$name' where NID like '$nid'";
    $result = mysqli_query($con, $sql);

    $sql = "update LOGIN set USERNAME = '$name' where USERNAME like '$name1[0]'";
    $result = mysqli_query($con, $sql);
    echo "Success\n";
}

if(isset($_POST['update3']))
{
    $ni = $_POST['nid'];
    $sql = "select * from STUDENT_INFO where NID like '$ni'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_num_rows($result);

    if($row == 0){
        $sql = "select NAME from STUDENT_INFO where NID like '$nid'";
        $result = mysqli_query($con, $sql);
        $na = mysqli_fetch_array($result);

        $sql = "update STUDENT_INFO set NID = '$ni' where NAME like '$na[0]'";
        $result = mysqli_query($con, $sql);
        $nid = $ni;
        echo "Success\n";
    }else{
        echo "this id exists";
    }
}

if(isset($_POST['update4'])){

    $honame = $_POST['Hos_name'];
    $sql = "select 1ST_D,2ND_D,HOS_NAME from STUDENT_INFO where NID like '$nid'";
    $result = mysqli_query($con,$sql);
    $da = mysqli_fetch_array($result); // CURRENT HOSPITAL'S DETAILS

    $sql = "select CAPACITY from HOSPITAL_INFO where NAME like '$honame'";
    $result = mysqli_query($con,$sql);
    $caphos = mysqli_fetch_array($result); //SELECTED HOSPITAL'S CAPACITY

    $sql = "select FILLED from DATE where 1ST_DOSE like '$da[0]' AND 2ND_DOSE like '$da[1]' AND NAME like '$honame'";
    $result = mysqli_query($con,$sql);
    $cur_cap = mysqli_fetch_array($result); // FILLED ON THE CURRENT DATE

    if(is_null($cur_cap)){
        $cur_cap = 0;
    }

    if($cur_cap == $caphos){
        echo "select a new one\n";
        header("refresh:1;url= edit.php");
    }else{

        if($cur_cap == 0){
            $cur_cap = 1;
            $sql = "insert into DATE values('$da[0]','$da[1]','$honame','$cur_cap')";
            $result = mysqli_query($con,$sql);

            $sql = "select VACCINE from HOSPITAL_INFO where NAME like '$honame'";
            $result = mysqli_query($con,$sql);
            $vac = mysqli_fetch_array($result);

            $sql = "update STUDENT_INFO set HOS_NAME = '$honame', VACCINE = '$vac[0]' where NID like '$nid'";
            $result = mysqli_query($con,$sql);

            $sql = "select FILLED from DATE where 1ST_DOSE like '$da[0]' AND 2ND_DOSE like '$da[1]' AND NAME like '$da[2]'";
            $result = mysqli_query($con,$sql);
            $cc = mysqli_fetch_array($result);
            $cc[0] -= 1;
            $sql = "update DATE set FILLED = '$cc[0]' where 1ST_DOSE like '$da[0]' AND 2ND_DOSE like '$da[1]' AND NAME like '$da[2]'";
            $result = mysqli_query($con,$sql);
        }else{

            $cur_cap[0]++;
            $sql = "update  DATE set FILLED = '$cur_cap[0]' where 1ST_DOSE like '$da[0]' AND 2ND_DOSE like '$da[1]' AND NAME like '$honame'";
            $result = mysqli_query($con,$sql);

            $sql = "select VACCINE from HOSPITAL_INFO where NAME like '$honame'";
            $result = mysqli_query($con,$sql);
            $vac = mysqli_fetch_array($result);

            $sql = "update STUDENT_INFO set HOS_NAME = '$honame', VACCINE = '$vac[0]' where NID like '$nid'";
            $result = mysqli_query($con,$sql);

            $sql = "select FILLED from DATE where 1ST_DOSE like '$da[0]' AND 2ND_DOSE like '$da[1]' AND NAME like '$da[2]'";
            $result = mysqli_query($con,$sql);
            $cc = mysqli_fetch_array($result);
            $cc[0] -= 1;
            $sql = "update DATE set FILLED = '$cc[0]' where 1ST_DOSE like '$da[0]' AND 2ND_DOSE like '$da[1]' AND NAME like '$da[2]'";
            $result = mysqli_query($con,$sql);
        }
    }
}

if(isset($_POST['update5'])){

    $a = $_POST['1std'];
    $b = $_POST['2ndd'];

    $sql = "select HOS_NAME from STUDENT_INFO where NID like '$nid'";
    $result = mysqli_query($con,$sql);
    $hname = mysqli_fetch_array($result);

    $sql = "select FILLED from DATE where 1ST_DOSE like '$a' AND 2ND_DOSE like '$b' AND NAME like '$hname[0]'";
    $result = mysqli_query($con, $sql);
    $ccap = mysqli_fetch_array($result);

    $sql = "select CAPACITY from HOSPITAL_INFO where NAME like '$hname[0]'";
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
            $sql = "insert into DATE values('$a','$b','$hname[0]','$ccap[0]')";
            $result = mysqli_query($con,$sql);

            $sql = "select 1ST_D,2ND_D from STUDENT_INFO where NID like '$nid'";
            $result = mysqli_query($con,$sql);
            $da = mysqli_fetch_array($result);

            $sql = "select FILLED from DATE where 1ST_DOSE like '$da[0]' AND 2ND_DOSE like '$da[1]' AND NAME like '$hname[0]'";
            $result = mysqli_query($con,$sql);
            $cur_cap = mysqli_fetch_array($result);

            $cur_cap[0] -= 1;


           $sql = "update DATE set FILLED = '$cur_cap[0]' where 1ST_DOSE like '$da[0]' AND 2ND_DOSE like '$da[1]' AND NAME like '$hname[0]' ";
            $result = mysqli_query($con,$sql);

           $sql = "update STUDENT_INFO set 1ST_D = '$a', 2ND_D = '$b' where NID like '$nid'";
           $result = mysqli_query($con,$sql);
        }else{
           $ccap[0]++;
            $sql = "update DATE set FILLED = '$ccap[0]' where 1ST_DOSE like '$a' AND 2ND_DOSE like '$b' AND NAME like '$hname[0]'";
            $result = mysqli_query($con,$sql);

            $sql = "select 1ST_D,2ND_D from STUDENT_INFO where NID like '$nid'";
            $result = mysqli_query($con,$sql);
            $da = mysqli_fetch_array($result);

            $sql = "select FILLED from DATE where 1ST_DOSE like '$da[0]' AND 2ND_DOSE like '$da[1]' AND NAME like '$hname[0]'";
            $result = mysqli_query($con,$sql);
            $cur_cap = mysqli_fetch_array($result);

            $cur_cap[0] -= 1;


           $sql = "update DATE set FILLED = '$cur_cap[0]' where 1ST_DOSE like '$da[0]' AND 2ND_DOSE like '$da[1]' AND NAME like '$hname[0]' ";
            $result = mysqli_query($con,$sql);

           $sql = "update STUDENT_INFO set 1ST_D = '$a', 2ND_D = '$b' where NID like '$nid'";
           $result = mysqli_query($con,$sql);
        }
    }
}

if(isset($_POST['Log Out'])){
    session_destroy();
    header("refresh:1;url=Home.php");
}

?>

 <h3>Update Data</h3>

 <form method="POST">

   <label>Name : </label>
   <input type = "text" name = "name" value = ""/>
   <input style="margin:6px " type="submit" name="update2" value="Name Update">
   <br>
   <label>NID : </label>
   <input style="margin:6px" type = "text" name = "nid" value = ""/>
   <input style="margin:6px" type="submit" name="update3" value="NID Update">
   <br>
   <label>Birth date:</label>
   <input style="margin:6px" type="text" name="bd" value="YEAR-MONTH-DAY">
   <input style="margin:6px" type="submit" name="update1" value="Birth Date Update">
   <br>
    <label>Hospital Name:</label>

    <select name="Hos_name" required/>
        <option style="margin:6px" >Hospital Names</option>
            <?php

            $con = mysqli_connect('localhost','root','','COVID');
            $sql = "select name from HOSPITAL_INFO";
            $result = mysqli_query($con, $sql);
            $row = mysqli_num_rows($result);

            while ($row = mysqli_fetch_array($result)){
                echo "<option value='". $row[0] ."'>" .$row[0] ."</option>" ;
            }

            ?>

    </select>

   <input style="margin:6px" type="submit" name="update4" value="Hospital Name Update">
   <br>
   <label>1st dose date:</label>
   <input style="margin:6px" type="text" name="1std" value="YEAR-MONTH-DAY">
   <br>
   <label>2nd dose date:</label>
   <input style="margin:6px" type="text" name="2ndd" value="YEAR-MONTH-DAY">
   <br>
   <input style="margin:6px" type="submit" name="update5" value="Date Update">
   <br>
 </form>
 <form action="Home.php" method="POST">
     <input style="margin: 7px;width:430px" type="submit" name="Log Out" value="Log Out">
 </form>
