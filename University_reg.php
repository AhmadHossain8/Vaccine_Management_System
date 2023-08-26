<head>
    <?php session_start();?>
    <title>University Registration Form</title>
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

    <h2>Sign Up</h2>
    <form name = "form3" method = "post" enctype = "multipart/form-data" >

                <label>University Name:</label>
                <input type = "text" name = "uniname" value = "" required/>
                <br>
                <label>Address:</label>
                <input type = "text" name = "uniaddress" value = "" required/>
                <br>
                <label>Student Capacity:</label>
                <input type = "number" name = "unicap" value = "" required/>
                <br>
                <label>Password:</label>
                <input type = "password" name = "unipwd" value = "" required/>
                <br>

            <input type="submit" class="btn btn-solid" name = "login" value="Login">

    </form>
</body>


<?php include 'University_reg_backend.php';?>
