<?php
session_start();
$con = mysqli_connect('localhost','root','','COVID');


    if(isset($_POST['login'])){

        // variable
        $reg_name = $_POST['reg_name'];
        $NID = $_POST['nid'];
        $reg_pass = $_POST['reg_pwd'];
        $insname = $_POST['ins'];
        $ho_name = $_POST['Hos_name'];
        $tomorrowDate = date("Y-m-d",strtotime("+1 day")); // getting tomorrow date
        $tomorrow4week = date("Y-m-d",strtotime("+4 week")); // getting date after 28 days
        

        //checking if the hospital is filled or not
        $sql = "select FILLED from DATE where 1st_dose = '$tomorrowDate' AND NAME like '$ho_name%'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);
        if(is_null($row[0])){
            $row[0] = 0;
        }$x = $row[0] + 1;

        $sql = "select CAPACITY from HOSPITAL_INFO where NAME like '$ho_name'";
        $result = mysqli_query($con, $sql);
        $row2 = mysqli_fetch_array($result);  


        
        if($row[0] == $row2[0]){
            echo "Sorry this hospital is filled. Please try a new hospital\n";
            header("refresh:2;url=student_registration.php");
        }else{

            //checking if the user is already registered or not
            $sql = "select * from LOGIN where USERNAME like '$reg_name'";
            $result = mysqli_query($con, $sql);
            $row = mysqli_num_rows($result);

            if($row >= 1){
                echo "This user has already registered.\n";
                header("refresh:2;url=student_registration.php");
            }
            else{

                //checking the infos
                $sql = "select * from STUDENT_INFO where NAME like '$reg_name' AND NID like '$NID' ";
                $result = mysqli_query($con, $sql);
                $row = mysqli_num_rows($result);

                if($row >= 1){

                    $_SESSION['rname'] = $reg_name;
                    echo 'login Successful';

                    //inserting username and pass to login table
                    $sql = "insert into LOGIN (USERNAME,PASSWORD) values ('" .$reg_name."','".$reg_pass."')";
                    $result = mysqli_query($con,$sql);


                    //updating the vaccine name for student
                    $sql = "select VACCINE from HOSPITAL_INFO where NAME like '$ho_name'" ;
                    $result = mysqli_query($con,$sql);
                    $row = mysqli_fetch_array($result);
                    $sql = "update STUDENT_INFO set REGISTRATION = 'DONE', HOS_NAME = '$ho_name',1ST_D = '$tomorrowDate' , 2ND_D = '$tomorrow4week', VACCINE = '$row[0]' where NID like '$NID'";
                    $result = mysqli_query($con,$sql);



                    //updating the filled column of the hospital
                    $sql = "select FILLED from DATE where 1st_dose = '$tomorrowDate' AND NAME like '$ho_name%'";
                    $result = mysqli_query($con, $sql);
                    $row = mysqli_fetch_array($result);
                    if(is_null($row[0])){
                        $row[0] = 0;
                    }

                    if($row[0] == 0){

                        //if no user is registered on that date
                        $sql = "insert into DATE values ('".$tomorrowDate."','".$tomorrow4week."','".$ho_name."', '".$x."')";
                        $result = mysqli_query($con,$sql);
                        header("refresh:1;url=login.php");

                    }else{  

                        //atleast one user is registered on that date
                        $sql = "update DATE set FILLED = ".$x." where 1st_dose = '$tomorrowDate' AND NAME like '$ho_name%'";
                        $result = mysqli_query($con,$sql);
                        header("refresh:1;url=login.php");  

                    }


                   
                }else{
                    echo "NOT SUCCESSFULL";
                    header("refresh:2;url=student_registration.php");
                }
            }
        }
        
    }
?>