<head>
    <style>

    body {
  width: 100vw;
  height: 100vh;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  font-family: sans-serif;
  font-size: 30px;
  background-color: #F0F8FF;
}
    input{
      width: 100%;
      padding: 20 px 20 px;
      font-size: 1 rem;
      margin: 10px 0;
      box-sizing: border-box;
      border: 3px solid salmon;
      border-radius: 5px;
    }
    input[type="submit"]{
      font-size: 20px;
      width: 100%;
      padding: 10 px 10 px;
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
    <?php session_start();?>
    <h1>Login</h1>
    <form name = "form" method = "post" enctype = "multipart/form-data" >

        <label>Username:</label>
        <input style="height:28 px;font-size:20px" type = "text" name = "uname"/>
        <br>
        <label>Password:</label>
        <input style="height:28 px;font-size:20px" type = "password" name = "pwd" />
        <br>
        <input type="submit" class="btn btn-solid" name = "login" value="Login">

        <input type="submit" name = "forgot_password" value = "Forgot Password">
    </form>
</body>

<?php include 'login_backend.php';

    if(isset($_POST['forgot_password'])){
        header("refresh:1;url=forgot_password.php");
    }

?>
