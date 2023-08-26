<?php
    session_start();
    $con = mysqli_connect('localhost','root','','COVID');

    if(isset($_POST["Import"])){
        
        $filename=$_FILES["file"]["tmp_name"];    
         if($_FILES["file"]["size"] > 0)
         {

            $file = fopen($filename, "r");
              while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
               {
                 $sql = "INSERT into STUDENT_INFO (NID,NAME,BIRTH_DATE,INS_NAME) 
                       values ('".$getData[0]."','".$getData[1]."','".$getData[2]."','".$getData[3]."')";
                       $result = mysqli_query($con, $sql);
                    
               }
          
            fclose($file);  

            echo "Successfull entered\n";
         }
    }   
?>