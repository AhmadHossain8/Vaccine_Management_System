<?php
session_start();
$con = mysqli_connect('localhost','root','','COVID');
    if(isset($_POST['login'])){

        $uni_name = $_POST['uniname'];
        $uni_address = $_POST['uniaddress'];
        $uni_pass = $_POST['unipwd'];
        $uni_cap = $_POST['unicap'];
    


        $sql = "select * from UNIVERSITY_INFO where NAME like '$uni_name' AND ADDRESS like '$uni_address' ";
        $result = mysqli_query($con, $sql);
        $row = mysqli_num_rows($result);

        if($row >= 1){
            echo "This user has already registered.\n";
            header("refresh:2;url=registration.php");
        }
        else{
            $sql = "insert into UNIVERSITY_INFO values ('" .$uni_name."','"
            .$uni_address."','".$uni_cap."')";

            $result = mysqli_query($con, $sql);
            $sql = "select * from UNIVERSITY_INFO where NAME like '$uni_name' AND ADDRESS like '$uni_address' ";
            $result = mysqli_query($con, $sql);
            $row = mysqli_num_rows($result);

            if($row >= 1){
                $_SESSION['uni_name'] = $uni_name;
                echo 'Registration Successful';
                $sql = "insert into LOGIN (USERNAME,PASSWORD) values ('" .$uni_name."','".$uni_pass."')";
                $result = mysqli_query($con,$sql);
                header("refresh:1;url= login.php");
            }else{
                echo "NOT SUCCESSFULL";
                header("refresh:1;url= University_reg.php");
            }
        }
        
    }
?>