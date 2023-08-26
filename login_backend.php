<?php
session_start();
    $con = mysqli_connect('localhost','root','','COVID');
    if(isset($_POST['login'])){
        $user = $_POST['uname'];
        $pass = $_POST['pwd'];

        $sql = "select * from LOGIN where binary USERNAME like '$user' AND PASSWORD like '$pass'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_num_rows($result);

        if($row >= 1){
            $sql = "select * from STUDENT_INFO where binary NAME like '$user'";
            $result = mysqli_query($con, $sql);
            $row = mysqli_num_rows($result);

            if($row >= 1){
                $_SESSION['user'] = $user;
                echo 'login Successful';
                header("refresh:1;url=welcome.php");
            }else{
                $sql = "select * from HOSPITAL_INFO where binary NAME like '$user'";
                $result = mysqli_query($con, $sql);   
                $row = mysqli_num_rows($result);

                if($row >= 1){
                    $_SESSION['user'] = $user;
                    echo 'login Successful';
                    header("refresh:1;url=hospital_homepage.php");
                }else{
                    $sql = "select * from UNIVERSITY_INFO where binary NAME like '$user'";
                    $result = mysqli_query($con, $sql);   
                    $row = mysqli_num_rows($result);

                    if($row >= 1){
                        $_SESSION['user'] = $user;
                        echo 'login Successful';
                        header("refresh:1;url=university_homepage.php");
                    }else{
                        $_SESSION['user'] = $user;
                        echo 'login Successful';
                        header("refresh:1;url=admin_homepage.php");                        
                    }
                }
            }

                      
        
           
        }else{
            echo "NOT SUCCESSFULL TRY AGAIN";
            header("refresh:1;url=login.php");
        }
    }

?>