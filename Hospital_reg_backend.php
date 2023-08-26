<?php
session_start();
$con = mysqli_connect('localhost','root','','COVID');
    if(isset($_POST['login'])){

        $hos_name = $_POST['hname'];
        $address = $_POST['address'];
        $hos_pass = $_POST['hpwd'];
        $cap = $_POST['cap'];
        $vac = $_POST['vac'];


        $sql = "select * from HOSPITAL_INFO where NAME like '$hos_name' AND ADDRESS like '$address' ";
        $result = mysqli_query($con, $sql);
        $row = mysqli_num_rows($result);

        if($row >= 1){
            echo "This user has already registered.\n";
            header("refresh:2;url=registration.php");
        }
        else{
            $sql = "insert into HOSPITAL_INFO values ('" .$hos_name."','"
            .$address."','".$cap."','".$vac."')";
            $result = mysqli_query($con, $sql);
            $sql = "select * from HOSPITAL_INFO where NAME like '$hos_name' AND ADDRESS like '$address' ";
            $result = mysqli_query($con, $sql);
            $row = mysqli_num_rows($result);

            if($row >= 1){
                $_SESSION['hos_name'] = $hos_name;
                echo 'Registration Successful';
                $sql = "insert into LOGIN (USERNAME,PASSWORD) values ('" .$hos_name."','".$hos_pass."')";
                $result = mysqli_query($con,$sql);


                header("refresh:1;url= login.php");
            }else{
                echo "NOT SUCCESSFULL";
                header("refresh:1;url= Hospital_reg.php");
            }
        }
        
    }
?>