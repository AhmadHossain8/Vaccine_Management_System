<head>
    <title>Forgot Password</title>
    <style>
    body {
  width: 100vw;
  height: 60vh;
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

    <h2>Forgot Password</h2>
    <form name = "form2" method = "post" enctype = "multipart/form-data" >

                <label>Name :</label>
                <input type = "text" name = "f_name" value = "" required/>
                <br>
                <label>Password:</label>
                <input type = "password" name = "f_pwd" value = "" required/>

                <input type="submit"  name = "flogin" value="Login">

    </form>
</body>


<?php include 'forgot_password_backend.php';?>
