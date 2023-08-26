<?php

$con = mysqli_connect('localhost','root','','COVID');


    if(isset($_POST['flogin'])){
      
        $f_name = $_POST['f_name'];
        $f_pass = $_POST['f_pwd'];
 

        $sql = "select * from LOGIN where USERNAME like '$f_name'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_num_rows($result);

        if($row >= 1){
            $sql = "update LOGIN set PASSWORD = '$f_pass' where USERNAME like '$f_name'";
            $result = mysqli_query($con, $sql);


            $sql = "select * from HOSPITAL_INFO where NAME like '$f_name'";
            $result = mysqli_query($con, $sql);

            $row = mysqli_num_rows($result);

            if($row >= 1){
                $sql = "update HOSPITAL_INFO set PASSWORD = '$f_pass' where NAME like '$f_name'";
                $result = mysqli_query($con, $sql);
            }

            $sql = "select * from UNIVERSITY_INFO where NAME like '$f_name'";
            $result = mysqli_query($con, $sql);

            $row = mysqli_num_rows($result);

            if($row >= 1){
                $sql = "update UNIVERSITY_INFO set PASSWORD = '$f_pass' where NAME like '$f_name'";
                $result = mysqli_query($con, $sql);
            }


            header("refresh:1;url=login.php");    
        }else{
            echo "wrong user name";
        }
    }
?>