
<head>
    <title>Registration Form</title>
    <?php session_start();?>
    <style>

    body {
  width: 100vw;
  height: 90vh;
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
<body>

    <h1 >Sign Up</h1>
    <form name = "form1" method = "post" enctype = "multipart/form-data" >

                <label>Name :</label>
                <input type = "text" name = "reg_name" value = "" required/>
                <br>
                <label>NID:</label>
                <input type = "text" name = "nid" value = "" required/>
                <br>
                <label>Hospital Name:</label>

                <select name="Hos_name" required/>

                    <option >Hospital Names</option>
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

                <br>
                <br>
                <label>Password:</label>
                <input type = "password" name = "reg_pwd" value = "" required/>

            <input type="submit"  name = "login" value="Login">

    </form>
</body>


<?php include 'student_registration_backend.php';?>
