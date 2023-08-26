<head>
    <?php session_start();?>
    <title>Hospital Registration Form</title>
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
    <form name = "form1" method = "post" enctype = "multipart/form-data" >

                <label>Hospital Name:</label>
                <input type = "text" name = "hname" value = "" required/>
                <br>
                <label>Address:</label>
                <input type = "text" name = "address" value = "" required/>
                <br>
                <label>Capacity:</label>
                <input type = "number" name = "cap" value = "" required/>
                <br>
                <label>Password:</label>
                <input type = "password" name = "hpwd" value = "" required/>
                <br>
                <label>Vaccine:</label>
                <input type="text" name="vac" required/>

            <input type="submit" class="btn btn-solid" name = "login" value="Login">

    </form>
</body>


<?php include 'Hospital_reg_backend.php';?>
